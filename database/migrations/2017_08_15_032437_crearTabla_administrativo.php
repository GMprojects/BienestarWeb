<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAdministrativo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Administrativo', function(Blueprint $tabla)
        {
            $tabla->increments('idAdministrativo');
            $tabla->string('cargo', 50);
            
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
        Schema::dropIfExists('Administrativo');
    }
}
