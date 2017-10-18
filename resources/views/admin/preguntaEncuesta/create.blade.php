@extends('template')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Pregunta:</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger" >
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
	<div>
		{!!Form::open(['url'=>'admin/preguntaEncuesta','method'=>'POST','autocomplete'=>'off'])!!}
		{{Form::token()}}
		<input type="hidden" name="idEncuesta"  value ="{{$idEncuesta}}" >
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="enunciado">Enunciado</label>
					<input type="text" name="enunciado"  required value ="{{old('enunciado')}}" class="form-control" placeholder="Enunciado">
				</div>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
		</div>
		{!!Form::close()!!}
	</div>
@endsection
