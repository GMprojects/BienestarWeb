<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\TipoHabito;
use BienestarWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TipoHabitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tiposHabito = TipoHabito::Search($request->tipo)->get();
        return view('admin.tipoHabito.index')->with('tiposHabito',$tiposHabito);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoHabito.create');
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
            'tipo' => 'required'
            ]);
        $tipoHabito = new TipoHabito($request->all());
        $tipoHabito->save();
        return Redirect::to('admin/tipoHabito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\TipoHabito  $tipoHabito
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.tipoHabito.show')->with('tipoHabito',TipoHabito::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\TipoHabito  $tipoHabito
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.tipoHabito.edit')->with('tipoHabito',TipoHabito::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\TipoHabito  $tipoHabito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required'
            ]);
        $tipoHabito = TipoHabito::findOrFail($id);
        $tipoHabito->tipo = $request->get('tipo');
        $tipoHabito->update();
        return Redirect::to('admin/tipoHabito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\TipoHabito  $tipoHabito
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoHabito = TipoHabito::findOrFail($id);
        $tipoHabito->delete();
        return Redirect::to('admin/tipoHabito');
    }
}
