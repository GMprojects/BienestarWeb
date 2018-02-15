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
                     <li><a href="{{ action('ActividadController@indexCategorias') }}">Categorías</a></li>
                     <li><a href="{{ action('ActividadController@indexPorCategoria', ['idTipoActividad' => $actividad->idTipoActividad, 'fecha' => date('Y-m-d')]) }}">{{ $actividad->tipoactividad->tipo }}</a></li>
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
                           @if($actividad->programador->foto != null)
                              <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}"><img src="{{ asset('storage/'.$actividad->programador->foto) }}" alt="No Disponible" class="img-circle"></a>
                           @else
                              @if ($actividad->programador->sexo == 'h'){{-- Hombre --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}"><img src="{{ asset('img/avatar5.png') }}" alt="No Disponible" class="img-circle"></a>
                              @else{{-- Mujer --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}"><img src="{{ asset('img/avatar2.png') }}" alt="No Disponible" class="img-circle"></a>
                              @endif
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}">{{ $actividad->programador->nombre }} {{ $actividad->programador->apellidoPaterno }} </a></div>
                           <div class="member-email"><a href="#" data-target = "#modal-email-p" data-toggle = "modal">{{ $actividad->programador->email }}</a></div>
                        </div>
                     </div>
                  </div>
                  @include('miembro.modalEmail')
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title">Responsable</h3>
                     </div>
                     <div class="member">
                        <div class="member-img pull-left">
                           @if($actividad->responsable->foto != null)
                              <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->responsable]) }}"><img src="{{ asset('storage/'.$actividad->responsable->foto) }}" alt="No Disponible" class="img-circle"></a>
                           @else
                              @if ($actividad->responsable->sexo == 'h'){{-- Hombre --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->responsable]) }}"><img src="{{ asset('img/avatar5.png') }}" alt="No Disponible" class="img-circle"></a>
                              @else{{-- Mujer --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->responsable]) }}"><img src="{{ asset('img/avatar2.png') }}" alt="No Disponible" class="img-circle"></a>
                              @endif
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
                              <a><img src="{{ asset('img/avatar3.png') }}" alt="No Disponible" class="img-circle"></a>
                           </div>
                           <div class="member-data">
                              <div class="member-name">{{ preg_split("/[-]/",$actividad->invitado)[0] }} {{ preg_split("/[-]/",$actividad->invitado)[1] }}</div>
                              <div class="member-email"><a href="#" data-target = "#modal-email-ri" data-toggle = "modal">{{preg_split("/[-]/",$actividad->invitado)[2] }}</a></div>
                           </div>
                        </div>
                     </div>
                  @endif
               </section>
                  @php
                     $diferencia = strtotime($actividad->fechaInicio) - strtotime(date('Y-m-d'));
                     $diasRestantes = intval($diferencia/86400);
                  @endphp
               <section class="col-md-6">
                  <div class="act-view">
                     <div class="act-view-img">
                        <p>
                           @if($actividad->rutaImagen == null)
                              <img class="img-thumbnail" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="No Disponible">
                           @else
                              <img class="img-thumbnail" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="No Disponible">
                           @endif
                           @switch( $actividad->estado )
                              @case(1) @case(4)
                                 @php
                                    $diferencia = strtotime($actividad->fechaInicio) - strtotime(date('Y-m-d'));
                                    $diasRestantes = intval($diferencia/86400);
                                 @endphp
                                 @if ($diasRestantes < 0)
                                    <span class="label-imagen-actividad" style="background-color:#FF8D00;">Expirada<span>
                                 @endif
                              @break
                              @case(2)
                                    <span class="label-imagen-actividad" style="background-color:#4CAE4C;">Realizada<span>
                              @break
                              @case(3)
                                    <span class="label-imagen-actividad" style="background-color:#C3301F;">Cancelada</span>
                              @break
                           @endswitch
                        </p>
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
                              <div class="dt-txt-big">{{ $actividad->lugar }}</div>
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
                        <div class="act-view-insc pull-right">
                           @if( $actividad->idTipoActividad == 4 )
                              @if(Auth::user() !=null && Auth::user()->idTipoPersona == 1 && Auth::user()->alumno->misInscripciones->contains('idActividad', $actividad->idActividad))
                                 <div class="label ff-bg-blue" style="border-radius: 25px;">Debo Asistir</div>
                              @else
                                 <div class="label ff-bg-red" style="border-radius: 25px;">Exclusiva: Tutorados</div>
                              @endif
                           @elseif($actividad->idTipoActividad == 8 || $actividad->idTipoActividad == 9)
                              <div class="label ff-bg-aqua" style="border-radius: 25px;">Presentar documentos</div>
                           @elseif(Auth::user()!=null)
                                 @if(stripos($actividad->tipoActividad->dirigidoA, (String)Auth::user()->idTipoPersona)!== false)
                                       @if(Auth::user()->idTipoPersona == 1 && Auth::user()->alumno->misInscripciones->contains('idActividad', $actividad->idActividad) ||
                                          Auth::user()->idTipoPersona == 2 && Auth::user()->docente->misInscripciones->contains('idActividad', $actividad->idActividad) ||
                                          Auth::user()->idTipoPersona == 3 && Auth::user()->administrativo->misInscripciones->contains('idActividad', $actividad->idActividad))
                                          <div class="label ff-bg-blue" style="border-radius: 25px;">
                                                <i class="fa fa-check-circle"></i> <span>Asistiré</span>
                                          </div>
                                       @else
                                             @if( $actividad->estado == 1  && $diasRestantes > 0 )
                                                   @if( $actividad->actividadGrupal != null && $actividad->actividadGrupal->cuposDisponibles > 0 )
                                                         @if( $actividad->idUserResp != Auth::user()->id )
                                                               @if (Auth::user()!=null)
                                                                 <a class="btn btn-ff pull-right" href="#" data-toggle="modal" data-target="#confirmModal-{{ $actividad->idActividad }}" style="border-radius: 25px;" >
                                                                   <i class="fa fa-circle-o"></i> Quiero Asistir
                                                                </a>
                                                               @endif
                                                         @else
                                                            <div class="label ff-bg-aqua" style="border-radius: 25px;">
                                                               <span style="color:white;">Soy Responsable</span>
                                                            </div>
                                                         @endif
                                                   @else
                                                      <div class="label ff-bg-red" style="border-radius: 25px;">
                                                         <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">No hay vacantes</span>
                                                      </div>
                                                   @endif
                                             @else
                                                <div class="label ff-bg-red" style="border-radius: 25px;">
                                                   <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">No disponible</span>
                                                </div>
                                             @endif

                                       @endif
                                 @else
                                    @if (strlen($actividad->tipoActividad->dirigidoA) == 1)
                                       @if (stripos($actividad->tipoActividad->dirigidoA,'1')!==false)
                                          <div class="label ff-bg-red" style="border-radius: 25px;">Exclusiva: Alumnos</div>
                                       @elseif (stripos($actividad->tipoActividad->dirigidoA,'2')!==false)
                                          <div class="label ff-bg-red" style="border-radius: 25px;">Exclusiva: Docentes</div>
                                       @else
                                          <div class="label ff-bg-red" style="border-radius: 25px;">Exclusiva: Administrativos</div>
                                       @endif
                                    @elseif(strlen($actividad->tipoActividad->dirigidoA) == 2)
                                       @if (stripos($actividad->tipoActividad->dirigidoA,'1')!==false && stripos($actividad->tipoActividad->dirigidoA,'2')!==false)
                                          {{-- Alumnos-Docentes --}}
                                          <div class="label ff-bg-red" style="border-radius: 25px;">Exclusiva: Alumnos y Docentes</div>
                                       @elseif (stripos($actividad->tipoActividad->dirigidoA,'1')!==false && stripos($actividad->tipoActividad->dirigidoA,'3')!==false)
                                          {{-- Alumnos-Administrativos --}}
                                          <div class="label ff-bg-red" style="border-radius: 25px;">Exclusiva: Alumnos y Administrativos</div>
                                       @else
                                          {{-- Docentes-Administrativos --}}
                                          <div class="label ff-bg-red" style="border-radius: 25px;">Exclusiva: Docentes y Administrativos</div>
                                       @endif
                                    @else
                                       {{-- Alumnos-Docentes-Administrativos --}}
                                       <div class="label ff-bg-red" style="border-radius: 25px;">
                                          <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">No disponible</span>
                                       </div>
                                    @endif
                                 @endif
                           @else
                                 @if (Auth::user()!=null)
                                    <a class="btn btn-ff pull-right" href="#" data-toggle="modal" data-target="#confirmModal-{{ $actividad->idActividad }}" style="border-radius: 25px;" >
                                      <i class="fa fa-circle-o"></i> Quiero Asistir
                                   </a>
                                 @endif
                           @endif
                        </div>
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
                                          <img src="{{ asset('storage/'.$alumno->foto ) }}" class="img-circle" alt="No Disponible">
                                       @else
                                          @if ($alumno->sexo == 'h')
                                             {{-- Hombre --}}
                                             <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="No Disponible">
                                          @else{{-- Mujer --}}
                                             <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="No Disponible">
                                          @endif
                                       @endif
                                       {{--<img src="{{ asset('storage/'.$alumno->foto ) }}" alt="No Disponible" class="img-circle">--}}
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
                                          <img src="{{ asset('storage/'.$docente->foto ) }}" class="img-circle" alt="No Disponible">
                                       @else
                                          @if ($docente->sexo == 'h'){{-- Hombre --}}
                                             <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="No Disponible">
                                          @else{{-- Mujer --}}
                                             <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="No Disponible">
                                          @endif
                                       @endif
                                       {{--<img src="{{ asset('storage/'.$docente->foto ) }}" alt="No Disponible" class="img-circle">--}}
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
                                          <img src="{{ asset('storage/'.$administrativo->foto ) }}" class="img-circle" alt="No Disponible">
                                       @else
                                          @if ($administrativo->sexo == 'h'){{-- Hombre --}}
                                             <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="No Disponible">
                                          @else{{-- Mujer --}}
                                             <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="No Disponible">
                                          @endif
                                       @endif
                                       {{--<img src="{{ asset('storage/'.$administrativo->foto ) }}" alt="No Disponible" class="img-circle">--}}
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
            <div class="modal fade" id="confirmModal-{{ $actividad->idActividad }}" tabindex="-1" role="dialog" aria-labelledby="lb-confMod-{{ $actividad->idActividad }}">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header" style="background-color:#337AB7; color:white; border-radius:4px 4px 0px 0px;">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
                           <h4 class="modal-title" id="lb-confMod-{{ $actividad->idActividad }}"><b>Confirme su Inscripción</b></h4>
                     </div>
                     <div class="modal-body">
                        <p> <b>Actividad:</b>  <b style="color: #4B367C">"{{ $actividad->titulo }}" </b> </p>
                        <p> <b>Fecha:</b>
                           @if (date("d/m/Y",strtotime($actividad->fechaInicio)) == date("d/m/Y",strtotime($actividad->fechaFin)))
                                 {{ Date::make($actividad->fechaInicio)->format('l\, d \d\e F') .'  desde las '.date("g:i A",strtotime($actividad->horaInicio)).'  hasta las '.date("g:i A",strtotime($actividad->horaFin)) }}
                           @else
                                 {{ Date::make($actividad->fechaInicio)->format('l\, d \d\e F').' '.date("g:i A",strtotime($actividad->horaInicio)).'  hasta '.Date::make($actividad->fechaFin)->format('l\, d \d\e F').' '.date("g:i A",strtotime($actividad->horaFin)) }}
                           @endif
                        </p>
                        <p> <b>Lugar:</b>  {{ $actividad->lugar }}</p>
                     </div>
                     <div class="modal-footer">
                        <div class="pull-left">
                           <button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
                        </div>
                        <div class="pull-right">
                           <button type="submit" class="btn btn-ff" onclick="event.preventDefault();
                           document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
                           <i class="fa fa-check"></i> Confirmar</button>
                           <form id="inscripcion-form-{{ $actividad->idActividad }}" action="{{ route('inscripcion.store', ['idActividad' => $actividad->idActividad]) }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </body>
</html>
