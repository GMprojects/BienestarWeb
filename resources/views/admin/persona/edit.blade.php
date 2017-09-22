@extends('layouts.admin', ['titulo' => 'Editar usuario: '.$persona->codigo, 'nombreTabla' => '', 'item' => 'usuTodos'])
@section('contenido')
	<div  class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-13">
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
{!!Form::model([$persona, $tipoPersona],['method'=>'PATCH','route'=>['persona.update',$persona->idPersona]])!!}
{{Form::token()}}

	<div class="row">
		<div class="col-md-6">
			<!-- CAJA de Datos Personales -->
			<div class="box box-success">
				<!-- HEADER de CAJA de Datos Personales -->
				<div class="box-header with-border">
					<i class="fa fa-address-card"></i>
					<h3 class="box-title">Datos Personales</h3>
				</div>
				<!-- BODY de CAJA de Datos Personales -->
				<div class="box-body">
					<!-- Imagen de usuario -->
					<div class="row">
						<div class="col-sm-4"></div>
						<div class="col-sm-4">
							@switch($persona->idTipoPersona)
								@case(1) <input type="file" name="foto" class="dropify" data-default-file="{{ asset('images/Usuario/Alumno/'.$persona->foto) }}" data-allowed-file-extensions="png jpg jpge" /> @break;
								@case(2) <input type="file" name="foto" class="dropify" data-default-file="{{ asset('images/Usuario/Docente/'.$persona->foto) }}" data-allowed-file-extensions="png jpg jpge" /> @break;
								@case(3) <input type="file" name="foto" class="dropify" data-default-file="{{ asset('images/Usuario/Administrativo/'.$persona->foto) }}" data-allowed-file-extensions="png jpg jpge" /> @break;
							@endswitch

						</div>
						<div class="col-sm-4"></div>
					</div><br/>
					<!-- Campos Tipo Texto -->
	            <div class="form-horizontal">
						<!-- Campo Nombre -->
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombre</label>
	   					<div class="col-sm-8">
	   						<div class="input-group">
	   							 <span class="input-group-addon"><i class="fa fa-user"></i></span>
	   							 <input required minlength="2" maxlength="45" type="text" class="form-control" name="nombre" value="{{ $persona->nombre }}" placeholder="e.g. María Fernanda" autofocus>
	   						</div>
	   					</div>
	   				</div>
						<!-- Campo Apellido Paterno -->
	   				<div class="form-group">
	   					<label for="apellidoPaterno" class="col-sm-3 control-label">Ap. Paterno</label>
	   					<div class="col-sm-8">
	   						<div class="input-group">
	   							 <span class="input-group-addon"><i class="fa fa-user"></i></span>
	   							 <input required minlength="2" maxlength="20" type="apellidoPaterno" class="form-control" name="apellidoPaterno" value="{{ $persona->apellidoPaterno }}" placeholder="e.g. Guevara">
	   						</div>
	   					</div>
	   				</div>
						<!-- Campo Apellido Materno -->
	   				<div class="form-group">
	   					<label for="apellidoMaterno" class="col-sm-3 control-label">Ap. Materno </label>
	   					<div class="col-sm-8">
	   						<div class="input-group">
	   							 <span class="input-group-addon"><i class="fa fa-user"></i></span>
	   							 <input required minlength="2" maxlength="20" type="apellidoMaterno" class="form-control" name="apellidoMaterno" value="{{ $persona->apellidoMaterno }}" placeholder="e.g. Lizárraga">
	   						</div>
	   					</div>
	   				</div>
						<!-- Campo Direccion -->
						<div class="form-group">
	   					<label for="direccion" class="col-sm-3 control-label">Direccion </label>
	   					<div class="col-sm-8">
	   						<div class="input-group">
	   							 <span class="input-group-addon"><i class="fa fa-home"></i></span>
	   							 <input required minlength="6" maxlength="100" type="direccion" class="form-control" name="direccion"  value="{{ $persona->direccion }}" placeholder="e.g. Las Ponas Mz. 69 Lt. 25">
	   						</div>
	   					</div>
	   				</div>
						<!-- Campo Email -->
	   				<div class="form-group">
	   					<label for="email" class="col-sm-3 control-label">Email </label>
	   					<div class="col-sm-8">
	   						<div class="input-group">
	   							 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	   							 <input required minlength="6" maxlength="100" type="email" class="form-control" name="email"  value="{{ $persona->email }}" placeholder="e.g. mguevaral@unitru.edu.pe">
	   						</div>
	   					</div>
	   				</div>
						<!-- Campo Telefono -->
	   				<div class="form-group">
	   					<label for="telefono" class="col-sm-3 control-label">Teléfono </label>
	   					<div class="col-sm-8">
	   						<div class="input-group">
	   							 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
	   							 <input pattern="[0-9]+" minlength="6" maxlength="15" type="text" class="form-control" name="telefono"  value="{{ $persona->telefono }}" placeholder="(xxx)xxxxxx">
	   						</div>
	   					</div>
	   				</div>
						<!-- Campo Celular -->
	   				<div class="form-group">
	   					<label for="celular" class="col-sm-3 control-label">Celular </label>
	   					<div class="col-sm-8">
	   						<div class="input-group">
	   							 <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
	   							 <input pattern="[0-9]+" minlength="9" maxlength="15" type="celular" class="form-control" name="celular" value="{{ $persona->celular }}" placeholder="(xxx)xxxxxxxxx">
	   						</div>
	   					</div>
	   				</div>
		   		</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<!-- CAJA de Datos Propios del TIPO_PERSONA -->
			<div class="box box-success" name "nuevoUsuario">
				<!-- HEADER de Datos Propios del TIPO_PERSONA -->
				<div class="box-header with-border">
					<i class="glyphicon glyphicon-user"></i>
					<h3 class="box-title" id = "tituloCamposPropios">Datos de Alumno</h3>
				</div>
				<!-- BODY de Datos Propios del TIPO_PERSONA -->
				<div class="box-body">
					<!-- Campo Tipo Radio (Tipo de Usuario) -->
					<div class="row" name = "tipos de persona">
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align: center;">
							<h3><i id="icoAlumno" class="flaticon-answer" style="color:rgba(0,0,0,1);"></i></h3>
							<input type="radio" id="radioAlumno" name="tipo" value="1" checked onchange="cambiarColorTipo(1)"/>
							<h5>Alumno</h5>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align: center;">
							<h3><i id="icoDocente" class="flaticon-classroom" style="color:rgba(0,0,0,0.5);"></i></h3>
							<input type="radio" id="radioDocente" name="tipo" value="2" onchange="cambiarColorTipo(2)"/>
							<h5>Docente</h5>
						</div>
						<div class="col-md-4 colsm-4 col-xs-4" style="text-align: center;">
							<h3><i id="icoAdministrativo" class="flaticon-teacher" style="color:rgba(0,0,0,0.5);"></i></h3>
							<input type="radio" id="radioAdministrativo" name="tipo" value="3" onchange="cambiarColorTipo(3)" />
							<h5>Administrativo</h5>
						</div>
					</div>
					@switch($persona->idTipoPersona)
						@case(1) <script type="text/javascript">cambiarColorTipo(1)</script> @break;
						@case(2) <script type="text/javascript">cambiarColorTipo(2)</script> @break;
						@case(3) <script type="text/javascript">cambiarColorTipo(3)</script> @break;
					@endswitch
					<br>
					<div class="form-horizontal">
						<div class="form-group">
							<label for="codigo" class="col-sm-3 control-label">Código </label>
							<div class="col-sm-8">
								<div class="input-group">
									 <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
									 <input pattern="[0-9]+" minlength="4" maxlength="15" type="text" class="form-control" name="codigo"  value="{{ $persona->codigo }}" placeholder="xxxx">
								</div>
							</div>
						</div>
					</div>

					<div class="form-horizontal">

						<!-- Campos para el tipo ADMINISTRATIVO -->
						<div class="camposAdministrativo" id = "formAdministrativo" style='display:none;'>
							<div class="form-group">
								<label for="cargo" class="col-sm-3 control-label">Cargo </label>
								<div class="col-sm-8">
									<div class="input-group">
										 <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
										 <input type="cargo" class="form-control" name="cargo" value="{{ $tipoPersona->cargo }}" placeholder="Cargo">
									</div>
								</div>
							</div>
						</div>

						<!-- Campos para el tipo ALUMNO -->
						<div class="camposAlumno" id = "formAlumno" style='display:block;'>
							<div class="form-group">
								<label for="condicion" class="col-sm-3 control-label">Condición </label>
								<div class="col-sm-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
										<select name="condicion" class="form-control" required>
						 					<option value="1">Matriculado</option>
						 					<option value="2">No Matriculado</option>
											<option value="3">Egresado</option>
						 				</select>
									</div>
								</div>
							</div>
						</div>

						<!-- Campos para el tipo DOCENTE -->
						<div class="camposDocente" id = "formDocente" style='display:none;'>
							<div class="form-group">
								<label for="categoria" class="col-sm-3 control-label">Categoría </label>
								<div class="col-sm-8">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
										<select name="categoria" class="form-control">
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
										<select name="dedicacion" class="form-control">
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
										<select name="modalidad" class="form-control">
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
			<div class="box box-success" name "nuevoUsuario">
				<!-- HEADER de CAJA de FUNCION de usuario -->
				<div class="box-header with-border">
					<i class="glyphicon glyphicon-lock"></i>
					<h3 class="box-title">Privilegios</h3>
				</div>
				<!-- BODY de CAJA de FUNCION de usuario -->
				<div class="box-body">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align: center;">
							<h3><i id="icoMiembro" class="flaticon-band" style="color:rgba(0,0,0,1);"></i></h3>
							<input type="radio" id="radioMiembro" name="funcion" value="1" checked onchange="cambiarColorFuncion(1)"/>
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
					@switch($persona->funcion)
						@case(1) <script type="text/javascript">cambiarColorFuncion(1)</script> @break;
						@case(2) <script type="text/javascript">cambiarColorFuncion(2)</script> @break;
						@case(3) <script type="text/javascript">cambiarColorFuncion(3)</script> @break;
					@endswitch
				</div>
				<!-- FOOTER de CAJA de FUNCION de usuario -->
				<div class="box-footer">
					<div class="form-group">
						<button class="btn btn-success" type="submit"> Guardar</button>
						<a href="#"><button class="btn btn-danger" type="reset"> Cancelar</button></a>
					</div>
				</div>
			</div>
		</div>

	</div>

{!! Form::close() !!}

<script type="text/javascript">
	function cambiarColorTipo(icono){
		document.getElementById('icoAlumno').style.color = 'rgba(0,0,0, 0.5)';
		document.getElementById('icoDocente').style.color = 'rgba(0,0,0, 0.5)';
		document.getElementById('icoAdministrativo').style.color = 'rgba(0,0,0, 0.5)';
		var iconoElegido = "";
		document.getElementById('formAdministrativo').style.display = 'none';
		document.getElementById('formAlumno').style.display = 'none';
		document.getElementById('formDocente').style.display = 'none';
		switch (icono) {
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
</script>
@endsection
