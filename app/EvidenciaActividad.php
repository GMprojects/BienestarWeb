<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class EvidenciaActividad extends Model
{
    protected $table = 'EvidenciaActividad';
    protected $primaryKey = 'idEvidenciaActividad';
    protected $fillable = [
        'ruta',
        'idActividad'
      ];

    public $timestamps = true;

    public function actividad() {
      return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }

    public function scopeSearch($query, $request){
      if($request->ruta != null){
        return $query
            ->where('idActividad','=',$request->idActividad)
            ->where('ruta','LIKE',"%$request->ruta%")
            ->orderBy('idEvidenciaActividad', 'ASC');
      }else{
        return $query
            ->where('idActividad','=',$request->idActividad)
            ->orderBy('idEvidenciaActividad', 'ASC');
      }
    }
}
