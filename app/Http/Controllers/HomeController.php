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

use BienestarWeb\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{
    /**
     * Create a new contaroller instance.
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
   public function index(Request $request){

      $actividades = Actividad::where([['modalidad', '=', '2'],['estado', '<', '3']])->get();
      return view('home')->with('actividades', $actividades);
      /*$user = User::find(854)->toArray();
        Mail::send('emails.mailEvent', $user, function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Mailgun Testing');
        });
        dd('Mail Send Successfully');*/
   }

}
