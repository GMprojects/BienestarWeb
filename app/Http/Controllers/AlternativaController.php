<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Alternativa;
use BienestarWeb\Encuesta;

use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

class AlternativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $alternativas = Alternativa::Search($request->texto)->get();
          $alternativas->each(function($alternativas){
              $alternativas->encuesta;
          });
          return view('admin.alternativa.index')
              ->with('alternativas',$alternativas)
              ->with('idEncuesta',$request->texto);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.alternativa.create')
            ->with('idEncuesta',$request->idEncuesta);
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
            'etiqueta' => 'required'
        ]);
        $alternativa = new Alternativa;
        $alternativa->etiqueta = $request->etiqueta;
        $encuesta = Encuesta::findOrFail($request->idEncuesta);
        $encuesta->alternativas()->save($alternativa);
      //return Redirect::to('admin/alternativa');
        return redirect()->action('AlternativaController@index', ['texto' => $request->idEncuesta]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \BienestarWeb\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BienestarWeb\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.alternativa.edit')
        ->with('alternativa',Alternativa::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BienestarWeb\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alternativa = Alternativa::findOrFail($id);
        $alternativa->etiqueta = $request->get('etiqueta');
        $alternativa->update();
        //return Redirect::to('admin/alternativa')->with('texto',$idEncuesta);
        //return redirect()->back();
        return redirect()->action('AlternativaController@index', ['texto' => $alternativa->idEncuesta]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BienestarWeb\Alternativa  $alternativa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alternativa = Alternativa::findOrFail($id);
        $alternativa->delete();
        return redirect()->back();
    }
}
