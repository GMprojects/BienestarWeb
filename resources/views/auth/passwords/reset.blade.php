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

      <!-- Scripts Generales -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

   </head>

   <body class="patron">

      <div class="container">
          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                      <div class="panel-heading">Reset Password</div>

                      <div class="panel-body">
                          <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                              {{ csrf_field() }}

                              <input type="hidden" name="token" value="{{ $token }}">

                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                      @if ($errors->has('email'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label for="password" class="col-md-4 control-label">Password</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control" name="password" required>

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                  <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                  <div class="col-md-6">
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                      @if ($errors->has('password_confirmation'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary">
                                          Reset Password
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      

      <div class="content-princ">
         <div class="login-box" id="caja">
            <div  class="header-login-box" >
               <h3> <i class="fa fa-user"> </i><strong>Farmacia y Bioquímica</strong></h3>
               <h4>Recuperar Contraseña</h4>
            </div>
            <div class="body-login-box">
               @if (session('status'))
                   <div class="alert alert-success">
                       {{ session('status') }}
                   </div>
               @endif
               <form class="form" method="POST" action="{{ route('password.email') }}">
                  {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                     <label for="">Cuál es su correo?</label>
                     <div class="input-group input-group-lg">
                           <span class="input-group-addon rounded-left"><i class="fa fa-envelope"></i></span>
                           <input required minlength="6" maxlength="100" type="email" class="form-control" name="email"  value="{{old('email')}}" placeholder="e.g. mguevaral@unitru.edu.pe" autofocus>
                     </div>
                     @if ($errors->has('email'))
                        <span class="help-block">
                           <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                  </div>

                  <div class="form-group" style="text-align:right;">
                     <button type="submit" class="btn btn-lg btn-facfar">
                        Enviar Link de Recuperación
                     </button>
                  </div>
               </form>
            </div>

         </div>
      </div>

   </body>

</html>
