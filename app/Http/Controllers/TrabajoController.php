<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Trabajo;
use BienestarWeb\Egresado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Http\Controllers\Controller;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trabajos = Trabajo::Search($request)->get();
        $trabajos->each(function($trabajos){
            $trabajos->egresado;
        });
        return view('admin.trabajo.index')
            ->with('trabajos',$trabajos)
            ->with('idEgresado',$request->idEgresado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.trabajo.create')
              ->with('idEgresado',$request->idEgresado);
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
            'institucion' => 'required',
            'lugar' => 'required',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|nullable',
            'nivelSatisfaccion' => 'required'
        ]);
        $trabajo = new Trabajo;
        $trabajo->institucion = $request->get('institucion');
        $trabajo->lugar = $request->get('lugar');
        $trabajo->fechaInicio = $request->get('fechaInicio');
        $trabajo->fechaFin = $request->get('fechaFin');
        $trabajo->nivelSatisfaccion = $request->get('nivelSatisfaccion');
        $trabajo->recomendaciones = $request->get('recomendaciones');
        $trabajo->observaciones = $request->get('observaciones');

        $egresado = Egresado::findOrFail($request->idEgresado);
        $egresado->trabajos()->save($trabajo);
      //return Redirect::to('admin/preguntaEncuesta');
        return redirect()->action('TrabajoController@index', ['idEgresado' => $request->idEgresado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.trabajo.edit')
        ->with('trabajo',Trabajo::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $trabajo->institucion = $request->get('institucion');
        $trabajo->lugar = $request->get('lugar');
        $trabajo->fechaInicio = $request->get('fechaInicio');
        $trabajo->fechaFin = $request->get('fechaFin');
        $trabajo->nivelSatisfaccion = $request->get('nivelSatisfaccion');
        $trabajo->recomendaciones = $request->get('recomendaciones');
        $trabajo->observaciones = $request->get('observaciones');
        $trabajo->update();
        //return Redirect::to('admin/preguntaEncuesta')->with('texto',$idEncuesta);
        //return redirect()->back();
        return redirect()->action('TrabajoController@index', ['idEgresado' => $trabajo->idEgresado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        $trabajo->delete();
        return redirect()->back();
    }
}
