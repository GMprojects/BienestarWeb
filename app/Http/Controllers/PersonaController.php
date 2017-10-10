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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
   {
      $users = User::all();
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
    public function store(Request $request)
    {    $request->validate([
           'nombre'=>'required|min:2|max:45',
           'apellidoPaterno' => 'required|min:2|max:20',
           'apellidoMaterno' => 'required|min:2|max:20',
           'codigo' => 'required|min:4|max:20',
           'email' => 'required|max:100',
           'direccion'=> 'max:100',
           'telefono' => 'max:15|min:6',
           'celular' => 'max:15',
           'foto' => 'file',
           'funcion' => 'required|numeric|min:1|max:3',
           'tipo' => 'required|numeric|min:1|max:3',
           //validacion si tipo = 1 (ALUMNO)
           'condicion' => 'required_if:tipo,1|numeric|min:1|max:3',
           //validacion si tipo = 2 (DOCENTE)
           'categoria' => 'required_if:tipo,2|numeric|min:1|max:4',
           'dedicacion' => 'required_if:tipo,2|numeric|min:1|max:3',
           'modalidad' => 'required_if:tipo,2|numeric|min:1|max:2',
           //validacion si tipo = 3 (ADMINISTRATIVO)
           'cargo' => 'required_if:tipo,3|max:50'
        ]);
        $file = $request->file('foto');
        $tipoUser = TipoPersona::find($request->tipo);

        if($file != null){
           $name = 'usr_'. $tipoUser->tipo .'_'. $request->apellidoPaterno.'_'. $request->apellidoMaterno.'_' . $request->codigo.'.'.$file->getClientOriginalExtension();
           $path = public_path().'\\images\\Usuario\\'.$tipoUser->tipo;
           $file->move($path, $name);
           $nuevaUser->foto = $name;
        }
        $nuevaUser = new User();
        $nuevaUser->nombre = $request->nombre;
        $nuevaUser->apellidoPaterno = $request->apellidoPaterno;
        $nuevaUser->apellidoMaterno = $request->apellidoMaterno;
        $nuevaUser->codigo = $request->codigo;
        $nuevaUser->email = $request->email;
        $nuevaUser->direccion = $request->direccion;
        $nuevaUser->telefono = $request->telefono;
        $nuevaUser->celular = $request->celular;
        $nuevaUser->funcion = $request->funcion;
        $nuevaUser->estado = 1;
        $nuevaUser->idTipoPersona = $request->tipo;
        $nuevaUser->save();
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
           case '1': $alumno = Alumno::findOrFail($user->idTipoPersona);
                     return view('admin.user.edit')->with('user', $user)->with('tipoUser', $alumno);
           case '2': $docente = Docente::findOrFail($user->idTipoPersona);
                     return view('admin.user.edit')->with('user', $user)->with('tipoUser', $docente);
           case '3': $administrativo = administrativo::findOrFail($user->idTipoPersona);
                     return view('admin.user.edit')->with('user', $user)->with('tipoUser', $administrativo);
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
        $user = User::findOrFail($id);
        switch ($user->idTipoPersona)
        {
           case '1': $alumno = Alumno::findOrFail($user->idTipoPersona); break;
           case '2': $docente = Docente::findOrFail($user->idTipoPersona); break;
           case '3': $administrativo = administrativo::findOrFail($user->idTipoPersona); break;
        }
        $user->nombre = $request->nombre;
        $user->apellidoPaterno = $request->apellidoPaterno;
        $user->apellidoMaterno = $request->apellidoMaterno;
        $user->codigo = $request->codigo;
        $user->email = $request->email;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->celular = $request->celular;

        $tipoUser = TipoPersona::find($request->tipo);
        $file = $request->file('foto');
        if($file != null){
           $nuevoPath = public_path().'\\images\\Usuario\\'.$request->tipo;
           $nuevoName = 'usr_'. $request->tipo .'_'. $request->apellidoPaterno.'_'. $request->apellidoMaterno.'_' . $request->codigo.'.'.$file->getClientOriginalExtension();
           $file->move($nuevoPath, $nuevoName);
           $user->foto = $nuevoName;
        }
        $user->funcion = $request->funcion;
        $user->idTipoPersona = $request->tipo;
        $user->update();

        switch ($request->tipo) {
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
        }
        return Redirect::to('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $users = User::select('idUser','nombre','apellidoPaterno','apellidoMaterno','codigo')
                    ->where('idTipoPersona','=', '2')
                    ->get();
        return response()->json($users);
      }
    }
    public function getUsersAdmDoc(Request $request){
    //    dd($request);
      if($request->ajax()){
        $users = User::select('idUser','nombre','apellidoPaterno','apellidoMaterno','codigo')
                    ->where('idTipoPersona','=', '1')
                    ->where('idTipoPersona','=', '2')
                    ->get();
        return response()->json($users);
      }
    }
    public function getAlumnos(Request $request){
    //    dd($request);
      if($request->ajax()){
        $users = Alumno::join('user','alumno.idUser', '=','user.idUser' )
                    ->select('alumno.idAlumno','user.nombre','user.apellidoPaterno','user.apellidoMaterno','user.codigo')
                    ->get();
        return response()->json($users);
      }
    }
}
