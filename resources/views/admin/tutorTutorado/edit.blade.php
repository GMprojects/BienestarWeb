@extends('template')
@section ('contenido')
{!! Form::open(['route'=>['tutorTutorado.update', $tutor[0]->idDocente], 'method'=>'PATCH', 'autocomplete'=>'off', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}
<div class="box box-success">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Editar Tutorados</h3>
			</div>
		</div>
	</div>

	<div class="box-body">
		{!!Form::hidden('anioSemestre',$anioSemestre)!!}
		{!!Form::hidden('numeroSemestre',$numeroSemestre)!!}
    <label><b>Tutor: </b> </label> <b>  &nbsp; &nbsp; {{ $tutor[0]->nombre.' '.$tutor[0]->apellidoPaterno.' '.$tutor[0]->apellidoMaterno }}</b>&nbsp; &nbsp;
    <div class="pull-right"><label><b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $anioSemestre.'-'.$numeroSemestre }}</div>
    <br> <br>
		<div id="divNoHayAlumnos" class="alert alert-danger" style='display:none;'>
				<a href="" class="close" data-dismiss="alert" aria-label="close">X</a>
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
		 ajaxAlumnosLibres();
 		//FalumnosLibres
	});

	function agregar(){
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
			ajaxAlumnosLibres();
	});

	$('#numeroSemestre').change(function(){
			ajaxAlumnosLibres();
	});

	function ajaxAlumnosLibres(){
		var numeroSemestre = {{ $numeroSemestre }}
		var anioSemestre = {{ $anioSemestre }}
    var idDocente = {{ $tutor[0]->idDocente }}
		var table = $('#tabModAlumnos').DataTable();
		 table.clear();
		 table.draw();
		//Preparando el AJAX
	 $.ajax({
		 type:'GET',
		 url: '/alumnosLibresExDoc',
		 data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre, idDocente:idDocente},
		 dataType: 'json',
		 success:function(data) {
			 for (var i = 0; i < data.length; i++) {
				 if(in_array(data[i].idAlumno,{{ $idTutorados }})){
					 table.row.add( [data[i].codigo,
													 data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre,
												   '<input type="checkbox" checked onchange="ocultarError(this)" style="" value='+data[i].idAlumno +' name="alumnos[]">']).draw(false);
				 }else {
					 table.row.add( [data[i].codigo,
  												 data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre,
  											   '<input type="checkbox" onchange="ocultarError(this)" style="" value='+data[i].idAlumno +' name="alumnos[]">']).draw(false);
				 }
			 }
		 },
		 error:function() {
				 console.log("Error ");
		 }
	 });
	}

	function ocultarError(){
		document.getElementById('divNoHayAlumnos').style.display = 'none';
	}

	function validar(){
		var existeUnSeleccionado = false;
		console.log('On Validate');
		chk=document.getElementsByName('alumnos[]');
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

	function in_array(valor, array){
			var noExiste = true;
			var i = 0;
			var cant = array.length;
			while ( i<cant && noExiste) {
					if (array[i]==valor) {
						noExiste = false;
					}
					i++;
			}
			if (!noExiste) {
					return true;
			} else {
					return false;
			}
	}
</script>
@endsection
