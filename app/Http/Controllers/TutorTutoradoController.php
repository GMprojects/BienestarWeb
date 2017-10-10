<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\TutorTutorado;
use BienestarWeb\Docente;
use BienestarWeb\Alumno;
use BienestarWeb\User;
use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

class TutorTutoradoController extends Controller
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
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function show(TutorTutorado $tutorTutorado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function edit(TutorTutorado $tutorTutorado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TutorTutorado $tutorTutorado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\TutorTutorado  $tutorTutorado
     * @return \Illuminate\Http\Response
     */
    public function destroy(TutorTutorado $tutorTutorado)
    {
        //
    }

    public function getTutores(Request $request){
    //    dd($request);
      if($request->ajax()){
          $users = Docente::join('tutorTutorado','docente.idDocente', '=','tutorTutorado.idDocente' )
              ->join('user','docente.idUser', '=','user.idUser' )
              ->where('tutorTutorado.numeroSemestre', '=', $request->numeroSemestre)
              ->where('tutorTutorado.anioSemestre', '=',  $request->anioSemestre)
              ->select('user.idUser','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
              ->distinct()
              ->get();
          return response()->json($users);
      }
    }

    public function getTutorados(Request $request){
    //    dd($request);
      if($request->ajax()){
          $idDocente = Docente::where('idUser', '=',  $request->idUser )->value('idDocente');
          $users = Alumno::join('tutorTutorado','alumno.idAlumno', '=','tutorTutorado.idAlumno' )
              ->join('user','alumno.idUser', '=','user.idUser' )
              ->where('tutorTutorado.idDocente', '=', $idDocente)
              ->where('tutorTutorado.numeroSemestre', '=', $request->numeroSemestre)
              ->where('tutorTutorado.anioSemestre', '=',  $request->anioSemestre)
              ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
              ->get();
          return response()->json($users);
      }
    }
}
