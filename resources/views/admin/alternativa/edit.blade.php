@extends('template')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6" col-md-6 col-sm-6 col-xs-12>
			<h3>Editar Alternativa: </h3>
			<h4>{{$alternativa->etiqueta}}</h4>
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
		{!!Form::model($alternativa,['method'=>'PATCH','route'=>['alternativa.update',$alternativa->idAlternativa]])!!}
		{{Form::token()}}
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="etiqueta">Etiqueta</label>
					<input type="text" name="etiqueta"  required value ="{{$alternativa->etiqueta}}" class="form-control">
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
