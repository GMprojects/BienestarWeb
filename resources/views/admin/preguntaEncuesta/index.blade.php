@extends('template')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>
			Preguntas de Encuesta
			<a href="{{ action('PreguntaEncuestaController@create',['idEncuesta' => $idEncuesta ])}}"><button class="btn btn-success">Nuevo </button></a>
		</h3>
		@include('admin.preguntaEncuesta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tabPreguntaEncuesta" class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Enunciado</th>
					<th>Opciones</th>
				</thead>
				@foreach($preguntasEncuesta as $preguntaEncuesta)
				<tr>
					<td>{{$preguntaEncuesta->idPreguntaEncuesta}}</td>
					<td>{{$preguntaEncuesta->enunciado}}</td>
					<td>
						<a href="{{URL::action('PreguntaEncuestaController@edit',$preguntaEncuesta->idPreguntaEncuesta)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$preguntaEncuesta->idPreguntaEncuesta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.preguntaEncuesta.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#tabPreguntaEncuesta').DataTable({
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
