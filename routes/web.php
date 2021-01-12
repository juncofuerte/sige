<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

//Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('home', function(){
    return view('home');
})->name('home');


Route::get('solicitudes/index/{param}','SolicitudesController@index')->name('solicitudes.index');

Route::get('solicitudes/crear','SolicitudesController@crear')->name('solicitudes.crear');

Route::get('solicitudes/ver','SolicitudesController@ver')->name('solicitudes.ver');
Route::get('solicitudes/editar','SolicitudesController@editar')->name('solicitudes.editar');
Route::get('solicitudes/anular','SolicitudesController@anular')->name('solicitudes.anular');
Route::get('solicitudes/eliminar','SolicitudesController@eliminar')->name('solicitudes.eliminar');

Route::get('solicitudes/crear/{id}/componentes', 'TraeComponentesController@listaComponentes')->name('traecomponentes.get');
Route::get('solicitudes/crear/{id}/iniciativas', 'TraeIniciativasController@listaIniciativas')->name('traeiniciativas.get');
Route::get('solicitudes/crear/{id}/detalle', 'TraeDetalleController@detalle')->name('traedetalle.get');

//para la llamada Ajax
Route::post('procesasolicitud', 'ProcesaSolicitudController@procesa')->name('procesasolicitud.post');


Route::get('datatables/solicitudes/{param}','DatatableController@solicitudes')->name('datatable.solicitudes');

//Para la llamada de la generación pdf
Route::get('pdf','PDFController@PDF')->name('descargarPDF');