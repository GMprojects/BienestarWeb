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
        Schema::create('BeneficiarioMovilidad', function(Blueprint $tabla)
        {
            $tabla->increments('idBeneficiarioMovilidad');
            $tabla->date('fechaInicio');
            $tabla->date('fechaFin');
            $tabla->tinyInteger('duracionMeses');
            $tabla->tinyInteger('duracionAnio');
            $tabla->string('institucion', 100);
            $tabla->string('pais', 45);
            $tabla->mediumtext('observaciones')->nullable();

            //Clave foranea de la tabla ActMovilidad
            /*$tabla->integer('idActMovilidad')->unsigned();
            $tabla->foreign('idActMovilidad')->references('idActMovilidad')->on('ActMovilidad');*/

            //Clave foranea de la tabla actividad
            $tabla->integer('idActividad')->unsigned();
            $tabla->foreign('idActividad')->references('idActividad')->on('Actividad');

            //Clave foranea de la tabla Alumno
            $tabla->integer('idAlumno')->unsigned();
            $tabla->foreign('idAlumno')->references('idAlumno')->on('Alumno');

            $tabla->timestamps();
        });

        Schema::create('EvidenciaMovilidad', function(Blueprint $tabla)
        {
            $tabla->increments('idEvidenciaMovilidad');
            $tabla->string('nombre', 100)->default('Evidencia');
            $tabla->mediumtext('ruta');

            //Clave foranea de la tabla Alumno
            $tabla->integer('idBeneficiarioMovilidad')->unsigned();
            $tabla->foreign('idBeneficiarioMovilidad')->references('idBeneficiarioMovilidad')->on('BeneficiarioMovilidad');

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
        Schema::dropIfExists('BeneficiarioMovilidad');
        Schema::dropIfExists('EvidenciaMovilidad');
    }
}
