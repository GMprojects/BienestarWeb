<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
  protected $table = 'Encuesta';
  protected $primaryKey = 'idEncuesta';
  protected $fillable = ['titulo', 'destino', 'idTipoActividad'];
  public $timestamps = false;

  public function preguntas(){
    return $this->hasMany('BienestarWeb\PreguntaEncuesta','idEncuesta');
  }
  public function tipoActividad(){
    return $this->belongsTo('BienestarWeb\TipoActividad','idTipoActividad');
  }
  public function alternativas(){
    return $this->hasMany('BienestarWeb\Alternativa','idEncuesta');
  }
  public function actividades(){
    return $this->belongsToMany('BienestarWeb\Actividad','encuestaRespondidaResp','idEncuesta','idActividad')
        ->withPivot('idEncuestaRespondidaResp')
        ->withTimestamps();
  }
  public function inscripcionesADA(){
    return $this->belongsToMany('BienestarWeb\InscripcionADA','encuestaRespondidaInsc','idEncuesta','idInscripcionADA')
        ->withPivot('idEncuestaRespondidaInsc')
        ->withTimestamps();
  }


  public function scopeSearch($query, $titulo){
    	return $query->where('titulo','LIKE',"%$titulo%")
                    ->orderBy('idEncuesta', 'ASC');
  }

}
