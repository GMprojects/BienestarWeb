@extends('template')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Tipo de Persona</h3>
			@if($errors->any())
			<div class="alert alert-danger" >
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
			{!!Form::open(['url'=>'admin/tipoPersona','method'=>'POST','autocomplete'=>'off'])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="tipo"> Tipo de Persona	</label>
				<input type="text" name="tipo" class="form-control" placeholder="Tipo de Persona">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
