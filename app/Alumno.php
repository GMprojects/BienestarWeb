<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'Alumno';
    protected $primaryKey = 'idAlumno';
    protected $fillable = [
      'condicion',
      'idPersona'];
    public $timestamps = true;

    public function persona(){
    	return $this->belongsTo('BienestarWeb\Persona', 'idPersona');
    }
    public function tutores(){
      return $this->belongsToMany('BienestarWeb\Docente','tutorTutorado','idAlumno','idDocente')
            ->withPivot('idTutorTutorado','anioSemestre','numeroSemestre','habitoEstudioRespondido');
    }
    public function inscripcionesAlumno(){
      return $this->belongsToMany('BienestarWeb\InscripcionADA','inscripcionAlumno','idAlumno','idInscripcionADA')
            ->withPivot('idInscAlumno','asistencia','idActividad');
    }
    public function actividadesMovilidad(){
        return $this->belongsToMany('BienestarWeb\ActMovilidad','beneficiarioMovilidad','idAlumno','idActMovilidad')
                    ->withPivot('idBeneficiarioMovilidad','fechaInicio','fechaFin','duracionMeses','duracionAnio','institucion','pais','observaciones')
                    ->withTimestamps();
    }
    public function actividadesComedor(){
        return $this->belongsToMany('BienestarWeb\ActComedor','beneficiarioComedor','idAlumno','idActComedor')
                    ->withPivot('idBeneficiarioComedor','fechaBeneficio','tipoBeneficio')
                    ->withTimestamps();
    }

}
