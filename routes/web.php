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

//Route::get('/', 'PageControler@inicio')->name('bienvenido');



//usuarios
// Authentication Routes...
route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
route::post('login', 'Auth\LoginController@login');
route::get('logout', 'Auth\LoginController@logout')->name('logout');


//Ruta de Home
Route::get('/bienvenido/', 'PageControler@inicio')->name('bienvenido');


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


//Gestion de Cumplimiento
Route::get('/cumplimiento/', 'CumplimientoController@cumplimiento')->name('Cumplimiento.cumplimiento');

Route::post('/cumplimiento/fetch', 'CumplimientoController@cumplimientofetch')->name('Cumplimiento.cumplimientofetch');

Route::get('/cumplimiento/regulacion/{id}/{regu}', 'CumplimientoController@cumplimientoregulacion')->name('Cumplimiento.cumplimientoregulacion');

Route::delete('/evidencia/eliminar/{id}', 'EvidenciaController@eliminar')->name('Evidencia.eliminar');

Route::post('/evidencia/agregar', 'EvidenciaController@agregar')->name('Evidencia.agregar');

Route::post('/cumplimiento/actualizar/{id}/{reg}/{art}', 'CumplimientoController@actualizarcumplimiento')->name('Cumplimiento.actualizarcumplimiento');


Route::get('/seguimiento/', 'InformeController@informeparametros')->name('Informe.parametroinforme');

Route::get('/seguimiento/regulacion/{id}/{regu}', 'InformeController@informeregulacion')->name('Informe.informe');
