<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class InscripcionADA extends Model
{
    protected $table = 'InscripcionADA';
    protected $primaryKey = 'idInscripcionADA';
    protected $fillable = [
        'idActividad'
      ];

    public $timestamps = true;

    public function actividad(){
      return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }
    public function inscripcionesAlumno(){
      return $this->belongsToMany('BienestarWeb\InscripcionAlumno','inscripcionAlumno','idInscripcionADA','idAlumno')
            ->withPivot('idInscAlumno','asistencia','idActividad');
    }
    public function inscripcionesDocente(){
      return $this->belongsToMany('BienestarWeb\InscripcionDocente','inscripcionDocente','idInscripcionADA','idAlumno')
            ->withPivot('idInscDocente','asistencia','idActividad');
    }
    public function inscripcionesAdministrativo(){
      return $this->belongsToMany('BienestarWeb\InscripcionAdministrativo','inscripcionAdministrativo','idInscripcionADA','idAlumno')
            ->withPivot('idInscAdministrativo','asistencia','idActividad');
    }
    public function encuestas(){
      return $this->belongsToMany('BiesnestarWeb\Encuesta','encuestaRespondidaInsc','idInscripcionADA','idEncuesta')
          ->withPivot('idEncuestaRespondidaInsc')
          ->withTimestamps();
    }

    public function scopeSearch($query, $idActividad){
      //dd($texto);
      return $query
          ->where('idActividad', '=', $idActividad)
          ->orderBy('idInscripcionADA', 'ASC');
    }


}
