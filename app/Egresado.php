<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Egresado extends Model
{
    protected $table = 'Egresado';
    protected $primaryKey = 'idEgresado';
    protected $fillable = [
        'nombre',
        'apellidoPateno',
        'apellidoMaterno',
        'direccion',
        'telefono',
        'celular',
        'email',
        'codigo',
        'anioEgreso',
        'numeroSemestre'
	];
	public $timestamps = true;

	public function trabajos(){
		return $this->hasMany('BienestarWeb\Trabajo','idEgresado');
	}


  public function scopeSearch($query, $texto) {
      return $query
          ->where('idEgresado', '=', $texto)
          ->orwhere('apellidoPaterno', 'LIKE', "%$texto%")
          ->orderBy('idEgresado', 'asc');
  }
  
}
