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

use BienestarWeb\Actividad;
use BienestarWeb\TipoActividad;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
      dd($request);
      $request->validate([
         'titulo' => 'required',
      ]);
      $nueva_encuesta = Encuesta::create([
         'titulo' => $request->titulo,
         'tipo' => $request->tipo_encuesta,
         'destino' => (($request->tipo_encuesta == 2)? implode('_', $request->destino) : $request->destino),
         'descripcion' => $request->descripcion,
         'idTipoActividad' => (($request->tipo_encuesta == 2)? null : $request->idTipoActividad)
      ]);

      $entradas = $request->except(['_method', '_token', 'titulo', 'destino', 'idTipoActividad', 'tipo_encuesta']);
      $valor = 1;
      $orden = 1;
      $n_seccion = 1;
      $titulo_stemp_new = "";
      $seccion_actual_new = null;
      foreach ( $entradas as $entrada) {
         $llave = key($entradas);
         if(strpos($llave, 'a_') !== false){ //ALTERNATIVA añadida
            Alternativa::create([
               'etiqueta' => $entrada,
               'valor' => $valor,
               'idEncuesta' => $nueva_encuesta->idEncuesta
            ]);
            $valor++;
         }
         if(strpos($llave, 'titulo_s') !== false){ //SECCION añadida
            $titulo_stemp_new = $entrada;
         }
         if(strpos($llave, 'descripcion_s') !== false){
            $seccion_actual_new = SeccionEncuesta::create([
               'titulo' => $titulo_stemp_new,
               'descripcion' => $entrada,
               'orden' => $n_seccion,
               'idEncuesta' => $nueva_encuesta->idEncuesta
            ]);
            $n_seccion++;
         }
         if(strpos($llave, '_e') !== false){ //ENUNCIADO añadido
            list($st_seccion, $st_enunciado) = explode('_', $llave);
            PreguntaEncuesta::create([
               'enunciado' => $entrada,
               'orden' => $orden,
               'idSeccion' => ((str_replace("s", "", $st_seccion) == "0")? null : $seccion_actual_new->idSeccion),
               'idEncuesta' => $nueva_encuesta->idEncuesta
            ]);
            $orden++;
         }
         next($entradas);
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
      //$encResp_insc = EncuestaRespondidaInsc::findOrFail($id);

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
        return view('admin.encuesta.edit')
        ->with('encuesta', Encuesta::findOrFail($id))
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
      $request->validate([
         'titulo' => 'required',
      ]);
      $encuesta = Encuesta::findOrFail($id);
      $encuesta->titulo = $request->titulo;
      $encuesta->tipo = $request->tipo_encuesta;
      $encuesta->destino = (($request->tipo_encuesta == 2)? implode('_', $request->destino) : $request->destino);
      $encuesta->descripcion = $request->descripcion;
      $encuesta->idTipoActividad = (($request->tipo_encuesta == 2)? null : $request->idTipoActividad);
      $encuesta->update();

      $entradas = $request->except(['_method', '_token', 'titulo', 'destino', 'idTipoActividad', 'tipo_encuesta']);
      $valor = 1;
      $orden = 1;
      $n_seccion = 1;
      $titulo_stemp_new = "";
      $titulo_stemp = "";
      $seccion_actual_new = null;
      $seccion_actual = null;

      $alternativas_actuales = $encuesta->alternativas->pluck('idAlternativa')->toArray();
      $preguntas_actuales = $encuesta->preguntas->pluck('idPregunta')->toArray();
      $secciones_actuales = $encuesta->secciones->pluck('idSeccion')->toArray();
      //dd($entradas);
      foreach ( $entradas as $entrada) {
         $llave = key($entradas);
         if( strpos($llave, '_new') !== false ){ //ELEMENTOS NUEVOS
            if(strpos($llave, 'a_') !== false){ //ALTERNATIVA añadida
               Alternativa::create([
                  'etiqueta' => $entrada,
                  'valor' => $valor,
                  'idEncuesta' => $id
               ]);
               $valor++;
            }
            if(strpos($llave, 'titulo_s') !== false){ //SECCION añadida
               $titulo_stemp_new = $entrada;
            }
            if(strpos($llave, 'descripcion_s') !== false){
               $seccion_actual_new = SeccionEncuesta::create([
                  'titulo' => $titulo_stemp_new,
                  'descripcion' => $entrada,
                  'orden' => $n_seccion,
                  'idEncuesta' => $id
               ]);
               $n_seccion++;
            }
            if(strpos($llave, '_e') !== false){ //ENUNCIADO añadido
               //substr_count($llave, '_new') == 1 el nuevo enunciado está en una sección que ya existe
               //substr_count($llave, '_new') == 2 el nuevo enunciado está en una sección nueva
               list($st_seccion, $st_enunciado) = explode('_', str_replace("_new", "", $llave));
               PreguntaEncuesta::create([
                  'enunciado' => $entrada,
                  'orden' => $orden,
                  'idSeccion' => ((str_replace("s", "", $st_seccion) == "0")? null : ( (substr_count($llave, '_new') == 1)? $seccion_actual->idSeccion : $seccion_actual_new->idSeccion )),
                  'idEncuesta' => $id
               ]);
               $orden++;
            }
         }else{
            if(strpos($llave, 'a_') !== false){ //ALTERNATIVA modificada
               $alternativa = Alternativa::find(str_replace("a_", "", $llave));
               $alternativa->etiqueta = $entrada;
               $alternativa->valor = $valor;
               $alternativa->update();
               $valor++;
               for ($i=0; $i < count($alternativas_actuales); $i++) {
                  if(strcmp($alternativas_actuales[$i], $alternativa->idAlternativa) == 0){
                     unset($alternativas_actuales[$i]);
                     $alternativas_actuales = array_values($alternativas_actuales);
                     break;
                  }
               }
            }
            if(strpos($llave, 'titulo_s') !== false){ //SECCION modificada
               $seccion_actual = SeccionEncuesta::find(str_replace("titulo_s", "", $llave));
               $titulo_stemp = $entrada;
            }
            if(strpos($llave, 'descripcion_s') !== false){
               $seccion_actual->titulo = $titulo_stemp;
               $seccion_actual->descripcion = $entrada;
               $seccion_actual->orden = $n_seccion;
               $n_seccion++;
               echo '<br />'.count($secciones_actuales).'<br />';
               for ($j=0; $j < count($secciones_actuales); $j++) {
                  if($secciones_actuales[$j] == $seccion_actual->idSeccion){
                     unset($secciones_actuales[$j]);
                     $secciones_actuales = array_values($secciones_actuales);
                     break;
                  }
               }

            }
            if(strpos($llave, '_e') !== false){ //ENUNCIADO modificada
               list($st_seccion, $st_enunciado) = explode('_', $llave);
               $pregunta = PreguntaEncuesta::find(str_replace("e", "", $st_enunciado));
               $pregunta->enunciado = $entrada;
               $pregunta->ordern = $orden;
               $orden++;
               for ($h=0; $h < count($preguntas_actuales); $h++) {
                  if($preguntas_actuales[$h] === $pregunta->idPregunta){
                     unset($preguntas_actuales[$h]);
                     $preguntas_actuales = array_values($preguntas_actuales);
                     break;
                  }
               }
            }
         }
         next($entradas);
      }
      foreach ($preguntas_actuales as $pregunta_actual) {
         $p = PreguntaEncuesta::findOrFail($pregunta_actual);
         $p->estado = 0;
         $p->update();
      }
      for($j=0 ; $j<count($secciones_actuales) ; $j++) {
         echo 'what';
         $s = SeccionEncuesta::findOrFail($secciones_actuales[$j]);
         $s->estado = 0;
         $s->update();
      }
      foreach ($alternativas_actuales as $alternativa_actual) {
         $a = Alternativa::findOrFail($alternativa_actual);
         $a->destroy();
      }
      //dd($preguntas_actuales);
      //dd($secciones_actuales);
      //dd($alternativas_actuales);

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

    public function misEncuPendientes(Request $request){
      /* Inscrito */

      switch ($request->user()->idTipoPersona) {
         case '1'://Alumno
            $idAlumno = Alumno::where('idUser', $request->id)->value('idAlumno');
            $insc_asis = InscripcionAlumno::where(['idAlumno' => $idAlumno, 'asistencia' => '1'])->pluck('idInscripcionADA');
            $insc_noresp = EncuestaRespondida::whereIn('idInscripcionADA', $insc_asis)->where('estado', '0')->get();
            break;
         case '2'://Docente
            $idDocente = Docente::where('idUser', $request->id)->value('idDocente');
            $insc_asis = InscripcionDocente::where(['idDocente' => $idDocente, 'asistencia' => '1'])->pluck('idInscripcionADA');
            $insc_noresp = EncuestaRespondida::whereIn('idInscripcionADA', $insc_asis)->where('estado', '0')->get();
            break;
         case '3'://Administrativo
            $idAdministrativo = Administrativo::where('idUser', $request->id)->value('idAdministrativo');
            $insc_asis = InscripcionAdministrativo::where(['idAdministrativo' => $idAdministrativo, 'asistencia' => '1'])->pluck('idInscripcionADA');
            $insc_noresp = EncuestaRespondida::whereIn('idInscripcionADA', $insc_asis)->where('estado', '0')->get();
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
}
