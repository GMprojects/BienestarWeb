<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Encuesta;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\EncuestaRespondidaInsc;
use BienestarWeb\EncuestaRespondidaResp;
use BienestarWeb\RptaEncuestaInsc;
use BienestarWeb\RptaEncuestaResp;
use BienestarWeb\Actividad;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;
use BienestarWeb\TipoActividad;
use BienestarWeb\PreguntaEncuesta;
use BienestarWeb\Alternativa;

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
        return view('admin.encuesta.index')->with('encuestas',$encuestas)
                                           ->with('tiposActividad',$tiposActividad);
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
      $encuesta = Encuesta::create([
         'titulo' => $request->titulo,
         'destino' => $request->destino,
         'idTipoActividad' => $request->idTipoActividad
      ]);

      $verificado = 0;
      $i = 0;
      while ((count($request->all())- 8) != $verificado) {
         if($request->input('e'.$i) != null){
            Alternativa::create([
               'etiqueta' => $request->input('e'.$i),
               'valor' => $request->input('v'.$i),
               'idEncuesta' => $encuesta->idEncuesta
            ]);
            $verificado = $verificado + 2;
         }
         if($request->input('p'.$i) != null){
            PreguntaEncuesta::create([
               'enunciado' => $request->input('p'.$i),
               'idEncuesta' => $encuesta->idEncuesta
            ]);
            $verificado++;
         }
         $i++;
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
        $tiposActividad=TipoActividad::get();
        return view('admin.encuesta.edit')
        ->with('encuesta',Encuesta::findOrFail($id))
        ->with('tiposActividad',$tiposActividad);
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
            'titulo' => 'required'
            ]);
        $encuesta = Encuesta::findOrFail($id);
        $encuesta->titulo = $request->get('titulo');
        $encuesta->destino = $request->get('destino');
        $encuesta->update();
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
        if((PreguntaEncuesta::where('idEncuesta',$id)->count())>0){
            PreguntaEncuesta::where('idEncuesta',$id)->delete();
        }
      //dd(Alternativa::where('idEncuesta',$id)->count());
        if((Alternativa::where('idEncuesta',$id)->count())>0){
            Alternativa::where('idEncuesta',$id)->delete();
            //dd(Alternativa::where('idEncuesta',$id));
        }
        Encuesta::destroy($id);
        return Redirect::to('admin/encuesta');
    }

    public function misEncuPendientes(Request $request){
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
}
