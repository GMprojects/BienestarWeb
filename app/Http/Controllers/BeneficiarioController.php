<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\ActComedor;
use BienestarWeb\ActMovilidad;
use BienestarWeb\Actividad;
use BienestarWeb\Alumno;
use BienestarWeb\BeneficiarioMovilidad;
use BienestarWeb\BeneficiarioComedor;

use Illuminate\Http\Request;

class BeneficiarioController extends Controller{

    public function createBeneficiario(Request $request, $idActividad)  {
        $actividad = Actividad::findOrFail($idActividad);
        if ($actividad->idTipoActividad == '8') {//movilidad
             $idAlumnos = BeneficiarioMovilidad::where('idActMovilidad', $actividad->actividadMovilidad['idActMovilidad'])->pluck('idAlumno');
        } else {// comedor
             $idAlumnos = BeneficiarioComedor::where('idActComedor', $actividad->actividadComedor['idActComedor'])->pluck('idAlumno');
        }
        $alumnos = Alumno::join('user','alumno.idUser','=','user.id')
                        ->whereNotIn('alumno.idAlumno', $idAlumnos)
                        ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                        ->get();
        return view('programador.actividad.beneficiario.create',['actividad' => $actividad, 'alumnos' => $alumnos, 'tipoActividad' => $actividad->idTipoActividad]);
    }

    public function storeBeneficiario(Request $request, $idActividad)  {
        //dd($request->all());
        $actividad = Actividad::findOrFail($idActividad);
        if ($actividad->idTipoActividad == '8') {//movilidad
            $actMovilidad = $actividad->actividadMovilidad;
            $actMovilidad->beneficiariosMovilidad()->attach($request->idAlumno,['fechaInicio' => BeneficiarioController::getFecha($request->fechaInicio),
                                                                               'fechaFin' => BeneficiarioController::getFecha($request->fechaFin),
                                                                               'duracionMeses' => $request->duracionMeses,
                                                                               'duracionAnio' => $request->duracionAnio,
                                                                               'institucion' => $request->institucion,
                                                                               'pais' => $request->pais,
                                                                               'observaciones' => $request->observaciones]);
            //dd($actMovilidad);
        } else {// comedor
            $actComedor = $actividad->actividadComedor;
            $actComedor->beneficiariosComedor()->attach($request->idAlumno,['fechaBeneficio' => BeneficiarioController::getFecha($request->fechaBeneficio),
                                                                            'tipoBeneficio' => $request->tipoBeneficio]);
            //dd($actComedor);
        }
        return redirect()->action('ActividadController@execute',['idActividad' => $idActividad]);
    }

    public function editBeneficiario($idActividad, $idBeneficiario)  {
       //dd($idTipoActividad.'     '.$idBeneficiario);
       $id_idTipoActividad = Actividad::where('idActividad', $idActividad)->select('idActividad','idTipoActividad')->first();
       //dd($id_idTipoActividad->idActividad);
       if ($id_idTipoActividad->idTipoActividad == '8') {//movilidad
         $beneficiario = BeneficiarioMovilidad::findOrFail($idBeneficiario);
         $alumno = Alumno::findOrFail($beneficiario->idAlumno);
       } else {// comedor
         $beneficiario = BeneficiarioComedor::findOrFail($idBeneficiario);
         $alumno = Alumno::findOrFail($beneficiario->idAlumno);
       }
       return view('programador.actividad.beneficiario.edit', ['idActividad' => $id_idTipoActividad->idActividad, 'idTipoActividad' => $id_idTipoActividad->idTipoActividad, 'beneficiario' => $beneficiario, 'alumno' => $alumno]);
    }

    public function updateBeneficiario(Request $request, $idActividad, $idBeneficiario)  {
         //dd('idAct'.$idActividad.' - '.'idBenef'.$idBeneficiario);
        //dd($request->all());
        $actividad = Actividad::findOrFail($idActividad);
        if ($actividad->idTipoActividad == '8') {//movilidad
            $dia =substr( $request->fechaFin,0 ,2); $mes =substr( $request->fechaFin,3 ,2); $anio=substr( $request->fechaFin,-4 ,4);
            $fechaF = $anio."-".$mes."-".$dia;

            $beneficiario = BeneficiarioMovilidad::findOrFail($idBeneficiario);
            $actividad->actividadMovilidad->beneficiariosMovilidad()->updateExistingPivot($beneficiario->idAlumno,['fechaInicio' => BeneficiarioController::getFecha($request->fechaInicio),
                                                                                                               'observaciones' => $request->observaciones]);
            //dd($actMovilidad);
        } else {// comedor
            $beneficiario = BeneficiarioComedor::findOrFail($idBeneficiario);
            $actividad->actividadComedor->beneficiariosComedor()->updateExistingPivot($beneficiario->idAlumno,['fechaBeneficio' => BeneficiarioController::getFecha($request->fechaBeneficio),
                                                                                                                  'tipoBeneficio' => $request->tipoBeneficio]);
            //dd($actComedor);
        }
        return redirect()->action('ActividadController@execute',['idActividad' => $idActividad]);
    }

    public function destroyBeneficiario($idActividad, $idBeneficiario) {
       //dd('idAct'.$idActividad.' - '.'idBenef'.$idBeneficiario);
       $actividad = Actividad::findOrFail($idActividad);
       if ($actividad->idTipoActividad == '8') {//movilidad
         $beneficiario = BeneficiarioMovilidad::findOrFail($idBeneficiario);
         $actividad->actividadMovilidad->beneficiariosMovilidad()->detach($beneficiario->idAlumno);
         //dd($actMovilidad);
       } else {// comedor
         $beneficiario = BeneficiarioComedor::findOrFail($idBeneficiario);
         $actividad->actividadComedor->beneficiariosComedor()->detach($beneficiario->idAlumno);
         //dd($actComedor);
       }
       return redirect()->action('ActividadController@execute',['idActividad' => $idActividad]);
    }

    function getFecha($fechaIn){
       $dia = substr( $fechaIn,0 ,2);
       $mes =substr( $fechaIn,3 ,2);
       $anio=substr( $fechaIn,-4 ,4);
       return $anio."-".$mes."-".$dia;
   }
}
