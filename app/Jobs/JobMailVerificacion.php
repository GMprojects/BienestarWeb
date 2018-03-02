<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use BienestarWeb\Mail\MailVerificacion;

class JobMailVerificacion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $nombreApellido;
    private $email;
    private $confirmation_code;
    private $sexo;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         Mail::to($this->email)
              ->send(new MailVerificacion($this->nombreApellido, $this->email, $this->confirmation_code, $this->sexo));
    }
}
