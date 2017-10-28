<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class InscripcionAdministrativo extends Model
{
    protected $table = 'InscripcionAdministrativo';
    protected $primaryKey = 'idInscripcionAdministrativo';
    protected $fillable = [
      'asistencia',
      'idActividad',
      'idAdministrativo',
      'idInscripcionADA'];

    public $timestamps = true;

    public function actividad(){
      return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }
}
