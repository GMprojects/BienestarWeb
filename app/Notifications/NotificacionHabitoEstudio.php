<?php

namespace BienestarWeb\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificacionHabitoEstudio extends Notification
{
    use Queueable;
    private $user;
    private $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct ($user, $url)
    {
          $this->user = $user;
          $this->url = $url;
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
        return (new MailMessage)->markdown('emails.mailBasico',[ 'subject' => 'Registrar Hábito de Estudio',
                                                                 'mensaje' => 'Se le pide por favor que llene la encuesta de hábito de estudio, la cual es muy necesaria para las próximas sesiones de tutoría.',
                                                                 'url' => $this->url,
                                                                 'accion' => 'Llenar Hábito de Estudio',
                                                                 'nombreEmisor' => null,
                                                                 'nombreReceptor' => $this->user->nombre.' '.$this->user->apellidoPaterno.' '.$this->user->apellidoMaterno,
                                                                 'sexoReceptor' => $this->user->sexo ])
                                ->subject('Registrar Hábito de Estudio');
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
