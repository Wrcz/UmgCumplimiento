<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;

class PageControler extends Controller
{
    public function inicio(){
      return view('welcome');
    }

    public function Prueba(){
      $Alumnos = App\Usuario::all();
      //$Alumnos = ['william','Michael','Jose'];
      //return view('Prueba',['Alumnos'=>$Alumnos,'nombre'=>$nombre]);
      return view('Prueba',compact('Alumnos'));
        }

      public function detalle($id){
          $Alumno = App\Usuario::findOrFail($id);
          return view('Usuario.detalle',compact('Alumno'));
        }

        public function crear(Request $request){
            $Alumno = new App\Usuario;
            $Alumno->NombreUsuario=$request->NombreUsuario;
            $Alumno->Password=$request->Password;
            $Alumno->NivelUsuario=$request->NivelUsuario;
            $Alumno->save();


            return back()->with('mensaje', 'Usuario Agregado!');
          //  return $request->all();
          }

}
