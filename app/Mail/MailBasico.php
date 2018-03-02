<?php

namespace BienestarWeb\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailBasico extends Mailable
{
    use Queueable, SerializesModels;

    private $subject;
    private $mensaje;
    private $url;
    private $nombreEmisor;
    private $nombreReceptor;
    private $sexoReceptor;
    private $mailReceptor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $mensaje, $url, $nombreEmisor, $nombreReceptor, $sexoReceptor, $mailReceptor)
    {
        $this->subject = $subject;
        $this->mensaje = $mensaje;
        $this->url = $url;
        $this->nombreEmisor = $nombreEmisor;
        $this->nombreReceptor = $nombreReceptor;
        $this->sexoReceptor = $sexoReceptor;
        $this->mailReceptor = $mailReceptor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from($this->mailReceptor)
                  ->markdown('emails.mailBasico',[ 'subject' => $this->subject,
                                                   'mensaje' => $this->mensaje,
                                                   'url' => $this->url,
                                                   'nombreEmisor' => $this->nombreEmisor,
                                                   'nombreReceptor' => $this->nombreReceptor,
                                                   'sexoReceptor' => $this->sexoReceptor ])
                  ->subject($this->subject);
    }
}
