@extends('template')
@section('contenido')
{!! Form::open(['route'=>['perfil.update',$user->id], 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true']) !!}
{{Form::token()}}
<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
			<div class="pull-right">
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> <span class="hidden-xs">Limpiar</span></button>
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> <span class="hidden-xs">Grabar</span></button>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-top: 70px;">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-address-card"></i></div>
	         <div class="caja-title">Datos Personales
					<div class="pull-right" style="margin-top:3px;">
						<a href="{{ action('MiPerfilController@editPassword',['id' => Auth::user()->id ]) }}" class="btn btn-ff">
							<i class="fa fa-lock fa-lg"></i> Cambiar Contraseña
						</a>
					</div>
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
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						@if($user->foto != null)
							<input type="file" name="foto" class="form-control dropify" data-height="200" data-max-file-size="4M" data-default-file="{{ asset('storage/'.$user->foto ) }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
						@else
							<input type="file" name="foto" class="form-control dropify" data-height="200" data-max-file-size="4M" data-default-file="{{ asset('storage/users/avatar2.png') }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
						@endif
						<div class="form-horizontal"><p style="color:blue; text-align:center;"> Tamaño Max: 4MB	</p></div>
					</div>
					<div class="col-sm-3"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-2"></div>
					<div class="form-horizontal">
						<p style="color:red;"> <span class="ast">*</span> Requerido	</p>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<!-- Campos Tipo Texto -->
				<div class="form-horizontal">
					<!-- Campo nombre -->
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Usuario <span class="ast">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-user"></i></span>
								 <input maxlength="100" required type="nombre" class="form-control" name="nombre" readonly value="{{ $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno }}">
							</div>
						</div>
					</div>
					<!-- Campo codigo -->
					<div class="form-group">
						<label for="coigo" class="col-sm-3 control-label">Código <span class="ast">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
								 <input maxlength="100" type="coigo" class="form-control" name="codigo" readonly  value="{{ $user->codigo }}">
							</div>
						</div>
					</div>
					<!-- Campo Email -->
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email <span class="ast">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								 <input required minlength="6" maxlength="100" type="email" class="form-control" name="email" readonly value="{{ $user->email }}"  onkeypress="return soloEmail(event)" placeholder="e.g. ejemplo@unitru.edu.pe">
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

					<!-- Campo Fecha Nacimiento -->
					<div class="form-group">
						<label for="fechaNacimiento" class="col-sm-3 control-label">Nacimiento </label>
						<div class="col-sm-8">
							<div class="input-group date">
								<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								@if ($user->fechaNacimiento != null)
										<input type="text" name="fechaNacimiento"  value="{{ date("d/m/Y",strtotime($user->fechaNacimiento )) }}" class="form-control"  id="fechaNacimiento" >
								@else
										<input type="text" name="fechaNacimiento"  placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaNacimiento" >
								@endif
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
		{!! Form::close() !!}
	   </div>
	</div>
	<div class="col-md-2"></div>
</div>


<style type="text/css">
	.ast{
		color: red;
		font-size: 20px;
	}
</style>

<script type="text/javascript">
	$('#fechaNacimiento').datetimepicker({
		format: 'DD/MM/YYYY'
	});

	function soloNumeros(evento){
		console.log(evento.charCode);
		if ((evento.charCode >= 48 && evento.charCode <= 57)) {
			return true;
		}
		return false;
	}
</script>
@endsection
