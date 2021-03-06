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
        Schema::create('BeneficiarioComedor', function(Blueprint $tabla)
        {
            $tabla->increments('idBeneficiarioComedor');
            $tabla->date('fechaBeneficio');
            $tabla->enum('tipoBeneficio', ['1', '2', '3', '4']);
            /*
                tipoBeneficiario:
                1. Beca
                2. MediaBeca
                3. Especial
            */

            //Clave foranea de la tabla ActComedor
            /*$tabla->integer('idActComedor')->unsigned();
            $tabla->foreign('idActComedor')->references('idActComedor')->on('ActComedor');*/

            //Clave foranea de la tabla actividad
            $tabla->integer('idActividad')->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad');

            //Clave foranea de la tabla Alumno
            $tabla->integer('idAlumno')->unsigned();
            $tabla->foreign('idAlumno')->references('idAlumno')->on('Alumno');

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
