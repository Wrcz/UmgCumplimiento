<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;

class InformeController extends Controller
{
    //

    public function index()
    {
        return view('Informe.parametroinforme');
    }

    public function informeparametros()
    {
        try {
            $Empresas =Db::select('SELECT e.idempresa,e.nombreempresa FROM empresas e INNER JOIN usuarios_empresas ue ON e.idempresa=ue.idempresa WHERE ue.idusuario=? order by e.idempresa', [1]);
 
            return view('Informe.parametroinforme')->with('Empresas', $Empresas);
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }


    public function informeregulacion($emp,$regu)
    {
        try {

        
            DB::beginTransaction();

            $ValoresCumplimiento =Db::statement('INSERT INTO cumplimiento_articulo (idregulacionempresa,idarticulo,observacionescumplimiento,fechacumplimiento,estadocumplimiento,nivelmadurez) 
            (SELECT re.idregulacionempresa,ra.idarticulo,NULL observaciones,NULL fechacumplimiento,0 estadocumplimiento,0 nivelmadurez FROM regulacion_empresa re  INNER JOIN regulacion_articulo ra ON re.idregulacion=ra.idregulacion 
            LEFT JOIN cumplimiento_articulo ca ON ca.idregulacionempresa=re.idregulacionempresa AND ca.idarticulo=ra.idarticulo
                WHERE re.idempresa=? AND re.idregulacion=?  AND ca.idcumplimientoempresa IS null)',[$emp,$regu]);
        
        $Cumplimiento =Db::select('SELECT rs.idseccion,rs.noseccion, rs.tituloseccion,rs.descripcionseccion,rs.estadoseccion,ra.idarticulo,re.idregulacionempresa,
        ra.numeroarticulo,ra.ordenarticulo,ra.tituloarticulo,ra.descripcionarticulo,ra.fechainiciovigencia,ra.fechafinvigencia,ra.estadoarticulo, 
        ISNULL(ca.estadocumplimiento,0) estadocumplimiento, ca.observacionescumplimiento,ca.fechacumplimiento, ISNULL(ce.evidencias,0) evidencias,ISNULL(cec.Sanciones,0) sanciones,
		rs1.idsancion,rs1.descripcionsancion,ca.idcumplimientoempresa,ca.nivelmadurez,
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


        $ArticulosNivel =Db::select("select a.nivelmadurez,a.NombreNivel, isnull(CantidadArticulos,0) CantidadArticulos  from 
        (
        select 0 nivelmadurez, '0 - Incompleto' NombreNivel union  
        select 1 nivelmadurez, '1 - Realizado'  union
        select 2 nivelmadurez, '2 - Gestionado'  union
        select 3 nivelmadurez, '3 - Establecido'  union
        select 4 nivelmadurez, '4 - Predecible'  union
        select 5 nivelmadurez, '5 - Optimizado'  
        ) a left join 
        (
       select d.nivelmadurez NivelMadurez,count(d.idcumplimientoempresa)  CantidadArticulos from regulacion_empresa  a
        inner join regulacion_articulo  b on b.idregulacion=a.idregulacion
        left JOIN cumplimiento_articulo d on d.idregulacionempresa=a.idregulacionempresa  and d.idarticulo=b.idarticulo
       where a.idempresa=? and a.idregulacion=?
       group by d.nivelmadurez
       ) b 
       on a.nivelmadurez=b.NivelMadurez 
       order by nivelmadurez ", [$emp,$regu]);

       $ArticulosEstadoCumplimiento =Db::select("select a.EstadoCumplimiento,a.DescripcionEstadoCumplimiento, isnull(CantidadArticulos,0) CantidadArticulos  from 
       (
       select 0 EstadoCumplimiento, 'No Cumple' DescripcionEstadoCumplimiento union  
       select 1 EstadoCumplimiento, 'Cumple'  union
       select 2 EstadoCumplimiento, 'En Proceso'  union
       select 3 EstadoCumplimiento, 'No Aplica'   
       ) a left join 
       (
      select isnull(d.estadocumplimiento,0) EstadoCumplimiento,count(d.idcumplimientoempresa)  CantidadArticulos from regulacion_empresa  a
       inner join regulacion_articulo  b on b.idregulacion=a.idregulacion
       left JOIN cumplimiento_articulo d on d.idregulacionempresa=a.idregulacionempresa  and d.idarticulo=b.idarticulo
      where a.idempresa=? and a.idregulacion=?
      group by isnull(d.estadocumplimiento,0)
      ) b  on a.EstadoCumplimiento=b.EstadoCumplimiento ", [$emp,$regu]);


      $PromedioNMadurez =Db::select("select   ISNULL(avg(d.nivelmadurez),0) NivelMadurez from regulacion_empresa  a
      inner join regulacion_articulo  b on b.idregulacion=a.idregulacion
      left JOIN cumplimiento_articulo d on d.idregulacionempresa=a.idregulacionempresa  and d.idarticulo=b.idarticulo
     where a.idempresa=? and a.idregulacion=? ", [$emp,$regu]);

     $CantidadArticulos =Db::select("select  idregulacion, COUNT(idarticulo)  CantidadArticulos from 
     regulacion_articulo  a   where a.idregulacion=? group by idregulacion
     ", [$regu]);

     
     $ArticulosVigentes =Db::select("select a.estadoarticulo,a.DescripcionEstado, isnull(CantidadArticulos,0) CantidadArticulos  from 
     (
     select 0 estadoarticulo, 'Inactivos' DescripcionEstado union  
     select 1 estadoarticulo, 'Vigentes'  
    
     ) a left join 
     (
    select idregulacion, estadoarticulo, count(idarticulo) CantidadArticulos  from 
     regulacion_articulo  a   where a.idregulacion=2 
     GROUP by idregulacion,estadoarticulo) b on a.estadoarticulo=b.estadoarticulo
     ", [$regu]);

        DB::commit();

            return view('Informe.informe')->with(
                [
                'Cumplimiento'=> $Cumplimiento,
                'Regulacion'=>$Regulacion,
                'Empresa'=>$Empresa,
                'Evidencias'=>$Evidencias,
                'ArticulosNivel'=>$ArticulosNivel,
                'ArticulosEstadoCumplimiento'=>$ArticulosEstadoCumplimiento,
                'PromedioNMadurez'=>$PromedioNMadurez,
                'CantidadArticulos'=>$CantidadArticulos,
                'ArticulosVigentes'=>$ArticulosVigentes
                ]);

        
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }

}
