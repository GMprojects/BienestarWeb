<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\ActComedor;
use BienestarWeb\ActMovilidad;
use BienestarWeb\Actividad;
use BienestarWeb\Alumno;
use BienestarWeb\BeneficiarioMovilidad;
use BienestarWeb\BeneficiarioComedor;
use BienestarWeb\EvidenciaMovilidad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class BeneficiarioController extends Controller{

    function getFecha($fechaIn){
         $dia = substr( $fechaIn,0 ,2);
         $mes =substr( $fechaIn,3 ,2);
         $anio=substr( $fechaIn,-4 ,4);
         return $anio."-".$mes."-".$dia;
    }

    public function createBeneficiario(Request $request, $idActividad)  {
        $actividad = Actividad::findOrFail($idActividad);
        if ($actividad->idTipoActividad == '8') {//movilidad
             $idAlumnos = BeneficiarioMovilidad::where('idActividad', $actividad['idActividad'])->pluck('idAlumno');
        } else {// comedor
             $idAlumnos = BeneficiarioComedor::where('idActividad', $actividad['idActividad'])->pluck('idAlumno');
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
            $actividad->beneficiariosMovilidad()->attach($request->idAlumno,['fechaInicio' => BeneficiarioController::getFecha($request->fechaInicio),
                                                                               'fechaFin' => BeneficiarioController::getFecha($request->fechaFin),
                                                                               'duracionMeses' => $request->duracionMeses,
                                                                               'duracionAnio' => $request->duracionAnio,
                                                                               'institucion' => $request->institucion,
                                                                               'pais' => $request->pais,
                                                                               'observaciones' => $request->observaciones]);
            //$idBeneficiario = BeneficiarioMovilidad::where([['idActividad', $actividad->idActividad],['idAlumno', $request->idAlumno]])->pluck('idBeneficiarioMovilidad')[0];
            //dd();
        } else {// comedor
            $actividad->beneficiariosComedor()->attach($request->idAlumno,['fechaBeneficio' => BeneficiarioController::getFecha($request->fechaBeneficio),
                                                                            'tipoBeneficio' => $request->tipoBeneficio]);
            //$idBeneficiario = BeneficiarioComedor::where([['idActividad', $actividad->idActividad],['idAlumno', $request->idAlumno]])->pluck('idBeneficiarioComedor')[0];
            //dd($actComedor);
        }
        //return redirect()->action('BeneficiarioController@editBeneficiario',[$actividad->idActividad,  $idBeneficiario ]);
        return redirect()->action('ActividadController@execute',['idActividad' => $idActividad]);
    }

    public function editBeneficiario($idActividad, $idBeneficiario)  {
       //dd($idTipoActividad.'     '.$idBeneficiario);
       $id_idTipoActividad = Actividad::where([['idActividad', $idActividad], ['estado', '<', '5']])->select('idActividad','idTipoActividad')->first();
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
            $actividad->beneficiariosMovilidad()->updateExistingPivot($beneficiario->idAlumno,['fechaInicio' => BeneficiarioController::getFecha($request->fechaInicio),
                                                                                                               'observaciones' => $request->observaciones]);
            //dd($actMovilidad);
        } else {// comedor
            $beneficiario = BeneficiarioComedor::findOrFail($idBeneficiario);
            $actividad->beneficiariosComedor()->updateExistingPivot($beneficiario->idAlumno,['fechaBeneficio' => BeneficiarioController::getFecha($request->fechaBeneficio),
                                                                                                                  'tipoBeneficio' => $request->tipoBeneficio]);
            //dd($actComedor);
        }
        return redirect()->action('ActividadController@execute',['idActividad' => $idActividad]);
    }

    public function destroyBeneficiario($idActividad, $idBeneficiario) {
       $actividad = Actividad::findOrFail($idActividad);
       if ($actividad->idTipoActividad == '8') {//movilidad
         $beneficiario = BeneficiarioMovilidad::findOrFail($idBeneficiario);
         $evidenciasMovilidad = EvidenciaMovilidad::where('idBeneficiarioMovilidad', $idBeneficiario)->get();
         foreach ($evidenciasMovilidad as $evidenciaMovilidad) {
            $path = $evidenciaMovilidad->ruta;
            File::delete(storage_path('app/public/'.$evidenciaMovilidad->ruta));
            Storage::delete($path);
            $evidenciaMovilidad->delete();
         }
         $actividad->beneficiariosMovilidad()->detach($beneficiario->idAlumno);
         //dd($actMovilidad);
       } else {// comedor
         $beneficiario = BeneficiarioComedor::findOrFail($idBeneficiario);
         $actividad->beneficiariosComedor()->detach($beneficiario->idAlumno);
         //dd($actComedor);
       }
       return redirect()->action('ActividadController@execute',['idActividad' => $idActividad]);
    }

   public function indexEvidenciasBeneficiario($idActividad, $idBeneficiario){
      $beneficiarioMovilidad = BeneficiarioMovilidad::findOrFail($idBeneficiario);
      //dd($beneficiario->evidenciasMovilidad);
      //dd($idAlumnoBeneficiario);
      $alumno = Alumno::findOrFail($beneficiarioMovilidad->idAlumno);
      //dd($alumno->actividadesMovilidad[0]->pivot->fechaInicio);
      return view('programador.actividad.beneficiario.evidencia.index',['beneficiarioMovilidad' => $beneficiarioMovilidad, 'alumno' => $alumno, 'actividadMovilidad' => $alumno->actividadesMovilidad[0]]);
   }

   public function storeEvidenciaBeneficiario(Request $request, $idActividad, $idBeneficiario){
         $request->validate([
             'ruta' => 'file',
             'nombre' => 'required|max:45'
         ]);
         $beneficiario = BeneficiarioMovilidad::findOrFail($idBeneficiario);
         $actividad = Actividad::findOrFail($beneficiario->idActividad);
         if($request->file('ruta')){
                $file = $request->file('ruta');
                $preRuta = 'evidenciaBeneficiario/'.$actividad->tipoActividad['tipo'].$actividad->idActividad.'/beneficiario'.$idBeneficiario.'/';
                $name = 'evidenciaBeneficiario_'.$idBeneficiario.'_'.time().'.'.$file->getClientOriginalExtension();
                $storage = Storage::disk('actividades')->put($preRuta.$name, \File::get($file));
                if($storage){
                  $rutaImagen = 'actividades/'.$preRuta.$name;
                }
         }else {
          $rutaImagen = NULL;
         }
         $evidenciaMovilidad = new EvidenciaMovilidad;
         $evidenciaMovilidad->ruta = $rutaImagen;
         $evidenciaMovilidad->nombre = $request->nombre;
         $evidenciaMovilidad->idBeneficiarioMovilidad = $idBeneficiario;
         $evidenciaMovilidad->save();
         return redirect()->back();
   }

   public function destroyEvidenciaBeneficiario($idActividad, $idBeneficiario, $idEvidencia){
         $evidenciaMovilidad = EvidenciaMovilidad::findOrFail($idEvidencia);
         $path = $evidenciaMovilidad->ruta;
         //  unlink($path);
         File::delete(storage_path('app/public/'.$evidenciaMovilidad->ruta));
         Storage::delete($path);
         $evidenciaMovilidad->delete();
         return redirect()->back();
   }

   public function descargarEvidenciaBeneficiario(Request $request){
      //if($request->ajax()){
          $evidenciaMovilidad = EvidenciaMovilidad::findOrFail($request->idEvidenciaMovilidad);
          return response()->download(storage_path('app/public/'.$evidenciaMovilidad->ruta));
      //}
   }

}
