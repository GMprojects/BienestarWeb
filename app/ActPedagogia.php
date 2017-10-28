<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class ActPedagogia extends Model
{
    protected $table = 'ActPedagogia';
    protected $primaryKey = 'idActPedagogia';
    protected $fillable = [
      'formaTutoria',
      'canalizacion',
      'idActividad'];

    public $timestamps = true;

    public function actividad(){
        return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }
    public function recomendacionesTutor(){
        return $this->belongsToMany('BienestarWeb\RecomendacionTutor','detallePedagogia','idActPedagogia','idRecomendacionTutor')
                    ->withPivot('idDetallePedagogia','motivo','situacionEspecifica','recomendacion')
                    ->withTimestamps();
    }


}
