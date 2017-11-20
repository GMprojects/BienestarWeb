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
    public function encuestas(){
      return $this->belongsToMany('BienestarWeb\Encuesta','encuestaRespondidaResp','idActividad','idEncuesta')
          ->withPivot('idEncuestaRespondidaResp')
          ->withTimestamps();
    }
    public function actividadComedor(){
      return $this->hasOne('BienestarWeb\ActComedor','idActividad');
    }
    public function actividadMovilidad(){
      return $this->hasOne('BienestarWeb\ActMovilidad','idActividad');
    }
    public function actividadesPedagogia(){
      return $this->hasMany('BienestarWeb\ActPedagogia','idActividad');
    }
    public function actividadGrupal(){
      return $this->hasOne('BienestarWeb\ActGrupal','idActividad');
    }

    public function scopeSearch($query, $request){
      if($request->idUserProgramador != null){
              if ($request->titulo != null) {
                return $query
                    ->where('idUserProg', '=', $request->idUserProgramador)
                    ->where('titulo','LIKE',"%$request->titulo%")
                    ->orderBy('idActividad', 'ASC');
              }else{
                return $query
                    ->where('idUserProg', '=', $request->idUserProgramador)
                    ->orderBy('idActividad', 'ASC');
              }
      }else if($request->idUserResponsable != null){
              if ($request->titulo != null) {
                return $query
                    ->where('idUserResp', '=', $request->idUserResponsable)
                    ->where('titulo','LIKE',"%$request->titulo%")
                    ->orderBy('idActividad', 'ASC');
              }else{
                return $query
                    ->where('idUserResp', '=', $request->idUserResponsable)
                    ->orderBy('idActividad', 'ASC');
              }
      }else if($request->idUserInscrito != null){
              $userInscrita = User::findOrFail( $request->idUserInscrito );
            //  dd($userInscrita->idUser);
            //  dd($request->idUserInscrito);
              //dd($userInscrita->tipoPersona['idTipoPersona']);
              switch($userInscrita->tipoPersona['idTipoPersona']){
                  case(1):{//docente
                    $idDocente = Docente::where('idUser','=',$userInscrita->idUser)->value('idDocente');
                    //dd($idAdministrativo);
                    $inscripciones = InscripcionADA::join('inscripcionDocente','inscripcionADA.idInscripcionADA','=','inscripcionDocente.idInscripcionADA')
                                    ->where('inscripcionDocente.idDocente', '=', $idDocente)
                                    ->pluck('inscripcionADA.idActividad');
                    //dd($inscripciones);
                    return $query
                        ->whereIn('actividad.idActividad',$inscripciones);
                  break;
                    break;
                  }
                  case(2):{//administrativo
                      $idAdministrativo = Administrativo::where('idUser','=',$userInscrita->idUser)->value('idAdministrativo');
                      //dd($idAdministrativo);
                      $inscripciones = InscripcionADA::join('inscripcionAdministrativo','inscripcionADA.idInscripcionADA','=','inscripcionAdministrativo.idInscripcionADA')
                                      ->where('inscripcionAdministrativo.idAdministrativo', '=', $idAdministrativo)
                                      ->pluck('inscripcionADA.idActividad');
                      //dd($inscripciones);
                      return $query
                          ->whereIn('actividad.idActividad',$inscripciones);
                    break;
                  }
                  case(3):{//alumno
                    $idAlumno = Alumno::where('idUser','=',$userInscrita->idUser)->value('idAlumno');
                    //dd($idAdministrativo);
                    $inscripciones = InscripcionADA::join('inscripcionAlumno','inscripcionADA.idInscripcionADA','=','inscripcionAlumno.idInscripcionADA')
                                    ->where('inscripcionAlumno.idAlumno', '=', $idAlumno)
                                    ->pluck('inscripcionADA.idActividad');
                    //dd($inscripciones);
                    return $query
                        ->whereIn('actividad.idActividad',$inscripciones);
                  break;
                    break;
                  }
              }
      }else if($request->estadoCancelado != null){
              if ($request->titulo != null) {
                return $query
                    ->where('estado', '=', 3)
                    ->where('titulo','LIKE',"%$request->titulo%")
                    ->orderBy('idActividad', 'ASC');
              }else{
                return $query
                    ->where('estado', '=', 3)
                    ->orderBy('idActividad', 'ASC');
              }
      }else{
                return $query
                    ->where('titulo','LIKE',"%$request->titulo%")
                    ->orderBy('idActividad', 'ASC');
      }
    }



}
