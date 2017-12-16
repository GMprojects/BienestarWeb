<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'Alumno';
    protected $primaryKey = 'idAlumno';
    protected $fillable = [
      'condicion',
      'idUser'];
    public $timestamps = true;

    public function user(){
    	return $this->belongsTo('BienestarWeb\User', 'idUser');
    }
    public function tutores(){
      return $this->belongsToMany('BienestarWeb\Docente','tutorTutorado','idAlumno','idDocente')
            ->withPivot('idTutorTutorado','anioSemestre','numeroSemestre','habitoEstudioRespondido');
    }
    /*public function inscripcionesAlumno(){
      return $this->belongsToMany('BienestarWeb\InscripcionADA','inscripcionAlumno','idAlumno','idInscripcionADA')
            ->withPivot('idInscAlumno','asistencia','idActividad');
    }*/
    public function misInscripciones(){
      return $this->hasMany('BienestarWeb\InscripcionAlumno', 'idAlumno');
    }
    public function actividadesMovilidad(){
        return $this->belongsToMany('BienestarWeb\Actividad','beneficiarioMovilidad','idAlumno','idActividad')
                    ->withPivot('idBeneficiarioMovilidad','fechaInicio','fechaFin','duracionMeses','duracionAnio','institucion','pais','observaciones')
                    ->withTimestamps();
    }
    public function actividadesComedor(){
        return $this->belongsToMany('BienestarWeb\Actividad','beneficiarioComedor','idAlumno','idActividad')
                    ->withPivot('idBeneficiarioComedor','fechaBeneficio','tipoBeneficio')
                    ->withTimestamps();
    }
    public function soyTutorado(){
      return $this->hasMany('BienestarWeb\TutorTutorado', 'idAlumno');
   }
}
