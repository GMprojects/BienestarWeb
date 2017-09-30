<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
   protected $table = 'Persona';
   protected $primaryKey='idPersona';
   public $timestamps=true;
   protected $fillable = [
      'id',
      'email',
      'password',
      'nombre',
   	'apellidoPaterno',
   	'apellidoMaterno',
      'fechaNacimiento',
      'codigo',
   	'direccion',
      'telefono',
   	'celular',
      'foto',
   	'funcion',
   	'estado',
      'idTipoPersona'
   ];

    public function tipoPersona()
    {
    	return $this->belongsTo('BienestarWeb\tipoPersona');
    }

    public function administrativo()
    {
    	return $this->hasOne('BienestarWeb\Administrativo', 'idPersona');
    }

    public function docente()
    {
    	return $this->hasOne('BienestarWeb\Docente', 'idPersona');
    }

    public function alumno()
    {
    	return $this->hasOne('BienestarWeb\Alumno', 'idPersona');
    }

    public function programacionActividades()
    {
        return $this->hasMany('BienestarWeb\Actividad');
    }

    public function responsabilidadActividades()
    {
        return $this->hasMany('BienestarWeb\Actividad');
    }

    public function inscripcionActividades()
    {
        return $this->hasMany('BienestarWeb\Actividad');
    }
}
