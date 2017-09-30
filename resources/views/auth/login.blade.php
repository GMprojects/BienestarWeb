@extends('layouts.inicio')
@section('contenido')
	<div class="login-box">
		<div  style="text-align: center;">
			<h2> <i class="fa fa-user"> </i>  Iniciar Sesión</h2>
		</div>

	   <form class="form" method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<input required minlength="6" maxlength="100" type="email" class="form-control" name="email"  value="{{old('email')}}" placeholder="e.g. mguevaral@unitru.edu.pe">
				</div>
				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-key"></i></span>
					<input required minlength="6" maxlength="100" type="password" class="form-control" name="password"  value="{{old('password')}}" placeholder="***********">
				</div>
				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</div>

			<div class="form-group">
				<label>
					<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
					 Recuérdame
				</label>
			</div>
			<br />
			<div class="form-group" style="text-align:right;">
				<button type="submit" class="button special">
					Conectar
				</button>
			</div>
			<div class="olvido" style="text-align:right;">
				<a href="{{ route('password.request') }}">
					Olvidaste tu contraseña?
				</a>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-grey',
				radioClass: 'iradio_square-grey',
				increaseArea: '20%' // optional
			});
			$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
			$("#input-id").fileinput();
			$("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});
		});
	</script>
@endsection
