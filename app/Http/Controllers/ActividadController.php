<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Actividad;
use BienestarWeb\ActGrupal;
use BienestarWeb\ActMovilidad;
use BienestarWeb\ActComedor;
use BienestarWeb\TipoActividad;
use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
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
    public function index(Request $request)
    {
    //    dd($request);
        $actividades = Actividad::Search($request)->get();
        //dd($actividades);
        return view('programador.actividad.index',['actividades' => $actividades,
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
     public function store(Request $request)
     {
        $mensajeA = 'Se le invita a participar de una actividad';
        $mensajeR = 'Ud. ha sido asignado como responsable de una actividad';
        $idUserProg = 22;
        $idUserResponsable = $request->idUserResponsable;
        $request->validate([
            'titulo' => 'required|max:100',
            'fechaProgramacion' => 'required|date_format:d/m/Y',
            'horaProgramacion' => 'required',
            'lugar' => 'required|max:200',
            'descripcion' => 'required',
            'modalidad' => 'required',
            'anioSemestre' => 'required',
            'numeroSemestre' => 'required',
            'rutaImagen' => 'image|mimes:jpeg,png,jpg'
        ]);
        //dd($request->all());
      /*  $val = Validator::make($request->all(), [
          'titulo' => 'required|max:100',
          'fechaProgramacion' => 'required|date_format:d/m/Y',
          'horaProgramacion' => 'required',
          'idTipoActividad' => 'required',
          'lugar' => 'required|max:200',
          'modalidad' => 'required',
          'anioSemestre' => 'required',
          'numeroSemestre' => 'required',
          'rutaImagen' => 'image|mimes:jpeg,png,jpg'
        ]);

         $val->sometimes(['idUserResponsable'],'required', function ($input){
           return $input->idTipoActividad > 2;
         });
         $val->sometimes(['idAlumnoTutorado'],'required', function ($input){
           return $input->idTipoActividad == 4;
         });
         $val->sometimes(['idAlumno'],'required', function ($input){
           return $input->idTipoActividad <= 2;
         });
        if($val->fails()){
           $tiposActividad=TipoActividad::get();
           return view('programador.actividad.create')
                   ->with('tiposActividad', $tiposActividad)
                   ->withErrors($val->errors());
         }else{*/
           //----------------------- subir imagen usando Storage ----------------
          if($request->file('rutaImagen')){
                 $file = $request->file('rutaImagen');
                 $name = 'imgAct_'.time().'.'.$file->getClientOriginalExtension();
                 $storage = Storage::disk('actividades')->put($name, \File::get($file));
                 if($storage){
                   $rutaImagen = 'actividades/'.$name;
                 }else{
                   $rutaImagen = NULL;
                 }
           }else {
             $rutaImagen = NULL;
           }
           //dd($rutaImagen);
           $dia =substr( $request->fechaProgramacion,0 ,2); $mes =substr( $request->fechaProgramacion,3 ,2); $anio=substr( $request->fechaProgramacion,-4 ,4);
           $fechaP = $anio."-".$mes."-".$dia;
           //$fechaP = (Carbon::parse($request->fechaProgramacion))->toDateString();
           $horaP = (Carbon::parse($request->horaProgramacion))->toTimeString();
           if($request->nombreResponsable != NULL){
             $invitado = $request->nombreResponsable.'-'.$request->apellidosResponsable.'-'.$request->emailResponsable;
           }else{
             $invitado = '--';
           }
           Log::info('       tipo actividad  '.$request->idTipoActividad);
           switch ($request->idTipoActividad) {
             case '1':
             case '2':
                      $idUserResponsable = $idUserProg;
                       $actividad = Actividad::create([
                         'titulo' => $request->titulo,
                         'fechaProgramacion' => $fechaP,
                         'horaProgramacion' => $horaP,
                         'lugar' => $request->lugar,
                         'referencia' => $request->referencia,
                         'descripcion' => $request->descripcion,
                         'informacionAdicional' => $request->informacionAdicional,
                         'rutaImagen' => $rutaImagen,
                         'invitado' => $invitado,
                         'cuposTotales' => '1',
                         'estado' => '1',
                         'anioSemestre' => $request->anioSemestre,
                         'numeroSemestre' => $request->numeroSemestre,
                         'modalidad' => $request->modalidad,
                         'idTipoActividad' => $request->idTipoActividad,
                         'idUserResp' => $idUserResponsable,
                         'idUserProg' => $idUserProg
                       ]);
                       //buscar user en alumno
                       $alumno = Alumno::findOrFail($request->idAlumno);
                       $inscripcionADA = $actividad->inscripcionesADA()->create([
                       ]);
                       $inscripcionAlumno = new InscripcionAlumno;
                       $inscripcionAlumno->asistencia = '0';
                       $inscripcionAlumno->idActividad = $actividad->idActividad;
                       $inscripcionAlumno->alumno()->associate($alumno);
                       $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
                       $mensajeA = 'Ud. ha sido inscrito en una actividad';
               break;
             case '3':
             case '10':
                       if($request->modalidad == 1){//INDIVIDUAL
                             $actividad = Actividad::create([
                               'titulo' => $request->titulo,
                               'fechaProgramacion' => $fechaP,
                               'horaProgramacion' => $horaP,
                               'lugar' => $request->lugar,
                               'referencia' => $request->referencia,
                               'descripcion' => $request->descripcion,
                               'informacionAdicional' => $request->informacionAdicional,
                               'rutaImagen' => $rutaImagen,
                               'invitado' => $invitado,
                               'cuposTotales' => '1',
                               'estado' => '1',
                               'anioSemestre' => $request->anioSemestre,
                               'numeroSemestre' => $request->numeroSemestre,
                               'modalidad' => '1',
                               'idTipoActividad' => $request->idTipoActividad,
                               'idUserResp' => $idUserResponsable,
                               'idUserProg' => $idUserProg
                             ]);
                             //buscar user en alumno
                             $alumno = Alumno::findOrFail($request->idAlumno);
                             $inscripcionADA = $actividad->inscripcionesADA()->create([
                             ]);
                             $inscripcionAlumno = new InscripcionAlumno;
                             $inscripcionAlumno->asistencia = '0';
                             $inscripcionAlumno->idActividad = $actividad->idActividad;
                             $inscripcionAlumno->alumno()->associate($alumno);
                             $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
                             $mensajeA = 'Ud. ha sido inscrito en una actividad';
                       }else{//GRUPAL
                             $actividad = Actividad::create([
                               'titulo' => $request->titulo,
                               'fechaProgramacion' => $fechaP,
                               'horaProgramacion' => $horaP,
                               'lugar' => $request->lugar,
                               'referencia' => $request->referencia,
                               'descripcion' => $request->descripcion,
                               'informacionAdicional' => $request->informacionAdicional,
                               'rutaImagen' => $rutaImagen,
                               'invitado' => $invitado,
                               'cuposTotales' => $request->cuposTotales,
                               'estado' => '1',
                               'anioSemestre' => $request->anioSemestre,
                               'numeroSemestre' => $request->numeroSemestre,
                               'modalidad' => '2',
                               'idTipoActividad' => $request->idTipoActividad,
                               'idUserResp' => $idUserResponsable,
                               'idUserProg' => $idUserProg
                             ]);
                             $actGrupal = new ActGrupal;
                             $actGrupal->cuposDisponibles = $request->cuposTotales;
                             $actGrupal->cuposOcupados = '0';
                             $actividad->actividadGrupal()->save($actGrupal);
                       }
               break;
             case '4':
                       $nroTutorados = count($request->idAlumnoTutorado);
                       if($nroTutorados > 1){
                          $modalidad = '2';
                       }else{
                         $modalidad = '1';
                       }
                     $actividad = Actividad::create([
                       'titulo' => $request->titulo,
                       'fechaProgramacion' => $fechaP,
                       'horaProgramacion' => $horaP,
                       'lugar' => $request->lugar,
                       'referencia' => $request->referencia,
                       'descripcion' => $request->descripcion,
                       'informacionAdicional' => $request->informacionAdicional,
                       'rutaImagen' => $rutaImagen,
                       'invitado' => $invitado,
                       'cuposTotales' => $nroTutorados,
                       'estado' => '1',
                       'anioSemestre' => $request->anioSemestre,
                       'numeroSemestre' => $request->numeroSemestre,
                       'modalidad' => $modalidad,
                       'idTipoActividad' => $request->idTipoActividad,
                       'idUserResp' => $idUserResponsable,
                       'idUserProg' => $idUserProg
                     ]);
                     //buscar user en alumno
                     for ($i = 0; $i < $nroTutorados; $i++) {
                         $alumno = Alumno::findOrFail($request->idAlumnoTutorado[$i]);
                         $inscripcionADA = $actividad->inscripcionesADA()->create([
                         ]);
                         $inscripcionAlumno = new InscripcionAlumno;
                         $inscripcionAlumno->asistencia = '0';
                         $inscripcionAlumno->idActividad = $actividad->idActividad;
                         $inscripcionAlumno->alumno()->associate($alumno);
                         $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
                     }
                     $mensajeA = 'Se le ha programado una Actividad de Tutoría ';
                     $mensajeR = 'Se le ha programado sus actividades de tutoría';
               break;
             case '5':           case '6':           case '7':
                     $actividad = Actividad::create([
                       'titulo' => $request->titulo,
                       'fechaProgramacion' => $fechaP,
                       'horaProgramacion' => $horaP,
                       'lugar' => $request->lugar,
                       'referencia' => $request->referencia,
                       'descripcion' => $request->descripcion,
                       'informacionAdicional' => $request->informacionAdicional,
                       'rutaImagen' => $rutaImagen,
                       'invitado' => $invitado,
                       'cuposTotales' => $request->cuposTotales,
                       'estado' => '1',
                       'anioSemestre' => $request->anioSemestre,
                       'numeroSemestre' => $request->numeroSemestre,
                       'modalidad' => '2',
                       'idTipoActividad' => $request->idTipoActividad,
                       'idUserResp' => $idUserResponsable,
                       'idUserProg' => $idUserProg
                     ]);
                     $actGrupal = new ActGrupal;
                     $actGrupal->cuposDisponibles = $request->cuposTotales;
                     $actGrupal->cuposOcupados = '0';
                     $actividad->actividadGrupal()->save($actGrupal);
               break;
             case '8':
                     $array = preg_split('[ ]', $request->fechasConvocatoria);
                     $dia=substr($array[0],0 ,2); $mes=substr($array[0],3 ,2); $anio=substr($array[0],-4 ,4);
                     $fechaIC = $anio."-".$mes."-".$dia;
                     $dia=substr($array[2],0 ,2); $mes=substr($array[2],3 ,2); $anio=substr($array[2],-4 ,4);
                     $fechaFC = $anio."-".$mes."-".$dia;
                     //dd($fechaIC);
                     $actividad = Actividad::create([
                       'titulo' => $request->titulo,
                       'fechaProgramacion' => $fechaP,
                       'horaProgramacion' => $horaP,
                       'lugar' => $request->lugar,
                       'referencia' => $request->referencia,
                       'descripcion' => $request->descripcion,
                       'informacionAdicional' => $request->informacionAdicional,
                       'rutaImagen' => $rutaImagen,
                       'invitado' => $invitado,
                       'cuposTotales' => '0',
                       'estado' => '1',
                       'anioSemestre' => $request->anioSemestre,
                       'numeroSemestre' => $request->numeroSemestre,
                       'modalidad' => '2',
                       'idTipoActividad' => $request->idTipoActividad,
                       'idUserResp' => $idUserResponsable,
                       'idUserProg' => $idUserProg
                     ]);
                     $actMovilidad = new ActMovilidad;
                     $actMovilidad->fechaInicioConvocatoria = $fechaIC;
                     $actMovilidad->fechaFinConvocatoria = $fechaFC;
                     $actividad->actividadMovilidad()->save($actMovilidad);
               break;
             case '9':
                     $dia=substr($request->fechaInicioConvocatoria,0 ,2); $mes=substr($request->fechaInicioConvocatoria,3 ,2); $anio=substr($request->fechaInicioConvocatoria,-4 ,4);
                     $fechaIC = $anio."-".$mes."-".$dia;
                     $actividad = Actividad::create([
                       'titulo' => $request->titulo,
                       'fechaProgramacion' => $fechaP,
                       'horaProgramacion' => $horaP,
                       'lugar' => $request->lugar,
                       'referencia' => $request->referencia,
                       'descripcion' => $request->descripcion,
                       'informacionAdicional' => $request->informacionAdicional,
                       'rutaImagen' => $rutaImagen,
                       'invitado' => $invitado,
                       'cuposTotales' => '0',
                       'estado' => '1',
                       'anioSemestre' => $request->anioSemestre,
                       'numeroSemestre' => $request->numeroSemestre,
                       'modalidad' => '2',
                       'idTipoActividad' => $request->idTipoActividad,
                       'idUserResp' => $idUserResponsable,
                       'idUserProg' => $idUserProg
                     ]);
                     $actComedor = new ActComedor;
                     $actComedor->fechaConvocatoria = $fechaIC;
                     $actividad->actividadComedor()->save($actComedor);
               break;
             default:
             # code...
             break;
           }
           //---------------Notificacion o E-Mail-------------------//
           //dd('dodododododo');
           if($request->idAlumno != null){
             $userAl = User::findOrFail($request->idAlumno);
           }else{
             $userAl = null;
           }
           $userResp = User::findOrFail($idUserResponsable);
           Log::info(' Tipo de Actividad             ->  '.$actividad->idTipoActividad);
           $job = (new JobEnviarNuevaActEmail($actividad, $actividad->idTipoActividad, $userAl, $userResp, $mensajeR, $mensajeA, $request->idAlumnoTutorado))
                  ->delay(Carbon::now()->addSeconds(5));
           dispatch($job);
           return Redirect::to('programador/actividad');
         //}
     }
    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
    public function edit($id)
    {
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
    public function update(Request $request, $id)
    {
          $idUserProg = 22;
          $idUserResponsable = $request->idUserResponsable;
          $request->validate([
              'titulo' => 'required|max:100',
              'fechaProgramacion' => 'required|date_format:d/m/Y',
              'horaProgramacion' => 'required',
              'lugar' => 'required|max:200',
              'anioSemestre' => 'required',
              'numeroSemestre' => 'required',
              'rutaImagen' => 'image|mimes:jpeg,png,jpg'
          ]);
          Log::info('Actualizar actividad');
          $actividad = Actividad::findOrFail($id);
          Log::info($actividad);
           //----------------------- subir imagen usando Storage ----------------
          if($request->file('rutaImagen')){
                  //Eliminando Foto anterior
                 $path = $actividad->rutaImagen;
                 File::delete(storage_path('app/public/'.$actividad->rutaImagen));
                 Storage::delete($path);
                 //Guardar la nueva imagen
                 $file = $request->file('rutaImagen');
                 $name = 'imgAct_'.time().'.'.$file->getClientOriginalExtension();
                 $storage = Storage::disk('actividades')->put($name, \File::get($file));
                 if($storage){
                   $rutaImagen = 'actividades/'.$name;
                 }else{
                   $rutaImagen = $actividad->rutaImagen;
                 }
           }else {
             $rutaImagen = $actividad->rutaImagen;
           }
           Log::info('Ruta Imagen  '.$rutaImagen);
           $dia =substr( $request->fechaProgramacion,0 ,2); $mes =substr( $request->fechaProgramacion,3 ,2); $anio=substr( $request->fechaProgramacion,-4 ,4);
           $fechaP = $anio."-".$mes."-".$dia;
           $horaP = (Carbon::parse($request->horaProgramacion))->toTimeString();
           if($request->nombreResponsable != NULL || $request->nombreResponsable != ''){
             $invitado = $request->nombreResponsable.'-'.$request->apellidosResponsable.'-'.$request->emailResponsable;
           }else{
             $invitado = '--';
           }
           switch ($actividad->idTipoActividad) {
             case '1':
             case '2':
                       $idUserResponsable = $idUserProg;
                       $actividad->titulo = $request->titulo;
                       $actividad->fechaProgramacion = $fechaP;
                       $actividad->horaProgramacion = $horaP;
                       $actividad->lugar = $request->lugar;
                       $actividad->referencia = $request->referencia;
                       $actividad->descripcion = $request->descripcion;
                       $actividad->informacionAdicional = $request->informacionAdicional;
                       $actividad->rutaImagen = $rutaImagen;
                       $actividad->invitado = $invitado;
                       $actividad->cuposTotales = '1';
                       $actividad->estado = '1';
                       $actividad->anioSemestre = $request->anioSemestre;
                       $actividad->numeroSemestre = $request->numeroSemestre;
                       $actividad->modalidad = '1';
                       $actividad->idTipoActividad = $actividad->idTipoActividad;
                       $actividad->idUserResp = $idUserResponsable;
                       $actividad->idUserProg = $idUserProg;
                       $actividad->update();
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
                             Log::info('Individual');
                             $actividad->titulo = $request->titulo;
                             $actividad->fechaProgramacion = $fechaP;
                             $actividad->horaProgramacion = $horaP;
                             $actividad->lugar = $request->lugar;
                             $actividad->referencia = $request->referencia;
                             $actividad->descripcion = $request->descripcion;
                             $actividad->informacionAdicional = $request->informacionAdicional;
                             $actividad->rutaImagen = $rutaImagen;
                             $actividad->invitado = $invitado;
                             $actividad->cuposTotales = '1';
                             $actividad->estado = '1';
                             $actividad->anioSemestre = $request->anioSemestre;
                             $actividad->numeroSemestre = $request->numeroSemestre;
                             $actividad->modalidad = '1';
                             $actividad->idTipoActividad = $actividad->idTipoActividad;
                             $actividad->idUserResp = $idUserResponsable;
                             $actividad->idUserProg = $idUserProg;
                             $actividad->update();
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
                             Log::info('Grupal');
                             $actividad->titulo = $request->titulo;
                             $actividad->fechaProgramacion = $fechaP;
                             $actividad->horaProgramacion = $horaP;
                             $actividad->lugar = $request->lugar;
                             $actividad->referencia = $request->referencia;
                             $actividad->descripcion = $request->descripcion;
                             $actividad->informacionAdicional = $request->informacionAdicional;
                             $actividad->rutaImagen = $rutaImagen;
                             $actividad->invitado = $invitado;
                             $actividad->cuposTotales = $request->cuposTotales;
                             $actividad->estado = '1';
                             $actividad->anioSemestre = $request->anioSemestre;
                             $actividad->numeroSemestre = $request->numeroSemestre;
                             $actividad->modalidad = '2';
                             $actividad->idTipoActividad = $actividad->idTipoActividad;
                             $actividad->idUserResp = $idUserResponsable;
                             $actividad->idUserProg = $idUserProg;
                             $actividad->update();

                             $actGrupal = ActGrupal::where('idActividad', $actividad->idActividad)->first();
                             $actGrupal->cuposDisponibles = $request->cuposTotales;
                             $actGrupal->cuposOcupados = '0';
                             $actGrupal->update();
                             Log::info('Actualizando act 3      ----          Grupal');
                       }
               break;
             case '4':
                       $nroTutorados = count($request->idAlumnoTutorado);
                       if($nroTutorados > 1){
                          $modalidad = '2';
                       }else{
                         $modalidad = '1';
                       }
                       $actividad->titulo = $request->titulo;
                       $actividad->fechaProgramacion = $fechaP;
                       $actividad->horaProgramacion = $horaP;
                       $actividad->lugar = $request->lugar;
                       $actividad->referencia = $request->referencia;
                       $actividad->descripcion = $request->descripcion;
                       $actividad->informacionAdicional = $request->informacionAdicional;
                       $actividad->rutaImagen = $rutaImagen;
                       $actividad->invitado = $invitado;
                       $actividad->cuposTotales = $nroTutorados;
                       $actividad->estado = '1';
                       $actividad->anioSemestre = $request->anioSemestre;
                       $actividad->numeroSemestre = $request->numeroSemestre;
                       $actividad->modalidad = $modalidad;
                       $actividad->idTipoActividad = $actividad->idTipoActividad;
                       $actividad->idUserResp = $idUserResponsable;
                       $actividad->idUserProg = $idUserProg;
                       $actividad->update();
                       //eliminar inscripciones anteriores
                       $inscripcionAlumno = InscripcionAlumno::where('idActividad', $actividad->idActividad)->delete();
                       $inscripcionADA = InscripcionADA::where('idActividad', $actividad->idActividad)->delete();
                       //realizar inscripciones
                       for ($i = 0; $i < $nroTutorados; $i++) {
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
                     $actividad->titulo = $request->titulo;
                     $actividad->fechaProgramacion = $fechaP;
                     $actividad->horaProgramacion = $horaP;
                     $actividad->lugar = $request->lugar;
                     $actividad->referencia = $request->referencia;
                     $actividad->descripcion = $request->descripcion;
                     $actividad->informacionAdicional = $request->informacionAdicional;
                     $actividad->rutaImagen = $rutaImagen;
                     $actividad->invitado = $invitado;
                     $actividad->cuposTotales = $request->cuposTotales;
                     $actividad->estado = '1';
                     $actividad->anioSemestre = $request->anioSemestre;
                     $actividad->numeroSemestre = $request->numeroSemestre;
                     $actividad->modalidad = '2';
                     $actividad->idTipoActividad = $actividad->idTipoActividad;
                     $actividad->idUserResp = $idUserResponsable;
                     $actividad->idUserProg = $idUserProg;
                     $actividad->update();

                     $actGrupal = ActGrupal::where('idActividad', $actividad->idActividad)->first();
                     $actGrupal->cuposDisponibles = $request->cuposTotales;
                     $actGrupal->cuposOcupados = '0';
                     $actGrupal->update();
               break;
             case '8':
                     $array = preg_split('[ ]', $request->fechasConvocatoria);
                     $dia=substr($array[0],0 ,2); $mes=substr($array[0],3 ,2); $anio=substr($array[0],-4 ,4);
                     $fechaIC = $anio."-".$mes."-".$dia;
                     $dia=substr($array[2],0 ,2); $mes=substr($array[2],3 ,2); $anio=substr($array[2],-4 ,4);
                     $fechaFC = $anio."-".$mes."-".$dia;
                     $actividad->titulo = $request->titulo;
                     $actividad->fechaProgramacion = $fechaP;
                     $actividad->horaProgramacion = $horaP;
                     $actividad->lugar = $request->lugar;
                     $actividad->referencia = $request->referencia;
                     $actividad->descripcion = $request->descripcion;
                     $actividad->informacionAdicional = $request->informacionAdicional;
                     $actividad->rutaImagen = $rutaImagen;
                     $actividad->invitado = $invitado;
                     $actividad->cuposTotales = '0';
                     $actividad->estado = '1';
                     $actividad->anioSemestre = $request->anioSemestre;
                     $actividad->numeroSemestre = $request->numeroSemestre;
                     $actividad->modalidad = '2';
                     $actividad->idTipoActividad = $actividad->idTipoActividad;
                     $actividad->idUserResp = $idUserResponsable;
                     $actividad->idUserProg = $idUserProg;
                     Log::info($actividad);
                     $actividad->update();

                     $actMovilidad = ActMovilidad::where('idActividad', $actividad->idActividad)->first();
                     $actMovilidad->fechaInicioConvocatoria = $fechaIC;
                     $actMovilidad->fechaFinConvocatoria = $fechaFC;
                     Log::info($actMovilidad);
                     $actMovilidad->update();
               break;
             case '9':
                     $dia=substr($request->fechaInicioConvocatoria,0 ,2); $mes=substr($request->fechaInicioConvocatoria,3 ,2); $anio=substr($request->fechaInicioConvocatoria,-4 ,4);
                     $fechaIC = $anio."-".$mes."-".$dia;
                     $actividad->titulo = $request->titulo;
                     $actividad->fechaProgramacion = $fechaP;
                     $actividad->horaProgramacion = $horaP;
                     $actividad->lugar = $request->lugar;
                     $actividad->referencia = $request->referencia;
                     $actividad->descripcion = $request->descripcion;
                     $actividad->informacionAdicional = $request->informacionAdicional;
                     $actividad->rutaImagen = $rutaImagen;
                     $actividad->invitado = $invitado;
                     $actividad->cuposTotales = '0';
                     $actividad->estado = '1';
                     $actividad->anioSemestre = $request->anioSemestre;
                     $actividad->numeroSemestre = $request->numeroSemestre;
                     $actividad->modalidad = '2';
                     $actividad->idTipoActividad = $actividad->idTipoActividad;
                     $actividad->idUserResp = $idUserResponsable;
                     $actividad->idUserProg = $idUserProg;
                     Log::info($actividad);
                     $actividad->update();

                     $actComedor = ActComedor::where('idActividad', $actividad->idActividad)->first();
                     $actComedor->fechaConvocatoria = $fechaIC;
                     Log::info($actComedor);
                     $actComedor->update();
               break;
             default:
             # code...
             break;
           }
           //---------------Notificacion o E-Mail-------------------//
           if ($request->envioCorreos == 'on') {
             Log::info('envio de notificaciones');
             $userResp = User::findOrFail($idUserResponsable);
             $job = (new JobEnviarActualizarActEmail($actividad, $userResp, '1'))
                    ->delay(Carbon::now()->addSeconds(5));
             dispatch($job);
           }else {
             Log::info('No hay envio de notificaciones');
           }
           return Redirect::to('programador/actividad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->estado ='3';
        $actividad->update();
        //---------------Notificacion o E-Mail-------------------//
        Log::info('envio de notificaciones');
        $userResp = User::findOrFail($idUserResponsable);
        $job = (new JobEnviarActualizarActEmail($actividad, $userResp, '2'))
               ->delay(Carbon::now()->addSeconds(5));
        dispatch($job);
        return Redirect::to('programador/actividad');
    }

    public function execute($id) //ejecutar una actividad
    {
        $actividad = Actividad::findOrFail($id);
        /*switch ($actividad->idTipoActividad) {
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
          break;*
        }*/
        return view('programador.actividad.execute', ['actividad' => $actividad]);
    }

    public function updateExecute($id) //ejecutar una actividad
    {
        $actividad = Actividad::findOrFail($id);
        return Redirect::to('programador/actividad');
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
}
