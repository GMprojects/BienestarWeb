<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\InscripcionADA;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Http\Controllers\Controller;

class InscripcionADAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd($request);
        $inscripciones = InscripcionADA::Search($request->idActividad)->get();
        $inscripciones->each(function($inscripciones){
            $inscripciones->inscripcionDocente;
            $inscripciones->inscripcionAdministrativo;
            $inscripciones->inscripcionAlumno;
            $inscripciones->actividad;
        });
        return view('programador.inscripcion.index')
            ->with('inscripciones',$inscripciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function show(InscripcionADA $inscripcionADA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function edit(InscripcionADA $inscripcionADA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InscripcionADA $inscripcionADA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\InscripcionADA  $inscripcionADA
     * @return \Illuminate\Http\Response
     */
    public function destroy(InscripcionADA $inscripcionADA)
    {
        //
    }
}
