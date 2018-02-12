<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEgresado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Egresado', function(Blueprint $tabla)
        {
            $tabla->increments('idEgresado');
            $tabla->enum('grado', ['1', '2', '3', '4']);
            /*
                Grado:
                1. Bachiller
                2. Magister
                3. Doctor
                4. Doctor Filósofo
            */
            $tabla->string('nombre', 45);
            $tabla->string('apellidoPaterno', 25);
            $tabla->string('apellidoMaterno', 25);
            $tabla->string('direccion', 100)->nullable();
            $tabla->string('telefono', 15)->nullable();
            $tabla->string('celular', 15)->nullable();
            $tabla->string('email', 100)->nullable();
            $tabla->string('codigo', 20)->unique();
            $tabla->smallInteger('anioEgreso');
            $tabla->enum('numeroSemestre', ['1', '2', '3']);
            $tabla->timestamps();

        });

        Schema::create('Trabajo', function(Blueprint $tabla)
        {
            $tabla->increments('idTrabajo');
            $tabla->string('institucion', 100);
            $tabla->string('lugar', 100);
            $tabla->date('fechaInicio');
            $tabla->date('fechaFin')->nullable();
            $tabla->integer('nivelSatisfaccion');
            $tabla->mediumtext('recomendaciones')->nullable();
            $tabla->mediumtext('observaciones')->nullable();

            //Clave foranea de la tabla Egresado
            $tabla->integer('idEgresado')->unsigned();
            $tabla->foreign('idEgresado')->references('idEgresado')->on('Egresado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Egresado');
        Schema::dropIfExists('Trabajo');
    }
}
