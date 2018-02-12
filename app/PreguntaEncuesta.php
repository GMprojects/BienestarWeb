<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class PreguntaEncuesta extends Model
{
  protected $table = 'PreguntaEncuesta';
  protected $primaryKey = 'idPregunta';
  protected $fillable = ['enunciado', 'orden', 'idSeccion', 'idEncuesta'];
  public $timestamps = false;

  public function encuesta(){
    return $this->belongsTo('BienestarWeb\Encuesta','idEncuesta');
  }

  public function seccion(){
     return $this->belongsTo('BienestarWeb\SeccionEncuesta', 'idSeccion');
 }
  /*
  public function scopeSearch($query, $texto){
    //dd($texto);
    return $query->where('idEncuesta', '=', $texto)
                ->orderBy('idPreguntaEncuesta', 'ASC');
  }
  public function enuestasRespondidaResp(){
      return $this->belongsToMany('BienestarWeb\EncuestaRespondidaResp','rptaencuestainsc','idPreguntaEncuesta','idEncuestaRespondidaResp')
                  ->withPivot('respuesta');
  }
  public function enuestasRespondidaInsc(){
      return $this->belongsToMany('BienestarWeb\EncuestaRespondidaInsc','rptaencuestaresp','idPreguntaEncuesta','idEncuestaRespondidaInsc')
                  ->withPivot('respuesta');
  }*/

   public function enuestasRespondidas(){
   return $this->belongsToMany('BienestarWeb\EncuestaRespondida','rptaencuesta','idPregunta','idEncuestaRespondida')
      ->withPivot('respuesta');
   }
}
