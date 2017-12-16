<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>FacFar</title>
      <!-- CSS GENERALES -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('facfar/facfar.css') }}"/>
      <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Raleway" rel="stylesheet">
      <!-- CSS adicionales -->
      <link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs/css/responsive.bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/datepicker/dist/css/bootstrap-datepicker.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/select-1.12.4/dist/css/bootstrap-select.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/flaticon/flaticon.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/iCheck/skins/square/green.css') }}"/>
      <!-- Scripts GENERALES -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <!-- Scripts adicionales -->
      <script src="{{ asset('plugins/datatables.net-bs/js/jquery.dataTables.js') }}"></script>
      <script src="{{ asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('plugins/datatables.net-bs/js/responsive.bootstrap.min.js') }}"></script>
      <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script>
      <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
      <script src="{{ asset('plugins/datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
      <script src="{{ asset('plugins/select-1.12.4/dist/js/bootstrap-select.min.js') }}"></script>
      <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
      <script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>
      <script src="{{ asset('plugins/iCheck/icheck.js') }}"></script>

      <script src="{{ asset('plugins/flot/jquery.flot.min.js') }}"></script>
      <script src="{{ asset('plugins/flot/jquery.flot.time.min.js') }}"></script>
      <script src="{{ asset('plugins/flot/jquery.flot.symbol.min.js') }}"></script>
      <script src="{{ asset('plugins/flot/jquery.flot.pie.min.js') }}"></script>
      <script src="{{ asset('plugins/flot/jquery.flot.categories.min.js') }}"></script>
      <script src="{{ asset('plugins/flot/jquery.flot.resize.min.js') }}"></script>
   </head>
   <body>
      @if(Auth::user() == null)
         @include('layouts.partials.nav')
      @else
         @include('layouts.partials.member-nav')
      @endif

      <div id="wrapper">
         <section id="page-content-wrapper" class="content-princ container">
            @if(Auth::user() != null)
               @include('layouts.partials.sidebar')
            @endif

            <!-- aqui el contenido -->
               @yield('contenido', 'Default')
            <!-- fin del contenido -->

            @include('layouts.partials.footer')
         </section>
      </div>
   </body>

   <script>
      $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();
      });
      $('.dropify').dropify({
       messages: {
      	  'default': 'Click o arrastrar y soltar',
      	  'replace': 'Click o arrastrar y soltar',
      	  'remove':  'Quitar',
      	  'error':   'Ops! Ha ocurrido un error'
       },
       error: {
           'imageFormat': 'Formato de Imagen no permitido (solo .png .jpg y .jpge).'
        }
      });

   	$(document).ready(function(){
         $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
         });
         $('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
   	});
   </script>

</html>
