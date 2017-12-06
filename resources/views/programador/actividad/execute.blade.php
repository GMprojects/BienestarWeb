@extends('template')
@section('contenido')
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="caja">
			<div class="caja-header">
	         <div class="caja-icon">1</div>
	         <div class="caja-title">Detalles de la Actividad </div>
      	</div>
			<div class="caja-body">
				<h4><b>Título de Actividad: </b> <b>  &nbsp; &nbsp; {{$actividad->titulo}}</b>&nbsp; &nbsp;</h4>
				<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label><b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $actividad->anioSemestre }}
									@if ($actividad->numeroSemestre == '1')
										- I
								  @else
										- II
								  @endif <br>
								<label><b>Fecha de Programación: </b> </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}<br>
								<label><b>Duración de la Actividad: </b> </label> &nbsp; &nbsp;{{ date("h:i A",strtotime($actividad->horaInicio)) }} &nbsp;- &nbsp;{{ date("h:i A",strtotime($actividad->horaFin)) }}<br>
								<label><b>Responsable: </b> </label> &nbsp; &nbsp;{{ $actividad->responsable->nombre.' '.$actividad->responsable->apellidoPaterno.' '.$actividad->responsable->apellidoMaterno }}<br>
								<label>Categoría </label>&nbsp; &nbsp;&nbsp; &nbsp;
								<span style="color: #4B367C;"> <b>{{ $actividad->tipoActividad->tipo }}</b> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;</span>
								<label >Modalidad </label>&nbsp; &nbsp;&nbsp; &nbsp;
								@if ($actividad->idTipoActividad != 8 && $actividad->idTipoActividad  != 9)
									@if ($actividad->modalidad == '1')
											<td><small class="label bg-aqua">Individual</small></td>
									@else
											<td><small class="label bg-purple">Grupal</small></td>
									@endif
								@else
									<td><small class="label bg-green">Libre</small></td>
								@endif
						</div>
				</div>
			   <br>
		 	</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12">
		@if ($actividad->idTipoActividad == 4)
			@include('programador.actividad.ejecutarActTut')
		@elseif ($actividad->idTipoActividad == 8)<!-- Movilidad -->
			@include('programador.actividad.ejecutarActMovilidad')
		@elseif ($actividad->idTipoActividad == 9)<!-- Comedor -->
			@include('programador.actividad.ejecutarActComedor')
		@else
			@include('programador.actividad.ejecutarOtrasAct')
		@endif
	</div>
</div>
{!! Form::close() !!}

<script type="text/javascript">
	$("#checkTodos").change(function () {
		console.log('chekBoxTotal');
		$("input:checkbox").prop('checked', $(this).prop("checked"));
	});
	$('.timepicker').timepicker({
		showInputs: false
	});
	$('#datepicker1').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate :  '-3d',
		format: 'dd/mm/yyyy'
	});
	$(document).ready(function() {
			 $('#tabAsistentes').DataTable({
					"lengthMenu": [ 15, 25, 50, 75, 100 ],
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
					},
			 });
			 $('#tabTutorados').DataTable({
					"lengthMenu": [ 15, 25, 50, 75, 100 ],
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
					},
			 });
			 init_contador('#observaciones', '#contadorObservaciones');
			 init_contador('#recomendaciones', '#contadorRecomendaciones');
	});

	function init_contador(idTextArea, idContador){
		function update_Contador(idTextArea, idContador){
			var contador = $(idContador);
			var ta = $(idTextArea);
			contador.html(ta.val().length+'/500');
		}
		$(idTextArea).keyup(function(){
			update_Contador(idTextArea, idContador);
		});
		$(idTextArea).change(function(){
			update_Contador(idTextArea, idContador);
		});
	}

</script>

<style type="text/css">
	textarea{
		resize: none;
	}
	.bg-aqua{
	  background-color: #00c0ef !important;
	}
	.bg-purple {
	  background-color: #605ca8 !important;
	}
	.bg-green {
	  background-color: #006400 !important;
	}
	.btn-circle{
		width: 23px;
		height: 23px;
		border-radius: 25px;
		padding: 0px 0px 0px 0.4px;
		font-size: 15px;
	}
</style>

@endsection
