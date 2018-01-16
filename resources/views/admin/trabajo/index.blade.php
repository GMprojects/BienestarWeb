@extends('template')
@section ('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Trabajos</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					@if ($op == 1)
						<a href="{{ action('TrabajoController@create',['op' => $op, 'idEgresado' => $egresado->idEgresado ]) }}"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nuevo Trabajo</button></a>
					@else
						<a href="{{ action('TrabajoController@create',['op' => $op ]) }}"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nuevo Trabajo</button></a>
					@endif
				</div>
			</div>
		</div>

		<div class="box-body">
			@if ($op == 1)
				<label><i class="fa fa-graduation-cap"></i><b>Egresado: </b></label> <b style="color:#4B367C">  &nbsp; &nbsp; {{ $egresado->nombre.' '.$egresado->apellidoPaterno.' '.$egresado->apellidoMaterno }}</b>&nbsp; &nbsp;
				<br><br>
			@endif
			<div class="table">
				<div class="table-responsive">
					<table id="tabTrabajos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<th>Id</th>
								@if ($op == 2)
									<th>Egresado</th>
								@endif
								<th>Institución</th>
								<th>Lugar</th>
								<th>Inicio</th>
								<th>Fin</th>
								<th>Nivel Satisfacción</th>
								<th>Recomendaciones</th>
								<th>Observaciones</th>
								<th>Opciones</th>
							</thead>
							@php($i = 0)
							@foreach($trabajos as $trabajo)
								@php($i++)
								<tr>
									<td>{{ $i }}</td>
									@if ($op == 2)
										<td>{{ $trabajo->egresado->nombre.' '.$trabajo->egresado->apellidoPaterno.' '.$trabajo->egresado->apellidoMaterno }}</td>
									@endif
									<td>{{ $trabajo->institucion }}</td>
									<td>{{ $trabajo->lugar }}</td>
									<td>{{ date("d/m/Y",strtotime($trabajo->fechaInicio)) }}</td>
									<td>
										@if ($trabajo->fechaFin != null)
											{{ date("d/m/Y",strtotime($trabajo->fechaFin)) }}
										@else
											Hasta la actualidad
										@endif
									</td>
									<td>
										@switch($trabajo->nivelSatisfaccion)
											@case(1)
											Muy Satisfactorio
											@break
											@case(2)
											Satisfactorio
											@break
											@case(3)Poco Satisfactorio
											@break
											@case(4)Mejorable
											@break
											@case(5)
											Insatisfactorio
											@break
										@endswitch
									</td>
									<td>{{ $trabajo->recomendaciones }}</td>
									<td>{{ $trabajo->observaciones }}</td>
									<td>
										{{--@if ($idEgresado == null)
											<a href="{{URL::action('EgresadoController@show',$trabajo->idEgresado) }}"><button class="btn btn-info">Ver Egresado</button></a>
										@else--}}
										<a href="{{ action('TrabajoController@edit',['idTrabajo' => $trabajo->idTrabajo, 'op' => $op] ) }}"><button class="btn btn-ff-yellow" data-toggle="tooltip" data-placement="bottom" title="Editar trabajo"><i class="fa fa-edit"></i></button></a>
										<a href="" data-target = "#modal-delete-{{ $trabajo->idTrabajo }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar trabajo"><i class="fa fa-trash"></i></button></a>
										{{--@endif--}}
									</td>
								</tr>
								@include('admin.trabajo.modal')
							@endforeach
					</table>
				</div>
			</div>
		</div>
</div>

<script>
	$(document).ready(function() {
		$('#tabTrabajos').DataTable({
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
