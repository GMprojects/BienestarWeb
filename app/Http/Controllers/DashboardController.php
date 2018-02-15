<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;

use BienestarWeb\Actividad;
use BienestarWeb\User;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller{

   public function index(){
      $actPendientes = Actividad::where('estado','1')->count();
      $actEjecutadas = Actividad::where('estado','2')->count();
      $actCanceladas = Actividad::where('estado','3')->count();
      $actExpiradas = Actividad::where('estado','4')->count();
      $estados = array($actPendientes, $actEjecutadas, $actCanceladas, $actExpiradas);
      $semestres = Actividad::select('anioSemestre','numeroSemestre')->distinct()->get();
      $actividadesProximas = Actividad::where([['estado','1'], ['fechaInicio','>=',(Carbon::now())->format('Y-m-d')]])->orderBy('fechaInicio', 'asc')->limit(5)->get();
      $idResponsablesFrecuentes = Actividad::select('idUserResp', DB::raw('count(idUserResp) as cantidad'))->groupBy('idUserResp')->orderBy('cantidad', 'desc')->limit(5)->pluck('idUserResp');
      $responsablesFrecuentes = User::whereIn('id', $idResponsablesFrecuentes)->get();
      $idProgramadoresFrecuentes = Actividad::select('idUserProg', DB::raw('count(idUserProg) as cantidad'))->groupBy('idUserProg')->orderBy('cantidad', 'desc')->limit(5)->pluck('idUserProg');
      $programadoresFrecuentes = User::whereIn('id', $idProgramadoresFrecuentes)->get();
      return view('admin.dashboard.index',['semestres' => $semestres->toArray(), 'estados' => $estados, 'actividadesProximas' => $actividadesProximas, 'responsablesFrecuentes' => $responsablesFrecuentes, 'programadoresFrecuentes' => $programadoresFrecuentes]);
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

   public function listarActividades(Request $request, $estado){
      //dd($request);
      if ($request->aS == 0 && $request->nS == 0) {
         $actividades = Actividad::where([['estado', $estado]])->get();
      } else {
         $actividades = Actividad::where([['estado', $estado],['anioSemestre', $request->aS],['numeroSemestre', $request->nS]])->get();
      }
      //dd($request->aS.' - '.$request->numeroSemestre);
      return view('admin.dashboard.actividades',['actividades' =>  $actividades, 'estado' => $estado, 'anioSemestre' => $request->aS, 'numeroSemestre' => $request->nS]);
   }

}
