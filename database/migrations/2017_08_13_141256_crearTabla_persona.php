<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Persona', function(Blueprint $tabla)
        {
            $tabla->increments('idPersona');
            $tabla->string('nombre', 45);
            $tabla->string('apellidoPaterno', 20);
            $tabla->string('apellidoMaterno', 20);
            $tabla->string('codigo', 20)->unique();
            $tabla->string('email', 100);
            $tabla->string('direccion', 100)->nullable();
            $tabla->string('telefono', 15)->nullable();
            $tabla->string('celular', 15)->nullable();
            $tabla->mediumtext('foto');
            $tabla->enum('funcion', ['1', '2', '3']);
            /*
                Funcion (tipo de usuario)
                1. Miembro/usuario (docente, administrativo y alumno)
                2. Programador
                3. Administrador
            */
            $tabla->enum('estado', [0,1]);
            /*
            estado
            0. Inactivo
            1. Activo
            */

            //Clave foranea de la tabla TipoPersona
            $tabla->integer('idTipoPersona')->unsigned();
            $tabla->foreign('idTipoPersona')->references('idTipoPersona')->on('TipoPersona');

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
        Schema::dropIfExists('Persona');
    }
}
