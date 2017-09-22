@extends('layouts.admin', ['titulo' => 'Egresados', 'nombreTabla' => '', 'item' => 'egreTodos'])
@section('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Todos los Egresados</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="egresado/create"><button class="btn btn-success">Nuevo Egresado</button></a>
				</div>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table id="tabEgresado" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<th>Id</th>
						<th>Codigo</th>
						<th>Apellidos</th>
						<th>Nombres</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Celular</th>
						<th>Correo</th>
						<th>Egreso</th>
						<th>Grado</th>
						<th>Opciones</th>
					</thead>

					@foreach($egresados as $egresado)
						<tr>
							<td>{{ $egresado->idEgresado }}</td>
							<td>{{ $egresado->codigo }}</td>
							<td>{{ $egresado->apellidoPaterno }} {{ $egresado->apellidoMaterno }}</td>
							<td>{{ $egresado->nombre }}</td>
							<td>{{ $egresado->direccion }}</td>
							<td>{{ $egresado->telefono }}</td>
							<td>{{ $egresado->celular }}</td>
							<td>{{ $egresado->email }}</td>
							<td>{{ $egresado->anioEgreso }} - {{ $egresado->numeroSemestre }}</td>
							@switch($egresado->grado)
								@case(1) <td><span class="badge bg-green">Bachiller</span></td> @break
								@case(2) <td><span class="badge bg-yellow">Magister</span></td> @break
								@case(3) <td><span class="badge bg-orange">Doctor</span></td> @break
								@case(4) <td><span class="badge bg-red">PhD</span></td> @break
							@endswitch
							<td>
								<a href="{{ action('TrabajoController@index',['idEgresado' => $egresado->idEgresado ]) }}"><button class="btn btn-info">Ver Trabajos</button></a>
								<a href="{{ action('EgresadoController@edit',$egresado->idEgresado) }}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target = "#modal-delete-{{ $egresado->idEgresado }}" data-toggle = "modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('admin.egresado.modal')
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
