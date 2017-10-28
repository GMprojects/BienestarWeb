<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      <title>FacFar | Home</title>
      <!-- CSS Generales -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('facfar/facfar.css') }}"/>
      <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Raleway" rel="stylesheet">

      <!-- aqui añade otros css -->
      <link rel="stylesheet" href="{{ asset('plugins/iCheck/skins/square/green.css') }}"/>

      <!-- Scripts Generales -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

      <!-- aqui añade otros scripts -->
      <script src="{{ asset('plugins/iCheck/icheck.js') }}"></script>
   </head>

   <body class="patron">
      <div class="content-princ">
         <div class="login-box" id="caja">
            <div  class="header-login-box" >
               <h3> <i class="fa fa-user"> </i><strong>Farmacia y Bioquímica</strong></h3>
               <h4>Iniciar Sesión</h4>
            </div>
            <div class="body-login-box">
               <form class="form" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                     <div class="input-group input-group-lg">
                           <span class="input-group-addon rounded-left"><i class="fa fa-envelope"></i></span>
                           <input required minlength="6" maxlength="100" type="email" class="form-control input-addon-left" name="email"  value="{{old('email')}}" placeholder="e.g. mguevaral@unitru.edu.pe" autofocus>
                     </div>
                     @if ($errors->has('email'))
                        <span class="help-block">
                           <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                     <div class="input-group input-group-lg">
                        <span class="input-group-addon rounded-left"><i class="fa fa-key"></i></span>
                        <input required minlength="4" maxlength="100" type="password" class="form-control input-addon-left" name="password"  value="{{old('password')}}" placeholder="***********">
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
                     <button type="submit" class="btn btn-lg btn-facfar">
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

         </div>
      </div>

      <script>
			$(document).ready(function(){
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green',
					increaseArea: '20%' // optional
				});
			});
   	</script>
   </body>

</html>
