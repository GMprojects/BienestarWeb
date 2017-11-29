@extends('template')
@section('contenido')
	{!! Form::model($tipoActividad, ['method'=>'PATCH', 'route'=>['tipoActividad.update', $tipoActividad->idTipoActividad], 'files'=>'true', 'onsubmit'=>'return validar()']) !!}
	{{ Form::token() }}
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
				<input type="text" required name="tipo" value="{{ $tipoActividad->tipo }}" class="form-control" placeholder="Nombre">
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

				<input type="file" required name="rutaImagen" class="form-control dropify"  data-allowed-file-extensions="png jpg jpge" data-default-file="{{ asset('storage/'.$tipoActividad['rutaImagen']) }}"  data-disable-remove="true">
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
@endsection
