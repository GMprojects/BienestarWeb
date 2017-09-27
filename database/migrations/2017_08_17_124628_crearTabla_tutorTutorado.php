<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTutorTutorado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TutorTutorado', function(Blueprint $tabla)
        {
            $tabla->increments('idTutorTutorado');
            $tabla->smallInteger('anioSemestre');
            $tabla->enum('numeroSemestre', [1, 2]);

            //Clave foranea de la tabla Alumno
            $tabla->integer('idAlumno')->unsigned();
            $tabla->foreign('idAlumno')->references('idAlumno')->on('Alumno')
               ->onDelete('cascade');

            //Clave foranea de la tabla Docente
            $tabla->integer('idDocente')->unsigned();
            $tabla->foreign('idDocente')->references('idDocente')->on('Docente')
               ->onDelete('cascade');

            $tabla->timestamps();

        });

        Schema::create('HabitoEstudio', function(Blueprint $tabla)
        {
            $tabla->increments('idHabitoEstudio');

            //Clave foranea de la tabla TutorTutorado
            $tabla->integer('idTutorTutorado')->unsigned();
            $tabla->foreign('idTutorTutorado')->references('idTutorTutorado')->on('TutorTutorado')
               ->onDelete('cascade');

            $tabla->timestamps();
        });

        Schema::create('TipoHabito', function(Blueprint $tabla)
        {
            $tabla->increments('idTipoHabito');
            $tabla->String('tipo', 50);
        });

        Schema::create('PreguntaHabito', function(Blueprint $tabla)
        {
            $tabla->increments('idPreguntaHabito');
            $tabla->mediumtext('enunciado');

            //Clave foranea de la tabla CategoriaHabito
            $tabla->integer('idTipoHabito')->unsigned();
            $tabla->foreign('idTipoHabito')->references('idTipoHabito')->on('TipoHabito')
               ->onDelete('cascade');
        });

        Schema::create('DetalleHabito', function(Blueprint $tabla)
        {
                $tabla->increments('idDetalleHabito');
                $tabla->enum('rpta', ['1', '2', '3', '4']);
                /*
                    1. Nunca
                    2. Pocas Veces
                    3. Muchas Veces
                    4. Siempre
                */

                //Clave foranea de la tabla HabitoEstudio
                $tabla->integer('idHabitoEstudio')->unsigned();
                $tabla->foreign('idHabitoEstudio')->references('idHabitoEstudio')->on('HabitoEstudio')
                  ->onDelete('cascade');

                //Clave foranea de la tabla HabitoEstudio
                $tabla->integer('idPreguntaHabito')->unsigned();
                $tabla->foreign('idPreguntaHabito')->references('idPreguntaHabito')->on('PreguntaHabito')
                  ->onDelete('cascade');
        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TutorTutorado');
        Schema::dropIfExists('HabitoEstudio');
        Schema::dropIfExists('DetalleHabito');
        Schema::dropIfExists('PreguntaHabito');
        Schema::dropIfExists('TipoHabito');
    }
}
