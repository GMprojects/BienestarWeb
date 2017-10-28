@extends('template')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar trabajo del egresado
				{{ $trabajo->egresado['nombres'] }}
				{{ $trabajo->egresado['apellidoPaterno'] }}
				{{ $trabajo->egresado['apellidoMaterno'] }}
			</h3>
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
	</div>
	<div>
		{!! Form::model($trabajo, ['method'=>'PATCH', 'route'=>['trabajo.update', $trabajo->idTrabajo]]) !!}
			{{ Form::token() }}
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="institucion">Institución</label>
						<input type="text" name="institucion" class="form-control" value ="{{ $trabajo->institucion }}" placeholder="Institución...">
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="lugar">Lugar</label>
						<input type="text" name="lugar" class="form-control" value ="{{ $trabajo->lugar }}" placeholder="Lugar...">
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="fechaInicio">Fecha Inicio</label>
						<input type="date" name="fechaInicio" min="2000-12-31" class="form-control" value ="{{ $trabajo->fechaInicio }}" placeholder="Fecha de Inicio...">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="fechaFin">Fecha Fin</label>
						<input type="date" name="fechaFin" min="2000-12-31" class="form-control" value ="{{ $trabajo->fechaFin }}" placeholder="Fecha de Fin...">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="nivelSatisfaccion">Nivel de Satisfacción</label>
						<input type="text" name="nivelSatisfaccion" class="form-control" value ="{{ $trabajo->nivelSatisfaccion }}" placeholder="Nivel de Satisfacción...">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="recomendaciones">Recomendaciones</label>
						<input type="text" name="recomendaciones" class="form-control" value ="{{ $trabajo->recomendaciones }}" placeholder="Recomendaciones...">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="observaciones">Observaciones</label>
						<input type="text" name="observaciones" class="form-control" value ="{{ $trabajo->observaciones }}" placeholder="Observaciones...">
					</div>
				</div>
			</div>
			<div>
				<button class="btn btn-primary" type="submit"> Guardar</button>
				<button class="btn btn-danger" type="reset"> Cancelar</button>
			</div>
			{!! Form::close() !!}
		</div>
@endsection
