<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTriggerEliminarCupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared('
           CREATE TRIGGER eliminarCupo AFTER DELETE ON `farmaciabd`.`inscripcionADA` FOR EACH ROW
            BEGIN
              SET @idActividadGrupal = (SELECT actGrupal.idActGrupal FROM actGrupal WHERE actGrupal.idActividad = OLD.idActividad);
              IF (@idActividadGrupal !=  0) THEN BEGIN
              UPDATE actGrupal SET cuposOcupados = cuposOcupados - 1, cuposDisponibles = cuposDisponibles + 1
                  WHERE actGrupal.idActGrupal = @idActividadGrupal;
              END; END IF;
            END
           ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::unprepared('
           CREATE TRIGGER eliminarCupo AFTER DELETE ON `farmaciabd`.`inscripcionADA` FOR EACH ROW
            BEGIN
              SET @idActividadGrupal = (SELECT actGrupal.idActGrupal FROM actGrupal WHERE actGrupal.idActividad = OLD.idActividad);
              IF (@idActividadGrupal !=  0) THEN BEGIN
              UPDATE actGrupal SET cuposOcupados = cuposOcupados - 1, cuposDisponibles = cuposDisponibles + 1
                  WHERE actGrupal.idActGrupal = @idActividadGrupal;
              END; END IF;
            END
           ');
    }
}
