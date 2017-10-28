<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BeneficiarioMovilidad extends Pivot
{
    protected $table = 'BeneficiarioMovilidad';
    protected $primaryKey = 'idBeneficiarioMovilidad';
    protected $fillable = [
      'fechaInicio',
      'fechaFin',
      'duracionMeses',
      'duracionAnio',
      'institucion',
      'pais',
      'observaciones'];

    public $timestamps = true;

    public function evidenciasMovilidad(){
        return $this->hasMany('BienestarWeb\EvidenciaMovilidad','idBeneficiarioMovilidad');
    }
}
