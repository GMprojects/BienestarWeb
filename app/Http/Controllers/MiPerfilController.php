<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\User;
use BienestarWeb\Actividad;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;


class MiPerfilController extends Controller
{
   public function show($id){
      $user = User::findOrFail($id);
     $du['user'] = $user;
         //SI SOY PROGRAMADOR(organizador) o ADMINISTRADOR
     if($user->funcion != 1){
        $progPendientes = Actividad::where([['idUserProg', $id ], ['estado', '1']])->count('idUserProg');
        $du['progPendientes'] = $progPendientes;
        $progEjecutadas = Actividad::where([['idUserProg', $id ], ['estado', '2']])->count('idUserProg');
        $du['progEjecutadas'] = $progEjecutadas;
        $progCanceladas = Actividad::where([['idUserProg', $id ], ['estado', '3']])->count('idUserProg');
        $du['progCanceladas'] = $progCanceladas;
        $progExpiradas = Actividad::where([['idUserProg', $id ], ['estado', '4']])->count('idUserProg');
        $du['progExpiradas'] = $progExpiradas;
     }
     //SI SOY RESPONSABLE
     $respPendientes = Actividad::where([['idUserResp', $id ], ['estado', '1']])->count('idUserResp');
     $du['respPendientes'] = $respPendientes;
     $respEjecutadas = Actividad::where([['idUserResp', $id ], ['estado', '2']])->count('idUserResp');
     $du['respEjecutadas'] = $respEjecutadas;
     //ACTIVIDADES INSCRITAS
     switch ($user->idTipoPersona) {
         case '1'://Alumno
            $idAlumno = Alumno::where('idUser', $id)->value('idAlumno');
            $inscInscripcion = InscripcionAlumno::where('idAlumno', $idAlumno)->count('idAlumno');
            $inscAsistencia = InscripcionAlumno::where('idAlumno', $idAlumno)->where('asistencia', '1')->count('idAlumno');
            break;
         case '2'://Docente
            $idDocente = Docente::where('idUser', $id)->pluck('idDocente');
            $inscInscripcion = InscripcionDocente::where('idDocente', $idDocente)->count('idDocente');
            $inscAsistencia = InscripcionDocente::where('idDocente', $idDocente)->where('asistencia', '1')->count('idDocente');
            break;
         case '3'://Administrativo
            $idAdministrativo = Administrativo::where('idUser', $id)->pluck('idAdministrativo');
            $inscInscripcion= InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->count('idAdministrativo');
            $inscAsistencia = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->where('asistencia', '1')->count('idAdministrativo');
            break;
     }
     $du['inscInscripcion'] = $inscInscripcion;
     $du['inscAsistencia'] = $inscAsistencia;
     //dd($du);
    return view('miembro.perfil.perfil')->with('du', $du);
   }
   public function edit(Request $request, $id){
      if($id == $request->user()->id){ //FUNCION DE middleware QUE NO PUDE IMPLEMENTAR EN UNMIDDLEWARE :(
         $user = User::findOrFail($request->user()->id);
         return view('miembro.perfil.edit')->with('user', $user);
      }else{
         return abort(401);
      }
   }
   public function misActInscrito($tipo, $id){
      $list_insc = array('hd');
      switch ($tipo) {
         case '1'://Alumno
            $idAlumno = Alumno::where('idUser', $id)->value('idAlumno');
            $inscripciones = InscripcionAlumno::where('idAlumno', $idAlumno)->pluck('idActividad');
            $actividades = Actividad::whereIn('idActividad', $inscripciones)->get();
            break;
         case '2'://Docente
            $idDocente = Docente::where('idUser', $id)->value('idDocente');
            $inscripciones = InscripcionDocente::where('idDocente', $idDocente)->pluck('idActividad');
            $actividades = Actividad::whereIn('idActividad', $inscripciones)->get();
            break;
         case '3'://Administrativo
            $idAdministrativo = Administrativo::where('idUser', $id)->value('idAdministrativo');
            $inscripciones = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->pluck('idActividad');
            $actividades = Actividad::whereIn('idActividad', $inscripciones)->get();
            break;
      }
      for ($i=0; $i < count($inscripciones) ; $i++) {
         array_push ( $list_insc,  $inscripciones[$i] );
      }
      return array($actividades, $list_insc);
   }
   public function misActResponsable($id){
      $actividades = Actividad::where('idUserResp', $id)->get();
      return $actividades;
   }
   public function misActProgramador($id){
      $actividades = Actividad::where('idUserProg', $id)->get();
      return $actividades;

   }

   public function mis_actividades(Request $request, $id){
      if($id == $request->user()->id){ //FUNCION DE middleware QUE NO PUDE IMPLEMENTAR EN UNMIDDLEWARE :(
         $aux = MiPerfilController::misActInscrito($request->user()->idTipoPersona, $request->user()->id);
         $list_insc = $aux[1];
         $mis_insc = $aux[0];
         $mis_resp = MiPerfilController::misActResponsable($request->user()->id);
         $mis_prog = MiPerfilController::misActProgramador($request->user()->id);
         $opcion = $request->opcion;
         return view('miembro.mis-actividades')->with('mis_insc', $mis_insc)->with('mis_resp', $mis_resp)->with('mis_prog', $mis_prog)->with('list_insc', $list_insc)->with('opcion', $opcion);
      }else{
         return abort(401);
      }
   }
}
