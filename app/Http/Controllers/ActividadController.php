<?php


namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Actividad;
use BienestarWeb\ActGrupal;
use BienestarWeb\ActMovilidad;
use BienestarWeb\ActComedor;
use BienestarWeb\ActPedagogia;
use BienestarWeb\TipoActividad;
use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;
use BienestarWeb\InscripcionADA;
use BienestarWeb\Semestre;

use BienestarWeb\Docente;
use BienestarWeb\Administrativo;

use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use BienestarWeb\Jobs\JobNotificacionActividad;
use BienestarWeb\Jobs\JobMailBasico;

use File;
use Validator;
use Carbon\Carbon;

class ActividadController extends Controller{

   function getFecha($fechaIn){
      $dia = substr( $fechaIn,0 ,2);
      $mes =substr( $fechaIn,3 ,2);
      $anio=substr( $fechaIn,-4 ,4);
      return $anio."-".$mes."-".$dia;
   }
   function getRutaImagen($request){
      if($request->file('rutaImagen')){
         $file = $request->file('rutaImagen');
         $name = 'imgAct_'.time().'.'.$file->getClientOriginalExtension();
         $storage = Storage::disk('actividades')->put($name, \File::get($file));
         if($storage){
            return 'actividades/'.$name;
         }else{
            return NULL;
         }
      }
   }
   function getRutaImagenUpdate($request, $rutaImgAnterior){
       //Eliminando Foto anterior
       $path = $rutaImgAnterior;
       File::delete(storage_path('app/public/'.$rutaImgAnterior));
       Storage::delete($path);
       //Guardar la nueva imagen
         if($request->file('rutaImagen')){
            $file = $request->file('rutaImagen');
            $name = 'imgAct_'.time().'.'.$file->getClientOriginalExtension();
            $storage = Storage::disk('actividades')->put($name, \File::get($file));
            if($storage){
               return 'actividades/'.$name;
            }else{
               return NULL;
            }
         }else {
             $rutaImagen = $rutaImgAnterior;
         }
   }
   function getInivitado($request){
      if($request->nombreResponsable != NULL){
         return $request->nombreResponsable.'-'.$request->apellidosResponsable.'-'.$request->emailResponsable;
      }else{
         return NULL;
      }
   }
   function getModalidad($request){
      switch(preg_split("/[-]/",$request->idTipoActividad)[0]) {
         case '1': case '2': return 1;
         case '4':
            if(count($request->idAlumnoTutorado) > 1){
               return '2';
            }else{
               return '1';
            }
         case '5': case '6': case '7': case '8': case '9': return 2;
         case '3': case '10': return $request->modalidad;
         default:
            return 2;
      }
   }
   function getModalidadUpdate($request, $actividad){
      if($actividad->idTipoActividad == '4'){
         if(count($request->idAlumnoTutorado) > 1){
            return '2';
         }else{
            return '1';
         }
      }else{
         return $actividad->modalidad;
      }
   }
   function getCuposTotales($request){
      switch(preg_split("/[-]/",$request->idTipoActividad)[0]) {
         case '1':
         case '2': return 1;
         case '4': return count($request->idAlumnoTutorado);
         case '5':
         case '6':
         case '7': return $request->cuposTotales;
         case '3':
         case '10':
            if($request->modalidad == 1)
               return 1;
            else return $request->cuposTotales;
         case '8':
         case '9': return 1;
         default: return  $request->cuposTotales;
      }
   }
   function getCuposTotalesUpdate($request, $actividad){
      switch($actividad->idTipoActividad) {
         case '1':
         case '2': return 1;
         case '4': return count($request->idAlumnoTutorado);
         case '5':
         case '6':
         case '7': return $request->cuposTotales;
         case '8':
         case '9': return 2;
         case '3':
         case '10':
            if($actividad->modalidad == 1)
               return 1;
            else return $request->cuposTotales;
         default:
            return $request->cuposTotales;
      }
   }
   function getResp($request){
      if($request->idUserResp == null){
         return $request->user()->id;
      }else{
         return $request->idUserResp;
      }
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
      //$actividades = Actividad::where('estado', '<', '5')->orderBy('fechaInicio', 'asc')->get();
      $actividades = Actividad::where('estado', '<', '5')->orderBy('fechaInicio', 'desc')->get();
      return view('programador.actividad.index',[
         'actividades' => $actividades,
         'idUserProgramador' => $request->idUserProgramador,
         'idUserResponsable', $request->idUserResponsable,
         'idUserInscrito', $request->idUserInscrito,
         'estadoCancelado', $request->estadoCancelado]);
   }

   public function indexPorCategoria($idTipoActividad, Request $request){
      if ($idTipoActividad == '0') {
        $tipoActividad = null;
        $actividades = Actividad::where([['estado', '<', '5'],['fechaInicio','>=',$request->fecha]])->orderBy('fechaInicio', 'asc')->get();
      }else{
        $tipoActividad = TipoActividad::findOrFail($idTipoActividad);
        $actividades = Actividad::where([['estado', '<', '5'],['idTipoActividad', '=',$request->idTipoActividad],['fechaInicio','>=',$request->fecha]])->orderBy('fechaInicio', 'asc')->get();
      }
      return view('miembro.actividades-categoria',[
         'tipoActividad' => $tipoActividad,
         'actividades' => $actividades,
         'fecha' => $request->fecha]);
   }

   public function indexCategorias(){
      $tiposActividad = TipoActividad::get();
      return view('miembro.categorias',['tiposActividad' => $tiposActividad]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $tiposActividad=TipoActividad::get();
      $semestre = config('semestre');
      return view('programador.actividad.create')
              ->with('tiposActividad', $tiposActividad)
              ->with('semestre', ( $semestre['anioSemestre'].'-'.(($semestre['numeroSemestre'] == 1) ? 'I' : 'II') ));
    }

      /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function store(Request $request){
         $request->validate([
            'titulo' => 'required|max:100',
            'fechaInicio' => 'required|date_format:d/m/Y',
            'horaInicio' => 'required',
            'lugar' => 'required|max:200',
            'descripcion' => 'required',
            'modalidad' => 'required',
            'rutaImagen' => 'image|mimes:jpeg,png,jpg'
         ]);
         $idTipoActividad = preg_split("/[-]/",$request->idTipoActividad)[0];
         if ($idTipoActividad == 1 || $idTipoActividad == 2) {
            $fechaFin = $this->getFecha($request->fechaInicio);
            $horaFin = (Carbon::parse($request->horaInicio))->toTimeString();
         } else {
            $fechaFin = $this->getFecha($request->fechaFin);
            $horaFin = (Carbon::parse($request->horaFin))->toTimeString();
         }
         $semestre = config('semestre');
         $actividad = Actividad::create([
            'titulo' => $request->titulo,
            'fechaInicio' => $this->getFecha($request->fechaInicio),
            'horaInicio' => (Carbon::parse($request->horaInicio))->toTimeString(),
            'fechaFin' => $fechaFin,
            'horaFin' => $horaFin,
            'lugar' => $request->lugar,
            'referencia' => $request->referencia,
            'descripcion' => $request->descripcion,
            'informacionAdicional' => $request->informacionAdicional,
            'rutaImagen' => $this->getRutaImagen($request),
            'invitado' => $this->getInivitado($request),
            'cuposTotales' => $this->getCuposTotales($request),
            'anioSemestre' => $semestre['anioSemestre'],
            'numeroSemestre' => $semestre['numeroSemestre'],
            'modalidad' => $this->getModalidad($request),
            'idTipoActividad' => $idTipoActividad,
            'idUserResp' => $this->getResp($request),
            'idUserProg' => $request->user()->id
         ]);
         switch ($idTipoActividad) {
            case '1':
            case '2':
               $alumno = Alumno::findOrFail($request->idAlumno);
               $inscripcionADA = $actividad->inscripcionesADA()->create([]);
               $inscripcionAlumno = new InscripcionAlumno;
               $inscripcionAlumno->idActividad = $actividad->idActividad;
               $inscripcionAlumno->alumno()->associate($alumno);
               $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
            break;
            case '3':
            case '10':
               if($request->modalidad == 1){//INDIVIDUAL
                  $alumno = Alumno::findOrFail($request->idAlumno);
                  $inscripcionADA = $actividad->inscripcionesADA()->create([]);
                  $inscripcionAlumno = new InscripcionAlumno;
                  $inscripcionAlumno->idActividad = $actividad->idActividad;
                  $inscripcionAlumno->alumno()->associate($alumno);
                  $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
               }else{//GRUPAL
                  $actGrupal = new ActGrupal;
                  $actGrupal->cuposDisponibles = $request->cuposTotales;
                  $actividad->actividadGrupal()->save($actGrupal);
               }
            break;
            case '4':
            //buscar user en alumno
               for ($i = 0; $i < count($request->idAlumnoTutorado); $i++) {
                  $alumno = Alumno::findOrFail($request->idAlumnoTutorado[$i]);
                  $inscripcionADA = $actividad->inscripcionesADA()->create([]);
                  $inscripcionAlumno = $inscripcionADA->inscripcionAlumno()->create([
                     'idActividad' => $actividad->idActividad,
                     'idAlumno' => $alumno->idAlumno
                  ]);
                  $actPed = ActPedagogia::create([
                     'idActividad' => $actividad->idActividad,
                     'idInscripcionAlumno' => $inscripcionAlumno->idInscripcionAlumno
                  ]);
                  $actPed->save();
               }
               break;
            case '5':           case '6':           case '7':
               $actGrupal = new ActGrupal;
               $actGrupal->cuposDisponibles = $request->cuposTotales;
               $actividad->actividadGrupal()->save($actGrupal);
               break;
            case '8':           case '9':
            break;
            default:
               $actGrupal = new ActGrupal;
               $actGrupal->cuposDisponibles = $request->cuposTotales;
               $actividad->actividadGrupal()->save($actGrupal);
            break;
         }
         //---------------Notificacion o E-Mail-------------------//
         if($idTipoActividad < 4 ||  $idTipoActividad == 10){
            $job = (new JobNotificacionActividad($actividad, '1', $request->idAlumno))->delay(Carbon::now()->addSeconds(1));
         }else{
            $job = (new JobNotificacionActividad($actividad, '1', $request->idAlumnoTutorado))->delay(Carbon::now()->addSeconds(1));
         }
         dispatch($job);
         $alumno = User::join('alumno', 'user.id', '=', 'alumno.idUser' )
                         ->where([['alumno.idAlumno',$request->idAlumno], ['confirmed', '=', 1], ['email', 'not like', '%-'], ['estado', '=', '1']])
                         ->whereNotNull('user.email')->first();
         dd($alumno);
         return redirect('/');
         //}
     }
    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $actividad = Actividad::findOrFail($id);
        $actividad->each(function($actividad){
            $actividad->tipoActividad;
            $actividad->evidenciasActividad;
            $actividad->responsable;
            $actividad->programador;
            $actividad->inscripcionesADA;
            $actividad->encuestas;
            $actividad->actividadComedor;
            $actividad->actividadMovilidad;
            $actividad->actividadPedagogia;
            $actividad->actividadGrupal;
        });
        return view('programador.actividad.show')->with('actividad',$actividad);
    }

    /**
     * Show the form for editing the specified resource..
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $semestre = config('semestre');
        $actividad = Actividad::findOrFail($id);
        switch ($actividad->idTipoActividad) {
          case '1':          case '3':        case '2':         case '4':       case '10':
              if (($actividad->idTipoActividad) == 4 || $actividad->modalidad == 1) {
                for ($i=0; $i < count($actividad->inscripcionesADA); $i++) {
                  $idInscripcionesADA[$i]=$actividad->inscripcionesADA[$i]->idInscripcionADA;
                }
                $idAlumnos = InscripcionAlumno::whereIn('idInscripcionADA', $idInscripcionesADA)->pluck('idAlumno');
              } else {
                $idAlumnos = null;
              }
            break;
          default:
              $idAlumnos = null;
          break;
        }
        return view('programador.actividad.edit', ['actividad' => $actividad, 'idAlumnos' => $idAlumnos, 'semestre' => ( $semestre['anioSemestre'].'-'.$semestre['numeroSemestre'] )]);
        //return view('programador.actividad.edit', ['actividad' => $actividad, 'idAlumnos' => $idAlumnos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
          $request->validate([
              'titulo' => 'required|max:100',
              'fechaInicio' => 'required|date_format:d/m/Y',
              'horaInicio' => 'required',
              'lugar' => 'required|max:200',
              'rutaImagen' => 'image|mimes:jpeg,png,jpg'
          ]);
          $actividad = Actividad::findOrFail($id);

          if ($request->idTipoActividad == 1 || $request->idTipoActividad == 2) {
             $fechaFin = $actividad->fechaFin;
             $horaFin = $actividad->horaFin;
          } else {
             $fechaFin = $this->getFecha($request->fechaFin);
             $horaFin = (Carbon::parse($request->horaFin))->toTimeString();
          }
           $actividad->titulo = $request->titulo;
           $actividad->fechaInicio = $this->getFecha($request->fechaInicio);
           $actividad->horaInicio = (Carbon::parse($request->horaInicio))->toTimeString();
           $actividad->fechaFin = $fechaFin;
           $actividad->horaFin = $horaFin;
           $actividad->lugar = $request->lugar;
           $actividad->referencia = $request->referencia;
           $actividad->descripcion = $request->descripcion;
           $actividad->informacionAdicional = $request->informacionAdicional;
           $actividad->rutaImagen = $this->getRutaImagenUpdate($request, $actividad->rutaImagen);
           $actividad->invitado = $this->getInivitado($request);
           $actividad->cuposTotales = $this->getCuposTotalesUpdate($request, $actividad);
           $actividad->estado = '1';
           $actividad->modalidad = $this->getModalidadUpdate($request, $actividad);
           $actividad->idUserResp = $this->getResp($request);
           $actividad->update();

           switch ($actividad->idTipoActividad) {
             case '1':
             case '2':
                 //Eliminar Inscripciones anteriores
                 $inscripcionAlumno = InscripcionAlumno::where('idAlumno', $request->idAlumno)->where('idActividad', $actividad->idActividad)->first();
                 if($inscripcionAlumno == null){ //NO Existe esta Inscripcion Alumno
                   $alumno = Alumno::findOrFail($request->idAlumno);
                   $inscripcionAlumno = InscripcionAlumno::where('idActividad', $actividad->idActividad)->first();
                   $inscripcionAlumno->asistencia = '0';
                   $inscripcionAlumno->alumno()->associate($alumno);
                   $inscripcionAlumno->update();
                 }
               break;
             case '3':
             case '10':
                 if($actividad->modalidad == 1){//INDIVIDUAL
                       //Eliminar Inscripciones anteriores
                       $inscripcionAlumno = InscripcionAlumno::where('idAlumno', $request->idAlumno)->where('idActividad', $actividad->idActividad)->first();
                       if($inscripcionAlumno == null){ //NO Existe esta Inscripcion Alumno
                            $alumno = Alumno::findOrFail($request->idAlumno);
                            $inscripcionAlumno = InscripcionAlumno::where('idActividad', $actividad->idActividad)->first();
                            $inscripcionAlumno->asistencia = '0';
                            $inscripcionAlumno->alumno()->associate($alumno);
                            $inscripcionAlumno->update();
                       }
                 }else{//GRUPAL
                       $actGrupal = ActGrupal::where('idActividad', $actividad->idActividad)->first();
                       $actGrupal->cuposDisponibles = $request->cuposTotales;
                       $actGrupal->update();
                 }
               break;
             case '4':
                 //eliminar inscripciones anteriores
                 ActPedagogia::where('idActividad', $actividad->idActividad)->delete();
                 $inscripcionAlumnos = InscripcionAlumno::where('idActividad', $actividad->idActividad)->delete();
                 $inscripcionADA = InscripcionADA::where('idActividad', $actividad->idActividad)->delete();
                 //realizar inscripciones
                 for ($i = 0; $i < $actividad->cuposTotales; $i++) {
                     $alumno = Alumno::findOrFail($request->idAlumnoTutorado[$i]);
                     $inscripcionADA = $actividad->inscripcionesADA()->create([
                     ]);
                     $inscripcionAlumno = new InscripcionAlumno;
                     $inscripcionAlumno->asistencia = '0';
                     $inscripcionAlumno->idActividad = $actividad->idActividad;
                     $inscripcionAlumno->alumno()->associate($alumno);
                     $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
                 }
               break;
             case '5':           case '6':           case '7':
                  $actGrupal = ActGrupal::where('idActividad', $actividad->idActividad)->first();
                  $actGrupal->cuposDisponibles = $request->cuposTotales;
                  $actGrupal->update();
               break;
             case '8':           case '9':
             break;
             default:
                $actGrupal = ActGrupal::where('idActividad', $actividad->idActividad)->first();
                $actGrupal->cuposDisponibles = $request->cuposTotales;
                $actGrupal->update();
             break;
           }
           //---------------Notificacion o E-Mail-------------------//
           if ($request->envioCorreos == 'on') {
             if ($actividad->idTipoActividad < 2) {
                $idUserResp = $actividad->idUserResp;
             } else {
                $idUserResp = $this->getResp($request);
             }

             $userResp = User::findOrFail($idUserResp);
             $job = (new JobNotificacionActividad($actividad, '2', null))
                    ->delay(Carbon::now()->addSeconds(1));
             dispatch($job);
           }
           return redirect()->action('MiPerfilController@mis_actividades', ['id' => $request->user()->id, 'opcion'=>'3']);
    }

    public function cancel($id)  {
        $actividad = Actividad::findOrFail($id);
        $actividad->estado ='3';
        $actividad->update();
        //---------------Notificacion o E-Mail-------------------//
        $userResp = User::findOrFail($actividad->idUserResp);
        $job = (new JobNotificacionActividad($actividad, '3', null))
               ->delay(Carbon::now()->addSeconds(1));
        dispatch($job);
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.s
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  {
        $actividad = Actividad::findOrFail($id);
        $actividad->estado ='5';
        $actividad->update();
        //---------------Notificacion o E-Mail-------------------//
        $userResp = User::findOrFail($actividad->idUserResp);
        $job = (new JobNotificacionActividad($actividad, '4', null))
               ->delay(Carbon::now()->addSeconds(1));
        dispatch($job);
        return redirect()->back();
    }

    public function execute($id){ //ejecutar una actividad
         $actividad = Actividad::findOrFail($id);
         $inscAlumnos = InscripcionADA::join('inscripcionAlumno','inscripcionADA.idInscripcionADA','=','inscripcionAlumno.idInscripcionADA')
                                        ->join('alumno','inscripcionAlumno.idAlumno','=','alumno.idAlumno')
                                        ->join('user','alumno.idUser','=','user.id')
                                        ->where('inscripcionADA.idActividad', $id)
                                        ->select('inscripcionADA.idInscripcionADA','alumno.idAlumno as idInscrito','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo', 'inscripcionAlumno.asistencia', 'user.idTipoPersona')
                                        ->get();
         $inscDocentes = InscripcionADA::join('inscripcionDocente','inscripcionADA.idInscripcionADA','=','inscripcionDocente.idInscripcionADA')
                                         ->join('docente','inscripcionDocente.idDocente','=','docente.idDocente')
                                         ->join('user','docente.idUser','=','user.id')
                                         ->where('inscripcionADA.idActividad', $id)
                                         ->select('inscripcionADA.idInscripcionADA','docente.idDocente as idInscrito','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo', 'inscripcionDocente.asistencia', 'user.idTipoPersona')
                                         ->get();
         $inscAdministrativos = InscripcionADA::join('inscripcionAdministrativo','inscripcionADA.idInscripcionADA','=','inscripcionAdministrativo.idInscripcionADA')
                                                 ->join('administrativo','inscripcionAdministrativo.idAdministrativo','=','administrativo.idAdministrativo')
                                                 ->join('user','administrativo.idUser','=','user.id')
                                                 ->where('inscripcionADA.idActividad', $id)
                                                 ->select('inscripcionADA.idInscripcionADA','administrativo.idAdministrativo as idInscrito','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo', 'inscripcionAdministrativo.asistencia', 'user.idTipoPersona')
                                                 ->get();
         $inscAlDoc = $inscAlumnos->merge($inscDocentes);
         $inscritos = $inscAlDoc->merge($inscAdministrativos);

         return view('programador.actividad.execute', ['actividad' => $actividad, 'inscripciones' => $inscritos]);
    }

    public function updateExecute(Request $request, $id){ //ejecutar una actividad
         $actividad = Actividad::findOrFail($id);
         if ($request->horaEjecutada != null) {
            $actividad->horaEjecutada = (Carbon::parse($request->horaEjecutada))->toTimeString();
            $actividad->fechaEjecutada = $this->getFecha($request->fechaEjecutada);
         }
         $actividad->estado = '2';

         switch ($actividad->idTipoActividad) {
             case '4':
                if ($request->observaciones == null) {
                   $actividad->observaciones = 'Ninguna';
                } else {
                   $actividad->observaciones = $request->observaciones;
                }
                if ($request->recomendaciones == null) {
                   $actividad->recomendaciones = 'Ninguna';
                } else {
                   $actividad->recomendaciones = $request->recomendaciones;
                }
                foreach ($actividad->actividadesPedagogia as $actPedagogia) {
                   $actPedagogia->formaTutoria = $request->formaTutoria;
                   $actPedagogia->update();
                }
             break;
             case '8':
             case '9':
                $actividad->observaciones = 'Ninguna';
                $actividad->recomendaciones = 'Ninguna';
             break;
             default:
                if ($request->observaciones == null) {
                   $actividad->observaciones = 'Ninguna';
                } else {
                   $actividad->observaciones = $request->observaciones;
                }
                if ($request->recomendaciones == null) {
                   $actividad->recomendaciones = 'Ninguna';
                } else {
                   $actividad->recomendaciones = $request->recomendaciones;
                }
             break;
         }
         $actividad->update();
         return redirect()->back();
    }

    public function verEstadisticaActividad($id){
        $actividad = Actividad::where('idActividad', $id)->first();
        $inscripcionesDocentes = Docente::join('inscripcionDocente','docente.idDocente', '=','inscripcionDocente.idDocente' )
                 ->join('user','docente.idUser', '=','user.id' )
                 ->where('inscripcionDocente.idActividad', '=', $id)
                 ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionDocente.asistencia','inscripcionDocente.idActividad','inscripcionDocente.idInscripcionADA')->get();
        $inscripcionesAlumnos = Alumno::join('inscripcionAlumno','alumno.idAlumno', '=','inscripcionAlumno.idAlumno' )
                      ->join('user','alumno.idUser', '=','user.id' )
                      ->where('inscripcionAlumno.idActividad', '=', $id)
                      ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionAlumno.asistencia','inscripcionAlumno.idActividad','inscripcionAlumno.idInscripcionADA')->get();
        $inscripcionesAdministrativos = Administrativo::join('inscripcionAdministrativo','administrativo.idAdministrativo', '=','inscripcionAdministrativo.idAdministrativo' )
              ->join('user','administrativo.idUser', '=','user.id' )
              ->where('inscripcionAdministrativo.idActividad', '=', $id)
              ->select('user.nombre','user.apellidoPaterno','user.apellidoMaterno','inscripcionAdministrativo.asistencia','inscripcionAdministrativo.idActividad','inscripcionAdministrativo.idInscripcionADA')->get();
        //dd($inscripciones);
        $numAsistentes = 0;    $numAusentes = 0;
        //numero Inscritos
        //dd($inscripcionesAlumnos);
        $numInscritos = count($inscripcionesAlumnos)+count($inscripcionesDocentes)+count($inscripcionesAdministrativos);
        //numero asistentes        //numero de ausentes
        if($inscripcionesAlumnos != null){
          foreach ($inscripcionesAlumnos as $inscripcionAlumno) {
            ($inscripcionAlumno->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
          }
        }
        if($inscripcionesDocentes != null){
          foreach ($inscripcionesDocentes as $inscripcionDocente) {
            ($inscripcionDocente->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
          }
        }
        if($inscripcionesAdministrativos != null){
          foreach ($inscripcionesAdministrativos as $inscripcionAdministrativo) {
            ($inscripcionAdministrativo->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
          }
        }

        return view('programador.actividad.inscripciones.index')
            ->with('inscripcionesDocentes',$inscripcionesDocentes)
            ->with('inscripcionesAlumnos',$inscripcionesAlumnos)
            ->with('inscripcionesAdministrativos',$inscripcionesAdministrativos)
            ->with('numInscritos',$numInscritos)
            ->with('numAsistentes',$numAsistentes)
            ->with('numAusentes',$numAusentes)
            ->with('cupos',$actividad->cupos)
            ->with('opcion', 1)
            ->with('actividad',$actividad);
   }

    public function verMisEstadisticas(Request $request){
      if($request->ajax()){
         $estadistica = [];
         //SI SOY PROGRAMADOR(organizador) o ADMINISTRADOR
         if($request->funcion != 1){
            $progPendientes = Actividad::where([['idUserProg', $request->id ], ['estado', '1']])->count('idUserProg');
            $estadistica['progPendientes'] = $progPendientes;
            $progEjecutadas = Actividad::where([['idUserProg', $request->id ], ['estado', '2']])->count('idUserProg');
            $estadistica['progEjecutadas'] = $progEjecutadas;
            $progCanceladas = Actividad::where([['idUserProg', $request->id ], ['estado', '3']])->count('idUserProg');
            $estadistica['progCanceladas'] = $progCanceladas;
            $progExpiradas = Actividad::where([['idUserProg', $request->id ], ['estado', '4']])->count('idUserProg');
            $estadistica['progExpiradas'] = $progExpiradas;
         }
         //SI SOY RESPONSABLE
         $respPendientes = Actividad::where([['idUserResp', $request->id ], ['estado', '1']])->count('idUserResp');
         $estadistica['respPendientes'] = $respPendientes;
         $respEjecutadas = Actividad::where([['idUserResp', $request->id ], ['estado', '2']])->count('idUserResp');
         $estadistica['respEjecutadas'] = $respEjecutadas;
         //ACTIVIDADES INSCRITAS
         switch ($request->idTipoPersona) {
            case '1'://Alumno
               $idAlumno = Alumno::where('idUser', $request->id)->value('idAlumno');
               $inscInscripcion = InscripcionAlumno::where('idAlumno', $idAlumno)->count('idAlumno');
               $inscAsistencia = InscripcionAlumno::where('idAlumno', $idAlumno)->where('asistencia', '1')->count('idAlumno');
               break;
            case '2'://Docente
               $idDocente = Docente::where('idUser', $request->id)->pluck('idDocente');
               $inscInscripcion = InscripcionDocente::where('idDocente', $idDocente)->count('idDocente');
               $inscAsistencia = InscripcionDocente::where('idDocente', $idDocente)->where('asistencia', '1')->count('idDocente');
               break;
            case '3'://Administrativo
               $idAdministrativo = Administrativo::where('idUser', $request->id)->pluck('idAdministrativo');
               $inscInscripcion= InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->count('idAdministrativo');
               $inscAsistencia = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->where('asistencia', '1')->count('idAdministrativo');
               break;
         }
         $estadistica['inscInscripcion'] = $inscInscripcion;
         $estadistica['inscAsistencia'] = $inscAsistencia;
         return response()->json($estadistica);
      }
    }

   public function verActividadesResp(Request $request){
      if($request->ajax()){
         $actividades = Actividad::where([['idUserResp', $request->id], ['estado', '<', '5']])->get();
         return response()->json($actividades);
      }
   }

   public function verActividadesProg(Request $request){
      if($request->ajax()){
         $actividades = Actividad::where([['idUserProg', $request->id], ['estado', '<', '5']])->get();
         return response()->json($actividades);
      }
   }

   public function verActividadesInsc(Request $request){
      if($request->ajax()){
         switch ($request->idTipoPersona) {
            case '1'://Alumno
               $idAlumno = Alumno::where('idUser', $request->id)->value('idAlumno');
               $actividades = InscripcionAlumno::where('idAlumno', $idAlumno)->get();
               break;
            case '2':
               $idDocente = Docente::where('idUser', $request->id)->pluck('idDocente');
               $actividades = InscripcionDocente::where('idDocente', $idDocente)->get();
               break;
            case '3'://Administrativo
               $idAdministrativo = Administrativo::where('idUser', $request->id)->pluck('idAdministrativo');
               $actividades = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->get();
               break;
         }
         return response()->json($actividades);
      }
   }

   public function verActividades(Request $request){
      if($request->ajax()){
                   //$user = User::findOrFail('22'); // OR AUTH ....
         switch ($request->tarea) {
           case '1'://ACTIVIDADES PROGRAMADAS
                 $actividades = Actividad::where([['idUserProg', $request->id], ['estado', '<', '5']])->get();
             break;
           case '2'://ACTIVIDADES RESPONSABLE
                 $actividades = Actividad::where([['idUserResp', $request->id], ['estado', '<', '5']])->get();
             break;
           case '3': //ACTIVIDADES INSCRITAS
                 switch ($request->idTipoPersona) {
                   case '1'://Docente
                     $idDocente = Docente::where('idUser', $request->id)->pluck('idDocente');
                     $actividades = InscripcionDocente::where('idDocente', $idDocente)->get();
                     break;
                   case '2'://Administrativo
                     $idAdministrativo = Administrativo::where('idUser', $request->id)->pluck('idAdministrativo');
                     $actividades = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->get();
                     break;
                   case '3'://Alumno
                     $idAlumno = Alumno::where('idUser', $request->id)->value('idAlumno');
                     $actividades = InscripcionAlumno::where('idAlumno', $idAlumno)->get();
                     break;
                 }
             break;
           case '4'://ACTIVIDADES QUE ASISTÍ
                 switch ($request->idTipoPersona) {
                   case '1'://Docente
                     $idDocente = Docente::where('idUser', $request->id)->pluck('idDocente');
                     $actividades = InscripcionDocente::where('idDocente', $idDocente)->where('asistencia', '1')->count('idDocente');
                     break;
                   case '2'://Administrativo
                     $idAdministrativo = Administrativo::where('idUser', $request->id)->pluck('idAdministrativo');
                     $actividades = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->where('asistencia', '1')->count('idAdministrativo');
                     break;
                   case '3'://Alumno
                     $idAlumno = Alumno::where('idUser', $request->id)->value('idAlumno');
                     $actividades = InscripcionAlumno::where('idAlumno', $idAlumno)->where('asistencia', '1')->count('idAlumno');
                     break;
                 }
             break;
           case '5'://ACTIVIDADES QUE NO ASISTÍ
                 switch ($request->idTipoPersona) {
                   case '1'://Docente
                     $idDocente = Docente::where('idUser', $request->id)->pluck('idDocente');
                     $actividades = InscripcionDocente::where('idDocente', $idDocente)->where('asistencia', '0')->count('idDocente');
                     break;
                   case '2'://Administrativo
                     $idAdministrativo = Administrativo::where('idUser', $request->id)->pluck('idAdministrativo');
                     $actividades = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->where('asistencia', '0')->count('idAdministrativo');
                     break;
                   case '3'://Alumno
                     $idAlumno = Alumno::where('idUser', $request->id)->value('idAlumno');
                     $actividades = InscripcionAlumno::where('idAlumno', $idAlumno)->where('asistencia', '0')->count('idAlumno');
                     break;
                 }
             break;
        }
        return response()->json($actividades);
      }
    }

    public function member_show(Request $request){
         $actividad = Actividad::findOrFail($request->id);
         $relacionadas = Actividad::where([['estado', '=', 1], ['idTipoActividad', '=', $actividad->idTipoActividad], ['idActividad', '<>', $actividad->idActividad], ['estado', '<', '5']])->get();
         $inscripciones = $actividad->inscripcionesADA;
         $insc_alum = [];
         $insc_doce = [];
         $insc_admi = [];
         for ($i=0; $i < count($inscripciones); $i++) {
         if($inscripciones[$i]->inscripcionAlumno != null){
            array_push( $insc_alum, $inscripciones[$i]->inscripcionAlumno->alumno->user );
         }
         if($inscripciones[$i]->inscripcionDocente != null){
            array_push( $insc_doce, $inscripciones[$i]->inscripcionDocente->docente->user );
         }
         if($inscripciones[$i]->inscripcionAdministrativo != null){
            array_push( $insc_admi, $inscripciones[$i]->inscripcionAdministrativo->administrativo->user );
         }
         }
         return view('miembro.actividad')->with([
            'actividad' => $actividad,
            'relacionadas' => $relacionadas,
            'insc_alum' => $insc_alum,
            'insc_doce' => $insc_doce,
            'insc_admi' => $insc_admi
         ]);
   }

   public function enviarMensaje(Request $request){
      $idEmisor = User::where('id', $request->idEmisor)->value('id');
      $idReceptor = User::where('id', $request->idReceptor)->value('id');
      $job = (new JobMailBasico($idEmisor, $idReceptor, $request->subject, $request->mensaje, NULL, NULL))
             ->delay(Carbon::now()->addSeconds(1));
      dispatch($job);
     return redirect()->back();
   }
}
