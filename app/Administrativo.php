<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $table = 'Administrativo';
    protected $primaryKey = 'idAdministrativo';
    protected $fillable = [
    'cargo',
    'idUser'
    ];

    public $timestamps = true;

    public function user(){
    	return $this->belongsTo('BienestarWeb\User','idUser');
    }

    /*public function inscripcionesAdministrativo(){
      return $this->belongsToMany('BienestarWeb\InscripcionADA','inscripcionAdministrativo','idAdministrativo','idInscripcionADA')
            ->withPivot('idInscAdministrativo','asistencia','idActividad');
    }*/

    public function misInscripciones(){
      return $this->hasMany('BienestarWeb\InscripcionAdministrativo', 'idAdministrativo');
   }
}
