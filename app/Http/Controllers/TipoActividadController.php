<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use BienestarWeb\TipoActividad;
use Illuminate\Support\Facades\Storage;
use File;


class TipoActividadController extends Controller
{

    function getDirigidoA(Request $request){
      $dirigidoA = "";
      if ($request->dirgidoA1 == 'on') {
         $dirigidoA = $dirigidoA + '1';
      }
      if ($request->dirgidoA2 == 'on') {
         $dirigidoA = $dirigidoA + '2';
      }
      if ($request->dirgidoA3 == 'on') {
         $dirigidoA = $dirigidoA + '3';
      }
      dd($dirigidoA);
      return $dirigidoA;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tiposActividad = TipoActividad::Search($request->texto)->get();
        return view('admin.tipoActividad.index',['tiposActividad' => $tiposActividad]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.tipoActividad.create");
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
                 $tipoActividad->dirigidoA = TipoActividadController::getDirigidoA($request);
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
    public function show($id)
    {
        return view('admin.tipoActividad.show', ['tipoActividad'=>TipoActividad::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    public function update(Request $request, $id)
    {
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
        $tipoActividad->dirigidoA = TipoActividadController::getDirigidoA($request);
        $tipoActividad->rutaImagen = $rutaImagen;
        $tipoActividad->update();

        return Redirect::to('admin/tipoActividad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoActividad = TipoActividad::findOrFail($id);
        $tipoActividad->delete();

        return Redirect::to('admin/tipoActividad');

    }
}
