@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Pregunta: </h3>
			<h4>{{$preguntaHabito->enunciado}}</h4>
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
		{!!Form::model($preguntaHabito,['method'=>'PATCH','route'=>['preguntaHabito.update',$preguntaHabito->idPreguntaHabito],'files'=>'true'])!!}
		{{Form::token()}}
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="enunciado">Enunciado</label>
					<input type="text" name="enunciado"  required value ="{{$preguntaHabito->enunciado}}" class="form-control">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				 <div class="form-group">
					<label for="idTipoHabito">Tipo de Hábito</label>
					<select name="idTipoHabito" class="form-control">
						@foreach($tiposHabito as $tipo)
							@if($tipo->idTipoHabito==$preguntaHabito->idTipoHabito)
								<option value="{{$tipo->idTipoHabito}}" selected>{{$tipo->tipo}}</option>
							@else
								<option value="{{$tipo->idTipoHabito}}" >{{$tipo->tipo}}</option>
							@endif
						@endforeach
					</select>
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
