<?php

namespace BienestarWeb\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Log;
use BienestarWeb\Actividad;

class ActividadActualizadaNotif extends Notification
{
    use Queueable;

    private $actividad;
    private $subject;
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct(Actividad $actividad, $subject)
    {
         $this->actividad = $actividad;
         $this->subject = $subject ;
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
        Log::info('ActividadActualizadaNotificacion');
        return $this->markdown('emails.actividadActualizadaEmail',['actividad' => $this->actividad])
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
