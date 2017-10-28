<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class RecomendacionTutor extends Model
{
    protected $table = 'RecomendacionTutor';
    protected $primaryKey = 'idRecomendacionTutor';
    protected $fillable = [
      'situacionEspecifica',
      'recomendacion'
    ];

    public $timestamps = true;

    public function actividadesPedagogia(){
        return $this->belongsToMany('BienestarWeb\ActPedagogia','detallePedagogia','idRecomendacionTutor','idActPedagogia')
                    ->withPivot('idDetallePedagogia','motivo','situacionEspecifica','recomendacion')
                    ->withTimestamps();
    }
}
