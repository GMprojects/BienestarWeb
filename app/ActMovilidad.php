<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class ActMovilidad extends Model
{
    protected $table = 'ActMovilidad';
    protected $primaryKey = 'idActMovilidad';
    protected $fillable = [
      'fechaInicioConvocatoria',
      'fechaFinConvocatoria',
      'idActividad'];

    public $timestamps = true;

    public function actividad(){
        return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }
    public function alumnos(){
        return $this->belongsToMany('BienestarWeb\Alumno','beneficiarioMovilidad','idActMovilidad','idAlumno')
                    ->withPivot('idBeneficiarioMovilidad','fechaInicio','fechaFin','duracionMeses','duracionAnio','institucion','pais','observaciones')
                    ->withTimestamps();
    }
}
