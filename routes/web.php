<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::view('Prueba','Prueba',['numero'=>777]);

Route::get('Prueba/{nombre?}', function ($nombre = null) {

  $Alumnos = ['william','Michael','Jose'];

  //return view('Prueba',['Alumnos'=>$Alumnos,'nombre'=>$nombre]);
  return view('Prueba',compact('Alumnos','nombre'));
})->name('Prueba');
