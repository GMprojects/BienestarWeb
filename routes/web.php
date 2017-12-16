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
    Route::get('tutorTutorado/{tutorTutorado}/destroy', 'TutorTutoradoController@destroyTutor');
    Route::get('dashboard', 'DashboardController@index');
    Route::get('dashboard/actividades', 'DashboardController@listarActividades');
   /* Route::get('tutorTutorado', 'TutorTutoradoController@index');
    Route::get('tutorTutorado/create', 'TutorTutoradoController@create');
    Route::get('tutorTutorado/{tutorTutorado}/edit', 'TutorTutoradoController@edit');
    Route::put('tutorTutorado/{tutorTutorado}', ['uses' => 'TutorTutoradoController@update', 'as' => 'tutorTutorado.update']);
    Route::put('tutorTutorado', ['uses' => 'TutorTutoradoController@store', 'as' => 'tutorTutorado.store']);*/
});

//Route::get('tutorTutorado/{tutorTutorado}', 'TutorTutoradoController@show');

//Route::get('perfilTipo', 'UserController@getUserTipo');

Route::middleware(['programador', 'auth'])->prefix('programador')->group(function () {
   Route::resource('actividad', 'ActividadController');

});

//PERMISOS DE MIEMBRO
Route::middleware('auth')->prefix('miembro')->group(function () {
    Route::resource('habitoEstudio','HabitoEstudioController');
    Route::resource('perfil','MiPerfilController');
    Route::resource('inscripcion', 'InscripcionADAController');

    Route::resource('evidenciaActividad', 'EvidenciaActividadController');

    Route::get('actividad/{idActividad}/execute', 'ActividadController@execute');
    Route::get('actividad/{idActividad}/execute/{idInsAlumno}/tutoria', 'ActPedagogiaController@create');
    Route::get('actividad/{id}/beneficiario/create', 'BeneficiarioController@createBeneficiario');
    Route::post('actividad/{id}/beneficiario', ['uses' => 'BeneficiarioController@storeBeneficiario','as' => 'beneficiario.store']);
    Route::get('actividad/{id}/beneficiario/{idBeneficiario}/edit', 'BeneficiarioController@editBeneficiario');
    Route::post('actividad/{id}/beneficiario/{idBeneficiario}', ['uses' => 'BeneficiarioController@updateBeneficiario','as' => 'beneficiario.update']);
    Route::delete('actividad/{id}/beneficiario/{idBeneficiario}','BeneficiarioController@destroyBeneficiario');


    Route::post('actividad/execute/{idActividad}', ['uses' => 'ActividadController@updateExecute','as' => 'actividad.updateExecute']);
    Route::post('actividad/registrarAsistencias/{idActividad}', ['uses' => 'InscripcionADAController@registrarAsistencias','as' => 'actividad.registrarAsistencias']);
    Route::post('actividad/nuevoMotivo/{idActividad}', ['uses' => 'DetallePedagogiaController@store',  'as' => 'detallePedagogia.store']);
    Route::post('actividad/actualizarActPedagogia/{idActividadPedagogia}', ['uses' => 'ActPedagogiaController@update', 'as' => 'actPedagogia.update']);

    Route::get('actividad/{id}/beneficiario/{idBeneficiario}/evidencias', 'BeneficiarioController@indexEvidenciasBeneficiario');
    Route::post('actividad/{id}/beneficiario/{idBeneficiario}/evidencias', ['uses' => 'BeneficiarioController@storeEvidenciaBeneficiario','as' => 'evidenciaBeneficiario.store']);
    Route::delete('actividad/{id}/beneficiario/{idBeneficiario}/evidencias/{idEvidencia}','BeneficiarioController@destroyEvidenciaBeneficiario');

    Route::get('actividad/member_show', ['uses' => 'ActividadController@member_show', 'as' => 'actividad.member_show']);
    Route::resource('perfil', 'MiPerfilController');
    Route::get('mis-actividades/{id}', ['uses' => 'MiPerfilController@mis_actividades', 'as' => 'miembro.misActividades']);


     Route::get('misTutorados', 'TutorTutoradoController@misTutorados');
     Route::get('encuesta', 'EncuestaController@encuesta');
     Route::get('encuestaInsc/{id}', ['uses' => 'EncuestaController@encuestaInsc']);
     Route::get('encuestaResp/{id}', ['uses' => 'EncuestaController@encuestaResp']);
     Route::post('encuesta/registrar_respuestas/{id}/{opt}', ['uses' => 'EncuestaController@registrar_respuestas']);
});
//Route::middleware('auth')->prefix('miembro')->get('actividad/member_show', ['uses' => 'ActividadController@member_show', 'as' => 'actividad.member_show']);

//PERMISOS DE MIEMBRO - PERFIL

/*Route::middleware('auth')->prefix('miembro')->group(function () {
   Route::resource('perfil', 'MiPerfilController');
   Route::get('mis-actividades/{id}', ['uses' => 'MiPerfilController@mis_actividades', 'as' => 'miembro.misActividades']);
});*/

Auth::routes();

/*                            AJAX                                  */
Route::get('listaResponsablesGen','UserController@getUsers');
Route::get('listaResponsablesAdm','UserController@getUsersAdm');
Route::get('listaResponsablesAdmDoc','UserController@getUsersAdmDoc');
Route::get('listaAlumnos','UserController@getAlumnos');
Route::get('listaResponsablesTutores','TutorTutoradoController@getTutores');
Route::get('listaTutorados','TutorTutoradoController@getTutorados');
Route::get('descargarEvidencia','EvidenciaActividadController@descargarEvidencia');
Route::get('descargarEvidenciaBeneficiario','BeneficiarioController@descargarEvidenciaBeneficiario');
Route::get('alumnosLibres', 'TutorTutoradoController@getAlumnosLibres');
Route::get('alumnosLibresExDoc', 'TutorTutoradoController@getAlumnosLibresExDoc');
Route::get('docentesNoTutores', 'TutorTutoradoController@getDocentesNoTutores');
Route::get('soyTutor', 'TutorTutoradoController@soyTutor');
Route::post('enviarMail','TutorTutoradoController@enviarEmail');

Route::get('buscarInscripciones', 'InscripcionADAController@buscarInscripciones');

//Route::get('send','CorreoController@send');

Route::get('actividadesProgramadas','ActividadController@verActividadesProg');
Route::get('actividadesResponsable','ActividadController@verActividadesResp');
Route::get('actividadesInscritas','ActividadController@verActividadesInsc');
Route::get('actividadesAsistidas','ActividadController@verActividades');
Route::get('actividadesNoAsistidas','ActividadController@verActividades');
Route::get('verMisEstadisticas','ActividadController@verMisEstadisticas');
Route::get('misEncuPendientes', 'EncuestaController@misEncuPendientes');


Route::get('reIndexDashboard','DashboardController@reIndex');

//temporal :p
Route::get('encuesta', function () {
    return view('encuesta');
});
Route::get('habitos', function () {
    return view('habitos');
});
Route::get('actividad-demo', function () {
    return view('actividad-demo');
});
Route::get('actividades-demo', function () {
    return view('actividades-demo');
});
Route::get('basura', function () {
   return view('basura');
});
