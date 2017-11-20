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
    private $subject;
    private $idUserRemitente;
    private $opcion;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($idReceptor, $mensaje, $subject, $idUserRemitente, $opcion)
    {
         $this->idReceptor = $idReceptor;
         $this->mensaje = $mensaje;
         $this->subject = $subject;
         $this->idUserRemitente = $idUserRemitente;
         $this->opcion = $opcion;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         Log::info("enviar Email Simple");
         Log::info("Subject    ".$this->subject);

         $destinatario = User::findOrFail($this->idReceptor);
         $nombreDestinatario = $destinatario->nombre.' '.$destinatario->apellidoPaterno.' '.$destinatario->apellidoMaterno;
         $remitente = User::findOrFail($this->idUserRemitente);

         Mail::to($destinatario->email)
              ->send(new Email($this->subject, $this->mensaje, $remitente, $this->opcion, $nombreDestinatario));
    }
}
