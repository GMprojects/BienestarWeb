<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;
use BienestarWeb\Administrativo;
use BienestarWeb\InscripcionADA;
use BienestarWeb\Docente;
use BienestarWeb\Alumno;
use BienestarWeb\User;

class Actividad extends Model
{
   	protected $table = 'Actividad';
      protected $primaryKey = 'idActividad';
   	protected $fillable = [
         'titulo',
         'fechaInicio',
         'horaInicio',
         'fechaFin',
         'horaFin',
         'lugar',
         'referencia',
         'descripcion',
         'informacionAdicional',
         'fechaEjecutada',
         'horaEjecutada',
         'cuposTotales',
         'estado',
         'anioSemestre',
         'numeroSemestre',
         'modalidad',
         'recomendaciones',
         'observaciones',
         'rutaImagen',
         'idTipoActividad',
         'idUserResp',
         'idUserProg',
         'invitado'
      ];

    public $timestamps = true;

	public function tipoActividad()	{
		return $this->belongsTo('BienestarWeb\tipoActividad','idTipoActividad');
	}
    public function evidenciasActividad(){
      return $this->hasMany('BienestarWeb\EvidenciaActividad','idActividad');
    }
    public function responsable(){
      return $this->belongsTo('BienestarWeb\User','idUserResp');
    }
    public function programador(){
      return $this->belongsTo('BienestarWeb\User','idUserProg');
    }
    public function inscripcionesADA(){
      return $this->hasMany('BienestarWeb\InscripcionADA','idActividad');
    }
    /*public function encuestas(){
      return $this->belongsToMany('BienestarWeb\Encuesta','encuestaRespondidaResp','idActividad','idEncuesta')
          ->withPivot('idEncuestaRespondidaResp')
          ->withTimestamps();
    }*/
    public function encuestaResponsable(){
      return $this->belongsToMany('BienestarWeb\Encuesta','encuestaRespondidaResp','idActividad','idEncuesta')
          ->withPivot('idEncuestaRespondidaResp')
          ->withTimestamps();
    }
    /*public function actividadComedor(){
      return $this->hasOne('BienestarWeb\ActComedor','idActividad');
    }
    public function actividadMovilidad(){
      return $this->hasOne('BienestarWeb\ActMovilidad','idActividad');
   }*/
    public function actividadesPedagogia(){
      return $this->hasMany('BienestarWeb\ActPedagogia','idActividad');
    }
    public function actividadGrupal(){
      return $this->hasOne('BienestarWeb\ActGrupal','idActividad');
    }
    //Actividad ActComedor
    public function beneficiariosComedor(){
       return $this->belongsToMany('BienestarWeb\Alumno','beneficiarioComedor','idActividad','idAlumno')
                   ->withPivot('idBeneficiarioComedor','fechaBeneficio','tipoBeneficio')
                   ->withTimestamps();
    }
    //Actividad ActMovilidad
    public function beneficiariosMovilidad(){
      return $this->belongsToMany('BienestarWeb\Alumno','beneficiarioMovilidad','idActividad','idAlumno')
                   ->withPivot('idBeneficiarioMovilidad','fechaInicio','fechaFin','duracionMeses','duracionAnio','institucion','pais','observaciones')
                   ->withTimestamps();
    }

}
