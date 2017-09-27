@extends('layouts.admin', ['titulo' => 'Pregunta de la encuesta', 'nombreTabla' => '', 'item' => 'encuTodas'])
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Pregunta: </h3>
			<h4>{{$preguntaEncuesta->enunciado}}</h4>
			@if($errors->any())
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
		{!!Form::model($preguntaEncuesta,['method'=>'PATCH','route'=>['preguntaEncuesta.update',$preguntaEncuesta->idPreguntaEncuesta]])!!}
		{{Form::token()}}
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="enunciado">Enunciado</label>
					<input type="text" name="enunciado"  required value ="{{$preguntaEncuesta->enunciado}}" class="form-control">
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
