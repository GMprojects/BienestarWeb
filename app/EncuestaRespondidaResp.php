<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class EncuestaRespondidaResp extends Model
{
       protected $table = 'EncuestaRespondidaResp';
       protected $primaryKey = 'idEncuestaRespondidaResp';
       protected $fillable = [
         'idActividad',
         'idEncuesta',
         'estado'];
       public $timestamps = true;

       public function preguntas(){
           return $this->belongsToMany('BienestarWeb\PreguntaEncuesta','rptaencuestaresp','idEncuestaRespondidaResp','idPreguntaEncuesta')
                       ->withPivot('respuesta');
       }
       public function encuesta(){
         return $this->belongsTo('BienestarWeb\Encuesta', 'idEncuesta');
      }
      public function actividad(){
        return $this->belongsTo('BienestarWeb\Actividad', 'idActividad');
     }
}
