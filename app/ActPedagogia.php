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
      'idInscripcionAlumno',
      'idActividad'];

    public $timestamps = true;

    public function actividad(){
      return $this->belongsTo('BienestarWeb\ActPedagogia','idActividad');
    }
    public function inscripcionAlumno(){
     return $this->belongsTo('BienestarWeb\ActPedagogia','idInscripcionAlumno');
    }
    public function detallesPedagogia(){
        return $this->hasMany('BienestarWeb\DetallePedagogia','idActPedagogia','idActPedagogia');
    }


}
