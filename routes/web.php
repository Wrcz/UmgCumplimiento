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

Route::get('/', 'PageControler@inicio');
//Route::view('Prueba','Prueba',['numero'=>777]);
Route::get('/Prueba/{nombre?}','PageControler@Prueba')->name('Prueba');

Route::get('/detalle/{id}','PageControler@detalle')->name('Usuario.detalle');

Route::get('/editar/{id}','PageControler@editar')->name('Usuario.editar');

Route::put('/editar/{id}','PageControler@update')->name('Usuario.update');

Route::DELETE('/eliminar/{id}','PageControler@eliminar')->name('Usuario.eliminar');

Route::post('/crear/','PageControler@crear')->name('Usuario.crear');
//Auth::routes();

//Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
