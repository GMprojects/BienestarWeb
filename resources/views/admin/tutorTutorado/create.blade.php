@extends('template')
@section ('contenido')

@if ($status != null)
	<div class="row">
		<div class="col-md-12" id="cajaDocente" style='display:block;'>
			<div class="caja">
				<div class="caja-header">
						<div class="caja-title">Tutor - Tutorados</div>
				 </div>
				<div class="caja-body">
					<div class="alert alert-info">
						<p> <i class="fa fa-calendar-times-o fa-1x" style="color:red;"></i> {{ $status }} </p>					
					</div>						
				</div>
			</div>
		</div>
	</div>
@else
	{!! Form::open(['url'=>'admin/tutorTutorado', 'method'=>'POST', 'autocomplete'=>'off', 'id' => 'formTutorTutorado']) !!}
	{!! Form::token() !!}
	<div class="row">
		<div class="col-xs-12">
			<div class="second-bar">
				<div class="pull-left">
					<button id="btnSalir" class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
					<a href="#cajaAlumnos" data-toggle="tab">
						<button id="btnVolver" style='display:none;' class="btn btn-ff-default" type="button" onclick="editarTutor()"><i class="fa fa-arrow-left"></i>
							<span class="hidden-xs">Volver</span>
						</button>
					</a>
				</div>
				<div class="pull-right">
					<a href="#cajaDocentes" data-toggle="tab">
						<button id="btnSiguiente" class="btn btn-ff" type="button" onclick="elegirTutor()"><i class="fa fa-arrow-right"></i>  <span class="hidden-xs">Siguiente</span></button>
					</a>
					<button id="btnVincular" style='display:none;' class="btn btn-ff" type="button" onclick="validar()"><i class="fa fa-link"></i>  <span class="hidden-xs">Vincular</span></button>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 70px;">
		<div class="col-md-12" id="cajaDocente" style='display:block;'>
			<div class="caja">
				<div class="caja-header">
			      <div class="caja-icon">1</div>
			      <div class="caja-title">Docente</div>
			   </div>
				<div class="caja-body">
					<div id="divNoHayTutor" style='display:none;' class="alert alert-danger" >
							<h4>Error</h4>
							<p>Debe elegir a un docente para que sea tutor</p>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label for="tabDocentes" style="color: #4B367C;">Seleccione al docente que será tutor.</label>
							<div class="table">
									<div class="table-responsive">
										<table id="tabDocentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
											<thead>
												<th>Código</th>
												<th>Docente</th>
												<th>Tutor</th>
											 </thead>
											 <tfoot>
	 											<th>Código</th>
	 											<th>Docente</th>
	 											<th>Tutor</th>
	 										 </tfoot>
										 </table>
									</div>
							 </div>
						</div>
					</div>
			   </div>
			</div>
		</div>
		<div class="col-md-12"  id="cajaAlumnos" style="display:none;">
			<div class="caja">
				<div class="caja-header">
			      <div class="caja-icon">2</div>
			      <div class="caja-title">Alumnos</div>
			   </div>
				<div class="caja-body">
					<div class="row">
						<div class="col-md-12">
							<div class="pull-left">
								<label><i class="fa fa-user margin-r-5"></i><b>Tutor: </b></label> &nbsp; &nbsp; <b id="tutor"> </b>&nbsp; &nbsp;
							</div>
						</div>
				   </div>
					<br>
					<div id="divNoHayAlumnos" class="alert alert-danger" style='display:none;'>
							<h4>Error</h4>
							<p>Debe al menos elegir un alumno</p>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label for="tabModAlumnos" style="color: #4B367C;">Seleccione a los alumnos que serán tutorados</label>
							<div class="table">
									<div class="table-responsive">
										<table id="tabModAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>Código</th>
													<th>Alumno</th>
													<th><input type="checkbox" name="select_all" value="1" class="icheckbox_square-green" id="checkTodos"/></th>
													<!--<th>Tutorado  &nbsp; &nbsp; <input type="checkbox" class="icheckbox_square-green" id="checkTodos"/></th>-->
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Código</th>
													<th>Alumno</th>
													<th></th>
													<!--<th>Tutorado  &nbsp; &nbsp; <input type="checkbox" class="icheckbox_square-green" id="checkTodos"/></th>-->
												</tr>
											</tfoot>
										</table>
								  </div>
						   </div>
						</div>
				   </div>
			  	</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}

	<div class="modal fade" id="modal-confirmacion">
		 <!-- /.modal-dialog -->
		 <div class="modal-dialog">
			   <!-- /.modal-content -->
			   <div class="modal-content">
					  <div class="modal-header" style="background-color:#337AB7; color:white; border-radius:4px 4px 0px 0px;">
		               <button type="button"  onclick="cancelarForm()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
		               <h4 class="modal-title"><b>Mensaje de Confirmación</b></h4>
		           </div>
			        <div class="modal-body">
			          	<p> Esta seguro de que el docente <b id="modTutor"></b> tiene como tutorados a: </p>
							<div id="tutorados">
								<ol></ol>
							</div>
			        </div>
					  <div class="modal-footer">
		  	            <div class="pull-left">
		  						<button class="btn btn-ff-default" onclick="cancelarForm()" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
		  					</div>
		  					<div class="pull-right">
		  						<button class="btn btn-ff" onclick="enviarForm()" type="button"><i class="fa fa-check"></i> Confirmar</button>
		  					</div>
	  				</div>
			   </div>
		      <!-- /.modal-content -->
		 </div>
	    <!-- /.modal-dialog -->
	</div>


	<script type="text/javascript">

		$(document).ready(function() {
			var tutorGeneral;
			var datosAlumnos = new Array();
			var datosDocente = new Array();
			@php($i = 0)
			@foreach ($alumnos as $alumno)
				datosAlumnos[{{ $i }}] = [
					"{{ $alumno->codigo }}",
					"{{ $alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno }}",
					"{{ $alumno->idAlumno.'_'.$alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno }}"
				]
				@php($i++)
			@endforeach
			@php($i = 0)
			@foreach ($docentes as $docente)
				datosDocente[{{ $i }}] = [
					"{{ $docente->codigo }}",
					"{{ $docente->nombre.' '.$docente->apellidoPaterno.' '.$docente->apellidoMaterno }}",
					"{{$docente->idDocente.'_'.$docente->codigo.'_'.$docente->apellidoPaterno.'_'.$docente->apellidoMaterno.'_'.$docente->nombre}}"
				]
				@php($i++)
			@endforeach
			 $('#tabDocentes').DataTable({
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
					"scrollY": "70vh",
	  			 	"scrollX": true,
					"scrollCollapse": true,
					"paging": false,
					"columnDefs": [{
	 		         "targets": 2,
	 		         "searchable":false,
	 		         "orderable":false,
	 		         "className": "dt-body-center",
	 		         'render': function (data, type, full, meta){
	 		             return '<input type="radio" id="idDocente" class="iradio_square-green" onchange="ocultarError(this)" value="'+ $('<div/>').text(data).html() + '" name="tutor">';
	 		         }
	 				}],
	 			  "data" : datosDocente,
			 });
			 $('#tabModAlumnos').DataTable({
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
				  "scrollY": "70vh",
				  "scrollX": true,
				  "scrollCollapse": true,
				  "paging": false,
				  "columnDefs": [{
			         "targets": 2,
			         "searchable":false,
			         "orderable":false,
			         "className": "dt-body-center",
			         'render': function (data, type, full, meta){
			             return '<input type="checkbox" class="icheckbox_square-green" onchange="ocultarError(this)" value="'+ $('<div/>').text(data).html() + '"  name="alumnos[]">';
			         }
					}],
				  "data" : datosAlumnos,
				  "select" : {
					   "style" : "multi"
					}
			 });
			$("#checkTodos").change(function () {
				$("input:checkbox").prop('checked', $(this).prop("checked"));
			});
			$('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
	        	$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
	      });
		});
		function ocultarError(){
			document.getElementById('divNoHayTutor').style.display = 'none';
			document.getElementById('divNoHayAlumnos').style.display = 'none';
		}
		function editarTutor(){
			document.getElementById('btnSalir').style.display = 'block';
			document.getElementById('btnSiguiente').style.display = 'block';
			document.getElementById('cajaDocente').style.display = 'block';
			document.getElementById('btnVincular').style.display = 'none';
			document.getElementById('btnVolver').style.display = 'none';
			document.getElementById('cajaAlumnos').style.display = 'none';
		}
		function elegirTutor(){
			var existeDocenteSeleccionado = false;
			chk1=document.getElementsByName('tutor');
			var i = 0;
			while (i<chk1.length && !existeDocenteSeleccionado) {
				if(chk1[i].checked){
					existeDocenteSeleccionado = true;
				}
				i++;
			}
			if(!existeDocenteSeleccionado){
				document.getElementById('divNoHayTutor').style.display = 'block';
			}else{
				document.getElementById('btnSalir').style.display = 'none';
				document.getElementById('btnSiguiente').style.display = 'none';
				document.getElementById('cajaDocente').style.display = 'none';
				document.getElementById('btnVincular').style.display = 'block';
				document.getElementById('btnVolver').style.display = 'block';
				document.getElementById('cajaAlumnos').style.display = 'block';
				var datosDocente = chk1[i-1].value;
				var datosTutor = datosDocente.split("_");
				tutorGeneral = datosTutor[4]+' '+datosTutor[3]+' '+datosTutor[2];
				document.getElementById('tutor').innerHTML = datosTutor[4]+' '+datosTutor[3]+' '+datosTutor[2];
			}
		}
		function validar(){
			var existeAlumnoSeleccionado = false;
			chk2=document.getElementsByName('alumnos[]');
			var i = 0;
			while (i<chk2.length && !existeAlumnoSeleccionado) {
				if(chk2[i].checked){
					existeAlumnoSeleccionado = true;
				}
				i++;
			}
			if(!existeAlumnoSeleccionado){
				document.getElementById('divNoHayAlumnos').style.display = 'block';
				//return false;
			}else{
				document.getElementById('modTutor').innerHTML = tutorGeneral;
				i=0;
				while (i<chk2.length ) {
					if(chk2[i].checked){
						$('#tutorados ol').append('<li id="alumno">'+((chk2[i].value).split("_"))[1]+'</li>');
					}
					i++;
				}
				$('#modal-confirmacion').modal('show');
				//enviarForm();
				//return true;
			}
		}
		function cancelarForm(){
			$('ol li').remove();
		}
		function enviarForm(){
			document.getElementById('formTutorTutorado').submit();
		}
	</script>
@endif

@endsection
