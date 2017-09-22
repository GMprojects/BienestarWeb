<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use BienestarWeb\TipoActividad;


class TipoActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tiposActividad = TipoActividad::Search($request->texto)->paginate(7);
        $tiposActividad->each(function($tiposActividad){
            $tiposActividad->actividad;
        });
        return view('admin.tipoActividad.index')->with('tiposActividad',$tiposActividad);
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

        if(Input::hasFile('rutaImagen'))
        {
            $archivo = Input::file('rutaImagen');
            $file->move(public_path().'/imagenes/tiposActividad', $file->getClientOriginalName());
        }

        $tipoActividad->save();
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
        $tipoActividad->tipo = $request->get('tipo');
        $tipoActividad->rutaImagen = $request->get('rutaImagen');
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
