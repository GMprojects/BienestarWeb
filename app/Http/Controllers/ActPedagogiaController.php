<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

use BienestarWeb\ActPedagogia;
use BienestarWeb\Actividad;
use BienestarWeb\InscripcionAlumno;

class ActPedagogiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $idActividad, $idTutoradoADA)
    {
         $inscAlumno = InscripcionAlumno::where('idActividad',$idActividad)->where('idInscripcionADA', $idTutoradoADA)->first();
         $alumno = $inscAlumno->alumno;
         $actividad = Actividad::findOrFail($idActividad);
         $actPedagogia = ActPedagogia::where('idActividad',$idActividad)->where('idInscripcionAlumno', $inscAlumno->idInscripcionAlumno)->first();
         return view('programador.actividad.actTutoria.create',['tutorado' => $alumno->user, 'actPedagogia' => $actPedagogia, 'idTutor' => $actividad->responsable->docente->idDocente,'anioSemestre' => $actividad->anioSemestre, 'numeroSemestre' => $actividad->numeroSemestre]);
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
     * @param  \BienestarWeb\ActPedagogia  $actPedagogia
     * @return \Illuminate\Http\Response
     */
    public function show(ActPedagogia $actPedagogia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\ActPedagogia  $actPedagogia
     * @return \Illuminate\Http\Response
     */
    public function edit(ActPedagogia $actPedagogia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\ActPedagogia  $actPedagogia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $actPedagogia = ActPedagogia::findOrFail($id);
         $actPedagogia->canalizacion = $request->canalizacion;
         $actPedagogia->update();
         return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\ActPedagogia  $actPedagogia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActPedagogia $actPedagogia)
    {
        //
    }
}
