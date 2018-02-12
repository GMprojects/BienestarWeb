@extends('template')
@section('contenido')
{!! Form::open(['url'=>'admin/egresado', 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{ Form::token() }}

<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 70px;">
	<div class="col-md-6">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon"><i class="fa fa-address-card"></i></div>
	         <div class="caja-title">Datos Personales
				</div>
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
						<p style="color:red;"> <span class="ast">*</span> Requerido	</p>
					</div>
					<div class="form-horizontal">
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombres <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required type="text" minlength="2"  maxlength="45" class="form-control" name="nombre" required value="{{old('nombre')}}" onkeypress="return soloLetras(event)" placeholder="Nombres">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="apellidoPaterno" class="col-sm-3 control-label">Ape. Paterno <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required type="text" minlength="2"  maxlength="25" class="form-control" name="apellidoPaterno" required value="{{old('apellidoPaterno')}}"  onkeypress="return soloLetras(event)" placeholder="Apellido Paterno">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="apellidoMaterno" class="col-sm-3 control-label">Ape. Materno <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required type="text" minlength="2" maxlength="25"  class="form-control" name="apellidoMaterno" required value="{{old('apellidoMaterno')}}"  onkeypress="return soloLetras(event)" placeholder="Apellido Materno">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="direccion" class="col-sm-3 control-label">Direccion </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-home"></i></span>
									 <input type="text" minlength="6" maxlength="100" class="form-control" name="direccion" value="{{old('direccion')}}" placeholder="e.g. Las Ponas Mz. 69 Lt. 25">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="telefono" class="col-sm-3 control-label">Teléfono </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
									 <input pattern="[0-9]+" minlength="9" maxlength="15" type="tel" class="form-control" name="telefono"  value="{{old('telefono')}}" onkeypress="return soloNumeros(event)" placeholder="(xxx)xxxxxx">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="celular" class="col-sm-3 control-label">Celular </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									 <input pattern="[0-9]+" minlength="6" maxlength="15" type="tel" class="form-control" name="celular" value="{{old('celular')}}" onkeypress="return soloNumeros(event)" placeholder="(xxx)xxxxxxxxx">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									 <input minlength="6" maxlength="100" type="email" class="form-control" name="email"  value="{{old('email')}}" onkeypress="return soloEmail(event)" placeholder="e.g. ejemplo@ejemplo.com">
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
		         <div class="caja-icon"><i class="fa fa-graduation-cap"></i></div>
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
									 <input required pattern="[0-9]+" minlength="4" maxlength="15" onkeypress="return soloNumeros(event)" type="text" class="form-control" name="codigo"  value="{{old('codigo')}}" placeholder="xxxx">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="anioEgreso" class="col-sm-3 control-label">Año Egreso <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
									 <input type="number" required min="2000" max="{{date("Y")}}" id="anioEgreso" name="anioEgreso" class="form-control" value ="{{old('anioEgreso')}}"  required placeholder="1950">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="numeroSemestre" class="col-sm-3 control-label">Ciclo <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
									<select name="numeroSemestre" class="form-control">
										<option value="1">I</option>
										<option value="2">II</option>
					 				</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="grado" class="col-sm-3 control-label">Grado <span class="ast">*</span></label>
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
			   </div><br><br><br>
				<div class="caja-footer">
					<div class="pull-right">
						<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
						<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
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
<script type="text/javascript">
	function soloNumeros(evento){
		console.log(evento.charCode);
		if ((evento.charCode >= 48 && evento.charCode <= 57)) {
			return true;
		}
		return false;
	}
	function soloLetras(evento){
		console.log(evento.charCode);
		if ((evento.charCode >= 65 && evento.charCode <= 90) ||
		    (event.charCode >= 97 && event.charCode <= 122) ||
			 (event.charCode == 225) || (event.charCode == 193) || //á Á
			 (event.charCode == 233) || (event.charCode == 201) || //é É
			 (event.charCode == 237) || (event.charCode == 205) || //í Í
			 (event.charCode == 243) || (event.charCode == 211) || //ó Ó
			 (event.charCode == 250) || (event.charCode == 218) || //ú Ú
			 (event.charCode == 32)) {
			return true;
		}
		return false;
	}
	function soloEmail(evento){
		console.log(evento.charCode);
		if ((evento.charCode >= 48 && evento.charCode <= 57) ||
			 (event.charCode >= 97 && event.charCode <= 122) ||
			 (event.charCode == 46)||
			 (event.charCode == 64)||
			 (event.charCode == 95)){
			return true;
		}
		return false;
	}

</script>
@endsection
