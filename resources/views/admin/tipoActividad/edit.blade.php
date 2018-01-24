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
			<div id="divError" class="alert alert-danger" style='display:none;'>
					<h4><b>Error</b></h4>
					<p id="pError">Mensaje</p>
			</div>
			<div class="form-group">
				<label for="tipo">Nombre Categoría</label>
				@if ( $tipoActividad->id < 11)
					<input type="text" required readonly onclick="visualizarMensaje()"name="tipo" value="{{ $tipoActividad->tipo }}" class="form-control" placeholder="Nombre">
				@else
					<input type="text" required name="tipo" value="{{ $tipoActividad->tipo }}" class="form-control" placeholder="Nombre">
				@endif
			</div>
			<div class="form-group">
				<label for="tipo">Dirigido a</label>
				<br>

				@if (strlen($tipoActividad->dirigidoA) == 1)
					@switch($tipoActividad->dirigidoA[0])
						@case('1')
							<input type="checkbox" checked name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
						@break
						@case('2')
							<input type="checkbox" name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" checked name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
						@break
						@case('3')
							<input type="checkbox" name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" checked name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
						@break
					@endswitch
				@elseif (strlen($tipoActividad->dirigidoA) == 2)
					@if ($tipoActividad->dirigidoA[0] == 1 && $tipoActividad->dirigidoA[1] == 2)
						<input type="checkbox" checked name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" checked name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
					@elseif ($tipoActividad->dirigidoA[0] == 1 && $tipoActividad->dirigidoA[1] == 3)
						<input type="checkbox" checked name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" checked name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
					@else{{-- 2 y 3 --}}
						<input type="checkbox" name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" checked name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" checked name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
					@endif
				@else
					<input type="checkbox" checked name="dirigidoA1" onchange="ocultar()" class="minimal"> &nbsp; Alumnos  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" checked name="dirigidoA2" onchange="ocultar()" class="minimal"> &nbsp; Docentes  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" checked name="dirigidoA3" onchange="ocultar()" class="minimal"> &nbsp; Administrativos
				@endif
			</div>
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
	<div class="modal fade" id="modal-ayuda">
		 <!-- /.modal-dialog -->
		 <div class="modal-dialog">
			   <!-- /.modal-content -->
			   <div class="modal-content">
			        <div class="modal-header" style="background-color:red; color:white; border-radius:6px 6px 0px 0px;">
				          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            <span aria-hidden="true"  class="fa fa-remove"></span></button>
				          <h4 class="modal-title"  style="color:white;"><i class="fa fa-warning"></i>&nbsp; &nbsp;<b>Error</b></h4>
			        </div>
			        <div class="modal-body">
			          	<p> Esta es una categoría por defecto, no puede editar el campo nombre.</p>
			        </div>
			        <div class="modal-footer">
							  <div class="pull-right">
								  <button class="btn btn-ff-default" type="button"  onclick="seleccionarCero()" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
							  </div>
			        </div>
			   </div>
		      <!-- /.modal-content -->
		 </div>
	    <!-- /.modal-dialog -->
	</div>

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
			$('#modal-ayuda').modal('show');
		}
	</script>
@endsection
