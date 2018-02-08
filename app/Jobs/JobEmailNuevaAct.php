<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notifiable;

use BienestarWeb\Notifications\ActividadProgramadaNotif;
use BienestarWeb\Actividad;
use BienestarWeb\TipoActividad;
use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;

class JobEmailNuevaAct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $actividad;
    private $userAl;
    private $userResp;
    private $mensajeR;
    private $mensajeA;
    private $tutorados;
    private $tipoActividad;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Actividad $actividad, $tipoActividad, $userAl, $userResp, $mensajeR, $mensajeA, $tutorados)
    {
        $this->actividad = $actividad;
        $this->userAl = $userAl;
        $this->userResp = $userResp;
        $this->mensajeR = $mensajeR;
        $this->mensajeA = $mensajeA;
        $this->tutorados = $tutorados;
        $this->tipoActividad = $tipoActividad;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
      if( $this->userAl != null){
          $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
          if ($userAl->confirmed) {
             $nombres = $this->userAl->nombre.' '.$this->userAl->apellidoPaterno.' '.$this->userAl->apellidoMaterno;
             $this->userAl->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $this->userAl->sexo, $url, $nombres, '0', '1'));
          }
      }else{
          $tipoActividad = TipoActividad::findOrFail($this->tipoActividad);
          if (strlen($tipoActividad->dirigidoA) == 1){
             switch($tipoActividad->dirigidoA[0]){
                case('1'): //Alumnos
                $tipoPersona = '1';
                break;
                case('2'): //Docentes
                $tipoPersona = '2';
                break;
                case('3'): //Administrativos
                $tipoPersona = '3';
                break;
             }
             if ($this->tipoActividad == '4') {
                  //"numero tutorados"
                  for ($i=0; $i < count($this->tutorados) ; $i++) {
                        $alumno = User::join('alumno', 'user.id', '=', 'alumno.idUser' )
                                  ->where('alumno.idAlumno', $this->tutorados[$i])
                                  ->whereNotNull('email')->first();
                         if ($alumno->confirmed) {
                              if ($alumno != null) {
                                 //enviar Alumno
                                 $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
                                 $nombres = $alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno;
                                 $alumno->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $alumno->sexo, $url, $nombres, '0', '1'));
                                 //Fin enviar Alumno
                             }
                         }
                  }
             } else {
                  $users = User::where([['idTipoPersona', '=', $tipoPersona],['confirmed', '=', 1]])->get();
                  //numero de users
                  if (count($users)!=0) {
                     $i=0;
                     foreach ($users as $user) {
                          $i++;
                          //enviar mail
                          $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
                          $nombres = $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno;
                          $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $user->sexo, $url, $nombres, '0', '0'));
                          //Fin enviar de enviar mail");
                     }
                  }
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
             $users = User::where([['idTipoPersona', '=', $tipoPersona[0]], ['idTipoPersona', '=', $tipoPersona[1]], ['confirmed', '=', 1]])->get();
             //numero de users
             if (count($users)!=0) {
                $i=0;
                foreach ($users as $user) {
                     $i++;
                     //enviar mail
                     $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
                     $nombres = $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno;
                     $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $user->sexo, $url, $nombres, '0', '0'));
                     //"Fin enviar de enviar mail"
                }
             }
          }else{ //Alumnos-Docentes-Administrativos
             $users = User::where([['confirmed', '=', 1]])->get();
             if (count($users)!=0) {
                $i=0;
                foreach ($users as $user) {
                     $i++;
                     //"enviar mail  "
                     $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
                     $nombres = $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno;
                     $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $user->sexo, $url, $nombres, '0', '0'));
                     //"Fin enviar de enviar mail"
                 }
              }
          }
      }

      if($this->tipoActividad > 2){
         //"enviar Responsable"
         if ($this->userResp->confirmed) {            
            $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
            $this->userResp->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeR, $this->userResp->sexo, $url, '1', '0'));
         }
         //"Fin enviar Responsable"
      }

    }
}
