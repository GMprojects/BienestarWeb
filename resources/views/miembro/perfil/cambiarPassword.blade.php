@extends('template')
@section('contenido')
{!! Form::open(['route'=>['perfil.updatePassword',$user->id], 'method'=>'POST', 'autocomplete'=>'off']) !!}
	{{ csrf_field() }}
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-lock"></i></div>
	         <div class="caja-title" id="tituloCamposPropios">Cambio de Contraseña</div>
	      </div>
			<div class="caja-body">
				<div class="form-horizontal">
					<!-- Campo Contraseña Anterior -->
					<div class="form-group">
						<label for="myPassword" class="col-sm-3 control-label">Contraseña Actual </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
								 <input required type="password" minlength="4" class="form-control" name="myPassword">
							</div>
                     @if (Session::has('message'))
                        <span class="help-block">
                          <strong style="color:red;">{{ $errors->first('myPassword') }}</strong>
                          <strong style="color:red;">{{ Session::get('message') }}</strong>
                        </span>
         				@endif
						</div>
					</div>
					<!-- Campo Contraseña Nueva -->
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Contraseña Nueva </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
								 <input required type="password" minlength="6" class="form-control" name="password">
							</div>
                     <span class="help-block">
                       <strong style="color:red;">{{ $errors->first('password') }}</strong>
                     </span>
						</div>
					</div>
					<!-- Campo Contraseña Nueva Again -->
					<div class="form-group">
						<label for="password_confirmation" class="col-sm-3 control-label">Repetir Contraseña Nueva </label>
						<div class="col-sm-8">
							<div class="input-group">
								 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
								 <input required type="password" minlength="6" class="form-control" name="password_confirmation">
							</div>
						</div>
					</div>
               <br>
               {{--<div class="olvido" style="text-align:left;">
                  <a href="{{ route('password.request') }}">¿Has olvidado tu contraseña?</a>
               </div>--}}
				</div>
			</div>
			<br><br>
			<div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
				</div>
	      </div>
		</div>
{!! Form::close() !!}
@endsection
