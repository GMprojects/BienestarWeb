<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\Persona;
use BienestarWeb\Actividad;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
   {  $actividades = Actividad::where(['modalidad' => '2', 'estado' => '1'||'2'])->get();
      return view('home')->with('actividades', $actividades);
   }
}
