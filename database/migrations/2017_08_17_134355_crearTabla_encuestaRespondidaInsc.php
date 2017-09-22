<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEncuestaRespondidaInsc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EncuestaRespondidaInsc', function(Blueprint $tabla)
        {
            $tabla->increments('idEncuestaRespondidaInsc');            

            //Clave foranea de la tabla InscripcionADA
            $tabla->integer('idInscripcionADA')->unsigned();
            $tabla->foreign('idInscripcionADA')->references('idInscripcionADA')->on('InscripcionADA');

            //Clave foranea de la tabla Encuesta
            $tabla->integer('idEncuesta')->unsigned();
            $tabla->foreign('idEncuesta')->references('idEncuesta')->on('Encuesta');

            $tabla->timestamps();
        });

        Schema::create('RptaEncuestaInsc', function(Blueprint $tabla)
        {
            $tabla->increments('idRptaEncuestaInsc');
            $tabla->string('respuesta', 20);

            //Clave foranea de la tabla PreguntaEncuesta
            $tabla->integer('idPreguntaEncuesta')->unsigned();
            $tabla->foreign('idPreguntaEncuesta')->references('idPreguntaEncuesta')->on('PreguntaEncuesta');

            //Clave foranea de la tabla EncuestaRespondidaInsc
            $tabla->integer('idEncuestaRespondidaInsc')->unsigned();
            $tabla->foreign('idEncuestaRespondidaInsc')->references('idEncuestaRespondidaInsc')->on('EncuestaRespondidaInsc');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EncuestaRespondidaInsc');
        Schema::dropIfExists('RptaEncuestaInsc');
    }
}
