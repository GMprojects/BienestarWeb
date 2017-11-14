<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;
use BienestarWeb\Administrativo;
use BienestarWeb\InscripcionADA;
use BienestarWeb\Docente;
use BienestarWeb\Alumno;
use BienestarWeb\Persona;

class InscripcionADA extends Model
{
    protected $table = 'InscripcionADA';
    protected $primaryKey = 'idInscripcionADA';
    protected $fillable = [
        'idActividad'
      ];

    public $timestamps = true;

    public function actividad(){
      return $this->belongsTo('BienestarWeb\Actividad','idActividad');
    }
    public function inscripcionAlumno(){
      return $this->hasOne('BienestarWeb\InscripcionAlumno','idInscripcionADA');
    }
    public function inscripcionDocente(){
      return $this->hasOne('BienestarWeb\InscripcionDocente','idInscripcionADA');
    }
    public function inscripcionAdministrativo(){
      return $this->hasOne('BienestarWeb\InscripcionAdministrativo','idInscripcionADA');
    }
    public function encuestas(){
      return $this->belongsToMany('BiesnestarWeb\Encuesta','encuestaRespondidaInsc','idInscripcionADA','idEncuesta')
          ->withPivot('idEncuestaRespondidaInsc')
          ->withTimestamps();
    }

    public function scopeSearchDocente($query, $request){
      //dd($request);
      $idActividad = $request->idActividad;
    //  dd($idActividad);
      if($request->nombre != null){
        $listaDocentes = Docente::join('inscripcionDocente','docente.idDocente', '=','inscripcionDocente.idDocente' )
              ->join('user','docente.idUser', '=','user.id' )
              ->where('inscripcionDocente.idActividad', '=', $request->idActividad)
              ->where('user.nombre','LIKE',"%$request->nombre%")
              ->orwhere('user.apellidoPaterno','LIKE',"%$request->nombre%")
              ->orwhere('user.apellidoMaterno','LIKE',"%$request->nombre%")
              ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionDocente.asistencia','inscripcionDocente.idActividad','inscripcionDocente.idInscripcionADA')->get();
        return $listaDocentes;
      }else{
        //dd($idActividad);
        $listaDocentes = Docente::join('inscripcionDocente','docente.idDocente', '=','inscripcionDocente.idDocente' )
              ->join('user','docente.idUser', '=','user.id' )
              ->where('inscripcionDocente.idActividad', '=', $request->idActividad)
              ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionDocente.asistencia','inscripcionDocente.idActividad','inscripcionDocente.idInscripcionADA')->get();
        return $listaDocentes;
      }
    }
    public function scopeSearchAlumno($query, $request){
      if($request->nombre != null){
        $listaAlumnos = Alumno::join('inscripcionAlumno','alumno.idAlumno', '=','inscripcionAlumno.idAlumno' )
              ->join('user','alumno.idUser', '=','user.id' )
              ->where('inscripcionAlumno.idActividad', '=', $request->idActividad)
              ->where('user.nombre','LIKE',"%$request->nombre%")
              ->orwhere('user.apellidoPaterno','LIKE',"%$request->nombre%")
              ->orwhere('user.apellidoMaterno','LIKE',"%$request->nombre%")
              ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionAlumno.asistencia','inscripcionAlumno.idActividad','inscripcionAlumno.idInscripcionADA')->get();
        return $listaAlumnos;
      }else{
        $listaAlumnos = Alumno::join('inscripcionAlumno','alumno.idAlumno', '=','inscripcionAlumno.idAlumno' )
              ->join('user','alumno.idUser', '=','user.id' )
              ->where('inscripcionAlumno.idActividad', '=', $request->idActividad)
              ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionAlumno.asistencia','inscripcionAlumno.idActividad','inscripcionAlumno.idInscripcionADA')->get();
        return $listaAlumnos;
      }
    }
    public function scopeSearchAdministrativo($query, $request){
      if($request->nombre != null){
        $listaAdministrativos = Administrativo::join('inscripcionAdministrativo','administrativo.idAdministrativo', '=','inscripcionAdministrativo.idAdministrativo' )
              ->join('user','administrativo.idUser', '=','user.id' )
              ->where('inscripcionAdministrativo.idActividad', '=', $request->idActividad)
              ->where('user.nombre','LIKE',"%$request->nombre%")
              ->orwhere('user.apellidoPaterno','LIKE',"%$request->nombre%")
              ->orwhere('user.apellidoMaterno','LIKE',"%$request->nombre%")
              ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionAdministrativo.asistencia','inscripcionAdministrativo.idActividad','inscripcionAdministrativo.idInscripcionADA')->get();
        return $listaAdministrativos;
      }else{
        $listaAdministrativos = Administrativo::join('inscripcionAdministrativo','administrativo.idAdministrativo', '=','inscripcionAdministrativo.idAdministrativo' )
              ->join('user','administrativo.idUser', '=','user.id' )
              ->where('inscripcionAdministrativo.idActividad', '=', $request->idActividad)
              ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionAdministrativo.asistencia','inscripcionAdministrativo.idActividad','inscripcionAdministrativo.idInscripcionADA')->get();
        return $listaAdministrativos;
      }
    }
}
