<?php

namespace BienestarWeb\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailVerificacion extends Mailable
{
    use Queueable, SerializesModels;

    private $nombreApellido;
    private $email;
    private $confirmation_code;
    private $sexo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreApellido, $email, $confirmation_code, $sexo)
    {
        $this->nombreApellido = $nombreApellido;
        $this->email = $email;
        $this->confirmation_code = $confirmation_code;
        $this->sexo = $sexo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from($this->email)
                      ->markdown('emails.mailCodigoVerificacion',['destinatario' => $this->nombreApellido,
                                                                 'sexo' => $this->sexo,
                                                                 'confirmation_code' => $this->confirmation_code ])
                      ->subject('Por favor confirme su email');
    }
}
