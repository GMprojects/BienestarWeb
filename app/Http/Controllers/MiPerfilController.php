<?php

namespace BienestarWeb\Http\Controllers;

use Illuminate\Http\Request;
use BienestarWeb\User;
use BienestarWeb\Actividad;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\TipoPersona;
use BienestarWeb\InscripcionAlumno;
use BienestarWeb\InscripcionDocente;
use BienestarWeb\InscripcionAdministrativo;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;
use Validator;


class MiPerfilController extends Controller{

   function getRutaImagenUpdate($request, $user){
      $path = $user->foto;
      if($request->file('foto')){
         //Eliminando Foto anterior
         File::delete(storage_path('app/public/'.$path));
         Storage::delete($path);
         //Guardar la nueva imagen
         $file = $request->file('foto');
         $name = 'usr_'.$user->idTipoPersona.'_'. $user->apellidoPaterno.'_'. $user->apellidoMaterno.'_' . $user->codigo.'.'.$file->getClientOriginalExtension();
         $storage = Storage::disk('users')->put($name, \File::get($file));
         if($storage){
           return 'users/'.$name;
         }else{
           return $user->foto;
         }
      }else {//no hay foto nueva
          return $path;
      }
   }

   function getFecha($fechaIn){
         if ($fechaIn != null) {
            $dia = substr( $fechaIn,0 ,2);
            $mes =substr( $fechaIn,3 ,2);
            $anio=substr( $fechaIn,-4 ,4);
            return $anio."-".$mes."-".$dia;
         } else {
            return null;
         }
   }

   public function show($id){
      $user = User::findOrFail($id);
      $du['user'] = $user;
         //SI SOY PROGRAMADOR(organizador) o ADMINISTRADOR
      if($user->funcion != 1){
        $progPendientes = Actividad::where([['idUserProg', $id ], ['estado', '1']])->count('idUserProg');
        $du['progPendientes'] = $progPendientes;
        $progEjecutadas = Actividad::where([['idUserProg', $id ], ['estado', '2']])->count('idUserProg');
        $du['progEjecutadas'] = $progEjecutadas;
        $progCanceladas = Actividad::where([['idUserProg', $id ], ['estado', '3']])->count('idUserProg');
        $du['progCanceladas'] = $progCanceladas;
        $progExpiradas = Actividad::where([['idUserProg', $id ], ['estado', '4']])->count('idUserProg');
        $du['progExpiradas'] = $progExpiradas;
      }
      //SI SOY RESPONSABLE
      $respPendientes = Actividad::where([['idUserResp', $id ], ['estado', '1']])->count('idUserResp');
      $du['respPendientes'] = $respPendientes;
      $respEjecutadas = Actividad::where([['idUserResp', $id ], ['estado', '2']])->count('idUserResp');
      $du['respEjecutadas'] = $respEjecutadas;
      //ACTIVIDADES INSCRITAS
      switch ($user->idTipoPersona) {
         case '1'://Alumno
            $idAlumno = Alumno::where('idUser', $id)->value('idAlumno');
            $inscInscripcion = InscripcionAlumno::where('idAlumno', $idAlumno)->count('idAlumno');
            $inscAsistencia = InscripcionAlumno::where('idAlumno', $idAlumno)->where('asistencia', '1')->count('idAlumno');
            break;
         case '2'://Docente
            $idDocente = Docente::where('idUser', $id)->pluck('idDocente');
            $inscInscripcion = InscripcionDocente::where('idDocente', $idDocente)->count('idDocente');
            $inscAsistencia = InscripcionDocente::where('idDocente', $idDocente)->where('asistencia', '1')->count('idDocente');
            break;
         case '3'://Administrativo
            $idAdministrativo = Administrativo::where('idUser', $id)->pluck('idAdministrativo');
            $inscInscripcion= InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->count('idAdministrativo');
            $inscAsistencia = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->where('asistencia', '1')->count('idAdministrativo');
            break;
      }
      $du['inscInscripcion'] = $inscInscripcion;
      $du['inscAsistencia'] = $inscAsistencia;
      return view('miembro.perfil.perfil')->with('du', $du);
   }
   public function edit(Request $request, $id){
      if($id == $request->user()->id){ //FUNCION DE middleware QUE NO PUDE IMPLEMENTAR EN UNMIDDLEWARE :(
         $user = User::findOrFail($request->user()->id);
         return view('miembro.perfil.edit')->with('user', $user);
      }else{
         return abort(401);
      }
   }
   public function update(Request $request, $id){
      $user = User::findOrFail($id);
         //Datos Personales
         $request->validate([
            'direccion'=> 'max:100',
            'telefono' => 'max:15',
            'celular' => 'max:15',
            'foto' => 'image|mimes:jpg,jpeg,png|max:4096'
         ]);
         $user->fechaNacimiento = MiPerfilController::getFecha($request->fechaNacimiento);
         $user->foto = MiPerfilController::getRutaImagenUpdate($request, $user);
         $user->direccion = $request->direccion;
         $user->telefono = $request->telefono;
         $user->celular = $request->celular;
         $user->update();

      return redirect()->back();
   }
   public function editPassword(Request $request, $id){
      $user = User::findOrFail($request->user()->id);
      return view('miembro.perfil.cambiarPassword')->with('user', $user);
   }
   public function updatePassword(Request $request){

      if(Hash::check($request->myPassword, Auth::user()->password)){
         $request->validate([
            'myPassword'=>'required',
            'password' => 'required|confirmed|min:6'
         ]);
         $user = User::where([['email', '=', Auth::user()->email]])->first();
         if($user != null){
            $user->password = bcrypt($request->password);
            $user->changed_pass = '1';
            $user->update();
            //return redirect()->back()->with('status','Contraseña Cambiada');
            return redirect()->action('MiPerfilController@show',['id' =>  Auth::user()->id])->with('status','Su contraseña ha sido cambiada satisfactoriamente');
         }
      }else{
            return redirect()->back()->with('message','Contraseña Incorrecta');
      }
   }
   public function misActInscrito($tipo, $id){
      $list_insc = array('hd');
      switch ($tipo) {
         case '1'://Alumno
            $idAlumno = Alumno::where('idUser', $id)->value('idAlumno');
            $inscripciones = InscripcionAlumno::where('idAlumno', $idAlumno)->pluck('idActividad');
            $actividades = Actividad::whereIn('idActividad', $inscripciones)->where('estado','<',5)->orderBy('fechaInicio', 'asc')->get();
            break;
         case '2'://Docente
            $idDocente = Docente::where('idUser', $id)->value('idDocente');
            $inscripciones = InscripcionDocente::where('idDocente', $idDocente)->pluck('idActividad');
            $actividades = Actividad::whereIn('idActividad', $inscripciones)->where('estado','<',5)->orderBy('fechaInicio', 'asc')->get();
            break;
         case '3'://Administrativo
            $idAdministrativo = Administrativo::where('idUser', $id)->value('idAdministrativo');
            $inscripciones = InscripcionAdministrativo::where('idAdministrativo', $idAdministrativo)->pluck('idActividad');
            $actividades = Actividad::whereIn('idActividad', $inscripciones)->where('estado','<',5)->orderBy('fechaInicio', 'asc')->get();
            break;
      }
      for ($i=0; $i < count($inscripciones) ; $i++) {
         array_push ( $list_insc,  $inscripciones[$i] );
      }
      return array($actividades, $list_insc);
   }
   public function misActResponsable($id){
      $actividades = Actividad::where([['idUserResp', $id],['estado','<',5]])->orderBy('fechaInicio', 'asc')->get();
      return $actividades;
   }
   public function misActProgramador($id){
      $actividades = Actividad::where([['idUserProg', $id],['estado','<',5]])->orderBy('fechaInicio', 'asc')->get();
      return $actividades;
   }
   public function mis_actividades(Request $request, $id){
      if($id == $request->user()->id){ //FUNCION DE middleware QUE NO PUDE IMPLEMENTAR EN UNMIDDLEWARE :(
         $aux = MiPerfilController::misActInscrito($request->user()->idTipoPersona, $request->user()->id);
         $list_insc = $aux[1];
         $mis_insc = $aux[0];
         $mis_resp = MiPerfilController::misActResponsable($request->user()->id);
         $mis_prog = MiPerfilController::misActProgramador($request->user()->id);
         $opcion = $request->opcion;
         return view('miembro.mis-actividades')->with('mis_insc', $mis_insc)->with('mis_resp', $mis_resp)->with('mis_prog', $mis_prog)->with('list_insc', $list_insc)->with('opcion', $opcion);
      }else{
         return abort(401);
      }
   }
}
