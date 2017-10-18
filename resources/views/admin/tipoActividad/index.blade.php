@extends('template')
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
				<table id="tabTipoActividad" class="table table-striped table-bordered table-condensed table-hover">
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

		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#tabTipoActividad').DataTable({
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
