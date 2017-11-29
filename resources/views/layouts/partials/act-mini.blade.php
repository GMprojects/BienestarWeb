<div class="col-md-4 col-sm-6 act-mini-container">

   <div class="act-mini">
      <div class="act-mini-header">
         @if( $actividad->rutaImagen == null )
            <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad, 'list_insc'=>$list_insc]) }}"><img style="height: 220px;" class="img-rounded" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="Not found"></a>
         @else
            <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad, 'list_insc'=>$list_insc]) }}"><img style="height: 220px;" class="img-rounded" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="Not found"></a>
         @endif
      </div>
      <div class="act-mini-body" >
         <div class="ff-calendar">
            <span class="ff-month">{{ date('M', strtotime( $actividad->fechaInicio )) }}</span>
            <span class="ff-day">{{ date('d', strtotime( $actividad->fechaInicio )) }}</span>
         </div>
         <div class="act-mini-details">
            <div class="act-mini-1">
               <span class="act-mini-title"><a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad, 'list_insc'=>$list_insc]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ $actividad->titulo }}">{{ $actividad->titulo }}</a></span>
            </div>
            <div class="act-mini-2">
               <span>{{ date('l, d', strtotime( $actividad->fechaInicio )) }} de {{ date('F', strtotime( $actividad->fechaInicio )) }} - </span>
               <span>{{ date('G:i', strtotime( $actividad->horaInicio )) }} - </span>
               <span><a href="#">{{ $actividad->lugar }}</a></span>
            </div>
            <div class="act-mini-2">
               <h5 style="margin-top:0px;">
                  @if($actividad->actividadGrupal != null)
                     <span class="label label-success">{{ $actividad->actividadGrupal->cuposOcupados }} Asistirán</span>
                     <span class="label label-danger">{{ $actividad->actividadGrupal->cuposDisponibles }} Disponibles</span>
                  @elseif ($actividad->idTipoActividad == 8 || $actividad->idTipoActividad == 9)
                     <span class="label label-danger">ABIERTO</span>
                  @else
                     <span class="label label-danger">TUTORADOS</span>
                  @endif
               </h5>
            </div>
         </div>
      </div>
      <div class="act-mini-footer act-{{ $actividad->idTipoActividad }}">
         <div class="act-mini-txt pull-left">Categoría: <a href="#">{{ $actividad->tipoActividad->tipo }}</a></div>
         @if($actividad->idTipoActividad != 4)
            @if(Auth::user() == null || $actividad->idUserResp != Auth::user()->id )
               @if(Auth::user() != null && Auth::user()->idTipoPersona != 1 && $actividad->idTipoActividad != '5' && $actividad->idTipoActividad != '6' && $actividad->idTipoActividad != '7')
                  <div class="act-mini-txt pull-right">Exclusiva: Estudiantes</div>
               @else
                  @if(in_array($actividad->idActividad, $list_insc))
                     <a class="btn-footer pull-right" href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad, 'list_insc'=>$list_insc]) }}" data-toggle="tooltip" data-placement="bottom" title="Ver detalles">
                        <i class="fa fa-check-circle"></i> Asistiré
                     </a>
                  @else
                     @if(Auth::user() == null || $actividad->actividadGrupal->cuposDisponibles > 0)
                        <a class="btn-footer pull-right" href="{{ route('inscripcion.store') }}"
                           onclick="event.preventDefault();
                           document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
                           <i class="fa fa-circle-o"></i> Deseo Asistir
                        </a>
                        <form id="inscripcion-form-{{ $actividad->idActividad }}" action="{{ route('inscripcion.store', ['idActividad' => $actividad->idActividad]) }}" method="POST" style="display: none;">
                           {{ csrf_field() }}
                        </form>
                        {{--<a class="btn-footer pull-right" data-toggle="modal" data-target="#confirmModal-{{ $actividad->idActividad }}"
                           href="{{ route('inscripcion.store') }}">
                           <i class="fa fa-circle-o"></i> Deseo Asistir
                        </a> --}}
                     @else
                        <a class="act-mini-txt pull-right" href="#" data-toggle="tooltip" data-placement="bottom" title="Click para contactar con el programador?">
                           <i class="fa fa-times-circle"></i> Inscripcion no disponible
                        </a>
                     @endif
                  @endif
               @endif
            @else
               <div class="act-mini-txt pull-right">Soy Responsable</div>
            @endif
         @else
            <div class="act-mini-txt pull-right">Exclusiva: Tutorados</div>
         @endif
      </div>
   </div>
</div>
<div class="modal fade" id="confirmModal-{{ $actividad->idActividad }}" tabindex="-1" role="dialog" aria-labelledby="lb-confMod-{{ $actividad->idActividad }}">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="lb-confMod-{{ $actividad->idActividad }}">Confirme su Inscripción</h4>
         </div>
         <div class="modal-body">
            Quiero inscribirme en :(
         </div>
         <div class="modal-footer">
            <a class="btn btn-success" href="{{ route('inscripcion.store') }}"
               onclick="event.preventDefault(); document.getElementById('inscripcion-form-{{ $actividad->idActividad }}').submit();">
               <i class="fa fa-check-o"></i> Confirmar
            </a>
            <form id="inscripcion-form-{{ $actividad->idActividad }}" action="{{ route('inscripcion.store', ['idActividad' => $actividad->idActividad]) }}" method="POST" style="display: none;">
               {{ csrf_field() }}
            </form>
            <button type="button" class="btn btn-primary">Cancelar</button>
         </div>
      </div>
   </div>
</div>
