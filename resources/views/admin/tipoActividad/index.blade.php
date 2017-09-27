@extends('layouts.admin', ['titulo' => 'Tipos de Actividades', 'nombreTabla' => '', 'item' => 'actiTipos'])
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Tipos de Actividades <a href="tipoActividad/create"><button class="btn btn-success">Nuevo Tipo</button></a></h3>
			@include('admin.tipoActividad.search')

		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Tipo Actividad</th>
						<th>Imagen</th>
						<th>Opciones</th>
					</thead>

					@foreach($tiposActividad as $tipoActividad)
						<tr>
							<td>{{ $tipoActividad->idTipoActividad }}</td>
							<td>{{ $tipoActividad->tipo }}</td>
							<td>{{ $tipoActividad->rutaImagen }}</td>
							<td>
								<a href="{{ action('TipoActividadController@edit',$tipoActividad->idTipoActividad) }}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target = "#modal-delete-{{ $tipoActividad->idTipoActividad }}" data-toggle = "modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('admin.tipoActividad.modal')
					@endforeach

				</table>
			</div>

			{{ $tiposActividad->render() }}

		</div>
	</div>
@endsection
