@extends('template')
@section('contenido')
{!!Form::model([$user, $tipoPersona],['method'=>'PATCH','files'=>'true', 'route'=>['user.update',$user->id]] )!!}
{{Form::token()}}
<div class="row">
	<div class="col-md-6">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-address-card"></i></div>
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
					<div class="row">
						<div class="col-sm-4"></div>
						<div class="col-sm-4">
							@if ($user->foto != null)
								<input type="file" name="foto" class="form-control dropify"data-default-file="{{ asset('storage/'.$user->foto) }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
							@else
								<input type="file" name="foto" class="form-control dropify"data-default-file="{{ asset('storage/users/avatar2.png') }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
							@endif
						</div>
						<div class="col-sm-4"></div>
					</div><br/>
					<div class="form-horizontal">
						<p style="color:red;"> <span class="ast">*</span> Requerido	</p>
					</div>
					<!-- Campos Tipo Texto -->
					<div class="form-horizontal">
						<!-- Campo Nombre -->
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombre <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required minlength="2" maxlength="45" type="text" class="form-control" name="nombre" value="{{ $user->nombre }}" onkeypress="return soloLetras(event)"  placeholder="Nombres" autofocus>
								</div>
							</div>
						</div>
						<!-- Campo Apellido Paterno -->
						<div class="form-group">
							<label for="apellidoPaterno" class="col-sm-3 control-label">Ap. Paterno <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required minlength="2" maxlength="20" type="apellidoPaterno" class="form-control" name="apellidoPaterno" value="{{ $user->apellidoPaterno }}" onkeypress="return soloLetras(event)" placeholder="Apellido Paterno">
								</div>
							</div>
						</div>
						<!-- Campo Apellido Materno -->
						<div class="form-group">
							<label for="apellidoMaterno" class="col-sm-3 control-label">Ap. Materno <span class="ast">*</span></label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-user"></i></span>
									 <input required minlength="2" maxlength="20" type="apellidoMaterno" class="form-control" name="apellidoMaterno" value="{{ $user->apellidoMaterno }}" onkeypress="return soloLetras(event)" placeholder="Apellido Materno">
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
									 <input required minlength="6" maxlength="100" type="email" class="form-control" name="email"  value="{{ $user->email }}"  onkeypress="return soloEmail(event)" placeholder="e.g. ejemplo@unitru.edu.pe">
								</div>
							</div>
						</div>
						<!-- Campo Telefono -->
						<div class="form-group">
							<label for="telefono" class="col-sm-3 control-label">Teléfono </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
									 <input pattern="[0-9]+" maxlength="15" type="text" class="form-control" name="telefono"  value="{{ $user->telefono }}" onkeypress="return soloNumeros(event)" placeholder="(xxx)xxxxxx">
								</div>
							</div>
						</div>
						<!-- Campo Celular -->
						<div class="form-group">
							<label for="celular" class="col-sm-3 control-label">Celular </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									 <input pattern="[0-9]+" maxlength="15" type="celular" class="form-control" name="celular" value="{{ $user->celular }}" onkeypress="return soloNumeros(event)" placeholder="(xxx)xxxxxxxxx">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<!-- CAJA de Datos Propios del TIPO_PERSONA -->
			<div class="caja" name "nuevoUsuario">
		      <div class="caja-header">
		         <div class="caja-icon">	<i class="glyphicon glyphicon-user"></i></div>
		         <div class="caja-title" id="tituloCamposPropios">Datos de Alumno
					</div>
		      </div>
				<!-- BODY de Datos Propios del TIPO_PERSONA -->
				<div class="caja-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label for="codigo" class="col-sm-3 control-label">Código </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
									 <input readonly pattern="[0-9]+" minlength="4" maxlength="15" type="text" class="form-control" name="codigo"  value="{{ $user->codigo }}" onkeypress="return soloNumeros(event)" placeholder="xxxx">
								</div>
							</div>
						</div>
					</div>

					<div class="form-horizontal">

						<!-- Campos para el tipo ADMINISTRATIVO -->
						<div class="camposAdministrativo" id="formAdministrativo" style='display:none;'>
							<div class="form-group">
								<label for="cargo" class="col-sm-3 control-label">Cargo </label>
								<div class="col-sm-8">
									<div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
										 <input type="cargo" class="form-control" name="cargo" value="{{ $tipoPersona->cargo }}"  onkeypress="return soloLetras(event)"  placeholder="Cargo">
									</div>
								</div>
							</div>
						</div>

						<!-- Campos para el tipo ALUMNO -->
						<div class="camposAlumno" id="formAlumno" style='display:block;'>
							<div class="form-group">
								<label for="condicion" class="col-sm-3 control-label">Condición </label>
								<div class="col-sm-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
										<select id="condicion" name="condicion" class="form-control" required>
											<option value="1">Matriculado</option>
											<option value="2">No Matriculado</option>
											<option value="3">Egresado</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<!-- Campos para el tipo DOCENTE -->
						<div class="camposDocente" id="formDocente" style='display:none;'>
							<div class="form-group">
								<label for="categoria" class="col-sm-3 control-label">Categoría </label>
								<div class="col-sm-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
										<select id="categoria" name="categoria" class="form-control">
											<option value="1">Principal</option>
											<option value="2">Asociado</option>
											<option value="3">Auxiliar</option>
											<option value="4">Contratado</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="dedicacion" class="col-sm-3 control-label">Dedicación </label>
								<div class="col-sm-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
										<select id="dedicacion" name="dedicacion" class="form-control">
											<option value="1">Exclusiva</option>
											<option value="2">Tiempo Completo</option>
											<option value="3">Tiempo Parcial</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="modalidad" class="col-sm-3 control-label">Modalidad </label>
								<div class="col-sm-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
										<select id="modalidad" name="modalidad" class="form-control">
											<option value="1">Ordinario</option>
											<option value="2">Contratado</option>
										</select>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
			<!-- CAJA de FUNCION de usuario -->
			<div class="caja" name "nuevoUsuario">
		      <div class="caja-header">
		         <div class="caja-icon">	<i class="fa fa-lock"></i></div>
		         <div class="caja-title">Privilegios
					</div>
		      </div>
				<!-- BODY de CAJA de FUNCION de usuario -->
				<div class="caja-body">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align: center;">
							<h3><i id="icoMiembro" class="flaticon-band" style="color:rgba(0,0,0,0.5);"></i></h3>
							<input type="radio" id="radioMiembro" name="funcion" value="1" onchange="cambiarColorFuncion(1)"/>
							<h5>Miembro</h5>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align: center;">
							<h3><i id="icoProgramador" class="flaticon-learning" style="color:rgba(0,0,0,0.5);"></i></h3>
							<input type="radio" id="radioProgramador" name="funcion" value="2" onchange="cambiarColorFuncion(2)"/>
							<h5>Programador</h5>
						</div>
						<div class="col-md-4 colsm-4 col-xs-4" style="text-align: center;">
							<h3><i id="icoAdmin" class="flaticon-problem" style="color:rgba(0,0,0,0.5);"></i></h3>
							<input type="radio" id="radioAdmin" name="funcion" value="3" onchange="cambiarColorFuncion(3)" />
							<h5>Administrador</h5>
						</div>
					</div>
				</div>
				<br><br>
				<!-- FOOTER de CAJA de FUNCION de usuario -->
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
	<script type="text/javascript">

		window.onload = iniciar();

		function iniciar(){
			var tipo = '', funcion = '';
	{{--		switch({{ $user->idTipoPersona }}){
				case 1: 	tipo = 'radioAlumno';
							document.getElementById('condicion').selectedIndex = {{ $tipoPersona->condicion }} - 1;
							break;
				case 2: 	tipo = 'radioDocente';
							document.getElementById('categoria').selectedIndex = {{ $tipoPersona->categoria }} - 1;
							document.getElementById('dedicacion').selectedIndex = {{ $tipoPersona->dedicacion }} - 1;
							document.getElementById('modalidad').selectedIndex = {{ $tipoPersona->modalidad }} - 1;
							break;
				case 3: 	tipo = 'radioAdministrativo'; break;
			}
			document.getElementById(tipo).checked = true;
			cambiarColorTipo({{ $user->idTipoPersona }});--}}

			switch({{ $user->funcion }}){
				case 1: funcion = 'radioMiembro'; break;
				case 2: funcion = 'radioProgramador'; break;
				case 3: funcion = 'radioAdmin'; break;
			}
			document.getElementById(funcion).checked = true;
			cambiarColorFuncion({{ $user->idTipoPersona }});
		}

		function cambiarColorTipo(icono){
			/*document.getElementById('icoAlumno').style.color = 'rgba(0,0,0, 0.5)';
			document.getElementById('icoDocente').style.color = 'rgba(0,0,0, 0.5)';
			document.getElementById('icoAdministrativo').style.color = 'rgba(0,0,0, 0.5)';*/
			var iconoElegido = "";
			document.getElementById('formAdministrativo').style.display = 'none';
			document.getElementById('formAlumno').style.display = 'none';
			document.getElementById('formDocente').style.display = 'none';
			switch ({{ $user->idTipoPersona }}) {
				case 1: 	iconoElegido = 'icoAlumno';
							document.getElementById('formAlumno').style.display = 'block';
							document.getElementById('tituloCamposPropios').innerHTML = "Datos de Alumno";break;
				case 2: 	iconoElegido = 'icoDocente';
							document.getElementById('formDocente').style.display = 'block';
							document.getElementById('tituloCamposPropios').innerHTML = "Datos de Docente";break;
				case 3: 	iconoElegido = 'icoAdministrativo';
							document.getElementById('formAdministrativo').style.display = 'block';
							document.getElementById('tituloCamposPropios').innerHTML = "Datos de Administrativo";break;
			}
			document.getElementById(iconoElegido).style.color = 'rgba(0,0,0,1)';
		}

		function cambiarColorFuncion(icono){
			document.getElementById('icoMiembro').style.color = 'rgba(0,0,0, 0.5)';
			document.getElementById('icoProgramador').style.color = 'rgba(0,0,0, 0.5)';
			document.getElementById('icoAdmin').style.color = 'rgba(0,0,0, 0.5)';
			var iconoElegido = "";
			switch (icono) {
				case 1: iconoElegido = 'icoMiembro'; break;
				case 2: iconoElegido = 'icoProgramador'; break;
				case 3: iconoElegido = 'icoAdmin'; break;
			}
			document.getElementById(iconoElegido).style.color = 'rgba(0,0,0,1)';
		}
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
	<style type="text/css">
		.ast{
			color: red;
			font-size: 20px;
		}
	</style>
@endsection
