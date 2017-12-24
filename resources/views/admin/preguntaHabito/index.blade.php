@extends('template')
@section ('contenido')
<div class="box box-info">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Preguntas de Encuesta de Hábitos de Estudio</h3>
			</div>
			<div class="col-xs-6" style="text-align:right;">
				{{--<a href="preguntaHabito/create"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nueva Pregunta</button></a>--}}
			</div>
		</div>
	</div>

	<div class="box-body">
			<div class="table">
					<div class="table-responsive">
							<table id="tabPreguntaHabito" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
							<!--<table id="tabPreguntaHabito" class="table table-striped table-bordered table-consdensed table-hover">-->
								<thead>
									<th>Id</th>
									<th>Enunciado</th>
									<th>Tipo de Hábito</th>
									<th>Opciones</th>
								</thead>
								@foreach($preguntasHabito as $preguntaHabito)
									<tr>
										<td>{{$preguntaHabito->idPreguntaHabito}}</td>
										<td>{{$preguntaHabito->enunciado}}</td>
										<td>{{$preguntaHabito->tipoHabito['tipo']}}</td>
										<td>
											<a href="{{URL::action('PreguntaHabitoController@edit',$preguntaHabito->idPreguntaHabito)}}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"></i></button></a>
											<a href="" data-target="#modal-delete-{{$preguntaHabito->idPreguntaHabito}}" data-toggle="modal"><button class="btn btn-ff-red"><i class="fa fa-trash"></i></button></a>
										</td>
									</tr>
									@include('admin.preguntaHabito.modal')
								@endforeach
						</table>
				</div>
		   </div>
    </div>
</div>

<script>
	$(document).ready(function() {
		$('#tabPreguntaHabito').DataTable({
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
