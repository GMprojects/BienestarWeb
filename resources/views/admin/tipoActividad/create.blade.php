@extends('template')
@section('contenido')

{!! Form::open(['url'=>'admin/tipoActividad', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true', 'onsubmit'=>'return validar()']) !!}

<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 70px;">
	<div class="caja">
      <div class="caja-header">
         <div class="caja-icon">1</div>
         <div class="caja-title">Datos de Nueva Categoría</div>
      </div>
      <div class="caja-body">
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form-group">
				<label for="tipo">Nombre Categoría</label>
				<input type="text" required name="tipo" class="form-control" onkeypress="return soloLetras(event)" placeholder="Nombre">
			</div>
			<div class="form-group">
				<label for="tipo">Que usuario puede ser el responsable</label>
				<br>
				<input type="checkbox" name="responsableA1" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="responsableA2" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="responsableA3" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Administrativos
			</div>
			<span class="help-block"  style='display:none;' id="spanErrorResponsable">
				<strong style="color:red;"><p id="pErrorResponsable"></p></strong>
			</span>
			<div class="form-group">
				<label for="tipo">Dirigido a</label>
				<br>
				<input type="checkbox" name="dirigidoA1" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="dirigidoA2" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="dirigidoA3" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Administrativos
			</div>
			<span class="help-block"  style='display:none;' id="spanErrorDirigidoA">
				<strong style="color:red;"><p id="pErrorDirigidoA"></p></strong>
			</span>
			<div class="form-control-file">
				<label for="rutaImagen">Imagen</label>
				<input type="file" required name="rutaImagen" class="form-control dropify" data-height="200" data-allowed-file-extensions="png jpg jpge" data-max-file-size="4M" data-errors-position="outside" data-show-remove="true">
			</div>
		</div><br><br>
		<div class="caja-footer">
			<div class="pull-right">
				<!--<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>-->
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}

<script type="text/javascript">
	var imagenCorrecta = true;
	$(document).ready(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
			increaseArea: '20%' // optional
		});
		$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
		imagenCorrecta = true;
	});
	/* PLUGIN - Dropify*/
	$('.dropify').dropify({
	 messages: {
		  'default': 'Click o arrastrar y soltar',
		  'replace': 'Click o arrastrar y soltar',
		  'remove':  'Quitar',
		  'error':   'Ops! algo anda mal con el archivo'
	 },
	 error: {
		'fileSize': 'El tamaño de la imagen es muy grande (máx. 4MB).',
		'fileExtension': 'Formato de Imagen no permitido (sólo .png .jpg .jpeg).'
	 }
	});
	var drEvent = $('.dropify').dropify();
	drEvent.on('dropify.error.fileSize', function(event, element){
		imagenCorrecta = false;
		console.log('fileSize - ERROR  '+imagenCorrecta);
	});
	drEvent.on('dropify.error.fileExtension', function(event, element){
		imagenCorrecta = false;
		console.log('fileSize - ERROR  '+imagenCorrecta);
	});
	drEvent.on('dropify.fileReady', function(event, element){
		imagenCorrecta = true;
		console.log('fileReady - '+imagenCorrecta);
	});
	drEvent.on('dropify.beforeClear', function(event, element){
		imagenCorrecta = false;
		console.log('beforeClear - '+imagenCorrecta);
	});
	/* FIN PLUGIN - Dropify*/
	function soloLetras(evento){
		if ((evento.charCode >= 65 && evento.charCode <= 90) ||
			 (event.charCode >= 97 && event.charCode <= 122) ||
			 (event.charCode == 225) || (event.charCode == 193) || //á Á
			 (event.charCode == 233) || (event.charCode == 201) || //é É
			 (event.charCode == 237) || (event.charCode == 205) || //í Í
			 (event.charCode == 243) || (event.charCode == 211) || //ó Ó
			 (event.charCode == 250) || (event.charCode == 218) || //ú Ú
			 (event.charCode == 32)) {
			return true;
		}
		return false;
	}

	function ocultarDirigidoA(){
		document.getElementById('spanErrorDirigidoA').style.display = 'none';
	}

	function ocultarResponsable(){
		document.getElementById('spanErrorResponsable').style.display = 'none';
	}

	function validar(){
		var todoBien = true;
		if (!$('.iDirigidoA').is(':checked')) {
			document.getElementById('pErrorDirigidoA').innerHTML = 'Debe dirigir las actividad de esta categoría a al menos un tipo de usuario';
			document.getElementById('spanErrorDirigidoA').style.display = 'block';
			todoBien = false;
		}
		if (!$('.iResponsable').is(':checked')) {
			document.getElementById('pErrorResponsable').innerHTML = 'Debe seleccionar que tipos de usuario pueden ser responsables de este tipo de actividades.';
			document.getElementById('spanErrorResponsable').style.display = 'block';
			todoBien = false;
		}
		if (!imagenCorrecta) {
			todoBien = false;
		}
		return todoBien;
	}
</script>
@endsection
