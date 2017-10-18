@extends ('template')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>
				Editar Encuesta de {{ $encuesta->tipoActividad['tipo'] }} para el
				@if($encuesta->destino === 'r')
					Responsable
				@else
					Inscrito
				@endif
		</h3>
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
		{!!Form::model($encuesta,['method'=>'PATCH','route'=>['encuesta.update',$encuesta->idEncuesta]])!!}
		{{Form::token()}}
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
						<label for="titulo">Titulo</label>
						<input type="text" name="titulo"  required value ="{{$encuesta->titulo}}" class="form-control">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				 <div class="form-group">
					<label for="idTipoActividad">Tipo de Actividad</label>
					<select name="idTipoActividad" class="form-control">
						@foreach($tiposActividad as $tipo)
							@if($tipo->idTipoActividad==$encuesta->idTipoActividad)
								<option value="{{$tipo->idTipoActividad}}" selected >{{$tipo->tipo}}</option>
							@else
								<option value="{{$tipo->idTipoActividad}}" >{{$tipo->tipo}}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				 <div class="form-group">
					<label for="destino">Destino</label>
					<select name="destino" class="form-control">
						@if($encuesta->destino=='r')
							<option value="r" selected >Responsable</option>
							<option value="i" >Inscrito</option>
						@else
							<option value="r"  >Responsable</option>
							<option value="i" selected>Inscrito</option>
						@endif
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
