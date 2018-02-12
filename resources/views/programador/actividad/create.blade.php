@extends('template')
@section('contenido')
@include('programador.actividad.modalAyuda')

{!! Form::open(['url'=>'programador/actividad', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}

<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
			<div class="pull-right">
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> <span class="hidden-xs">Limpiar</span></button>
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> <span class="hidden-xs">Publicar</span></button>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 70px;">
	<div class="col-md-6 col-sm-6">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">1</div>
	         <div class="caja-title">Datos Generales</div>
	      </div>
	      <div class="caja-body">
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
				<div>
					<p style="color:red;"> <span class="ast">*</span> Requerido
						<span>
							<button type="button" class="btn btn-default btn-circle" data-toggle="modal" data-target="#modal-ayuda">
								<i class="fa fa-question" style="padding-left:4px;"></i>
							</button>
						</span>
					</p>
				</div>
	         <div class="form-control-file">
					<label for="rutaImagen">Imagen</label>
					<input type="file" name="rutaImagen" class="form-control dropify"  data-allowed-file-extensions="png jpg jpge"  data-disable-remove="true">
				</div>
				<br>
            <div class="form-group">
               <label for="titulo">Título de la actividad </label><span class="ast">*</span>
               <input type="text"  minlength="5"  name="titulo" class="form-control"  required value ="{{ old('titulo') }}" placeholder="De preferencia un título corto y llamativo">
            </div>
				<div class="form-group">
					<label for="idTipoActividad">Categoría </label><span class="ast">*</span>
					<select name="idTipoActividad" id="selectIdTipoActividad"  required class="form-control">
						<option value="">Seleccione una Categoría</option>
						@foreach($tiposActividad as $tipo)
							<option value="{{$tipo->idTipoActividad}}-{{$tipo->responsable}}">{{$tipo->tipo}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
				  <label for="titulo">Descripción </label><span class="ast">*</span>
					<textarea style="resize: none;" minlength="10" name="descripcion"  class="form-control" required value ="{{old('descripcion')}}"  rows="6" cols="30" placeholder="Describir una breve reseña de Evento"></textarea>
			  	</div>
				<div class="form-group">
					<label for="titulo">Información Adicional </label>
					<textarea style="resize: none;" name="informacionAdicional"  class="form-control" value ="{{old('informacionAdicional')}}"  rows="6" cols="30" placeholder="Añadir información Adicional"></textarea>
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
					<div id="horasError" class="alert alert-danger" style='display:none;'>
							<p>La <b>Hora de Fin</b> debe ser mayor a la <b>Hora de Inicio</b>.</p>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="fechaInicio" id="lblFechaInicio">Fecha de Inicio </label><span class="ast">*</span>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								@if (old('fechaInicio') == null)
									<input type="text" required name="fechaInicio"  placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaInicio" >
								@else
									<input type="text" required name="fechaInicio"  value="{{old('fechaInicio')}}" class="form-control"  id="fechaInicio" >
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-6" id="divHoraInicio">
						<div class="bootstrap-timepicker">
							<div class="form-group">
								<label for="horaInicio">Hora de Inicio </label><span class="ast">*</span>
								<div class="input-group">
									<div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
									</div>
									@if (old('horaInicio') == null)
										<input type="text" required name="horaInicio" id="horaInicio" placeholder="{{ date("h:i A") }}" class="form-control timepicker">
									@else
										<input type="text" required name="horaInicio" id="horaInicio" value="{{old('horaInicio')}}" class="form-control timepicker">
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" id="divFechaFin">
						<div class="form-group">
							<label for="fechaFin" id="lblFechaFin">Fecha de Fin </label><span class="ast">*</span>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								@if (old('fechaFin') == null)
									<input type="text" required name="fechaFin"  placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaFin" >
								@else
									<input type="text" required name="fechaFin"  value="{{old('fechaFin')}}" class="form-control"  id="fechaFin" >
								@endif
							</div>
						</div>
					</div>
					<div class="col-md-6" id="divHoraFin">
						<div class="bootstrap-timepicker">
							<div class="form-group">
								<label for="horaFin">Hora de Fin </label><span class="ast">*</span>
								<div class="input-group">
									<div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
									</div>
									@if (old('horaFin') == null)
										<input type="text" required name="horaFin" id="horaFin" placeholder="{{ date("h:i A") }}" class="form-control timepicker">
									@else
										<input type="text" required name="horaFin" id="horaFin" value="{{old('horaFin')}}" class="form-control timepicker">
									@endif
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
					<label for="lugar">Lugar </label><span class="ast">*</span>
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-location-arrow"></i>
					  </div>
					  <input type="text" name="lugar" class="form-control" value="{{ old('lugar') }}" required  placeholder="Av. Juan Pablo II S/N - Ciudad Universitaria">
					</div>
				</div>
				<div class="form-group">
					<label for="referencia">Referencia</label>
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-map-signs"></i>
					  </div>
					  <input type="text" name="referencia" class="form-control" value="{{ old('referencia') }}" placeholder="Aula 202 - Segundo Piso Bienestar Universitario">
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
				<div id="divError" class="alert alert-danger" style='display:none;'>
						<p id="pError">Debe elegir a un docente para que sea tutor</p>
				</div>
				<div id="divNoHayTutor" class="alert alert-danger" style='display:none;'>
		         <p id="mensajeTutor">No existen tutores registrados en el ciclo académico.</p>
         	</div>
				<div id="selectResponsables" style='display:none;'>
					<div class="form-group">
						<label for="idUserResp" id="etiquetaResponsable">Responsable </label><span class="ast">*</span>
						<select name="idUserResp" onchange="ocultar()" id="selectIdResponsable" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
						<a id="enlaceRespInvitado" onclick="mostrarNuevoResponsable()" style='display:none;'>Añadir Responsable Invitado</a>
					</div>
				</div>
				<div id="divModalidad" style='display:none;'>
					<div class="form-group">
						<label for="modalidad">Modalidad</label>
							<div class="row">
								<div class="col-xs-6">
									<input type="radio" id="rIndividual" name="modalidad" value="1" checked onchange="mostrarSegunModalidad(1)"> Individual</option>
								</div>
								<div class="col-xs-6 pull-right">
									<input type="radio" id="rGrupal" name="modalidad" value="2" onchange="mostrarSegunModalidad(2)"> Grupal</option>
								</div>
							</div>
					</div>
				</div>
				<div id="selectAlumnos" style='display:none;'>
					<div class="form-group">
						<label id="lbAlumno" for="idAlumno">Alumno </label><span class="ast">*</span>
						<select name="idAlumno" onchange="ocultar()" id="selectIdAlumno" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
					</div>
				</div>
				<div id="selectAlumnosTutorados" style='display:none;'>
					<div class="form-group">
						<label for="idAlumnoTutorado">Tutorados </label><span class="ast">*</span>
						<select name="idAlumnoTutorado[]" onchange="ocultar()" id="selectIdAlumnoTutorado"  class="selectpicker form-control" multiple title="Selecciona Tutorado.."data-size="15" data-live-search="true" data-show-subtext="true"> </select>
					</div>
				</div>
				<div id="divCuposTotales" style='display:none;'>
					<div class="form-group">
						<label for="cuposTotales">N° Cupos </label><span class="ast">*</span>
						<input type="number" id="cuposTotales" min="2" name="cuposTotales" class="form-control" value ="{{old('cuposTotales')}}" placeholder="2">
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
					<button type="button" class="btn btn-caja" onclick="ocultarNuevoResponsable()" onc>
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="caja-body">
				<div id="respError" class="alert alert-danger" style='display:none;'>
						<p>Debe registrar todos los datos del responsable invitado, sino exite un invitdo cerrar la caja <b>Responsable Invitado</b>.</p>
				</div>
				<div class="form-group">
					<label for="nombreResponsable">Nombres </label><span class="ast">*</span>
					<input type="text" id="nombreResponsable" name="nombreResponsable" class="form-control" value ="{{old('nombreResponsable')}}" placeholder="Nombres">
				</div>
				<div class="form-group">
					<label for="apellidosResponsable">Apellidos </label><span class="ast">*</span>
					<input type="text" id="apellidosResponsable" name="apellidosResponsable" class="form-control" value ="{{old('apellidosResponsable')}}" placeholder="Apellidos">
				</div>
				<div class="form-group">
					<label for="emailResponsable">Correo </label><span class="ast">*</span>
					<input type="email" id="emailResponsable" name="emailResponsable" class="form-control" value ="{{old('emailResponsable')}}" placeholder="xxx@xxx.xx">
				</div>
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var llenarInvitado = false;
	$(document).ready(function(){
		$('#modal-ayuda').modal('show');
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
			increaseArea: '20%' // optional
		});
		$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
	});
	$('.timepicker').timepicker({
		showInputs: false
	})
	$('#fechaInicio').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	$('#fechaFin').datetimepicker({
		format: 'DD/MM/YYYY',
		useCurrent: false // Important! See issue #1075
	});
	$('#fechaInicio').on("dp.change", function(e){
		$('#fechaFin').data("DateTimePicker").minDate(e.date);
	});
	$('#fechaFin').on("dp.change", function(e){
		$('#fechaInicio').data("DateTimePicker").maxDate(e.date);
	});
	$('#horaInicio').click(function(){
			document.getElementById('horasError').style.display = 'none';
	});
	$('#horaFin').click(function(){
			document.getElementById('horasError').style.display = 'none';
	});
	$("#selectIdTipoActividad").change(function(){
		document.getElementById('boxDatosEspecificos').style.display = 'block';
      var tamSelectIdResponsable=document.getElementById("selectIdResponsable").length;
      var tamSelectIdAlumno=document.getElementById("selectIdAlumno").length;
      if(tamSelectIdResponsable>0){
        $("#selectIdResponsable").children('option').remove();
      }
      if(tamSelectIdAlumno>0){
        $("#selectIdAlumno").children('option').remove();
      }
      tamSelectIdAlumno=document.getElementById("selectIdAlumnoTutorado").length;
      if(tamSelectIdAlumno>0){
        $("#selectIdAlumnoTutorado").children('option').remove();
      }
		document.getElementById('selectResponsables').style.display = 'none';
		document.getElementById('selectAlumnos').style.display = 'none';
		document.getElementById('selectAlumnosTutorados').style.display = 'none';

		document.getElementById('divCuposTotales').style.display = 'none';
		document.getElementById('divModalidad').style.display = 'none';
		document.getElementById('divError').style.display = 'none';

		document.getElementById('divFechaFin').style.display = 'block';
		document.getElementById('divHoraFin').style.display = 'block';

		document.getElementById('boxResponsableInvitado').style.display = 'none';
		document.getElementById('enlaceRespInvitado').style.display = 'none';
		document.getElementById('divNoHayTutor').style.display = 'none';
		document.getElementById('etiquetaResponsable').innerHTML = 'Responsable';
		document.getElementById('lblFechaInicio').innerHTML = 'Fecha de Inicio';
		document.getElementById('lblFechaFin').innerHTML = 'Fecha de Fin';

		$('#cuposTotales').removeAttr('required');
		var tipoActividad = $(this).val().split('-');
      switch (tipoActividad[0]) {
			case '1'://ATENCIÓN MÉDICA
			case '2'://PSICOLOGÍA
				document.getElementById('divFechaFin').style.display = 'none';
				document.getElementById('divHoraFin').style.display = 'none';
				document.getElementById('selectAlumnos').style.display = 'block';
				dListaAlumnos('{{ action('UserController@getUsersAlumnos') }}','Alumnos');
				$('#fechaFin').removeAttr('required');
				$('#horaFin').removeAttr('required');
				break;
			case '3'://SERVICIO SOCIAL
				document.getElementById('selectResponsables').style.display = 'block';
				document.getElementById('divModalidad').style.display = 'block';
				document.getElementById('selectAlumnos').style.display = 'block';
				document.getElementById('rIndividual').checked = true;
				dListaResponsables(tipoActividad[1]);
				dListaAlumnos('{{ action('UserController@getUsersAlumnos') }}','Alumno');
				$('#fechaFin').attr('required', 'true');
				$('#horaFin').attr('required', 'true');
				break;
			case '4'://TUTORÍA
				document.getElementById('selectResponsables').style.display = 'block';
				document.getElementById('selectAlumnosTutorados').style.display = 'block';
				document.getElementById('etiquetaResponsable').innerHTML = 'Tutor';
				dListaTutores('{{ action('TutorTutoradoController@getTutores') }}','Tutor');
				$('#fechaFin').attr('required', 'true');
				$('#horaFin').attr('required', 'true');
				break;
			case '5'://DEPORTES
			case '6'://CULTURALES
			case '7'://ESPARCIMIENTO
				document.getElementById('selectResponsables').style.display = 'block';
				document.getElementById('divCuposTotales').style.display = 'block';
				document.getElementById('enlaceRespInvitado').style.display = 'block';
				dListaResponsables(tipoActividad[1]);
				$('#cuposTotales').attr('required', 'true');
				$('#fechaFin').attr('required', 'true');
				$('#horaFin').attr('required', 'true');
				break;
			case '8'://MOVILIDAD
			case '9'://COMEDOR
				document.getElementById('selectResponsables').style.display = 'block';
				document.getElementById('lblFechaInicio').innerHTML = 'Inicio de la Convocatoria';
				document.getElementById('lblFechaFin').innerHTML = 'Fin de la Convocatoria';
				dListaResponsables(tipoActividad[1]);
				$('#fechaFin').removeAttr('required');
				$('#horaFin').removeAttr('required');
				break;
			case '10'://REFORZAMIENTO
				document.getElementById('selectResponsables').style.display = 'block';
				document.getElementById('divModalidad').style.display = 'block';
				document.getElementById('enlaceRespInvitado').style.display = 'block';
				document.getElementById('selectAlumnos').style.display = 'block';
				dListaResponsables(tipoActividad[1]);
				dListaAlumnos('{{ action('UserController@getUsersAlumnos') }}','Alumno');
				$('#fechaFin').attr('required', 'true');
				$('#horaFin').attr('required', 'true');
				break;
			default:
				document.getElementById('divCuposTotales').style.display = 'block';
				document.getElementById('selectResponsables').style.display = 'block';
				document.getElementById('enlaceRespInvitado').style.display = 'block';
				dListaResponsables(tipoActividad[1]);
				$('#cuposTotales').attr('required', 'true');
				$('#fechaFin').attr('required', 'true');
				$('#horaFin').attr('required', 'true');
				break;
         }
	});
	var dListaResponsables = function( responsables ) {
			var tipoActividadResponsable = responsables;
			var url = '';
			if (tipoActividadResponsable.length == 1){
				switch(tipoActividadResponsable[0]){
					case('1'):
						url = url + '{{ action('UserController@getUsersAlumnos') }}'
						break;
					case('2'):
						url = url + '{{ action('UserController@getUsersDocentes') }}'
						break;
					case('3'):
						url = url + '{{ action('UserController@getUsersAdministrativos') }}'
						break;
				}
			}else if (tipoActividadResponsable.length == 2){
				if (tipoActividadResponsable[0] == 1 && tipoActividadResponsable[1] == 2){
					url = url + '{{ action('UserController@getUsersAlumDoc') }}'
				}else if (tipoActividadResponsable[0] == 1 && tipoActividadResponsable[1] == 3){
					url = url + '{{ action('UserController@getUsersAlumAdm') }}'
				}else{ {{-- 2 y 3 --}}
					url = url + '{{ action('UserController@getUsersDocAdm') }}'
				}
			}else{
				url = url + '{{ action('UserController@getUsersTodos') }}'
			}
			console.log(' url:  '+url);
			var op ="";
			var tamSelectIdResp=document.getElementById("selectIdResponsable").length;
			if(tamSelectIdResp>0){
				$("#selectIdResponsable").children('option').remove();
			}
			//Preparando el AJAX
		   $.ajax({
		      type:'GET',
		      url: url,
		      data: '',
		      dataType: 'json',
		      success:function(data) {
		          op ='<option value="" selected> Seleccione un Responsable </option>';
		          $("#selectIdResponsable").append(op);
		          for (var i = 0; i < data.length; i++) {
						 op ='<option data-subtext="'+data[i].codigo+'" value="'+data[i].id+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
		            //op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].id+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
		            $("#selectIdResponsable").append(op);
		          }
		          $("#selectIdResponsable").selectpicker("refresh");
		      },
		      error:function() {
		          console.log("Error en Obtener lista de Responsables ");
		      }
		    });
		    //Fin del AJAX
	};

	var dListaAlumnos = function(url, placeholder) {
	    var op ="";
		var tamSelectIdAlumno=document.getElementById("selectIdAlumno").length;
		if(tamSelectIdAlumno>0){
			$("#selectIdAlumno").children('option').remove();
		}
	    //Preparando el AJAX
	    $.ajax({
	      type:'GET',
	      url: url,
	      data: "",
	      dataType: 'json',
	      success:function(data) {
	          op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
	          $("#selectIdAlumno").append(op);
	          for (var i = 0; i < data.length; i++) {
	            op ='<option data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
	            $("#selectIdAlumno").append(op);
	          }
	          $("#selectIdAlumno").selectpicker("refresh");
	      },
	      error:function() {
	          console.log("Error en Obtener lista de Alumnos");
	      }
	    });
	    //Fin del AJAX
	};

	var dListaTutores = function(url, placeholder) {
	    var op ="";
	    //Preparando el AJAX
		 $.ajax({
		      type:'GET',
		      url: url,
		      dataType: 'json',
		      success:function(data) {
		        if (data == 'error') {
					  document.getElementById('divNoHayTutor').style.display = 'block';
	 				  document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+"{{(String)$semestre}}"+'.';
					  $('#modal-errorTut').modal('show');
		        }else{
					  if(data.length == 0){
						   document.getElementById('divNoHayTutor').style.display = 'block';
						   document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+"{{(String)$semestre}}"+'.';
							$('#modal-errorTut').modal('show');
					  }else {
							  op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
							  $("#selectIdResponsable").append(op);
							  for (var i = 0; i < data.length; i++) {
								 op ='<option data-subtext="'+data[i].codigo+'" value="'+data[i].id+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
								 $("#selectIdResponsable").append(op);
							  }
							  $("#selectIdResponsable").selectpicker("refresh");
					  }
				  }
		      },error:function() {
						$('#modal-errorTut').modal('show');
						document.getElementById('divNoHayTutor').style.display = 'block';
						document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+"{{(String)$semestre}}"+'.';
		          	console.log("Error en Obtener lista de Tutores");
		      }
	    });
	    //Fin del AJAX
	};

	$("#selectIdResponsable").change(function(){
		if(($('#selectIdTipoActividad').val().split('-'))[0] == 4){
			var op ="";
			var tamSelectIdAlumno=document.getElementById("selectIdAlumno").length;
			if(tamSelectIdAlumno>0){
				$("#selectIdAlumno").children('option').remove();
			}
			var tamSelectIdAlumno=document.getElementById("selectIdAlumnoTutorado").length;
			if(tamSelectIdAlumno>0){
			$("#selectIdAlumnoTutorado").children('option').remove();
			}
			//Preparando el AJAX
			$.ajax({
				type:'GET',
				url: '{{ action('TutorTutoradoController@getTutorados') }}',
				data: {id:$(this).val()},
				dataType: 'json',
				success:function(data) {
					if (data == 'error') {
	 				  document.getElementById('divNoHayTutor').style.display = 'block';
	  				  document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+"{{(String)$semestre}}"+'.';
	 	        }else{
						for (var i = 0; i < data.length; i++) {
							op ='<option data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
							$("#selectIdAlumnoTutorado").append(op);
						}
						$("#selectIdAlumnoTutorado").selectpicker("refresh");
	 			  }
				},
				error:function() {
					console.log("Error en Obtener lista de tutorados");
				}
			});
		//Fin del AJAX
	   }
	});

	function mostrarNuevoResponsable(){
		llenarInvitado = true;
		document.getElementById('boxResponsableInvitado').style.display = 'block';
	}
	function ocultarNuevoResponsable(){
		llenarInvitado = false;
		document.getElementById('boxResponsableInvitado').style.display = 'none';
		$('#nombreResponsable').val('');
		$('#apellidosResponsable').val('');
		$('#emailResponsable').val('');
	}
	function mostrarSegunModalidad(modalidad){
			document.getElementById('selectAlumnos').style.display = 'none';
			document.getElementById('selectAlumnosTutorados').style.display = 'none';
			document.getElementById('divCuposTotales').style.display = 'none';
			switch (modalidad) {
				case 1:
							if(document.getElementById('selectIdTipoActividad').value == 4){
									document.getElementById('selectAlumnosTutorados').style.display = 'block';
							}else {
									document.getElementById('selectAlumnos').style.display = 'block';
							}
							$('#cuposTotales').removeAttr('required');
					break;
				case 2:
							document.getElementById('divCuposTotales').style.display = 'block';
							ocultar()
							$('#cuposTotales').attr('required', 'true');
					break;
				default:
			}
	}

	function ocultar(){
		document.getElementById('divError').style.display = 'none';
	}

	function validar(){
		var todoBien = true;
		switch ((($('#selectIdTipoActividad').val()).split('-'))[0]) {
			case '1'://ATENCIÓN MÉDICA
			case '2'://PSICOLOGÍA
				var selectIdAlumno = document.getElementById('selectIdAlumno');
				var pro = selectIdAlumno.options[selectIdAlumno.selectedIndex].value;
				if ( pro == '') {
					document.getElementById('pError').innerHTML = 'Debe seleccionar un alumno para quien será la actividad que esta programando.';
					document.getElementById('divError').style.display = 'block';
					todoBien = false;
				}
				break;
			case '3'://SERVICIO SOCIAL
			case '10'://REFORZAMIENTO
				var selectIdResponsable = document.getElementById('selectIdResponsable');
				var pro1 = selectIdResponsable.options[selectIdResponsable.selectedIndex].value;
				if ( $('input:radio[name=modalidad]:checked').val() == 1 ) {//INDIVIDUAL
					var selectIdAlumno = document.getElementById('selectIdAlumno');
					var pro2 = selectIdAlumno.options[selectIdAlumno.selectedIndex].value;
					if ( pro1 == '' || pro2 == '') {
						document.getElementById('pError').innerHTML = 'Debe seleccionar un alumno y un responsable para quien será la actividad que esta programando.';
						document.getElementById('divError').style.display = 'block';
						todoBien = false;
					}
				} else if ( $('input:radio[name=modalidad]:checked').val() == 2 ) {//GRUPAL
					if ( pro1 == '' ) {
						document.getElementById('pError').innerHTML = 'Debe seleccionar un responsable para quien será la actividad que esta programando.';
						document.getElementById('divError').style.display = 'block';
						todoBien = false;
					}
				}
				if ($('#fechaInicio').val() === $('#fechaFin').val() ) {
					var i = moment($('#horaInicio').val(),'HH:mm A');
					var f = moment($('#horaFin').val(),'HH:mm A');
					if( f.diff(i) < 0){
						document.getElementById('horasError').style.display = 'block';
						todoBien = false;
					}
				}
				break;
			case '4'://TUTORÍA
				var selectIdResponsable = document.getElementById('selectIdResponsable');
				if(selectIdResponsable.options.length == 0){
					//<MODAL><DE>ERROR</DE></MODAL>
					document.getElementById('pError').innerHTML = 'Antes de publicar se deben registrar tutores en el semestre académico.'+"{{(String)$semestre}}"+'.';
					document.getElementById('divError').style.display = 'block';
					todoBien = false;
				}else {
					var pro1 = selectIdResponsable.options[selectIdResponsable.selectedIndex].value;
					if ( pro1 == '' ) {
						document.getElementById('pError').innerHTML = 'Debe seleccionar un tutor, quien estará a cargo de sesión de tutoría que esta programando.';
						document.getElementById('divError').style.display = 'block';
						todoBien = false;
					}else {
						var selectIdAlumnoTutorado = document.getElementById('selectIdAlumnoTutorado');
						if ( selectIdAlumnoTutorado.selectedIndex == -1) {
							document.getElementById('pError').innerHTML = 'Debe seleccionar al menos un tutorado.';
							document.getElementById('divError').style.display = 'block';
							todoBien = false;
						}
					}
					if ($('#fechaInicio').val() === $('#fechaFin').val() ) {
						var i = moment($('#horaInicio').val(),'HH:mm A');
						var f = moment($('#horaFin').val(),'HH:mm A');
						if( f.diff(i) < 0){
							document.getElementById('horasError').style.display = 'block';
							todoBien = false;
						}
					}
				}
				break;
			case '5'://DEPORTES
			case '6'://CULTURALES
			case '7'://ESPARCIMIENTO
			case '8'://MOVILIDAD
			case '9'://COMEDOR
				var selectIdResponsable = document.getElementById('selectIdResponsable');
				var pro1 = selectIdResponsable.options[selectIdResponsable.selectedIndex].value;
				if ( pro1 == '' ) {
					document.getElementById('pError').innerHTML = 'Debe seleccionar un responsable, quien estará a cargo de la actividad que esta programando.';
					document.getElementById('divError').style.display = 'block';
					todoBien = false;
				}
				var nombreResponsable = $('#nombreResponsable').val();
				var apellidosResponsable = $('#apellidosResponsable').val();
				var emailResponsable = $('#emailResponsable').val();
				if(llenarInvitado){
					if(nombreResponsable == '' || apellidosResponsable == '' || emailResponsable == ''){
							document.getElementById('respError').style.display = 'block';
							todoBien = false
					}
				}
				if ($('#fechaInicio').val() === $('#fechaFin').val() ) {
					var i = moment($('#horaInicio').val(),'HH:mm A');
					var f = moment($('#horaFin').val(),'HH:mm A');
					if( f.diff(i) < 0){
						document.getElementById('horasError').style.display = 'block';
						todoBien = false;
					}
				}
				break;
			default:
				var selectIdResponsable = document.getElementById('selectIdResponsable');
				var pro1 = selectIdResponsable.options[selectIdResponsable.selectedIndex].value;
				if ( pro1 == '' ) {
					document.getElementById('pError').innerHTML = 'Debe seleccionar un responsable, quien estará a cargo de la actividad que esta programando.';
					document.getElementById('divError').style.display = 'block';
					todoBien = false;
				}
				if ($('#fechaInicio').val() === $('#fechaFin').val() ) {
					var i = moment($('#horaInicio').val(),'HH:mm A');
					var f = moment($('#horaFin').val(),'HH:mm A');
					if( f.diff(i) < 0){
						document.getElementById('horasError').style.display = 'block';
						todoBien = false;
					}
				}
				break;
		}
		return todoBien;
	}
	function seleccionarCero(){
		$("#selectIdTipoActividad option:first").attr('selected', 'selected');
	}
</script>

<style type="text/css">
	.table-fixed{
		height: 100px;
	}
	textarea{
		resize: none;
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
