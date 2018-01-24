<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEncuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Encuesta', function(Blueprint $tabla)
        {
            $tabla->increments('idEncuesta');
            $tabla->string('titulo', 250);
            $tabla->enum('destino', ['r', 'i']);

            //Clave foranea de la tabla TipoActividad
            $tabla->integer('idTipoActividad')->unsigned();
            $tabla->foreign('idTipoActividad')->references('idTipoActividad')->on('TipoActividad')->onDelete('cascade');
        });

        Schema::create('Alternativa', function(Blueprint $tabla)
        {
            $tabla->increments('idAlternativa');
            $tabla->string('etiqueta', 20);
            $tabla->integer('valor')->default(0);
            //Clave foranea de la tabla Encuesta
            $tabla->integer('idEncuesta')->unsigned();
            $tabla->foreign('idEncuesta')->references('idEncuesta')->on('Encuesta')->onDelete('cascade');
        });

        Schema::create('PreguntaEncuesta', function(Blueprint $tabla)
        {
            $tabla->increments('idPreguntaEncuesta');
            $tabla->mediumtext('enunciado');
            $tabla->integer('orden')->default(0);
            $tabla->integer('estado')->default('1');
            //0 desactivada
            //1 activada

            //Clave foranea de la tabla Encuesta
            $tabla->integer('idEncuesta')->unsigned();
            $tabla->foreign('idEncuesta')->references('idEncuesta')->on('Encuesta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Encuesta');
        Schema::dropIfExists('Alternativa');
        Schema::dropIfExists('PreguntaEncuesta');
    }
}
