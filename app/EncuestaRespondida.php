<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class EncuestaRespondida extends Model
{
      protected $table = 'EncuestaRespondida';
      protected $primaryKey = 'idEncuestaRespondida';
      protected $fillable =
      [  'estado',
         'fh_envio',
         'fh_registro',
         'idUser',
         'idEncuesta',
         'idActividad'
      ];
      public $timestamps = true;

      public function encuesta(){
         return $this->belongsTo('BienestarWeb\Encuesta', 'idEncuesta');
      }
      public function actividad(){
         return $this->belongsTo('BienestarWeb\Actividad', 'idActividad');
      }
      public function user(){
         return $this->belongsTo('BienestarWeb\User', 'idUser');
      }
      public function preguntas(){
         return $this->belongsToMany( 'BienestarWeb\PreguntaEncuesta', 'rptaencuesta', 'idEncuestaRespondida', 'idPregunta')
         ->withPivot('respuesta');
      }
}
