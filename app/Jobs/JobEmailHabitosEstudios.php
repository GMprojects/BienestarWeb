<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\TutorTutorado;

use BienestarWeb\Notifications\HabitoEstudioNotif;

class JobEmailHabitosEstudios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $idDocente;
    private $anioSemestre;
    private $numeroSemestre;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idDocente, $anioSemestre, $numeroSemestre)
    {
        $this->idDocente = $idDocente;
        $this->anioSemestre = $anioSemestre;
        $this->numeroSemestre = $numeroSemestre;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         $users = User::join('alumno','user.id','=','alumno.idUser')
                        ->join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )
                        ->where([['tutorTutorado.idDocente', $this->idDocente], ['tutorTutorado.anioSemestre', $this->anioSemestre], ['tutorTutorado.numeroSemestre', $this->numeroSemestre], ['tutorTutorado.habitoEstudioRespondido', '0'], ['confirmed', '=', 1]])
                        ->get();
         //-----------enviar los emails------------------------------------------------------------------------
         //"Enviar correo a los inscritos "
         if (count($users)!=0) {
            foreach ($users as $user) {
                 $url = url(route('habitoEstudio.create'));
                 $user->notify(new HabitoEstudioNotif($user, $url));
            }
         }
         //Fin Enviar Correos;

    }
}
