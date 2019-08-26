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
  
    //Metodo para obtener usuarios
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
  
    //Metodo para Agregar usuarios
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
  
    //Metodo para Eliminar usuarios
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
  
    //Metodo para Consultar usuarios
    public function consultar($id)
    {
        try {
            $Usuario = App\usuarios::findOrFail($id);
            $Empresas = DB::select('SELECT e.idempresa,e.nombreempresa,e.estadoempresa, CASE WHEN  ue.idusuario IS NULL THEN 0 ELSE 1 END asignada FROM empresas e LEFT JOIN usuarios_empresas ue  ON e.idempresa=ue.idempresa AND ue.idusuario=?', [$id]);
            $Niveles =Db::table('usuarios_nivel')->orderby('idnivelusuario')->get();
            
            return view('Usuarios.consultar', compact('Usuario', 'Empresas', 'Niveles'));
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }
        
    //Metodo Para Actualizar usuarios
    public function actualizar(Request $request, $id)
    {
        try {
            $cambiarpass =false;
              
            if ($request->exists('cambiarpass')) {
                $cambiarpass=true;
            }
           
            if ($cambiarpass) {
                $request->validate([
                      'nombreusuario'=>'required',
                      'nivelusuario'=>'required',
                      'estadousuario'=>'required',
                      'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                      'password_confirmation' => 'min:6'
                      ]);
            } else {
                $request->validate([
                      'nombreusuario'=>'required',
                      'nivelusuario'=>'required',
                      'estadousuario'=>'required'
                      ]);
            }
             
             
            $Usuario = App\usuarios::findOrFail($id);
            $Usuario->nombreusuario=$request->nombreusuario;
            $Usuario->idnivelusuario=$request->nivelusuario;
            if ($cambiarpass) {
                $Usuario->password=bcrypt($request->password);
            }
            $Usuario->estadousuario=$request->estadousuario;
            $Usuario->save();
  
          
            return back()->with('mensaje', 'Usuario actualizado.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al guardar los cambios.'. $e);
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'currio un error al guardar los cambios.');
        }
    }
     
    //Metodo para actualizar Usuarios/Empresas
    public function actualizarempresas(Request $request, $id, $empresa)
    {
        try {
            $estadoasociacion = false;
            
            if ($request->accion=="asociar") {
                $estadoasociacion = true;
            } else {
                $estadoasociacion = false;
            }
          
            if ($estadoasociacion) {
                $Actualiza = App\usuarios_empresas::updateOrCreate(['idusuario'=>$id,'idempresa'=>$empresa], ['idusuario'=>$id,'idempresa'=>$empresa]);
            } else {
                $Elimina = App\usuarios_empresas::where(['idusuario'=>$id,'idempresa'=>$empresa])->delete();
            }
  
  
            return back()->with('mensaje', 'Se guardaron los cambios correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al asociar la empresa.' . $e);
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al asociar la empresa');
        }
    }
}
