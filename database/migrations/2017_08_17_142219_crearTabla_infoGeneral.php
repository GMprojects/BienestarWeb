<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInfoGeneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InfoGeneral', function(Blueprint $tabla)
        {
            $tabla->increments('idInfoGeneral');
            $tabla->enum('sexo', ['0', '1']);
            /*
                Sexo:
                0. Hombre
                1. Mujer
            */
            $tabla->date('fechaNacimiento');
            $tabla->enum('estadoCivil', ['1', '2', '3', '4']);
            /*
                Estado Civil:
                1. Soltero
                2. Casado
                3. Viudo
                4. Divorciado
            */
            $tabla->string('ocupacion', 50);
            $tabla->string('nombreApoderado', 50)->nullable();
            $tabla->string('apellidoApoderado', 50)->nullable();
            $tabla->enum('relacionApoderado', ['1', '2', '3', '4', '5', '6']);
            /*
                Relacion Apoderado:
                1. Padre
                2. Madre
                3. Tio/a
                4. Abuelo/a
                5. Hermano/a
                6. Otro
            */
            $tabla->string('telefonoApoderado', 15)->nullable();
            $tabla->mediumtext('planVida');
            $tabla->mediumtext('planInmediato');
            $tabla->mediumtext('metasVida');

            //Clave foranea de la tabla Alumno
            $tabla->integer('idAlumno')->unsigned();
            $tabla->foreign('idAlumno')->references('idAlumno')->on('Alumno')
               ->onDelete('cascade');

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
        Schema::dropIfExists('InfoGeneral');
    }
}
