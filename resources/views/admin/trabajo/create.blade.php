@extends('template')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Trabajo</h3>
			 @if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(['url'=>'admin/trabajo', 'method'=>'POST', 'autocomplete'=>'off']) !!}
			{{ Form::token() }}
					<input type="hidden" name="idEgresado"  value ="{{$idEgresado}}" >

					<div class="form-group">
						<label for="institucion">Institución</label>
						<input type="text" name="institucion" class="form-control" value ="{{old('institucion')}}" placeholder="Institución...">
					</div>

					<div class="form-group">
						<label for="lugar">Lugar</label>
						<input type="text" name="lugar" class="form-control" value ="{{old('lugar')}}" placeholder="Lugar...">
					</div>

					<div class="form-group">
						<label for="fechaInicio">Fecha Inicio</label>
						<input type="date" name="fechaInicio" min="2000-12-31" class="form-control" value ="{{old('fechaInicio')}}" placeholder="Fecha de Inicio...">
					</div>

					<div class="form-group">
						<label for="fechaFin">Fecha Fin</label>
						<input type="date" name="fechaFin" min="2000-12-31" class="form-control" value ="{{old('fechaFin')}}" placeholder="Fecha de Fin...">
					</div>

					<div class="form-group">
						<label for="nivelSatisfaccion">Nivel de Satisfacción</label>
						<input type="text" name="nivelSatisfaccion" class="form-control" value ="{{old('nivelSatisfaccion')}}" placeholder="Nivel de Satisfacción...">
					</div>

					<div class="form-group">
						<label for="recomendaciones">Recomendaciones</label>
						<input type="text" name="recomendaciones" class="form-control" value ="{{old('recomendaciones')}}" placeholder="Recomendaciones...">
					</div>

					<div class="form-group">
						<label for="observaciones">Observaciones</label>
						<input type="text" name="observaciones" class="form-control" value ="{{old('observaciones')}}" placeholder="Observaciones...">
					</div>

					<div>
						<button class="btn btn-primary" type="submit"> Guardar</button>
						<button class="btn btn-danger" type="reset"> Cancelar</button>
					</div>

			{!! Form::close() !!}

		</div>
	</div>
@endsection
