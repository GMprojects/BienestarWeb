@extends ('template')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>
			Trabajos
			<a href="{{ action('TrabajoController@create',['idEgresado' => $idEgresado ])}}"><button class="btn btn-success">Nuevo </button></a>
		</h3>
		@include('admin.trabajo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Institución</th>
					<th>Lugar</th>
					<th>Inicio</th>
					<th>Fin</th>
					<th>Nivel Satisfacción</th>
					<th>Recomendaciones</th>
					<th>Observaciones</th>
					<th>Opciones</th>
				</thead>

				@foreach($trabajos as $trabajo)
					<tr>
						<td>{{ $trabajo->idTrabajo }}</td>
						<td>{{ $trabajo->institucion }}</td>
						<td>{{ $trabajo->lugar }}</td>
						<td>{{ $trabajo->fechaInicio }}</td>
						<td>{{ $trabajo->fechaFin }}</td>
						<td>{{ $trabajo->nivelSatisfaccion }}</td>
						<td>{{ $trabajo->recomendaciones }}</td>
						<td>{{ $trabajo->observaciones }}</td>
						<td>
							<a href="{{ action('EgresadoController@index',['texto' => $trabajo->idEgresado ]) }}"><button class="btn btn-info">Ver Egresado</button></a>
							<a href="{{URL::action('TrabajoController@edit',$trabajo->idTrabajo)}}"><button class="btn btn-warning">Editar</button></a>
							<a href="" data-target = "#modal-delete-{{ $trabajo->idTrabajo }}" data-toggle = "modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('admin.trabajo.modal')
				@endforeach

			</table>
		</div>
	</div>
</div>
@endsection
