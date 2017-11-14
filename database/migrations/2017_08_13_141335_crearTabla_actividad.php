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
            $tabla->mediumtext('referencia')->nullable();
            $tabla->longText('descripcion');
            $tabla->longText('informacionAdicional')->nullable();
            $tabla->date('fechaEjecutada')->nullable();
            $tabla->time('horaEjecutada')->nullable();
            $tabla->integer('cuposTotales');
            $tabla->enum('estado', ['1', '2', '3', '4'])->default('1');
            /*  Estado:
                1. Programada    Pendiente
                2. Ejecutada     Ejecutada
                3. Cancelada     Cancelada
                4. No Ejecutada  Expirada
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
            $tabla->mediumtext('rutaImagen')->nullable();
            $tabla->string('invitado', 500)->nullable();
            //Clave foranea de la tabla tipoActividad
            $tabla->integer('idTipoActividad')->unsigned();
            $tabla->foreign('idTipoActividad')->references('idTipoActividad')->on('TipoActividad');

            //Clave foranea de la tabla Persona para asignar un RESPONSABLE
            $tabla->integer('idUserResp')->unsigned();
            $tabla->foreign('idUserResp')->references('id')->on('user');

            //Clave foranea de la tabla Persona para definir un PROGRAMADOR
            $tabla->integer('idUserProg')->unsigned();
            $tabla->foreign('idUserProg')->references('id')->on('user');

            $tabla->timestamps();
        });

        Schema::create('EvidenciaActividad', function(Blueprint $tabla)
        {
            $tabla->increments('idEvidenciaActividad');
            $tabla->string('nombre', 100)->default('Evidencia');
            $tabla->mediumtext('ruta')->nullable();
            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad')->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad');

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
