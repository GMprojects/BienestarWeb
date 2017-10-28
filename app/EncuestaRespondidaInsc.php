<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EncuestaRespondidaInsc extends Pivot
{
    protected $table = 'EncuestaRespondidaInsc';
    protected $primaryKey = 'idEncuestaRespondidaInsc';
    protected $fillable = [
      'idActividad',
      'idEncuesta'];

    public $timestamps = true;

    public function preguntasEncuesta(){
        return $this->belongsToMany('BienestarWeb\PreguntaEncuesta','rptaEncuestaInsc','idEncuestaRespondidaInsc','idPreguntaEncuesta')
                    ->withPivot('idRptaEncuestaInsc','rpta');
    }
}
