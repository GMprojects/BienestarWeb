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
  public function enuestasRespondidaResp(){
      return $this->belongsToMany('BienestarWeb\EncuestaRespondidaResp','rptaencuestainsc','idPreguntaEncuesta','idEncuestaRespondidaResp')
                  ->withPivot('respuesta');
  }
  public function enuestasRespondidaInsc(){
      return $this->belongsToMany('BienestarWeb\EncuestaRespondidaInsc','rptaencuestaresp','idPreguntaEncuesta','idEncuestaRespondidaInsc')
                  ->withPivot('respuesta');
  }

}
