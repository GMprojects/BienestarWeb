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
            <div class="row" style="margin-left:0px; margin-right:0px; margin-top: -20px;">
               <ol class="breadcrumb">
                  <li><a href="#">Inicio</a></li>
                  <li><a href="#">Categorías</a></li>
                  <li><a href="#">{{ $actividad->tipoactividad->tipo }}</a></li>
                  <li class="active">{{ str_limit($actividad->titulo, 20) }}</li>
               </ol>
            </div>
            <div class="row">
               <section class="organizadores col-md-3">
                  <div class="panel panel-default hidden-sm hidden-xs">
                     <div class="panel-heading">
                        @if($actividad->programador->sexo == 'm')
                           <h3 class="panel-title">Programadora</h3>
                        @else
                           <h3 class="panel-title">Programador</h3>
                        @endif
                     </div>
                     <div class="member">
                        <div class="member-img pull-left">
                           @if($actividad->programador->foto == null)
                              <a href="#"><img src="{{ asset('img/avatar3.png') }}" alt="Not found" class="img-circle"></a>
                           @else
                              <a href="#"><img src="{{ asset('storage/'.$actividad->programdor->foto) }}" alt="Not found" class="img-circle"></a>
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="#">{{ $actividad->programdor->nombre }} {{ $actividad->programdor->apellidoPaterno }} </a></div>
                           <div class="member-email"><a href="#">{{ $actividad->programdor->email }}</a></div>
                        </div>
                     </div>
                  </div>

                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">Responsable</h3>
                     </div>
                     <div class="member">
                        <div class="member-img pull-left">
                           @if($actividad->responsable->foto == null)
                              <a href="#"><img src="{{ asset('img/avatar3.png') }}" alt="Not found" class="img-circle"></a>
                           @else
                              <a href="#"><img src="{{ asset('storage/'.$actividad->responsable->foto) }}" alt="Not found" class="img-circle"></a>
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="#"></i>{{ $actividad->responsable->nombre }} {{ $actividad->responsable->apellidoPaterno }}</a></div>
                           <div class="member-email"><a href="#">{{ $actividad->responsable->email }}</a></div>
                        </div>
                     </div>
                  </div>

                  @if($actividad->invitado != '--')
                     <div class="panel panel-default hidden-sm hidden-xs">
                        <div class="panel-heading">
                           <h3 class="panel-title">Invitado</h3>
                        </div>
                        <div class="member">
                           <div class="member-img pull-left">
                              <a href="#"><img src="{{ asset('img/avatar3.png') }}" alt="Not found" class="img-circle"></a>
                           </div>
                           <div class="member-data">
                              <div class="member-name"><a href="#">Un Invitado</a></div>
                              <div class="member-email"><a href="#"></i>invitadoimpresionante@unitru.edu.pe</a></div>
                           </div>
                        </div>
                     </div>
                  @endif
               </section>
               <section class="col-md-6">
                  <div class="act-view">
                     <div class="act-view-header">
                        <img class="img-thumbnail" src="{{ asset('img/img5.jpg') }}" alt="No disponible">
                     </div>
                     <div class="act-view-body">
                        <div class="act-view-1">
                           <span class="act-view-title">Esta es una actividad con un titulo más grande, pero demasiado grande, que no cabe</span>
                        </div>
                        <hr class="act-hr">
                        <div class="act-view-details">
                           <div class="act-view-2" >
                              <div class="col-sm-6">
                                 <span class="text-muted">Cuándo?</span>
                                 <h4 class="no-mt">Sábado, 26 de Noviembre</h4>
                              </div>
                              <div class="col-sm-6">
                                 <span class="text-muted">A qué hora?</span>
                                 <h4 class="no-mt">12:00 p.m.</h4>
                              </div>
                              <div class="col-sm-12">
                                 <span class="text-muted">Dónde?</span>
                                 <h4 class="no-mt"><a href="#">Universidad Nacional de Trujillo</a></h4>
                              </div>
                           </div>
                           <div class="act-view-2" style="margin-left:15px; padding-right:15px;">
                              <button type="button" class="btn btn-sm btn-ff pull-right"><i class="fa fa-star-o"></i>Asistiré</button>
                              <h5 class="no-mt">
                                 <span class="label label-success rounded">14 asistirán</span>
                                 <span class="label label-danger rounded">6 restantes</span>
                              </h5>
                           </div>
                        </div>
                        <hr class="act-hr">
                        <div class="act-view-desc">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                              nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                              reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                              Excepteur sint occaecat cupidatat non proident,
                              sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                     </div>
                     <div class="act-view-footer">

                     </div>
                  </div>
               </section>
               <aside class="col-md-3 col-sm-3 hidden-xs hidden-sm">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">Actividades Relacionadas</h3>
                     </div>
                     <section class="actividades-relacionadas">

                        <section class="activity-item">
                           <a href="#" class="list-group-item act-rec">
                              <img class="img-thumbnail pull-left" src="{{ asset('img/act1.jpg') }}" alt="No disponible">
                              <h5 class="act-rec-title"><b>Una Actividad Reciente</b></h5>
                              <p class="act-rec-descripcion text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                           </a>
                        </section>

                        <section class="activity-item">
                           <a href="#" class="list-group-item act-rec">
                              <span class="thumb"><img class="img-thumbnail pull-left" src="{{ asset('img/act2.jpg') }}" alt="No disponible"></span>
                              <h5 class="act-rec-title"> <b>Una Actividad Reciente</b></h5>
                              <p class="act-rec-descripcion text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                           </a>
                        </section>

                        <section class="activity-item">
                           <a href="#" class="list-group-item act-rec">
                              <span class="thumb"><img class="img-thumbnail pull-left" src="{{ asset('img/act3.jpg') }}" alt="No disponible"></span>
                              <h5 class="act-rec-title"> <b>Una Actividad Reciente</b></h5>
                              <p class="act-rec-descripcion text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                           </a>
                        </section>
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
                                 <img src="{{ asset('img/avatar.png') }}" alt="Not found" class="img-circle">
                              </div>
                              <div class="signed-up-data">
                                 <div class="member-name"></i>Jhordy Abanto Castillo</div>
                              </div>
                           </a>
                        </div>

                        <div class="signed-up">
                           <a href="#">
                              <div class="signed-up-img pull-left">
                                 <img src="{{ asset('img/avatar4.png') }}" alt="Not found" class="img-circle">
                              </div>
                              <div class="signed-up-data">
                                 <div class="member-name"></i> Abelardo Abad Giron</div>
                              </div>
                           </a>
                        </div>

                        <div class="signed-up">
                           <a href="#">
                              <div class="signed-up-img pull-left">
                                 <img src="{{ asset('img/avatar5.png') }}" alt="Not found" class="img-circle">
                              </div>
                              <div class="signed-up-data">
                                 <div class="member-name"></i> Jordy Abanto Reyes</div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </section>
               </aside>
            </div>
            @include('layouts.partials.footer')
         </section>
      </div>
   </body>
</html>
