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
Route::get('register/verify/{code}', 'UserController@verify');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('tipoPersona','TipoPersonaController');
    Route::resource('tipoActividad', 'TipoActividadController');
    Route::resource('egresado', 'EgresadoController');
    Route::resource('trabajo', 'TrabajoController');
    Route::resource('encuesta', 'EncuestaController');
    Route::get('encuesta/send/{idEncuesta}',  ['uses' => 'EncuestaController@send','as' => 'encuesta.send']);
    Route::get('encuesta/details/{idEncuesta}',  ['uses' => 'EncuestaController@details','as' => 'encuesta.details']);
    Route::post('encuesta/store_send/{idEncuesta}', ['uses' => 'EncuestaController@store_send','as' => 'encuesta.store_send']);
    Route::resource('user', 'UserController');
    Route::resource('tutorTutorado', 'TutorTutoradoController');
    Route::delete('tutorTutorado/{tutorTutorado}/destroy/{anioSemestre}/{numeroSemestre}', ['uses' =>  'TutorTutoradoController@destroyTutor','as' => 'tutorTutorado.destroyTutor']);
    Route::get('dashboard', 'DashboardController@index');
    Route::get('dashboard/actividades/{estado}', 'DashboardController@listarActividades');
    Route::get('alumnos', 'UserController@indexAlumnos');
    Route::get('docentes', 'UserController@indexDocentes');
    Route::get('administrativos', 'UserController@indexAdministrativos');
    Route::resource('semestre', 'SemestreController');
    Route::get('actividadEjecutada/{idActividad}', 'ActividadController@verEstadisticaActividad');
});


Route::middleware(['programador', 'auth'])->prefix('programador')->group(function () {
    Route::resource('actividad', 'ActividadController');
});

//PERMISOS DE MIEMBRO
Route::middleware('auth')->prefix('miembro')->group(function () {
    //Route::get('perfil','MiPerfilController@index');
    Route::resource('perfil', 'MiPerfilController');
    Route::get('perfil/{idPerfil}/edit', 'MiPerfilController@edit');
    Route::post('perfil/{idPerfil}',  ['uses' => 'MiPerfilController@update','as' => 'perfil.update']);
    Route::get('perfil/{idPerfil}/editPassword', 'MiPerfilController@editPassword');
    Route::post('perfil/cambioPassword/{idPerfil}',  ['uses' => 'MiPerfilController@updatePassword','as' => 'perfil.updatePassword']);
    Route::resource('inscripcion', 'InscripcionADAController');

    Route::resource('evidenciaActividad', 'EvidenciaActividadController');
    Route::get('actividad/categoria/{idTipoActividad}/', ['uses' => 'ActividadController@indexPorCategoria','as' => 'actividad.indexPorCategoria']);
    Route::get('actividad/categoria', 'ActividadController@indexCategorias');
    Route::get('actividad/{idActividad}/cancel', 'ActividadController@cancel');
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
    Route::post('actividad/deleteMotivo/{idActividad}', ['uses' => 'DetallePedagogiaController@update',  'as' => 'detallePedagogia.update']);
    Route::delete('actividad/nuevoMotivo/{idMotivo}', 'DetallePedagogiaController@destroy');
    Route::post('actividad/actualizarActPedagogia/{idActividadPedagogia}', ['uses' => 'ActPedagogiaController@update', 'as' => 'actPedagogia.update']);
    Route::get('actividad/{id}/beneficiario/{idBeneficiario}/evidencias', 'BeneficiarioController@indexEvidenciasBeneficiario');
    Route::post('actividad/{id}/beneficiario/{idBeneficiario}/evidencias', ['uses' => 'BeneficiarioController@storeEvidenciaBeneficiario','as' => 'evidenciaBeneficiario.store']);
    Route::delete('actividad/{id}/beneficiario/{idBeneficiario}/evidencias/{idEvidencia}','BeneficiarioController@destroyEvidenciaBeneficiario');

    Route::get('actividad/member_show', ['uses' => 'ActividadController@member_show', 'as' => 'actividad.member_show']);
    Route::get('mis-actividades/{id}', ['uses' => 'MiPerfilController@mis_actividades', 'as' => 'miembro.misActividades']);

    Route::post('enviarMailHabito', ['uses' => 'TutorTutoradoController@enviarEmail', 'as' => 'tutorTutorado.enviarMailHabito']);
    Route::post('enviarMensaje', ['uses' => 'ActividadController@enviarMensaje', 'as' => 'tutorTutorado.enviarMensaje']);

    Route::get('misTutorados', 'TutorTutoradoController@misTutorados');

    Route::get('show_habito/{id}', ['uses' => 'EncuestaController@show_habito']);
    Route::get('member_show/{id}', ['uses' => 'EncuestaController@member_show']);
    Route::post('member_show/store_answers/{id}', ['uses' => 'EncuestaController@store_answers']);

    Route::post('enviar/verify', ['uses' => 'UserController@enviarMailVerificacion', 'as' => 'user.enviarMailVerificacion']);
});
//Route::middleware('auth')->prefix('miembro')->get('actividad/member_show', ['uses' => 'ActividadController@member_show', 'as' => 'actividad.member_show']);

//PERMISOS DE MIEMBRO - PERFIL

/*Route::middleware('auth')->prefix('miembro')->group(function () {
   Route::resource('perfil', 'MiPerfilController');
   Route::get('mis-actividades/{id}', ['uses' => 'MiPerfilController@mis_actividades', 'as' => 'miembro.misActividades']);
});*/
Auth::routes();

/*                            AJAX                                  */
Route::get('listaUsersTodos','UserController@getUsersTodos');
Route::get('listaUsersAlumnos','UserController@getUsersAlumnos');
Route::get('listaUsersDocentes','UserController@getUsersDocentes');
Route::get('listaUsersAdministrativos','UserController@getUsersAdministrativos');

Route::get('listaUsersAlumDoc','UserController@getUsersAlumDoc');
Route::get('listaUsersAlumAdm','UserController@getUsersAlumAdm');
Route::get('listaUsersDocAdm','UserController@getUsersDocAdm');
//--------------------------------------------------------
Route::get('listaResponsablesTutores','TutorTutoradoController@getTutores');
Route::get('listaTutorados','TutorTutoradoController@getTutorados');
//----------------------------------------------------------
Route::get('descargarEvidencia','EvidenciaActividadController@descargarEvidencia');
Route::get('descargarEvidenciaBeneficiario','BeneficiarioController@descargarEvidenciaBeneficiario');
Route::get('alumnosLibresExDoc', 'TutorTutoradoController@getAlumnosLibresExDoc');
Route::get('soyTutor', 'TutorTutoradoController@soyTutor');
//Route::post('enviarMail','TutorTutoradoController@enviarEmail');
//Route::post('enviarMailUser','TutorTutoradoController@enviarEmail');

Route::get('buscarInscripciones', 'InscripcionADAController@buscarInscripciones');

//Route::get('send','CorreoController@send');

Route::get('actividadesProgramadas','ActividadController@verActividadesProg');
Route::get('actividadesResponsable','ActividadController@verActividadesResp');
Route::get('actividadesInscritas','ActividadController@verActividadesInsc');
Route::get('actividadesAsistidas','ActividadController@verActividades');
Route::get('actividadesNoAsistidas','ActividadController@verActividades');
Route::get('verMisEstadisticas','ActividadController@verMisEstadisticas');
Route::get('misEncuestasPendientes', 'EncuestaController@getMisEncuestasPendientes');


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
