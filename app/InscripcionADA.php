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
              ->join('persona','docente.idPersona', '=','persona.idPersona' )
              ->where('inscripcionDocente.idActividad', '=', $request->idActividad)
              ->where('persona.nombre','LIKE',"%$request->nombre%")
              ->orwhere('persona.apellidoPaterno','LIKE',"%$request->nombre%")
              ->orwhere('persona.apellidoMaterno','LIKE',"%$request->nombre%")
              ->select('persona.nombre','persona.apellidoPaterno','persona.apellidoMaterno','inscripcionDocente.asistencia','inscripcionDocente.idActividad','inscripcionDocente.idInscripcionADA')->get();
        return $listaDocentes;
      }else{
        //dd($idActividad);
        $listaDocentes = Docente::join('inscripcionDocente','docente.idDocente', '=','inscripcionDocente.idDocente' )
              ->join('persona','docente.idPersona', '=','persona.idPersona' )
              ->where('inscripcionDocente.idActividad', '=', $request->idActividad)
              ->select('persona.nombre','persona.apellidoPaterno','persona.apellidoMaterno','inscripcionDocente.asistencia','inscripcionDocente.idActividad','inscripcionDocente.idInscripcionADA')->get();
        return $listaDocentes;
      }
    }
    public function scopeSearchAlumno($query, $request){
      if($request->nombre != null){
        $listaAlumnos = Alumno::join('inscripcionAlumno','alumno.idAlumno', '=','inscripcionAlumno.idAlumno' )
              ->join('persona','alumno.idPersona', '=','persona.idPersona' )
              ->where('inscripcionAlumno.idActividad', '=', $request->idActividad)
              ->where('persona.nombre','LIKE',"%$request->nombre%")
              ->orwhere('persona.apellidoPaterno','LIKE',"%$request->nombre%")
              ->orwhere('persona.apellidoMaterno','LIKE',"%$request->nombre%")
              ->select('persona.nombre','persona.apellidoPaterno','persona.apellidoMaterno','inscripcionAlumno.asistencia','inscripcionAlumno.idActividad','inscripcionAlumno.idInscripcionADA')->get();
        return $listaAlumnos;
      }else{
        $listaAlumnos = Alumno::join('inscripcionAlumno','alumno.idAlumno', '=','inscripcionAlumno.idAlumno' )
              ->join('persona','alumno.idPersona', '=','persona.idPersona' )
              ->where('inscripcionAlumno.idActividad', '=', $request->idActividad)
              ->select('persona.nombre','persona.apellidoPaterno','persona.apellidoMaterno','inscripcionAlumno.asistencia','inscripcionAlumno.idActividad','inscripcionAlumno.idInscripcionADA')->get();
        return $listaAlumnos;
      }
    }
    public function scopeSearchAdministrativo($query, $request){
      if($request->nombre != null){
        $listaAdministrativos = Administrativo::join('inscripcionAdministrativo','administrativo.idAdministrativo', '=','inscripcionAdministrativo.idAdministrativo' )
              ->join('persona','administrativo.idPersona', '=','persona.idPersona' )
              ->where('inscripcionAdministrativo.idActividad', '=', $request->idActividad)
              ->where('persona.nombre','LIKE',"%$request->nombre%")
              ->orwhere('persona.apellidoPaterno','LIKE',"%$request->nombre%")
              ->orwhere('persona.apellidoMaterno','LIKE',"%$request->nombre%")
              ->select('persona.nombre','persona.apellidoPaterno','persona.apellidoMaterno','inscripcionAdministrativo.asistencia','inscripcionAdministrativo.idActividad','inscripcionAdministrativo.idInscripcionADA')->get();
        return $listaAdministrativos;
      }else{
        $listaAdministrativos = Administrativo::join('inscripcionAdministrativo','administrativo.idAdministrativo', '=','inscripcionAdministrativo.idAdministrativo' )
              ->join('persona','administrativo.idPersona', '=','persona.idPersona' )
              ->where('inscripcionAdministrativo.idActividad', '=', $request->idActividad)
              ->select('persona.nombre','persona.apellidoPaterno','persona.apellidoMaterno','inscripcionAdministrativo.asistencia','inscripcionAdministrativo.idActividad','inscripcionAdministrativo.idInscripcionADA')->get();
        return $listaAdministrativos;
      }
    }
}
