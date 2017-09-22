<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Encuesta;
use BienestarWeb\TipoActividad;
use BienestarWeb\PreguntaEncuesta;
use BienestarWeb\Alternativa;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use BienestarWeb\Http\Controllers\Controller;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $encuestas = Encuesta::Search($request->titulo)->get();
        $encuestas->each(function($encuestas){
            $encuestas->tipoActividad;
        });
        return view('admin.encuesta.index')->with('encuestas',$encuestas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposActividad=TipoActividad::get();
        return view('admin.encuesta.create')->with('tiposActividad',$tiposActividad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required'
            ]);
        $encuesta = new Encuesta($request->all());
        $encuesta->save();
        return Redirect::to('admin/encuesta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        $encuesta->each(function($encuesta){
            $encuesta->preguntasEncuesta;
            $encuesta->alternativas;
            $encuesta->tipoActividad;
        });
        //dd($habitoEstudio->preguntasHabito);
        return view('admin.encuesta.show')->with('encuesta',$encuesta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tiposActividad=TipoActividad::get();
        return view('admin.encuesta.edit')
        ->with('encuesta',Encuesta::findOrFail($id))
        ->with('tiposActividad',$tiposActividad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required'
            ]);
        $encuesta = Encuesta::findOrFail($id);
        $encuesta->titulo = $request->get('titulo');
        $encuesta->destino = $request->get('destino');
        $encuesta->update();
        return Redirect::to('admin/encuesta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        if((PreguntaEncuesta::where('idEncuesta',$id)->count())>0){
            PreguntaEncuesta::where('idEncuesta',$id)->delete();
        }
      //dd(Alternativa::where('idEncuesta',$id)->count());
        if((Alternativa::where('idEncuesta',$id)->count())>0){
            Alternativa::where('idEncuesta',$id)->delete();
            //dd(Alternativa::where('idEncuesta',$id));
        }
        Encuesta::destroy($id);
        return Redirect::to('admin/encuesta');
    }
}
