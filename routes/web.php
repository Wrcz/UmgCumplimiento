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

Route::delete('/empresas/eliminar/{id}', 'EmpresasController@eliminar')->name('Empresas.eliminar');

Route::post('/empresas/agregar/', 'EmpresasController@agregar')->name('Empresas.agregar');

Route::get('/empresas/consultar/{id}/{regulaciones}', 'EmpresasController@consultar')->name('Empresas.consultar');

Route::put('/empresas/consultar/{id}', 'EmpresasController@actualizar')->name('Empresas.actualizar');

Route::put('/empresas/regulacion/{id}/{reg}', 'EmpresasController@actualizarregulacion')->name('Empresas.actualizarregulacion');
//fin Rutas para Empresas

//Rutas para usuarios
Route::get('/usuarios', 'UsuariosController@usuarios')->name('Usuarios.usuarios');

Route::post('/usuarios/agregar/', 'UsuariosController@agregar')->name('Usuarios.agregar');

Route::delete('/usuarios/eliminar/{id}', 'UsuariosController@eliminar')->name('Usuarios.eliminar');

Route::get('/usuarios/consultar/{id}', 'UsuariosController@consultar')->name('Usuarios.consultar');

Route::put('/usuarios/consultar/{id}', 'UsuariosController@actualizar')->name('Usuarios.actualizar');

Route::put('/usuarios/empresas/{id}/{emp}', 'UsuariosController@actualizarempresas')->name('Usuarios.actualizarempresas');
//fin Rutas para usuarios

//Rutas para regulaciones
Route::get('/regulaciones', 'RegulacionesController@regulaciones')->name('Regulaciones.regulaciones');

Route::post('/regulaciones/agregar', 'RegulacionesController@agregar')->name('Regulaciones.agregar');

Route::delete('/regulaciones/eliminar/{id}', 'RegulacionesController@eliminar')->name('Regulaciones.eliminar');

Route::get('/regulaciones/consultar/{id}', 'RegulacionesController@consultar')->name('Regulaciones.consultar');

Route::put('/regulaciones/consultar/{id}', 'RegulacionesController@actualizar')->name('Regulaciones.actualizar');

Route::delete('/seccion/eliminar/{id}', 'RegulacionesController@eliminarseccion')->name('Regulaciones.eliminarseccion');

Route::put('/seccion/consultar/{id}', 'RegulacionesController@actualizarseccion')->name('Regulaciones.actualizarseccion');

Route::post('/seccion/agregar/{id}', 'RegulacionesController@agregarseccion')->name('Regulaciones.agregarseccion');

Route::post('/articulos/agregar/{id}', 'RegulacionesController@agregararticulo')->name('Regulaciones.agregararticulo');

Route::put('/articulos/actualizar/{id}', 'RegulacionesController@actualizararticulo')->name('Regulaciones.actualizararticulo');

Route::delete('/articulos/eliminar/{id}', 'RegulacionesController@eliminararticulo')->name('Regulaciones.eliminararticulo');

Route::get('/sanciones/consultar/{id}/{reg}', 'SancionesController@sancion')->name('Regulaciones.sancion');

Route::delete('/sanciones/consultar/{id}', 'SancionesController@eliminarsancion')->name('Regulaciones.eliminarsancion');

Route::put('/sanciones/consultar/{id}', 'SancionesController@actualizarsancion')->name('Regulaciones.actualizarsancion');

Route::post('/sanciones/agregar/{id}', 'SancionesController@agregarsancion')->name('Regulaciones.agregarsancion');
//fin Rutas para regulaciones

Route::get('/Prueba/{nombre?}', 'PageControler@Prueba')->name('Prueba');

Route::get('/detalle/{id}', 'PageControler@detalle')->name('Usuario.detalle');

Route::get('/editar/{id}', 'PageControler@editar')->name('Usuario.editar');

Route::put('/editar/{id}', 'PageControler@update')->name('Usuario.update');

Route::DELETE('/eliminar/{id}', 'PageControler@eliminar')->name('Usuario.eliminar');

Route::post('/crear/', 'PageControler@crear')->name('Usuario.crear');

//Auth::routes();

//Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
