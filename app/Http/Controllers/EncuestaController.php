<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\Encuesta;
use BienestarWeb\Alternativa;
use BienestarWeb\SeccionEncuesta;
use BienestarWeb\PreguntaEncuesta;
use BienestarWeb\EncuestaRespondida;
use BienestarWeb\RptaEncuesta;
use BienestarWeb\TutorTutorado;

use BienestarWeb\Actividad;
use BienestarWeb\TipoActividad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

use BienestarWeb\Http\Controllers\Controller;

class EncuestaController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request){
          $tiposActividad=TipoActividad::get();
          $encuestas = Encuesta::get();
          $cant_enc_resp = [];
          foreach ($encuestas as $encuesta) {
             array_push($cant_enc_resp, EncuestaRespondida::where(['idEncuesta' => $encuesta->idEncuesta, 'estado' => '1'])->count());
          }
          //dd($cant_enc_resp);
          return view('admin.encuesta.index')->with('encuestas',$encuestas)->with('cant_enc_resp', $cant_enc_resp);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(){
           $tiposActividad=TipoActividad::all();
           return view('admin.encuesta.create')->with('tipos',$tiposActividad);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      //dd($request);
      $request->validate([
         'titulo' => 'required',
      ]);
      $nueva_encuesta = Encuesta::create([
         'titulo' => $request->titulo,
         'tipo' => $request->tipo_encuesta,
         'destino' => (($request->tipo_encuesta == 2)? implode('_', $request->destino) : $request->destino),
         'descripcion' => $request->descripcion,
         'idTipoActividad' => $request->idTipoActividad
      ]);

      $inputs = $request->except(['_method', '_token', 'titulo', 'destino', 'idTipoActividad', 'tipo_encuesta']);
      $valor = 1;
      $orden = 1;
      $n_seccion = 1;
      $titulo_stemp = "";
      $seccion_actual = null;
      foreach ( $inputs as $in_put) {
         $llave = key($inputs);
         if(strpos($llave, 'a_') !== false){ //ALTERNATIVA añadida
            Alternativa::create([
               'etiqueta' => $in_put,
               'valor' => $valor,
               'idEncuesta' => $nueva_encuesta->idEncuesta
            ]);
            $valor++;
         }
         if(strpos($llave, 'titulo_s') !== false){ //SECCION añadida
            $titulo_stemp = $in_put;
         }
         if(strpos($llave, 'descripcion_s') !== false){
            $seccion_actual = SeccionEncuesta::create([
               'titulo' => $titulo_stemp,
               'descripcion' => $in_put,
               'orden' => $n_seccion,
               'idEncuesta' => $nueva_encuesta->idEncuesta
            ]);
            $n_seccion++;
         }
         if(strpos($llave, '_e') !== false){ //ENUNCIADO añadido
            list($st_seccion, $st_enunciado) = explode('_', $llave);
            PreguntaEncuesta::create([
               'enunciado' => $in_put,
               'orden' => $orden,
               'idSeccion' => ((str_replace("s", "", $st_seccion) == "0")? null : $seccion_actual->idSeccion),
               'idEncuesta' => $nueva_encuesta->idEncuesta
            ]);
            $orden++;
         }
         next($inputs);
      }
      return Redirect::to('admin/encuesta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      $encuesta = Encuesta::findOrFail($id);
      return view('admin.encuesta.show')->with('encuesta', $encuesta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $tipos=TipoActividad::get();
        $preguntas = PreguntaEncuesta::where('idEncuesta', $id);
        return view('admin.encuesta.edit')
        ->with('encuesta',Encuesta::findOrFail($id))
        ->with('tipos',$tipos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      //dd($request->except(['_method', '_token', 'titulo', 'destino']));
      $request->validate([
         'titulo' => 'required'
      ]);
      $encuesta = Encuesta::findOrFail($id);
      $encuesta->titulo = $request->titulo;
      $encuesta->destino = $request->destino;
      $encuesta->update();

      $inputs = $request->except(['_method', '_token', 'titulo', 'destino']);
      $valor = 1;
      $orden = 1;

      $alternativas = $encuesta->alternativas;
      $preguntas_actuales = $encuesta->preguntas;
      //dd($preguntas->whereNotIn('idPreguntaEncuesta', [52]));
      foreach ( $inputs as $in_put) {
         $llave = key($inputs);
         if(strpos($llave, 'e_a') !== false){ //etiqueta añadida
            Alternativa::create([
               'etiqueta' => $in_put,
               'valor' => $valor,
               'idEncuesta' => $id
            ]);
            $valor++;
         }else if(strpos($llave, 'e') !== false){ //etiqueta existente
            $alternativa = Alternativa::findOrFail(str_replace("e", "", $llave));
            $alternativa->etiqueta = $in_put;
            $alternativa->valor = $valor;
            $alternativa->update();
            $valor++;
         }if(strpos(key($inputs), 'p_a') !== false){ //pregunta añadida
            PreguntaEncuesta::create([
               'enunciado' => $in_put,
               'idEncuesta' => $id
            ]);
            $orden++;
         }else if(strpos(key($inputs), 'p') !== false){ //pregunta existente
            $pregunta = PreguntaEncuesta::findOrFail(str_replace("p", "", $llave));
            $pregunta->enunciado = $in_put;
            $pregunta->orden = $orden;
            $pregunta->update();
            $preguntas_actuales = $preguntas_actuales->whereNotIn('idPreguntaEncuesta', [str_replace("p", "", $llave)]);
            $orden++;
         }
         next($inputs);
      }
      foreach ($preguntas_actuales as $pregunta_actual) {
         $pregunta_actual->estado = 0;
         $pregunta_actual->update();
      }
      return Redirect::to('admin/encuesta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $encuesta = Encuesta::findOrFail($id);
      Encuesta::destroy($id);
      return Redirect::to('admin/encuesta');
    }

    public function getMisEncuestasPendientes(Request $request){
      /* Inscrito */

      switch ($request->user()->idTipoPersona) {
         case '1'://Alumno
            $idAlumno = Alumno::where('idUser', $request->id)->value('idAlumno');
            $insc_asis = InscripcionAlumno::where(['idAlumno' => $idAlumno, 'asistencia' => '1'])->pluck('idInscripcionADA');
            $insc_noresp = EncuestaRespondidaInsc::whereIn('idInscripcionADA', $insc_asis)->where('estado', '0')->get();
            break;
         case '2'://Docente
            $idDocente = Docente::where('idUser', $request->id)->value('idDocente');
            $insc_asis = InscripcionDocente::where(['idDocente' => $idDocente, 'asistencia' => '1'])->pluck('idInscripcionADA');
            $insc_noresp = EncuestaRespondidaInsc::whereIn('idInscripcionADA', $insc_asis)->where('estado', '0')->get();
            break;
         case '3'://Administrativo
            $idAdministrativo = Administrativo::where('idUser', $request->id)->value('idAdministrativo');
            $insc_asis = InscripcionAdministrativo::where(['idAdministrativo' => $idAdministrativo, 'asistencia' => '1'])->pluck('idInscripcionADA');
            $insc_noresp = EncuestaRespondidaInsc::whereIn('idInscripcionADA', $insc_asis)->where('estado', '0')->get();
            break;
      }
      /* Responsable */
      $resp_act = Actividad::where(['idUserResp' => $request->id, 'estado' => '2'])->pluck('idActividad');
      $resp_noresp = EncuestaRespondidaResp::whereIn('idActividad', $resp_act)->where('estado', '0')->get();
      if($request->ajax()){
         //$enc_noresp = [ 'insc_noresp' => $insc_noresp, 'resp_noresp' => $resp_noresp ];
         return response()->json(['insc_noresp' => $insc_noresp, 'resp_noresp' => $resp_noresp]);
      }else{
         return view('miembro.mis-encuestas.todas', ['insc_noresp'=>$insc_noresp, 'resp_noresp'=>$resp_noresp]);
      }
   }

   public function encuestaInsc(Request $request, $id){
      $encResp_insc = EncuestaRespondidaInsc::findOrFail($id);
      return view('miembro.mis-encuestas.show')
         ->with(['encResp' => $encResp_insc, 'opt'=>'1']);
   }

   public function encuestaResp(Request $request, $id){
      $encResp_resp = EncuestaRespondidaResp::findOrFail($id);
      return view('miembro.mis-encuestas.show')
         ->with(['encResp' => $encResp_resp, 'opt'=>'2']);
   }

   public function registrar_respuestas(Request $request, $id, $opt){
      switch($opt){
         case '1': //encuesta de Inscrito
            $encResp_insc = EncuestaRespondidaInsc::findOrFail($id);
            if($encResp_insc->estado == '0'){
               $preguntas = $encResp_insc->encuesta->preguntas;
               for ($i=0; $i < count($preguntas) ; $i++) {
                  $encResp_insc->preguntas()->attach($preguntas[$i], ['respuesta' => $request->input($preguntas[$i]->idPreguntaEncuesta)]);
               }
               $encResp_insc->estado = '1';
               $encResp_insc->update();
            }
            break;
         case '2': //encuesta de Responsable
            $encResp_resp = EncuestaRespondidaResp::findOrFail($id);
            if($encResp_resp->estado == '0'){
               $preguntas = $encResp_resp->encuesta->preguntas;
               for ($i=0; $i < count($preguntas) ; $i++) {
                  $encResp_resp->preguntas()->attach($preguntas[$i], ['respuesta' => $request->input($preguntas[$i]->idPreguntaEncuesta)]);
               }
               $encResp_resp->estado = '1';
               $encResp_resp->update();
            }
            break;
      }
      return redirect('/');
   }


   public function getHabitoEstudio($idEncuestaRespondida){
      $encuesta = Encuesta::findOrFail((EncuestaRespondida::findOrFail($idEncuestaRespondida))->idEncuesta);
      return view('miembro.tutorado.habitoEstudio.mis-habitos')->with('encuesta', $encuesta)->with('idEncuestaRespondida', $idEncuestaRespondida);
   }

   public function storeHabitoEstudio(Request $request, $idEncuestaRespondida){
      $inputs = $request->except(['_method', '_token']);
      list($keys, $values) = array_divide($inputs);
      $encuestaRespondida = EncuestaRespondida::findOrFail($idEncuestaRespondida);
      dd($encuestaRespondida->tutorTutorado);
      for ($i=0; $i < count($keys) ; $i++) {
         $rptaEncuesta = new RptaEncuesta;
         $rptaEncuesta->respuesta = $values[$i];
         $rptaEncuesta->idEncuestaRespondida = $idEncuestaRespondida;
         $rptaEncuesta->idPregunta = $keys[$i];;
         $rptaEncuesta->save();
      }
      $encuestaRespondida = EncuestaRespondida::findOrFail($idEncuestaRespondida);
      TutorTutorado::where('idTutorTutorado', $encuestaRespondida->tutorTutorado->idTutorTutorado)->increment('habitoEstudioRespondido');
      //return view('miembro.mis-encuestas.todos');
      return redirect('/');
   }

   public function showHabitoEstudio($idTutorTutorado){
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
   }
}
