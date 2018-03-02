<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\Actividad;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;

use BienestarWeb\EncuestaRespondida;
use BienestarWeb\RptaEncuesta;
use BienestarWeb\Alternativa;
use DB;

use BienestarWeb\User;

use Carbon\Carbon;
use Log;
use BienestarWeb\Mail\MailVerificacion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailer;
use BienestarWeb\RecomendacionTutor;
class HomeController extends Controller{
    /**
     * Create a new contaroller instance.
     *
     * @return void
     */
    public function __construct(){
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request){
      /*Mail::to('mfernanda.mgl95@gmail.com')
           ->send(new MailVerificacion('Mafer','mfernanda.mgl95@gmail.com', 'dddddddddsdsfsd', 'M'));*/
      //return Redirect::to('admin/user');
      //dd('rere');
      $fechaActual = (Carbon::now())->format('Y-m-d');
      $actividades = Actividad::where([['modalidad', '=', '2'],['estado', '=', '1'],['fechaInicio','>=', $fechaActual]])->orderBy('fechaInicio', 'asc')->get();
      return view('home')->with('actividades', $actividades);

      /*dd(strlen('YSajS818LmT4HOvfrDywW6rPPjWyS0gBdbVFdCIPDuNPhuAtIWA9O26UMDxH'));
      for ($i=0; $i < 100; $i++) {
         $code[$i] = str_random(30);
      }
      //dd($code);
      return view('home',['code' => $code]);*/
   }

}
