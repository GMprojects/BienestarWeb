@extends('template')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
   </div>
</div>
{!! Form::model($actividad, ['method'=>'PATCH', 'route'=>['actividad.update', $actividad->idActividad], 'files'=>'true']) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">1</div>
	         <div class="caja-title">Datos Generales</div>
	      </div>
	      <div class="caja-body">
	         <div class="form-control-file">
					<label for="rutaImagen">Imagen</label>
					@if ($actividad->rutaImagen != null)
						<!--<img src="{/{ '../../../storage/'.$actividad->rutaImagen }}" data-default-file="{/{ asset('images/avatar3.png') }}"  width="440px" class="img-responsive">-->
						<input type="file" name="rutaImagen" class="form-control dropify"data-default-file="{{ asset('storage/'.$actividad->rutaImagen) }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
					@else
						<!--<img src="{/{ '../../../storage/'.$actividad->tipoActividad['rutaImagen'] }}" data-default-file="{/{ asset('images/avatar3.png') }}"  width="440px" class="img-responsive">-->
						<input type="file" name="rutaImagen" class="form-control dropify"data-default-file="{{ asset('storage/'.$actividad->tipoActividad['rutaImagen']) }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
					@endif
				</div>
				<br>
            <div class="form-group">
               <label for="titulo">Título de la actividad *</label>
               <input type="text" name="titulo" class="form-control"  required value ="{{$actividad->titulo}}" placeholder="De preferencia un título corto y llamativo">
            </div>

				<div class="form-group">
					<label for="idTipoActividad">Categoría </label>&nbsp; &nbsp;&nbsp; &nbsp;
					<span style="color: #4B367C;"> <b>{{ $actividad->tipoActividad->tipo }}</b> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;</span>
					<label >Modalidad </label>&nbsp; &nbsp;&nbsp; &nbsp;
					@if ($actividad->actividadMovilidad == null||$actividad->actividadComedor == null)
						@if ($actividad->modalidad == '1')
								<td><small class="label bg-aqua">Individual</small></td>
						@else
								<td><small class="label bg-purple">Grupal</small></td>
						@endif
					@else
						<td><small class="label bg-green">Libre</small></td>
					@endif
				</div>

				<div class="form-group">
				  <label for="titulo">Descripción *</label>
					<textarea style="resize: none;" name="descripcion"  class="form-control" required rows="6" cols="30">{{ $actividad->descripcion }}</textarea>
			  	</div>
				<div class="form-group">
					<label for="titulo">Información Adicional </label>
					<textarea style="resize: none;" name="informacionAdicional"  class="form-control" rows="6" cols="30" placeholder="Añadir información Adicional">{{ $actividad->informacionAdicional }}</textarea>
				</div>
				<div class="form-group">
					<input type="checkbox" id="envioCorreos" name="envioCorreos" class="minimal"> &nbsp;&nbsp; &nbsp; <b>Enviar correos a todos los inscritos</b>&nbsp; &nbsp;
					<span>
						<button type="button" class="btn btn-default btn-circle" data-toggle="modal" data-target="#modal-default">
							<i class="fa fa-question" style="padding-left:4px;"></i>
           			</button>
					</span>
				</div>
			</div>
	      <div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Modificar</button>
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
				</div>
	      </div>
	   </div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="caja">
			<div class="caja-header">
				<div class="caja-icon">2</div>
				<div class="caja-title">Cuándo? </div>
			</div>
			<div class="caja-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="fechaInicio">Fecha de Inicio *</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="fechaInicio" class="form-control" required  value="{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}" id="datepicker1">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
							<div class="form-group">
								<label for="horaInicio">Hora de Inicio *</label>
								<div class="input-group">
									<div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
									</div>
									<input type="text" name="horaInicio"  required value="{{ date('g:i A',strtotime($actividad->horaInicio)) }}" class="form-control timepicker" id="timepicker1">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="fechaFin">Fecha de Fin *</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="fechaFin" class="form-control" required  value="{{ date("d/m/Y",strtotime($actividad->fechaFin)) }}" id="datepicker2">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
							<div class="form-group">
								<label for="horaFin">Hora de Fin *</label>
								<div class="input-group">
									<div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
									</div>
									<input type="text" name="horaFin"  required value="{{ date('g:i A',strtotime($actividad->horaFin)) }}" class="form-control timepicker" id="timepicker2">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="caja-footer"></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="caja">
			<div class="caja-header">
				<div class="caja-icon">3</div>
				<div class="caja-title">Dónde? </div>
			</div>
			<div class="caja-body">
				<div class="form-group">
					<label for="lugar">Lugar *</label>
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-location-arrow"></i>
					  </div>
					  <input type="text" name="lugar" class="form-control" value="{{ $actividad->lugar }}" required  placeholder="Av. Juan Pablo II S/N - Ciudad Universitaria">
					</div>
				</div>
				<div class="form-group">
					<label for="referencia">Referencia</label>
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-map-signs"></i>
					  </div>
					  <input type="text" name="referencia" class="form-control" value="{{ $actividad->referencia }}" placeholder="Aula 202 - Segundo Piso Bienestar Universitario">
					</div>
				</div>
			</div>
			<div class="caja-footer"></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="caja"  id="boxDatosEspecificos" style='display:none;'>
			<div class="caja-header">
				<div class="caja-icon">4</div>
				<div class="caja-title"> Datos Específicos</div>
			</div>
			<div class="caja-body">
				<div id="selectResponsables" style='display:none;'>
					<div class="form-group">
						<label for="idUserResp" id="etiquetaResponsable">Responsable *</label>
						<select name="idUserResp" id="selectIdResponsable" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
						<a id="enlaceRespInvitado" onclick="mostrarNuevoResponsable()" style='display:none;'>Añadir Responsable Invitado</a>
					</div>
				</div>
				<div id="selectAlumnosI" style='display:none;'>
					<div class="form-group">
						<label id="lbAlumno" for="idAlumnoI">Alumno *</label>
						<select name="idAlumno" id="selectIdAlumnoI"  class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
					</div>
				</div>
				<div id="selectAlumnosTutorados" style='display:none;'>
					<div class="form-group">
						<label for="idAlumnoTutorado">Tutorados *</label>
						<select name="idAlumnoTutorado[]" id="selectIdAlumnoTutorado"  class="selectpicker form-control" multiple title="Selecciona Tutorado.."data-size="15" data-live-search="true" data-show-subtext="true"> </select>
					</div>
				</div>
				<div id="divNoHayTutor" class="callout callout-danger" style='display:none;'>
		         <h4>Tutores</h4>
		         <p id="mensajeTutor">No hay tutor dentro del bla bla.</p>
         	</div>
				<div id="divCuposTotales" style='display:none;'>
					<div class="form-group">
						<label for="cuposTotales">N° Cupos *</label>
						@if ($actividad->idTipoActividad >2 && $actividad->idTipoActividad != 4 && $actividad->idTipoActividad !=3 &&  $actividad->modalidad !=1 && $actividad->idTipoActividad !=10 )
							<input type="number" id="cuposTotales" min="2" name="cuposTotales" class="form-control" value ="{{ $actividad->cuposTotales }}">
						@else
							<input type="number" id="cuposTotales" min="2" name="cuposTotales" class="form-control">
						@endif
					</div>
				</div>
				<div class="form-group" style='display:none;'id="fechasConvocatoria">
					<label for="fechasConvocatoria">Rango de la Convocatoria *</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						@if ($actividad->actividadMovilidad != null)
						 	 <input type="text" name="fechasConvocatoria" class="form-control pull-right" value="{{date("d/m/Y",strtotime($actividad->actividadMovilidad['fechaInicioConvocatoria'])).' - '.date("d/m/Y",strtotime($actividad->actividadMovilidad['fechaFinConvocatoria']))}}" id="daterangepicker">
						@else
							 <input type="text" name="fechasConvocatoria" class="form-control pull-right" value="" id="daterangepicker">
						@endif
					</div>
				</div>
				<div class="form-group" style='display:none;' id="fechaInicioConvocatoria">
					<label for="fechaInicioConvocatoria">Fecha de Inicio Convocatoria *</label>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						@if ($actividad->actividadComedor != null)
					 		 <input type="text" name="fechaInicioConvocatoria" class="form-control pull-right" value="{{ date("d/m/Y",strtotime($actividad->actividadComedor['fechaConvocatoria'])) }}" id="datepicker4">
					   @else
							 <input type="text" name="fechaInicioConvocatoria" class="form-control pull-right" value="" id="datepicker4">
					   @endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="caja" id="boxResponsableInvitado" style='display:none;'>
			<div class="caja-header">
				<div class="caja-icon">5</div>
				<div class="caja-title"> Responsable Invitado </div>
				<div class="caja-tools">
					<button type="button" class="btn btn-caja" onclick="ocultarNuevoResponsable()">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="caja-body">
				<div class="form-group">
				  <label for="nombreResponsable">Nombres *</label>
				  <input type="text" id="nombreResponsable" name="nombreResponsable" class="form-control" placeholder="Nombres">
			  </div>
			  <div class="form-group">
				  <label for="apellidosResponsable">Apellidos *</label>
				  <input type="text" id="apellidosResponsable" name="apellidosResponsable" class="form-control" placeholder="Apellidos">
			  </div>
			  <div class="form-group">
				  <label for="emailResponsable">Correo *</label>
				  <input type="email" id="emailResponsable" name="emailResponsable" class="form-control" placeholder="xxx@xxx.xx">
			  </div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-default">
	 <!-- /.modal-dialog -->
	 <div class="modal-dialog">
		   <!-- /.modal-content -->
		   <div class="modal-content">
		        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true" class="fa fa-remove"></span></button>
			          <h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp; &nbsp;<b>Ayuda</b></h4>
		        </div>
		        <div class="modal-body">
		          	<p>Seleccione esta opción si desea comunicar a todos los inscritos de los cambios que esta realizando en esta actividad.</p>
		        </div>
		        <div class="modal-footer">
		          	<button type="button" class="btn btn-ff-default pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
		        </div>
		   </div>
	      <!-- /.modal-content -->
	 </div>
    <!-- /.modal-dialog -->
</div>

{!! Form::close() !!}

<script type="text/javascript">
	$.ajaxSetup({
	   headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('.timepicker').timepicker({
		showInputs: false
	})
	$('#datepicker1').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate :  '-3d',
		format: 'dd/mm/yyyy'
	})
	$('#datepicker2').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate :  '-3d',
		format: 'dd/mm/yyyy'
	})
	$('#datepicker3').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate :  '-3d',
		format: 'dd/mm/yyyy'
	})
	$('#datepicker4').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate :  '-3d',
		format: 'dd/mm/yyyy'
	})
	$('#daterangepicker').daterangepicker({
		//autoUpdateInput: false,
		locale: {
			format: 'DD/MM/YYYY'
		},
		minDate :  '{{ date("d")-2 }}',
	});
	$(document).ready(function(){
		document.getElementById('boxDatosEspecificos').style.display = 'block';
      console.log("elegir actividad");
		//ATENCIÓN MÉDICA       PSICOLOGÍA
		if ({{ $actividad->idTipoActividad }} == '1' || {{ $actividad->idTipoActividad }} == '2') {
			console.log("1-2");
			document.getElementById('selectAlumnosI').style.display = 'block';
			dListaAlumnos('{{ action('UserController@getAlumnos') }}','Alumnos');
			//SERVICIO SOCIAL
		}else if ({{ $actividad->idTipoActividad }} == '3') {
			document.getElementById('selectResponsables').style.display = 'block';
			document.getElementById('selectAlumnosI').style.display = 'block';
			document.getElementById('rIndividual').checked = true;
			dListaResponsables('{{ action('UserController@getUsersAdm') }}', 'responsable');
			dListaAlumnos('{{ action('UserController@getAlumnos') }}','Alumnos');
			//TUTORIA
		}else if ({{ $actividad->idTipoActividad }} == '4') {
			document.getElementById('selectResponsables').style.display = 'block';
			document.getElementById('selectAlumnosTutorados').style.display = 'block';
			document.getElementById('etiquetaResponsable').innerHTML = 'Tutor *';
			var numeroSemestre = $('#numeroSemestre').val();
			var anioSemestre = $('#anioSemestre').val();
			dListaTutores('{{ action('TutorTutoradoController@getTutores') }}','Tutor',anioSemestre,numeroSemestre);
			var op ="";
			$.ajax({
				type:'GET',
				url: '/listaTutorados',
				data: {id:{{ $actividad->idUserResp }}, anioSemestre:{{ $actividad->anioSemestre }}, numeroSemestre:{{ $actividad->numeroSemestre }}},
				dataType: 'json',
				success:function(data) {
							for (var i = 0; i < data.length; i++) {
								if({{ count($actividad->inscripcionesADA) }} !=0 ){
									//console.log(data[i].idAlumno);console.log({{ $idAlumnos["0"]}});
										if(in_array(data[i].idAlumno, {{ $idAlumnos }})){
											op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
										}else{
											op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
										}
								}
								$("#selectIdAlumnoTutorado").append(op);
							}
							$("#selectIdAlumnoTutorado").selectpicker("refresh");
				},
				error:function() {
						console.log("Error ");
				}
			});
			//DEPORTES CULTURALES ESPARCIMIENTO
		}else if ({{ $actividad->idTipoActividad }} == '5' || {{ $actividad->idTipoActividad }} == '6' || {{ $actividad->idTipoActividad }} == '7') {
			console.log("5 - 6- 7");
			document.getElementById('selectResponsables').style.display = 'block';
			document.getElementById('divCuposTotales').style.display = 'block';
			document.getElementById('enlaceRespInvitado').style.display = 'block';
			if ( ('{{ $actividad->invitado }}') != '' ) {
				 console.log("tamaño de "+('{{ $actividad->invitado }}').length);
	          document.getElementById('boxResponsableInvitado').style.display = 'block';
				 var invitado = ('{{ $actividad->invitado }}').split("-");
				 $('#nombreResponsable').attr('value', invitado[0]);
	          $('#apellidosResponsable').attr('value', invitado[1]);
	          $('#emailResponsable').attr('value', invitado[2]);
			}
			dListaResponsables('{{ action('UserController@getUsers') }}','Responsable');
			//MOVILIDAD
		}else if ({{ $actividad->idTipoActividad }} == '8') {
			document.getElementById('selectResponsables').style.display = 'block';
			//document.getElementById('boxDatosAdicionales').style.display = 'block';
			document.getElementById('fechasConvocatoria').style.display = 'block';
			dListaResponsables('{{ action('UserController@getUsersAdm') }}','Responsable');
			//COMEDOR
		}else if ({{ $actividad->idTipoActividad }} == '9') {
			document.getElementById('selectResponsables').style.display = 'block';
			//document.getElementById('boxDatosAdicionales').style.display = 'block';
			document.getElementById('fechaInicioConvocatoria').style.display = 'block';
			dListaResponsables('{{ action('UserController@getUsersAdm') }}','Responsable');
			//REFORZAMIENTO
		}else{
			document.getElementById('selectResponsables').style.display = 'block';
			document.getElementById('enlaceRespInvitado').style.display = 'block';
			document.getElementById('selectAlumnosI').style.display = 'block';
			dListaResponsables('{{ action('UserController@getUsers') }}','Responsable');
			dListaAlumnos('{{ action('UserController@getAlumnos') }}');
		}
	});

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
	var dListaResponsables = function(url, placeholder) {
		var op ="";
			var tamSelectIdResp=document.getElementById("selectIdResponsable").length;
			if(tamSelectIdResp>0){
				$("#selectIdResponsable").children('option').remove();
				console.log('Borrando');
			}
			//Preparando el AJAX
	    $.ajax({
	      type:'GET',
	      url: url,
	      data: '',
	      dataType: 'json',
			success:function(data) {
	          op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
	          $("#selectIdResponsable").append(op);
	          console.log('Cantidad de responsables'+data.length);
	          for (var i = 0; i < data.length; i++) {
		           if({{ $actividad->idUserResp }} == data[i].id){
		             op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].id+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
		           }else{
		             op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].id+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
		           }
		            $("#selectIdResponsable").append(op);
	          }
	          $("#selectIdResponsable").selectpicker("refresh");
			},
	      error:function() {
	          console.log("Error ");
	      }
	    });
	    //Fin del AJAX
	};

	var dListaAlumnos = function(url, placeholder) {
	    var op ="";
		var tamSelectIdAlumno=document.getElementById("selectIdAlumnoI").length;
		if(tamSelectIdAlumno>0){
			$("#selectIdAlumnoI").children('option').remove();
			console.log('Borrando');
		}
	    //Preparando el AJAX
	    $.ajax({
	      type:'GET',
	      url: url,
	      data: "",
	      dataType: 'json',
			success:function(data) {
	          op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
	          $("#selectIdAlumnoI").append(op);
				 console.log('Cantidad de alumnos'+data.length);
	          for (var i = 0; i < data.length; i++) {
						if({{ count($actividad->inscripcionesADA) }} !=0 ){
							//console.log(data[i].idAlumno);console.log({/{ $idAlumnos["0"]}});
								if(in_array(data[i].idAlumno, {{ $idAlumnos }})){
									op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
								}else{
									op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
								}
						}
		            $("#selectIdAlumnoI").append(op);
	          }
	          $("#selectIdAlumnoI").selectpicker("refresh");
	      },
	      error:function() {
	          console.log("Error ");
	      }
	    });
	    //Fin del AJAX
	};

	var dListaTutores = function(url, placeholder,anioSemestre, numeroSemestre) {
	    var op ="";
	    //Preparando el AJAX
		 $.ajax({
	      type:'GET',
	      url: url,
	      data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
	      dataType: 'json',
	      success:function(data) {
	        if(data.length == 0){
					document.getElementById('divNoHayTutor').style.display = 'block';
					document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+anioSemestre+'-'+numeroSemestre+'.';
	        }else {
	              op ='<option value=""> Seleccione un '+placeholder+' </option>';
	              $("#selectIdResponsable").append(op);
								console.log('Cantidad de Tutores'+data.length);
	              for (var i = 0; i < data.length; i++) {
						  if({{ $actividad->idUserResp }} == data[i].id){
                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].id+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                    }else{
                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].id+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                    }
	                $("#selectIdResponsable").append(op);
	              }
	              $("#selectIdResponsable").selectpicker("refresh");
	        }
	      },
	      error:function() {
	          console.log("Error ");
	      }
	    });
	    //Fin del AJAX
	};

	$("#selectIdResponsable").change(function(){
		console.log($(this).val());
		if({{ $actividad->idTipoActividad }} == 4){
			var op ="";
			var tamSelectIdAlumno=document.getElementById("selectIdAlumnoI").length;
			if(tamSelectIdAlumno>0){
				$("#selectIdAlumnoI").children('option').remove();
				console.log('Borrando');
			}
			var tamSelectIdAlumno=document.getElementById("selectIdAlumnoTutorado").length;
			if(tamSelectIdAlumno>0){
			$("#selectIdAlumnoTutorado").children('option').remove();
				console.log('Borrando');
			}
			var numeroSemestre = {{ $actividad->numeroSemestre }};
			var anioSemestre = {{ $actividad->anioSemestre }};
			//Preparando el AJAX
			console.log("TutorTutoradoooo");
			$.ajax({
				type:'GET',
				url: '{{ action('TutorTutoradoController@getTutorados') }}',
				data: {id:$(this).val(), anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
				dataType: 'json',
				success:function(data) {
					console.log($('input:radio[name=modalidad]').val());
					console.log('Cantidad de Tutorados'+data.length);
					for (var i = 0; i < data.length; i++) {
						op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
						$("#selectIdAlumnoTutorado").append(op);
					}
					$("#selectIdAlumnoTutorado").selectpicker("refresh");
				},
				error:function() {
					console.log("Error selectResponsable");
				}
			});
		//Fin del AJAX
	   }
	});

	$("#anioSemestre").click(function(){
	      document.getElementById('divNoHayTutor').style.display = 'none';
	      if($('#selectIdTipoActividad').val() == 4){
	        var op ="";
	        //Preparando el AJAX
	        $.ajax({
	          type:'GET',
	          url: '{{ action('TutorTutoradoController@getTutores') }}',
	          data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
	          dataType: 'json',
	          success:function(data) {
	            if(data.length == 0){
	                  document.getElementById('divNoHayTutor').style.display = 'block';
	                  document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+anioSemestre+'-'+numeroSemestre+'.';
	            }else {
	                  op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
	                  $("#selectIdResponsable").append(op);
	                  for (var i = 0; i < data.length; i++) {
	                    op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].id+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
	                    $("#selectIdResponsable").append(op);
	                  }
	                  $("#selectIdResponsable").selectpicker("refresh");
	            }
	          },
	          error:function() {
	              console.log("Error listaResponsablesTutores");
	          }
	        });
	        //Fin del AJAX
	      }
	});

	function mostrarNuevoResponsable(){
		document.getElementById('boxResponsableInvitado').style.display = 'block';
	}

	function ocultarNuevoResponsable(){
		document.getElementById('boxResponsableInvitado').style.display = 'none';
		$('#nombreResponsable').val('');
		$('#apellidosResponsable').val('');
		$('#emailResponsable').val('');
	}

	function mostrarSegunModalidad(modalidad){
			document.getElementById('selectAlumnosI').style.display = 'none';
			document.getElementById('selectAlumnosTutorados').style.display = 'none';
			document.getElementById('divCuposTotales').style.display = 'none';
			switch (modalidad) {
				case 1:
							if(document.getElementById('selectIdTipoActividad').value == 4){
									document.getElementById('selectAlumnosTutorados').style.display = 'block';
							}else {
									document.getElementById('selectAlumnosI').style.display = 'block';
							}
					break;
				case 2:
							document.getElementById('divCuposTotales').style.display = 'block';
					break;
				default:
			}
	}
</script>

<style type="text/css">
	.table-fixed{
		height: 100px;
	}
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
