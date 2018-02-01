<?php

namespace BienestarWeb\Mail;

use BienestarWeb\Actividad;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActividadActualizadaMail extends Mailable
{
    use Queueable, SerializesModels;

    private $actividad;
    private $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Actividad $actividad, $subject)
    {
          $this->actividad = $actividad;
          $this->subject = $subject ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //'ActividadActualizadaMail');
        return $this->markdown('emails.actividadActualizadaEmail',['actividad' => $this->actividad])
                    ->subject($this->subject);
    }
}
