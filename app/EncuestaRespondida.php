<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class EncuestaRespondida extends Model
{
      protected $table = 'EncuestaRespondida';
      protected $primaryKey = 'idEncuestaRespondida';
      protected $fillable =
      [  'estado',
         'idUser',
         'idEncuesta',
         'idActividad'
      ];
      //public $timestamps = true;

      public function encuesta(){
         return $this->belongsTo('BienestarWeb\Encuesta', 'idEncuesta');
      }
      public function actividad(){
         return $this->belongsTo('BienestarWeb\Actividad', 'idActividad');
      }
      public function tutorTutorado(){
         return $this->belongsTo('BienestarWeb\TutorTutorado', 'idTutorTutorado');
      }
      public function user(){
         return $this->belongsTo('BienestarWeb\user', 'id');
      }
      public function respuestas(){
         return $this->hasMany('BienestarWeb\RptaEncuesta', 'idEncuestaRespondida');
      }
}
