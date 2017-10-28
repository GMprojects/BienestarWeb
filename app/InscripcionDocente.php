<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class InscripcionDocente extends Model
{
    protected $table = 'InscripcionDocente';
    protected $primaryKey = 'idInscripcionDocente';
    protected $fillable = [
      'asistencia',
      'idActividad',
      'idDocente',
      'idInscripcionADA'];

    public $timestamps = true;

    public function actividad(){
      return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }
}
