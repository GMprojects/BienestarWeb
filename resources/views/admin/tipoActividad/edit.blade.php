@extends('layouts.admin', ['titulo' => 'Editar tipo de Actividad', 'nombreTabla' => '', 'item' => 'actiTipos'])
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Tipo de Actividad {{ $tipoActividad->tipo }}</h3>
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($tipoActividad, ['method'=>'PATCH', 'route'=>['tipoActividad.update', $tipoActividad->idTipoActividad]]) !!}
				{{ Form::token() }}

					<div class="form-group">
						<label for="tipo">Tipo</label>
						<input type="text" name="tipo" class="form-control" value="{{ $tipoActividad->tipo }}" placeholder="Tipo...">
					</div>

					<div class="form-group">
						<label for="rutaImagen">Ruta</label>
						<input type="text" name="rutaImagen" class="form-control" value="{{ $tipoActividad->rutaImagen }}" placeholder="Ruta...">
					</div>

					<div>
						<button class="btn btn-primary" type="submit"> Guardar</button>
						<button class="btn btn-danger" type="reset"> Cancelar</button>
					</div>

			{!! Form::close() !!}

		</div>
	</div>
@endsection
