<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
    public function __construct(Actividad $actividad, $tipoActividad, $userAl, User $userResp, $mensajeR, $mensajeA, $tutorados)
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
    public function handle()
    { Log::info('JobEnviarNuevaActEmail');
      if( $this->userAl != null){
                Log::info("enviar Alumno   ". $this->userAl->email);
                $this->userAl->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
                /* Mail::to( $this->userAl->email)
                    ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
                Log::info("Fin enviar Alumno");*/
      }else{
        Log::info('Job Enviar -> tipo de la actividad'.$this->tipoActividad);
        switch ($this->tipoActividad) {
          case '3': case '10':
            $users = User::where('idTipoPersona', '3')->whereNotNull('email');
            $i=0;
            foreach ($users as $user) {
              $i++;
              Log::info($i);
              Log::info("enviar Alumno  ".$user->email);/*
              Mail::to($email)
                  ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
              $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              Log::info("Fin enviar Alumno");
            }
          break;
          case '5': case '6': case '7':
            $users = User::whereNotNull('email');$i=0;
            foreach ($users as $user) {
              $i++;
              Log::info($i);
              Log::info("enviar Alumno  ".$user->email);/*
              Mail::to($email)
                  ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
              $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              Log::info("Fin enviar Alumno");
            }
            break;
          case '4':
            for ($i=0; $i < count($this->tutorados) ; $i++) {
              $alumno = Alumno::join('user','alumno.idUser', '=','user.id' )
                  ->where('alumno.idAlumno', $this->tutorados[$i])->whereNotNull('email');
                  if ($alumno != null) {
                     Log::info($i);
                     Log::info("enviar Alumno  ".$alumno->email);/*
                     Mail::to($alumno)
                          ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
                     $alumno->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
                     Log::info("Fin enviar Alumno ".$i);
                 }else{
                    Log::info('ALumno no tiene correo');
                 }
            }
            break;
          case '8': case '9':
            $users = User::where('idTipoPersona', '3')->whereNotNull('email');
            $i=0;
            foreach ($users as $user) {
              $i++;
              Log::info($i);
              Log::info("enviar Alumno  ".$user->email);
              $user->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));
              /*Mail::to($user)
                  ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeA));*/
              Log::info("Fin enviar Alumno");
            }
            break;
        }
      }
      Log::info("enviar Responsable");
      $this->userResp->notify(new ActividadProgramadaNotif($this->actividad, $this->mensajeR));
      /*Mail::to($this->userResp->email)
          ->send(new ActividadProgramadaNotif($this->actividad, $this->mensajeR));*/
      Log::info("Fin enviar Responsable");
    }
}
