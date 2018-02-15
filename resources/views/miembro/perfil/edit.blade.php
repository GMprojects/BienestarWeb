@extends('template')
@section('contenido')
{!! Form::open(['route'=>['perfil.update',$user->id], 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true', 'onsubmit'=>'return validar()']) !!}
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
	      <div class="caja-body" id="iiii">
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
						<p style="color:red;"> <span class="ast">*</span> Requerido
							<span>
								<button type="button" class="btn btn-default btn-circle" data-toggle="modal" data-target="#modal-ayuda">
									<i class="fa fa-question" style="padding-left:4px;"></i>
								</button>
							</span>
						</p>
					</div>
					<div class="col-sm-3"></div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						@if($user->foto != null)
							<input type="file" name="foto" class="form-control dropify" data-height="200" data-default-file="{{ asset('storage/'.$user->foto ) }}" data-allowed-file-extensions="png jpg jpge" data-max-file-size="4M" data-errors-position="outside" data-show-remove="false">
						@else
							@if ($user->sexo == 'h'){{-- Hombre --}}
								<input type="file" name="foto" class="form-control dropify" data-height="200" data-default-file="{{ asset('img/avatar5.png') }}" data-allowed-file-extensions="png jpg jpge" data-max-file-size="4M" data-errors-position="outside" data-show-remove="false">
							@else{{-- Mujer --}}
								<input type="file" name="foto" class="form-control dropify" data-height="200" data-default-file="{{ asset('img/avatar2.png') }}" data-allowed-file-extensions="png jpg jpge" data-max-file-size="4M" data-errors-position="outside" data-show-remove="false">
							@endif
						@endif
					</div>
					<div class="col-sm-3"></div>
				</div>
				<br>
				<!-- Campos Tipo Texto -->
				<div class="form-horizontal">
					<!-- Campo nombre -->
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Usuario <span class="ast">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-user"></i></span>
								 <input data-toggle="tooltip" data-placement="bottom" title="Este dato sólo puede ser editado por el administrador" maxlength="100" required type="nombre" class="form-control" name="nombre" readonly value="{{ $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno }}">
							</div>
						</div>
					</div>
					<!-- Campo codigo -->
					<div class="form-group">
						<label for="coigo" class="col-sm-3 control-label">Código <span class="ast">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
								 <input data-toggle="tooltip" data-placement="bottom" title="Este dato sólo puede ser editado por el administrador" maxlength="100" type="coigo" class="form-control" name="codigo" readonly  value="{{ $user->codigo }}">
							</div>
						</div>
					</div>
					<!-- Campo Email -->
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email <span class="ast">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								 <input data-toggle="tooltip" data-placement="bottom" title="Este dato sólo puede ser editado por el administrador" required minlength="6" maxlength="100" type="email" class="form-control" name="email" readonly value="{{ $user->email }}"  onkeypress="return soloEmail(event)" placeholder="e.g. ejemplo@unitru.edu.pe">
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
<div class="modal fade" id="modal-ayuda">
	 <!-- /.modal-dialog -->
	 <div class="modal-dialog">
		   <!-- /.modal-content -->
		   <div class="modal-content">
		        <div class="modal-header" style="background-color:#4C4C4C; color:white; border-radius:4px 4px 0px 0px;">
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
			          <h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp; &nbsp;<b>Ayuda</b></h4>
		        </div>
		        <div class="modal-body">
		          	<p> Los siguientes campos sólo pueden ser <b style="color:red;">modificados por el administrador</b>.</p>
                  <ul>
                     <li>Nombres y Apellidos</li>
                     <li>Código</li>
                     <li>E-mail</li>
                  </ul>
						<p>Si necesita modificar algún campo, <b>comuníquese con el administrador</b>.</p>
						<p>El <b style="color:red;">tamaño máximo</b> de la imagen debe ser de <b style="color:red;">4MB</b>.</p>
		        </div>
		        <div class="modal-footer">
						  <div class="pull-left">
							  <button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
						  </div>
		        </div>
		   </div>
	      <!-- /.modal-content -->
	 </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	var imagenCorrecta = true;

	$(document).ready(function(){
		$('#modal-ayuda').modal('show');
		imagenCorrecta = true;
	});
	/* PLUGIN - Dropify*/
	$('.dropify').dropify({
	 messages: {
		  'default': 'Click o arrastrar y soltar',
		  'replace': 'Click o arrastrar y soltar',
		  'remove':  'Quitar',
		  'error':   'Ops! algo anda mal con el archivo'
	 },
	 error: {
		'fileSize': 'El tamaño de la imagen es muy grande (máx. 4MB).',
		'fileExtension': 'Formato de Imagen no permitido (sólo .png .jpg .jpeg).'
	 }
	});
	var drEvent = $('.dropify').dropify();
	drEvent.on('dropify.error.fileSize', function(event, element){
		imagenCorrecta = false;
		console.log('fileSize - ERROR  '+imagenCorrecta);
	});
	drEvent.on('dropify.error.fileExtension', function(event, element){
		imagenCorrecta = false;
		console.log('fileSize - ERROR  '+imagenCorrecta);
	});
	drEvent.on('dropify.fileReady', function(event, element){
		imagenCorrecta = true;
		console.log('fileReady - '+imagenCorrecta);
	});
	/* FIN PLUGIN - Dropify*/
	function validar(){
		return imagenCorrecta;
	}
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

<style type="text/css">
	.btn-circle{
		width: 23px;
		height: 23px;
		border-radius: 25px;
		padding: 0px 0px 0px 0.4px;
		font-size: 15px;
	}
	.ast{
		color: red;
		font-size: 20px;
	}
</style>
@endsection
