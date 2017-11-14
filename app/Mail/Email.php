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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $mensaje, $remitente)
    {
         $this->mensaje = $mensaje;
         $this->subject = $subject;
         $this->remitente = $remitente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info('Email');
        return $this->markdown('emails.emailSimple',['subject' => $this->subject, 'mensaje' => $this->mensaje, 'remitente' => $this->remitente])
                    ->subject($this->subject);
    }
}
