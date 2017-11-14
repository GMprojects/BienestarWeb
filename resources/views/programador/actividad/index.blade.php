@extends('template')
@section('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Lista de Actividades</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="actividad/create"><button class="btn btn-success">Nueva Actividad</button></a>
				</div>
			</div>

		</div>

		<div class="box-body">
				<div class="table">
						<div class="table-responsive">
								<table id="tabActividades" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
														<th>Id</th>
														<th>Título</th>
														<th>Fecha Inicio</th>
														<th>Hora Inicio</th>
														<th>Fecha Fin</th>
														<th>Hora Fin</th>
														<th>Fecha de Ejecución</th>
														<th>Hora de Ejecución</th>
														<th>Cupos</th>
														<th>Estado</th>
														<th>Semestre</th>
														<th>Modalidad</th>
														<th>Opciones</th>
										</thead>
										<tbody>
														@foreach($actividades as $actividad)
															<tr>
																<td>{{ $actividad->idActividad }}</td>
																<td>{{ $actividad->titulo }}</td>
																<td>{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}</td>
																<td>{{ date("g:i A",strtotime($actividad->horaInicio)) }}</td>
																<td>{{ date("d/m/Y",strtotime($actividad->fechaFin)) }}</td>
																<td>{{ date("g:i A",strtotime($actividad->horaFin)) }}</td>
																<td>{{ $actividad->fechaEjecutada }}</td>
																<td>{{ $actividad->horaEjecutada }}</td>
																@if ($actividad->cuposTotales == 0)
																	<td>Libre</td>
																@else
																	<td>{{ $actividad->cuposTotales }}</td>
																@endif
																@switch($actividad->estado)
																	@case(1)
																		<td><small class="label pull-right bg-yellow">Inicio</small></td>
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
																<td>
																	{{ $actividad->anioSemestre }} -
																	@if ( $actividad->numeroSemestre == 1 )
																		I
																	@else
																		II
																	@endif
																</td>
																@switch($actividad->modalidad)
																	@case(1)
																		<td><small class="label pull-right bg-aqua">Individual</small></td>
																		@break
																	@case(2)
																		<td><small class="label pull-right bg-purple">Grupal</small></td>
																		@break
																@endswitch
																<td>
																			<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-warning">Editar</button></a>
																			<a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-danger">ELiminar</button></a>
																			<a href="{{ action('ActividadController@execute',$actividad->idActividad) }}"><button class="btn btn-success">Ejecutar</button></a>
																			<!--Solo si la actividad est cancelada se puede habilitar-->
																			<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-warning">Habilitar</button></a>
																			<a href="{{ action('ActividadController@show',$actividad->idActividad)}}"><button class="btn btn-info">Ver Más </button></a>
																</td>
															</tr>
															@include('programador.actividad.modal')
														@endforeach
									</tbody>
								</table>
				  	</div>
				</div>
		</div>
</div>

<script>
	$(document).ready(function() {
		$('#tabActividades').DataTable({
			"lengthMenu": [ 10, 25, 50, 75, 100 ],
			"oLanguage" : {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Reg. actuales: _START_ - _END_ / Reg. totales: _TOTAL_",
				"sInfoEmpty":      "Reg. actuales: 0 - 0 / Reg. totales: 0",
				"sInfoFiltered":   "(filtrado de un total _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				  "sFirst":    "Primero",
				  "sLast":     "Último",
				  "sNext":     "Sig",
				  "sPrevious": "Ant"
				},
				"oAria": {
				  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		})
	});
</script>
@endsection
