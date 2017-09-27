<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBeneficiarioMovilidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BeneficiaroMovilidad', function(Blueprint $tabla)
        {
            $tabla->increments('idBeneficiaroMovilidad');
            $tabla->date('fechaInicio');
            $tabla->date('fechaFin');
            $tabla->tinyInteger('duracionMeses');
            $tabla->tinyInteger('duracionAnio');
            $tabla->string('institucion', 100);
            $tabla->string('pais', 45);
            $tabla->mediumtext('observaciones');

            //Clave foranea de la tabla ActMovilidad
            $tabla->integer('idActMovilidad')->unsigned();
            $tabla->foreign('idActMovilidad')->references('idActMovilidad')->on('ActMovilidad')
               ->onDelete('cascade');

            //Clave foranea de la tabla Alumno
            $tabla->integer('idAlumno')->unsigned();
            $tabla->foreign('idAlumno')->references('idAlumno')->on('Alumno')
               ->onDelete('cascade');

            $tabla->timestamps();
        });

        Schema::create('EvidenciaMovilidad', function(Blueprint $tabla)
        {
            $tabla->increments('idEvidenciaMovilidad');
            $tabla->mediumtext('ruta');

            //Clave foranea de la tabla Alumno
            $tabla->integer('idBeneficiaroMovilidad')->unsigned();
            $tabla->foreign('idBeneficiaroMovilidad')->references('idBeneficiaroMovilidad')->on('BeneficiaroMovilidad')
               ->onDelete('cascade');;

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
        Schema::dropIfExists('BeneficiaroMovilidad');
        Schema::dropIfExists('EvidenciaMovilidad');
    }
}
