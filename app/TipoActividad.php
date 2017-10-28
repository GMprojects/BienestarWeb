<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $table = 'TipoActividad';
    protected $primaryKey = 'idTipoActividad';
    protected $fillable = ['tipo', 'rutaImagen'];
    public $timestamps = false;

    public function actividades(){
    	return $this->hasMany('BienestarWeb\Actividad');
    }

    public function encuestas(){
      return $this->hasMany('BienestarWeb\Encuesta');
    }

    public function scopeSearch($query, $tipo){
        return $query
        	->where('tipo','LIKE',"%$tipo%")
            ->orwhere('rutaImagen','LIKE',"%$tipo%")
            ->orderBy('idTipoActividad', 'desc');
    }

}
