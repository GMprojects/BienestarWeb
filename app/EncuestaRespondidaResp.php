<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EncuestaRespondidaResp extends Pivot
{
    protected $table = 'EncuestaRespondidaResp';
    protected $primaryKey = 'idEncuestaRespondidaResp';
    protected $fillable = [
      'idActividad',
      'idEncuesta'];

    public $timestamps = true;

    public function preguntasEncuesta(){
        return $this->belongsToMany('BienestarWeb\PreguntaEncuesta','rptaEncuestaResp','idEncuestaRespondidaResp','idPreguntaEncuesta')
                    ->withPivot('idRptaEncuestaResp','rpta');
    }
}
