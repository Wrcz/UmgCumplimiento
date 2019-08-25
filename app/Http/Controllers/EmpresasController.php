<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;

class EmpresasController extends Controller
{
    public function inicio(){
        return view('Empresas.empresas');
      }

      //Metodo para obtener empresaas
      public function empresas(){
        try {
        $Empresas =App\empresas::all()->sortBy('nombreempresa');
        return view ('Empresas.empresas',compact('Empresas'));

      } catch (\Illuminate\Database\QueryException $e)  {
        report($e);
        return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');

      } catch (PDOException $e) {
        return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
      }
      }

      //Metodo para Agregar empresas
      public function agregar(Request $request){
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
    
      } catch (\Illuminate\Database\QueryException $e)  {
        return back()->with('mensajeerror', 'Ocurrio un error agregar la empresa.');

      } catch (PDOException $e) {
        return back()->with('mensajeerror', 'Ocurrio un error agregar la empresa.');

      } catch (Exception $e) {
        return back()->with('mensajeerror', 'Ocurrio un error agregar la empresa.');
      }
      
      }

      //Metodo para Eliminar empresas
      public function eliminar($idempresa){
      try {

        $Empresa = App\empresas::where('idempresa',$idempresa)->delete();
        return back()->with('mensaje', 'Empresa Eliminada.');
      
      } catch (\Illuminate\Database\QueryException $e)  {
        report($e);
        return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');

      } catch (PDOException $e) {
        return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
      }
        
      }

      //Metodo para Consultar Empresas
      public function consultar($id){
        try {

          $Empresa = App\empresas::findOrFail($id);
        
        return view('Empresas.consultar',compact('Empresa'));

      } catch (\Illuminate\Database\QueryException $e)  {
        report($e);
        return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');

      } catch (PDOException $e) {
        return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
      }

      }
      
      //Metodo Para Actualizar Empresas
      public function actualizar(Request $request, $id){
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

        if ($request->estadoempresa=="Activa")
         $Chk_estadoempresa=true;
        else
          $Chk_estadoempresa=false;

        $Empresa = App\empresas::findOrFail($id);
        $Empresa->nombreempresa=$request->nombreempresa;
        $Empresa->tipoindustria=$request->tipoindustria;
        $Empresa->correoelectronico=$request->correoelectronico;
        $Empresa->pais=$request->pais;
        $Empresa->direccion=$request->direccion;
        $Empresa->estadoempresa=$Chk_estadoempresa;
        $Empresa->save();

        
        return back()->with('mensaje', 'Empresa actualizada.');

      } catch (\Illuminate\Database\QueryException $e)  {
        report($e);
        return back()->with('mensajeerror', 'Ocurrio un error al guardar los cambios.');

      } catch (PDOException $e) {
        return back()->with('mensajeerror', 'currio un error al guardar los cambios.');
      }
      }

}
