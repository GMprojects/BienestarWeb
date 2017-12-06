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
use Log;

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

   function getListInsc($user){
      $list_insc = array('hd');
         switch ($user->idTipoPersona) {
            case '1'://Alumno
              $idAlumno = Alumno::where('idUser', $user->id)->value('idAlumno');
              $inscripciones = InscripcionAlumno::where('idAlumno', $idAlumno)->get();
              break;
            case '2'://Docente
               $idDocente = Docente::where('idUser', $user->id)->pluck('idDocente');
               $inscripciones = InscripcionDocente::where('idDocente', $idDocente)->get();
               break;
            case '3'://Administrativo
               $idAdministrativo = Administrativo::where('idUser', $user->id)->pluck('idAdministrativo');
               $inscripciones = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->get();
               break;
         }

         for ($i=0; $i < count($inscripciones) ; $i++) {
            array_push ( $list_insc,  $inscripciones[$i]->idActividad );
         }
         return $list_insc;
   }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
      Log::info('JobEnviarNuevaActEmail');
      if( $this->userAl != null){
          Log::info("Enviar mail Alumno   ". $this->userAl->email);
          $url = action('MiPerfilController@mis_actividades', ['id' => $this->userAl->id , 'opcion' => 3]);
          $this->userAl->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $this->userAl->sexo, $url, '0', '1'));
          Log::info("Fin de enviar mail Alumno   ". $this->userAl->email);
      }else{
          Log::info('Job Enviar -> tipo de la actividad'.$this->tipoActividad);
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
                  Log::info("numero tutorados".count($this->tutorados));
                  for ($i=0; $i < count($this->tutorados) ; $i++) {
                        $alumno = User::join('alumno', 'user.id', '=', 'alumno.idUser' )
                                  ->where('alumno.idAlumno', $this->tutorados[$i])
                                  ->whereNotNull('email')->first();
                        if ($alumno != null) {
                           Log::info("i = ".$i);
                           Log::info("enviar Alumno  ");
                           $url = action('MiPerfilController@mis_actividades', ['id' => $alumno->id , 'opcion' => 3]);
                           $alumno->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $alumno->sexo, $url, '0', '1'));
                           Log::info("Fin enviar Alumno ".$i);
                       }else{
                          Log::info('ALumno no tiene correo');
                       }
                  }
             } else {

                  Log::info('tipo Persona 0:   '.$tipoPersona );
                  $users = User::where('idTipoPersona', $tipoPersona)->whereNotNull('email')->get();
                  Log::info('numero de users'.count($users));
                  $i=0;
                  foreach ($users as $user) {
                       $i++;
                       Log::info("i = ".$i);
                       Log::info("enviar mail  ");
                       $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad, 'list_insc'=>JobEmailNuevaAct::getListInsc($user)]);
                       $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $user->sexo, $url, '0', '0'));
                       Log::info("Fin enviar de enviar mail");
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
             Log::info('tipo Persona 0:   '.$tipoPersona[0] );
             Log::info('tipo Persona 1:   '.$tipoPersona[1] );
             $users = User::where('idTipoPersona', $tipoPersona[0])->where('idTipoPersona', $tipoPersona[1])->whereNotNull('email')->get();
             Log::info('numero de users'.count($users));
             $i=0;
             foreach ($users as $user) {
                  $i++;
                  Log::info("i = ".$i);
                  Log::info("enviar mail  ");
                  $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad, 'list_insc'=>JobEmailNuevaAct::getListInsc($user)]);
                  $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $user->sexo, $url, '0', '0'));
                  Log::info("Fin enviar de enviar mail");
             }
          }else{ //Alumnos-Docentes-Administrativos
             Log:info('Todos users');
             $users = User::whereNotNull('email')->get();
             Log::info('numero de users'.count($users));
             $i=0;
             foreach ($users as $user) {
               $i++;
               Log::info("i = ".$i);
               Log::info("enviar mail  ");
               $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad, 'list_insc'=>JobEmailNuevaAct::getListInsc($user)]);
               $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA, $user->sexo, $url, '0', '0'));
               Log::info("Fin enviar de enviar mail");
            }
          }
      }

      if($this->tipoActividad > 2){
         Log::info("enviar Responsable");
         $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad, 'list_insc'=>JobEmailNuevaAct::getListInsc($this->userResp)]);
         $this->userResp->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeR, $this->userResp->sexo, $url, '1', '0'));
         Log::info("Fin enviar Responsable");
      }

    }
}
