<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


use BienestarWeb\Mail\ActividadActualizadaMail;
use BienestarWeb\Notifications\ActividadActualizadaNotif;
use BienestarWeb\Actividad;
use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionAdministrativo;
use BienestarWeb\InscripcionDocente;
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
        Log::info("enviar Responsable");
        $this->userResp->notify(new ActividadActualizadaNotif($this->actividad));
        //Mail::to($this->userResp->email)
                    //  ->send(new ActividadActualizadaMail($this->actividad, $this->mensajeR));
        Log::info($this->userResp->email);
        Log::info("Fin enviar Responsable");
        Log::info("Enviar correo a los inscritos");
        //verificar si existe inscripciones de Alumnos
        $inscripcionesAlumnos = InscripcionAlumno::where('idActividad', $this->actividad->idActividad)->get();
        //verificar si existe inscripciones de Administrativos
        $inscripcionesAdministrativos = InscripcionAdministrativo::where('idActividad', $this->actividad->idActividad)->get();
        //verificar si existe inscripciones de Docentes
        $inscripcionesDocentes = InscripcionDocente::where('idActividad', $this->actividad->idActividad)->get();
        //--------------------------------------------------------------------------------------------------------------------
        if($inscripcionesAlumnos != null){
          $i = 0;
          foreach ($inscripcionesAlumnos as $inscripcionAlumno) {
            $alumnos[$i] = $inscripcionAlumno->alumno;
            $i++;
          }
        }else {
          $alumnos = array();
        }
        if($inscripcionesAdministrativos != null){
          $i = 0;
          foreach ($inscripcionesAdministrativos as $inscripcionAdministrativo) {
            $administrativos[$i] = $inscripcionAdministrativo->administrativo;
            $i++;
          }
        }else {
          $administrativos = array();
        }
        if($inscripcionesDocentes != null){
          $i = 0;
          foreach ($inscripcionesDocentes as $inscripcionDocente) {
            $docentes[$i] = $inscripcionDocente->docente;
            $i++;
          }
        }else {
          $docentes = array();
        }
        $users = array_merge($alumnos, $administrativos);
        $users = array_merge($users, $docentes);
        if ($this->opcion == '1') {
          $subject = 'Actividad Actualizada';
        } else {
          $subject = 'Actividad Cancelada';
        }
        //-----------enviar los emails-------------------------------------------------------------------------
        Log::info('Enviar Correos');
        foreach ($users as $user) {
          Log::info($user);
          $user->notify(new ActividadActualizadaNotif($this->actividad));
          //Mail::to($email)->send(new ActividadActualizadaMail($this->actividad, $this->mensajeA));
        }
        Log::info("Fin Enviar Correos");
    }
}
