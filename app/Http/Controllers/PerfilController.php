<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;
use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\Actividad;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;

class PerfilController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {  $user = User::findOrFail($id);
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
      return view('miembro.perfil')->with('du', $du);
   }
   public function edit($id){

   }
}
