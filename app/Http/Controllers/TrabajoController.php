<?php

namespace BienestarWeb\Http\Controllers;

use BienestarWeb\Trabajo;
use BienestarWeb\Egresado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Http\Controllers\Controller;

class TrabajoController extends Controller{

      function getFecha($fechaIn){
         if( $fechaIn == null ){
            return null;
         }else{
            $dia = substr( $fechaIn,0 ,2);
            $mes =substr( $fechaIn,3 ,2);
            $anio=substr( $fechaIn,-4 ,4);
            return $anio."-".$mes."-".$dia;
         }
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
         if ($request->op == 1) { //viene desde egresado
            $trabajos = Trabajo::where('idEgresado',$request->idEgresado)->get();
            $egresado = Egresado::findOrFail($request->idEgresado);
            return view('admin.trabajo.index')
                ->with('op',$request->op)
                ->with('trabajos',$trabajos)
                ->with('egresado', $egresado);
         } else {
             $op = 2;
             $trabajos = Trabajo::get();
             return view('admin.trabajo.index')
                ->with('op',$op)
                ->with('trabajos',$trabajos);
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
         if ($request->op == 1) { //viene desde egresado
            $egresado = Egresado::findOrFail($request->idEgresado);
            return view('admin.trabajo.create')
                  ->with('op',$request->op)
                  ->with('idEgresado', $request->idEgresado)
                  ->with('egresado', $egresado);
         } else {
            $op = 2;
            $egresados = Egresado::get();
            return view('admin.trabajo.create')
                  ->with('op',$op)
                  ->with('egresados',$egresados);
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'institucion' => 'required',
            'lugar' => 'required',
            'nivelSatisfaccion' => 'required',
            'fechaInicio' => 'required|date_format:"d/m/Y"',
            'fechaFin' => 'nullable|after:fechaInicio|date_format:"d/m/Y"'
        ]);
        $trabajo = new Trabajo;
        $trabajo->institucion = $request->get('institucion');
        $trabajo->lugar = $request->get('lugar');
        $trabajo->fechaInicio = TrabajoController::getFecha($request->fechaInicio);
        $trabajo->fechaFin =TrabajoController::getFecha($request->fechaFin);
        $trabajo->nivelSatisfaccion = $request->get('nivelSatisfaccion');
        $trabajo->recomendaciones = $request->get('recomendaciones');
        $trabajo->observaciones = $request->get('observaciones');

        $egresado = Egresado::findOrFail($request->idEgresado);
        $egresado->trabajos()->save($trabajo);
      //return Redirect::to('admin/preguntaEncuesta');
        if ($request->op == 2) {
           return redirect()->action('TrabajoController@index', ['op' => $request->op]);
       } else { //viene desde egresado
           return redirect()->action('TrabajoController@index', ['idEgresado' => $request->idEgresado, 'op' => $request->op]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
         if ($request->op == null) {
            abort(404);
         } else {
            return view('admin.trabajo.edit')
            ->with('trabajo',Trabajo::findOrFail($id))
            ->with('op', $request->op);
         }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $request->validate([
            'institucion' => 'required',
            'lugar' => 'required',
            'nivelSatisfaccion' => 'required',
            'fechaInicio' => 'required|date_format:"d/m/Y"',
            'fechaFin' => 'nullable|after:fechaInicio|date_format:"d/m/Y"'
        ]);
        $trabajo = Trabajo::findOrFail($id);
        $trabajo->institucion = $request->get('institucion');
        $trabajo->lugar = $request->get('lugar');
        $trabajo->fechaInicio = TrabajoController::getFecha($request->fechaInicio);
        $trabajo->fechaFin = TrabajoController::getFecha($request->fechaFin);
        $trabajo->nivelSatisfaccion = $request->get('nivelSatisfaccion');
        $trabajo->recomendaciones = $request->get('recomendaciones');
        $trabajo->observaciones = $request->get('observaciones');
        $trabajo->update();

        if ($request->op == 2) {
           return redirect()->action('TrabajoController@index', ['op' => $request->op]);
        } else { //viene desde egresado
           return redirect()->action('TrabajoController@index', ['idEgresado' => $trabajo->idEgresado, 'op' => $request->op]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $trabajo = Trabajo::findOrFail($id);
        $trabajo->delete();
        return redirect()->back();
    }
}
