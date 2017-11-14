@extends('template')
@section('contenido')
	<div  class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
			@if (count($errors) >0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li> {{ $error }} </li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

{!! Form::open(['url'=>'admin/egresado', 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{ Form::token() }}

	<div class="row">
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-address-card"></i>
					<h3 class="box-title">Datos Personales</h3>
				</div>
				<div class="box-body">
					<div class="form-horizontal">

						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombres: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input type="text" class="form-control" name="nombre" required value="{{old('nombre')}}" placeholder="Nombres...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="apellidoPaterno" class="col-sm-3 control-label">Ape. Paterno: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input type="text" class="form-control" name="apellidoPaterno" required value="{{old('apellidoPaterno')}}" placeholder="Apellido Paterno...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="apellidoMaterno" class="col-sm-3 control-label">Ape. Materno: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input type="text" class="form-control" name="apellidoMaterno" required value="{{old('apellidoMaterno')}}" placeholder="Apellido Materno...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="direccion" class="col-sm-3 control-label">Direccion: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-home"></i></span>
									 <input type="text" class="form-control" name="direccion" required value="{{old('direccion')}}" placeholder="Direccion...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="telefono" class="col-sm-3 control-label">Teléfono: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
									 <input type="text" class="form-control" name="telefono" required value="{{old('telefono')}}" placeholder="Teléfono...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="celular" class="col-sm-3 control-label">Celular: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
									 <input type="text" class="form-control" name="celular" required value="{{old('celular')}}" placeholder="Celular...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									 <input type="email" class="form-control" name="email" required value="{{old('email')}}" placeholder="Correo electrónico...">
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-graduation-cap"></i>
					<h3 class="box-title">Datos del Egresado</h3>
				</div>

				<div class="box-body">
					<div class="form-horizontal">

						<div class="form-group">
							<label for="codigo" class="col-sm-3 control-label">Código: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input type="text" class="form-control" name="codigo" required value="{{old('codigo')}}" placeholder="Nombre">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="anioEgreso" class="col-sm-3 control-label">Año Egreso: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input type="text" class="form-control" name="anioEgreso" required value="{{old('anioEgreso')}}" placeholder="Año Egreso...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="numeroSemestre" class="col-sm-3 control-label">Númetro de Semestre: </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input type="text" class="form-control" name="numeroSemestre" required value="{{old('numeroSemestre')}}" placeholder="Año Egreso...">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="grado" class="col-sm-3 control-label">Condición: </label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
									<select name="grado" class="form-control" required>
										<option value="1">Bachiller</option>
										<option value="2">Magister</option>
										<option value="3">Doctor</option>
										<option value="4">PhD</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<button class="btn btn-primary" type="submit"> Guardar</button>
							<button class="btn btn-danger" type="reset"> Cancelar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

{!! Form::close() !!}
@endsection
