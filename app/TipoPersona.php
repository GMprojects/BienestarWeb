<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    protected $table = 'TipoPersona';
    protected $primaryKey = 'idTipoPersona';
    protected $fillable = ['tipo'];

    public $timestamps = false;

    public function personas(){
    	return $this->hasMany('BienestarWeb\Persona');
    }

    public function scopeSearch($query, $tipo){
    	return $query->where('tipo','LIKE',"%$tipo%")
                    ->orderBy('idTipoPersona', 'ASC');
    }
}
