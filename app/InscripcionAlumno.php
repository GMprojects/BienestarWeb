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

    public function alumno(){
      return $this->belongsTo('BienestarWeb\Alumno','idAlumno');
    }

    public function inscripcionADA(){
      return $this->belongsTo('BienestarWeb\InscripcionADA','idInscripcionADA');
    }

    public function actividadesPedagogia(){
      return $this->hasMany('BienestarWeb\ActPedagogia','idInscripcionAlumno');
    }
}
