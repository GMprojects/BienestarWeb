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

use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

use Illuminate\Mail\Message;
use BienestarWeb\Mail\ProgramacionActividad;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use BienestarWeb\Jobs\JobEmailNuevaAct;
use BienestarWeb\Jobs\JobEmailActualizarAct;

use File;
use Log;
use Validator;
use Carbon\Carbon;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
    //    dd($request);
      $actividades = Actividad::Search($request)->get();
      //dd($actividades);
      return view('programador.actividad.index',[
         'actividades' => $actividades,
         'idUserProgramador' => $request->idUserProgramador,
         'idUserResponsable', $request->idUserResponsable,
         'idUserInscrito', $request->idUserInscrito,
         'idUserInscrito', $request->idUserInscrito,
         'estadoCancelado', $request->estadoCancelado]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tiposActividad=TipoActividad::get();
    //  $users=User::get();
      return view('programador.actividad.create')
              ->with('tiposActividad', $tiposActividad);
            //  ->with('users', $users);
    }

      /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
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
         switch($request->idTipoActividad) {
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
         switch($request->idTipoActividad) {
            case '1':
            case '2': return 1;
            case '4': return count($request->idAlumnoTutorado);
            case '5':
            case '6':
            case '7': return $request->cuposTotales;
            default:
               if($request->modalidad == 1)
                  return 1;
               else return $request->cuposTotales;
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
            case '9': return 1;
            default:
               if($actividad->modalidad == 1)
                  return 1;
               else return $request->cuposTotales;
         }
      }
      function getResp($request){
         if($request->idUserResp == null){
            return $request->user()->id;
         }else{
            return $request->idUserResp;
         }
      }
      public function store(Request $request){
         $mensajeA = 'Estimad@ alumn@, se le invita a participar de una actividad';
         $mensajeR = 'Ud. ha sido asignado como responsable de una actividad';
         $request->validate([
            'titulo' => 'required|max:100',
            'fechaInicio' => 'required|date_format:d/m/Y',
            'horaInicio' => 'required',
            'lugar' => 'required|max:200',
            'descripcion' => 'required',
            'modalidad' => 'required',
            'rutaImagen' => 'image|mimes:jpeg,png,jpg'
         ]);
         $actividad = Actividad::create([
            'titulo' => $request->titulo,
            'fechaInicio' => ActividadController::getFecha($request->fechaInicio),
            'horaInicio' => (Carbon::parse($request->horaInicio))->toTimeString(),
            'fechaFin' =>  ActividadController::getFecha($request->fechaFin),
            'horaFin' => (Carbon::parse($request->horaFin))->toTimeString(),
            'lugar' => $request->lugar,
            'referencia' => $request->referencia,
            'descripcion' => $request->descripcion,
            'informacionAdicional' => $request->informacionAdicional,
            'rutaImagen' => ActividadController::getRutaImagen($request),
            'invitado' => ActividadController::getInivitado($request),
            'cuposTotales' => ActividadController::getCuposTotales($request),
            'anioSemestre' => 2017,
            'numeroSemestre' => 2,
            'modalidad' => ActividadController::getModalidad($request),
            'asistenciaRegistrada' => 0,
            'idTipoActividad' => $request->idTipoActividad,
            'idUserResp' => ActividadController::getResp($request),
            'idUserProg' => $request->user()->id
         ]);

         switch ($request->idTipoActividad) {
            case '1':
            case '2':
               $alumno = Alumno::findOrFail($request->idAlumno);
               $inscripcionADA = $actividad->inscripcionesADA()->create([]);
               $inscripcionAlumno = new InscripcionAlumno;
               $inscripcionAlumno->idActividad = $actividad->idActividad;
               $inscripcionAlumno->alumno()->associate($alumno);
               $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
               $mensajeA = 'Estimad@ alumn@, ud. ha sido inscrito en una actividad';
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
                  $mensajeA = 'Estimad@ alumn@, ud. ha sido inscrito en una actividad';
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
               $mensajeA = 'Estimad@ alumn@, se le ha programado una sesión de tutoría ';
               $mensajeR = 'Estimado tutor, se le ha programado una sesión de tutoría';
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
         if($request->idAlumno != null){
            Log::info("Actividad de Atencion Medica o Psicologia servicio Social reforzamiento");
            $alumno = Alumno::findOrFail($request->idAlumno);
            $userAl = $alumno->user;
            Log::info($userAl);
         }else{
            $userAl = null;
         }

         if($actividad->idTipoActividad < 3){
            Log::info("no neviar correoa  ningn reponsable");
            $userResp = null;
         }else{
            Log::info("no neviar correoa  ningn reponsable");
            $userResp = User::findOrFail($request->idUserResp);
         }

         Log::info(' Tipo de Actividad             ->  '.$actividad->idTipoActividad);
         $job = (new JobEmailNuevaAct($actividad, $actividad->idTipoActividad, $userAl, $userResp, $mensajeR, $mensajeA, $request->idAlumnoTutorado))
            ->delay(Carbon::now()->addSeconds(30));
         dispatch($job);
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
      //  dd($actividad->actividadesGrupal);
        return view('programador.actividad.show')->with('actividad',$actividad);
    }

    /**
     * Show the form for editing the specified resource..
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      //dd(count(InscripcionAlumno::where('idActividad', '35')->get()));
        $actividad = Actividad::findOrFail($id);
        //dd(count(preg_split("/[-]/",$actividad->invitado)));
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
              return view('programador.actividad.edit', ['actividad' => $actividad, 'idAlumnos' => $idAlumnos]);
            break;
          default:
              $idAlumnos = null;
              return view('programador.actividad.edit', ['actividad' => $actividad, 'idAlumnos' => $idAlumnos]);
          break;
        }
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
          Log::info('Actualizar actividad');
          $actividad = Actividad::findOrFail($id);
          Log::info($actividad);

           $actividad->titulo = $request->titulo;
           $actividad->fechaInicio = ActividadController::getFecha($request->fechaInicio);
           $actividad->horaInicio = (Carbon::parse($request->horaInicio))->toTimeString();
           $actividad->fechaFin = ActividadController::getFecha($request->fechaFin);
           $actividad->horaFin = (Carbon::parse($request->horaFin))->toTimeString();
           $actividad->lugar = $request->lugar;
           $actividad->referencia = $request->referencia;
           $actividad->descripcion = $request->descripcion;
           $actividad->informacionAdicional = $request->informacionAdicional;
           $actividad->rutaImagen = ActividadController::getRutaImagenUpdate($request, $actividad->rutaImagen);
           $actividad->invitado = ActividadController::getInivitado($request);
           $actividad->cuposTotales = ActividadController::getCuposTotalesUpdate($request, $actividad);
           $actividad->estado = '1';
           $actividad->modalidad = ActividadController::getModalidadUpdate($request, $actividad);
           $actividad->idUserResp = ActividadController::getResp($request);
           $actividad->update();

           switch ($actividad->idTipoActividad) {
             case '1':
             case '2':
                 //Eliminar Inscripciones anteriores
                 $inscripcionAlumno = InscripcionAlumno::where('idAlumno', $request->idAlumno)->where('idActividad', $actividad->idActividad)->first();
                 if($inscripcionAlumno == null){ //NO Existe esta Inscripcion Alumno
                   Log::info('NO Existe esta inscripcion');
                   $alumno = Alumno::findOrFail($request->idAlumno);
                   $inscripcionAlumno = InscripcionAlumno::where('idActividad', $actividad->idActividad)->first();
                   Log::info($inscripcionAlumno);
                   Log::info('inscripcion alumno  '.$inscripcionAlumno->idInscripcionAlumno);
                   $inscripcionAlumno->asistencia = '0';
                   $inscripcionAlumno->alumno()->associate($alumno);
                   $inscripcionAlumno->update();
                 }
                 Log::info('Actualizando act 1      ----          2');
               break;
             case '3':
             case '10':
                 if($actividad->modalidad == 1){//INDIVIDUAL
                       //Eliminar Inscripciones anteriores
                       $inscripcionAlumno = InscripcionAlumno::where('idAlumno', $request->idAlumno)->where('idActividad', $actividad->idActividad)->first();
                       if($inscripcionAlumno == null){ //NO Existe esta Inscripcion Alumno
                            Log::info('NO Existe esta inscripcion');
                            $alumno = Alumno::findOrFail($request->idAlumno);
                            $inscripcionAlumno = InscripcionAlumno::where('idActividad', $actividad->idActividad)->first();
                            Log::info($inscripcionAlumno);
                            Log::info('inscripcion alumno  '.$inscripcionAlumno->idInscripcionAlumno);
                            $inscripcionAlumno->asistencia = '0';
                            $inscripcionAlumno->alumno()->associate($alumno);
                            $inscripcionAlumno->update();
                       }
                       Log::info('Actualizando act 3      ----          Individual');
                 }else{//GRUPAL
                       $actGrupal = ActGrupal::where('idActividad', $actividad->idActividad)->first();
                       $actGrupal->cuposDisponibles = $request->cuposTotales;
                       $actGrupal->update();
                       Log::info('Actualizando act 3      ----          Grupal');
                 }
               break;
             case '4':
                 //eliminar inscripciones anteriores
                 $inscripcionAlumno = InscripcionAlumno::where('idActividad', $actividad->idActividad)->delete();
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
             Log::info('envio de notificaciones Actualizar Actividad');
             $userResp = User::findOrFail($request->idUserResp);
             $job = (new JobEmailActualizarAct($actividad, $userResp, '1'))
                    ->delay(Carbon::now()->addSeconds(5));
             dispatch($job);
           }else {
             Log::info('No hay envio de notificaciones');
           }
           //return Redirect::to('programador/actividad');
           //action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id])
           return redirect()->action('MiPerfilController@mis_actividades', ['id' => $request->user()->id, 'opcion'=>'3']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  {
        $actividad = Actividad::findOrFail($id);
        $actividad->estado ='3';
        $actividad->update();
        //---------------Notificacion o E-Mail-------------------//
        Log::info('envio de notificaciones');
        $userResp = User::findOrFail($actividad->idUserResp);
        $job = (new JobEmailActualizarAct($actividad, $userResp, '2'))
               ->delay(Carbon::now()->addSeconds(5));
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
         // --------------------------------------------------------------------------------------------------
         //dd($inscripciones);
         $numAsistentes = 0;    $numAusentes = 0;
         //numero Inscritos
         //dd($inscripcionesAlumnos);
         $numInscritos = count($inscAlumnos)+count($inscDocentes)+count($inscAdministrativos);
         //numero asistentes        //numero de ausentes
         if($inscAlumnos != null){
            foreach ($inscAlumnos as $inscripcionAlumno) {
              ($inscripcionAlumno->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
            }
         }
         if($inscDocentes != null){
            foreach ($inscDocentes as $inscripcionDocente) {
              ($inscripcionDocente->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
            }
         }
         if($inscAdministrativos != null){
            foreach ($inscAdministrativos as $inscripcionAdministrativo) {
              ($inscripcionAdministrativo->asistencia == 1 ) ? $numAsistentes = $numAsistentes + 1 : $numAusentes = $numAusentes + 1  ;
            }
         }

         return view('programador.actividad.execute', ['actividad' => $actividad, 'inscripciones' => $inscritos, 'numAsistentes' => $numAsistentes]);
    }

    public function updateExecute(Request $request, $id){ //ejecutar una actividad
         $actividad = Actividad::findOrFail($id);
         if ($request->horaEjecutada != null) {
            $actividad->horaEjecutada = (Carbon::parse($request->horaEjecutada))->toTimeString();
            $actividad->fechaEjecutada = ActividadController::getFecha($request->fechaEjecutada);
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
         Log::info($estadistica);
         return response()->json($estadistica);
      }
    }

   public function verActividadesResp(Request $request){
      Log::info('si llegooooo ');
      if($request->ajax()){
         $actividades = Actividad::where('idUserResp', $request->id)->get();
         return response()->json($actividades);
      }
   }

   public function verActividadesProg(Request $request){
      if($request->ajax()){
         $actividades = Actividad::where('idUserProg', $request->id)->get();
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
                 $actividades = Actividad::where('idUserProg', $request->id)->get();
             break;
           case '2'://ACTIVIDADES RESPONSABLE
                 $actividades = Actividad::where('idUserResp', $request->id)->get();
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
      return view('miembro.actividad')->with('actividad',$actividad)->with('list_insc', $request->list_insc);
      //return view('miembro.actividad')->with('actividad',$actividad);
   }
}
