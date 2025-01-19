<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuario/list','Admin\UsuarioController@list');
Route::get('/solicitante/list','Admin\SolicitanteController@list');
Route::get('/contacto/list','Admin\ContactoController@list');
Route::get('/contacto/{contacto}/get','Admin\ContactoController@get');
Route::post('/cotizacion/store', 'Admin\CotizacionController@store');
Route::get('/cotizacion/list', 'Admin\CotizacionController@list');
Route::get('/cotizacion/create', 'Admin\CotizacionController@create')->name('createCotizacion');
Route::get('/cotizacion', 'Admin\CotizacionController@index');
Route::delete("/cotizacion/delete/{id}","Admin\CotizacionController@delete")->name("delCotizacion");
Route::get('/cotizacion/{cotizacion}/get','Admin\CotizacionController@get');
Route::get('/cotizacion/{cotizacion}/edit','Admin\CotizacionController@edit');
Route::put("/cotizacion/update",'Admin\CotizacionController@update')->name('updateCotizacion');

Route::get('/cotizaciondetalle/{cotizacion}/list','Admin\CotizacionDetalleController@list');
Route::delete('/cotizaciondetalle/delete/{id}','Admin\CotizacionDetalleController@delete');
Route::resource('usuario','Admin\UsuarioController');
Route::get('/prueba/{cotizaciondetalle}/list', 'Admin\PruebaController@list');
Route::get('/prueba/{codprueba}/get', 'Admin\PruebaController@get');
Route::post('/prueba/store', 'Admin\PruebaController@store');
Route::delete("/prueba/delete/{id}","Admin\PruebaController@delete")->name("delPrueba");
Route::put("/prueba/update",'Admin\PruebaController@update')->name('updatePrueba');
Route::resource('categoria','Admin\CategoriaController');
Route::resource('solicitante','Admin\SolicitanteController');
Route::resource('contacto','Admin\ContactoController');
Auth::routes();
Route::resource('asesoria','Admin\AsesoriaController');
Route::resource('curso','Admin\CursoController');
Route::resource('instructor','Admin\InstructorController');
Route::resource('horario-curso','Admin\HorarioCursoController');
Route::resource('horario-instructor','Admin\HorarioInstructorController');
Route::resource('instructor-curso','Admin\CursoInstructorController');
Route::resource('descuento','Admin\DescuentoController');
Route::resource('servicioac','Admin\ServicioAcademicoController');

//Ruta para crear el pdf
Route::get('cursos-list-pdf', 'Admin\CursoController@exportPdf')->name('cursos.pdf');
Route::get('cotizaciones-list-pdf', 'Admin\SolicitanteController@exportPdf')->name('cotizaciones.pdf');

//---------- Rutas para DataTable----------------
Route::get('dataTableUser','Admin\UsuarioController@dataTable')->name('dataTableUser');
Route::get('dataTableAsesoria','Admin\AsesoriaController@dataTable')->name('dataTableAsesoria');