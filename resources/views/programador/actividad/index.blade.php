@extends('template')
@section('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Lista de Actividades</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="actividad/create"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nueva Actividad</button></a>
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
														<th>Modalidad</th>
														<th>Cupos</th>
														<th>Semestre</th>
														<th>Fecha Inicio</th>
														<th>Hora Inicio</th>
														<th>Estado</th>
														<th>Fecha de Ejecución</th>
														<th>Hora de Ejecución</th>
														<th>Opciones</th>
										</thead>
										<tbody>
														@foreach($actividades as $actividad)
															<tr>
																<td>{{ $actividad->idActividad }}</td>
																<td>{{ $actividad->titulo }}</td>
																@switch($actividad->modalidad)
																	@case(1)
																		<td><small class="label ff-bg-aqua rounded">Individual</small></td>
																		@break
																	@case(2)
																		@if ($actividad->idTipoActividad == 9 || $actividad->idTipoActividad == 8)
																			<td><small class="label ff-bg-purple rounded">Libre</small></td>
																		@else
																			<td><small class="label ff-bg-green2 rounded">Grupal</small></td>
																		@endif
																		@break
																@endswitch
																@if ($actividad->idTipoActividad == 9 || $actividad->idTipoActividad == 8)
																	<td>Libre</td>
																@else
																	<td>{{ $actividad->cuposTotales }}</td>
																@endif
																<td>
																	{{ $actividad->anioSemestre }} -
																	@if ( $actividad->numeroSemestre == 1 )
																		I
																	@else
																		II
																	@endif
																</td>
																<td>{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}</td>
																<td>{{ date("g:i A",strtotime($actividad->horaInicio)) }}</td>

																@switch($actividad->estado)
																	@case(1)
																		<td><small class="label ff-bg-blue rounded">Pendiente</small></td>
																		<td>Pendiente</td>
																		<td>Pendiente</td>
																		@break
																	@case(2)
																		<td><small class="label ff-bg-green rounded">Ejecutada</small></td>
																		<td>{{ date("d/m/Y",strtotime($actividad->fechaEjecutada)) }}</td>
																		<td>{{ date("g:i A",strtotime($actividad->horaEjecutada)) }}</td>
																		@break
																	@case(3)
																		<td><small class="label ff-bg-red rounded">Cancelada</small></td>
																		<td>Cancelada</td>
																		<td>Cancelada</td>
																		@break
																	@case(4)
																		<td><small class="label ff-bg-orange rounded">Expirada</small></td>
																		<td>Expirada</td>
																		<td>Expirada</td>
																		@break
																@endswitch
																<td>
																	<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"  data-toggle="tooltip" data-placement="bottom" title="Editar o Habilitar Actividad"></i></button></a>
																	<a href="{{ action('ActividadController@execute',$actividad->idActividad) }}">
																		<button class="btn btn-ff-greenOs" data-toggle="tooltip" data-placement="bottom" title="Ejecutar Actividad">
																			<span>
						                                         <i class="fa fa-child"><i class="fa fa-cogs"></i></i>
						                                       </span>
																		</button>
																	</a>
																	<a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Cancelar Actividad"><i class="fa fa-remove"></i></button></a>
																	<!--Solo si la actividad est cancelada se puede habilitar-->
																	{{--<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-warning">Habilitar</button></a>
																	<a href="{{ action('ActividadController@show',$actividad->idActividad)}}"><button class="btn btn-info">Ver Más </button></a>--}}
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
