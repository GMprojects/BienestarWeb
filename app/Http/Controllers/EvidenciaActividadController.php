<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\EvidenciaActividad;
use BienestarWeb\Actividad;
use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

class EvidenciaActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $evidenciasActividad = EvidenciaActividad::Search($request)->get();
        //dd($actividades);
        $evidenciasActividad->each(function($evidenciasActividad){
            $evidenciasActividad->actividad;
        });
        //dd($evidenciasActividad);
        return view('programador.evidenciaActividad.index')
                ->with('evidenciasActividad', $evidenciasActividad)
                ->with('idActividad',$request->idActividad);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('programador.evidenciaActividad.create')
              ->with('idActividad',$request->idActividad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Manipulacion de imagesetthickness
        //dd($request);
        $request->validate([
            'ruta' => 'file'
        ]);
        $actividad = Actividad::findOrFail($request->idActividad);
        $file = $request->file('ruta');
        $name = 'evidenciaActividad_'.$request->idActividad.'_'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path().'/imagenes/evidenciaActividad/'.$actividad->tipoActividad['tipo'].$request->idActividad.'/';
        //dd($path);
        $file->move($path,$name);
        //$evidenciaActividad = EvidenciaActividad::findOrFail($id);
        return redirect()->action('EvidenciaActividadController@index', ['idActividad' => $request->idActividad]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
