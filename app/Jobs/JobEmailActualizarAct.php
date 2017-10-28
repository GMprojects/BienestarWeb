<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailer;

use BienestarWeb\Mail\ActividadActualizadaMail;

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
            $emailAlumnos[$i] = $inscripcionAlumno->alumno->user['email'];
            $i++;
          }
        }else {
          $emailAlumnos = array();
        }
        if($inscripcionesAdministrativos != null){
          $i = 0;
          foreach ($inscripcionesAdministrativos as $inscripcionAdministrativo) {
            $emailAdministrativos[$i] = $inscripcionAdministrativo->administrativo->user['email'];
            $i++;
          }
        }else {
          $emailAdministrativos = array();
        }
        if($inscripcionesDocentes != null){
          $i = 0;
          foreach ($inscripcionesDocentes as $inscripcionDocente) {
            $emailDocentes[$i] = $inscripcionDocente->docente->user['email'];
            $i++;
          }
        }else {
          $emailDocentes = array();
        }
        $emails = array_merge($emailAlumnos, $emailAdministrativos);
        $emails = array_merge($emails, $emailDocentes);
        if ($this->opcion == '1') {
          $subject = 'Actividad Actualizada';
        } else {
          $subject = 'Actividad Cancelada';
        }
        //-----------enviar los emails-------------------------------------------------------------------------
        Log::info('Enviar Correos');
        foreach ($emails as $email) {
          Log::info($email);
          //Mail::to($email)->send(new ActividadActualizadaMail($this->actividad, $this->mensajeA));
        }
        Log::info("Fin Enviar Correos");


    }
}
