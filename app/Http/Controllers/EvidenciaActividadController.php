<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\EvidenciaActividad;
use BienestarWeb\Actividad;
use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use File;
class EvidenciaActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $evidenciasActividad = EvidenciaActividad::Search($request)->get();
        //dd($actividades);
        $evidenciasActividad->each(function($evidenciasActividad){
            $evidenciasActividad->actividad;
        });
      //  dd($evidenciasActividad);
        return view('programador.evidenciaActividad.index')
                ->with('evidenciasActividad', $evidenciasActividad)
                ->with('idActividad',$request->idActividad);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('programador.evidenciaActividad.create')
              ->with('idActividad',$request->idActividad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'ruta' => 'file',
            'nombre' => 'required|max:45'
        ]);
        $actividad = Actividad::findOrFail($request->idActividad);
        if($request->file('ruta')){
               $file = $request->file('ruta');
               $preRuta = 'evidenciaActividad/'.$actividad->tipoActividad['tipo'].$request->idActividad.'/';
               $name = 'evidenciaActividad_'.$request->idActividad.'_'.time().'.'.$file->getClientOriginalExtension();
               $storage = Storage::disk('actividades')->put($preRuta.$name, \File::get($file));
               if($storage){
                 $rutaImagen = 'actividades/'.$preRuta.$name;
               }
        }else {
         $rutaImagen = NULL;
        }
        $evidenciaActividad = new EvidenciaActividad;
        $evidenciaActividad->ruta = $rutaImagen;
        $evidenciaActividad->nombre = $request->nombre;
        $evidenciaActividad->idActividad = $request->idActividad;
        $evidenciaActividad->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\EvidenciaActividad  $evidenciaActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evidenciaActividad = EvidenciaActividad::findOrFail($id);
        $path = $evidenciaActividad->ruta;
      //  unlink($path);
        File::delete(storage_path('app/public/'.$evidenciaActividad->ruta));
        Storage::delete($path);
        $evidenciaActividad->delete();
        return redirect()->back();
    }

    public function descargarEvidencia(Request $request){
        //if($request->ajax()){
            $evidencia = EvidenciaActividad::findOrFail($request->idEvidencia);
            return response()->download(storage_path('app/public/'.$evidencia->ruta));
        //}

    }
}
