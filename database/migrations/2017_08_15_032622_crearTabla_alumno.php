<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Alumno', function(Blueprint $tabla)
        {
            $tabla->increments('idAlumno');
            $tabla->enum('condicion', ['1', '2', '3']);
            /*
                Alumno:
                m. Matriculado
                n. No Matriculado
                e. Egresado
            */

            //Clave foranea de la tabla Persona
            $tabla->integer('idPersona')->unsigned();
            $tabla->foreign('idPersona')->references('idPersona')->on('Persona');
            
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
        Schema::dropIfExists('Alumno');
    }
}
