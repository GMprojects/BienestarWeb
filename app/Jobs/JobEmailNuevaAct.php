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
use BienestarWeb\User;
use BienestarWeb\Alumno;
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
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
      Log::info('JobEnviarNuevaActEmail');
      if( $this->userAl != null){
          Log::info("enviar Alumno   ". $this->userAl->email);
          //Notification::send($this->userAl, new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
          $this->userAl->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
          /* Mail::to( $this->userAl->email)
              ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
          Log::info("Fin enviar Alumno");*/
      }else{
        Log::info('Job Enviar -> tipo de la actividad'.$this->tipoActividad);
        switch ($this->tipoActividad) {
          case '3': case '10':
            $users = User::where('idTipoPersona', '3')->whereNotNull('email')->get();
            Log::info('numero de users'.count($users));
            $i=0;
            foreach ($users as $user) {
              $i++;
              Log::info("i = ".$i);
              Log::info("enviar Alumno  ");
              /*Log::info($user);
              Mail::to($email)
                  ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
              $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              //Notification::send($user, new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              Log::info("Fin enviar Alumno");
            }
          break;
          case '5': case '6': case '7':
            $users = User::whereNotNull('email')->get();
            Log::info('numero de users'.count($users));
            $i=0;
            foreach ($users as $user) {
              $i++;
              Log::info("i = ".$i);
              Log::info("enviar Alumno  ");
              /*Log::info($user);
              Mail::to($email)
                  ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
              $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              //Notification::send($user, new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              Log::info("Fin enviar Alumno");
            }
            break;
          case '4':
            Log::info("numero tutorados".count($this->tutorados));
            for ($i=0; $i < count($this->tutorados) ; $i++) {
                  $alumno = User::join('alumno', 'user.id', '=', 'alumno.idUser' )
                            ->where('alumno.idAlumno', $this->tutorados[$i])->whereNotNull('email')->first();
                  if ($alumno != null) {
                     Log::info("i = ".$i);
                     Log::info("enviar Alumno  ");
                     /*Log::info($alumno);
                     Mail::to($alumno)
                          ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
                     $alumno->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
                     //Notification::send($alumno, new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
                     Log::info("Fin enviar Alumno ".$i);
                 }else{
                    Log::info('ALumno no tiene correo');
                 }
            }
            break;
          case '8': case '9':
            $users = User::where('idTipoPersona', '3')->whereNotNull('email')->get();
            $i=0;
            foreach ($users as $user) {
              $i++;
              Log::info("i = ".$i);
              Log::info("enviar Alumno  ");
              /*Log::info($user);
              Mail::to($user)
                  ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
             $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
             //Notification::send($user, new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              Log::info("Fin enviar Alumno");
            }
            break;
        }
      }

      if($this->tipoActividad > 2){
         Log::info("enviar Responsable");
           //Notification::send($this->userResp, new ActividadProgramadaNotif($this->actividad, $this->mensajeR));
         $this->userResp->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeR));
           /*Mail::to($this->userResp->email)
               ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeR));*/
         Log::info("Fin enviar Responsable");
      }

    }
}
