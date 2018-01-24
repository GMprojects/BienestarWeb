<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
  protected $table = 'Alternativa';
  protected $primaryKey = 'idAlternativa';
  protected $fillable = ['etiqueta', 'valor', 'idEncuesta'];
  public $timestamps = false;

  public function encuesta(){
    return $this->belongsTo('BienestarWeb\Encuesta','idEncuesta');
  }

  public function scopeSearch($query, $texto){
    return $query
        ->where('idEncuesta', '=', $texto)
        ->orderBy('idAlternativa', 'ASC');
  }

}
