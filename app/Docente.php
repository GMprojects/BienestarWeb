<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'Docente';
    protected $primaryKey = 'idDocente';
    protected $fillable = [
      'categoria',
      'dedicacion',
      'modalidad',
      'idUser'];

    public $timestamps = true;

    public function user(){
    	   return $this->belongsTo('BienestarWeb\User','idUser');
    }
    public function tutorados(){
        return $this->belongsToMany('BienestarWeb\Alumno','tutorTutorado','idDocente','idAlumno')
              ->withPivot('idTutorTutorado','anioSemestre','numeroSemestre','habitoEstudioRespondido');
    }
    public function inscripcionesDocente(){
      return $this->belongsToMany('BienestarWeb\InscripcionADA','inscripcionDocente','idDocente','idInscripcionADA')
            ->withPivot('idInscDocente','asistencia','idActividad');
    }
    public function horariosDisponible(){
      return $this->hasMany('BienestarWeb\HorarioDisponible','idDocente');
    }
}
