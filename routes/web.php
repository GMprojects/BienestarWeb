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
    return view('home');
});

Route::middleware('auth', 'admin')->prefix('admin')->group(function () {
    Route::resource('tipoPersona','TipoPersonaController');
    Route::resource('tipoHabito','TipoHabitoController');
    Route::resource('preguntaHabito','PreguntaHabitoController');
    Route::resource('tipoActividad', 'TipoActividadController');
    Route::resource('egresado', 'EgresadoController');
    Route::resource('trabajo', 'TrabajoController');
    Route::resource('encuesta', 'EncuestaController');
    Route::resource('alternativa', 'AlternativaController');
    Route::resource('preguntaEncuesta', 'PreguntaEncuestaController');
    Route::resource('user', 'UserController');

});

Route::middleware('auth')->prefix('miembro')->group(function () {
    Route::resource('habitoEstudio','HabitoEstudioController');
});
Route::middleware('auth')->get('beneficiarioComedor', 'AlumnoController@showBeneficiarioComedor');

Route::prefix('programador')->group(function () {
    Route::resource('actividad', 'ActividadController');
    Route::resource('evidencia', 'EvidenciaActividadController');
    Route::resource('inscripcion', 'InscripcionADAController');
    Route::resource('beneficiarioMovilidad', 'BeneficiarioMovilidadController');
    Route::resource('evidenciaActividad', 'EvidenciaActividadController');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('listaResponsablesGen','UserController@getUsers');
Route::get('listaResponsablesAdm','UserController@getUsersAdm');
Route::get('listaResponsablesAdmDoc','UserController@getUsersAdmDoc');

Route::get('listaAlumnos','UserController@getAlumnos');

Route::get('listaResponsablesTutores','TutorTutoradoController@getTutores');
Route::get('listaTutorados','TutorTutoradoController@getTutorados');
//Route::get('listaTutorados/{idDocente}','TutorTutoradoController@getTutorados');
