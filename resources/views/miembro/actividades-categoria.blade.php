<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>FacFar | Actividad</title>
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('facfar/facfar.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/datetimepicker-4.17.47/build/css/bootstrap-datetimepicker.min.css') }}"/>
      <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Raleway" rel="stylesheet">
      <!-- Scripts -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script>
      <script src="{{ asset('plugins/datetimepicker-4.17.47/build/js/bootstrap-datetimepicker.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   </head>
   <body>
      @include('layouts.partials.member-nav')
      <div id="wrapper">
         <section id="page-content-wrapper" class="content-princ container">
            @if(Auth::user() != null)
               @include('layouts.partials.sidebar')
            @endif

            <div class="row">
            <section class="actividades col-md-9">
               <ol class="breadcrumb">
                  <li><a href="{{ route('home') }}">Inicio</a></li>
                  <li><a href="{{ action('ActividadController@indexCategorias') }}">Categorías</a></li>
                  @if ($tipoActividad!=null)
                  <li class="active">{{ $tipoActividad->tipo }}</li>
                  @else
                  <li class="active">Todas</li>
                  @endif
               </ol>
               @if (count($actividades)==0)
                  <div class="col-md-12">
                    @if ($tipoActividad!=null)
                     <h4>No hay actividades de <b>{{ $tipoActividad->tipo }}</b> registradas.</h4>
                    @else
                     <h4>No hay actividades registradas.</h4>
                    @endif
                    <br><br>
                  </div>
               @else
                  @foreach ($actividades as $actividad)
                     @include('layouts.partials.act-media', [$actividad])
                  @endforeach
               @endif
            </section>
            <aside class="col-md-3 col-sm-3 hidden-xs hidden-sm">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Actividades por Fecha Publicación</h3>
                  </div>
                  <a id="link" href=""></a>
                  <div style="overflow:hidden;">
                     <div class="row">
                        <div class="col-md-12">
                          <div id="fechaSeleccionada"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </aside>
         </div>
            @include('layouts.partials.footer')
         </section>
      </div>

      <script type="text/javascript">
        $(document).ready(function (){
          $('#fechaSeleccionada ').datetimepicker({
         		format: 'YYYY-MM-DD',
         		useCurrent: false, // Important! See issue #1075
               inline:true,
               defaultDate:'{{ date("Y-m-d",strtotime($fecha)) }}'

         	});
          $('#fechaSeleccionada').on("dp.change", function(e){
                console.log($('#fechaSeleccionada').data('DateTimePicker').date().format('YYYY-MM-DD'));
                @if ($tipoActividad != null)
                $('#link').attr('href', '{{ action('ActividadController@indexPorCategoria',
                   ['idTipoActividad' => $tipoActividad->idTipoActividad, 'fecha' => '' ]) }}'+$('#fechaSeleccionada').data('DateTimePicker').date().format('YYYY-MM-DD'));
                @else
                $('#link').attr('href', '{{ action('ActividadController@indexPorCategoria',
                   ['idTipoActividad' => '0', 'fecha' => '' ]) }}'+$('#fechaSeleccionada').data('DateTimePicker').date().format('YYYY-MM-DD'));
                @endif
                document.getElementById('link').click();
         	});
        });
      </script>
   </body>

</html>
