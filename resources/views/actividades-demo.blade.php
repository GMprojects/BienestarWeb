<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>FacFar | Home</title>
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
            <section class="actividades col-md-9">
               <ol class="breadcrumb">
                  <li><a href="#">Inicio</a></li>
                  <li><a href="#">Categorías</a></li>
                  <li class="active">Deportes</li>
               </ol>

               <article class="actividad clearfix">
                  <div class="act-header">
                     <h4 class="act-title"><a href="#">Una nueva actividad programada mejorada evolucionada</a></h4>
                     <small>Publicado el  <i class="fa fa-calendar"></i><span class="act-fecha">26 enero del 2017</span> por <span class="act-programador"><a href="#">Maria Guevara</a></span>
                     <span class="act-separator">/</span><span class="act-categoria"> Categoría: <a href="#">Psicología</a><span class="act-separator">/</span></span><span class="label label-success act-estado"> Faltan 3 días</span></small>
                  </div>
                  <hr class="act-hr"/>
                  <div class="act-body row">
                     <div class="col-md-12">
                        <p>
                           <a href="#" class="thumb pull-left">
                           <img class="img-thumbnail" src="{{ asset('img/act1.jpg') }}" alt="No disponible"></a>
                        </p>
                        <p class="act-descripcion text-justify">
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                     </div>
                  </div>
                  <hr class="act-hr" />
                  <div class="row  act-footer">
                     <div class="col-md-8 col-sm-8 col-xs-4">
                        <span class="label label-success rounded">14 Registrados</span>
                        <span class="label label-danger rounded">6 Restantes</span>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-8 text-right">
                        <div class="btn-group">
                           <a href="#" class="btn btn-facfar-flat">Info</a>
                           <button type="btn" class="btn btn-facfar">
                              Inscribirme
                           </button>
                        </div>
                     </div>
                  </div>
               </article>

               <article class="actividad clearfix">
                  <div class="act-header">
                     <h4 class="act-title"><a href="#">Una nueva actividad programada mejorada evolucionada</a></h4>
                     <small>Publicado el  <i class="fa fa-calendar"></i><span class="act-fecha">26 enero del 2017</span> por <span class="act-programador"><a href="#">Maria Guevara</a></span>
                     <span class="act-separator">/</span><span class="act-categoria"> Categoría: <a href="#">Psicología</a><span class="act-separator">/</span></span><span class="label label-success act-estado"> Faltan 3 días</span></small>
                  </div>
                  <hr class="act-hr"/>
                  <div class="act-body row">
                     <div class="col-md-12">
                        <p>
                           <a href="#" class="thumb pull-left">
                           <img class="img-thumbnail" src="{{ asset('img/act2.jpg') }}" alt="No disponible"></a>
                        </p>
                        <p class="act-descripcion text-justify">
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                     </div>
                  </div>
                  <hr class="act-hr" />
                  <div class="row  act-footer">
                     <div class="col-md-8 col-sm-8 col-xs-4">
                        <span class="label label-success rounded">14 Registrados</span>
                        <span class="label label-danger rounded">6 Restantes</span>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-8 text-right">
                        <div class="btn-group">
                           <a href="#" class="btn btn-facfar-flat">Info</a>
                           <button type="btn" class="btn btn-facfar">
                              Inscribirme
                           </button>
                        </div>
                     </div>
                  </div>
               </article>

               <article class="actividad clearfix">
                  <div class="act-header">
                     <h4 class="act-title"><a href="#">Una nueva actividad programada mejorada evolucionada</a></h4>
                     <small>Publicado el  <i class="fa fa-calendar"></i><span class="act-fecha">26 enero del 2017</span> por <span class="act-programador"><a href="#">Maria Guevara</a></span>
                     <span class="act-separator">/</span><span class="act-categoria"> Categoría: <a href="#">Psicología</a><span class="act-separator">/</span></span><span class="label label-success act-estado"> Faltan 3 días</span></small>
                  </div>
                  <hr class="act-hr"/>
                  <div class="act-body row">
                     <div class="col-md-12">
                        <p>
                           <a href="#" class="thumb pull-left">
                           <img class="img-thumbnail" src="{{ asset('img/act3.jpg') }}" alt="No disponible"></a>
                        </p>
                        <p class="act-descripcion text-justify">
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                     </div>
                  </div>
                  <hr class="act-hr" />
                  <div class="row  act-footer">
                     <div class="col-md-8 col-sm-8 col-xs-4">
                        <span class="label label-success rounded">14 Registrados</span>
                        <span class="label label-danger rounded">6 Restantes</span>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-8 text-right">
                        <div class="btn-group">
                           <a href="#" class="btn btn-facfar-flat">Info</a>
                           <button type="btn" class="btn btn-facfar">
                              Inscribirme
                           </button>
                        </div>
                     </div>
                  </div>
               </article>
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
                              <img src="{{ asset('img/avatar3.png') }}" alt="Not found" class="img-circle">
                           </div>
                           <div class="signed-up-data">
                              <div class="member-name"></i>Raul Álvarez Carbajasdadasdasdal</div>
                           </div>
                        </a>
                     </div>

                     <div class="signed-up">
                        <a href="#">
                           <div class="signed-up-img pull-left">
                              <img src="{{ asset('img/avatar3.png') }}" alt="Not found" class="img-circle">
                           </div>
                           <div class="signed-up-data">
                              <div class="member-name"></i>Raul Álvarez Carbajasdadasdasdal</div>
                           </div>
                        </a>
                     </div>

                     <div class="signed-up">
                        <a href="#">
                           <div class="signed-up-img pull-left">
                              <img src="{{ asset('img/avatar3.png') }}" alt="Not found" class="img-circle">
                           </div>
                           <div class="signed-up-data">
                              <div class="member-name"></i>Raul Álvarez Carbajasdadasdasdal</div>
                           </div>
                        </a>
                     </div>
                  </div>
               </section>
               <hr/>

            </aside>
         </div>
            @include('layouts.partials.footer')
         </section>
      </div>
   </body>

</html>
