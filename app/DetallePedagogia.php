<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class DetallePedagogia extends Model
{
    protected $table = 'DetallePedagogia';
    protected $primaryKey = 'idDetallePedagogia';
    protected $fillable = [
      'motivo',
      'situacionEspecifica',
      'recomendacion',
      'idActPedagogia'];

    public $timestamps = true;

    public function actividaPedagogia(){
        return $this->belongsTo('BienestarWeb\ActPedagogia','idActPedagogia');
    }


}
