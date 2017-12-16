<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEncuestaRespondidaResp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EncuestaRespondidaResp', function(Blueprint $tabla)
        {
            $tabla->increments('idEncuestaRespondidaResp');
            $tabla->integer('estado')->default(0);
            /*
            estado:
            0. No Respondida
            1. Respondida
            2. Eliminada
            */
            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad')->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad');

            //Clave foranea de la tabla Encuesta
            $tabla->integer('idEncuesta')->unsigned();
            $tabla->foreign('idEncuesta')->references('idEncuesta')->on('Encuesta');

            $tabla->timestamps();
        });

        Schema::create('RptaEncuestaResp', function(Blueprint $tabla)
        {
            $tabla->increments('idRptaEncuestaResp');
            $tabla->string('respuesta', 20);

            //Clave foranea de la tabla PreguntaEncuesta
            $tabla->integer('idPreguntaEncuesta')->unsigned();
            $tabla->foreign('idPreguntaEncuesta')->references('idPreguntaEncuesta')->on('PreguntaEncuesta');

            //Clave foranea de la tabla EncuestaRespondidaResp
            $tabla->integer('idEncuestaRespondidaResp')->unsigned();
            $tabla->foreign('idEncuestaRespondidaResp')->references('idEncuestaRespondidaResp')->on('EncuestaRespondidaResp');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EncuestaRespondidaResp');
        Schema::dropIfExists('RptaEncuestaResp');
    }
}
