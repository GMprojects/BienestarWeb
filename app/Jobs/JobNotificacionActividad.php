<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//
use Illuminate\Notifications\Notifiable;
//Models
use BienestarWeb\TipoActividad;
use BienestarWeb\User;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;
//Notifications
use BienestarWeb\Notifications\NotificacionActividad;
use Log;
class JobNotificacionActividad implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $actividad;
    private $opcion;
    private $tutorados;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($actividad, $opcion, $tutorados)
    {
        $this->actividad = $actividad;
        $this->opcion = $opcion;
        $this->tutorados = $tutorados;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tipoActividad = TipoActividad::findOrFail($this->actividad->idTipoActividad);
        $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
        $mensajeResp = 'Ud. ha sido asignado como responsable de una actividad';
        $mensajeDemas = 'Se le invita a participar de una actividad';
        //Envio a los demas
        if ($this->opcion == '1') {//nueva
          $subject = 'Nueva Actividad Programada';
          if (strlen($tipoActividad->dirigidoA) == 1){
             switch($tipoActividad->dirigidoA[0]){
                case('1'): $tipoPersona[0] = '1'; break;//Alumno
                case('2'): $tipoPersona[0] = '2'; break;//Docente
                case('3'): $tipoPersona[0] = '3'; break;//Administrativo
             }
          }elseif (strlen($tipoActividad->dirigidoA) == 2){
             if ($tipoActividad->dirigidoA[0] == 1 && $tipoActividad->dirigidoA[1] == 2){ //Alumnos-Docentes
                $tipoPersona[0] = '1';
                $tipoPersona[1] = '2';
             }elseif ($tipoActividad->dirigidoA[0] == 1 && $tipoActividad->dirigidoA[1] == 3){ //Alumnos-Administrativos
                $tipoPersona[0] = '1';
                $tipoPersona[1] = '3';
             }else{ //Docentes-Administrativos
                $tipoPersona[0] = '2';
                $tipoPersona[1] = '3';
             }
          }else{ //Alumnos-Docentes-Administrativos
              $tipoPersona[0] = '1';
              $tipoPersona[1] = '2';
              $tipoPersona[2] = '3';
          }
          if ($tipoActividad->idTipoActividad == '4') {
            $mensajeDemas = 'Se le ha programado una sesión de tutoría ';
            $mensajeResp = 'Ud. ha sido asignado responsable de la siguiente sesión de tutoría';
             for ($i=0; $i < count($this->tutorados) ; $i++) {
                 $alumno = User::join('alumno', 'user.id', '=', 'alumno.idUser' )
                                 ->where([['alumno.idAlumno', $this->tutorados[$i]],['user.confirmed', '=', 1], ['user.email', 'not like', '%-'], ['user.estado', '=', '1']])
                                 ->whereNotNull('email')->first();
                 if ($alumno != null) {
                     $nombres = $alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno;
                     $alumno->notify(new NotificacionActividad($subject, $this->actividad, $mensajeDemas, $alumno->sexo, $url, $nombres, '0', '1'));
                 }
             }
          }else if($this->actividad->modalidad == '1' && ($tipoActividad->idTipoActividad < 4 ||  $tipoActividad->idTipoActividad == 10)){
              $mensajeDemas = 'Ud. ha sido inscrito en la siguiente actividad ';
              $alumno = User::join('alumno', 'user.id', '=', 'alumno.idUser' )
                              ->where([['alumno.idAlumno', $this->tutorados], ['user.confirmed', '=', 1], ['user.email', 'not like', '%-'], ['user.estado', '=', '1']])
                              ->whereNotNull('user.email')->first();
              if ($alumno != null) {
                  $nombres = $alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno;
                  $alumno->notify(new NotificacionActividad($subject, $this->actividad, $mensajeDemas, $alumno->sexo, $url, $nombres, '0', '1'));
              }
          }else{
            $users = User::where([['user.confirmed', '=', 1], ['user.email', 'not like', '%-'], ['user.estado', '=', '1']])->whereIn('idTipoPersona', $tipoPersona)->whereNotNull('email')->get();
              if (count($users)!=0) {
                 foreach ($users as $user) {
                      $nombres = $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno;
                      $user->notify(new NotificacionActividad($subject, $this->actividad, $mensajeDemas, $user->sexo, $url, $nombres, '0', '0'));
                 }
             }
          }
        }else{
          //verificar si existe inscripciones de Alumnos
          $inscripcionesAlumnos = InscripcionAlumno::where('idActividad', $this->actividad->idActividad)->get();
          //verificar si existe inscripciones de Administrativos
          $inscripcionesAdministrativos = InscripcionAdministrativo::where('idActividad', $this->actividad->idActividad)->get();
          //verificar si existe inscripciones de Docentes
          $inscripcionesDocentes = InscripcionDocente::where('idActividad', $this->actividad->idActividad)->get();
          //--------------------------------------------------------------------------------------------------------------------
          if(count($inscripcionesAlumnos)>0){
            $i = 0;
            foreach ($inscripcionesAlumnos as $inscripcionAlumno) {
               if ($inscripcionAlumno->alumno->user->confirmed) {
                    $alumnos[$i] = $inscripcionAlumno->alumno->user;
               }
              $i++;
            }
          }else {
            $alumnos = array();
          }
          if(count($inscripcionesAdministrativos)>0){
            $i = 0;
            foreach ($inscripcionesAdministrativos as $inscripcionAdministrativo) {
               if ($inscripcionAdministrativo->administrativo->user->confirmed) {
                    $administrativos[$i] = $inscripcionAdministrativo->administrativo->user;
               }
              $i++;
            }
          }else {
            $administrativos = array();
          }
          if(count($inscripcionesDocentes)>0){
            $i = 0;
            foreach ($inscripcionesDocentes as $inscripcionDocente) {
               if ($inscripcionDocente->docente->user->confirmed) {
                    $docentes[$i] = $inscripcionDocente->docente->user;
               }
              $i++;
            }
          }else {
            $docentes = array();
          }
          $users = array_merge($alumnos, $administrativos);
          $users = array_merge($users, $docentes);
          switch ($this->opcion) {
            case '2':
              $subject = 'Actividad Actualizada';
              $mensajeResp = 'La actividad de la que ud. es responsable ha sido modificada';
              $mensajeDemas = 'La actividad en la que ud. esta inscrito ha sido modificada';
            break;//actualizada
            case '3':
              $subject = 'Actividad Cancelada';
              $mensajeResp = 'La actividad de la que ud. es responsable ha sido cancelada';
              $mensajeDemas = 'La actividad en la que ud. esta inscrito ha sido cancelada';
            break;//cancelada
            case '4':
              $subject = 'Actividad Eliminada';
              $mensajeResp = 'La actividad de la que ud. es responsable ha sido eliminada';
              $mensajeDemas = 'La actividad en la que ud. esta inscrito ha sido eliminada';
            break;//eliminada
          }
          //-----------enviar los emails-------------------------------------------------------------------------
          foreach ($users as $user) {
            $nombres = $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno;
            $user->notify(new NotificacionActividad($subject, $this->actividad, $mensajeDemas, $user->sexo, $url, $nombres, '0', '1'));
          }
        }
        //Envio a responsable
        $userResp = User::where([['user.id', $this->actividad->idUserResp], ['user.confirmed', '=', 1], ['user.email', 'not like', '%-'], ['user.estado', '=', '1']])
                          ->whereNotNull('email')->first();
        if ($userResp != null && $userResp->confirmed) {
          $nombres = $userResp->nombre.' '.$userResp->apellidoPaterno.' '.$userResp->apellidoMaterno;
          $userResp->notify(new NotificacionActividad($subject, $this->actividad, $mensajeResp, $userResp->sexo, $url, $nombres, '1', '0'));
        }
    }
}
