<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailer;

use BienestarWeb\Mail\Email;

use BienestarWeb\User;
use Log;

class JobEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $idReceptor;
    private $mensaje;
    public $subject;
    private $idUserRemitente;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idReceptor, $mensaje, $subject, $idUserRemitente)
    {
         $this->idReceptor = $idReceptor;
         $this->mensaje = $mensaje;
         $this->subject = $subject;
         $this->idUserRemitente = $idUserRemitente;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         Log::info("enviar Email Simple");
         $receptorEmail = User::where('id', $this->idReceptor)->value('email');
         $remitente = User::findOrFail($this->idUserRemitente);
         $nombreRemitente = $remitente->nombre.' '.$remitente->apellidoPaterno.' '.$remitente->apellidoMaterno;
         Mail::to($receptorEmail)
              ->send(new Email($this->subject, $this->mensaje, $nombreRemitente));
    }
}
