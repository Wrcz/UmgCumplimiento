<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;

class SancionesController extends Controller
{
    //

    //Metodo de inicio
    public function inicio()
    {
        return view('Regulaciones.sanciones');
    }
      
    //Metodo para obtener Sancion
    public function sancion($idarticulo,$idregulacion)
    {
        try {
            $Sanciones =Db::table('regulacion_sancion')
            ->join('regulacion_articulo','regulacion_articulo.idarticulo','=','regulacion_sancion.idarticulo')
            ->where('regulacion_sancion.idarticulo', '=', $idarticulo)
            ->select('regulacion_sancion.*','regulacion_articulo.numeroarticulo','regulacion_articulo.tituloarticulo')->get();

            $Articulos =App\articulo::findOrFail($idarticulo);
        
           // dd($Articulos);
            return view('Regulaciones.sancion', compact('Sanciones','idregulacion','Articulos'));

        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (Exception $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }
      
    //Metodo para Agregar Sancion
    public function agregarsancion(Request $request,$idarticulo)
    {
        try {

           
            $request->validate([
                'descripcionsancion'=>'required'
                ]);
      
            $Regulacion = Db::table('regulacion_sancion')->insert([
                    'descripcionsancion' => $request->descripcionsancion,
                    'idarticulo' => $idarticulo,
                    'estadosancion'=>true
                    ]);
         
                  
            return back()->with('mensaje', 'Sancion Agregada correctamente!');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($ex);
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la regulacion.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la regulacion.');
        } catch (Exception $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la regulacion.');
        }
    }
      
    //Metodo para Eliminar Sancion
    public function eliminarsancion($idsancion)
    {
        try {
            $Sancion = Db::table('regulacion_sancion')->where('idsancion', $idsancion)->delete();
            return back()->with('mensaje', 'Sancion Eliminada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }

    //Metodo Para Actualizar Sancion
    public function actualizarsancion(Request $request, $idsancion)
    {
        try {
            $request->validate([
                      'descripcionsancion'=>'required',
                      'estadosancion'=>'required'   
                      ]);
           
            $Sancion = App\sancion::findOrFail($idsancion);
            //dd($Sancion);
            $Sancion->descripcionsancion=$request->descripcionsancion;
            $Sancion->estadosancion=$request->estadosancion;
            $Sancion->save();
  
          
            return back()->with('mensaje', 'Sancion actualizada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al guardar los cambios.'. $e);
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'currio un error al guardar los cambios.');
        }
    }
}
