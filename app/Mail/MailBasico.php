<?php

namespace BienestarWeb\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailBasico extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    private $mensaje;
    private $url;
    private $accion;
    private $nombreEmisor;
    private $nombreReceptor;
    private $sexoReceptor;
    private $mailEmisor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $mensaje, $url, $accion, $nombreEmisor, $nombreReceptor, $sexoReceptor, $mailEmisor)
    {
        $this->subject = $subject;
        $this->mensaje = $mensaje;
        $this->url = $url;
        $this->accion = $accion;
        $this->nombreEmisor = $nombreEmisor;
        $this->nombreReceptor = $nombreReceptor;
        $this->sexoReceptor = $sexoReceptor;
        $this->mailEmisor = $mailEmisor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from($this->mailEmisor)
                  ->markdown('emails.mailBasico',[ 'subject' => $this->subject,
                                                   'mensaje' => $this->mensaje,
                                                   'url' => $this->url,
                                                   'accion' => $this->accion,
                                                   'nombreEmisor' => $this->nombreEmisor,
                                                   'nombreReceptor' => $this->nombreReceptor,
                                                   'sexoReceptor' => $this->sexoReceptor ])
                  ->subject($this->subject);
    }
}
