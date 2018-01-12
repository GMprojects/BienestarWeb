@extends('template')
@section('contenido')

{{--{!! Form::model($user, ['method'=>'PATCH', 'route'=>['perfil.update', $egresado->idEgresado]]) !!}--}}
{!! Form::open(['route'=>['perfil.update',$user->id], 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{Form::token()}}
<div class="row">
	{!!Form::hidden('op',1)!!}
	<div class="col-md-6">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-address-card"></i></div>
	         <div class="caja-title">Datos Personales
				</div>
	      </div>
	      <div class="caja-body">
				<!-- Imagen de usuario -->
				<div  class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
						@if (count($errors) >0)
						<div class="alert alert-danger">
							<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
							</ul>
						</div>
						@endif
					</div>
				</div>
				<br>
				<div class="form-horizontal">
					<p style="color:red;"> <span class="ast">*</span> Requerido	</p>
				</div>
				<!-- Campos Tipo Texto -->
				<div class="form-horizontal">
					<!-- Campo nombre -->
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-user"></i></span>
								 <input maxlength="100" type="nombre" class="form-control" name="nombre" value="{{ $user->nombre }} {{ $user->apellidoPaterno }} {{ $user->apellidoMaterno }}">
							</div>
						</div>
					</div>
					<!-- Campo codigo -->
					<div class="form-group">
						<label for="coigo" class="col-sm-3 control-label">Código </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
								 <input maxlength="100" type="coigo" class="form-control" name="codigo" readonly  value="{{ $user->codigo }}">
							</div>
						</div>
					</div>
					<!-- Campo Direccion -->
					<div class="form-group">
						<label for="direccion" class="col-sm-3 control-label">Direccion </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-home"></i></span>
								 <input maxlength="100" type="direccion" class="form-control" name="direccion"  value="{{ $user->direccion }}" placeholder="e.g. Las Ponas Mz. 69 Lt. 25">
							</div>
						</div>
					</div>
					<!-- Campo Email -->
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email <span class="ast">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								 <input required minlength="6" maxlength="100" type="email" class="form-control" name="email" value="{{ $user->email }}"  onkeypress="return soloEmail(event)" placeholder="e.g. ejemplo@unitru.edu.pe">
							</div>
						</div>
					</div>
					<!-- Campo Telefono -->
					<div class="form-group">
						<label for="telefono" class="col-sm-3 control-label">Teléfono </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
								 <input pattern="[0-9]+" minlength="6" maxlength="15" type="tel" class="form-control" name="telefono"  value="{{ $user->telefono }}" onkeypress="return soloNumeros(event)" placeholder="(xxx)xxxxxx">
							</div>
						</div>
					</div>
					<!-- Campo Celular -->
					<div class="form-group">
						<label for="celular" class="col-sm-3 control-label">Celular </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
								 <input pattern="[0-9]+"  minlength="9" maxlength="15" type="tel" class="form-control" name="celular" value="{{ $user->celular }}" onkeypress="return soloNumeros(event)" placeholder="(xxx)xxxxxxxxx">
							</div>
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
				</div>
	      </div>
	   </div>
{!! Form::close() !!}

{!! Form::open(['route'=>['perfil.update',$user->id], 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{Form::token()}}
		{!!Form::hidden('op',2)!!}
			<div class="caja">
		      <div class="caja-header">
		         <div class="caja-icon">	<i class="fa fa-user"></i></div>
		         <div class="caja-title">Datos Específicos</div>
		      </div>
				<div class="caja-body">
					<div  class="row">
						<div class="col-lg-12 col-sm-12 col-xs-12">
							@if (count($errors) >0)
							<div class="alert alert-danger">
								<ul>
								@foreach($errors->all() as $error)
									<li>{{$error}}</li>
								@endforeach
								</ul>
							</div>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-horizontal">
							@if ($user->idTipoPersona == 1)
								<div class="form-group">
									<label for="condicion" class="col-sm-3 control-label">Condición <span class="ast">*</span></label>
									<div class="col-sm-8">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
											<select name="condicion" class="form-control" required>
												@switch ($user->alumno->condicion)
													@case(1)
													<option value="1" selected>Matriculado</option>
													<option value="2">No Matriculado</option>
													@break
													@case(2)
													<option value="1">Matriculado</option>
													<option value="2" selected>No Matriculado</option>
													@break
												@endswitch
											</select>
										</div>
									</div>
								</div>
							@elseif ($user->idTipoPersona == 2)
										<div class="form-group">
											<label for="categoria" class="col-sm-3 control-label">Categoría </label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-star fa-rotate-90"></i><i class="fa fa-suitcase"></i></span>
													<select name="categoria" class="form-control">
														@switch ($user->docente->categoria)
															@case(1)
															<option value="1" selected>Principal</option>
															<option value="2">Asociado</option>
															<option value="3">Auxiliar</option>
															<option value="4">Contratado</option>
															@break
															@case(2)
															<option value="1">Principal</option>
															<option value="2" selected>Asociado</option>
															<option value="3">Auxiliar</option>
															<option value="4">Contratado</option>
															@break
															@case(3)
															<option value="1">Principal</option>
															<option value="2">Asociado</option>
															<option value="3" selected>Auxiliar</option>
															<option value="4">Contratado</option>
															@break
															@case(4)
															<option value="1">Principal</option>
															<option value="2">Asociado</option>
															<option value="3">Auxiliar</option>
															<option value="4" selected>Contratado</option>
															@break
														@endswitch
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="dedicacion" class="col-sm-3 control-label">Dedicación </label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-clock-o"> <i class="fa fa-briefcase"></i></i></span>
													<select name="dedicacion" class="form-control">
														@switch ($user->docente->dedicacion)
															@case(1)
															<option value="1" selected>Exclusiva</option>
															<option value="2">Tiempo Completo</option>
															<option value="3">Tiempo Parcial</option>
															@break
															@case(2)
															<option value="1">Exclusiva</option>
															<option value="2" selected>Tiempo Completo</option>
															<option value="3">Tiempo Parcial</option>
															@break
															@case(3)
															<option value="1">Exclusiva</option>
															<option value="2">Tiempo Completo</option>
															<option value="3" selected>Tiempo Parcial</option>
															@break
														@endswitch
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="modalidad" class="col-sm-3 control-label">Modalidad </label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-tag fa-rotate-90"></i> <i class="fa fa-briefcase"></i></span>
													<select name="modalidad" class="form-control">
														@switch ($user->docente->dedicacion)
															@case(1)
															<option value="1" selected>Ordinario</option>
															<option value="2">Contratado</option>
															@break
															@case(2)
															<option value="1">Ordinario</option>
															<option value="2" selected>Contratado</option>
															@break
														@endswitch
													</select>
												</div>
											</div>
										</div>
							@else
								<div class="form-group">
									<label for="cargo" class="col-sm-3 control-label">Cargo <span class="ast">*</span></label>
									<div class="col-sm-8">
										<div class="input-group">
											 <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
											 <input type="cargo" id="cargo" class="form-control" name="cargo" value="{{ $user->administrativo->cargo}}" placeholder="Cargo">
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
				<br><br>
				<div class="caja-footer">
					<div class="pull-right">
						<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
						<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
					</div>
		      </div>

			</div>
	</div>
{!! Form::close() !!}
{!! Form::open(['route'=>['perfil.update',$user->id], 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true']) !!}
{{Form::token()}}
	{!!Form::hidden('op',3)!!}
	<div class="col-md-6">
		<div class="caja">

	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-user-circle"></i></div>
	         <div class="caja-title">Foto de Perfil</div>
	      </div>
			<div class="caja-body">
				<div  class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
						@if (count($errors) >0)
						<div class="alert alert-danger">
							<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
							</ul>
						</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						@if($user->foto != null)
							<input type="file" name="foto" class="form-control dropify" data-height="200"  data-default-file="{{ asset('storage/'.$user->foto ) }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="false">
						@else
							<input type="file" name="foto" class="form-control dropify" data-height="200"  data-default-file="{{ asset('storage/users/avatar2.png') }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="false">
						@endif
					</div>
					<div class="col-sm-3"></div>
				</div>
			</div>
			<br><br>
			<div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
				</div>
	      </div>

		</div>
{!! Form::close() !!}
{{--{!! Form::open(['route'=>['perfil.update',$user->id], 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{Form::token()}}
	{!!Form::hidden('op',4)!!}
		<div class="caja">

	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-lock"></i></div>
	         <div class="caja-title" id="tituloCamposPropios">Cambio de Contraseña</div>
	      </div>
			<div class="caja-body">
				<div  class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
						@if (count($errors) >0)
						<div class="alert alert-danger">
							<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
							</ul>
						</div>
						@endif
					</div>
				</div>
				<div class="form-horizontal">
					<!-- Campo Contraseña Anterior -->
					<div class="form-group">
						<label for="passwordNow" class="col-sm-3 control-label">Contraseña Actual </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
								 <input type="password" class="form-control" name="passwordNow">
							</div>
						</div>
					</div>
					<!-- Campo Contraseña Nueva -->
					<div class="form-group">
						<label for="passwordNew" class="col-sm-3 control-label">Contraseña Nueva </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
								 <input type="password" class="form-control" name="passwordNew">
							</div>
						</div>
					</div>
					<!-- Campo Contraseña Nueva Again -->
					<div class="form-group">
						<label for="passwordNewAgain" class="col-sm-3 control-label">Repetir Contraseña </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
								 <input type="password" class="form-control" name="passwordNewAgain">
							</div>
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
				</div>
	      </div>

		</div>

{!! Form::close() !!}--}}
	</div>
</div>

<style type="text/css">
	.ast{
		color: red;
		font-size: 20px;
	}
</style>

<script type="text/javascript">
function soloNumeros(evento){
	console.log(evento.charCode);
	if ((evento.charCode >= 48 && evento.charCode <= 57)) {
		return true;
	}
	return false;
}
</script>
@endsection
