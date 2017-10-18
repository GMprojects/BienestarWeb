@extends('template')
@section('contenido')
	<div  class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Persona</h3>
			@if (count($errors) >0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

	{!!Form::model($recomendaciontutor,['method'=>'PATCH','route'=>["recomendaciontutor.update",$recomendaciontutor->idTabla1]])!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Situacion especifica</label>
				<input type="text" name="situacionEspecifica"  value="{{$recomendaciontutor->situacionEspecifica}}" class="form-control" placeholder="situacion...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="apellidoPaterno">Recomendacion</label>
				<input type="text" name="recomendacion"  value="{{$recomendaciontutor->recomendacion}}" class="form-control" placeholder="recomendacion...">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
@endsection
