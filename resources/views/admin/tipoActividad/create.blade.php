@extends('template')
@section('contenido')

	{!! Form::open(['url'=>'admin/tipoActividad', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true', 'onsubmit'=>'return validar()']) !!}
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
			<div id="divError" class="alert alert-danger" style='display:none;'>
					<h4><b>Error</b></h4>
					<p id="pError">Mensaje</p>
			</div>
			<div class="form-group">
				<label for="tipo">Nombre Categoría</label>
				<input type="text" required name="tipo" class="form-control" placeholder="Nombre">
			</div>
			<div class="form-group">
				<label for="tipo">Dirigido a</label>
				<br>
				<input type="checkbox" name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
			</div>
			<div class="form-control-file">
				<label for="rutaImagen">Imagen</label>
				<input type="file" required name="rutaImagen" class="form-control dropify"  data-allowed-file-extensions="png jpg jpge"  data-disable-remove="true">
			</div>
		</div>
		<div class="caja-footer">
			<div class="pull-right">
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
			</div>
		</div>
	</div>
	{!! Form::close() !!}

<script type="text/javascript">

	function ocultar(){
		document.getElementById('divError').style.display = 'none';
	}

	function validar(){
		var todoBien = true;
		if ($('input[type=checkbox]').is(':checked')) {
		} else {
			document.getElementById('pError').innerHTML = 'Debe dirigir las actividad de esta categoría a al menos uno';
			document.getElementById('divError').style.display = 'block';
			todoBien = false;
		}
		return todoBien;
	}
</script>
@endsection
