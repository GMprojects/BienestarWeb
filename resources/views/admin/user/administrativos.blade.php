@extends('layouts.admin', ['titulo' => 'Administrativos', 'nombreTabla' => 'tabAdministrativos', 'item' => 'usuAdmin'])
@section('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Administrativos</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="user/create"><button class="btn btn-success">Nuevo Usuario</button></a>
				</div>
			</div>

		</div>

		<div class="box-body">
			<div class="table">
				<table id="tabAdministrativos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<th>Código</th>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Celular</th>
						<th>Email</th>
						<th>Funcion</th>
						<th>Foto</th>
						<th>Opciones</th>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{ $user->codigo }}</td>
							<td >{{$user->apellidoPaterno}} {{$user->apellidoMaterno}} {{$user->nombre}}</td>
							<td>{{$user->direccion}}</td>
							<td>{{$user->telefono}}</td>
							<td>{{$user->celular}}</td>
							<td>{{$user->email}}</td>
							@switch( $user->funcion)
								@case(3) <td><span class="badge bg-red">Administrador</span></td> @break
								@case(2) <td><span class="badge bg-orange">Programador</span></td> @break
								@case(1) <td><span class="badge bg-green">Miembro</span></td> @break
							@endswitch
							<td>
								<a href="{{URL::action('UserController@edit',$user->id)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('admin.user.modal')
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
