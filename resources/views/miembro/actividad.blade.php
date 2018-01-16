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
{{-- <div class="row">
   <div class="col-md-12">
      <ol class="breadcrumb">
         <li><a href="{{ route('home') }}">Inicio</a></li>
         <li><a href="#">Categorías</a></li>
         <li><a href="#">{{ $actividad->tipoactividad->tipo }}</a></li>
         <li class="active">{{ str_limit($actividad->titulo, 20) }}</li>
      </ol>
   </div>
</div>--}}

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
                              <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}"><img src="{{ asset('img/avatar3.png') }}" alt="No Encontrada" class="img-circle"></a>
                           @else
                              <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}"><img src="{{ asset('storage/'.$actividad->programador->foto) }}" alt="No Encontrada" class="img-circle"></a>
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}">{{ $actividad->programador->nombre }} {{ $actividad->programador->apellidoPaterno }} </a></div>
                           <div class="member-email"><a href="#" data-target = "#modal-email-p" data-toggle = "modal">{{ $actividad->programador->email }}</a></div>
                        </div>
                     </div>
                  </div>
                  {{--@include('miembro.modalEmail')--}}
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">Responsable</h3>
                     </div>
                     <div class="member">
                        <div class="member-img pull-left">
                           @if($actividad->responsable->foto == null)
                              <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->responsable]) }}"><img src="{{ asset('img/avatar3.png') }}" alt="No Encontrada" class="img-circle"></a>
                           @else
                              <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->responsable]) }}"><img src="{{ asset('storage/'.$actividad->responsable->foto) }}" alt="No Encontrada" class="img-circle"></a>
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="{{ action('MiPerfilController@show', ['id' =>$actividad->responsable]) }}"> {{ $actividad->responsable->nombre }} {{ $actividad->responsable->apellidoPaterno }}</a></div>
                           <div class="member-email"><a href="#" data-target = "#modal-email-r" data-toggle = "modal">{{ $actividad->responsable->email }}</a></div>
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
                              <a><img src="{{ asset('img/avatar3.png') }}" alt="No Encontrada" class="img-circle"></a>
                           </div>
                           <div class="member-data">
                              <div class="member-name">{{ preg_split("/[-]/",$actividad->invitado)[0] }} {{ preg_split("/[-]/",$actividad->invitado)[1] }}</div>
                              <div class="member-email"><a href="#" data-target = "#modal-email-ri" data-toggle = "modal">{{preg_split("/[-]/",$actividad->invitado)[2] }}</a></div>
                           </div>
                        </div>
                     </div>
                  @endif
               </section>
               <section class="col-md-6">

                  <div class="act-view">
                     <div class="act-view-img">
                        @if($actividad->rutaImagen == null)
                           <img class="img-thumbnail" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="No Encontrada">
                        @else
                           <img class="img-thumbnail" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="No Encontrada">
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
                              <div class="dt-txt-big">{{ Date::make($actividad->fechaInicio)->format('l\, d \d\e F') }}</div>
                           </div>
                        </div>
                        <div class="act-view-dt">
                           <div class="act-view-icon pull-left text-center">
                              <i class="fa fa-clock-o "></i>
                           </div>
                           <div class="dt-txt">
                              <span class="text-muted">A qué hora?</span>
                              <div class="dt-txt-big">{{ date("g:i A",strtotime($actividad->horaInicio)) }}</div>
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
                           @elseif( $actividad->idTipoActividad == 8 || $actividad->idTipoActividad == 9)
                              <span class="label ff-bg">Libre</span>
                           @elseif( $actividad->idTipoActividad == 4 )
                              <span class="label ff-bg-blue">TUTORADOS</span>
                           @endif
                        </div>
                     @if( $actividad->idTipoActividad == 4 )
                        @if(Auth::user()!= null && Auth::user()->idTipoPersona == 1 && Auth::user()->alumno->misInscripciones->contains('idActividad', $actividad->idActividad))
                           <h5><span class="label ff-bg-red">DEBO ASISTIR</span></h5>
                        @endif
                     @elseif($actividad->idTipoActividad == 8 || $actividad->idTipoActividad == 9)
                        <span class="pull-right label ff-bg-red rounded" style="font-size: 1.3em;">Presentar documentos</span>
                     @elseif(Auth::user()!=null)
                        @if(stripos($actividad->tipoActividad->dirigidoA, (String)Auth::user()->idTipoPersona)!== false)
                           @if(Auth::user()->idTipoPersona == 1 && Auth::user()->alumno->misInscripciones->contains('idActividad', $actividad->idActividad) ||
                              Auth::user()->idTipoPersona == 2 && Auth::user()->docente->misInscripciones->contains('idActividad', $actividad->idActividad) ||
                              Auth::user()->idTipoPersona == 3 && Auth::user()->administrativo->misInscripciones->contains('idActividad', $actividad->idActividad))
                              <a class="btn btn-ff pull-right" data-toggle="tooltip" data-placement="bottom" title="Ver detalles">
                                 <i class="fa fa-check-circle"></i> Asistiré
                              </a>
                           @else
                              @if( $actividad->estado == 1 )
                                 @if( $actividad->actividadGrupal != null && $actividad->actividadGrupal->cuposDisponibles > 0 )
                                    <a class="btn btn-ff pull-right" href="{{ route('inscripcion.store') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
                                       <i class="fa fa-circle-o"></i> Quiero Asistir
                                    </a>
                                 @else
                                    <span class="label ff-red">
                                       <i class="fa fa-times-circle"></i> No hay vacantes
                                    </span>
                                 @endif
                              @else
                                 <span class="label ff-red">
                                    <i class="fa fa-times-circle"></i> No disponible
                                 </span>
                              @endif

                           @endif
                        @else
                           <div class="act-mini-txt pull-right">
                              <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">No es para mí</span>
                           </div>
                        @endif
                     @else
                        <a class="btn btn-ff pull-right" href="{{ route('inscripcion.store') }}"
                           onclick="event.preventDefault();
                           document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
                           <i class="fa fa-circle-o"></i> Quiero Asistir
                        </a>
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
                  @if( count($relacionadas) > 0 )
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title">Actividades Relacionadas</h3>
                        </div>
                        <section class="actividades-relacionadas">
                           @foreach ($relacionadas as $key => $relacionada)
                              <section class="activity-item">
                                 <a href="{{ action('ActividadController@member_show', ['id'=>$relacionada->idActividad]) }}" class="list-group-item act-rec">
                                    <img class="img-thumbnail pull-left" src="{{ asset('img/act1.jpg') }}" alt="No disponible">
                                    <h5 class="act-rec-title"><b>{{ $relacionada->titulo }}</b></h5>
                                    <p class="act-rec-descripcion text-justify"> {{ $relacionada->descripcion }} </p>
                                 </a>
                              </section>
                           @endforeach
                        </section>
                     </div>
                  @endif

                  @if( count($insc_alum) > 0 )
                     <section class="alumnos_inscritos">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h3 class="panel-title">Estudiantes que asitirán</h3>
                           </div>
                           @foreach ($insc_alum as $alumno)
                              <div class="signed-up">
                                 <a href="{{ action('MiPerfilController@show', ['idPerfil' => $alumno->id ]) }}">
                                    <div class="signed-up-img pull-left">
                                       @if($alumno->foto != null)
                                          <img src="{{ asset('storage/'.$alumno->foto ) }}" class="img-circle" alt="No Encontrada">
                                       @else
                                          @if ($alumno->sexo == 'h')
                                             {{-- Hombre --}}
                                             <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="No Encontrada">
                                          @else{{-- Mujer --}}
                                             <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="No Encontrada">
                                          @endif
                                       @endif
                                       {{--<img src="{{ asset('storage/'.$alumno->foto ) }}" alt="No Encontrada" class="img-circle">--}}
                                    </div>
                                    <div class="signed-up-data">
                                       <div class="member-name"></i>{{ $alumno->nombre }} {{ $alumno->apellidoPaterno }}</div>
                                    </div>
                                 </a>
                              </div>
                           @endforeach
                        </div>
                     </section>
                  @endif

                  @if( count($insc_doce) > 0 )
                     <section class="alumnos_inscritos">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h3 class="panel-title">Docentes que asitirán</h3>
                           </div>
                           @foreach ($insc_doce as $docente)
                              <div class="signed-up">
                                 <a href="{{ action('MiPerfilController@show', ['idPerfil' => $docente->id ]) }}">
                                    <div class="signed-up-img pull-left">
                                       @if($docente->foto != null)
                                          <img src="{{ asset('storage/'.$docente->foto ) }}" class="img-circle" alt="No Encontrada">
                                       @else
                                          @if ($docente->sexo == 'h'){{-- Hombre --}}
                                             <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="No Encontrada">
                                          @else{{-- Mujer --}}
                                             <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="No Encontrada">
                                          @endif
                                       @endif
                                       {{--<img src="{{ asset('storage/'.$docente->foto ) }}" alt="No Encontrada" class="img-circle">--}}
                                    </div>
                                    <div class="signed-up-data">
                                       <div class="member-name"></i>{{ $docente->nombre }} {{ $docente->apellidoPaterno }}</div>
                                    </div>
                                 </a>
                              </div>
                           @endforeach
                        </div>
                     </section>
                  @endif

                  @if( count($insc_admi) > 0 )
                     <section class="alumnos_inscritos">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h3 class="panel-title">Administrativos que asitirán</h3>
                           </div>
                           @foreach ($insc_admi as $administrativo)
                              <div class="signed-up">
                                 <a href="{{ action('MiPerfilController@show', ['idPerfil' => $administrativo->id ]) }}">
                                    <div class="signed-up-img pull-left">
                                       @if($administrativo->foto != null)
                                          <img src="{{ asset('storage/'.$administrativo->foto ) }}" class="img-circle" alt="No Encontrada">
                                       @else
                                          @if ($administrativo->sexo == 'h'){{-- Hombre --}}
                                             <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="No Encontrada">
                                          @else{{-- Mujer --}}
                                             <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="No Encontrada">
                                          @endif
                                       @endif
                                       {{--<img src="{{ asset('storage/'.$administrativo->foto ) }}" alt="No Encontrada" class="img-circle">--}}
                                    </div>
                                    <div class="signed-up-data">
                                       <div class="member-name"></i>{{ $administrativo->nombre }} {{ $administrativo->apellidoPaterno }}</div>
                                    </div>
                                 </a>
                              </div>
                           @endforeach
                        </div>
                     </section>
                  @endif

               </aside>
            </div>
            @include('layouts.partials.footer')
         </section>
      </div>
   </body>
</html>
