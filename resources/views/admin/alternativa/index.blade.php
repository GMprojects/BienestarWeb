@extends('template')
@section ('contenido')
	<div class="box box-info">
		<div class="box-header">
			<div class="row">
				<div class="col-xs-6">
					<h3 class="box-title">Alternativas</h3>
				</div>
				<div class="col-xs-6" style="text-align:right;">
					<a href="{{ action('AlternativaController@create',['idEncuesta' => $idEncuesta ])}}"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nueva Alternativa</button></a>
				</div>
			</div>
		</div>

		<div class="box-body">
				<div class="table">
						<div class="table-responsive">
								<table id="tabAlternativas" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<th>Id</th>
										<th>Etiqueta</th>
										<th>Opciones</th>
									</thead>
									@foreach($alternativas as $alternativa)
										<tr>
											<td>{{$alternativa->idAlternativa}}</td>
											<td>{{$alternativa->etiqueta}}</td>
											<td>
												<a href="{{URL::action('AlternativaController@edit',$alternativa->idAlternativa)}}"><button class="btn btn-info">Editar</button></a>
												<a href="" data-target="#modal-delete-{{$alternativa->idAlternativa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
											</td>
										</tr>
										@include('admin.alternativa.modal')
									@endforeach
						   	</table>
						</div>
				</div>
		</div>
</div>

<script>
	$(document).ready(function() {
		$('#tabAlternativas').DataTable({
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
