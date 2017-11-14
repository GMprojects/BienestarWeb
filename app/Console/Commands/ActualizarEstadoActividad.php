<?php

namespace BienestarWeb\Console\Commands;

use Illuminate\Console\Command;
use BienestarWeb\Actividad;

class ActualizarEstadoActividad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actividad:actualizarEstado';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambia el estado de la actividad cuando esta no cumplio su plazo de programación';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $actividades = Actividad::get();
      $fechaActual = date("Y-m-j H:i:s");
      foreach ($actividades as $actividad) {
          if(($actividad->fechaEjecucion == null) && ($fechaActual > $actividad->fechaProgramacion.' '.$actividad->horaProgramacion)){
                  $actividad->estado = '4';
                  $actividad->update();
          }
      }
      $this->info("Se verifico la que actividades ya se vencieron el plazo :$");
    }
}
