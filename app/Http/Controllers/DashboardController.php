<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;

use BienestarWeb\Actividad;
use DB;

class DashboardController extends Controller{

   public function index(){
      $actPendientes = Actividad::where('estado','1')->count();
      $actEjecutadas = Actividad::where('estado','2')->count();
      $actCanceladas = Actividad::where('estado','3')->count();
      $actExpiradas = Actividad::where('estado','4')->count();
      $estados = array($actPendientes, $actEjecutadas, $actCanceladas, $actExpiradas);
      $semestres = Actividad::select('anioSemestre','numeroSemestre')->distinct()->get();
      return view('admin.dashboard.index')->with('semestres', $semestres->toArray())->with('estados', $estados);

   }

   public function reIndex(Request $request){
      if($request->ajax()){
         if ($request->anioSemestre == 0 && $request->numeroSemestre == 0) {
            $actPendientes = Actividad::where('estado','1')->count();
            $actEjecutadas = Actividad::where('estado','2')->count();
            $actCanceladas = Actividad::where('estado','3')->count();
            $actExpiradas = Actividad::where('estado','4')->count();
            $estados = array($actPendientes, $actEjecutadas, $actCanceladas, $actExpiradas);
         } else {
            $actPendientes = Actividad::where([['estado','1'],['anioSemestre', $request->anioSemestre],['numeroSemestre', $request->numeroSemestre]])->count();
            $actEjecutadas = Actividad::where([['estado','2'],['anioSemestre', $request->anioSemestre],['numeroSemestre', $request->numeroSemestre]])->count();
            $actCanceladas = Actividad::where([['estado','3'],['anioSemestre', $request->anioSemestre],['numeroSemestre', $request->numeroSemestre]])->count();
            $actExpiradas = Actividad::where([['estado','4'],['anioSemestre', $request->anioSemestre],['numeroSemestre', $request->numeroSemestre]])->count();
            $estados = array($actPendientes, $actEjecutadas, $actCanceladas, $actExpiradas);
         }
         return response()->json($estados);
      }
   }

   public function listarActividades(Request $request){
      dd($request);
   }

}
