@extends('template')
@section ('contenido')
{!! Form::open(['url'=>'admin/tutorTutorado', 'method'=>'POST', 'autocomplete'=>'off', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
			<div class="pull-right">
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
				<button class="btn btn-ff" type="submit"><i class="fa fa-link"></i> Vincular</button>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 70px;">
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
					<div class="col-md-12">
						<label for="tabDocentes" style="color: #4B367C;">Seleccione al docente que será tutor.</label>
						<div class="table">
								<div class="table-responsive">
									<table id="tabDocentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<th>Código</th>
											<th>Tutor</th>
											<th>Selec.</th>
										 </thead>
										 <tbody>
											 @foreach ($docentes as $docente)
												 <tr>
   											 	<td>{{ $docente->codigo }}</td>
   												<td>{{ $docente->nombre.' '.$docente->apellidoPaterno.' '.$docente->apellidoMaterno }}</td>
   												<td>
   													<input type="radio" id="idDocente" class="iradio_square-green" onchange="ocultarError(this)" value="{{$docente->idDocente.'_'.$docente->codigo.'_'.$docente->apellidoPaterno.'_'.$docente->apellidoMaterno.'_'.$docente->nombre}}" name="tutor">
   												</td>
   											 </tr>
											 @endforeach
										 </tobody>
									 </table>
								</div>
						 </div>
					</div>
				</div><br>
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
					<div class="col-md-12">
						<label for="tabModAlumnos" style="color: #4B367C;">Seleccione a los alumnos que serán tutorados.</label>
						<div class="table">
								<div class="table-responsive">
									<table id="tabModAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<th>Código</th>
											<th>Alumno</th>
											<th>Selec.</th>
										</thead>
										<tbody>
  											 @foreach ($alumnos as $alumno)
  												 <tr>
     											 	<td>{{ $alumno->codigo }}</td>
     												<td>{{ $alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno }}</td>
     												<td>
     													<input type="checkbox" class="icheckbox_square-green" onchange="ocultarError(this)" value="{{$alumno->idAlumno}}" name="alumnos[]">
     												</td>
     											 </tr>
  											 @endforeach
										</tobody>
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

		// ajaxAlumnos();ajaxDocentes();
 		//FalumnosLibres
});

function ocultarError(){
	document.getElementById('divNoHayTutor').style.display = 'none';
	document.getElementById('divNoHayAlumnos').style.display = 'none';
}

function validar(){
	var existeAlumnoSeleccionado = false;
	var existeDocenteSeleccionado = false;
	console.log('On Validate');
	chk1=document.getElementsByName('tutor');
	chk2=document.getElementsByName('alumnos[]');
	var i = 0;
	while (i<chk2.length && !existeAlumnoSeleccionado) {
		if(chk2[i].checked){
			existeAlumnoSeleccionado = true;
		}
		i++;
	}
	var i = 0;
	while (i<chk1.length && !existeDocenteSeleccionado) {
		if(chk1[i].checked){
			existeDocenteSeleccionado = true;
			console.log('ffff        '+i);
		}
		i++;
	}
	if(!existeAlumnoSeleccionado && !existeDocenteSeleccionado){
		document.getElementById('divNoHayTutor').style.display = 'block';
		document.getElementById('divNoHayAlumnos').style.display = 'block';
		return false;
	}else if(!existeAlumnoSeleccionado){
		document.getElementById('divNoHayAlumnos').style.display = 'block';
		return false;
	}else if(!existeDocenteSeleccionado){
		document.getElementById('divNoHayTutor').style.display = 'block';
		return false;
	}
}
</script>

<style type="text/css">

</style>
@endsection
