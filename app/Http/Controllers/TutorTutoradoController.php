<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\TutorTutorado;
use BienestarWeb\EncuestaRespondida;
use BienestarWeb\Encuesta;
use BienestarWeb\Docente;
use BienestarWeb\Alumno;
use BienestarWeb\Persona;
use BienestarWeb\User;

use BienestarWeb\Semestre;
use BienestarWeb\Actividad;
use BienestarWeb\ActPedagogia;
use BienestarWeb\InscripcionAlumno;

use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;
use BienestarWeb\Http\Controllers\EncuestaController;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use BienestarWeb\Jobs\JobMailBasico;
use BienestarWeb\Jobs\JobMailHabitosEstudios;
use DB;
use Carbon\Carbon;

class TutorTutoradoController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $tutores = TutorTutorado::join('docente','tutorTutorado.idDocente','=','docente.idDocente')
                                  ->join('user','docente.idUser', '=','user.id' )
                                  ->select('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo','tutorTutorado.anioSemestre','tutorTutorado.numeroSemestre',DB::raw('count(tutorTutorado.idAlumno) as nroTutorados'))
                                  ->groupBy('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo','tutorTutorado.anioSemestre','tutorTutorado.numeroSemestre')
                                  ->get();
        return view('admin.tutorTutorado.index',['tutores' => $tutores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
         $semestre = config('semestre');
         $fechaActual = (Carbon::now())->format('Y-m-d');
         $existe = (($fechaActual >= $semestre['fechaInicio']) && ($fechaActual <= $semestre['fechaFin'])) ? true : false ;
         if($existe){
            $tutorTutorados = TutorTutorado::where('anioSemestre',  $semestre['anioSemestre'])
                                           ->where('numeroSemestre', $semestre['numeroSemestre'])
                                           ->select('idDocente','idAlumno')->get();

            $idDocentesTutorados = $tutorTutorados->pluck('idDocente');
            $idAlumnosTutorados = $tutorTutorados->pluck('idAlumno');
            $docentes = Docente::join('user','docente.idUser', '=','user.id' )
                             ->whereNotIn('docente.idDocente', $idDocentesTutorados)
                             ->select('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                             ->get();

            $alumnos = Alumno::join('user','alumno.idUser', '=','user.id' )
                            ->whereNotIn('alumno.idAlumno', $idAlumnosTutorados)
                            ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                            ->get();
            return view('admin.tutorTutorado.create')->with('alumnos', $alumnos)->with('docentes', $docentes)->with('status', null);
         }else{
            return view('admin.tutorTutorado.create')->with('status', 'No se encuentra dentro del rango de fechas del Semestre Actual.');
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $semestre = config('semestre');
        $array = preg_split("/[_]/",$request->tutor);
        $idDocente = $array[0];
        $docente = Docente::findOrFail($idDocente);
        for ($i = 0; $i < count($request->alumnos); $i++) {
          $docente->tutorados()->attach( (preg_split("/[_]/",$request->alumnos[$i]))[0],
                                          ['anioSemestre' => $semestre['anioSemestre'], 'numeroSemestre' => $semestre['numeroSemestre']]);
        }
        $i=0;
        $encuestasUsers = array();
        $idUserAlumnos = Alumno::whereIn('idAlumno',$request->alumnos)->pluck('idUser');
        foreach ($idUserAlumnos as $idUserAlumno) {
          $idEncuestaRespondida = EncuestaController::store_habi($idUserAlumno);
          if ($idEncuestaRespondida != null) {
            $encuestasUsers[$i] = array('idEncuestaRespondida' => $idEncuestaRespondida, 'idUser' => $idUserAlumno);
          }
          $i++;
        }
        $job = (new JobMailHabitosEstudios($encuestasUsers))
           ->delay(Carbon::now()->addSeconds(1));
        dispatch($job);
        return Redirect::to('admin/tutorTutorado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idTutor){
        $tutor = Docente::findOrFail($idTutor);
        $tutorados = TutorTutorado::join('alumno','tutorTutorado.idAlumno','=','alumno.idAlumno')
                                  ->join('user','alumno.idUser', '=','user.id' )
                                  ->where([['idDocente',  $idTutor],['anioSemestre',  $request->anioSemestre],['numeroSemestre',  $request->numeroSemestre]])
                                  ->select('tutorTutorado.idTutorTutorado', 'alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo','tutorTutorado.anioSemestre','tutorTutorado.numeroSemestre','tutorTutorado.habitoEstudioRespondido')
                                  ->orderBy('user.nombre', 'asc')
                                  ->get();
        return view('admin.tutorTutorado.show',['tutor' => $tutor->user,'idTutor' => $tutor->idDocente, 'tutorados' => $tutorados, 'anioSemestre' => $request->anioSemestre, 'numeroSemestre' => ($request->numeroSemestre == 1) ? 'I' : 'II'  ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $idTutor){
		$semestre = config('semestre');
		$fechaActual = (Carbon::now())->format('Y-m-d');
		$existe = (($fechaActual >= $semestre['fechaInicio']) && ($fechaActual <= $semestre['fechaFin'])) ? true : false ;
		if($existe){
			$tutor = Docente::join('user','docente.idUser', '=','user.id' )
						->where('idDocente', $idTutor)
						->select('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
						->first();

			$idAlumnosTutorados = TutorTutorado::where([['numeroSemestre', $request->numeroSemestre],['anioSemestre',  $request->anioSemestre],['idDocente',  $tutor->idDocente]])
										   ->pluck('idAlumno');

			$alumnosLibres = Alumno::join('user','alumno.idUser', '=','user.id' )//alumnos Libres
						 ->whereNotIn('alumno.idAlumno', $idAlumnosTutorados)
						 ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
						 ->orderBy('user.nombre')
						 ->get();

			return view('admin.tutorTutorado.edit',['tutor' => $tutor,
											   //'idTutorados' => $idTutorados,
											   'anioSemestre' => $request->anioSemestre,
											   'numeroSemestre' => $request->numeroSemestre,
											   'alumnos' => $alumnosLibres,
											   'status' => null]);
		}else{
            return view('admin.tutorTutorado.edit')->with('status', 'No se encuentra dentro del rango de fechas del Semestre Actual.');
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idTutor){
        $docente = Docente::findOrFail($idTutor);
        for ($i = 0; $i < count($request->alumnos); $i++) {
          $docente->tutorados()->attach( $request->alumnos[$i], ['anioSemestre' => $request->anioSemestre,
                                                                 'numeroSemestre' => $request->numeroSemestre]);
        }
        //$encuestasUser = array();
        $i=0;
        $encuestasUser = array();
        $idUserAlumnos = Alumno::whereIn('idAlumno',$request->alumnos)->pluck('idUser');
        foreach ($idUserAlumnos as $idUserAlumno) {
          $idEncuestaRespondida = EncuestaController::store_habi($idUserAlumno);
          if ($idEncuestaRespondida != null) {
            $encuestasUser[$i] = array('idEncuestaRespondida' => $idEncuestaRespondida, 'idUser' => $idUserAlumno);
          }
          $i++;
        }
        $job = (new JobMailHabitosEstudios($encuestasUser))
           ->delay(Carbon::now()->addSeconds(1));
        dispatch($job);
        return Redirect::to('admin/tutorTutorado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function destroy($idTutorTutorado){
         $tutorTutorado = TutorTutorado::findOrFail($idTutorTutorado);
         $idDocente = $tutorTutorado->idDocente;
         $numeroSemestre = $tutorTutorado->numeroSemestre;
         $anioSemestre = $tutorTutorado->anioSemestre;
         $actividades = Actividad::where([
                                       ['idUserResp', Docente::findOrFail($tutorTutorado->idDocente)->user->id],
                                       ['numeroSemestre', $tutorTutorado->numeroSemestre],
                                       ['anioSemestre', $tutorTutorado->anioSemestre]
                                       ])->get();
         if ($actividades!=null) {
            foreach ($actividades as $actividad) {
               if ( $actividad->estado != 2 ) {
                  //sino esta ejecutada la actividad se eliman las inscripciones, de lo contrario quedan como registro.
                  $i = 0;
                  $noExiste = true;
                  $inscritos = count($actividad->inscripcionesADA);
                  $cuposTotales = $actividad->cuposTotales;
                  while ($noExiste && $i<$inscritos) {
                     $inscripcionADA = $actividad->inscripcionesADA[$i];
                     if ($inscripcionADA->inscripcionAlumno->idAlumno == $tutorTutorado->idAlumno) {
                        ActPedagogia::where([
                                            ['idActividad', $actividad->idActividad],
                                            ['idInscripcionAlumno', $inscripcionADA->inscripcionAlumno->idInscripcionAlumno]
                                            ])->delete();
                        $inscripcionADA->inscripcionAlumno->delete();
                        $inscripcionADA->delete();
                        $noExiste = false;
                        $cuposTotales--;
                     }
                     $i++;
                  }
                  $actividad->cuposTotales = $cuposTotales;
                  if ($inscritos==0) {
                     $actividad->delete();
                  }elseif ($inscritos==1) {
                     $actividad->modalidad = 1;
                  }
                  $actividad->update();
               }
            }
         }
         // else : -> habito de estudio  no Respondido
         //ELIMINAR LA Encuesta
         EncuestaController::destroy_habi($tutorTutorado->idTutorTutorado);
         $tutorTutorado->delete();
         $tutorTutorados = TutorTutorado::where([
                                       ['idDocente', $idDocente],
                                       ['numeroSemestre', $numeroSemestre],
                                       ['anioSemestre', $anioSemestre]
                                       ])->get();
         if (count($tutorTutorados)==0) {
            return Redirect::to('admin/tutorTutorado');
         } else {
            return redirect()->back();
         }

    }

    public function destroyTutor($idTutor, $anioSemestre, $numeroSemestre){
         $actividades = Actividad::where([
                                       ['idUserResp', Docente::findOrFail($idTutor)->user->id],
                                       ['numeroSemestre', $numeroSemestre],
                                       ['anioSemestre', $anioSemestre]])->get();
         $tutorTutorados = TutorTutorado::where([
                                              ['numeroSemestre', $numeroSemestre],
                                              ['anioSemestre',  $anioSemestre],
                                              ['idDocente',  $idTutor]])->get();
         foreach ($tutorTutorados as $tutorTutorado) {
            if ($actividades != null) {
               foreach ($actividades as $actividad) {
                  if ( $actividad->estado != 2 ) {
                     //sino esta ejecutada la actividad se eliman las inscripciones, de lo contrario quedan como registro.
                     $i = 0;
                     $noExiste = true;
                     $inscritos = count($actividad->inscripcionesADA);
                     while ($noExiste && $i<$inscritos) {
                        $inscripcionADA = $actividad->inscripcionesADA[$i];
                        if ($inscripcionADA->inscripcionAlumno->idAlumno == $tutorTutorado->idAlumno) {
                           ActPedagogia::where([
                                               ['idActividad', $actividad->idActividad],
                                               ['idInscripcionAlumno', $inscripcionADA->inscripcionAlumno->idInscripcionAlumno]
                                               ])->delete();
                           $inscripcionADA->inscripcionAlumno->delete();
                           $inscripcionADA->delete();
                           $noExiste = false;
                        }
                        $i++;
                     }
                  }
               }
            }
            $tutorTutorado->delete();
         }
         if ($actividades != null) {
            foreach ($actividades as $actividad) {
               if ($actividad->estado != 2) {
                  $actividad->delete();
               }
            }
         }
         return redirect()->back();
    }

   public function enviarEmail(Request $request) {
         $aux = TutorTutorado::findOrFail($request->idTutorTutorado);
         $semestre = Semestre::where( ['anioSemestre' => $aux->anioSemestre, 'numeroSemestre' => $aux->numeroSemestre] )->get();
         $encuesta = Encuesta::findOrFail(3);
         $enviada = EncuestaRespondida::where(['idUser' => $aux->tutorado->user->id, 'idEncuesta' => 3])->whereBetween('fh_registro', [$semestre[0]->fechaInicio, $semestre[0]->fechaFin])->get();

         $idUserAlumno = Alumno::where('idAlumno', $aux->idAlumno)->value('idUser');
         $idUserDocente = Docente::where('idDocente', $aux->idDocente)->value('idUser');

         $url = url('miembro/member_show/'.$enviada[0]->idEncuestaRespondida);
         //($idUserEmisor, $idUserReceptor, $subject, $mensaje, $url, $accion)
         $job = (new JobMailBasico($idUserDocente, $idUserAlumno, $request->subject, $request->mensaje, $url, 'Llenar Hábito Estudio'))
               ->delay(Carbon::now()->addSeconds(1));
         dispatch($job);
         return redirect()->back();
    }

    public function getTutores(Request $request){
         if($request->ajax()){
            $semestre = config('semestre');
            $users = Docente::join('tutorTutorado','docente.idDocente', '=','tutorTutorado.idDocente' )
                ->join('user','docente.idUser', '=','user.id' )
                ->select('user.id','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                ->where([['anioSemestre', $semestre['anioSemestre']], ['numeroSemestre', $semestre['numeroSemestre']]])
                ->distinct()
                ->get();
           return response()->json($users);
         }
    }

    public function getTutorados(Request $request){
         if($request->ajax()){
           $semestre = config('semestre');
           $idDocente = Docente::where('idUser',  $request->id )->value('idDocente');
           $tutorados = Alumno::join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )
               ->join('user','alumno.idUser', '=','user.id' )
               ->where([['tutorTutorado.idDocente',  $idDocente], ['anioSemestre', $semestre['anioSemestre']], ['numeroSemestre',  $semestre['numeroSemestre']]])
               ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
               ->get();
          return response()->json($tutorados);
        }
    }


    public function getAlumnosLibresExDoc(Request $request){
         //alumos libres + //alumnosdeTutorado del docente $request->idDocente
         if($request->ajax()){
             $idAlumnosTutorados = TutorTutorado::where('numeroSemestre', $request->numeroSemestre)
                                                 ->where('anioSemestre',  $request->anioSemestre)
                                                 ->pluck('idAlumno');
             $alumnosLibres = Alumno::join('user','alumno.idUser', '=','user.id' )//alumnosLibres
                               ->whereNotIn('alumno.idAlumno', $idAlumnosTutorados)
                               ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                               ->get();
             $alumnosTutorados = Alumno::join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )//alumnosdeTutorado del docente $request->idDocente
                 ->join('user','alumno.idUser', '=','user.id' )
                 ->where([['tutorTutorado.idDocente',  $request->idDocente],['tutorTutorado.numeroSemestre',  $request->numeroSemestre],['tutorTutorado.anioSemestre',   $request->anioSemestre]])
                 ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                 ->get();
             $alumos = $alumnosLibres->merge($alumnosTutorados);
             return response()->json($alumos->all());
         }
    }

    public function soyTutor(Request $request){
         if($request->ajax()){
            $dt = [];
            $idDocente = Docente::where('idUser',   $request->id )->value('idDocente');
            $tutorados = TutorTutorado::where([['idDocente', $idDocente]])
                  ->count('idDocente');
            $dt['tutorados'] = $tutorados;
            $dt['idDocente'] = $idDocente;
            return response()->json($dt);
         }
    }

    public function misTutorados(Request $request){
         $docente = Docente::where('idUser', Auth::user()->id )->get()[0];
         $tutorados = Alumno::join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )
              ->join('user','alumno.idUser', 'user.id' )
              ->where([['tutorTutorado.idDocente', $docente->idDocente]])
              ->select('tutorTutorado.idTutorTutorado', 'alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo','tutorTutorado.anioSemestre','tutorTutorado.numeroSemestre', 'tutorTutorado.habitoEstudioRespondido')
              ->get();
         return view('miembro.tutor.indexTutorado',['tutor' => $docente->user,'idTutor' => $docente->idDocente, 'tutorados' => $tutorados ]);
   }
}
