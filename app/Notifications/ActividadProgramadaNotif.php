<?php

namespace BienestarWeb\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use BienestarWeb\Actividad;

class ActividadProgramadaNotif extends Notification
{
    use Queueable;

    private $actividad;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Actividad $actividad)
    {
        $this->actividad = $actividad;
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
        return (new MailMessage)->markdown('emails.actividadProgramadaEmail')
                                ->with('actividad', $this->actividad)
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
