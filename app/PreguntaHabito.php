<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class PreguntaHabito extends Model
{
    protected $table = 'PreguntaHabito';
    protected $primaryKey = 'idPreguntaHabito';
    protected $fillable = ['enunciado','idTipoHabito'];

    public $timestamps = false;

    public function tipoHabito(){
        return $this->belongsTo('BienestarWeb\TipoHabito','idTipoHabito');
    }

    public function habitosEstudio(){
        return $this->belongsToMany('BienestarWeb\HabitoEstudio','detalleHabito','idPreguntaHabito','idHabitoEstudio')
            ->withPivot('idDetalleHabito','rpta');
    }

	public function scopeSearch($query, $enunciado){
    	return $query->where('enunciado','LIKE',"%$enunciado%")
                    ->orderBy('idPreguntaHabito', 'ASC');
    }

}
