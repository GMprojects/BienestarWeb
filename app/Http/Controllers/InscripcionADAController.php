<?php

namespace BienestarWeb\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Http\Controllers\Controller;

use BienestarWeb\InscripcionADA;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;
use BienestarWeb\User;
use BienestarWeb\Actividad;
use BienestarWeb\Encuesta;
use BienestarWeb\EncuestaRespondidaResp;
use BienestarWeb\EncuestaRespondidaInsc;

use Illuminate\Support\Facades\Auth;

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
        return view('miembro.inscripcion.index')
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request){

         $actividad = Actividad::findOrFail($request->idActividad);
         $user =  Auth::user();
         $inscripcionADA = $actividad->inscripcionesADA()->create([]);
         switch ($user->idTipoPersona) {
            case '1':
               $alumno = User::findOrFail($user->id)->alumno;
               $inscripcionAlumno= new InscripcionAlumno;
               $inscripcionADA->inscripcionAlumno()->create([
                 'idActividad' => $actividad->idActividad,
                 'idAlumno' => $alumno->idAlumno
               ]);
               break;
            case '2':
               $docente = User::findOrFail($user->id)->docente;
               $inscripcionDocente = new InscripcionDocente;
               $inscripcionADA->inscripcionDocente()->create([
                 'idActividad' => $actividad->idActividad,
                 'idDocente' => $docente->idDocente
               ]);
               break;
            case '3':
               $administrativo = User::findOrFail($user->id)->administrativo;
               $inscripcionAdministrativo = new InscripcionAdministrativo;
               $inscripcionADA->inscripcionAdministrativo()->create([
                 'idActividad' => $actividad->idActividad,
                 'idAdministrativo' => $administrativo->idAdministrativo
               ]);
               break;
         }
         /*if($actividad->actividadGrupal != null){
            $actividad->actividadGrupal->cuposDisponibles = $actividad->actividadGrupal->cuposDisponibles -1;
            $actividad->actividadGrupal->cuposOcupados = $actividad->actividadGrupal->cuposOcupados +1;
         }*/
         return redirect()->back();
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

    public function registrarAsistencias(Request $request, $id){
      //dd($id);
      $idEnc_insc = Encuesta::where([
         'idTipoActividad' => Actividad::findOrFail($id)->idTipoActividad,
         'destino' => 'i'
         ])->pluck('idEncuesta');
      $idEnc_resp = Encuesta::where([
         'idTipoActividad' => Actividad::findOrFail($id)->idTipoActividad,
         'destino' => 'r'
         ])->pluck('idEncuesta');
      EncuestaRespondidaResp::create([
         'idActividad' => $id,
         'idEncuesta' => $idEnc_resp[0]
      ]);
      for ($i = 0; $i < count($request->asistencia) ; $i++) {
         $array = preg_split("/[-]/",$request->asistencia[$i]);
         if($array[1] == '1'){
            //alumno 1
            $inscripcionAlumno = InscripcionAlumno::where('idInscripcionADA', $array[0])->get();
            $inscripcionAlumno[0]->asistencia = '1';
            $inscripcionAlumno[0]->update();

         }elseif ($array[1] == '2') {
            //docente 2
            $inscripcionDocente = InscripcionDocente::where('idInscripcionADA', $array[0])->get();
            $inscripcionDocente[0]->asistencia = '1';
            $inscripcionDocente[0]->update();
         }else {//administrativo 3
            $inscripcionAdministrativo = InscripcionAdministrativo::where('idInscripcionADA', $array[0])->get();
            $inscripcionAdministrativo[0]->asistencia = '1';
            $inscripcionAdministrativo[0]->update();
         }
         $nuevaEncuesta = EncuestaRespondidaInsc::create([
            'idInscripcionADA'=>$array[0],
            'idEncuesta' => $idEnc_insc[0]
         ]);
      }
      $actividad = Actividad::findOrFail($id);
      $actividad->estado = 2;
      $actividad->update();

      return redirect()->back();
   }

}
