@extends('template')
@section ('contenido')
{!! Form::open(['url'=>'admin/tutorTutorado', 'method'=>'POST', 'autocomplete'=>'off', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}
<div class="box box-success">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Tutor</h3>
			</div>
		</div>
	</div>

	<div class="box-body">
		<div id="divNoHayTutor" class="alert alert-danger" style='display:none;'>
				<h4>Error</h4>
				<p>Debe elegir a un docente para que sea tutor</p>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="anioSemestre">Año </label>
						<input type="number" min="{{ date('Y') }}" id="anioSemestre" name="anioSemestre" class="form-control" value ="{{ date('Y') }}"  required placeholder="{{ date('Y') }}">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="numeroSemestre">Ciclo </label>
						<select name="numeroSemestre" id="numeroSemestre" required  class="form-control">
								<option value="1">I</option>
								<option value="2">II</option>
						</select>
					</div>
				</div>
		  </div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
		</div>
  	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					 <label for="codigo">Código</label>
					 <input type="text" id="codigo" name="codigo" class="form-control" disabled>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
					 <label for="nombreApellidos">Nombres y Apellidos</label>
					 <input type="text" id="nombreApellidos"name="nombreApellidos" required class="form-control" disabled>
				</div>
				 	 <button type="button" class="btn btn-primary" style="margin-top: 24px;"data-toggle="modal" data-target="#modal-default">Buscar</button>
			 </div>
		</div>
		<br>
  </div>
</div>

<div class="box box-success">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Tutorados</h3>
			</div>
		</div>
	</div>

	<div class="box-body">
		<div id="divNoHayAlumnos" class="alert alert-danger" style='display:none;'>
				<h4>Error</h4>
				<p>Debe al menos elegir un alumno</p>
		</div>
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-0"></div>
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	       <label for="tabModAlumnos">Alumnos</label>
				 <div class="table">
						 <div class="table-responsive">
							 <table id="tabModAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
								 <thead>
									 <th>Código</th>
									 <th>Alumno</th>
									 <th>Opciones</th>
								 </thead>
								 <tbody>
								 </tobody>
							 </table>
						</div>
	     		</div>
		   </div>
	   </div>
	   <button class="btn btn-primary" type="submit"> Programar</button>
  	</div>
</div>

<!-- MODALES -->
<!-- /.modal -->
<div class="modal fade" id="modal-default">
	 <!-- /.modal-dialog -->
	<div class="modal-dialog">
		 <!-- /.modal-content -->
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><b>Seleccionar al Tutor</b></h4>
				</div>
				<div class="modal-body">
					<div class="table">
							<div class="table-responsive">
								<table id="tabDocentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<th>Código</th>
										<th>Tutor</th>
										<th>Opciones</th>
									 </thead>
	 								 <tbody>
	 								 </tobody>
	 							 </table>
							</div>
					 </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="agregar()" data-dismiss="modal">Grabar</button>
          <button type="button" class="btn btn-default pull-right" onclick="ocultarError()"  data-dismiss="modal">Cerrar</button>
				</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
$(document).ready(function() {
		 $('#tabModAlumnos').DataTable({
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
				},
				"order": [[ 1, 'asc' ]]
		 });
		 $('#tabDocentes').DataTable({
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
				},
				"order": [[ 1, 'asc' ]]
		 })

		 ajaxAlumnos();ajaxDocentes();
 		//FalumnosLibres
	});
	function agregar(){
		document.getElementById('divNoHayTutor').style.display = 'none';
		document.getElementById('divNoHayAlumnos').style.display = 'none';
	  $('input[type=radio]').each(function(){
          if (this.checked) {
            var str = this.value;
            var res = str.split("_");
						$('#idTutor').val(res[0]);
						$('#codigo').val(res[1]);
						$('#nombreApellidos').val(res[2]);
          }
	   });
	}

	$('#anioSemestre').change(function(){
			ajaxAlumnos();
			ajaxDocentes();
	});

	$('#numeroSemestre').change(function(){
			ajaxAlumnos();
			ajaxDocentes();
	});

	function ajaxAlumnos(){
		var numeroSemestre = $('#numeroSemestre').val();
		var anioSemestre = $('#anioSemestre').val();
		var table = $('#tabModAlumnos').DataTable();
		 table.clear();
		 table.draw();
		//Preparando el AJAX
	 $.ajax({
		 type:'GET',
		 url: '/alumnosLibres',
		 data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
		 dataType: 'json',
		 success:function(data) {
			 //
			 for (var i = 0; i < data.length; i++) {
				 table.row.add( [data[i].codigo,
												 data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre,
											   '<input type="checkbox" onchange="ocultarError(this)" style="" value='+data[i].idAlumno +' name="alumnos[]">']).draw(false);
			 }
			 //$('input[type=checkbox]').iCheck('enable');
			 //$('input[type=checkbox]').css("margin", "3px");,
		 },
		 error:function() {
				 console.log("Error ");
		 }
	 });
	}

	function ajaxDocentes(){
		var numeroSemestre = $('#numeroSemestre').val();
		var anioSemestre = $('#anioSemestre').val();
		var table = $('#tabDocentes').DataTable();
		 table.clear();
		 table.draw();
		//Preparando el AJAX
	 $.ajax({
		 type:'GET',
		 url: '/docentesNoTutores',
		 data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
		 dataType: 'json',
		 success:function(data) {
			 console.log(data);
			 for (var i = 0; i < data.length; i++) {
				 table.row.add( [data[i].codigo,
												 data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre,
												 '<input type="radio" id="idDocente" value="'+data[i].idDocente+'_'+data[i].codigo+'_'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'" name="tutor">']).draw(false);
			 }
			 //$('input[type=checkbox]').iCheck('enable');
			 //$('input[type=checkbox]').css("margin", "3px");,
		 },
		 error:function() {
				 console.log("Error ");
		 }
	 });
	}

	function ocultarError(){
		document.getElementById('divNoHayTutor').style.display = 'none';
		document.getElementById('divNoHayAlumnos').style.display = 'none';
		//$('input[type=checkbox]').css("margin", "14px");
	}

	function validar(){
		var existeUnSeleccionado = false;
		console.log('On Validate');
		chk=document.getElementsByName('alumnos[]');
		if ($('#codigo').val() == '') {
			document.getElementById('divNoHayTutor').style.display = 'block';
			return false;
		}
		var i = 0;
		while (i<chk.length && !existeUnSeleccionado) {
			if(chk[i].checked){
				existeUnSeleccionado = true;
			}
			i++;
		}
		if(existeUnSeleccionado){
			return true;
		}else{
			document.getElementById('divNoHayAlumnos').style.display = 'block';
			return false;
		}

	}
</script>

<style type="text/css">

</style>
@endsection
