<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use BienestarWeb\User;

use BienestarWeb\Notifications\NotificacionHabitoEstudio;

class JobMailHabitosEstudios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $encuestasUsers = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $encuestasUsers)
    {
        $this->encuestasUsers = $encuestasUsers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       if (count($this->encuestasUsers)!=0) {
         for ($i=0; $i < count($this->encuestasUsers) ; $i++) {
           $url = url('miembro/member_show/'.$this->encuestasUsers[$i]['idEncuestaRespondida']);
           $user = User::findOrFail($this->encuestasUsers[$i]['idUser']);
           $user->notify( new NotificacionHabitoEstudio($user , $url) );
         }
       }
    }
}
