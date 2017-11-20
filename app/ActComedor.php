<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class ActComedor extends Model
{
  protected $table = 'ActComedor';
  protected $primaryKey = 'idActComedor';
  protected $fillable = [
    'fechaConvocatoria',
    'idActividad'];

  public $timestamps = true;

  public function actividad(){
      return $this->belongsTo('BienestarWeb\Actividad','idActividad');
  }
  public function beneficiariosComedor(){
      return $this->belongsToMany('BienestarWeb\Alumno','beneficiarioComedor','idActComedor','idAlumno')
                  ->withPivot('idBeneficiarioComedor','fechaBeneficio','tipoBeneficio')
                  ->withTimestamps();
  }
}
