@extends('template')
@section ('contenido')
{!! Form::open(['url'=>'admin/tutorTutorado', 'method'=>'POST', 'autocomplete'=>'off', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="caja">
			<div class="caja-header">
		      <div class="caja-icon">1</div>
		      <div class="caja-title">Docente</div>
		   </div>

			<div class="caja-body">
				<div id="divNoHayTutor" class="alert alert-danger" style='display:none;'>
						<h4>Error</h4>
						<p>Debe elegir a un docente para que sea tutor</p>
				</div>
				<div class="row">
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
				<div class="row">
					<br>
					<label for="tabDocentes" style="color: #4B367C;">Seleccione al docente que será tutor.</label>
					<div class="table">
							<div class="table-responsive">
								<br>
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
				<br>
		   </div>
		</div>
	</div>
<div class="col-md-6 col-sm-6">
		<div class="caja">
			<div class="caja-header">
		      <div class="caja-icon">2</div>
		      <div class="caja-title">Alumnos</div>
		   </div>

			<div class="caja-body">
				<div id="divNoHayAlumnos" class="alert alert-danger" style='display:none;'>
						<h4>Error</h4>
						<p>Debe al menos elegir un alumno</p>
				</div>
				<div class="row">
					 <label for="tabModAlumnos" style="color: #4B367C;">Seleccione a los alumnos que serán tutorados.</label>
					 <br>
					 <div class="table">
							 <div class="table-responsive">
 								 <br>
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
			<div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Asignar </button>
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
				</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}


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
		 url: '{{ action('TutorTutoradoController@getAlumnosLibres') }}',
		 data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
		 dataType: 'json',
		 success:function(data) {
			 for (var i = 0; i < data.length; i++) {
				 var nombres = (data[i].nombre).split(" ");
				 table.row.add([data[i].codigo,
									 data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+ nombres[0],
									 '<input type="checkbox" onchange="ocultarError(this)" style="" value='+data[i].idAlumno +' name="alumnos[]">']).draw(false);
			 }
			 //$('input[type=checkbox]').iCheck('enable');
			 //$('input[type=checkbox]').css("margin", "3px");,
		 },
		 error:function() {
				 console.log("Error ajaxAlumno");
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
		 url: '{{ action('TutorTutoradoController@getDocentesNoTutores') }}',
		 data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
		 dataType: 'json',
		 success:function(data) {
			 //console.log(data);
			 for (var i = 0; i < data.length; i++) {
   			 var nombres = (data[i].nombre).split(" ");
				 table.row.add( [data[i].codigo,
									  data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+ nombres[0],
									  '<input type="radio" id="idDocente" value="'+data[i].idDocente+'_'+data[i].codigo+'_'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'" name="tutor">']).draw(false);
			 }
			 //$('input[type=checkbox]').iCheck('enable');
			 //$('input[type=checkbox]').css("margin", "3px");,
		 },
		 error:function() {
				 console.log("Error AjaxDocente");
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
		chk1=document.getElementsByName('tutor');
		chk2=document.getElementsByName('alumnos[]');
		var i = 0;
		while (i<chk2.length && !existeUnSeleccionado) {
			if(chk2[i].checked){
				existeUnSeleccionado = true;
			}
			i++;
		}
		if(!existeUnSeleccionado && !chk1[0].checked){
			document.getElementById('divNoHayTutor').style.display = 'block';
			document.getElementById('divNoHayAlumnos').style.display = 'block';
			return false;
		}else if(!existeUnSeleccionado){
			document.getElementById('divNoHayAlumnos').style.display = 'block';
			return false;
		}else {
			document.getElementById('divNoHayTutor').style.display = 'block';
			return false;
		}

	}
</script>

<style type="text/css">

</style>
@endsection
