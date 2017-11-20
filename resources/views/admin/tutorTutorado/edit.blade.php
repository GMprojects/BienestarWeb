@extends('template')
@section ('contenido')
{!!Form::open(['route'=>['tutorTutorado.update', $tutor->idDocente], 'method'=>'PATCH', 'autocomplete'=>'off', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}

{!!Form::hidden('anioSemestre',$anioSemestre)!!}
{!!Form::hidden('numeroSemestre',$numeroSemestre)!!}

<div class="caja">
	<div class="caja-header">
      <div class="caja-icon"><i class="fa fa-users"></i></div>
      <div class="caja-title">Tutorados</div>
   </div>

	<div class="caja-body">
	   <div class="row">
			<h4>
				<b>Docente: </b> <b>  &nbsp; &nbsp; {{ $tutor->nombre.' '.$tutor->apellidoPaterno.' '.$tutor->apellidoMaterno }}</b>&nbsp; &nbsp;
			   <div class="pull-right"><label><b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $anioSemestre.'-'.$numeroSemestre }}</div>
			</h4>

	      <br> <br>
			<div id="divNoHayAlumnos" class="alert alert-danger" style='display:none;'>
					<a href="" class="close" data-dismiss="alert" aria-label="close">X</a>
					<h4>Error</h4>
					<p>Debe al menos elegir un alumno</p>
			</div>
	   </div>
		<div class="row">
	       <label for="tabModAlumnos" style="color: #4B367C;">Seleccione a los alumnos que serán tutorados</label>
			 <div class="table">
					 <div class="table-responsive">
						 <table id="tabModAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
							 <thead>
								 <th>Código</th>
								 <th>Alumno</th>
								 <th>Opciones</th>
							 </thead>
							 <tbody>
								 @foreach ($tutorados as $tutorado)
									 <tr>
										 @if (in_array($tutorado->idAlumno, $idTutorados->toArray()))
											 <td>{{ $tutorado->codigo }}</td>
											 <td>{{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}</td>
											 <td><input type="checkbox" checked onchange="ocultarError(this)" style="" value={{ $tutorado->idAlumno }} name="alumnos[]"></td>
										 @else
											 <td>{{ $tutorado->codigo }}</td>
											 <td>{{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}</td>
											 <td><input type="checkbox" onchange="ocultarError(this)" style="" value={{ $tutorado->idAlumno }} name="alumnos[]"></td>
										 @endif
									 </tr>
								 @endforeach
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
				"order": [[ 2,'asc' ]]
		 });
		// ajaxAlumnosLibres();
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
