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
   public function docente(){
      return $this->belongsTo('BienestarWeb\Docente', 'idDocente');
   }
   public function inscripcionADA(){
     return $this->belongsTo('BienestarWeb\InscripcionADA','idInscripcionADA');
   }
}
