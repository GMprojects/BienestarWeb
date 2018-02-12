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
            $tabla->mediumtext('descripcion')->nullable();
            $tabla->enum('pred', ['0', '1'])->default('0');  //0: no predeterminada, 1: predeterminada
            $tabla->integer('tipo')->default(1);
            /*tipo
               1: Asociada a un TIPO DE Actividad
               2: LIBRE
            */
            $tabla->string('destino', 4);
            /*
               destino
                  unicos:
                  r = Responsable
                  i = Inscrito
               concatanables:
                  1 = Alumnos
                  2 = Docentes
                  3 = Administrativos
            */

            //Clave foranea de la tabla TipoActividad
            //puede ser null porque no todas las encuestas están asociadas a una actividad
            $tabla->integer('idTipoActividad')->nullable()->unsigned();
            $tabla->foreign('idTipoActividad')->references('idTipoActividad')->on('TipoActividad')->onDelete('cascade');

            $tabla->timestamps();
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

        Schema::create('SeccionEncuesta', function(Blueprint $tabla)
        {
            $tabla->increments('idSeccion');
            $tabla->string('titulo', 250);
            $tabla->mediumtext('descripcion')->nullable();
            $tabla->integer('orden')->default(0);
            $tabla->integer('estado')->default('1');
            //0 desactivada
            //1 activada

            //Clave foranea de la tabla Encuesta
            $tabla->integer('idEncuesta')->unsigned();
            $tabla->foreign('idEncuesta')->references('idEncuesta')->on('Encuesta')->onDelete('cascade');
        });

        Schema::create('PreguntaEncuesta', function(Blueprint $tabla)
        {
            $tabla->increments('idPregunta');
            $tabla->mediumtext('enunciado');
            $tabla->integer('orden')->default(0);
            $tabla->integer('estado')->default('1');
            /*
            estado:
               0 - 'eliminada'
               1 - 'no eliminada'
            */
            //Clave foranea de la tabla SeccionEncuesta
            $tabla->integer('idSeccion')->nullable()->unsigned();
            $tabla->foreign('idSeccion')->references('idSeccion')->on('SeccionEncuesta')->onDelete('cascade');

            //Clave foranea de la tabla Encuesta
            $tabla->integer('idEncuesta')->unsigned();
            $tabla->foreign('idEncuesta')->references('idEncuesta')->on('Encuesta')->onDelete('cascade');

        });


        Schema::create('EncuestaRespondida', function(Blueprint $tabla)
        {
            $tabla->increments('idEncuestaRespondida');
            $tabla->integer('estado')->default(0);
            //0 no respondida
            //1 respondida

            //Clave foranea de la tabla User
            $tabla->integer('idUser')->unsigned();
            $tabla->foreign('idUser')->references('id')->on('User')->onDelete('cascade');

            //Clave foranea de la tabla Encuesta
            $tabla->integer('idEncuesta')->unsigned();
            $tabla->foreign('idEncuesta')->references('idEncuesta')->on('Encuesta')->onDelete('cascade');

            //Clave foranea de la tabla Actividad
            //Encuestas que están relacionadas con el tipoActividad
            $tabla->integer('idActividad')->nullable()->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad')->onDelete('cascade');

            $tabla->integer('idTutorTutorado')->nullable()->unsigned();
            $tabla->foreign('idTutorTutorado')->references('idTutorTutorado')->on('TutorTutorado')->onDelete('cascade');

            $tabla->timestamps();
        });

        Schema::create('RptaEncuesta', function(Blueprint $tabla)
        {
            $tabla->increments('idRptaEncuesta');
            $tabla->string('respuesta', 20);

            //Clave foranea de la tabla EncuestaRespondida
            $tabla->integer('idEncuestaRespondida')->unsigned();
            $tabla->foreign('idEncuestaRespondida')->references('idEncuestaRespondida')->on('EncuestaRespondida')->onDelete('cascade');

            //Clave foranea de la tabla PreguntaEncuesta
            $tabla->integer('idPregunta')->unsigned();
            $tabla->foreign('idPregunta')->references('idPregunta')->on('PreguntaEncuesta')->onDelete('cascade');
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
        Schema::dropIfExists('SeccionEncuesta');
        Schema::dropIfExists('PreguntaEncuesta');
        Schema::dropIfExists('EncuestaRespondida');
        Schema::dropIfExists('RptaEncuesta');
    }
}
