<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;

class UsuariosController extends Controller
{
    //Metodo de inicio
    public function inicio()
    {
        return view('Usuarios.usuarios');
    }

    //Metodo para obtener empresaas
    public function usuarios()
    {
        try {
            $Usuarios =Db::table('usuarios')
            ->join('usuarios_nivel', 'usuarios.idnivelusuario', '=', 'usuarios_nivel.idnivelusuario')
            ->select('usuarios.idusuario', 'usuarios_nivel.nombrenivelusuario', 'usuarios.nombreusuario', 'usuarios.correoelectronico', 'usuarios.estadousuario')
            ->get();

            $Niveles =Db::table('usuarios_nivel')->orderby('idnivelusuario')->get();

            return view('Usuarios.usuarios', compact('Usuarios', 'Niveles'));
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
        }
    }

    //Metodo para Agregar empresas
    public function agregar(Request $request)
    {
        try {
            $request->validate([
        'nivelusuario'=>'required',
        'nombreusuario'=>'required',
        'correoelectronico'=>'required',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6'
        ]);

    
            $Usuario = new App\usuarios;
            $Usuario->idnivelusuario=$request->nivelusuario;
            $Usuario->nombreusuario=$request->nombreusuario;
            $Usuario->correoelectronico=$request->correoelectronico;
            $Usuario->password=bcrypt($request->password);
            $Usuario->estadousuario=true;
            $Usuario->save();
      
            return back()->with('mensaje', 'Usuario Agregado correctamente!');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error agregar usuario.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error agregar usuario.');
        } catch (Exception $e) {
            return back()->with('mensajeerror', 'Ocurrio un error agregar usuario.');
        }
    }

    //Metodo para Eliminar empresas
    public function eliminar($idusuario)
    {
        try {
            $Usuario = App\usuarios::where('idusuario', $idusuario)->delete();
            return back()->with('mensaje', 'Usuario Eliminada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }

    //Metodo para Consultar Empresas
    public function consultar($id)
    {
        try {
            $Usuario = App\usuarios::findOrFail($id);
            $Empresas = DB::select('SELECT e.idempresa,e.nombreempresa,e.estadoempresa, CASE WHEN  ue.idusuario IS NULL THEN 0 ELSE 1 END asignada FROM empresas e LEFT JOIN usuarios_empresas ue  ON e.idempresa=ue.idempresa AND ue.idusuario=?', [$id]);
            $Niveles =Db::table('usuarios_nivel')->orderby('idnivelusuario')->get();
          
            return view('Usuarios.consultar', compact('Usuario','Empresas','Niveles'));
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }
      
    //Metodo Para Actualizar Empresas
    public function actualizar(Request $request, $id)
    {
        try {
           
            $request->validate([
          'nombreusuario'=>'required',
          'nivelusuario'=>'required',
          'correoelectronico'=>'required',
          'estadousuario'=>'required',
          'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
          'password_confirmation' => 'min:6'
          ]);

            
            $Usuario = App\usuarios::findOrFail($id);
            $Usuario->nombreusuario=$request->nombreusuario;
            $Usuario->idnivelusuario=$request->nivelusuario;
            $Usuario->correoelectronico=$request->correoelectronico;
            $Usuario->password=bcrypt($request->password);
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


      
    //Metodo para Consultar Empresas
    public function actualizarregulacion(Request $request, $id, $regula)
    {
        try {
            $estadoregulacion = false;
          

            if ($request->accion=="asociar") {
                $estadoregulacion = true;
            } else {
                $estadoregulacion = false;
            }

             
            $Existe = DB::table('regulacion_empresa')->where([['idempresa','=',$id],['idregulacion','=',$regula]])->count();
          
           
            if ($Existe>=1) {
                $Actualiza = DB::table('regulacion_empresa')->where([['idempresa','=', $id],['idregulacion','=', $regula]])->update(['estadoregulacionempresa'=>$estadoregulacion]);
            } else {
                $Inserta = DB::table('regulacion_empresa')->insert(['idempresa' => $id,'idregulacion'=> $regula,'estadoregulacionempresa'=>$estadoregulacion]);
            }
          

            return back()->with('mensaje', 'Regulaciòn Asociada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al asociar la regulaciòn.' . $e);
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al asociar la regulaciòn');
        }
    }
}
