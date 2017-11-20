@extends('template')
@section ('contenido')
<div class="box box-info">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Tutores </h3>
			</div>
			<div class="col-xs-6" style="text-align:right;">
				<a href="tutorTutorado/create"><button class="btn btn-ff-green">Nuevo Tutor - Tutorados</button></a>
			</div>
		</div>

	</div>

	<div class="box-body">
			<div class="table">
					<div class="table-responsive">
						<table id="tabTutores" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<th>Id</th>
								<th>Código</th>
								<th>Nombres y Apellidos</th>
								<th>Semestre Académico</th>
								<th>Nro. Tutorados</th>
								<th>Opciones</th>
							</thead>
              			@php($i = 1)
							@foreach($tutores as $tutor)
							<tr>
                			<td>{{ $i }}</td>
								<td>{{ $tutor->codigo }}</td>
								<td>{{ $tutor->nombre.' '.$tutor->apellidoPaterno.' '.$tutor->apellidoMaterno }}</td>
								<td>{{ $tutor->anioSemestre.'-'.$tutor->numeroSemestre }}</td>
								<td>{{ $tutor->nroTutorados }}
								<td>
			                  <a href="{{ action('TutorTutoradoController@show',['idDocente' => $tutor->idDocente, 'anioSemestre' => $tutor->anioSemestre, 'numeroSemestre' => $tutor->numeroSemestre ])}}">
			                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
			                    		<i class="fa fa-eye"></i>
			                    </button>
			                  </a>
									<a href="{{ action('TutorTutoradoController@edit',['idDocente' => $tutor->idDocente, 'anioSemestre' => $tutor->anioSemestre, 'numeroSemestre' => $tutor->numeroSemestre ]) }}">
										<button class="btn btn-warning">
											<i class="fa fa-edit"></i>
										</button>
									</a>
                		  </td>
                		@php($i++)
							</tr>
							@endforeach
						</table>
					</div>
		   </div>
	 </div>
</div>
<script>
	$(document).ready(function() {
		$('#tabTutores').DataTable({
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
