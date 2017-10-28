<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class ActGrupal extends Model
{
    protected $table = 'ActGrupal';
    protected $primaryKey = 'idActGrupal';
    protected $fillable = [
      'cuposDisponibles',
      'cuposOcupados',
      'idActividad'];

    public $timestamps = true;

    public function actividad(){
        return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }
}
