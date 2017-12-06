<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class HabitoEstudio extends Model
{
    protected $table = 'HabitoEstudio';
    protected $primaryKey = 'idHabitoEstudio';
    protected $fillable = ['idTutorTutorado'];

    public $timestamps = true;

    public function tutorTutorado(){
        return $this->belongsTo('BienestarWeb\TutorTutorado','idTutorTutorado','idTutorTutorado');
    }
    public function respuestasHabito(){
        return $this->belongsToMany('BienestarWeb\PreguntaHabito','detalleHabito','idHabitoEstudio','idPreguntaHabito')
            ->withPivot('idDetalleHabito','rpta');
    }
	  public function scopeSearch($query, $idTutorTutorado){
    	return $query->where('idTutorTutorado','=',"%$idTutorTutorado%")
                ->has('tutorTutorado.habitoEstudioLlenado','=',0);
    }
}
