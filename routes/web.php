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

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
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
    Route::resource('tutorTutorado', 'TutorTutoradoController');
});

Route::middleware('auth')->prefix('miembro')->group(function () {
    Route::resource('habitoEstudio','HabitoEstudioController');
});

Route::middleware('auth')->prefix('miembro')->get('perfil', function () {
    return view('miembro.miperfil');
});
Route::get('perfilTipo', 'UserController@getUserTipo');

Route::middleware(['programador', 'auth'])->prefix('programador')->group(function () {
    Route::get('actividad/{idActividad}/execute', 'ActividadController@execute');
    Route::resource('actividad', 'ActividadController');
    Route::resource('inscripcion', 'InscripcionADAController');
    Route::resource('beneficiarioMovilidad', 'BeneficiarioMovilidadController');
    Route::resource('evidenciaActividad', 'EvidenciaActividadController');
});

Auth::routes();

/*                            AJAX                                  */
Route::get('listaResponsablesGen','UserController@getUsers');
Route::get('listaResponsablesAdm','UserController@getUsersAdm');
Route::get('listaResponsablesAdmDoc','UserController@getUsersAdmDoc');
Route::get('listaAlumnos','UserController@getAlumnos');
Route::get('listaResponsablesTutores','TutorTutoradoController@getTutores');
Route::get('listaTutorados','TutorTutoradoController@getTutorados');
Route::get('descargarEvidencia','EvidenciaActividadController@descargarEvidencia');

Route::get('buscarInscripciones', 'InscripcionADAController@buscarInscripciones');

Route::get('send','CorreoController@send');

Route::get('actividadesProgramadas','ActividadController@verActividadesProg');
Route::get('actividadesResponsable','ActividadController@verActividadesResp');
Route::get('actividadesInscritas','ActividadController@verActividadesInsc');
Route::get('actividadesAsistidas','ActividadController@verActividades');
Route::get('actividadesNoAsistidas','ActividadController@verActividades');
Route::get('verMisEstadisticas','ActividadController@verMisEstadisticas');

//temporal :p
Route::get('nuevo', function () {
    return view('nuevo');
});
Route::get('actividad-demo', function () {
    return view('actividad-demo');
});
Route::get('actividades-demo', function () {
    return view('actividades-demo');
});
Route::get('encuesta', function () {
    return view('encuesta');
});
