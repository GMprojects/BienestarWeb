@extends('template')
@section ('contenido')
<div class="box box-info">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Encuestas</h3>
			</div>
			<div class="col-xs-6" style="text-align:right;">
				<a type="button" href="{{ action('EncuestaController@create') }}" class="btn btn-ff-green pull-right" style="margin-top:4px;">
					<i class="fa fa-plus "></i>Nueva Encuesta
				</a>
			</div>
		</div>
	</div>
	<div class="box-body">
			<div class="table">
					<div class="table-responsive">
							<table id="tabEncuestas" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<th>Id</th>
									<th>Título</th>
									<th>Tipo Actividad</th>
									<th>Dirigido A</th>
									<th>Opciones</th>
								</thead>
								@foreach($encuestas as $encuesta)
									<tr>
										<td>{{$encuesta->idEncuesta}}</td>
										<td>{{$encuesta->titulo}}</td>
										<td>{{$encuesta->tipoActividad['tipo']}}</td>
										@if($encuesta->destino === 'r')
											<td>Responsable</td>
										@else
											<td>Inscrito</td>
										@endif
										<td>
											{{--
											<a href="{{URL::action('EncuestaController@edit',$encuesta->idEncuesta)}}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"></i></button></a>
											<a href="" data-target="#modal-delete-{{$encuesta->idEncuesta}}" data-toggle="modal"><button class="btn btn-ff-red"><i class="fa fa-remove"></i></button></a>
											--}}
											<a href="{{URL::action('EncuestaController@show',$encuesta->idEncuesta)}}"><button class="btn btn-ff-blues"><i class="fa fa-eye"></i></button></a>
										</td>
									</tr>
									@include('admin.encuesta.modal')
								@endforeach
							</table>
					</div>
			</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#tabEncuestas').DataTable({
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
