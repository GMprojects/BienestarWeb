<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class EncuestaRespondidaInsc extends Model
{
      protected $table = 'EncuestaRespondidaInsc';
      protected $primaryKey = 'idEncuestaRespondidaInsc';
      protected $fillable = [
        'idActividad',
        'idInscripcionADA',
        'idEncuesta',
        'estado'];

      public $timestamps = true;

      public function preguntas(){
        return $this->belongsToMany('BienestarWeb\PreguntaEncuesta','rptaencuestainsc','idEncuestaRespondidaInsc','idPreguntaEncuesta')
                      ->withPivot('respuesta');
      }
      public function encuesta(){
        return $this->belongsTo('BienestarWeb\Encuesta', 'idEncuesta');
     }
     public function inscripcionADA(){
       return $this->belongsTo('BienestarWeb\InscripcionADA','idInscripcionADA');
     }
}
