@extends('template')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Tipos de Hábito <a href="tipoHabito/create"><button class="btn btn-success">Nuevo </button></a></h3>
		@include('admin.tipoHabito.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tabHabito" class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</thead>
				@foreach($tiposHabito as $tipoHabito)
				<tr>
					<td>{{$tipoHabito->idTipoHabito}}</td>
					<td>{{$tipoHabito->tipo}}</td>
					<td>
						<a href="{{URL::action('TipoHabitoController@edit',$tipoHabito->idTipoHabito)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$tipoHabito->idTipoHabito}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.tipoHabito.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#tabTipoHabito').DataTable({
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
