<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\TipoPersona;
use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

class TipoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
            $tiposPersona=TipoPersona::Search($request->tipo)->paginate(7);
            $tiposPersona->each(function($tiposPersona){
             	$tiposPersona->persona;
            });
            return view('admin.tipoPersona.index')->with('tiposPersona',$tiposPersona);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoPersona.create');
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
        $tipoPersona = new TipoPersona;
        $tipoPersona->tipo = $request->get('tipo');
        $tipoPersona->save();
        return Redirect::to('admin/tipoPersona');
    }

    /**
     * Display the specified resource.
     *
     * @param  \sisVentas\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        return view('admin.tipoPersona.show')->with('tipoPersona',TipoPersona::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \sisVentas\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.tipoPersona.edit',['tipoPersona'=>TipoPersona::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \sisVentas\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required'
            ]);
        $tipoPersona=TipoPersona::findOrFail($id);   
        $tipoPersona->tipo = $request->get('tipo');
        $tipoPersona->update();
        return Redirect::to('admin/tipoPersona');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \sisVentas\TipoPersona  $tipoPersona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoPersona = TipoPersona::findOrFail($id);
        $tipoPersona->delete();
        return Redirect::to('admin/tipoPersona');
    }
}
