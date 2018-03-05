<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSemestre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Semestre', function(Blueprint $tabla)
         {
              $tabla->increments('idSemestre');
              $tabla->date('fechaInicio');
              $tabla->date('fechaFin');
              $tabla->smallInteger('anioSemestre');
              $tabla->enum('numeroSemestre', [1, 2]);
              $tabla->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Semestre');
    }
}
