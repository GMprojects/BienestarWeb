<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\ActPedagogia;
use BienestarWeb\DetallePedagogia;

class DetallePedagogiaController extends Controller{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(){
      //
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request, $idActPedagogia, $idTutorado){
        $alumno = Alumno::findOrFail($idTutorado);
        $actPedagogia = ActPedagogia::findOrFail($idActPedagogia);
        return view('programador.actividad.actTutoria.create',['tutorado' => $alumno->user, 'actPedagogia' => $actPedagogia]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request, $idActPedagogia){
        $actPedagogia = ActPedagogia::findOrFail($idActPedagogia);
        $detalle = new DetallePedagogia;
        $detalle->motivo = $request->motivo;
        $detalle->situacionEspecifica = $request->situacionEspecifica;
        $detalle->recomendacion = $request->recomendacion;
        $actPedagogia->detallesPedagogia()->save($detalle);
        return redirect()->back();
   }

   /**
    * Display the specified resource.
    *
    * @param  \BienestarWeb\DetallePedagogia  $detallePedagogia
    * @return \Illuminate\Http\Response
    */
   public function show(DetallePedagogia $detallePedagogia){
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \BienestarWeb\DetallePedagogia  $detallePedagogia
    * @return \Illuminate\Http\Response
    */
   public function edit(DetallePedagogia $detallePedagogia){
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \BienestarWeb\DetallePedagogia  $detallePedagogia
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id){
      $detalle = DetallePedagogia::findOrFail($id);
      $detalle->motivo = $request->motivo;
      $detalle->situacionEspecifica = $request->situacionEspecifica;
      $detalle->recomendacion = $request->recomendacion;
      $detalle->update();
      return redirect()->back();
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \BienestarWeb\DetallePedagogia  $detallePedagogia
    * @return \Illuminate\Http\Response
    */
   public function destroy($id){
      $detalle = DetallePedagogia::findOrFail($id);
      $detalle->delete();
      return redirect()->back();
   }
}
