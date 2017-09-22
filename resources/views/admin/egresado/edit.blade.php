@extends('layouts.admin', ['titulo' => 'Egresados', 'nombreTabla' => '', 'item' => 'egreTodos'])
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar el egresado:
				{{ $egresado->nombre }}
				{{ $egresado->apellidoPaterno }}
				{{ $egresado->apellidoMaterno }}
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

			{!! Form::model($egresado, ['method'=>'PATCH', 'route'=>['egresado.update', $egresado->idEgresado]]) !!}
				{{ Form::token() }}

					<div class="form-group">
						<label for="grado">Grado</label>
						<select name="grado" class="form-control">
								@if($egresado->grado==1)
									<option value="1" selected>Bachiller</option>
									<option value="2" >Magister</option>
									<option value="3" >Doctor</option>
									<option value="4" >PhD</option>
								@elseif($egresado->grado==2)
									<option value="1" >Bachiller</option>
									<option value="2" selected>Magister</option>
									<option value="3" >Doctor</option>
									<option value="4" >PhD</option>
								@elseif($egresado->grado==3)
									<option value="1" >Bachiller</option>
									<option value="2" >Magister</option>
									<option value="3" selected>Doctor</option>
									<option value="4" >PhD</option>
								@elseif($egresado->grado==4)
									<option value="1" >Bachiller</option>
									<option value="2" >Magister</option>
									<option value="3" >Doctor</option>
									<option value="4" selected>PhD</option>
								@endif
						</select>
				</div>

					<div class="form-group">
						<label for="direccion">Direccion</label>
						<input type="text" name="direccion" class="form-control" value="{{ $egresado->direccion }}" placeholder="Direccion...">
					</div>

					<div class="form-group">
						<label for="telefono">Telefono</label>
						<input type="text" name="telefono" class="form-control" value="{{ $egresado->telefono }}" placeholder="Telefono...">
					</div>

					<div class="form-group">
						<label for="celular">Celular</label>
						<input type="text" name="celular" class="form-control" value="{{ $egresado->celular }}" placeholder="Celular...">
					</div>

					<div class="form-group">
						<label for="email">Correo Electrónico</label>
						<input type="text" name="email" class="form-control" value="{{ $egresado->email }}" placeholder="Correo Electrónico...">
					</div>

					<div>
						<button class="btn btn-primary" type="submit"> Guardar</button>
						<button class="btn btn-danger" type="reset"> Cancelar</button>
					</div>

			{!! Form::close() !!}

		</div>
	</div>
@endsection
