<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInscripcionADA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
        Asistencia:
        1. Asistio
        0. Falto
    */
    public function up()
    {
        Schema::create('InscripcionADA', function(Blueprint $tabla)
        {
            $tabla->increments('idInscripcionADA');

            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad')->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad');


            $tabla->timestamps();

        });


        Schema::create('InscripcionAlumno', function(Blueprint $tabla)
        {
            $tabla->increments('idInscAlumno');
            $tabla->enum('asistencia', ['0', '1']);

            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad');
            
            //Clave foranea de la tabla Alumno
            $tabla->integer('idAlumno')->unsigned();
            $tabla->foreign('idAlumno')->references('idAlumno')->on('Alumno');

            //Clave foranea de la tabla InscripcionADA
            $tabla->integer('idInscripcionADA')->unsigned();
            $tabla->foreign('idInscripcionADA')->references('idInscripcionADA')->on('InscripcionADA');

            $tabla->timestamps();

        });

        Schema::create('InscripcionDocente', function(Blueprint $tabla)
        {
            $tabla->increments('idInscDocente');
            $tabla->enum('asistencia', ['0', '1']);

            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad');

            //Clave foranea de la tabla Docente
            $tabla->integer('idDocente')->unsigned();
            $tabla->foreign('idDocente')->references('idDocente')->on('Docente');

            //Clave foranea de la tabla InscripcionADA
            $tabla->integer('idInscripcionADA')->unsigned();
            $tabla->foreign('idInscripcionADA')->references('idInscripcionADA')->on('InscripcionADA');

            $tabla->timestamps();

        });

        Schema::create('InscripcionAdministrativo', function(Blueprint $tabla)
        {
            $tabla->increments('idInscAdministrativo');
            $tabla->enum('asistencia', ['0', '1']);

            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad');

            //Clave foranea de la tabla Administrativo
            $tabla->integer('idAdministrativo')->unsigned();
            $tabla->foreign('idAdministrativo')->references('idAdministrativo')->on('Administrativo');

            //Clave foranea de la tabla InscripcionADA
            $tabla->integer('idInscripcionADA')->unsigned();
            $tabla->foreign('idInscripcionADA')->references('idInscripcionADA')->on('InscripcionADA');

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
        Schema::dropIfExists('InscripcionADA');
        Schema::dropIfExists('InscripcionAlumno');
        Schema::dropIfExists('InscripcionDocente');
        Schema::dropIfExists('InscripcionAdministrativo');
    }
}
