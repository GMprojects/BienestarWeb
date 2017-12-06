@extends('template')
@section('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Todos los Egresados</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="egresado/create"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nuevo Egresado</button></a>
				</div>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<table id="tabEgresados" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
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
								<a href="{{ action('TrabajoController@index',['idEgresado' => $egresado->idEgresado, 'op' => '1'  ]) }}">
									<button class="btn btn-ff-greenOs">
										<span>
										  <i class="fa fa-eye"><i class="fa fa-briefcase"></i></i>
										</span>
									</button>
								</a>
								<a href="{{ action('EgresadoController@edit',$egresado->idEgresado) }}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"></i></button></a>
								<a href="" data-target = "#modal-delete-{{ $egresado->idEgresado }}" data-toggle = "modal"><button class="btn btn-ff-red"><i class="fa fa-remove"></i></button></a>
							</td>
						</tr>
						@include('admin.egresado.modal')
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#tabEgresados').DataTable({
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
