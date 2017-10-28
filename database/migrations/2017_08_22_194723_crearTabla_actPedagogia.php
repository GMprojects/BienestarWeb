<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaActPedagogia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ActPedagogia', function(Blueprint $tabla)
        {
            $tabla->increments('idActPedagogia');
            $tabla->enum('formaTutoria', ['1', '2', '3']);
            /*
                FormaTutoria:
                1. Presencial
                2. Telefono
                3. Correo
            */
            $tabla->enum('canalizacion', ['1', '2'])->nullable();
            /*
                Canalizacion:
                1. Medico
                2. Psicologico
            */

            //Clave foranea de la tabla Actividad
            $tabla->integer('idActividad')->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad')
               ->onDelete('cascade');

            $tabla->timestamps();
        });

        Schema::create('RecomendacionTutor', function(Blueprint $tabla)
        {
            $tabla->increments('idRecomendacionTutor');
            $tabla->mediumtext('situacionEspecifica');
            $tabla->mediumtext('recomendacion');

        });

        Schema::create('DetallePedagogia', function(Blueprint $tabla)
        {
            $tabla->increments('idDetallePedagogia');
            $tabla->mediumtext('motivo');
            $tabla->mediumtext('situacionEspecifica');
            $tabla->mediumtext('recomendacion');

            //Clave foranea de la tabla ActPedagogia
            $tabla->integer('idActPedagogia')->unsigned();
            $tabla->foreign('idActPedagogia')->references('idActPedagogia')->on('ActPedagogia')
               ->onDelete('cascade');

            //Clave foranea de la tabla RecomendacionTutor
            $tabla->integer('idRecomendacionTutor')->unsigned();
            $tabla->foreign('idRecomendacionTutor')->references('idRecomendacionTutor')->on('RecomendacionTutor')
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
        Schema::dropIfExists('ActPedagogia');
        Schema::dropIfExists('DetallePedagogia');
        Schema::dropIfExists('RecomendacionTutor');
    }
}
