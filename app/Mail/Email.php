<?php

namespace BienestarWeb\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
class Email extends Mailable
{
    use Queueable, SerializesModels;


    public $subject;
    private $mensaje;
    private $remitente;
    private $opcion;
    private $nombreDestinatario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $mensaje, $remitente, $opcion, $nombreDestinatario)
    {
         $this->mensaje = $mensaje;
         $this->subject = $subject;
         $this->remitente = $remitente;
         $this->opcion = $opcion;
         $this->nombreDestinatario = $nombreDestinatario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info("Email");
        Log::info("Remitente");
        Log::info($this->remitente);
        Log::info("Email Remitente    ".$this->remitente->email);
        $nombreRemitente = $this->remitente->nombre.' '.$this->remitente->apellidoPaterno.' '.$this->remitente->apellidoMaterno;

        return $this->from($this->remitente->email)
                    ->markdown('emails.emailSimple',['subject' => $this->subject,
                                                     'mensaje' => $this->mensaje,
                                                     'remitente' => $nombreRemitente,
                                                     'destinatario' => $this->nombreDestinatario,
                                                     'opcion' => $this->opcion ])
                    ->subject($this->subject);
    }
}
