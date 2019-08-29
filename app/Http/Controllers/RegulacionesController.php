<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;

class RegulacionesController extends Controller
{
    //Metodo de inicio
    public function inicio()
    {
        return view('Regulaciones.regulaciones');
    }
  
    //Metodo para obtener Regulaciones
    public function regulaciones()
    {
        try {
            $Regulaciones =DB::table('regulacion')->get();
       
            return view('Regulaciones.regulaciones', compact('Regulaciones'));
        } catch (\Illuminate\Database\QueryException $e) {
            // dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            //dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }
  
    //Metodo para Agregar Regulaciones
    public function agregar(Request $request)
    {
        try {
            $request->validate([
          'identificacion'=>'required',
          'nombreregulacion'=>'required',
          'descripcionregulacion'=>'required',
          'pais' => 'required'
          ]);
  
            $Regulacion = Db::table('regulacion')->insert([
               'identificacion'=> $request->identificacion,
                'nombreregulacion' => $request->nombreregulacion,
                'descripcionregulacion' => $request->descripcionregulacion,
                'pais'=>$request->pais,
                'fechainiciovigencia'=>$request->fechainicio,
                'fechafinvigencia'=>$request->fechafin,
                'estadoregulacion'=>true
                ]);
     
              
            return back()->with('mensaje', 'Regulacion Agregada correctamente!');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la regulacion.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la regulacion.');
        } catch (Exception $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la regulacion.');
        }
    }
  
    //Metodo para Eliminar Regulaciones
    public function eliminar($idregulacion)
    {
        try {
            $Regulacion = Db::table('regulacion')->where('idregulacion', $idregulacion)->delete();
            return back()->with('mensaje', 'Regulacion Eliminada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }
  
    //Metodo para Consultar Regulaciones
    public function consultar($idregulacion)
    {
        try {
            $Regulaciones = App\regulacion::findOrFail($idregulacion);
            $Secciones = DB::select('SELECT * FROM regulacion_seccion rs WHERE rs.idregulacion=?', [$idregulacion]);
            $Articulos =Db::select('SELECT ra.idarticulo,ra.numeroarticulo,ra.ordenarticulo,ra.descripcionarticulo, ra.tituloarticulo,ra.estadoarticulo,ra.fechainiciovigencia,
                                    ra.fechafinvigencia, ra.idseccion,rs.noseccion,rs.tituloseccion FROM regulacion_articulo ra INNER JOIN 
                                    regulacion_seccion rs ON ra.idseccion=rs.idseccion AND 
                                    ra.idregulacion=rs.idregulacion WHERE rs.idregulacion=? order by rs.noseccion,ra.ordenarticulo', [$idregulacion]);
      
            return view('Regulaciones.consultar', compact('Regulaciones', 'Secciones', 'Articulos'));
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al consultar los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al consultar los datos.');
        }
    }
        
    //Metodo Para Actualizar Regulaciones
    public function actualizar(Request $request, $idregulacion)
    {
        try {
            $request->validate([
                      'identificacion'=>'required',
                      'nombreregulacion'=>'required',
                      'descripcionregulacion'=>'required',
                      'pais'=>'required',
                      'estadoregulacion' => 'required'
                      ]);
           
            $Usuario = App\regulacion::findOrFail($idregulacion);
            $Usuario->identificacion=$request->identificacion;
            $Usuario->nombreregulacion=$request->nombreregulacion;
            $Usuario->descripcionregulacion=$request->descripcionregulacion;
            $Usuario->pais=$request->pais;
            $Usuario->fechainiciovigencia=$request->fechainicio;
            $Usuario->fechafinvigencia=$request->fechafin;
            $Usuario->estadoregulacion=$request->estadoregulacion;
            $Usuario->save();
  
          
            return back()->with('mensaje', 'Regulación actualizada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al guardar los cambios.'. $e);
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'currio un error al guardar los cambios.');
        }
    }
     
    //Metodo para Eliminar Regulaciones
    public function eliminarseccion($idseccion)
    {
        try {
            $Seccion = Db::table('regulacion_seccion')->where('idseccion', $idseccion)->delete();
            return back()->with('mensaje', 'Seccion Eliminada.');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }

    public function actualizarseccion(Request $request, $idseccion)
    {
        try {
            $request->validate([
                      'noseccion'=>'required',
                      'tituloseccion'=>'required',
                      'descripcionseccion'=>'required'
                      ]);
            
                    

            $Seccion = DB::table('regulacion_seccion')->where('idseccion', $idseccion)->update(['noseccion' => $request->noseccion,'tituloseccion'=>$request->tituloseccion,'descripcionseccion'=>$request->descripcionseccion,'estadoseccion'=>$request->estadoseccion]);
                  
            return back()->with('mensaje', 'Secciòn actualizada.');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al guardar los cambios.'. $e);
        } catch (PDOException $e) {
            dd($e);
            return back()->with('mensajeerror', 'currio un error al guardar los cambios.');
        }
    }

    //Metodo para Agregar Regulaciones
    public function agregarseccion(Request $request, $idregulacion)
    {
        try {
            $request->validate([
            'noseccion'=>'required',
            'tituloseccion'=>'required',
            'descripcionseccion'=>'required'
            ]);
    
            $Regulacion = Db::table('regulacion_seccion')->insert([
                'idregulacion'=> $idregulacion,
                 'noseccion'=> $request->noseccion,
                  'tituloseccion' => $request->tituloseccion,
                  'descripcionseccion' => $request->descripcionseccion,
                  'estadoseccion'=>true
                  ]);
       
                
            return back()->with('mensaje', 'Seccion Agregada correctamente!');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la seccion.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la seccion.');
        } catch (Exception $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la seccion.');
        }
    }
    
    //Metodo para Agregar Articulos
    public function agregararticulo(Request $request, $idregulacion)
    {
        try {
            $request->validate([
             'idseccion'=>'required',
             'numeroarticulo'=>'required',
             'ordenarticulo'=>'required',
             'tituloarticulo'=>'required',
             'descripcionarticulo'=>'required'
             ]);
     
            $Articulos = Db::table('regulacion_articulo')->insert([
                 'idregulacion'=> $idregulacion,
                 'idseccion'=> $request->idseccion,
                 'numeroarticulo'=> $request->numeroarticulo,
                  'ordenarticulo'=> $request->ordenarticulo,
                   'tituloarticulo' => $request->tituloarticulo,
                   'descripcionarticulo' => $request->descripcionarticulo,
                   'fechainiciovigencia' => $request->fechainiciovigencia,
                   'fechafinvigencia' => $request->fechafinvigencia,
                   'estadoarticulo'=>true
                   ]);
        
                 
            return back()->with('mensaje', 'Articulo Agregado correctamente!');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            return back()->with('mensajeerror', 'Ocurrio un error al agregar el articulo.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la seccion.');
        } catch (Exception $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al agregar la seccion.');
        }
    }

     //Metodo Para Actualizar Regulaciones
     public function actualizararticulo(Request $request, $idarticulo)
     {
         try {
             
             $request->validate([
                       'numeroarticulo'=>'required',
                       'tituloarticulo'=>'required',
                       'idseccion'=>'required',
                       'ordenarticulo'=>'required',
                       'estadoarticulo' => 'required',
                       'descripcionarticulo' => 'required'
                       ]);
            
             $Articulo = DB::table('regulacion_articulo')->where('idarticulo', $idarticulo)
             ->update([
             'numeroarticulo' => $request->numeroarticulo,
             'idseccion'=>$request->idseccion,
             'ordenarticulo'=>$request->ordenarticulo,
             'tituloarticulo'=>$request->tituloarticulo,
             'descripcionarticulo'=>$request->descripcionarticulo,
             'fechainiciovigencia'=>$request->fechainicio,
             'fechafinvigencia'=>$request->fechafin,
             'estadoarticulo'=>$request->estadoarticulo
             ]);
           
             return back()->with('mensaje', 'Artículo actualizado.');
         } catch (\Illuminate\Database\QueryException $e) {
             dd($e);
             return back()->with('mensajeerror', 'Ocurrio un error al guardar los cambios.'. $e);
         } catch (PDOException $e) {
             return back()->with('mensajeerror', 'currio un error al guardar los cambios.');
         }
     }

      //Metodo para Eliminar articulos
    public function eliminararticulo($idarticulos)
    {
        try {
            $Articulo = Db::table('regulacion_articulo')->where('idarticulo', $idarticulos)->delete();
            
            return back()->with('mensaje', 'Articulo Eliminada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }
  
}
