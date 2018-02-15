@extends('template')
@section('contenido')
<div class="box box-info">
	<div class="box-header">
		<div class="row">
			<div class="col-md-12">
				<div class="pull-left">
					<h3 class="box-title">
                  Lista de Actividades
                  <b>
                     @switch($estado)
                        @case('1')
                        Pendientes
                        @break
                        @case('2')
                        Ejecutadas
                        @break
                        @case('3')
                        Canceladas
                        @break
                        @case('4')
                        Expiradas
                        @break
                     @endswitch
                     @if ($anioSemestre != 0 && $numeroSemestre != 0)
                        del {{ $anioSemestre }} - @if ($numeroSemestre == '1') I @else II @endif
                     @endif
                  </b>
               </h3>
				</div>
				<div class="pull-right">
					<a href="actividad/create"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nueva Actividad</button></a>
				</div>
			</div>
		</div>
	</div>

	<div class="box-body">
		<div class="table">
			<div class="table-responsive">
				<table id="tabActividades" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<th>Id</th>
						<th>Título</th>
						<th>Tipo Actividad</th>
						<th>Modalidad</th>
						<th>Cupos</th>
						<th>Semestre</th>
						<th>Fecha Inicio</th>
						<th>Hora Inicio</th>
						<th>Estado</th>
						<!--<th>Fecha Ejecución</th>
						<th>Hora Ejecución</th>-->
						<th>Opciones</th>
					</thead>
					<tbody>
						@php
							$i = 0;
						@endphp
						@foreach($actividades as $actividad)
							@php($i++)
							<tr>
								<td>{{ $i }}</td>
								<td><a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}">{{ $actividad->titulo }}</a></td>
								<td>{{ $actividad->tipoActividad->tipo }}</td>
								@switch($actividad->modalidad)
									@case(1)
									<td><small class="label ff-bg-aqua rounded">Individual</small></td>
									@break
									@case(2)
									@if ($actividad->idTipoActividad == 9 || $actividad->idTipoActividad == 8)
									<td><small class="label ff-bg-purple rounded">Libre</small></td>
									@else
									<td><small class="label ff-bg-green2 rounded">Grupal</small></td>
									@endif
									@break
								@endswitch
								@if ($actividad->idTipoActividad == 9 || $actividad->idTipoActividad == 8)
									<td>Libre</td>
								@else
									<td>{{ $actividad->cuposTotales }}</td>
								@endif
								<td>{{ $actividad->anioSemestre }} - @if ( $actividad->numeroSemestre == 1 )I	@else	II @endif</td>
								<td>{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}</td>
								<td>{{ date("g:i A",strtotime($actividad->horaInicio)) }}</td>

								@switch($actividad->estado)
									@case(1)
										@php($diferencia = strtotime($actividad->fechaInicio) - strtotime(date('Y-m-d')))
										@php($diasRestantes = intval($diferencia/86400))
										@if ($diasRestantes < 0)
											<td><small class="label ff-bg-orange rounded">Expirada</small></td>
										@else
											<td><small class="label ff-bg-blue rounded">Pendiente</small></td>
										@endif
									<!--<td>Pendiente</td>
									<td>Pendiente</td>-->
									@break
									@case(2)
									<td><small class="label ff-bg-green rounded">Ejecutada</small></td>
									{{--<td>{{ date("d/m/Y",strtotime($actividad->fechaEjecutada)) }}</td>
									<td>{{ date("g:i A",strtotime($actividad->horaEjecutada)) }}</td>--}}
									@break
									@case(3)
									<td><small class="label ff-bg-red rounded">Cancelada</small></td>
									<!--<td>Cancelada</td>
									<td>Cancelada</td>-->
									@break
									@case(4)
									<td><small class="label ff-bg-orange rounded">Expirada</small></td>
									<!--<td>Expirada</td>
									<td>Expirada</td>-->
									@break
								@endswitch
								<td>
									@switch($actividad->estado)
										@case('1')
											<a href="{{ action('ActividadController@execute',$actividad->idActividad) }}">
												<button class="btn btn-ff-greenOs" data-toggle="tooltip" data-placement="bottom" title="Ejecutar Actividad">
													<span>
													  <i class="fa fa-child"><i class="fa fa-cogs"></i></i>
													</span>
												</button>
											</a>
											<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-ff-yellow" data-toggle="tooltip" data-placement="bottom" title="Editar o Habilitar Actividad"><i class="fa fa-edit"></i></button></a>
											<a href="" data-target = "#modal-cancel-{{ $actividad->idActividad }}" data-toggle = "modal"> <button  class="btn btn-ff-dark-red" data-toggle="tooltip" data-placement="bottom" title="Cancelar Actividad"><i class="fa fa-ban" ></i></button></a>
											<a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Actividad"><i class="fa fa-trash"></i></button></a>
										@break
										@case('2')
											<a href="{{ action('ActividadController@execute',$actividad->idActividad) }}">
												<button class="btn btn-ff-greenOs" data-toggle="tooltip" data-placement="bottom" title="Ejecutar Actividad">
													<span>
													  <i class="fa fa-child"><i class="fa fa-cogs"></i></i>
													</span>
												</button>
											</a>
											<a href="" data-target = "#modal-ejecutada" data-toggle = "modal"><button class="btn btn-ff-default" data-toggle="tooltip" data-placement="bottom" title="Función no Disponible "><i class="fa fa-edit"></i></button></a>
											<a href="" data-target = "#modal-ejecutada" data-toggle = "modal"> <button  class="btn btn-ff-default" data-toggle="tooltip" data-placement="bottom" title="Función no Disponible "><i class="fa fa-ban" ></i></button></a>
											<a href="" data-target = "#modal-ejecutada" data-toggle = "modal"><button class="btn btn-ff-default" data-toggle="tooltip" data-placement="bottom" title="Función no Disponible "><i class="fa fa-trash"></i></button></a>

										@break
										@case('3')
											<a href="" data-target = "#modal-cancelada" data-toggle = "modal"><button class="btn btn-ff-default" data-toggle="tooltip" data-placement="bottom" title="Función no Disponible "><span><i class="fa fa-child"><i class="fa fa-cogs"></i></i></span></button></a>
											<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-ff-yellow" data-toggle="tooltip" data-placement="bottom" title="Editar o Habilitar Actividad"><i class="fa fa-edit"></i></button></a>
											<a href="" data-target = "#modal-cancelada" data-toggle = "modal"> <button  class="btn btn-ff-default" data-toggle="tooltip" data-placement="bottom" title="Función no Disponible "><i class="fa fa-ban" ></i></button></a>
											<a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Actividad"><i class="fa fa-trash"></i></button></a>
										@break
										@case('4')
											<a href="" data-target = "#modal-expirada" data-toggle = "modal"><button class="btn btn-ff-default" data-toggle="tooltip" data-placement="bottom" title="Función no Disponible "><span><i class="fa fa-child"><i class="fa fa-cogs"></i></i></span></button></a>
											<a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-ff-yellow" data-toggle="tooltip" data-placement="bottom" title="Editar o Habilitar Actividad"><i class="fa fa-edit"></i></button></a>
											<a href="" data-target = "#modal-cancel-{{ $actividad->idActividad }}" data-toggle = "modal"> <button  class="btn btn-ff-dark-red" data-toggle="tooltip" data-placement="bottom" title="Cancelar Actividad"><i class="fa fa-ban" ></i></button></a>
											<a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Actividad"><i class="fa fa-trash"></i></button></a>
										@break
									@endswitch
								</td>
							</tr>
							@include('programador.actividad.modal')
							@include('programador.actividad.modalCancel')
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- MODALES -->
   <div class="modal fade" id="modal-expirada">
   	 <!-- /.modal-dialog -->
   	 <div class="modal-dialog">
   		   <!-- /.modal-content -->
   		   <div class="modal-content">
   		        <div class="modal-header" style="background-color:#444; color:white; border-radius:4px 4px 0px 0px;">
   			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			            <span aria-hidden="true"  class="fa fa-remove"></span></button>
   			          <h4 class="modal-title"  style="color:white;"><i class="fa fa-warning"></i>&nbsp; &nbsp;<b>Función no Disponible </b></h4>
   		        </div>
   		        <div class="modal-body">
   		          	<p> Esta función <b>NO DISPONIBLE</b> por que la actividad ha <b>EXPIRADO</b>.</p>
   		        </div>
   		        <div class="modal-footer">
   						  <div class="pull-right">
   							  <button class="btn btn-ff-default" type="button"  onclick="seleccionarCero()" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
   						  </div>
   		        </div>
   		   </div>
   	      <!-- /.modal-content -->
   	 </div>
       <!-- /.modal-dialog -->
   </div>

   <div class="modal fade" id="modal-ejecutada">
   	 <!-- /.modal-dialog -->
   	 <div class="modal-dialog">
   		   <!-- /.modal-content -->
   		   <div class="modal-content">
   		        <div class="modal-header" style="background-color:#444; color:white; border-radius:4px 4px 0px 0px;">
   			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			            <span aria-hidden="true"  class="fa fa-remove"></span></button>
   			          <h4 class="modal-title"  style="color:white;"><i class="fa fa-warning"></i>&nbsp; &nbsp;<b>Función no Disponible </b></h4>
   		        </div>
   		        <div class="modal-body">
   		          	<p> Esta función <b>NO DISPONIBLE</b> por que la actividad ya ha sido <b>EJECUTADA</b>.</p>
   		        </div>
   		        <div class="modal-footer">
   						  <div class="pull-right">
   							  <button class="btn btn-ff-default" type="button"  onclick="seleccionarCero()" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
   						  </div>
   		        </div>
   		   </div>
   	      <!-- /.modal-content -->
   	 </div>
       <!-- /.modal-dialog -->
   </div>

   <div class="modal fade" id="modal-cancelada">
   	 <!-- /.modal-dialog -->
   	 <div class="modal-dialog">
   		   <!-- /.modal-content -->
   		   <div class="modal-content">
   		        <div class="modal-header" style="background-color:#444; color:white; border-radius:4px 4px 0px 0px;">
   			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			            <span aria-hidden="true"  class="fa fa-remove"></span></button>
   			          <h4 class="modal-title"  style="color:white;"><i class="fa fa-warning"></i>&nbsp; &nbsp;<b>Función no Disponible </b></h4>
   		        </div>
   		        <div class="modal-body">
   		          	<p> Esta función <b>NO DISPONIBLE</b> por que la actividad ya ha sido <b>CANCELADA</b>.</p>
   		        </div>
   		        <div class="modal-footer">
   						  <div class="pull-right">
   							  <button class="btn btn-ff-default" type="button"  onclick="seleccionarCero()" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
   						  </div>
   		        </div>
   		   </div>
   	      <!-- /.modal-content -->
   	 </div>
       <!-- /.modal-dialog -->
   </div>
<!-- MODALES -->

<script>
	$(document).ready(function() {
		$('#tabActividades').DataTable({
			"lengthMenu":[[15, 25, 50, 75, -1 ], [15, 25, 50, 75, "Todas" ]],
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
