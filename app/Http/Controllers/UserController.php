<?php

namespace BienestarWeb\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use BienestarWeb\User;
use BienestarWeb\TipoPersona;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\TutorTutorado;
use BienestarWeb\Actividad;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;
use File;

class UserController extends Controller
{
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

   function getRutaImagenUpdate($request, $user){
          if($request->file('foto')){
             //dd("Hy foto nueva");
             //Eliminando Foto anterior
             $path = $user->foto;
             File::delete(storage_path('app/public/'.$path));
             Storage::delete($path);
             //Guardar la nueva imagen
             $file = $request->file('foto');
             $name = 'usr_'. $user->idTipoPersona .'_'. $request->apellidoPaterno.'_'. $request->apellidoMaterno.'_' . $request->codigo.'.'.$file->getClientOriginalExtension();
             $storage = Storage::disk('users')->put($name, \File::get($file));
             if($storage){
                return 'users/'.$name;
             }else{
                return $path;
             }
          }else {
              //dd("<NO></NO>Hy foto nueva");
              return $path;
          }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
   {
      $users = User::where('estado','1')->get();
      return view('admin.user.index')->with('users', $users);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      //Ydd($request);
       $request->validate([
           'nombre'=>'required|min:2|max:45',
           'apellidoPaterno' => 'required|min:2|max:20',
           'apellidoMaterno' => 'required|min:2|max:20',
           'codigo' => 'required|min:4|max:20|unique:user',
           'email' => 'required|max:100|unique:user',
           'direccion'=> 'max:100',
           'telefono' => 'max:15',
           'celular' => 'max:15',
           'foto' => 'file',
           'sexo' => 'required',
           'funcion' => 'required|numeric|min:1|max:3',
           'tipo' => 'required|numeric|min:1|max:3',
           //validacion si tipo = 1 (ALUMNO)
           'condicion' => 'required_if:tipo,1|numeric|min:1|max:3',
           //validacion si tipo = 2 (DOCENTE)
           'categoria' => 'numeric|min:1|max:4',
           'dedicacion' => 'numeric|min:1|max:3',
           'modalidad' => 'numeric|min:1|max:2',
           //validacion si tipo = 3 (ADMINISTRATIVO)
           'cargo' => 'max:50'
        ]);
        $file = $request->file('foto');
        $tipoUser = TipoPersona::find($request->tipo);

        $nuevoUser = new User();
        $nuevoUser->nombre = strtoupper($request->nombre);
        $nuevoUser->apellidoPaterno = strtoupper($request->apellidoPaterno);
        $nuevoUser->apellidoMaterno = strtoupper($request->apellidoMaterno);
        $nuevoUser->fechaNacimiento = UserController::getFecha($request->fechaNacimiento);
        $nuevoUser->sexo = $request->sexo;
        $nuevoUser->codigo = $request->codigo;
        $nuevoUser->email = $request->email;
        $nuevoUser->direccion = $request->direccion;
        $nuevoUser->telefono = $request->telefono;
        $nuevoUser->celular = $request->celular;
        $nuevoUser->funcion = $request->funcion;
        $nuevoUser->idTipoPersona = $request->tipo;
        $nuevoUser->password = bcrypt($request->codigo);
        $file = $request->file('foto');
        if($file != null){
           $name = 'usr_'. $tipoUser->tipo .'_'. $request->apellidoPaterno.'_'. $request->apellidoMaterno.'_' . $request->codigo.'.'.$file->getClientOriginalExtension();
           $storage = Storage::disk('users')->put($name, \File::get($file));
           if($storage){
             $path = 'users/'.$name;
             $nuevoUser->foto = $path;
          }
        }
        $nuevoUser->save();
        $user = User::where('codigo', $request->codigo)->get();
        switch ($request->tipo) {
           case '1': $nuevoAlumno = new Alumno();
                     $nuevoAlumno->condicion = $request->condicion;
                     $user[0]->alumno()->save($nuevoAlumno);
                     break;

           case '2': $nuevoDocente = new Docente();
                     $nuevoDocente->categoria = $request->categoria;
                     $nuevoDocente->dedicacion = $request->dedicacion;
                     $nuevoDocente->modalidad = $request->modalidad;
                     $user[0]->docente()->save($nuevoDocente);
                     break;

           case '3': $nuevoAdministrativo = new Administrativo();
                     $nuevoAdministrativo->cargo = $request->cargo;
                     $user[0]->administrativo()->save($nuevoAdministrativo);
                     break;
        }
        return Redirect::to('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user = User::findOrFail($id);
        switch ($user->idTipoPersona) {
           case '1': $alumno = Alumno::where('idUser', $id)->get();
                     return view('admin.user.edit')->with('user', $user)->with('tipoPersona', $alumno[0]);
           case '2': $docente = Docente::where('idUser', $id)->get();
                     return view('admin.user.edit')->with('user', $user)->with('tipoPersona', $docente[0]);
           case '3': $administrativo = administrativo::where('idUser', $id)->get();
                     return view('admin.user.edit')->with('user', $user)->with('tipoPersona', $administrativo[0]);
        }
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
      //dd($request);
         $user = User::findOrFail($id);
         if ($user->email == $request->email) {
             //dd('igual');
             $request->validate([
                 'nombre'=>'required|min:2|max:45',
                 'apellidoPaterno' => 'required|min:2|max:20',
                 'apellidoMaterno' => 'required|min:2|max:20',
                 'sexo' => 'required',
                 'direccion'=> 'max:100',
                 'telefono' => 'max:15',
                 'celular' => 'max:15'
             ]);
         } else {
             //dd('duff');
             $request->validate([
                 'nombre'=>'required|min:2|max:45',
                 'apellidoPaterno' => 'required|min:2|max:20',
                 'apellidoMaterno' => 'required|min:2|max:20',
                 'sexo' => 'required',
                 'email' => 'required|max:100|unique:user',
                 'direccion'=> 'max:100',
                 'telefono' => 'max:15',
                 'celular' => 'max:15'
             ]);
         }
        switch ($user->idTipoPersona)
        {
           case '1': $alumno = Alumno::findOrFail($user->idTipoPersona); break;
           case '2': $docente = Docente::findOrFail($user->idTipoPersona); break;
           case '3': $administrativo = Administrativo::findOrFail($user->idTipoPersona); break;
        }
        $user->nombre = strtoupper($request->nombre);
        $user->apellidoPaterno = strtoupper($request->apellidoPaterno);
        $user->apellidoMaterno = strtoupper($request->apellidoMaterno);
        $user->fechaNacimiento = UserController::getFecha($request->fechaNacimiento);
        $user->sexo = $request->sexo;
        $user->codigo = $request->codigo;
        $user->email = $request->email;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->celular = $request->celular;

        $tipoUser = TipoPersona::find($request->tipo);
        $user->foto = UserController::getRutaImagenUpdate($request, $user);
        //dd($user->foto);
        $user->funcion = $request->funcion;
      //dd($user);
        $user->update();

        /*switch ($request->tipo) {
           case '1': $alumno = $user->alumno()->get();
                     $alumno[0]->condicion = $request->condicion;
                     $alumno[0]->update();
                     break;

           case '2': $docente = $user->docente()->get();
                     $docente[0]->categoria = $request->categoria;
                     $docente[0]->dedicacion = $request->dedicacion;
                     $docente[0]->modalidad = $request->modalidad;
                     $docente[0]->update();
                     break;

           case '3': $administrativo = $user->administrativo()->get();
                     $administrativo[0]->cargo = $request->cargo;
                     $administrativo[0]->update();
                     break;
        }*/
        //return Redirect::to('admin/user');
        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$user = User::findOrFail($id);
        $user->estado = '0';
        $user->update();*/
        $user = User::findOrFail($id);
        $tieneRelaciones = true;
        if (count($user->docente) == 0) {
           $tieneRelaciones = false;
        }
        if (count($user->alumno) == 0) {
           $tieneRelaciones = false;
        }
        if (count($user->administrativo) == 0) {
           $tieneRelaciones = false;
        }
        if (count($user->actividadesProgramador) == 0) {
           $tieneRelaciones = false;
        }
        if (count($user->actividadesResponsable) == 0) {
           $tieneRelaciones = false;
        }

        if ($tieneRelaciones) {
           $user->estado = '0';
           $user->update();
        } else {
           $user->delete();
        }


        /*echo 'docente   '.count($user->docente);
        echo 'alumno   '.count($user->alumno);
        echo 'administrativo   '.count($user->administrativo);

        echo 'actividadesProgramador   '.count($user->actividadesProgramador);
        echo 'actividadesResponsable   '.count($user->actividadesResponsable);*/
dd('e');
        //return Redirect::to('admin/user');
    }

    public function asignarResponsable(Request $request)
    {
    }
    public function getUsers(Request $request){
    //    dd($request);
      if($request->ajax()){
        $users = User::get();
        return response()->json($users);
      }
    }
    public function getUsersAdm(Request $request){
    //    dd($request);
      if($request->ajax()){
        $users = User::select('id','nombre','apellidoPaterno','apellidoMaterno','codigo')
                    ->where('idTipoPersona','=', '2')
                    ->get();
        return response()->json($users);
      }
    }
    public function getUsersAdmDoc(Request $request){
    //    dd($request);
      if($request->ajax()){
        $users = User::select('id','nombre','apellidoPaterno','apellidoMaterno','codigo')
                    ->where('idTipoPersona','=', '1')
                    ->where('idTipoPersona','=', '2')
                    ->get();
        return response()->json($users);
      }
    }
    public function getAlumnos(Request $request){
    //    dd($request);
      if($request->ajax()){
        $users = Alumno::join('user','alumno.idUser', '=','user.id' )
                    ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                    ->get();
        return response()->json($users);
      }
    }
    public function indexAlumnos(){
        $alumnos = User::where([['idTipoPersona','1'], ['estado','1']])
                 ->get();
        return view('admin.user.alumnos')->with('alumnos', $alumnos);
    }
    public function indexDocentes(){
        $docentes = User::where([['idTipoPersona','2'], ['estado','1']])
                 ->get();
        return view('admin.user.docentes')->with('docentes', $docentes);
    }
    public function indexAdministrativos(){
        $administrativos = User::where([['idTipoPersona','3'],['estado','1']])
                 ->get();
        return view('admin.user.administrativos')->with('administrativos', $administrativos);
    }
}
