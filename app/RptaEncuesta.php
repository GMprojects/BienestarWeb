<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class RptaEncuesta extends Model
{
    protected $table = 'RptaEncuesta';
    protected $primaryKey = 'idRptaEncuesta';
    protected $fillable = ['respuesta', 'idEncuestaRespondida', 'idPregunta'];
    public $timestamps = false;
   
}
