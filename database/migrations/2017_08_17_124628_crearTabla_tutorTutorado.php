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

            $tabla->enum('habitoEstudioRespondido', [0, 1])->default('0');
            //Clave foranea de la tabla Alumno
            $tabla->integer('idAlumno')->unsigned();
            $tabla->foreign('idAlumno')->references('idAlumno')->on('Alumno');

            //Clave foranea de la tabla Docente
            $tabla->integer('idDocente')->unsigned();
            $tabla->foreign('idDocente')->references('idDocente')->on('Docente');

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
        Schema::dropIfExists('TutorTutorado');
    }
}
