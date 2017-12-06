<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\PreguntaHabito;
use BienestarWeb\TipoHabito;
use BienestarWeb\HabitoEstudio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use BienestarWeb\TutorTutorado;
use BienestarWeb\Alumno;
use BienestarWeb\Http\Controllers\Controller;

use DB;
class HabitoEstudioController extends Controller
{
    /**
     * Display a listing of the resourceC
     *hebitoEstudioRespuesta
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        //$cadena=url()->current();
        //$r=strpos($cadena,'usuario');
        //if($r !== FALSE){
        //FALTA EL FILTRO POr SER TUTORTUTORADO
        //Search($request->idTutorTutorado)->

        $habitosEstudio = HabitoEstudio::get();

        $tutorTutorados = TutorTutorado::get();
        //dd($tutorTutorados);
        return view('usuario.habitoEstudio.index')
                ->with('habitosEstudio',$habitosEstudio)
                ->with('tutorTutorados',$tutorTutorados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\ResponsetutorTutorados
     */
    public function create()
    {
        //$preguntasHabito = PreguntaHabito::orderBy('idTipoHabito')->get();
        $preguntasHabito = PreguntaHabito::get();
        return view('miembro.tutorado.habitoEstudio.create')->with('preguntasHabito',$preguntasHabito);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input('respuestasHabito'));

        $idTutorTutorado='7';

        $tutorTutorado = TutorTutorado::findOrFail($idTutorTutorado);
        //$user->roles()->updateExistingPivot($roleId, $attributes);
        //$tutorTutorado->habitoEstudioRespondido = '1';
        //$tutorTutorado->update();
        $habitoEstudio = new HabitoEstudio;
        $tutorTutorado->habitosEstudio()->save($habitoEstudio);
        $preguntasHabito = PreguntaHabito::orderBy('idTipoHabito')->get();
        $i=0;
        foreach ($preguntasHabito as $pH) {
            $i=$i+1;
            $id =$pH->idPreguntaHabito;
            $rpta = $request->input('respuestasHabito.'.$i);
            //sdd($request->input('respuestasHabito.'.$i));
            $habitoEstudio->respuestasHabito()->attach($id,['rpta'=>$rpta]);
        }
        //dd($habitoEstudio);
        return Redirect::to('usuario/habitoEstudio');
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

         //dd($si->toArray()[0]['rpta']);
        //dd($si);
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
    public function destroy($id)
    {
        //
    }
}
