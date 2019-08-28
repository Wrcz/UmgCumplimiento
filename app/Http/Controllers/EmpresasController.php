<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;

class EmpresasController extends Controller
{
    public function inicio()
    {
        return view('Empresas.empresas');
    }

    //Metodo para obtener empresaas
    public function empresas()
    {
        try {
            $Empresas =App\empresas::all()->sortBy('nombreempresa');

            return view('Empresas.empresas', compact('Empresas'));
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
        'nombreempresa'=>'required',
        'tipoindustria'=>'required',
        'correoelectronico'=>'required',
        'pais'=>'required',
        'direccion'=>'required'
        ]);

            $Empresa = new App\empresas;
            $Empresa->nombreempresa=$request->nombreempresa;
            $Empresa->tipoindustria=$request->tipoindustria;
            $Empresa->correoelectronico=$request->correoelectronico;
            $Empresa->pais=$request->pais;
            $Empresa->direccion=$request->direccion;
            $Empresa->estadoempresa=true;
            $Empresa->save();

            return back()->with('mensaje', 'Empresa Agregada correctamente!');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error agregar la empresa.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error agregar la empresa.');
        } catch (Exception $e) {
            return back()->with('mensajeerror', 'Ocurrio un error agregar la empresa.');
        }
    }

    //Metodo para Eliminar empresas
    public function eliminar($idempresa)
    {
        try {
            $Empresa = App\empresas::where('idempresa', $idempresa)->delete();
            return back()->with('mensaje', 'Empresa Eliminada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
        }
    }

    //Metodo para Consultar Empresas
    public function consultar($id, $regula)
    {
        try {
            $Empresa = App\empresas::findOrFail($id);
            $Regulaciones = DB::select('SELECT r.idregulacion,r.identificacion,r.nombreregulacion,r.pais,r.estadoregulacion,isnull(re.estadoregulacionempresa,0)  asignada,ISNULL(re.idregulacionempresa,0)  idregulacionempresa FROM regulacion r left JOIN regulacion_empresa re ON r.idregulacion=re.idregulacion AND re.idempresa=?', [$id]);
        
          
            return view('Empresas.consultar', compact('Empresa'), compact('Regulaciones'));
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al consultar los datos.');
        } catch (PDOException $e) {
            return back()->with('mensajeerror', 'Ocurrio un error al consultar los datos.');
        }
    }
      
    //Metodo Para Actualizar Empresas
    public function actualizar(Request $request, $id)
    {
        try {
            $request->validate([
          'nombreempresa'=>'required',
          'tipoindustria'=>'required',
          'correoelectronico'=>'required',
          'pais'=>'required',
          'direccion'=>'required',
          'estadoempresa'=>'required',
          ]);

            $Chk_estadoempresa =false;

            if ($request->estadoempresa=="Activa") {
                $Chk_estadoempresa=true;
            } else {
                $Chk_estadoempresa=false;
            }

            $Empresa = App\empresas::findOrFail($id);
            $Empresa->nombreempresa=$request->nombreempresa;
            $Empresa->tipoindustria=$request->tipoindustria;
            $Empresa->correoelectronico=$request->correoelectronico;
            $Empresa->pais=$request->pais;
            $Empresa->direccion=$request->direccion;
            $Empresa->estadoempresa=$Chk_estadoempresa;
            $Empresa->save();

        
            return back()->with('mensaje', 'Empresa actualizada.');
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return back()->with('mensajeerror', 'Ocurrio un error al guardar los cambios.');
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
