<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaActMovilidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ActMovilidad', function(Blueprint $tabla)
        {
            $tabla->increments('idActMovilidad');
            $tabla->date('fechaInicioConvocatoria');
            $tabla->date('fechaFinConvocatoria');

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
        Schema::dropIfExists('ActMovilidad');
    }
}
