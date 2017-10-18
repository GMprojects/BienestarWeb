<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class TipoHabito extends Model
{
    protected $table = 'TipoHabito';
    protected $primaryKey = 'idTipoHabito';
    protected $fillable = [
      'tipo',
      'estado'];

    public $timestamps = false;

    public function preguntasHabito(){
    	return $this->hasMany('BienestarWeb\PreguntaHabito','idTipoHabito');
    }

    public function scopeSearch($query, $tipo){
    	return $query->where('tipo','LIKE',"%$tipo%")
                    ->orderBy('idTipoHabito', 'ASC');
    }
}
