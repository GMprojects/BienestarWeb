<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;

use BienestarWeb\Actividad;
use BienestarWeb\User;
use BienestarWeb\Encuesta;
use BienestarWeb\Alternativa;
use BienestarWeb\EncuestaRespondida;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller{

   public function index(){
      $actPendientes = Actividad::where('estado','1')->count();
      $actEjecutadas = Actividad::where('estado','2')->count();
      $actCanceladas = Actividad::where('estado','3')->count();
      $actExpiradas = Actividad::where('estado','4')->count();
      $estados = array($actPendientes, $actEjecutadas, $actCanceladas, $actExpiradas);
      /*          */
      $semestres = Actividad::select('anioSemestre','numeroSemestre')->distinct()->get();
      $actividadesProximas = Actividad::where([['estado','1'], ['fechaInicio','>=',(Carbon::now())->format('Y-m-d')]])->orderBy('fechaInicio', 'asc')->limit(5)->get();
      $idResponsablesFrecuentes = Actividad::select('idUserResp', DB::raw('count(idUserResp) as cantidad'))->groupBy('idUserResp')->orderBy('cantidad', 'desc')->limit(5)->pluck('idUserResp');
      $responsablesFrecuentes = User::whereIn('id', $idResponsablesFrecuentes)->get();
      $idProgramadoresFrecuentes = Actividad::select('idUserProg', DB::raw('count(idUserProg) as cantidad'))->groupBy('idUserProg')->orderBy('cantidad', 'desc')->limit(5)->pluck('idUserProg');
      $programadoresFrecuentes = User::whereIn('id', $idProgramadoresFrecuentes)->get();
      /*         */
      $actividadesAltas = Actividad::join('tipoActividad', 'actividad.idTipoActividad', '=', 'tipoActividad.idTipoActividad')
                        ->join('encuestarespondida', 'actividad.idActividad', '=', 'encuestaRespondida.idActividad')
                        ->join('rptaEncuesta', 'encuestaRespondida.idEncuestaRespondida', '=', 'rptaEncuesta.idEncuestaRespondida')
                        ->select('actividad.idActividad', 'titulo', 'tipoActividad.tipo', 'actividad.rutaImagen as actividadRutaImagen', 'tipoActividad.rutaImagen as tipoActividadRutaImagen', DB::raw('sum(rptaEncuesta.respuesta) as suma'))
                        ->where([['actividad.modalidad', '2'], ['actividad.estado','2']])
                        ->orderBy('suma', 'desc')
                        ->limit('5')
                        ->groupBy('actividad.idActividad', 'titulo', 'tipoActividad.tipo', 'actividadRutaImagen', 'tipoActividadRutaImagen')
                        ->get();
      /*
      $tutorTutorado = TutorTutorado::where('idTutorTutorado', $idTutorTutorado)->first();
      $user = $tutorTutorado->tutorado->user;

      $encuestaRespondida = EncuestaRespondida::where('idTutorTutorado', $idTutorTutorado)->first();
      $encuesta = Encuesta::findOrFail($encuestaRespondida->idEncuesta);
      $alternativas = Alternativa::where('idEncuesta', $encuesta->idEncuesta)->select('etiqueta', 'valor')->get();

      $i = 0;
      $respuesta_cantidad = array();
      foreach ($alternativas as $alternativa) {
         $respuesta_cantidad[$i] = RptaEncuesta::where([['idEncuestaRespondida', $encuestaRespondida->idEncuestaRespondida],
                                                        ['respuesta', $alternativa->valor]])
                                                 ->count('respuesta');
         $i++;
      }
      $respuestas = RptaEncuesta::where([['idEncuestaRespondida', $encuestaRespondida->idEncuestaRespondida]])->get();
      return view('miembro.tutor.habitoEstudio.show')->with('encuesta', $encuesta)
                                                     ->with('user', $user)
                                                     ->with('tutorTutorado', $tutorTutorado)
                                                     ->with('respuestas', $respuestas)
                                                     ->with('respuesta_cantidad', $respuesta_cantidad)
                                                     ->with('alternativas', $alternativas->toArray());
      */
      //solo una encuesta por tipo?
      //$encuesta = Encuesta::findOrFail($encuestaRespondida->idEncuesta);
      //$alternativas = Alternativa::where('idEncuesta', $encuesta->idEncuesta)->select('etiqueta', 'valor')->get();
      //$algo = EncuestaRespondida::join('rptaEncuesta','encuestaRespondida.idEncuestaRespondida','=','rptaEncuesta.idEncuestaRespondida')
      //->select('encuestaRespondida.idEncuesta', 'encuestaRespondida.idActividad', DB::raw('count(rptaEncuesta.idRptaEncuesta) as cantidad'))
      //->where([['encuestaRespondida.idActividad', '48'], ['encuestaRespondida.destino', 'i'], ['encuestaRespondida.pred', 'i']])
      //->groupBy('encuestaRespondida.idEncuesta', 'encuestaRespondida.idActividad')
      //->get();
      //dd($algo->toArray());
      return view('admin.dashboard.index', [ 'semestres' => $semestres->toArray(),
                                             'estados' => $estados,
                                             'actividadesProximas' => $actividadesProximas,
                                             'responsablesFrecuentes' => $responsablesFrecuentes,
                                             'programadoresFrecuentes' => $programadoresFrecuentes,
                                             'actividadesAltas' => $actividadesAltas ]);
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
