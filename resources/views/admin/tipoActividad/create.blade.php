@extends('layouts.admin', ['titulo' => 'Tipos de Actividades', 'nombreTabla' => '', 'item' => 'actiTipos'])
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Tipo de Actividad</h3>
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(['url'=>'admin/tipoActividad', 'method'=>'POST', 'autocomplete'=>'off']) !!}
				{{ Form::token() }}

					<div class="form-group">
						<label for="tipo">Tipo</label>
						<input type="text" name="tipo" class="form-control" placeholder="Tipo...">
					</div>

					<div class="form-group">
						<label for="rutaImagen">Ruta</label>
						<input type="file" name="rutaImagen" class="form-control" placeholder="Ruta...">
					</div>

					<div>
						<button class="btn btn-primary" type="submit"> Guardar</button>
						<button class="btn btn-danger" type="reset"> Cancelar</button>
					</div>

			{!! Form::close() !!}

		</div>
	</div>
@endsection
