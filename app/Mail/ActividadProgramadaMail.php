<?php

namespace BienestarWeb\Mail;

use BienestarWeb\Actividad;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActividadProgramadaMail extends Mailable
{
    use Queueable, SerializesModels;

    private $actividad;
    private $mensaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Actividad $actividad, $mensaje)
    {
          $this->actividad = $actividad;
          $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //'ActividadProgramadaMail'
        return $this->markdown('emails.actividadProgramadaEmail',['actividad' => $this->actividad, 'mensaje' => $this->mensaje])
                    ->subject('Nueva Actividad Programada ');
    }
}
