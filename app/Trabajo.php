<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $table = 'Trabajo';
    protected $primaryKey = 'idTrabajo';
    protected $fillable = [
        'institucion',
        'lugar',
        'fechaInicio',
        'fechaFin',
        'nivelSatisfaccion',
        'recomendaciones',
        'observaciones',
        'idEgresado'
    ];
    public $timestamps = false;

    public function egresado(){
    	  return $this->belongsTo('BienestarWeb\Egresado','idEgresado');
    }

    public function scopeSearchEgresado($query, $idEgresado){
        //dd($texto);
        return $query
            ->where('idEgresado', '=', $idEgresado)
            ->orderBy('idTrabajo', 'ASC');
    }

    public function scopeSearchEgresadoInstitucion($query, $idEgresado, $institucion){
        //dd($texto);
        return $query
            ->where('idEgresado', '=', $idEgresado)
            ->where('institucion','LIKE',"%$institucion%")
            ->orderBy('idTrabajo', 'ASC');
    }

    public function scopeSearchInstitucion($query, $institucion){
        //dd($texto);
        return $query
            ->where('institucion','LIKE',"%$institucion%")
            ->orderBy('idTrabajo', 'ASC');
    }

    public function scopeSearch($query, $request){
      if($request->institucion != null && $request->idEgresado != null){
        return $query
            ->where('idEgresado', '=', $request->idEgresado)
            ->where('institucion','LIKE',"%$request->institucion%")
            ->orderBy('idTrabajo', 'ASC');
      }else if($request->institucion == null && $request->idEgresado != null){
        return $query
            ->where('idEgresado', '=', $request->idEgresado)
            ->orderBy('idTrabajo', 'ASC');
      }else{
        return $query
            ->where('institucion','LIKE',"%$request->institucion%")
            ->orderBy('idTrabajo', 'ASC');
      }
    }

}
