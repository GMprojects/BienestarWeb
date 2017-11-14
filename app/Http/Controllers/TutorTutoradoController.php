<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\TutorTutorado;
use BienestarWeb\Docente;
use BienestarWeb\Alumno;
use BienestarWeb\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Mail;

use BienestarWeb\Jobs\JobEmail;

use DB;
use Log;
use Carbon\Carbon;

class TutorTutoradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *alumnos = Alumno::join('user','alumno.idUser', '=','user.id' )
              *         ->whereNotIn('alumno.idAlumno', $idAlumnosTutorados)
              *         ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
              *         ->get();
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tutores = Docente::has('tutorados')->get();
        //SELECT idDocente, anioSemestre, numeroSemestre, COUNT(idAlumno) as nroTutorados FROM tutortutorado GROUP BY idDocente, anioSemestre, numeroSemestre
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
    public function create()
    {
        return view('admin.tutorTutorado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // alumnos[] , tutor split[0]
    {
        //dd($request);
        $array = preg_split("/[.]/",$request->tutor);
        $idDocente = $array[0];
        $docente = Docente::findOrFail($idDocente);
        for ($i = 0; $i < count($request->alumnos); $i++) {
          $docente->tutorados()->attach( $request->alumnos[$i], ['anioSemestre' => $request->anioSemestre,
                                                                 'numeroSemestre' => $request->numeroSemestre]);
        }
        return Redirect::to('admin/tutorTutorado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idTutor)
    {

        $tutor = Docente::findOrFail($idTutor);
        $tutorados = TutorTutorado::join('alumno','tutorTutorado.idAlumno','=','alumno.idAlumno')
                                  ->join('user','alumno.idUser', '=','user.id' )
                                  ->where([['idDocente', '=', $idTutor],['anioSemestre', '=', $request->anioSemestre],['numeroSemestre', '=', $request->numeroSemestre]])
                                  ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo','tutorTutorado.anioSemestre','tutorTutorado.numeroSemestre','tutorTutorado.habitoEstudioRespondido')
                                  ->get();
        return view('admin.tutorTutorado.show',['tutor' => $tutor->user,'idTutor' => $tutor->idDocente, 'tutorados' => $tutorados ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $idTutor)
    {
        $tutor = Docente::join('user','docente.idUser', '=','user.id' )
                        ->where('idDocente', $idTutor)
                        ->select('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                        ->get();
        $tutorados = TutorTutorado::join('alumno','tutorTutorado.idAlumno','=','alumno.idAlumno')
                                  ->join('user','alumno.idUser', '=','user.id' )
                                  ->where([['idDocente', '=', $idTutor],['anioSemestre', '=', $request->anioSemestre],['numeroSemestre', '=', $request->numeroSemestre]])
                                  ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo','tutorTutorado.anioSemestre','tutorTutorado.numeroSemestre','tutorTutorado.habitoEstudioRespondido')
                                  ->get();
        $idTutorados = Alumno::join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )//alumnosdeTutorado del docente $request->idDocente
                                  ->where([['tutorTutorado.idDocente', '=', $idTutor],['tutorTutorado.numeroSemestre', '=', $request->numeroSemestre],['tutorTutorado.anioSemestre', '=',  $request->anioSemestre]])
                                  ->pluck('alumno.idAlumno');
        return view('admin.tutorTutorado.edit',['tutor' => $tutor, 'idTutorados' => $idTutorados, 'anioSemestre' => $request->anioSemestre,'numeroSemestre' => $request->numeroSemestre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idTutor)
    {
        //dd($request);
        $docente = Docente::findOrFail($idTutor);
        TutorTutorado::where([['idDocente', '=', $idTutor],['anioSemestre', '=', $request->anioSemestre],['numeroSemestre', '=', $request->numeroSemestre]])->delete();

        for ($i = 0; $i < count($request->alumnos); $i++) {
          $docente->tutorados()->attach( $request->alumnos[$i], ['anioSemestre' => $request->anioSemestre,
                                                                 'numeroSemestre' => $request->numeroSemestre]);
        }
        return Redirect::to('admin/tutorTutorado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function destroy(TutorTutorado $tutorTutorado)
    {
        //
    }

   public function enviarEmail(Request $request)
    {
        if($request->ajax()){
           $idAlPer = Alumno::where('idAlumno', $request->idAlumno)->value('idUser');
           $idDocPer = Docente::where('idDocente', $request->idTutor)->value('idUser');
           $job = (new JobEmail($idAlPer, $request->mensaje, $request->Subject, $idDocPer))
                  ->delay(Carbon::now()->addSeconds(5));
           dispatch($job);
        }
    }

    public function getTutores(Request $request){
    //    dd($request);
      if($request->ajax()){

          $users = Docente::join('tutorTutorado','docente.idDocente', '=','tutorTutorado.idDocente' )
              ->join('user','docente.idUser', '=','user.id' )
              ->select('user.id','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
              ->distinct()
              ->get();
         return response()->json($users);
      }
    }

    public function getTutorados(Request $request){
    //    dd($request);
    Log::info($request);
      if($request->ajax()){
          $idDocente = Docente::where('idUser', '=',  $request->id )->value('idDocente');
          $tutorados = Alumno::join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )
              ->join('user','alumno.idUser', '=','user.id' )
              ->where('tutorTutorado.idDocente', '=', $idDocente)
              ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
              ->get();
          return response()->json($tutorados);
      }
    }

    public function getAlumnosLibres(Request $request){
    //    dd($request);whereNotIn
      if($request->ajax()){
          $idAlumnosTutorados = TutorTutorado::where('numeroSemestre',$request->numeroSemestre)
                                             ->where('anioSemestre', '=',  $request->anioSemestre)
                                             ->pluck('idAlumno');
          $alumnos = Alumno::join('user','alumno.idUser', '=','user.id' )
                            ->whereNotIn('alumno.idAlumno', $idAlumnosTutorados)
                            ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                            ->get();
          return response()->json($alumnos);
      }
    }

    public function getDocentesNoTutores(Request $request){
    //    dd($request);whereNotIn
      if($request->ajax()){
          $idAlumnosTutorados = TutorTutorado::where('numeroSemestre',$request->numeroSemestre)
                                             ->where('anioSemestre', '=',  $request->anioSemestre)
                                             ->pluck('idDocente');
          $docentes = Docente::join('user','docente.idUser', '=','user.id' )
                            ->whereNotIn('docente.idDocente', $idAlumnosTutorados)
                            ->select('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                            ->get();
          return response()->json($docentes);
      }
    }

    public function getAlumnosLibresExDoc(Request $request){//alumos libres + //alumnosdeTutorado del docente $request->idDocente
    //    dd($request);whereNotIn
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
              ->where([['tutorTutorado.idDocente', '=', $request->idDocente],['tutorTutorado.numeroSemestre', '=', $request->numeroSemestre],['tutorTutorado.anioSemestre', '=',  $request->anioSemestre]])
              ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
              ->get();
          $alumos = $alumnosLibres->merge($alumnosTutorados);
          return response()->json($alumos->all());
      }
    }

    public function soyTutor(Request $request){
      if($request->ajax()){
         $dt = [];
         $idDocente = Docente::where('idUser', '=',  $request->id )->value('idDocente');
         $tutorados = tutorTutorado::where('idDocente', $idDocente)
               ->count('idDocente');
         $dt['tutorados'] = $tutorados;
         $dt['idDocente'] = $idDocente;
         return response()->json($dt);
      }
    }

    public function misTutorados(Request $request){
      Log::info('Buscando mis tutorados'.$request);
      $docente = Docente::where('idUser', Auth::user()->id )->get()[0];
      $tutorados = Alumno::join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )
           ->join('user','alumno.idUser', '=','user.id' )
           ->where('tutorTutorado.idDocente', '=', $docente->idDocente)
           ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
           ->get();
      return view('admin.tutorTutorado.show',['tutor' => $docente->user,'idTutor' => $docente->idDocente, 'tutorados' => $tutorados ]);
   }
}
