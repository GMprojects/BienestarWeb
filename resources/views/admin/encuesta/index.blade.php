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
								@for($i = 0; $i < count($encuestas); $i++)
									<tr>
										<td>{{$encuestas[$i]->idEncuesta}}</td>
										<td>{{$encuestas[$i]->titulo}}</td>
										<td>
											@if($encuestas[$i]->tipo == 1)
												{{$encuestas[$i]->tipoActividad['tipo']}}
											@endif
										</td>
										@if($encuestas[$i]->tipo == 1)
											@if($encuestas[$i]->destino === 'r')
												<td>Responsable</td>
											@else
												<td>Inscritos</td>
											@endif
										@elseif($encuestas[$i]->tipo == 2)
											<td>
												@if(strpos($encuestas[$i]->destino, '1') !== false)
													<p>Alumnos</p>
												@endif
												@if(strpos($encuestas[$i]->destino, '2') !== false)
													<p>Docentes</p>
												@endif
												@if(strpos($encuestas[$i]->destino, '3') !== false)
													<p>Administradores</p>
												@endif
				  							 </td>
				  						 @elseif($encuestas[$i]->tipo == 3)
											 @if($encuestas[$i]->destino === 'd')
 												<td>Tutor</td>
 											@else
 												<td>Tutorado</td>
 											@endif
										 @endif
										<td>
											<a href="{{URL::action('EncuestaController@show',$encuestas[$i]->idEncuesta)}}">
												<button class="btn btn-ff-blues" data-toggle="tooltip" data-placement="bottom" title="Vista Preliminar de la Encuesta">
													<span>
													  <i class="fa fa-eye"><i class="fa fa-file-text"></i></i>
													</span>
												</button>
											</a>

											@if($cant_enc_resp[$i] == 0)
												<a href="{{URL::action('EncuestaController@edit',$encuestas[$i]->idEncuesta)}}">
													<button class="btn btn-ff-orange" data-toggle="tooltip" data-placement="bottom" title="Editar esta encuesta">
														<span>
														  <i class="fa fa-edit"></i></i>
														</span>
													</button>
												</a>
												<a href="" data-target="#modal-delete-{{$encuestas[$i]->idEncuesta}}" data-toggle="modal"><button class="btn btn-ff-red"><i class="fa fa-trash"></i></button></a>
											@endif
											@if($encuestas[$i]->tipo != 1)
												<a href="{{URL::action('EncuestaController@send',$encuestas[$i]->idEncuesta)}}">
													<button class="btn btn-ff-green" data-toggle="tooltip" data-placement="bottom" title="Enviar esta encuesta">
														<span>
														  <i class="fa fa-send"></i></i>
														</span>
													</button>
												</a>
											@endif
											@if ($cant_enc_resp[$i] > 0)
												<a href="{{URL::action('EncuestaController@details',$encuestas[$i]->idEncuesta)}}">
													<button class="btn btn-ff-default" data-toggle="tooltip" data-placement="bottom" title="Detalles de esta encuesta">
														<span>
														  <i class="fa fa-list"></i></i>
														</span>
													</button>
												</a>
											@endif

										</td>
									</tr>
									@include('admin.encuesta.modal')
								@endfor
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
