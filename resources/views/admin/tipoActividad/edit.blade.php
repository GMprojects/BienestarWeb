@extends('template')
@section('contenido')
{!! Form::model($tipoActividad, ['method'=>'PATCH', 'route'=>['tipoActividad.update', $tipoActividad->idTipoActividad], 'files'=>'true', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}
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
         <div class="caja-title">Datos de la Categoría</div>
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
				@if ( $tipoActividad->idTipoActividad < 11 )
					<input type="text" required readonly onclick="visualizarMensaje()"name="tipo" value="{{ $tipoActividad->tipo }}" class="form-control" placeholder="Nombre">
				@else
					<input type="text" required name="tipo" value="{{ $tipoActividad->tipo }}" class="form-control" placeholder="Nombre">
				@endif
			</div>
			<span class="help-block"  style='display:none;' id="spanErrorTipo">
				<strong style="color:red;"><p id="pErrorTipo">Esta es una categoría por defecto, no puede editar el campo nombre.</p></strong>
			</span>
			<div class="form-group">
				<label for="tipo">Que usuario puede ser el responsable</label>
				<br>
				@if ($tipoActividad->idTipoActividad != 4)
					@if (stripos($tipoActividad->responsable,'1')!==false)
						<input type="checkbox" checked name="responsableA1" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@else
						<input type="checkbox" name="responsableA1" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@endif
					@if (stripos($tipoActividad->responsable,'2')!==false)
						<input type="checkbox" checked name="responsableA2" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@else
						<input type="checkbox" name="responsableA2" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@endif
					@if (stripos($tipoActividad->responsable,'3')!==false)
						<input type="checkbox" checked name="responsableA3" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Administrativos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@else
						<input type="checkbox" name="responsableA3" onchange="ocultarResponsable()" class="iResponsable"> &nbsp; Administrativos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@endif
				@else
					<b style="color:red;">Exclusivo de Tutores</b>
				@endif
			</div>
			<span class="help-block"  style='display:none;' id="spanErrorResponsable">
				<strong style="color:red;"><p id="pErrorResponsable"></p></strong>
			</span>
			<div class="form-group">
				<label for="tipo">Dirigido a</label>
				<br>
				@if ($tipoActividad->idTipoActividad != 3 && $tipoActividad->idTipoActividad != 10)
					@if (stripos($tipoActividad->dirigidoA,'1')!==false)
						<input type="checkbox" checked name="dirigidoA1" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@else
						<input type="checkbox" name="dirigidoA1" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@endif
					@if (stripos($tipoActividad->dirigidoA,'2')!==false)
						<input type="checkbox" checked name="dirigidoA2" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@else
						<input type="checkbox" name="dirigidoA2" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@endif
					@if (stripos($tipoActividad->dirigidoA,'3')!==false)
						<input type="checkbox" checked name="dirigidoA3" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Administrativos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@else
						<input type="checkbox" name="dirigidoA3" onchange="ocultarDirigidoA()" class="iDirigidoA"> &nbsp; Administrativos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@endif
				@else
					<b style="color:red;">Exclusivo de Alumnos</b>
				@endif
			</div>
			<span class="help-block"  style='display:none;' id="spanErrorDirigidoA">
				<strong style="color:red;"><p id="pErrorDirigidoA"></p></strong>
			</span>
			<div class="form-control-file">
				<label for="rutaImagen">Imagen</label>

				<input type="file"  name="rutaImagen" class="form-control dropify"  data-allowed-file-extensions="png jpg jpge" data-default-file="{{ asset('storage/'.$tipoActividad['rutaImagen']) }}"  data-disable-remove="true">
			</div>
		</div><br><br>
		<div class="caja-footer">
			<div class="pull-right">
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}

	<script type="text/javascript">
		$(document).ready(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
				increaseArea: '20%' // optional
			});
			$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
		});
		function visualizarMensaje(){
			document.getElementById('spanErrorTipo').style.display = 'block';
		}

		function ocultarDirigidoA(){
			console.log('ocultarDirigidoA');
			document.getElementById('spanErrorDirigidoA').style.display = 'none';
		}

		function ocultarResponsable(){
			console.log('ocultarResponsable');
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
			return todoBien;
		}

	</script>
@endsection
