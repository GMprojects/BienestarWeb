<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class InscripcionAlumno extends Model
{
    protected $table = 'InscripcionAlumno';
    protected $primaryKey = 'idInscripcionAlumno';
    protected $fillable = [
      'asistencia',
      'idActividad',
      'idAlumno',
      'idInscripcionADA'];

    public $timestamps = true;

   public function actividad(){
      return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }

   public function alumno(){
      return $this->belongsTo('BienestarWeb\Alumno', 'idAlumno');
   }
}
