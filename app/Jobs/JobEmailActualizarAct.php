<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notifiable;

use BienestarWeb\Notifications\ActividadActualizadaNotif;
use BienestarWeb\Actividad;
use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;
use Log;

class JobEmailActualizarAct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $actividad;
    private $userResp;
    private $opcion;
    /*Opcion
    -1 - solo actualizada
    -2 - cancelada*/
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Actividad $actividad, User $userResp, $opcion)
    {
        $this->actividad = $actividad;
        $this->userResp = $userResp;
        $this->opcion = $opcion;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         //Log::info("---------------------------------------------------------------------------------- ");
         if ($this->opcion == '1') {
              $subject = 'Actividad Actualizada';
         } elseif($this->opcion == '2') {
              $subject = 'Actividad Cancelada';
         } else {
              $subject = 'Actividad Eliminada';
         }
        //Log::info("JobEmailActualizarAct ");
        //Log::info("Inicio enviar Responsable");
        $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
        $this->userResp->notify(new ActividadActualizadaNotif($this->actividad, $subject, $url));
        //Log::info($this->userResp->email);
        //Log::info("Fin enviar Responsable");
        // -------------------------------------------------------------------------------------------------------------------
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
            $alumnos[$i] = $inscripcionAlumno->alumno->user;
            $i++;
          }
        }else {
          $alumnos = array();
        }
        if(count($inscripcionesAdministrativos)>0){
          $i = 0;
          foreach ($inscripcionesAdministrativos as $inscripcionAdministrativo) {
            $administrativos[$i] = $inscripcionAdministrativo->administrativo->user;
            $i++;
          }
        }else {
          $administrativos = array();
        }
        if(count($inscripcionesDocentes)>0){
          $i = 0;
          foreach ($inscripcionesDocentes as $inscripcionDocente) {
            $docentes[$i] = $inscripcionDocente->docente->user;
            $i++;
          }
        }else {
          $docentes = array();
        }
        $users = array_merge($alumnos, $administrativos);
        $users = array_merge($users, $docentes);

        //-----------enviar los emails-------------------------------------------------------------------------
        //Log::info("---------------------------------------------------------------------------------- ");
        //Log::info("Enviar correo a los inscritos ");
        foreach ($users as $user) {
             //Log::info($user->email);
             $url = action('ActividadController@member_show', ['id'=> $this->actividad->idActividad]);
             $user->notify(new ActividadActualizadaNotif($this->actividad, $subject, $url));
        }
        //Log::info("Fin Enviar Correos");
    }
}
