<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBeneficiarioComedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('BeneficiaroComedor', function(Blueprint $tabla)
        {
            $tabla->increments('idBeneficiaroComedor');
            $tabla->date('fechaBeneficio');
            $tabla->enum('tipoBeneficiario', ['1', '2', '3', '4']);
            /*
                tipoBeneficiario:
                1. Beca
                2. MediaBeca
                3. Especial
            */

            //Clave foranea de la tabla ActComedor
            $tabla->integer('idActComedor')->unsigned();
            $tabla->foreign('idActComedor')->references('idActComedor')->on('ActComedor')
               ->onDelete('cascade');

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
        Schema::dropIfExists('BeneficiarioComedor');
    }
}
