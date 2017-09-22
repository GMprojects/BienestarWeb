<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\PreguntaEncuesta;
use BienestarWeb\Encuesta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Http\Controllers\Controller;

class PreguntaEncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->enunciado != null){
          $preguntasEncuesta = PreguntaEncuesta::FiltroEnunciado($request->idEncuesta,$request->enunciado)->get();
        }else {
          $preguntasEncuesta = PreguntaEncuesta::Search($request->idEncuesta)->get();
        }
        $preguntasEncuesta->each(function($preguntasEncuesta){
            $preguntasEncuesta->encuesta;
        });
        return view('admin.preguntaEncuesta.index')
            ->with('preguntasEncuesta',$preguntasEncuesta)
            ->with('idEncuesta',$request->idEncuesta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.preguntaEncuesta.create')
              ->with('idEncuesta',$request->idEncuesta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'enunciado' => 'required|unique:preguntaEncuesta'
        ]);
        $preguntaEncuesta = new PreguntaEncuesta;
        $preguntaEncuesta->enunciado = $request->get('enunciado');
        $encuesta = Encuesta::findOrFail($request->idEncuesta);
        $encuesta->preguntasEncuesta()->save($preguntaEncuesta);
      //return Redirect::to('admin/preguntaEncuesta');
        return redirect()->action('PreguntaEncuestaController@index', ['idEncuesta' => $request->idEncuesta]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.preguntaEncuesta.edit')
        ->with('preguntaEncuesta',PreguntaEncuesta::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $preguntaEncuesta = PreguntaEncuesta::findOrFail($id);
        $preguntaEncuesta->enunciado = $request->get('enunciado');
        $preguntaEncuesta->update();
        //return Redirect::to('admin/preguntaEncuesta')->with('texto',$idEncuesta);
        //return redirect()->back();
        return redirect()->action('PreguntaEncuestaController@index', ['idEncuesta' => $preguntaEncuesta->idEncuesta]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $preguntaEncuesta = PreguntaEncuesta::findOrFail($id);
        $preguntaEncuesta->delete();
        return redirect()->back();
        //return Redirect::to('admin/preguntaEncuesta')->with('texto',$idEncuesta);
        //return view('admin.preguntaEncuesta.index')
        //->with('texto',$idEncuesta);
    }
}
