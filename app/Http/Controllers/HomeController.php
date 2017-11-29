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
      $list_insc = array('hd');
      if($request->user() != null){
         switch ($request->user()->idTipoPersona) {
            case '1'://Alumno
              $idAlumno = Alumno::where('idUser', $request->user()->id)->value('idAlumno');
              $inscripciones = InscripcionAlumno::where('idAlumno', $idAlumno)->get();
              break;
            case '2'://Docente
               $idDocente = Docente::where('idUser', $request->user()->id)->pluck('idDocente');
               $inscripciones = InscripcionDocente::where('idDocente', $idDocente)->get();
               break;
            case '3'://Administrativo
               $idAdministrativo = Administrativo::where('idUser', $request->user()->id)->pluck('idAdministrativo');
               $inscripciones = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->get();
               break;
         }

         for ($i=0; $i < count($inscripciones) ; $i++) {
            array_push ( $list_insc,  $inscripciones[$i]->idActividad );
         }
      }
      return view('home')->with('actividades', $actividades)->with('list_insc', $list_insc);
   }

}
