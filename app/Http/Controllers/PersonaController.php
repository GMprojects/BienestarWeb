<?php

namespace BienestarWeb\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use BienestarWeb\Persona;
use BienestarWeb\TipoPersona;
use BienestarWeb\Alumno;
use BienestarWeb\Docente;
use BienestarWeb\Administrativo;
use BienestarWeb\User;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
   {
      $personas = Persona::all();
      return view('admin.persona.index')->with('personas', $personas);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    return view('admin.persona.create');
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
           'telefono' => 'max:15',
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
        //REGISTRO DE usuario
        $usuario = new User();
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->codigo);


        $file = $request->file('foto');
        $tipoPersona = TipoPersona::find($request->tipo);
        $nuevaPersona = new Persona();
        if($file != null){
           $name = 'usr_'.$tipoPersona->tipo.'_'. $request->apellidoPaterno.'_'. $request->apellidoMaterno.'_' . $request->codigo.'.'.$file->getClientOriginalExtension();
           $path = public_path().'\\images\\Usuario\\'.$tipoPersona->tipo;
           $file->move($path, $name);
           $nuevaPersona->foto = $name;
        }
        $nuevaPersona->nombre = $request->nombre;
        $nuevaPersona->apellidoPaterno = $request->apellidoPaterno;
        $nuevaPersona->apellidoMaterno = $request->apellidoMaterno;
        $nuevaPersona->codigo = $request->codigo;
        $nuevaPersona->email = $request->email;
        $nuevaPersona->direccion = $request->direccion;
        $nuevaPersona->telefono = $request->telefono;
        $nuevaPersona->celular = $request->celular;
        $nuevaPersona->funcion = $request->funcion;
        $nuevaPersona->estado = 1;
        $nuevaPersona->idTipoPersona = $request->tipo;
        $usuario->save();
        $nuevaPersona->save();
        $persona = Persona::where('codigo', $request->codigo)->get();
        switch ($request->tipo) {
           case '1': $nuevoAlumno = new Alumno();
                     $nuevoAlumno->condicion = $request->condicion;
                     $persona[0]->alumno()->save($nuevoAlumno);
                     break;

           case '2': $nuevoDocente = new Docente();
                     $nuevoDocente->categoria = $request->categoria;
                     $nuevoDocente->dedicacion = $request->dedicacion;
                     $nuevoDocente->modalidad = $request->modalidad;
                     $persona[0]->docente()->save($nuevoDocente);
                     break;

           case '3': $nuevoAdministrativo = new Administrativo();
                     $nuevoAdministrativo->cargo = $request->cargo;
                     $persona[0]->administrativo()->save($nuevoAdministrativo);
                     break;
        }


        return Redirect::to('admin/persona');
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
    {   $persona = Persona::findOrFail($id);
      switch ($persona->idTipoPersona) {
           case '1': $tipoPersona = $persona->alumno()->get(); break;
           case '2': $tipoPersona = $persona->docente()->get(); break;
           case '3': $tipoPersona = $persona->docente()->get(); break;
        }
        if(sizeof($tipoPersona)>0){
           return view('admin.persona.edit')->with('persona', $persona)->with('tipoPersona', $tipoPersona[0]);
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
    {   $persona = Persona::findOrFail($id);
        $persona->nombre = $request->nombre;
        $persona->apellidoPaterno = $request->apellidoPaterno;
        $persona->apellidoMaterno = $request->apellidoMaterno;
        $persona->codigo = $request->codigo;
        $persona->email = $request->email;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->celular = $request->celular;

        $tipoPersona = TipoPersona::find($request->tipo);
        $file = $request->file('foto');
        if($file != null){
           $nuevoPath = public_path().'\\images\\Usuario\\'.$request->tipo;
           $nuevoName = 'usr_'. $request->tipo .'_'. $request->apellidoPaterno.'_'. $request->apellidoMaterno.'_' . $request->codigo.'.'.$file->getClientOriginalExtension();
           $file->move($nuevoPath, $nuevoName);
           $persona->foto = $nuevoName;
        }else {
           //$persona->foto = null;
        }
        $persona->funcion = $request->funcion;
        $persona->idTipoPersona = $request->tipo;
        $persona->update();

        switch ($persona->tipo) {
           case '1': $alumno = $persona->alumno()->get();
                     $alumno[0]->condicion = $request->condicion;
                     $alumno[0]->update();
                     break;

           case '2': $docente = $persona->docente()->get();
                     $docente[0]->categoria = $request->categoria;
                     $docente[0]->dedicacion = $request->dedicacion;
                     $docente[0]->modalidad = $request->modalidad;
                     $docente[0]->update();
                     break;

           case '3': $administrativo = $persona->administrativo()->get();
                     $administrativo[0]->cargo = $request->cargo;
                     $administrativo[0]->update();
                     break;
        }
        return Redirect::to('admin/persona');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::findOrFail($id);
        $persona->estado = 0;
        return Redirect::to('admin/persona');
     }
}
