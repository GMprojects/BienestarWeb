@extends('template')
@section('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Lista de Categorías</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="tipoActividad/create"><button class="btn btn-ff-green"><i class="fa fa-plus "></i> Nueva Categoría</button></a>
				</div>
			</div>

		</div>

		<div class="box-body">
				<div class="table">
						<div class="table-responsive">
								<table id="tabTipoActividad" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">

										<thead>
											<th>Id</th>
											<th>Nombre Categoría</th>
											<th>Dirigido A</th>
											<th>Imagen</th>
											<th>Opciones</th>
										</thead>
										<tbody>
											@foreach($tiposActividad as $tipoActividad)
												<tr>
													<td>{{ $tipoActividad->idTipoActividad }}</td>
													<td>{{ $tipoActividad->tipo }}</td>
													<td>
														<ul>
															@if (strlen($tipoActividad->dirigidoA) == 1)
																@switch($tipoActividad->dirigidoA[0])
																	@case('1')
																		<li>Alumnos</li>
																	@break
																	@case('2')
																		<li>Docentes</li>
																	@break
																	@case('3')
																		<li>Administrativos</li>
																	@break
																@endswitch
															@elseif (strlen($tipoActividad->dirigidoA) == 2)
																@if ($tipoActividad->dirigidoA[0] == 1 && $tipoActividad->dirigidoA[1] == 2)
																	<li>Alumnos</li>
																	<li>Docentes</li>
																@elseif ($tipoActividad->dirigidoA[0] == 1 && $tipoActividad->dirigidoA[1] == 3)
																	<li>Alumnos</li>
																	<li>Administrativos</li>
																@else{{-- 2 y 3 --}}
																	<li>Docentes</li>
																	<li>Administrativos</li>
																@endif
															@else
																<li>Alumnos</li>
																<li>Docentes</li>
																<li>Administrativos</li>
															@endif
														</ul>
													</td>
													<td><img src="{{ asset('storage/'.$tipoActividad->rutaImagen) }}" width="100px" alt="No encontrada"></td>
													<td>
														<a href="{{ action('TipoActividadController@edit',$tipoActividad->idTipoActividad) }}" class="btn btn-ff-yellow"><i class="fa fa-edit"></i></a>
														<a href="" data-target = "#modal-delete-{{ $tipoActividad->idTipoActividad }}" data-toggle = "modal" class="btn btn-ff-red"><i class="fa fa-trash"></i></a>
													</td>
												</tr>
												@include('admin.tipoActividad.modal')
											@endforeach
										</tbody>

									</table>
							</div>
					</div>
			</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#tabTipoActividad').DataTable({
				//[10, 25, 50, -1], [10, 25, 50, "Todo"]
				"lengthMenu": [ [10, 15, 25, -1], [10, 25, 50, "Todo"]  ],
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
				  },
				  "order": [[1, "asc"]]
				}
			})
		});
	</script>

@endsection
