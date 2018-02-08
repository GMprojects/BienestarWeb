<article class="actividad clearfix">
   @php
      $diferencia = strtotime($actividad->fechaInicio) - strtotime(date('Y-m-d'));
      $diasRestantes = intval($diferencia/86400);
   @endphp
   <div class="act-header">
      <div class="row">
         <div class="col-md-12">
            <div class="pull-left">
               <h4 class="act-title">
                  <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ $actividad->titulo }}">{{ $actividad->titulo }}</a>
               </h4>
            </div>
            <div class="pull-right">
               @switch( $actividad->estado )
                  @case(1)
                     @if( $actividad->idTipoActividad == 4 )
                        @if(Auth::user() !=null && Auth::user()->idTipoPersona == 1 && Auth::user()->alumno->misInscripciones->contains('idActividad', $actividad->idActividad)))
                           <div class="act-mini-txt pull-right">DEBO ASISTIR</div>
                        @else
                           <div class="act-mini-txt pull-right">Exclusiva: Tutorados</div>
                        @endif
                     @elseif($actividad->idTipoActividad == 8 || $actividad->idTipoActividad == 9)
                        <div class="act-mini-txt pull-right">Presentar documentos</div>
                     @elseif(Auth::user()!=null)
                        @if(stripos($actividad->tipoActividad->dirigidoA, (String)Auth::user()->idTipoPersona)!== false)
                           @if(Auth::user()->idTipoPersona == 1 && Auth::user()->alumno->misInscripciones->contains('idActividad', $actividad->idActividad) ||
                              Auth::user()->idTipoPersona == 2 && Auth::user()->docente->misInscripciones->contains('idActividad', $actividad->idActividad) ||
                              Auth::user()->idTipoPersona == 3 && Auth::user()->administrativo->misInscripciones->contains('idActividad', $actividad->idActividad))
                              <div class="act-mini-txt pull-right">
                                 <i style="color:black;" class="fa fa-check-circle"></i> <span style="color:black;">Asistiré</span>
                              </div>
                           @else
                              @if( $actividad->estado == 1 && $diasRestantes > 0 )
                                 @if( $actividad->actividadGrupal != null && $actividad->actividadGrupal->cuposDisponibles > 0 )
                                    @if( $actividad->idUserResp != Auth::user()->id )
                                       @if (Auth::user()!=null)
                                          <a class="btn btn-ff pull-right" href="#" data-toggle="modal" data-target="#confirmModal-{{ $actividad->idActividad }}">
                                            <i class="fa fa-circle-o"></i> Quiero Asistir
                                         </a>
                                       @endif
                                    @else
                                       <div class="act-mini-txt pull-right">
                                          <i style="color:black;" class="fa fa-times-circle"></i> <span style="color:black;">Soy Responsable</span>
                                       </div>
                                    @endif
                                 @else
                                    <div class="act-mini-txt pull-right">
                                       <i style="color:black;" class="fa fa-times-circle"></i> <span style="color:black;">No hay vacantes</span>
                                    </div>
                                 @endif
                              @else
                                 <div class="act-mini-txt pull-right">
                                    <i style="color:black;" class="fa fa-times-circle"></i> <span style="color:black;">No disponible</span>
                                 </div>
                              @endif

                           @endif
                        @else
                           <div class="act-mini-txt pull-right">
                              <i style="color:black;" class="fa fa-times-circle"></i> <span style="color:black;">No disponible</span>
                           </div>
                        @endif
                     @else
                        @if (Auth::user()!=null)
                           <a class="btn-footer pull-right" href="#" data-toggle="modal" data-target="#confirmModal-{{ $actividad->idActividad }}">
                              <i class="fa fa-circle-o"></i> Quiero Asistir
                           </a>
                        @endif
                     @endif
                  @break
                  @case(2)
                     <div class="act-mini-txt pull-right">
                        <i style="color:black;" class="fa fa-calendar-check-o"></i> <span style="color:black;">Actividad Realizada</span>
                     </div>
                  @break
                  @case(3)
                     <div class="act-mini-txt pull-right">
                        <i style="color:black;" class="fa fa-times-circle"></i> <span style="color:black;">Actividad Cancelada</span>
                     </div>
                  @break
                  @case(4)
                     <div class="act-mini-txt pull-right">
                        <i style="color:black;" class="fa fa-calendar-times-o"></i> <span style="color:black;">Actividad Expirada</span>
                     </div>
                  @break
               @endswitch
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <small>
               Programada para el  <i class="fa fa-calendar"></i>
               <span class="act-fecha">{{ Date::make($actividad->fechaInicio)->format('d \d\e F \d\e\l Y' ) }} </span> por
               <span class="act-programador">
                  <a href="{{ action('MiPerfilController@show', ['id' =>$actividad->programador]) }}">{{ $actividad->programador->nombre }} {{ $actividad->programador->apellidoPaterno }} </a>
               </span>
               <span class="act-separator">/</span>
               <span class="act-categoria"> Categoría: <a href="{{ action('ActividadController@indexCategorias') }}">{{ $actividad->tipoActividad->tipo }}</a>
                  <span class="act-separator">/</span>
               </span>
               @switch( $actividad->estado )
                  @case(1)  @case(4)
                     @if ($diasRestantes < 0)
                        <span class="label ff-bg-orange act-estado">Expirada</span>
                     @else
                        <span class="label ff-bg-blue act-estado">
                           @if ($diasRestantes == 1)
                              Faltan {{ '1 día'}}
                           @else
                              Faltan {{$diasRestantes.' días'}}
                           @endif
                        </span>
                     @endif
                  @break
                  @case(2)
                        <span class="label ff-bg-green act-estado">Ejecutada</span>
                  @break
                  @case(3)
                        <span class="label ff-bg-red act-estado">Cancelada</span>
                  @break
               @endswitch
            </small>
         </div>
      </div>
   </div>

   <hr class="act-hr"/>
   <div class="act-body row">
      <div class="col-md-12">
         <p>
            @if( $actividad->rutaImagen == null )
               <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}" class="thumb pull-left"><img class="thumb pull-left" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="No Disponible"></a>
            @else
               <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}" class="thumb pull-left"><img class="thumb pull-left" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="No Disponible"></a>
            @endif
            @switch( $actividad->estado )
               @case(1) @case(4)
                  @php
                     $diferencia = strtotime($actividad->fechaInicio) - strtotime(date('Y-m-d'));
                     $diasRestantes = intval($diferencia/86400);
                  @endphp
                  @if ($diasRestantes < 0)
                     <span class="label-imagen" style="background-color:#FF8D00;">Expirada<span>
                  @endif
               @break
               @case(2)
                     <span class="label-imagen" style="background-color:#4CAE4C;">Realizada<span>
               @break
               @case(3)
                     <span class="label-imagen" style="background-color:#C3301F;">Cancelada</span>
               @break
            @endswitch
         </p>
         <p> <b>Fecha Programada:</b> {{ Date::make($actividad->fechaInicio)->format('l\, d \d\e F \d\e\l Y') }} a las {{ date("g:i A",strtotime($actividad->horaInicio)) }} </p>
         <p class="act-descripcion text-justify"> {{ str_limit($actividad->descripcion, 500) }} </p>
      </div>
   </div>
   <hr class="act-hr" />
   <div class="row  act-footer">
      <div class="col-md-8 col-sm-8 col-xs-4">
         @if($actividad->actividadGrupal != null)
            <span class="label ff-bg-green">{{ $actividad->actividadGrupal->cuposOcupados }} Asistirán</span>
            <span class="label ff-bg-red">{{ $actividad->actividadGrupal->cuposDisponibles }} Disponibles</span>
         @elseif ($actividad->idTipoActividad == 8 || $actividad->idTipoActividad == 9)
            <span class="label ff-bg">LIBRE</span>
         @else
            <span class="label ff-bg-blue">TUTORADOS</span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4 col-xs-8 text-right">
         <div class="btn-group">
            <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}" class="btn btn-ff-blues"> <i class="fa fa-eye"></i> Ver Más...</a>
         </div>
      </div>
   </div>
</article>
<div class="modal fade" id="confirmModal-{{ $actividad->idActividad }}" tabindex="-1" role="dialog" aria-labelledby="lb-confMod-{{ $actividad->idActividad }}">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#337AB7; color:black; border-radius:6px 6px 0px 0px;">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
               <h4 class="modal-title" id="lb-confMod-{{ $actividad->idActividad }}"><b style="color:white;">Confirme su Inscripción</b></h4>
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
