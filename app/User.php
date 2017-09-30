<?php

namespace BienestarWeb;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
