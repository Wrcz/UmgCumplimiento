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

}
