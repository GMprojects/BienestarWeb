<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use BienestarWeb\TipoActividad;
use BienestarWeb\Actividad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use File;

class TipoActividadController extends Controller{

    function getDirigidoA(Request $request){
         $dirigidoA = "";
         if ($request->dirigidoA1 == 'on') {
            $dirigidoA = $dirigidoA.'1';
         }
         if ($request->dirigidoA2 == 'on') {
            $dirigidoA = $dirigidoA.'2';
         }
         if ($request->dirigidoA3 == 'on') {
            $dirigidoA = $dirigidoA.'3';
         }
         return $dirigidoA;
    }
    function getResponsable(Request $request){
         $responsable = "";
         if ($request->responsableA1 == 'on') {
            $responsable = $responsable.'1';
         }
         if ($request->responsableA2 == 'on') {
            $responsable = $responsable.'2';
         }
         if ($request->responsableA3 == 'on') {
            $responsable = $responsable.'3';
         }
         return $responsable;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $tiposActividad = TipoActividad::get();
        $idTiposActividad = Actividad::select('idTipoActividad')->distinct()->pluck('idTipoActividad');
        return view('admin.tipoActividad.index',['tiposActividad' => $tiposActividad, 'idTiposActividad' => Collection::unwrap($idTiposActividad)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view("admin.tipoActividad.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'tipo' => 'required|max:45',
            'rutaImagen' => 'required'
        ]);

        $tipoActividad = new TipoActividad;
        $tipoActividad->tipo = $request->get('tipo');
        if($request->file('rutaImagen')){
               $file = $request->file('rutaImagen');
               $preRuta = 'tipoActividad/';
               $name = 'tA'.time().'.'.$file->getClientOriginalExtension();
               $storage = Storage::disk('actividades')->put($preRuta.$name, \File::get($file));
               if($storage){
                 $rutaImagen = 'actividades/'.$preRuta.$name;
                 $tipoActividad->rutaImagen = $rutaImagen;
                 $tipoActividad->dirigidoA = $this->getDirigidoA($request);
                 $tipoActividad->responsable = $this->getResponsable($request);
                 $tipoActividad->save();
               }
        }

        return Redirect::to('admin/tipoActividad');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return view('admin.tipoActividad.show', ['tipoActividad'=>TipoActividad::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $tipoActividad = TipoActividad::findOrFail($id);
        return view('admin.tipoActividad.edit', ['tipoActividad'=>$tipoActividad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $tipoActividad = TipoActividad::findOrFail($id);
        if($request->file('rutaImagen')){
                //Eliminando Foto anterior
               $path = $tipoActividad->rutaImagen;
               File::delete(storage_path('app/public/'.$tipoActividad->rutaImagen));
               Storage::delete($path);
               //Guardar la nueva imagen
               $file = $request->file('rutaImagen');
               $preRuta = 'tipoActividad/';
               $name = 'tA'.time().'.'.$file->getClientOriginalExtension();
               $storage = Storage::disk('actividades')->put($preRuta.$name, \File::get($file));
               if($storage){
                 $rutaImagen = 'actividades/'.$preRuta.$name;
               }else{
                 $rutaImagen = $actividad->rutaImagen;
               }
         }else {
           $rutaImagen = $tipoActividad->rutaImagen;
         }
        $tipoActividad->rutaImagen = $rutaImagen;
        $tipoActividad->dirigidoA = $this->getDirigidoA($request);
        $tipoActividad->responsable = $this->getResponsable($request);
        $tipoActividad->update();

        return Redirect::to('admin/tipoActividad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        TipoActividad::destroy($id);

        return Redirect::to('admin/tipoActividad');
    }
}
