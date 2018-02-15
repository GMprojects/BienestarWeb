@extends('template')
@section('contenido')
<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 70px;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="caja">
			<div class="caja-header">
	         <div class="caja-icon">1</div>
	         <div class="caja-title">Detalles de la Actividad </div>
      	</div>
			<div class="caja-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4> <b>Título de Actividad:    &nbsp; &nbsp; {{$actividad->titulo}}&nbsp; &nbsp;</b> </h4>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label><i class="fa fa-calendar-o margin-r-5"></i>&nbsp; &nbsp;Semestre Académico:  </label> &nbsp; &nbsp;{{ $actividad->anioSemestre }}
								@if ($actividad->numeroSemestre == '1')
									- I
							  @else
									- II
							  @endif <br>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label><i class="fa fa-calendar margin-r-5"></i>&nbsp; &nbsp;Fecha de Inicio:  </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label><i class="fa fa-clock-o margin-r-5"></i>&nbsp; &nbsp;Hora de Inicio:  </label> &nbsp; &nbsp;{{ date("h:i A",strtotime($actividad->horaInicio)) }}
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label><i class="fa fa-calendar margin-r-5"></i>&nbsp; &nbsp;Fecha de Fin:  </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividad->fechaFin)) }}
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label><i class="fa fa-clock-o margin-r-5"></i>&nbsp; &nbsp;Hora de Fin:  </label> &nbsp; &nbsp;{{ date("h:i A",strtotime($actividad->horaFin)) }}
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label><i class="fa fa-user margin-r-5"></i>&nbsp; &nbsp;Responsable:  </label> &nbsp; &nbsp;{{ $actividad->responsable->nombre.' '.$actividad->responsable->apellidoPaterno.' '.$actividad->responsable->apellidoMaterno }}
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label><i class="fa fa-tags  margin-r-5"></i>&nbsp; &nbsp;Categoría:  </label> &nbsp; &nbsp;<b style="color: #4B367C;">{{ $actividad->tipoActividad->tipo }}</b>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<label><i class="fa fa-users margin-r-5"></i>&nbsp; &nbsp;Modalidad
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
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
	/*$(document).ready(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
			increaseArea: '20%' // optional
		});
		$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
	});*/
	{{--$("#checkTodos").change(function () {
		//console.log('chekBoxTotal');
		$("input:checkbox").prop('checked', $(this).prop("checked"));
	});--}}
	var imagenCorrecta = true;
	$('.timepicker').timepicker({
		showInputs: false
	});
	$('#fechaEjecutada').datetimepicker({
		format: 'DD/MM/YYYY',
		minDate: moment('{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}','DD/MM/YYYY')
	});
	$(document).ready(function() {
		imagenCorrecta = true;
		$('#tabTutorados').DataTable({
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
			"order": [[ 1, 'asc' ]],
			"scrollY": "400px",
			"scrollCollapse": true,
			"paging": false
		});
		$('#tabAsistentes').DataTable({
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
			"order": [[ 1, 'asc' ]],
			"scrollY": "400px",
			"scrollCollapse": true,
			"paging": false
		});
		$('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
		  $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
	  });
			 init_contador('#observaciones', '#contadorObservaciones');
			 init_contador('#recomendaciones', '#contadorRecomendaciones');
	});
	/* PLUGIN - Dropify*/
	$('.dropify').dropify({
	 messages: {
		  'default': 'Click o arrastrar y soltar',
		  'replace': 'Click o arrastrar y soltar',
		  'remove':  'Quitar',
		  'error':   'Ops! algo anda mal con el archivo'
	 },
	 error: {
		'fileSize': 'El tamaño de la imagen es muy grande (máx. 4MB).',
		'fileExtension': 'Formato de Imagen no permitido (sólo .png .jpg .jpeg).'
	 }
	});
	var drEvent = $('.dropify').dropify();
	drEvent.on('dropify.error.fileSize', function(event, element){
		imagenCorrecta = false;
		console.log('fileSize - ERROR  '+imagenCorrecta);
	});
	drEvent.on('dropify.error.fileExtension', function(event, element){
		imagenCorrecta = false;
		console.log('fileSize - ERROR  '+imagenCorrecta);
	});
	drEvent.on('dropify.fileReady', function(event, element){
		imagenCorrecta = true;
		console.log('fileReady - '+imagenCorrecta);
	});
	drEvent.on('dropify.beforeClear', function(event, element){
		imagenCorrecta = false;
		console.log('beforeClear - '+imagenCorrecta);
	});
	/* FIN PLUGIN - Dropify*/
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
	function verAsistencias(){
		$('#modal-asistencia').modal('show');
	}
	function validar(){
		return imagenCorrecta;
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
	.ast{
		color: red;
		font-size: 20px;
	}
</style>

@endsection
