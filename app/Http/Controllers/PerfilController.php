<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\Http\Controllers\Controller;

class PerfilController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
      if($request->id == Auth::user()->id){
         return view('miembro.perfil');
      }
   }
}
