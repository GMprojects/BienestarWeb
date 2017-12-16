<?php

namespace BienestarWeb\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Log;

use BienestarWeb\User;

class HabitoEstudioNotif extends Notification
{
    use Queueable;
    private $user;
    private $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( User $user, $url)
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
      Log::info('HabitoEstudioNotification');
      return (new MailMessage)->markdown('emails.habitoEstudioEmail',['user' => $this->user,
                                                                       'url' => $this->url ])
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
