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

//Route::get('/', 'PageControler@inicio');

Route::get('/', function () {
         return view('bienvenido');
    
})->name('bienvenido');


//Rutas para Empresas
Route::get('/empresas', 'EmpresasController@empresas')->name('Empresas.empresas');

Route::delete('/empresas/eliminar/{id}','EmpresasController@eliminar')->name('Empresas.eliminar');

Route::post('/empresas/agregar/','EmpresasController@agregar')->name('Empresas.agregar');

Route::get('/empresas/consultar/{id}','EmpresasController@consultar')->name('Empresas.consultar');

Route::put('/empresas/consultar/{id}','EmpresasController@actualizar')->name('Empresas.actualizar');
//fin Rutas para Empresas

Route::get('/Prueba/{nombre?}','PageControler@Prueba')->name('Prueba');

Route::get('/detalle/{id}','PageControler@detalle')->name('Usuario.detalle');

Route::get('/editar/{id}','PageControler@editar')->name('Usuario.editar');

Route::put('/editar/{id}','PageControler@update')->name('Usuario.update');

Route::DELETE('/eliminar/{id}','PageControler@eliminar')->name('Usuario.eliminar');

Route::post('/crear/','PageControler@crear')->name('Usuario.crear');

//Auth::routes();

//Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
