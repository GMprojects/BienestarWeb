@extends('template')
@section ('contenido')
{!!Form::open(['route'=>['tutorTutorado.update', $tutor->idDocente], 'method'=>'PATCH', 'autocomplete'=>'off', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
			<div class="pull-right">
				<button class="btn btn-ff" type="submit"><i class="fa fa-link"></i>  <span class="hidden-xs">Vincular</span></button>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 70px;">
	<div class="col-md-12">
		<div class="caja">
			<div class="caja-header">
		      <div class="caja-icon"><i class="fa fa-users"></i></div>
		      <div class="caja-title">Tutorados</div>
		   </div>

			<div class="caja-body">
				{!!Form::hidden('anioSemestre',$anioSemestre)!!}
				{!!Form::hidden('numeroSemestre',$numeroSemestre)!!}
			   <div class="row">
					<div class="col-md-12">
						<div class="pull-left">
							<label><i class="fa fa-user margin-r-5"></i><b>Tutor: </b></label> <b>  &nbsp; &nbsp; {{ $tutor->nombre.' '.$tutor->apellidoPaterno.' '.$tutor->apellidoMaterno }}</b>&nbsp; &nbsp;
						</div>
						<div class="pull-right">
							<label><i class="glyphicon glyphicon-calendar margin-r-5"></i><b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $anioSemestre }} - @if ( $numeroSemestre == 1 )I	@else	II @endif
						</div>
					</div>
			   </div>
		      <br>
				<div class="row">
					<div id="divNoHayAlumnos" class="alert alert-danger" style='display:none;'>
							<a href="" class="close" data-dismiss="alert" aria-label="close">X</a>
							<h4>Error</h4>
							<p>Debe al menos elegir un alumno</p>
					</div>
				</div>
				<div class="row">
			       <div class="col-md-12">
						 <label for="tabModAlumnos" style="color: #4B367C;">Seleccione a los alumnos que serán tutorados</label>
		   			 <div class="table">
		   					 <div class="table-responsive">
		   						 <table id="tabModAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
		   							 <thead>
		   								 <th>Código</th>
		   								 <th>Alumno</th>
		   								 <th>Tutorado  &nbsp; &nbsp; <input type="checkbox" class="icheckbox_square-green" id="checkTodos"/></th>
		   							 </thead>
		   							 <tbody>
		   								 @foreach ($alumnos as $alumno)
		   								 <tr>
		   									 <td>{{ $alumno->codigo }}</td>
		   									 <td>{{ $alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre }}</td>
		   									 <td><input type="checkbox" class="icheckbox_square-green" id="check" onchange="ocultarError(this)" style="" value={{ $alumno->idAlumno }} name="alumnos[]"></td>
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
			 "scrollY": "500px",
			 "scrollCollapse": true,
			 "paging": false
	  });

	  $("#checkTodos").change(function () {
		  //console.log('chekBoxTotal');
		  $("input:checkbox").prop('checked', $(this).prop("checked"));
	  });

	});


	function ocultarError(){
		document.getElementById('divNoHayAlumnos').style.display = 'none';
	}

	$('#limpiarBtn').click(function(){
		console.log('limpiar Button');
		$('input:checkbox').prop('checked',false);
	});

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
