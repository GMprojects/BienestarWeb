<div class="col-md-4 col-sm-6 act-mini-container">

   <div class="act-mini">
      <div class="act-mini-header">
         @if( $actividad->rutaImagen == null )
            <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}"><img style="height: 220px;" class="img-rounded" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="Not found"></a>
         @else
            <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}"><img style="height: 220px;" class="img-rounded" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="Not found"></a>
         @endif
      </div>
      <div class="act-mini-body" >
         <div class="ff-calendar">
            <span class="ff-month">{{ date('M', strtotime( $actividad->fechaInicio )) }}</span>
            <span class="ff-day">{{ date('d', strtotime( $actividad->fechaInicio )) }}</span>
         </div>
         <div class="act-mini-details">
            <div class="act-mini-1">
               <span class="act-mini-title"><a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ $actividad->titulo }}">{{ $actividad->titulo }}</a></span>
            </div>
            <div class="act-mini-2">
               <span>{{ date('l, d', strtotime( $actividad->fechaInicio )) }} de {{ date('F', strtotime( $actividad->fechaInicio )) }} - </span>
               <span>{{ date("g:i A",strtotime($actividad->horaInicio)) }} - </span>
               <span>{{ $actividad->lugar }}</span>
            </div>
            <div class="act-mini-2">
               <h5 style="margin-top:0px;">
                  @if($actividad->actividadGrupal != null)
                     <span class="label ff-bg-green">{{ $actividad->actividadGrupal->cuposOcupados }} Asistirán</span>
                     <span class="label ff-bg-red">{{ $actividad->actividadGrupal->cuposDisponibles }} Disponibles</span>
                  @elseif ($actividad->idTipoActividad == 8 || $actividad->idTipoActividad == 9)
                     <span class="label ff-bg">LIBRE</span>
                  @else
                     <span class="label ff-bg-blue">TUTORADOS</span>
                  @endif
               </h5>
            </div>
         </div>
      </div>
      <div class="act-mini-footer act-{{ $actividad->idTipoActividad }}">
         <div class="act-mini-txt pull-left">Categoría: <span style="color: white;">{{ $actividad->tipoActividad->tipo }}</span> {{--<a href="#">{{ $actividad->tipoActividad->tipo }}</a>--}}</div>
{{-- --}}
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
                     <i style="color:white;" class="fa fa-check-circle"></i> <span style="color:white;">Asistiré</span>
                  </div>
                  {{--<a class="btn-footer pull-right" href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad]) }}" data-toggle="tooltip" data-placement="bottom" title="Ver detalles">
                     <i class="fa fa-check-circle"></i> Asistiré
                  </a>--}}
               @else
                  @if( $actividad->estado == 1 )
                     @if( $actividad->actividadGrupal != null && $actividad->actividadGrupal->cuposDisponibles > 0 )
                        @if( $actividad->idUserResp != Auth::user()->id )
                           @if (Auth::user()!=null)
                              <a class="btn-footer pull-right" href="#" data-toggle="modal" data-target="#confirmModal-{{ $actividad->idActividad }}">
                                <i class="fa fa-circle-o"></i> Quiero Asistir
                             </a>
                           @endif
                        @else
                           <div class="act-mini-txt pull-right">
                              <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">Soy Responsable</span>
                           </div>
                        @endif
                     @else
                        <div class="act-mini-txt pull-right">
                           <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">No hay vacantes</span>
                        </div>
                     @endif
                  @else
                     <div class="act-mini-txt pull-right">
                        <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">No disponible</span>
                     </div>
                  @endif

               @endif
            @else
               <div class="act-mini-txt pull-right">
                  <i style="color:white;" class="fa fa-times-circle"></i> <span style="color:white;">No disponible</span>
               </div>
            @endif
         @else
            @if (Auth::user()!=null)
               <a class="btn-footer pull-right" href="{{ route('inscripcion.store') }}"
                  onclick="event.preventDefault();
                  document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
                  <i class="fa fa-circle-o"></i> Quiero Asistir
               </a>
            @endif
         @endif
      </div>
   </div>
</div>
<div class="modal fade" id="confirmModal-{{ $actividad->idActividad }}" tabindex="-1" role="dialog" aria-labelledby="lb-confMod-{{ $actividad->idActividad }}">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
               <h4 class="modal-title" id="lb-confMod-{{ $actividad->idActividad }}"><b>Confirme su Inscripción</b></h4>
         </div>
         <div class="modal-body">
            <p> <b style="color: #4B367C">Actividad: "{{ $actividad->titulo }}" </b> </p>
            <p> <b>Fecha:</b>
               @if (date("d/m/Y",strtotime($actividad->fechaInicio)) == date("d/m/Y",strtotime($actividad->fechaFin)))
                     {{ date("d/m/Y",strtotime($actividad->fechaInicio)).'  desde las '.date("g:i A",strtotime($actividad->horaInicio)).'  hasta las '.date("g:i A",strtotime($actividad->horaFin)) }}
               @else
                     {{ date("d/m/Y",strtotime($actividad->fechaInicio)).' '.date("g:i A",strtotime($actividad->horaInicio)).'  hasta '.date("d/m/Y",strtotime($actividad->fechaFin)).' '.date("g:i A",strtotime($actividad->horaFin)) }}
               @endif
            </p>
            <p> <b>Lugar:</b>  {{ $actividad->lugar }}</p>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-ff" onclick="event.preventDefault();
            document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
            <i class="fa fa-check-circle"></i> Confirmar</button>
            <form id="inscripcion-form-{{ $actividad->idActividad }}" action="{{ route('inscripcion.store', ['idActividad' => $actividad->idActividad]) }}" method="POST" style="display: none;">
               {{ csrf_field() }}
            </form>
            <button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
         </div>
      </div>
   </div>
</div>
