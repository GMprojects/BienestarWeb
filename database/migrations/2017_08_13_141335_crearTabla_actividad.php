<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Actividad', function(Blueprint $tabla)
        {
            $tabla->increments('idActividad');
            $tabla->string('titulo', 100);
            $tabla->date('fechaProgramacion');
            $tabla->time('horaProgramacion');
            $tabla->mediumtext('lugar');
            $tabla->date('fechaEjecutada')->nullable();
            $tabla->time('horaEjecutada')->nullable();
            $tabla->integer('cuposTotales');
            $tabla->enum('estado', ['1', '2', '3', '4']);
            /*  Estado:
                1. Programada
                2. Ejecutada
                3. Cancelada
                4. No Ejecutada
            */
            $tabla->smallInteger('anioSemestre');
            $tabla->enum('numeroSemestre', ['1', '2', '3']);
            $tabla->enum('modalidad', ['1', '2']);
            /*
                Modalidad:
                1. Individual
                2. Grupal
            */
            $tabla->string('observaciones', 500)->default('Ninguna');
            $tabla->string('recomendaciones', 500)->default('Ninguna');
            $tabla->mediumtext('rutaImagen');

            $tabla->string('invitado', 500);

            //Clave foranea de la tabla tipoActividad
            $tabla->integer('idTipoActividad')->unsigned();
            $tabla->foreign('idTipoActividad')->references('idTipoActividad')->on('TipoActividad');

            //Clave foranea de la tabla User para asignar un RESPONSABLE
            $tabla->integer('idResp')->unsigned();
            $tabla->foreign('idResp')->references('id')->on('User');

            //Clave foranea de la tabla User para definir un PROGRAMADOR
            $tabla->integer('idProg')->unsigned();
            $tabla->foreign('idProg')->references('id')->on('User');

            $tabla->timestamps();
        });

        Schema::create('EvidenciaActividad', function(Blueprint $tabla)
        {
            $tabla->increments('idEvidenciaActividad');
            $tabla->string('nombre', 50);
            $tabla->mediumtext('ruta');
            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad')->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad')
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
        Schema::dropIfExists('Actividad');
        Schema::dropIfExists('EvidenciaActividad');
    }
}
