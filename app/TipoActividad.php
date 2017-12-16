<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $table = 'TipoActividad';
    protected $primaryKey = 'idTipoActividad';
    protected $fillable = ['tipo', 'dirigidoA', 'rutaImagen'];
    public $timestamps = false;

    public function actividades(){
    	return $this->hasMany('BienestarWeb\Actividad');
    }

    public function encuestas(){
      return $this->hasMany('BienestarWeb\Encuesta');
    }

}
