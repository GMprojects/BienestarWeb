<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>FacFar | Inicio</title>
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('facfar/facfar.css') }}"/>
      <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Raleway" rel="stylesheet">
      <!-- Scripts -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   </head>
   <body>
      {{---@if(Auth::user() == null)--}}
            @include('layouts.partials.nav')
    {{--  @else
         @include('layouts.partials.member-nav')
      @endif--}}
      <div id="wrapper">
         <section id="page-content-wrapper" class="content-princ container">
            <div class="caja">
               <div class="caja-header">
      	         <div class="caja-icon">	<i class="fa fa-at"></i></div>
      	         <div class="caja-title">Verificación de Correo</div>
      	      </div>
               <div class="caja-body">
                  <div class="row">
                     <h1 style="text-align:center;">
                        <span class="fa fa-stack fa-lg">
                           <i class="fa fa-envelope fa-stack-2x" style="color:#555;"></i>
                           <i class="fa fa-check-circle fa-stack-1x" style="color:#4CAE4C; left:40px; bottom:25px;"></i>
                        </span>
                     </h1>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <p style="font-size:2em; text-align:center;">Has confirmado correctamente tu correo :D . Bienvenido! <br> <i class="fa fa-child fa-stack-2x" style="color:#444;"></i></p>
                     </div>
                  </div>
               </div>
               <br><br><br><br>
               {{--<div class="caja-footer">
                  <div class="row">
                     <h1 style="text-align:center;">
                        <a style="left:50%;" href="{{ route('login') }}" class="btn btn-ff">
                           <i style="font-size: 1.4em;" class="fa fa-user"></i>
                           <span class="" style="font-size: 1.3em; padding-left:5px;">Iniciar Sesión</span>
                        </a>
                     </h1>
                  </div>
               </div>--}}
            </div>
            @include('layouts.partials.footer')
         </section>
      </div>
   </body>
</html>
