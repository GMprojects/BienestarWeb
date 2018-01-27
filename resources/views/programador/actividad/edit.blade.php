@extends('template')
@section('contenido')
@include('programador.actividad.modalAyuda')

{!! Form::model($actividad, ['method'=>'PATCH', 'route'=>['actividad.update', $actividad->idActividad], 'files'=>'true', 'onsubmit'=>'return validar()']) !!}
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
               <label for="titulo">Título de la actividad </label><span class="ast">*</span>
               <input type="text" name="titulo" class="form-control"  required value ="{{$actividad->titulo}}" placeholder="De preferencia un título corto y llamativo">
            </div>

				<div class="form-group">
					<label for="idTipoActividad">Categoría </label>&nbsp; &nbsp;&nbsp; &nbsp;
					<span style="color: #4B367C;"> <b>{{ $actividad->tipoActividad->tipo }}</b> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;</span>
					<label >Modalidad </label>&nbsp; &nbsp;&nbsp; &nbsp;
					@if ($actividad->idTipoActividad < 8 ||$actividad->idTipoActividad > 9)
						@if ($actividad->modalidad == '1')
								<span class="label ff-bg-aqua">INDIVIDUAL</span>
						@else
								<span class="label ff-bg-green2">GRUPAL</span>
						@endif
					@else
						<span class="label ff-bg">LIBRE</span>
					@endif
				</div>

				<div class="form-group">
				  <label for="titulo">Descripción </label><span class="ast">*</span>
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
				<div class="pull-left">
					<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> Volver</button>
				</div>
				<div class="pull-right">
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Publicar</button>
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
								<input type="text" name="fechaInicio" class="form-control" required  value="{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}" id="fechaInicio">
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
									<input type="text" name="horaInicio"  id="horaInicio"   required value="{{ date('g:i A',strtotime($actividad->horaInicio)) }}" class="form-control timepicker" id="timepicker1">
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
								<input type="text" name="fechaFin" class="form-control" required  value="{{ date("d/m/Y",strtotime($actividad->fechaFin)) }}" id="fechaFin">
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
									<input type="text" name="horaFin"  id="horaFin"   required value="{{ date('g:i A',strtotime($actividad->horaFin)) }}" class="form-control timepicker" id="timepicker2">
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
				<div id="divError" class="alert alert-danger" style='display:none;'>
						<p id="pError">Debe elegir a un docente para que sea tutor</p>
				</div>
				<div id="selectResponsables" style='display:none;'>
					<div class="form-group">
						<label for="idUserResp" id="etiquetaResponsable">Responsable </label><span class="ast">*</span>
						<select name="idUserResp" id="selectIdResponsable" onchange="ocultar()" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
						<a id="enlaceRespInvitado" onclick="mostrarNuevoResponsable()" style='display:none;'>Añadir Responsable Invitado</a>
					</div>
				</div>
				<div id="selectAlumnos" style='display:none;'>
					<div class="form-group">
						<label id="lbAlumno" for="idAlumnoI">Alumno </label><span class="ast">*</span>
						<select name="idAlumno" id="selectIdAlumno" onchange="ocultar()" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
					</div>
				</div>
				<div id="selectAlumnosTutorados" style='display:none;'>
					<div class="form-group">
						<label for="idAlumnoTutorado">Tutorados </label><span class="ast">*</span>
						<select name="idAlumnoTutorado[]" id="selectIdAlumnoTutorado" onchange="ocultar()" class="selectpicker form-control" multiple title="Selecciona Tutorado.."data-size="15" data-live-search="true" data-show-subtext="true"> </select>
					</div>
				</div>
				<div id="divNoHayTutor" class="callout callout-danger" style='display:none;'>
		         <h4>Tutores</h4>
		         <p id="mensajeTutor">No hay tutor dentro del bla bla.</p>
         	</div>
				@if ($actividad->cuposTotales != 1)
				<div id="divCuposTotales" style='display:none;'>
					<div class="form-group">
						<label for="cuposTotales">N° Cupos </label><span class="ast">*</span>
							<input type="number" id="cuposTotales" min="2" name="cuposTotales" class="form-control" value ="{{ $actividad->cuposTotales }}">
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="caja" id="boxResponsableInvitado" style='display:none;'>
			<div class="caja-header">
				<div class="caja-icon">5</div>
				<div class="caja-title"> Responsable Invitado </div>
				<div class="caja-tools">
					<button type="button" class="btn btn-caja" onclick="ocultarNuevoResponsable()"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="caja-body">
				<div id="respError" class="alert alert-danger" style='display:none;'>
						<p>Debe registrar todos los datos del responsable invitado, sino exite un invitdo cerrar la caja <b>Responsable Invitado</b>.</p>
				</div>
				@if ($actividad->invitado != null)
					<div class="form-group">
					  <label for="nombreResponsable">Nombres </label><span class="ast">*</span>
					  <input type="text" id="nombreResponsable" name="nombreResponsable" value="{{ preg_split("/[-]/",$actividad->invitado)[0] }}" class="form-control" placeholder="Nombres">
				  </div>
				  <div class="form-group">
					  <label for="apellidosResponsable">Apellidos </label><span class="ast">*</span>
					  <input type="text" id="apellidosResponsable" name="apellidosResponsable" value="{{ preg_split("/[-]/",$actividad->invitado)[1] }}" class="form-control" placeholder="Apellidos">
				  </div>
				  <div class="form-group">
					  <label for="emailResponsable">Correo </label><span class="ast">*</span>
					  <input type="email" id="emailResponsable" name="emailResponsable" value="{{ preg_split("/[-]/",$actividad->invitado)[2] }}" class="form-control" placeholder="xxx@xxx.xx">
				  </div>
				@else
					<div class="form-group">
					  <label for="nombreResponsable">Nombres </label><span class="ast">*</span>
					  <input type="text" id="nombreResponsable" name="nombreResponsable" class="form-control" placeholder="Nombres">
				  </div>
				  <div class="form-group">
					  <label for="apellidosResponsable">Apellidos </label><span class="ast">*</span>
					  <input type="text" id="apellidosResponsable" name="apellidosResponsable" class="form-control" placeholder="Apellidos">
				  </div>
				  <div class="form-group">
					  <label for="emailResponsable">Correo </label><span class="ast">*</span>
					  <input type="email" id="emailResponsable" name="emailResponsable" class="form-control" placeholder="xxx@xxx.xx">
				  </div>
				@endif
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
	var llenarInvitado = false;

	console.log(llenarInvitado);

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
	$(document).ready(function(){
		document.getElementById('boxDatosEspecificos').style.display = 'block';
      console.log("elegir actividad");
		//ATENCIÓN MÉDICA       PSICOLOGÍA
		if ({{ $actividad->idTipoActividad }} == '1' || {{ $actividad->idTipoActividad }} == '2') {
			console.log("1-2");
			document.getElementById('divFechaFin').style.display = 'none';
			document.getElementById('divHoraFin').style.display = 'none';

			document.getElementById('selectAlumnos').style.display = 'block';
			dListaAlumnos('{{ action('UserController@getAlumnos') }}','Alumno');

			$('#fechaFin').removeAttr('required');
			$('#horaFin').removeAttr('required');
			//SERVICIO SOCIAL
		}else if ({{ $actividad->idTipoActividad }} == '3') {
			document.getElementById('selectResponsables').style.display = 'block';
			dListaResponsables('{{ action('UserController@getUsersAdm') }}','Responsable');
			if ('{{ $actividad->cuposTotales }}' == 1) {//INDIVIDUAL
				document.getElementById('selectAlumnos').style.display = 'block';
				dListaAlumnos('{{ action('UserController@getAlumnos') }}','Alumno');
			} else {//GRUPAL
				document.getElementById('divCuposTotales').style.display = 'block';
			}

			$('#fechaFin').removeAttr('required');
			$('#horaFin').removeAttr('required');
			//TUTORIA
		}else if ({{ $actividad->idTipoActividad }} == '4') {
			document.getElementById('selectResponsables').style.display = 'block';
			document.getElementById('selectAlumnosTutorados').style.display = 'block';
			document.getElementById('etiquetaResponsable').innerHTML = 'Tutor';
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
					if(data.length == 0){
 					   document.getElementById('divNoHayTutor').style.display = 'block';
 					   document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+"{{(String)$semestre}}"+'.';
 						$('#modal-errorTut').modal('show');
 				  }else {
							for (var i = 0; i < data.length; i++) {
								if({{ count($actividad->inscripcionesADA) }} !=0 ){
									{{--console.log(data[i].idAlumno);console.log({{ $idAlumnos["0"]}});--}}
										if(in_array(data[i].idAlumno, {{ $idAlumnos }})){
											op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
										}else{
											op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
										}
								}
								$("#selectIdAlumnoTutorado").append(op);
							}
							$("#selectIdAlumnoTutorado").selectpicker("refresh");
					}
				},
				error:function() {
						console.log("Error ");
				}
			});

			$('#fechaFin').removeAttr('required');
			$('#horaFin').removeAttr('required');
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
				 llenarInvitado = true;
			}
			dListaResponsables('{{ action('UserController@getUsers') }}','Responsable');

			$('#cuposTotales').attr('required', 'true');
			$('#fechaFin').attr('required', 'true');
			$('#horaFin').attr('required', 'true');

			//MOVILIDAD
		}else if ({{ $actividad->idTipoActividad }} == '8' || {{ $actividad->idTipoActividad }} == '9') {
			document.getElementById('selectResponsables').style.display = 'block';
			document.getElementById('lblFechaInicio').innerHTML = 'Inicio de la Convocatoria';
			document.getElementById('lblFechaFin').innerHTML = 'Fin de la Convocatoria';

			dListaResponsables('{{ action('UserController@getUsersAdm') }}','Responsable');

			$('#fechaFin').attr('required', 'true');
			$('#horaFin').attr('required', 'true');

			//REFORZAMIENTO
		}else if ({{ $actividad->idTipoActividad }} == '10'){
			document.getElementById('selectResponsables').style.display = 'block';
			dListaResponsables('{{ action('UserController@getUsers') }}','Responsable');
			document.getElementById('enlaceRespInvitado').style.display = 'block';
			if ('{{ $actividad->cuposTotales }}' == 1) {//INDIVIDUAL
				document.getElementById('selectAlumnos').style.display = 'block';
				dListaAlumnos('{{ action('UserController@getAlumnos') }}','Alumno');
			} else {//GRUPAL
				document.getElementById('divCuposTotales').style.display = 'block';
			}
			if ( ('{{ $actividad->invitado }}') != '' ) {
				 console.log("tamaño de "+('{{ $actividad->invitado }}').length);
	          document.getElementById('boxResponsableInvitado').style.display = 'block';
				 var invitado = ('{{ $actividad->invitado }}').split("-");
				 $('#nombreResponsable').attr('value', invitado[0]);
	          $('#apellidosResponsable').attr('value', invitado[1]);
	          $('#emailResponsable').attr('value', invitado[2]);
				 llenarInvitado = true;
			}

			$('#fechaFin').attr('required', 'true');
			$('#horaFin').attr('required', 'true');

		}else{
			document.getElementById('divCuposTotales').style.display = 'block';
			document.getElementById('selectResponsables').style.display = 'block';
			document.getElementById('enlaceRespInvitado').style.display = 'block';
			dListaResponsables('{{ action('UserController@getUsers') }}','Responsable');
			if ( ('{{ $actividad->invitado }}') != '' ) {
				 console.log("tamaño de "+('{{ $actividad->invitado }}').length);
	          document.getElementById('boxResponsableInvitado').style.display = 'block';
				 var invitado = ('{{ $actividad->invitado }}').split("-");
				 $('#nombreResponsable').attr('value', invitado[0]);
	          $('#apellidosResponsable').attr('value', invitado[1]);
	          $('#emailResponsable').attr('value', invitado[2]);
			}

			$('#cuposTotales').attr('required', 'true');
			$('#fechaFin').attr('required', 'true');
			$('#horaFin').attr('required', 'true');

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
		var tamSelectIdAlumno=document.getElementById("selectIdAlumno").length;
		if(tamSelectIdAlumno>0){
			$("#selectIdAlumno").children('option').remove();
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
	          $("#selectIdAlumno").append(op);
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
		            $("#selectIdAlumno").append(op);
	          }
	          $("#selectIdAlumno").selectpicker("refresh");
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
			var tamSelectIdAlumno=document.getElementById("selectIdAlumno").length;
			if(tamSelectIdAlumno>0){
				$("#selectIdAlumno").children('option').remove();
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
		llenarInvitado = true;
		console.log(llenarInvitado);
		document.getElementById('boxResponsableInvitado').style.display = 'block';
	}

	function ocultarNuevoResponsable(){
		llenarInvitado = false;
		console.log(llenarInvitado);
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
					break;
				case 2:
							document.getElementById('divCuposTotales').style.display = 'block';
					break;
				default:
			}
	}

	function ocultar(){
		document.getElementById('divError').style.display = 'none';
	}

	function validar(){
		var todoBien = true;
		switch ('{{ $actividad->idTipoActividad }}') {
			case '1'://ATENCIÓN MÉDICA
			case '2'://PSICOLOGÍA
				var selectIdAlumno = document.getElementById('selectIdAlumno');
				var pro = selectIdAlumno.options[selectIdAlumno.selectedIndex].value;
				if ( pro == '') {
					document.getElementById('pError').innerHTML = 'Debe seleccionar un alumno para quien será la actividad que esta programando.';
					document.getElementById('divError').style.display = 'block';
					todoBien = false;
				}
				//document.getElementById('selectIdAlumno').style.display = 'block';
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
				var pro1 = selectIdResponsable.options[selectIdResponsable.selectedIndex].value;
				if(selectIdResponsable.options.length == 0){
					document.getElementById('pError').innerHTML = 'Antes de publicar se deben registrar tutores en el semestre académico.'+"{{(String)$semestre}}"+'.'
					document.getElementById('divError').style.display = 'block';
					todoBien = false;
				}else{
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
				console.log(llenarInvitado);
				if(llenarInvitado){
					console.log(nombreResponsable);
					if(nombreResponsable == '' || apellidosResponsable == '' || emailResponsable == ''){
							document.getElementById('respError').style.display = 'block';
							console.log(nombreResponsable);
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
	.ast{
		color: red;
		font-size: 20px;
	}
</style>

@endsection
