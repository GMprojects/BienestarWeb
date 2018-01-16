<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\PreguntaHabito;
use BienestarWeb\TipoHabito;
use BienestarWeb\HabitoEstudio;
use BienestarWeb\Semestre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use BienestarWeb\TutorTutorado;
use BienestarWeb\Alumno;
use BienestarWeb\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
class HabitoEstudioController extends Controller{
    /**
     * Display a listing of the resourceC
     *hebitoEstudioRespuesta
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\ResponsetutorTutorados
     */
     public function create(){    /*
         $preguntasHabito = PreguntaHabito::orderBy('idTipoHabito')->get();
         return view('miembro.habitoEstudio.create')->with('preguntasHabito',$preguntasHabito);*/
        $preguntasHabito = PreguntaHabito::all();
        $preguntas = [];
        $j = 0; $k = 0; $i = $preguntasHabito[0]->idTipoHabito;
        foreach ($preguntasHabito as $pregunta) {
           if($i == $pregunta->idTipoHabito){
              $preguntas[$j][$k++] = $pregunta;
           }else{
              $k = 0;
              $preguntas[++$j][$k++] = $pregunta;
              $i = $pregunta->idTipoHabito;
           }

        }
        return view('miembro.tutorado.habitoEstudio.mis-habitos')->with('preguntas',$preguntas);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function getSemestre(){
         $fechaActual = (Carbon::now())->format('Y-m-d');
         $semestres = Semestre::get();
         $i = 0; $existe = false; $nroSem = count($semestres);
         while ($i < $nroSem && !$existe) {
          $fechaInicio = $semestres[$i]['fechaInicio'];
          $fechaFin = $semestres[$i]['fechaFin'];

            if (($fechaActual >= $fechaInicio) && ($fechaActual <= $fechaFin)) {
               $existe = true;
            } else {
               $existe = false;
            }
            $i++;
         }

         if ($existe) {//True
            return $semestres[$i-1]['semestre'];
         } else {
            return $semestres[$nroSem-1]['semestre'];
         }

    }
     public function store(Request $request){
         /* $array = explode("-",HabitoEstudioController::getSemestre());
         $numeroSemestre  = ($array[1] == 'I') ? 1 : 2 ; */

         $tutorTutorado = TutorTutorado::where([
            'idAlumno' => $request->user()->alumno->idAlumno,
            'habitoEstudioRespondido' => '0',
            /*'anioSemestre' => $array[0],
            'numeroSemestre' => $numeroSemestre*/
            ])->get()[0];

         $habitoEstudio = HabitoEstudio::create([
            'idTutorTutorado' => $tutorTutorado->idTutorTutorado
         ]);
         $preguntasHabito = PreguntaHabito::all();
         foreach ($preguntasHabito as $pregunta) {
             $habitoEstudio->respuestasHabito()->attach($pregunta,['rpta'=> $request->input($pregunta->idPreguntaHabito)]);
         }
         $request->user()->alumno->tutores()->updateExistingPivot($tutorTutorado->idDocente, ['habitoEstudioRespondido' => '1'] );
         return redirect('/');

     }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\HabitoEstudio  $habitoEstudio
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $tutorTutorado = TutorTutorado::findOrFail($id);
        $alumno = Alumno::findOrFail($tutorTutorado->idAlumno);
        $respuesta_cantidad = HabitoEstudio::join('detalleHabito','habitoEstudio.idHabitoEstudio', '=','detalleHabito.idHabitoEstudio' )
                  ->where([['habitoEstudio.idHabitoEstudio', $tutorTutorado->habitoEstudio->idHabitoEstudio]])
                  ->select('detalleHabito.rpta',DB::raw('count(detalleHabito.rpta) as cantidad'))
                  ->groupBy('detalleHabito.rpta')->get();
        return view('miembro.tutor.habitoEstudio.show')->with('tutorTutorado', $tutorTutorado)
                                                       ->with('alumno', $alumno->user)
                                                       ->with('respuesta_cantidad', $respuesta_cantidad->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\HabitoEstudio  $habitoEstudio
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\HabitoEstudio  $habitoEstudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\HabitoEstudio  $habitoEstudio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}
