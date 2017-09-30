@extends('layouts.admin', ['titulo' => 'Programar Actividad', 'nombreTabla' => 'tabActividad', 'item' => 'actiTodas'])
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de Actividades <a href="actividad/create"><button class="btn btn-success">Nueva Actividad</button></a></h3>
			@include('programador.actividad.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table id='tabActividad' class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Título</th>
						<th>Fecha de Programación</th>
						<th>Hora de Programación</th>
						<th>Fecha de Ejecución</th>
						<th>Hora de Ejecución</th>
						<th>Cupos Totales</th>
						<th>Estado</th>
						<th>Semestre</th>
						<th>Modalidad</th>
						<th>Opciones</th>
					</thead>

					@foreach($actividades as $actividad)
						<tr>
							<td>{{ $actividad->idActividad }}</td>
							<td>{{ $actividad->titulo }}</td>
							<td>{{ $actividad->fechaProgramacion }}</td>
							<td>{{ $actividad->horaProgramacion }}</td>
							<td>{{ $actividad->fechaEjecutada }}</td>
							<td>{{ $actividad->horaEjecutada }}</td>
							@if ($actividad->cuposTotales == 0)
								<td>Libre</td>
							@else
								<td>{{ $actividad->cuposTotales }}</td>
							@endif
							@switch($actividad->estado)
								@case(1)
									<td><small class="label pull-right bg-yellow">Programada</small></td>
									@break
								@case(2)
									<td><small class="label pull-right bg-green">Ejecutada</small></td>
									@break
								@case(3)
									<td><small class="label pull-right bg-orange">Cancelada</small></td>
									@break
								@case(4)
									<td><small class="label pull-right bg-red">No Ejecutada</small></td>
									@break
							@endswitch
							<td>{{ $actividad->anioSemestre }} - {{ $actividad->numeroSemestre }}</td>
							@switch($actividad->modalidad)
								@case(1)
									<td><small class="label pull-right bg-aqua">Individual</small></td>
									@break
								@case(2)
									<td><small class="label pull-right bg-purple">Grupal</small></td>
									@break
							@endswitch
							<td>
									@if($idPersonaProgramador != null)
										<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-warning">Editar</button></a>
										<a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-danger">Cancelar</button></a>
						      @elseif($idPersonaResponsable != null)
										<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-success">Ejecutar</button></a>
									@elseif($idPersonaInscrito != null)
										<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-warning">Ver</button></a>
						      @elseif($estadoCancelado != null)
										<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-warning">Habilitar</button></a>
										<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-danger">Eliminar</button></a>
						      @else
										<a href="{{ action('ActividadController@show',$actividad->idActividad)}}"><button class="btn btn-info">Ver Más </button></a>
										<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-warning">Editar</button></a>
										<a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-danger">Cancelar</button></a>
						      @endif
							</td>
						</tr>
						@include('programador.actividad.modal')
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection
