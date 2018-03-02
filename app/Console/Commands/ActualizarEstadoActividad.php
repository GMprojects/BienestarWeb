<?php

namespace BienestarWeb\Console\Commands;

use Illuminate\Console\Command;
use BienestarWeb\Actividad;
use Carbon\Carbon;
//prueba
use Log;
use BienestarWeb\RecomendacionTutor;
//prubea
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
      /*$actividades = Actividad::get();
      $fechaActual = date("Y-m-j H:i:s");
      foreach ($actividades as $actividad) {
        if(($actividad->estado == '1') && ((intval((strtotime($actividad->fechaInicio) - strtotime(date('Y-m-d')))/86400)) < 0) ){
            Log::info($actividad->titulo);
            $actividad->estado = '4';
            $actividad->update();
        }
      }*/
      /*
      INSERT INTO `recomendaciontutor` (`idRecomendacionTutor`, `situacionEspecifica`, `recomendacion`) VALUES
      (1, 'Alto rendimiento académico.', 'Canalizar a cursos avanzados. Canalizar a la incorporación de grupos estudiantiles y de investigación.'),

      */
      $recomendacion = new RecomendacionTutor;
      $recomendacion->situacionEspecifica = 'situacionEspecificaPrueba';
      $recomendacion->recomendacion = 'situacionEspecificaPrueba';
      $recomendacion->save();

      $this->info("Se verifico la que actividades ya se vencieron el plazo :$");
    }
}
