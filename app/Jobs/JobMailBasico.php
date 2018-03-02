<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailer;
//Mail
use BienestarWeb\Mail\MailBasico;
//Models
use BienestarWeb\User;

class JobMailBasico implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $idUserEmisor;
    private $idUserReceptor;
    private $subject;
    private $mensaje;
    private $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idUserEmisor, $idUserReceptor, $subject, $mensaje, $url, $accion)
    {
        $this->idUserEmisor = $idUserEmisor;
        $this->idUserReceptor = $idUserReceptor;
        $this->subject = $subject;
        $this->mensaje = $mensaje;
        $this->url = $url;
        $this->accion = $accion;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userEmisor = User::findOrFail($this->idUserEmisor);
        $userReceptor = User::findOrFail($this->idUserReceptor);

        $nombreEmisor = $userEmisor->nombre.' '.$userEmisor->apellidoPaterno.' '.$userEmisor->apellidoMaterno;
        $nombreReceptor = $userReceptor->nombre.' '.$userReceptor->apellidoPaterno.' '.$userReceptor->apellidoMaterno;

        if ($userReceptor->confirmed) {
           Mail::to($userReceptor->email)
                ->send(new MailBasico($this->subject, $this->mensaje, $this->url, $this->accion, $nombreEmisor, $nombreReceptor, $userReceptor->sexo, $userReceptor->mail));
        }
    }
}
