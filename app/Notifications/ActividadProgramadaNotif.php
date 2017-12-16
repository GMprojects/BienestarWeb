<?php

namespace BienestarWeb\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Log;
use BienestarWeb\Actividad;

class ActividadProgramadaNotif extends Notification
{
    use Queueable;

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
    public function __construct(Actividad $actividad,  $mensaje, $sexo, $url, $nombres, $soyResponsable, $soyInscrito)
    {
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
        /*return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');*/
        Log::info('ActividadProgramadaNotificacion');
        return (new MailMessage)->markdown('emails.actividadProgramadaEmail',['actividad' => $this->actividad,
                                                                              'mensaje' => $this->mensaje,
                                                                              'sexo' => $this->sexo,
                                                                              'url' => $this->url,
                                                                              'nombres' => $this->nombres,
                                                                              'soyResponsable' => $this->soyResponsable,
                                                                              'soyInscrito' => $this->soyInscrito  ])
                                ->subject('Nueva Programada Actividad');
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
