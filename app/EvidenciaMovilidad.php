<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class EvidenciaMovilidad extends Model
{
    protected $table = 'EvidenciaMovilidad';
    protected $primaryKey = 'idEvidenciaMovilidad';
    protected $fillable = [
      'ruta',
      'idBeneficiarioMovilidad'];

    public $timestamps = true;

    public function evidenciasMovilidad(){
        return $this->belongsTo('BienestarWeb\BeneficiarioMovilidad','idBeneficiarioMovilidad');
    }
}
