@extends('template')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Tipo de Hábito</h3>
			@if($errors->any())
			<div class="alert alert-danger" >
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
			{!!Form::open(['url'=>'admin/tipoHabito','method'=>'POST','autocomplete'=>'off'])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="tipo"> Tipo de Hábito	</label>
				<input type="text" name="tipo" class="form-control" placeholder="Tipo de Hábito">
			</div>
			<div class="pull-right">
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> Volver</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
