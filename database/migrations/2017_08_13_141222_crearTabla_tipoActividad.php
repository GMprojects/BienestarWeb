<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTipoActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoActividad', function(Blueprint $tabla)
        {
            $tabla->increments('idTipoActividad');
            $tabla->string('tipo', 45)->unique();
            $tabla->string('dirigidoA', 4);
            /*
                Categoría:
                1. ActAtencionMedica
                2. ActPsicologia
                3. ActServicioSocial
                4. ActPedagogia
                5. ActDeportes
                6. ActCulturales
                7. ActEsparcimiento
                8. ActMovilidad
                9. ActComedor
                10. ActReforzamiento
            */
            $tabla->mediumtext('rutaImagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoActividad');
    }
}
