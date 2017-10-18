@extends('template')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Encuesta </h3>
			@if(count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
						<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
	</div>
{!!Form::open(['url'=>'admin/encuesta','method'=>'POST','autocomplete'=>'off'])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="titulo">Título</label>
			<input type="text" name="titulo"  required value ="{{old('titulo')}}" class="form-control" placeholder="Título">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		 <div class="form-group">
			<label for="idTipoActividad">Tipo de Actividad</label>
			<select name="idTipoActividad" class="form-control">
				@foreach($tiposActividad as $tipo)
					<option value="{{$tipo->idTipoActividad}}">{{$tipo->tipo}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		 <div class="form-group">
			<label for="destino">Destino</label>
			<select name="destino" class="form-control">
					<option value="r">Responsable</option>
					<option value="i">Inscrito</option>
			</select>
		</div>
	</div>
</div>
<div class="form-group">
	<button class="btn btn-primary" type="submit">Guardar</button>
	<button class="btn btn-danger" type="reset">Cancelar</button>
</div>
{!!Form::close()!!}
@endsection
