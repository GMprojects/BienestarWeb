<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Semestre;
use Illuminate\Http\Request;

use BienestarWeb\Rules\SemestreValidation;
use BienestarWeb\Rules\NumSemestreValidation;

use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class SemestreController extends Controller{

      function getFecha($fechaIn){
         $dia = substr( $fechaIn,0 ,2);
         $mes =substr( $fechaIn,3 ,2);
         $anio=substr( $fechaIn,-4 ,4);
         return $anio."-".$mes."-".$dia;
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
          $semestres = Semestre::orderBy('fechaInicio')->get();
          return view('admin.semestre.index')->with('semestres', $semestres)->with('numSemestres', count($semestres));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
          return view('admin.semestre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
          $request->validate([
             'fechaInicio' => ['required', 'date_format:"d/m/Y"', new SemestreValidation(null)],
             'fechaFin' => ['required', 'after:fechaInicio', 'date_format:"d/m/Y"', new SemestreValidation(null)],
             'numeroSemestre' => ['required', new NumSemestreValidation($request->anioSemestre)]
          ]);
          $semestre = new Semestre;
          $semestre->fechaInicio = SemestreController::getFecha($request->fechaInicio);
          $semestre->fechaFin = SemestreController::getFecha($request->fechaFin);
          $semestre->anioSemestre = $request->anioSemestre;
          $semestre->numeroSemestre = $request->numeroSemestre;
          $semestre->save();
          return Redirect::to('admin/semestre');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function show(Semestre $semestre){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
       return view('admin.semestre.edit')->with('semestre', Semestre::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
         $request->validate([
           'fechaInicio' => ['required', 'date_format:"d/m/Y"', new SemestreValidation($id)],
           'fechaFin' => ['required', 'after:fechaInicio', 'date_format:"d/m/Y"', new SemestreValidation($id)]
        ]);
        $semestre = Semestre::findOrFail($id);
        $semestre->fechaInicio = SemestreController::getFecha($request->fechaInicio);
        $semestre->fechaFin = SemestreController::getFecha($request->fechaFin);
        $semestre->update();
        return Redirect::to('admin/semestre');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\Semestre  $semestre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       Semestre::destroy($id);
       return Redirect::to('admin/semestre');
    }
}
