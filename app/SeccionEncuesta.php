<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class SeccionEncuesta extends Model
{
    protected $table = 'SeccionEncuesta';
    protected $primaryKey = 'idSeccion';
    protected $fillable = ['titulo', 'descripcion', 'orden', 'estado', 'idEncuesta'];
    public $timestamps = false;
    
    public function preguntas(){
      return $this->hasMany('BienestarWeb\PreguntaEncuesta','idSeccion');
   }

   public function encuesta(){
      return $this->belongsTo('BienestarWeb\Encuesta', 'idEncuesta');
   }
}
