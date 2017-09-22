<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDocente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Docente', function(Blueprint $tabla)
        {
            $tabla->increments('idDocente');
            $tabla->enum('categoria', ['1', '2', '3', '4']);
            /*
                Categoria: 
                1. Principal
                2. Asociado
                3. Auxiliar
                4. Contratado
            */
            $tabla->enum('dedicacion', ['1', '2', '3']);
            /*
                Dedicacion:
                1. Dedicación Exclusiva
                2. Tiempo Completo
                3. Tiempo Parcial
            */
            $tabla->enum('modalidad', ['1', '2']);
            /*
                Modalidad:
                1. Ordinario
                2. Contratado
            */
            
            //Clave foranea de la tabla Persona
            $tabla->integer('idPersona')->unsigned();
            $tabla->foreign('idPersona')->references('idPersona')->on('Persona');
            
            $tabla->timestamps();                        
        });

        Schema::create('HorarioDisponible', function(Blueprint $tabla)
        {
            $tabla->increments('idHorarioDisponible');
            $tabla->enum('dia', ['1', '2', '3', '4', '5', '6', '7']);         
            $tabla->time('horaInicio');
            $tabla->time('horaFin');
            $tabla->string('lugar', 100);
            $tabla->smallInteger('anioSemestre');
            $tabla->enum('numeroSemestre', ['1', '2', '3']);

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
        Schema::dropIfExists('HorarioDisponible');
    }
}
