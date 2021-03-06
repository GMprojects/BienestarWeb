<?php

namespace BienestarWeb;
/*
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
class User extends Model implements Authenticatable, CanResetPasswordContract
{
    use Notifiable;
    use CanResetPasswordContract;
*/

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
    protected $table='user';
    protected $primaryKey = 'id';
    protected $fillable = [
      'id',
      'email',
      'password',
      'nombre',
      'apellidoPaterno',
      'apellidoMaterno',
      'fechaNacimiento',
      'sexo',
      'codigo',
      'direccion',
      'telefono',
      'celular',
      'foto',
      'funcion',
      'estado',
      'changed_pass',
      'confirmed',
      'confirmation_code',
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
    	return $this->hasOne('BienestarWeb\Administrativo', 'idUser');
    }

    public function docente()
    {
    	return $this->hasOne('BienestarWeb\Docente', 'idUser');
    }

    public function alumno()
    {
    	return $this->hasOne('BienestarWeb\Alumno', 'idUser');
    }

    public function actividadesProgramador()
    {
        return $this->hasMany('BienestarWeb\Actividad', 'idUserProg');
    }

    public function actividadesResponsable()
    {
        return $this->hasMany('BienestarWeb\Actividad', 'idUserResp');
    }

    public function encuestasRespondidas()
    {
        return $this->hasMany('BienestarWeb\EncuestaRespondida', 'idUser');
    }

    public function encuestas()
    {
      return $this->hasMany('BienestarWeb\EncuestaRespondida', 'idUser');
    }
}
