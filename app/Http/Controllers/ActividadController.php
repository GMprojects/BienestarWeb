<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Actividad;
use BienestarWeb\ActGrupal;
use BienestarWeb\ActMovilidad;
use BienestarWeb\ActComedor;
use BienestarWeb\TipoActividad;
use BienestarWeb\User;
use BienestarWeb\Alumno;
use BienestarWeb\InscripcionAlumno;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Http\Controllers\Controller;

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
        $actividades->each(function($actividades){
            $actividades->tipoActividad;
            $actividades->evidenciasActividad;
            $actividades->responsable;
            $actividades->programador;
            $actividades->inscripcionesADA;
            $actividades->encuestas;
            $actividades->actividadesComedor;
            $actividades->actividadesMovilidad;
            $actividades->actividadesPedagogia;
            $actividades->actividadesGrupal;
        });
        //dd($actividades);
        return view('programador.actividad.index')
                ->with('actividades', $actividades)
                ->with('idUserProgramador', $request->idUserProgramador)
                ->with('idUserResponsable', $request->idUserResponsable)
                ->with('idUserInscrito', $request->idUserInscrito)
                ->with('estadoCancelado', $request->estadoCancelado);
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
        $request->validate([
             'titulo' => 'required|max:100',
             'fechaProgramacion' => 'required|date_format:d/m/Y',
             'horaProgramacion' => 'required',
             'lugar' => 'required|max:200',
             'modalidad' => 'required',
             'anioSemestre' => 'required',
             'numeroSemestre' => 'required',
             'rutaImagen' => 'mimes:jpeg,png'
         ]);
         $idUserProg=22;

         if($request->file('rutaImagen')){
             $file = $request->file('rutaImagen');
             $name = 'imgAct_'.time().'.'.$file->getClientOriginalExtension();
             $path = public_path().'/images/Actividad/';
             $file->move($path,$name);
         }else{
           $name=NULL;
         }
         //$fechaP =  $request->fechaProgramacion->format('Y-m-d');
         $dia =substr( $request->fechaProgramacion,0 ,2); $mes =substr( $request->fechaProgramacion,3 ,2); $anio=substr( $request->fechaProgramacion,-4 ,4);
         $fechaP = $anio."-".$mes."-".$dia;
         $hora=substr($request->horaProgramacion,0 ,2); $min=substr($request->horaProgramacion,3 ,2); $ind=substr($request->horaProgramacion,-4 ,4);
         if($ind == 'PM'){
           $h = ($hora+12).":".$min.":00";
         }
         $h = (int)$hora.":".$min.":00";
         switch ($request->idTipoActividad) {
           case '1':
           case '2':
                     $actividad = Actividad::create([
                       'titulo' => $request->titulo,
                       'fechaProgramacion' => $fechaP,
                       'horaProgramacion' => $h,
                       'lugar' => $request->lugar,
                       'rutaImagen' => $name,
                       'cuposTotales' => '1',
                       'estado' => '1',
                       'anioSemestre' => $request->anioSemestre,
                       'numeroSemestre' => $request->numeroSemestre,
                       'modalidad' => $request->modalidad,
                       'idTipoActividad' => $request->idTipoActividad,
                       'idUserResp' => $idUserProg,
                       'idUserProg' => $idUserProg
                     ]);
                     //buscar user en alumno
                     $alumno = Alumno::findOrFail($request->idAlumnoI);
                     $inscripcionADA = $actividad->inscripcionesADA()->create([
                     ]);
                     $inscripcionAlumno = new InscripcionAlumno;
                     $inscripcionAlumno->asistencia = '0';
                     $inscripcionAlumno->idActividad = $actividad->idActividad;
                     $inscripcionAlumno->alumno()->associate($alumno);
                     $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
             break;
           case '3':
           case '10':
                     if($request->modalidad == 1){//INDIVIDUAL
                           $actividad = Actividad::create([
                             'titulo' => $request->titulo,
                             'fechaProgramacion' => $fechaP,
                             'horaProgramacion' => $h,
                             'lugar' => $request->lugar,
                             'rutaImagen' => $name,
                             'cuposTotales' => '1',
                             'estado' => '1',
                             'anioSemestre' => $request->anioSemestre,
                             'numeroSemestre' => $request->numeroSemestre,
                             'modalidad' => '1',
                             'idTipoActividad' => $request->idTipoActividad,
                             'idUserResp' => $request->idResponsable,
                             'idUserProg' => $idUserProg
                           ]);
                           //buscar user en alumno
                           $alumno = Alumno::findOrFail($request->idAlumnoI);
                           $inscripcionADA = $actividad->inscripcionesADA()->create([
                           ]);
                           $inscripcionAlumno = new InscripcionAlumno;
                           $inscripcionAlumno->asistencia = '0';
                           $inscripcionAlumno->idActividad = $actividad->idActividad;
                           $inscripcionAlumno->alumno()->associate($alumno);
                           $inscripcionADA->inscripcionAlumno()->save($inscripcionAlumno);
                     }else{//GRUPAL
                           $actividad = Actividad::create([
                             'titulo' => $request->titulo,
                             'fechaProgramacion' => $fechaP,
                             'horaProgramacion' => $h,
                             'lugar' => $request->lugar,
                             'rutaImagen' => $name,
                             'cuposTotales' => $request->cuposTotales,
                             'estado' => '1',
                             'anioSemestre' => $request->anioSemestre,
                             'numeroSemestre' => $request->numeroSemestre,
                             'modalidad' => '2',
                             'idTipoActividad' => $request->idTipoActividad,
                             'idUserResp' => $request->idResponsable,
                             'idUserProg' => $idUserProg
                           ]);
                           $actGrupal = new ActGrupal;
                           $actGrupal->cuposDisponibles = $request->cuposTotales;
                           $actGrupal->cuposOcupados = '0';
                           $actividad->actividadesGrupal()->save($actGrupal);
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
                     'horaProgramacion' => $h,
                     'lugar' => $request->lugar,
                     'rutaImagen' => $name,
                     'cuposTotales' => $nroTutorados,
                     'estado' => '1',
                     'anioSemestre' => $request->anioSemestre,
                     'numeroSemestre' => $request->numeroSemestre,
                     'modalidad' => $modalidad,
                     'idTipoActividad' => $request->idTipoActividad,
                     'idUserResp' => $request->idResponsable,
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
             break;
           case '5':
           case '6':
           case '7':
                   $actividad = Actividad::create([
                     'titulo' => $request->titulo,
                     'fechaProgramacion' => $fechaP,
                     'horaProgramacion' => $h,
                     'lugar' => $request->lugar,
                     'rutaImagen' => $name,
                     'cuposTotales' => $request->cuposTotales,
                     'estado' => '1',
                     'anioSemestre' => $request->anioSemestre,
                     'numeroSemestre' => $request->numeroSemestre,
                     'modalidad' => '2',
                     'idTipoActividad' => $request->idTipoActividad,
                     'idUserResp' => $request->idResponsable,
                     'idUserProg' => $idUserProg
                   ]);
                   $actGrupal = new ActGrupal;
                   $actGrupal->cuposDisponibles = $request->cuposTotales;
                   $actGrupal->cuposOcupados = '0';
                   $actividad->actividadesGrupal()->save($actGrupal);
             break;
           case '8':
                   $dia=substr($request->fechaInicioConvocatoria,0 ,2); $mes=substr($request->fechaInicioConvocatoria,3 ,2); $anio=substr($request->fechaInicioConvocatoria,-4 ,4);
                   $fechaIC = $anio."-".$mes."-".$dia;
                   $dia=substr($request->fechaFinConvocatoria,0 ,2); $mes=substr($request->fechaFinConvocatoria,3 ,2); $anio=substr($request->fechaFinConvocatoria,-4 ,4);
                   $fechaFC = $anio."-".$mes."-".$dia;
                   $actividad = Actividad::create([
                     'titulo' => $request->titulo,
                     'fechaProgramacion' => $fechaP,
                     'horaProgramacion' => $h,
                     'lugar' => $request->lugar,
                     'rutaImagen' => $name,
                     'cuposTotales' => '0',
                     'estado' => '1',
                     'anioSemestre' => $request->anioSemestre,
                     'numeroSemestre' => $request->numeroSemestre,
                     'modalidad' => '2',
                     'idTipoActividad' => $request->idTipoActividad,
                     'idUserResp' => $request->idResponsable,
                     'idUserProg' => $idUserProg
                   ]);
                   $actMovilidad = new ActMovilidad;
                   $actMovilidad->fechaInicioConvocatoria = $request->fechaInicioConvocatoria;
                   $actMovilidad->fechaFinConvocatoria = $request->fechaFinConvocatoria;
                   $actividad->actividadesMovilidad()->save($actMovilidad);
             break;
           case '9':
                   $fecha_ddmmYYY = $request->fechaInicioConvocatoria;
                   $dia=substr($fecha_ddmmYYY,0 ,2); $mes=substr($fecha_ddmmYYY,3 ,2); $anio=substr($fecha_ddmmYYY,-4 ,4);
                   $fechaIC = $anio."-".$mes."-".$dia;
                   $actividad = Actividad::create([
                     'titulo' => $request->titulo,
                     'fechaProgramacion' => $fechaP,
                     'horaProgramacion' => $h,
                     'lugar' => $request->lugar,
                     'rutaImagen' => $name,
                     'cuposTotales' => '0',
                     'estado' => '1',
                     'anioSemestre' => $request->anioSemestre,
                     'numeroSemestre' => $request->numeroSemestre,
                     'modalidad' => '2',
                     'idTipoActividad' => $request->idTipoActividad,
                     'idUserResp' => $request->idResponsable,
                     'idUserProg' => $idUserProg
                   ]);
                   $actComedor = new ActComedor;
                   $actComedor->fechaInicioConvocatoria = $fechaIC;
                   $actividad->actividadesComedor()->save($actComedor);
             break;
           default:
           # code...
           break;
         }
         return Redirect::to('programador/actividad');
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
            $actividad->actividadesComedor;
            $actividad->actividadesMovilidad;
            $actividad->actividadesPedagogia;
            $actividad->actividadesGrupal;
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
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        //
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
        return Redirect::to('programador/actividad');
    }

}
