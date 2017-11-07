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
               <div class="col-md-12">
                  <ol class="breadcrumb">
                     <li><a href="{{ route('home') }}">Inicio</a></li>
                     <li><a href="#">Categorías</a></li>
                     <li><a href="#">{{ $actividad->tipoactividad->tipo }}</a></li>
                     <li class="active">{{ str_limit($actividad->titulo, 20) }}</li>
                  </ol>
               </div>
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
                              <a href="#"><img src="{{ asset('storage/'.$actividad->programador->foto) }}" alt="Not found" class="img-circle"></a>
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="#">{{ $actividad->programador->nombre }} {{ $actividad->programador->apellidoPaterno }} </a></div>
                           <div class="member-email"><a href="#">{{ $actividad->programador->email }}</a></div>
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
                           <div class="member-name"><a href="{{ action('PerfilController@show', ['id' =>$actividad->responsable]) }}"></i>{{ $actividad->responsable->nombre }} {{ $actividad->responsable->apellidoPaterno }}</a></div>
                           <div class="member-email"><a href="#">{{ $actividad->responsable->email }}</a></div>
                        </div>
                     </div>
                  </div>

                  @if($actividad->invitado != null)
                     <div class="panel panel-default hidden-sm hidden-xs">
                        <div class="panel-heading">
                           <h3 class="panel-title">Invitado</h3>
                        </div>
                        <div class="member">
                           <div class="member-img pull-left">
                              <a href="#"><img src="{{ asset('img/avatar3.png') }}" alt="Not found" class="img-circle"></a>
                           </div>
                           <div class="member-data">
                              <div class="member-name"><a href="#">{{ preg_split("/[-]/",$actividad->invitado)[0] }} {{ preg_split("/[-]/",$actividad->invitado)[1] }}</a></div>
                              <div class="member-email"><a href="#">{{preg_split("/[-]/",$actividad->invitado)[2] }}</a></div>
                           </div>
                        </div>
                     </div>
                  @endif
               </section>
               <section class="col-md-6">

                  <div class="act-view">
                     <div class="act-view-img">
                        @if($actividad->rutaImagen == null)
                           <img class="img-thumbnail" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="Not found">
                        @else
                           <img class="img-thumbnail" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="Not found">
                        @endif
                     </div>
                     <div class="act-view-title">{{ $actividad->titulo }}</div>
                     <div class="act-view-www">
                        <div class="act-view-dt">
                           <div class="act-view-icon pull-left text-center">
                              <i class="fa fa-calendar text-center"></i>
                           </div>
                           <div class="dt-txt">
                              <span class="text-muted">Cuándo?</span>
                              <div class="dt-txt-big">{{ date('l, d', strtotime( $actividad->fechaInicio )) }} de {{ date('F', strtotime( $actividad->fechaInicio )) }}</div>
                           </div>
                        </div>
                        <div class="act-view-dt">
                           <div class="act-view-icon pull-left text-center">
                              <i class="fa fa-clock-o "></i>
                           </div>
                           <div class="dt-txt">
                              <span class="text-muted">A qué hora?</span>
                              <div class="dt-txt-big">{{ date('G:i', strtotime( $actividad->horaInicio )) }}</div>
                           </div>
                        </div>
                        <div class="act-view-dt">
                           <div class="act-view-icon pull-left text-center">
                              <i class="fa fa-map-marker "></i>
                           </div>
                           <div class="dt-txt">
                              <span class="text-muted">Dónde?</span>
                              <div class="dt-txt-big"><a href="#">{{ $actividad->lugar }}</a></div>
                           </div>
                        </div>
                        @if($actividad->referencia != null)
                           <div class="act-view-dt">
                              <div class="act-view-icon pull-left text-center">
                                 <i class="fa fa-map-marker "></i>
                              </div>
                              <div class="dt-txt">
                                 <span class="text-muted">Y si mi pierdo?</span>
                                 <div class="dt-txt-big">{{ $actividad->referencia }}</div>
                              </div>
                           </div>
                        @endif
                     </div>
                     <div class="act-view-nums">
                        <div class="act-view-insc pull-left">
                           @if( $actividad->actividadGrupal!= null )
                              <span class="label label-success">{{ $actividad->actividadGrupal->cuposOcupados }} asistirán</span>
                              <span class="label label-danger">{{ $actividad->actividadGrupal->cuposDisponibles }} restantes</span>
                           @else
                              <span class="label label-danger">TUTORADOS</span>
                           @endif
                        </div>
                        @if(in_array($actividad->idActividad, $list_insc))
                           <a class="btn btn-ff pull-right" href="{{ action('ActividadController@member_show', $actividad->idActividad) }}" data-toggle="tooltip" data-placement="bottom" title="Ver detalles">
                              <i class="fa fa-check-circle"></i> Asistiré
                           </a>
                        @else
                           @if(Auth::user() == null || $actividad->idActividad != 4 || $actividad->actividadGrupal->cuposDisponibles > 0)
                              <a class="btn btn-ff pull-right" href="{{ route('inscripcion.store') }}"
                                 onclick="event.preventDefault();
                                 document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
                                 <i class="fa fa-circle-o"></i> Deseo Asistir
                              </a>
                              <form id="inscripcion-form-{{ $actividad->idActividad }}" action="{{ route('inscripcion.store', ['idActividad' => $actividad->idActividad]) }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                              </form>
                           @else
                              <a class="act-mini-txt pull-right" href="#" data-toggle="tooltip" data-placement="bottom" title="Click para contactar con el programador?">
                                 <i class="fa fa-times-circle"></i> Inscripcion no disponible
                              </a>
                           @endif
                        @endif
                     </div>
                     <div class="act-view-desc">
                        <div class="dt-txt-big">Descripción</div>
                        <p>{{ $actividad->descripcion }}</p>
                     </div>
                     @if($actividad->informacionAdicional != null)
                        <div class="act-view-info">
                           <div class="dt-txt-big">Información Adicional</div>
                           <p>{{ $actividad->informacionAdicional }}</p>
                        </div>
                     @endif
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
