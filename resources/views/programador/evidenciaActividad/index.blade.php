@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Evidencia de la Actividad {{ $idActividad  }}
				<a href="{{ action('EvidenciaActividadController@create',['idActividad' => $idActividad ])}}">
					<button class="btn btn-success">Nuevo </button>
				</a>
			</h3>
			@include('programador.evidenciaActividad.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Ruta</th>
						<th>Opciones</th>
					</thead>
					@foreach($evidenciasActividad as $evidenciaActividad)
					<tr>
						<td>{{ $evidenciaActividad->idEvidenciaActividad }}</td>
						<td>{{ $evidenciaActividad->ruta }}</td>
						<td>----</td>
					</tr>
						@include('programador.evidenciaActividad.modal')
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection
