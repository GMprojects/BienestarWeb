<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Actividad;
use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        $actividades = Actividad::Search($request)->get();
        //dd($actividades);
        $actividades->each(function($actividades){
            $actividades->tipoActividad;
            $actividades->evidenciasActividad;
            $actividades->responsable;
            $actividades->programador;
            $actividades->inscripcionesADA;
            $actividades->encuestas;
            $actividades->actividadesComedor;
            $actividades->actividadesMovilidad;
            $actividades->actividadesPedagogia;
            $actividades->actividadesGrupal;
        });
        //dd($actividades);
        return view('programador.actividad.index')
                ->with('actividades', $actividades)
                ->with('idPersonaProgramador', $request->idPersonaProgramador)
                ->with('idPersonaResponsable', $request->idPersonaResponsable)
                ->with('idPersonaInscrito', $request->idPersonaInscrito)
                ->with('estadoCancelado', $request->estadoCancelado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('programador.actividad.create')->with('preguntasHabito',$preguntasHabito);

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
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->each(function($actividad){
            $actividad->tipoActividad;
            $actividad->evidenciasActividad;
            $actividad->responsable;
            $actividad->programador;
            $actividad->inscripcionesADA;
            $actividad->encuestas;
            $actividad->actividadesComedor;
            $actividad->actividadesMovilidad;
            $actividad->actividadesPedagogia;
            $actividad->actividadesGrupal;
        });
      //  dd($actividad->actividadesGrupal);
        return view('programador.actividad.show')->with('actividad',$actividad);
    }

    /**
     * Show the form for editing the specified resource..
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actividad $actividad)
    {
        //
    }
}
