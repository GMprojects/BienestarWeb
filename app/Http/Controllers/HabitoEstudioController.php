<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\PreguntaHabito;
use BienestarWeb\TipoHabito;
use BienestarWeb\HabitoEstudio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use BienestarWeb\TutorTutorado;
use BienestarWeb\Http\Controllers\Controller;

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

        $habitosEstudio = HabitoEstudio::paginate(10);
        $habitosEstudio->each(function($habitosEstudio){
            $habitosEstudio->tutorTutorado;
        });

        $tutorTutorados = TutorTutorado::where('habitoEstudioRespondido','=','0')->paginate(10);
        $tutorTutorados->each(function($tutorTutorados){
        $tutorTutorados->habitoEstudio;
        });
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
        $preguntasHabito = PreguntaHabito::orderBy('idTipoHabito')->get();
        $preguntasHabito->each(function($preguntasHabito){
            $preguntasHabito->tipoHabito;
        });
        return view('usuario.habitoEstudio.create')->with('preguntasHabito',$preguntasHabito);
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
            $habitoEstudio->preguntasHabito()->attach($id,['rpta'=>$rpta]);
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
    public function show($id)
    {
        $habitoEstudio = HabitoEstudio::findOrFail($id);
        $habitoEstudio->each(function($habitoEstudio){
            $habitoEstudio->preguntasHabito;
            $habitoEstudio->tutorTutorado;
        });
        //dd($habitoEstudio->preguntasHabito);
        return view('usuario.habitoEstudio.show')->with('habitoEstudio',$habitoEstudio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\HabitoEstudio  $habitoEstudio
     * @return \Illuminate\Http\Response
     */
    public function edit(HabitoEstudio $habitoEstudio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\HabitoEstudio  $habitoEstudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HabitoEstudio $habitoEstudio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\HabitoEstudio  $habitoEstudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(HabitoEstudio $habitoEstudio)
    {
        //
    }
}
