<?php

namespace BienestarWeb\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailer;

use BienestarWeb\Mail\ActividadProgramadaMail;

use BienestarWeb\Actividad;
use BienestarWeb\Persona;
use Log;
class Trabajo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $act = Actividad::findOrFail('1');
      Log::info('Enviar Correo -- 1');
      Mail::to('mfernanda.mgl95@gmail.com')
          ->send(new ActividadProgramadaMail($act,'Bla'));
      Log::info('Fin Enviar Correo -- 2');
    }
}
