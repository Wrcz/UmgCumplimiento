<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;

class CumplimientoController extends Controller
{
    //

    //Metodo para obtener empresaas
    public function cumplimiento()
    {
        try {
            $Empresas =Db::select('SELECT e.idempresa,e.nombreempresa FROM empresas e INNER JOIN usuarios_empresas ue ON e.idempresa=ue.idempresa WHERE ue.idusuario=? order by e.idempresa', [1]);
 
            return view('Cumplimiento.cumplimiento')->with('Empresas', $Empresas);
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }

    //Metodo para obtener empresaas
    public function cumplimientofetch(Request $request)
    {
        try {
            $select = $request->get('select');
            $value = $request->get('value');
            $dependent = $request->get('dependent');
            $data = DB::select('SELECT r.idregulacion,r.identificacion + char(32) +r.nombreregulacion nombreregulacion FROM regulacion_empresa re INNER JOIN regulacion r ON re.idregulacion=r.idregulacion WHERE re.idempresa=?', [$value]);
       
            $output = '<option value="">Seleccione Regulacion</option>';
            
            foreach ($data as $key => $row) {
                $output .=  '<option value="'.$row->idregulacion.'">'.$row->nombreregulacion.'</option>';
            }
           
            echo($output);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }


    public function cumplimientoregulacion($emp,$regu)
    {
        try {
            DB::beginTransaction();

            $ValoresCumplimiento =Db::statement('INSERT INTO cumplimiento_articulo (idregulacionempresa,idarticulo,observacionescumplimiento,fechacumplimiento,estadocumplimiento) 
            (SELECT re.idregulacionempresa,ra.idarticulo,NULL observaciones,NULL fechacumplimiento,0 estadocumplimiento FROM regulacion_empresa re  INNER JOIN regulacion_articulo ra ON re.idregulacion=ra.idregulacion 
            LEFT JOIN cumplimiento_articulo ca ON ca.idregulacionempresa=re.idregulacionempresa AND ca.idarticulo=ra.idarticulo
                WHERE re.idempresa=? AND re.idregulacion=?  AND ca.idcumplimientoempresa IS null)',[$emp,$regu]);
        
        $Cumplimiento =Db::select('SELECT rs.idseccion,rs.noseccion, rs.tituloseccion,rs.descripcionseccion,rs.estadoseccion,ra.idarticulo,re.idregulacionempresa,
        ra.numeroarticulo,ra.ordenarticulo,ra.tituloarticulo,ra.descripcionarticulo,ra.fechainiciovigencia,ra.fechafinvigencia,ra.estadoarticulo, 
        ISNULL(ca.estadocumplimiento,0) estadocumplimiento, ca.observacionescumplimiento,ca.fechacumplimiento, ISNULL(ce.evidencias,0) evidencias,ISNULL(cec.Sanciones,0) sanciones,
		rs1.idsancion,rs1.descripcionsancion,ca.idcumplimientoempresa,
        ROW_NUMBER() OVER( PARTITION BY ra.idseccion,rs.noseccion ORDER BY rs.noseccion) filaseccion,
        ROW_NUMBER() OVER( PARTITION BY ra.idarticulo ORDER BY ra.idarticulo) filaarticulo
        FROM 
        regulacion r INNER JOIN 
        regulacion_seccion rs ON r.idregulacion=rs.idregulacion INNER JOIN 
        regulacion_articulo ra ON ra.idregulacion=r.idregulacion AND ra.idseccion=rs.idseccion INNER JOIN 
        regulacion_empresa re ON re.idregulacion=r.idregulacion LEFT JOIN 
        cumplimiento_articulo ca ON ca.idarticulo=ra.idarticulo AND ca.idregulacionempresa=re.idregulacionempresa LEFT JOIN
        (SELECT idcumplimientoempresa, COUNT(*) evidencias  FROM cumplimiento_evidencia GROUP BY idcumplimientoempresa ) ce ON ce.idcumplimientoempresa=ca.idcumplimientoempresa  LEFT JOIN
		regulacion_sancion rs1 ON rs1.idarticulo=ra.idarticulo AND rs1.estadosancion=1 LEFT JOIN
        (SELECT rs.idarticulo, COUNT(*) Sanciones  FROM regulacion_sancion rs GROUP BY rs.idarticulo ) cec ON cec.idarticulo =ra.idarticulo
          WHERE re.idempresa=? AND r.idregulacion=?
        ORDER BY rs.noseccion,ra.ordenarticulo,ra.numeroarticulo', [$emp,$regu]);


            $Regulacion =App\regulacion::findOrFail($regu);
            $Empresa =App\empresas::findOrFail($emp);

            $Evidencias =Db::select('SELECT ce.*,a.idarticulo,a.idregulacionempresa FROM cumplimiento_articulo a INNER JOIN cumplimiento_evidencia ce ON a.idcumplimientoempresa=ce.idcumplimientoempresa
            INNER JOIN regulacion_empresa re ON re.idregulacionempresa=a.idregulacionempresa 
            WHERE re.idempresa=? AND re.idregulacion=? ', [$emp,$regu]);

        DB::commit();

            return view('Cumplimiento.cumplimientoregulacion')->with(['Cumplimiento'=> $Cumplimiento,'Regulacion'=>$Regulacion,'Empresa'=>$Empresa,'Evidencias'=>$Evidencias]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }
}
