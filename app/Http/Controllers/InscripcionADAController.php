<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\InscripcionADA;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\Actividad;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Http\Controllers\Controller;

class InscripcionADAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //dd($request);
      switch ($request->opcionBuscar) {
        case '1':
          $inscripcionesAlumnos = InscripcionADA::SearchAlumno($request);
          $inscripcionesDocentes = null;
          $inscripcionesAdministrativos = null;
          break;
        case '2':
          $inscripcionesDocentes = InscripcionADA::SearchDocente($request);
          $inscripcionesAdministrativos = null;
          $inscripcionesAlumnos = null;
          break;
        case '3':
          $inscripcionesAdministrativos = InscripcionADA::SearchAdministrativo($request);
          $inscripcionesDocentes = null;
          $inscripcionesAlumnos = null;
          break;
        default:
          $inscripcionesDocentes = InscripcionADA::SearchDocente($request);
          $inscripcionesAlumnos = InscripcionADA::SearchAlumno($request);
          $inscripcionesAdministrativos = InscripcionADA::SearchAdministrativo($request);
          break;
      }
        //dd($inscripciones);
        $numAsistentes = 0;    $numAusentes = 0;
        //numero Inscritos
        //dd($inscripcionesAlumnos);
        $numInscritos = count($inscripcionesAlumnos)+count($inscripcionesDocentes)+count($inscripcionesAdministrativos);
        //numero asistentes        //numero de ausentes
        if($inscripcionesAlumnos != null){
          foreach ($inscripcionesAlumnos as $inscripcionAlumno) {
            ($inscripcionAlumno->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
          }
        }
        if($inscripcionesDocentes != null){
          foreach ($inscripcionesDocentes as $inscripcionDocente) {
            ($inscripcionDocente->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
          }
        }
        if($inscripcionesAdministrativos != null){
          foreach ($inscripcionesAdministrativos as $inscripcionAdministrativo) {
            ($inscripcionAdministrativo->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
          }
        }
        // -------------------------------------------- //
        return view('programador.inscripcionADA.index')
            ->with('inscripcionesDocentes',$inscripcionesDocentes)
            ->with('inscripcionesAlumnos',$inscripcionesAlumnos)
            ->with('inscripcionesAdministrativos',$inscripcionesAdministrativos)
            ->with('numInscritos',$numInscritos)
            ->with('numAsistentes',$numAsistentes)
            ->with('numAusentes',$numAusentes)
            ->with('cupos',$request->cupos)
            ->with('idActividad',$request->idActividad)
            ->with('opcionBuscar',$request->opcionBuscar)
            ->with('nombre',$request->nombre);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $actividad = Actividad::findOrFail($request->idActividad);
         $user =  Auth::user();
         $inscripcionADA = $actividad->inscripcionesADA()->create([
         ]);
         switch ($user->idTipoPersona) {
             case '1':
                $docente = Docente::findOrFail($user->id);
                $inscripcionDocente = new InscripcionDocente;
                $inscripcionADA->inscripcionDocente()->create([
                  'asistencia' => '0',
                  'idActividad' => $actividad->idActividad,
                  'idDocente' => $docente->idDocente
                ]);
                break;
             case '2':
                $administrativo = Administrativo::findOrFail($user->id);
                $inscripcionAdministrativo = new InscripcionAdministrativo;
                $inscripcionADA->inscripcionAdministrativo()->create([
                  'asistencia' => '0',
                  'idActividad' => $actividad->idActividad,
                  'idAdministrativo' => $administrativo->idAdministrativo
                ]);
                break;
             case '3':
                $alumno = Alumno::findOrFail($user->id);
                $inscripcionAlumno= new InscripcionAlumno;
                $inscripcionADA->inscripcionDocente()->create([
                  'asistencia' => '0',
                  'idActividad' => $actividad->idActividad,
                  'idAlumno' => $alumno->idAlumno
                ]);
                break;
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function show(InscripcionADA $inscripcionADA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function edit(InscripcionADA $inscripcionADA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InscripcionADA $inscripcionADA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function destroy(InscripcionADA $inscripcionADA)
    {
        //
    }

}
