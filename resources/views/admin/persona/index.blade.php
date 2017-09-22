@extends('layouts.admin', ['titulo' => 'Usuarios', 'nombreTabla' => 'tabPersonas', 'item' => 'usuTodos'])
@section('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Todos los Usuarios</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="persona/create"><button class="btn btn-success">Nuevo Usuario</button></a>
				</div>
			</div>

		</div>

		<div class="box-body">
			<div class="table">
				<table id="tabPersonas" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Celular</th>
						<th>Email</th>
						<th>Funcion</th>
						<th>Tipo</th>
						<th>Foto</th>
						<th>Opciones</th>
					</thead>
					<tbody>
						@foreach ($personas as $persona)
						<tr>
							<td >{{$persona->apellidoPaterno}} {{$persona->apellidoMaterno}} {{$persona->nombre}}</td>
							<td>{{$persona->direccion}}</td>
							<td>{{$persona->telefono}}</td>
							<td>{{$persona->celular}}</td>
							<td>{{$persona->email}}</td>
							@switch( $persona->funcion)
								@case(3) <td><span class="badge bg-red">Administrador</span></td> @break
								@case(2) <td><span class="badge bg-orange">Programador</span></td> @break
								@case(1) <td><span class="badge bg-green">Miembro</span></td> @break
							@endswitch
							@switch( $persona->idTipoPersona)
								@case(1) <td><span class="badge bg-green">Alumno</span></td>
											<td>
												<img src="{{asset('images/Usuario/Alumno/'.$persona->foto)}}" alt="{{$persona->nombre}}" height="100px" width="100px" class="img-thumbnail">
											</td>
											@break
								@case(2) <td><span class="badge bg-orange">Docente</span></td>
											<td>
												<img src="{{asset('images/Usuario/Docente/'.$persona->foto)}}" alt="{{$persona->nombre}}" height="100px" width="100px" class="img-thumbnail">
											</td>
											@break
								@case(3) <td><span class="badge bg-red">Administrativo</span></td>
											<td>
												<img src="{{asset('images/Usuario/Administrativo/'.$persona->foto)}}" alt="{{$persona->nombre}}" height="100px" width="100px" class="img-thumbnail">
											</td>
											@break
							@endswitch
							<td>
								<a href="{{URL::action('PersonaController@edit',$persona->idPersona)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$persona->idPersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('admin.persona.modal')
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
