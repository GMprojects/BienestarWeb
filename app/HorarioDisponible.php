<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class HorarioDisponible extends Model
{
    protected $table = 'HorarioDisponible';
    protected $primaryKey = 'idHorarioDisponible';
    protected $fillable = [
        'dia',
        'horaInicio',
        'horaFin',
        'lugar',
        'anioSemestre',
        'numeroSemestre',
        'idDocente'
    ];

    public $timestamps = true;

    public function docente(){
       return $this->belongsTo('BienestarWeb\Docente','idDocente');
    }
}
