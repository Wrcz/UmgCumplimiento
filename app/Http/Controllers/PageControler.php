<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageControler extends Controller
{
    public function inicio(){
      return view('welcome');
    }

    public function Prueba($nombre = null){
      $Alumnos = ['william','Michael','Jose'];
      //return view('Prueba',['Alumnos'=>$Alumnos,'nombre'=>$nombre]);
      return view('Prueba',compact('Alumnos','nombre'));
        }

}
