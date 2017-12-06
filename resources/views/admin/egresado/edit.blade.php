@extends('template')
@section('contenido')}
{!! Form::model($egresado, ['method'=>'PATCH', 'route'=>['egresado.update', $egresado->idEgresado]]) !!}
{{ Form::token() }}
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
<div class="row">
	<div class="col-md-6">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon"><i class="fa fa-address-card" style="font-size: 1em;"></i></div>
	         <div class="caja-title">Datos Personales
				</div>
	      </div>
	      <div class="caja-body">
					<div class="form-horizontal">
						<p style="color:red;"> <span class="ast">*</span> Requerido	</p>
					</div>
					<div class="form-horizontal">
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombres <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required type="text" class="form-control" name="nombre" required value="{{ $egresado->nombre }}" placeholder="Nombres">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="apellidoPaterno" class="col-sm-3 control-label">Ape. Paterno <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required type="text" class="form-control" name="apellidoPaterno" required value="{{ $egresado->apellidoPaterno }}" placeholder="Apellido Paterno">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="apellidoMaterno" class="col-sm-3 control-label">Ape. Materno <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required type="text" class="form-control" name="apellidoMaterno" required value="{{ $egresado->apellidoMaterno }}" placeholder="Apellido Materno">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="direccion" class="col-sm-3 control-label">Direccion </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-home"></i></span>
									 <input type="text" class="form-control" name="direccion" value="{{ $egresado->direccion }}" placeholder="Direccion">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="telefono" class="col-sm-3 control-label">Teléfono </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
									 <input pattern="[0-9]+" maxlength="15" type="tel" class="form-control" name="telefono"  value="{{ $egresado->telefono }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="(xxx)xxxxxx">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="celular" class="col-sm-3 control-label">Celular </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									 <input pattern="[0-9]+" maxlength="15" type="tel" class="form-control" name="celular" value="{{ $egresado->celular }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="(xxx)xxxxxxxxx">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									 <input minlength="6" maxlength="100" type="email" class="form-control" name="email"  value="{{ $egresado->email }}" placeholder="e.g. ejemplo@ejemplo.com">
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="caja">
		      <div class="caja-header">
		         <div class="caja-icon"><i class="fa fa-graduation-cap" style="font-size: 1em;"></i></div>
		         <div class="caja-title">Datos del Egresado
					</div>
		      </div>
		      <div class="caja-body">
					<div class="form-horizontal">

						<div class="form-group">
							<label for="codigo" class="col-sm-3 control-label">Código <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
									 <input required pattern="[0-9]+" minlength="4" maxlength="15" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" name="codigo"  value="{{ $egresado->codigo }}" placeholder="xxxx">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="anioEgreso" class="col-sm-3 control-label">Año Egreso <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
									 <input type="number" required min="2000" id="anioEgreso" name="anioEgreso" class="form-control" value ="{{ $egresado->anioEgreso }}"  required placeholder="{{ date('Y') }}">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="numeroSemestre" class="col-sm-3 control-label">Ciclo <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
									<select name="numeroSemestre" class="form-control">
										@if($egresado->numeroSemestre==1)
										<option value="1" selected>I</option>
										<option value="2">II</option>
										@elseif($egresado->numeroSemestre==2)
										<option value="1">I</option>
										<option value="2" selected>II</option>
										@endif
					 				</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="grado" class="col-sm-3 control-label">Condición <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
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
							</div>
						</div>
					</div>
			   </div>
				<div class="caja-footer">
					<div class="pull-right">
						<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
						<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
					</div>
		      </div>
		   </div>
	  </div>
</div>

{!! Form::close() !!}

<style type="text/css">
	.ast{
		color: red;
		font-size: 20px;
	}
</style>
@endsection
