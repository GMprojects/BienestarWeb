<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\PreguntaHabito;
use BienestarWeb\TipoHabito;

use BienestarWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Query\Builder;

class PreguntaHabitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$preguntasHabito = PreguntaHabito::Search($request->enunciado)->paginate(10);
        $preguntasHabito = PreguntaHabito::get();
        /*$preguntasHabito->each(function($preguntasHabito){
            $preguntasHabito->tipoHabito;
        });*/
        return view('admin.preguntaHabito.index')->with('preguntasHabito',$preguntasHabito);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposHabito=TipoHabito::get();
        return view('admin.preguntaHabito.create')->with('tiposHabito',$tiposHabito);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'enunciado' => 'required|unique:preguntaHabito'
            ]);
        $preguntaHabito = new PreguntaHabito($request->all());
        $preguntaHabito->save();
        return Redirect::to('admin/preguntaHabito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\PreguntaHabito  $preguntaHabito
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.preguntaHabito.show')->with('preguntaHabito',PreguntaHabito::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\PreguntaHabito  $preguntaHabito
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tiposHabito=TipoHabito::get();
        return view('admin.preguntaHabito.edit')
        ->with('preguntaHabito',PreguntaHabito::findOrFail($id))
        ->with('tiposHabito',$tiposHabito);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\PreguntaHabito  $preguntaHabito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'enunciado' => 'required'
            ]);
        $preguntaHabito = PreguntaHabito::findOrFail($id);
        $preguntaHabito->enunciado = $request->get('enunciado');
        $preguntaHabito->idTipoHabito = $request->get('idTipoHabito');
        $preguntaHabito->update();
        return Redirect::to('admin/preguntaHabito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\PreguntaHabito  $preguntaHabito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $preguntaHabito = PreguntaHabito::findOrFail($id);
        $preguntaHabito->delete();
        return Redirect::to('admin/preguntaHabito');
    }
}
