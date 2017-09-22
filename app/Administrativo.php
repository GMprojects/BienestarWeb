<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $table = 'Administrativo';
    protected $primaryKey = 'idAdministrativo';
    protected $fillable = [
    'cargo',
    'idPersona'
    ];

    public $timestamps = true;

    public function persona(){
    	return $this->belongsTo('BienestarWeb\Persona','idPersona');
    }

    public function inscripcionesAdministrativo(){
      return $this->belongsToMany('BienestarWeb\InscripcionADA','inscripcionAdministrativo','idAdministrativo','idInscripcionADA')
            ->withPivot('idInscAdministrativo','asistencia','idActividad');
    }
}
