<?php

namespace BienestarWeb\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificacionActividad extends Notification
{
    use Queueable;

    private $subject;
    private $actividad;
    private $mensaje;
    private $sexo;
    private $url;
    private $nombres;
    private $soyResponsable;
    private $soyInscrito;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, Actividad $actividad,  $mensaje, $sexo, $url, $nombres, $soyResponsable, $soyInscrito)
    {
        $this->subject = $subject;
        $this->actividad = $actividad;
        $this->mensaje = $mensaje;
        $this->sexo = $sexo;
        $this->url = $url;
        $this->nombres = $nombres;
        $this->soyResponsable = $soyResponsable;
        $this->soyInscrito = $soyInscrito;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('emails.mailActividad',[ 'subject' => $this->subject,
                                                                    'actividad' => $this->actividad,
                                                                    'mensaje' => $this->mensaje,
                                                                    'sexo' => $this->sexo,
                                                                    'url' => $this->url,
                                                                    'nombres' => $this->nombres,
                                                                    'soyResponsable' => $this->soyResponsable,
                                                                    'soyInscrito' => $this->soyInscrito ])
                               ->subject($this->subject);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
