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
      $Alumnos = App\Usuario::paginate(3);
      //$Alumnos = ['william','Michael','Jose'];
      //return view('Prueba',['Alumnos'=>$Alumnos,'nombre'=>$nombre]);
      return view('Prueba',compact('Alumnos'));
        }

      public function detalle($id){
          $Alumno = App\Usuario::findOrFail($id);
          return view('Usuario.detalle',compact('Alumno'));
        }

        public function crear(Request $request){
          $request->validate([
          'NombreUsuario'=>'required',
          'Password'=>'required',
          'NivelUsuario'=>'required']);

            $Alumno = new App\Usuario;
            $Alumno->NombreUsuario=$request->NombreUsuario;
            $Alumno->Password=$request->Password;
            $Alumno->NivelUsuario=$request->NivelUsuario;
            $Alumno->save();
            return back()->with('mensaje', 'Usuario Agregado!');
          //  return $request->all();
          }

          public function editar($id){
              $Alumno = App\Usuario::findOrFail($id);

              return view('Usuario.editar',compact('Alumno'));
            }

            public function update(Request $request, $id){
                $Alumno = App\Usuario::findOrFail($id);
                $Alumno->NombreUsuario=$request->NombreUsuario;
                $Alumno->Password=$request->Password;
                $Alumno->NivelUsuario=$request->NivelUsuario;
                $Alumno->save();
                return back()->with('mensaje', 'Usuario actualizado.');
              }

              public function eliminar($id){
                  $Alumno = App\Usuario::findOrFail($id);
                    $Alumno->delete();

                  return back()->with('mensaje', 'Usuario eliminado.');
                }

}
