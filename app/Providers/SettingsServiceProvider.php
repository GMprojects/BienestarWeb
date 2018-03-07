<?php

namespace BienestarWeb\Providers;

use Illuminate\Support\ServiceProvider;

use BienestarWeb\Semestre;
use Carbon\Carbon;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $fechaActual = (Carbon::now())->format('Y-m-d');
        $semestres = Semestre::orderBy('fechaInicio')->get();
        $i = 0; $existe = false; $nroSem = count($semestres);
        while ($i < $nroSem && !$existe) {
          $fechaInicio = $semestres[$i]['fechaInicio'];
          $fechaFin = $semestres[$i]['fechaFin'];
          if (($fechaActual >= $fechaInicio) && ($fechaActual <= $fechaFin)) {
            $existe = true;
          } else {
            $existe = false;
          }
          $i++;
        }
        if ($existe) {//esta dentro del rango
          config()->set('semestre', $semestres[$i-1]->toArray());
        } else {//se obtiene el ultimo semestre
          config()->set('semestre', $semestres[$nroSem-1]->toArray());
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
