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
      <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Raleway" rel="stylesheet">
      <!-- Scripts -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
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
               <section class="actividades col-md-12">
                  <ol class="breadcrumb">
                     <li><a href="{{ route('home') }}">Inicio</a></li>
                     <li class="active"> Categorias </li>
                  </ol>
                  @foreach ($tiposActividad as $tipoActividad)
                     <div class="col-md-3 col-sm-6 col-xs-6">
                        <a href="{{ action('ActividadController@indexPorCategoria', ['idTipoActividad' => $tipoActividad->idTipoActividad, 'fecha' => date('Y-m-d')]) }}">
                           <div class="cat-mini">
                              <div class="cat-mini-body">
                                 <img style="height: 150px;" class="img-rounded" src="{{ asset('storage/'.$tipoActividad->rutaImagen) }}" alt="No encontrada">
                              </div>
                              <div class="cat-mini-footer">
                                 <p style="text-align:center;"> <b>{{ $tipoActividad->tipo }}</b> </p>
                              </div>
                           </div>
                        </a>
                     </div>
                  @endforeach
               </section>

            {{--<aside class="col-md-3 col-sm-3 hidden-xs hidden-sm">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">Actividades Relacionadas</h3>
                  </div>
                  <section class="actividades-relacionadas">
                     @foreach ($relacionadas as $key => $relacionada)
                        <section class="activity-item"  style="height:90px;">
                           <a href="{{ action('ActividadController@member_show', ['id'=>$relacionada->idActividad]) }}" class="list-group-item act-rec"  style="height:90px;">
                              @if($actividad->rutaImagen == null)
                                 <img class="img-thumbnail pull-left" src="{{ asset('storage/'.$relacionada->tipoActividad->rutaImagen) }}" alt="No Disponible">
                              @else
                                 <img class="img-thumbnail pull-left" src="{{ asset('storage/'.$relacionada->rutaImagen) }}" alt="No Disponible">
                              @endif
                              <h5 class="act-rec-title"><b>{{ $relacionada->titulo }}</b></h5>
                              <p class="act-rec-descripcion text-justify"> {{ str_limit($relacionada->descripcion, 160) }} </p>
                           </a>
                        </section>
                     @endforeach
                  </section>
               </div>

               <section class="inscritos">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">Asistirán</h3>
                     </div>
                     <div class="signed-up">
                        <a href="#">
                           <div class="signed-up-img pull-left">
                              <img src="{{ asset('img/avatar3.png') }}" alt="No disponible" class="img-circle">
                           </div>
                           <div class="signed-up-data">
                              <div class="member-name"></i>Raul Álvarez Carbajasdadasdasdal</div>
                           </div>
                        </a>
                     </div>

                     <div class="signed-up">
                        <a href="#">
                           <div class="signed-up-img pull-left">
                              <img src="{{ asset('img/avatar3.png') }}" alt="No disponible" class="img-circle">
                           </div>
                           <div class="signed-up-data">
                              <div class="member-name"></i>Raul Álvarez Carbajasdadasdasdal</div>
                           </div>
                        </a>
                     </div>

                     <div class="signed-up">
                        <a href="#">
                           <div class="signed-up-img pull-left">
                              <img src="{{ asset('img/avatar3.png') }}" alt="No disponible" class="img-circle">
                           </div>
                           <div class="signed-up-data">
                              <div class="member-name"></i>Raul Álvarez Carbajasdadasdasdal</div>
                           </div>
                        </a>
                     </div>
                  </div>
               </section>
               <hr/>

            </aside>--}}
         </div>
            @include('layouts.partials.footer')
         </section>
      </div>
   </body>

</html>
