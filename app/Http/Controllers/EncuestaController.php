<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\TutorTutorado;
use BienestarWeb\user;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\Encuesta;
use BienestarWeb\Alternativa;
use BienestarWeb\SeccionEncuesta;
use BienestarWeb\PreguntaEncuesta;
use BienestarWeb\EncuestaRespondida;
use Bienestar\Semestre;

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
      $request->validate([
         'titulo' => 'required',
      ]);
      switch( $request->tipo_encuesta ){
         case 1: $destino = $request->destino_1; break;
         case 2: $destino = implode('_', $request->destino_2); break;
         case 3: $destino = $request->destino_3; break;
      }
      $nueva_encuesta = Encuesta::create([
         'titulo' => $request->titulo,
         'tipo' => $request->tipo_encuesta,
         'destino' => $destino,
         'descripcion' => $request->descripcion,
         'idTipoActividad' => (($request->tipo_encuesta != 1)? null : $request->idTipoActividad)
      ]);

      $entradas = $request->except(['_method', '_token', 'titulo', 'descripcion', 'destino_1', 'destino_2', 'destino_3', 'idTipoActividad', 'tipo_encuesta']);
      $valor = 1;
      $orden = 1;
      $n_seccion = 1;
      $titulo_stemp_new = "";
      $seccion_actual_new = null;
      foreach ( $entradas as $llave => $entrada) {
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
      dd($request);
      $request->validate([
         'titulo' => 'required',
      ]);
      //dd($request);
      switch( $request->tipo_encuesta ){
         case 1: $destino = $request->destino_1; break;
         case 2: $destino = implode('_', $request->destino_2); break;
         case 3: $destino = $request->destino_3; break;
      }
      $encuesta = Encuesta::findOrFail($id);
      $encuesta->titulo = $request->titulo;
      $encuesta->tipo = $request->tipo_encuesta;
      $encuesta->destino = $destino;
      $encuesta->descripcion = $request->descripcion;
      $encuesta->idTipoActividad = (($request->tipo_encuesta != 1)? null : $request->idTipoActividad);
      $encuesta->update();

      $entradas = $request->except(['_method', '_token', 'titulo', 'descripcion', 'destino_1', 'destino_2', 'destino_3', 'idTipoActividad', 'tipo_encuesta']);
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
      foreach ( $entradas as $llave => $entrada) {
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
               $seccion_actual->update();
               $n_seccion++;
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
               $pregunta->orden = $orden;
               $pregunta->update();
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
         //next($entradas);
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

    public function send(Request $request, $id){
      $encuesta = Encuesta::findOrFail($id);
      $alumnos = null;
      $docentes = null;
      $administrativos = null;
      if( $encuesta->tipo == 2){
         if(strpos($encuesta->destino, '1') !== false){
            $alumnos = User::where('idTipoPersona', 1)->get();
         }
         if(strpos($encuesta->destino, '2') !== false){
            $docentes = User::where('idTipoPersona', 2)->get();
         }
         if(strpos($encuesta->destino, '3') !== false){
            $administrativos = User::where('idTipoPersona', 3)->get();
         }
         return view('admin.encuesta.send')
         ->with('encuesta', Encuesta::findOrFail($id))
         ->with('alumnos', $alumnos)
         ->with('docentes', $docentes)
         ->with('administrativos', $administrativos);
      }
      if( $encuesta->tipo == 3 ){

         if($encuesta->destino == 'd'){
            $tutores = TutorTutorado::join('docente','tutorTutorado.idDocente','=','docente.idDocente')
              ->join('user','docente.idUser', '=','user.id' )
              ->select('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo', 'user.id')
              ->groupBy('docente.idDocente','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo', 'user.id')
              ->get();
           return view('admin.encuesta.send')
           ->with('encuesta', $encuesta)
           ->with('tutores', $tutores);
         }else{
            $tutorados = TutorTutorado::join('alumno','tutorTutorado.idAlumno','=','alumno.idAlumno')
              ->join('user','alumno.idUser', '=','user.id' )
              ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo', 'user.id')
              ->groupBy('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo', 'user.id')
              ->get();
           return view('admin.encuesta.send')
           ->with('encuesta', $encuesta)
           ->with('tutorados', $tutorados);
         }

      }

   }

   public function store_send(Request $request, $id){
      $encuesta = Encuesta::findOrFail($id);
      $fh_registro = date('Y-m-d H:i');
      if( $encuesta->tipo == 2){
         if(strpos($encuesta->destino, '1') !== false){
            foreach ($request->alumnos as $alumno) {
               EncuestaRespondida::create([
                  'idUser' => $alumno,
                  'idEncuesta' => $id,
                  'fh_envio' => $request->fecha_envio.' '.$request->hora_envio,
                  'fh_registro' => $fh_registro
               ]);
            }
         }
         if(strpos($encuesta->destino, '2') !== false){
            foreach ($request->docentes as $docente) {
               EncuestaRespondida::create([
                  'idUser' => $docente,
                  'idEncuesta' => $id,
                  'fh_envio' => $request->fecha_envio.' '.$request->hora_envio,
                  'fh_registro' => $fh_registro
               ]);
            }
         }
         if(strpos($encuesta->destino, '3') !== false){
            foreach ($request->administrativos as $administrativo) {
               EncuestaRespondida::create([
                  'idUser' => $administrativo,
                  'idEncuesta' => $id,
                  'fh_envio' => $request->fecha_envio.' '.$request->hora_envio,
                  'fh_registro' => $fh_registro
               ]);
            }
         }
      }
      if( $encuesta->tipo == 3 ){
         if($encuesta->destino == 'd'){
            foreach ($request->tutores as $tutor) {
               EncuestaRespondida::create([
                  'idUser' => $tutor,
                  'idEncuesta' => $id,
                  'fh_envio' => $request->fecha_envio.' '.$request->hora_envio,
                  'fh_registro' => $fh_registro
               ]);
            }
         }else{
            foreach ($request->tutorados as $tutorado) {
               EncuestaRespondida::create([
                  'idUser' => $tutorado,
                  'idEncuesta' => $id,
                  'fh_envio' => $request->fecha_envio.' '.$request->hora_envio,
                  'fh_registro' => $fh_registro
               ]);
            }
         }
      }
      return Redirect::to('admin/encuesta');
   }


   public function member_show(Request $request, $id){
      $encResp = EncuestaRespondida::findOrFail($id);
      $encuesta = Encuesta::findOrFail($encResp->idEncuesta);
      return view('miembro.mis-encuestas.show')
         ->with('encuesta', $encuesta)
         ->with('idEncuestaRespondida', $id);
   }

   public function store_answers(Request $request, $id){
      $encResp= EncuestaRespondida::findOrFail($id);
      if($encResp->estado == '0' && $request->user()->id == $encResp->idUser){
         $preguntas = $encResp->encuesta->preguntas->where('estado', 1);
         foreach ( $preguntas as $pregunta ) {
            $encResp->preguntas()->attach($pregunta->idPregunta, ['respuesta' => $request->input($pregunta->idPregunta)]);
         }
         $encResp->estado = '1';
         $encResp->update();
      }else{
         abort('401');
      }
      return redirect('/');
   }

   public function details($id){
      $encuesta = Encuesta::findOrFail($id);
      $respondidas = EncuestaRespondida::where(['idEncuesta' => $id, 'estado' => 1]);
      $fh_envios = $respondidas->groupBy('fh_envio')->pluck('fh_envio');

      $respXfh = [];
      foreach ($fh_envios as $fh_envio) {
         array_push($respXfh, EncuestaRespondida::where(['fh_envio' => $fh_envio, 'estado' => 1])->get());
      }
      $preguntas = $encuesta->preguntas;
      $alternativas = $encuesta->alternativas;
      $matriz_frecuencia = [];

      foreach ($respXfh as $envio) {  // $envio es una collection de EncuestaRespondida que tienen la misma fecha de envio
         $envio_frec = [];
         foreach ($preguntas->where('estado', 1) as $pregunta) {
            $preguntas_frec = [];
            foreach ($alternativas as $alternativa) {
               $preguntas_frec[$alternativa->idAlternativa] = 0;
            }
            $envio_frec[$pregunta->idPregunta] = $preguntas_frec;
         }

         foreach ($envio as $enc_res) { //$enc_res es un objeto de EncuestaRespondida
            foreach ($enc_res->preguntas->where('estado', 1) as $pregunta) { //acceso a la tabla PIVOTE RptaEncuesta
               $envio_frec[$pregunta->idPregunta][$pregunta->pivot->respuesta] ++;
            }
         }
         array_push($matriz_frecuencia, $envio_frec);
      }
      $alt = $encuesta->alternativas->sortBy('valor');
      $alt = $alt->values();
      return view('admin.encuesta.details')
         ->with('encuesta', $encuesta)
         ->with('alternativas', $alt)
         ->with('respXfh', $respXfh)
         ->with('matriz_frecuencia', $matriz_frecuencia);
   }
}
