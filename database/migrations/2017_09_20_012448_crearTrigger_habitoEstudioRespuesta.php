<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTriggerHabitoEstudioRespuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared('
           CREATE TRIGGER habitoEstudioRespuesta AFTER INSERT ON `habitoEstudio` FOR EACH ROW
           BEGIN
             UPDATE tutorTutorado SET `habitoEstudioRespondido` = 1 WHERE tutorTutorado.idTutorTutorado = NEW.idTutorTutorado;
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
        DROP TRIGGER `habitoEstudioRespuesta`
     ');
    }
}
