<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class PreguntaEncuesta extends Model
{
  protected $table = 'PreguntaEncuesta';
  protected $primaryKey = 'idPreguntaEncuesta';
  protected $fillable = ['enunciado', 'idEncuesta'];
  public $timestamps = false;

  public function encuesta(){
    return $this->belongsTo('BienestarWeb\Encuesta','idEncuesta');
  }
  public function scopeSearch($query, $texto){
    //dd($texto);
    return $query->where('idEncuesta', '=', $texto)
                ->orderBy('idPreguntaEncuesta', 'ASC');
  }
  public function enuestasRespondidasResp(){
      return $this->belongsToMany('BienestarWeb\EncuestaRespondidaResp','rptaEncuestaResp','idPreguntaEncuesta','idEncuestaRespondidaResp')
                  ->withPivot('idRptaEncuestaResp','rpta');
  }
  public function enuestasRespondidasInsc(){
      return $this->belongsToMany('BienestarWeb\EncuestaRespondidaInsc','rptaEncuestaInsc','idPreguntaEncuesta','idEncuestaRespondidaInsc')
                  ->withPivot('idRptaEncuestaInsc','rpta');
  }


  public function scopeFiltroEnunciado($query, $idEncuesta, $enunciado){
      //dd($texto);
      return $query
          ->where('idEncuesta', '=', $idEncuesta)
          ->where('enunciado','LIKE',"%$enunciado%")
          ->orderBy('idPreguntaEncuesta', 'ASC');
  }
}
