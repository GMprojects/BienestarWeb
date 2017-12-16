<?php

namespace BienestarWeb\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Validation\Rule;

use BienestarWeb\Egresado;
use BienestarWeb\Trabajo;

class EgresadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $egresados = Egresado::Search($request->texto)->get();
        $egresados->each(function($egresados){
            $egresados->trabajos;
        });
        return view('admin.egresado.index')->with('egresados', $egresados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.egresado.create');
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
            'grado' => 'required',
            'nombre' => 'required|max:45',
            'apellidoPaterno' => 'required|max:20',
            'apellidoMaterno' => 'required|max:20',
            'codigo' => 'required|max:20|unique:egresado',
            'anioEgreso' => 'required',
            'numeroSemestre' => ['required', Rule::in('1','2')],
        ]);

        $egresado = new Egresado;
        $egresado->grado = $request->grado;
        $egresado->nombre = $request->nombre;
        $egresado->apellidoPaterno = $request->apellidoPaterno;
        $egresado->apellidoMaterno = $request->apellidoMaterno;
        $egresado->direccion = $request->direccion;
        $egresado->telefono = $request->telefono;
        $egresado->celular = $request->celular;
        $egresado->email = $request->email;
        $egresado->codigo = $request->codigo;
        $egresado->anioEgreso = $request->anioEgreso;
        $egresado->numeroSemestre = $request->numeroSemestre;

        //dd($egresado);
        $egresado->save();
        return Redirect::to('admin/egresado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $egresado = Egresado::findOrFail($id);
        //$egresado->each(function($egresado){
          //  $egresado->trabajos;
        //});
        return view('admin.egresado.show',['egresado' => $egresado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $egresado = Egresado::findOrFail($id);
        return view('admin.egresado.edit', ['egresado'=>$egresado]);
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
         $request->validate([
            'grado' => 'required',
            'nombre' => 'required|max:45',
            'apellidoPaterno' => 'required|max:20',
            'apellidoMaterno' => 'required|max:20',
            'anioEgreso' => 'required',
            'numeroSemestre' => ['required', Rule::in('1','2')],
        ]);
        $egresado = Egresado::findOrFail($id);
        $egresado->grado = $request->grado;
        $egresado->nombre = $request->nombre;
        $egresado->apellidoPaterno = $request->apellidoPaterno;
        $egresado->apellidoMaterno = $request->apellidoMaterno;
        $egresado->direccion = $request->direccion;
        $egresado->telefono = $request->telefono;
        $egresado->celular = $request->celular;
        $egresado->email = $request->email;
        $egresado->codigo = $request->codigo;
        $egresado->anioEgreso = $request->anioEgreso;
        $egresado->numeroSemestre = $request->numeroSemestre;
        $egresado->update();

        return Redirect::to('admin/egresado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $egresado = Egresado::findOrFail($id);
        if(count($egresado->trabajos)>0){
            Trabajo::where('idEgresado',$id)->delete();
        }
        Egresado::destroy($id);
        return Redirect::to('admin/egresado');
    }
}
