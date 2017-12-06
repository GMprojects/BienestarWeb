<li class="mis-act-list st-{{ $actividad->estado }} mis-act-item">
   <div class="mis-act-img pull-left">
      @if($actividad->rutaImagen == null)
         <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad, 'list_insc'=>$list_insc]) }}"><img src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="Not found"></a>
      @else
         <a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad, 'list_insc'=>$list_insc]) }}"><img src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="Not found"></a>
      @endif
   </div>
   <div class="mis-act-dt">
      <div class="act-mini-1">
         <span class="act-mini-title"><a href="{{ action('ActividadController@member_show', ['id'=>$actividad->idActividad, 'list_insc'=>$list_insc]) }}" data-toggle="tooltip" data-placement="bottom" title="{{ $actividad->titulo }}">{{ $actividad->titulo }}</a></span>
      </div>
      <div class="act-mini-2">
         <span>{{ date('l, d', strtotime( $actividad->fechaInicio )) }} de {{ date('F', strtotime( $actividad->fechaInicio )) }} - </span>
         <span>{{ date('G:i', strtotime( $actividad->horaInicio )) }} - </span>
         <span><a href="#">{{ $actividad->lugar }}</a></span>
      </div>
      <div class="act-mini-2">
         <h5 style="margin-top:0px; margin-bottom:7px;">
            @if($actividad->actividadGrupal != null)
               <span class="label ff-bg-green">{{ $actividad->actividadGrupal->cuposOcupados }} Asistirán</span>
               <span class="label ff-bg-red">{{ $actividad->actividadGrupal->cuposDisponibles }} Disponibles</span>
            @elseif($actividad->idTipoActividad == 4)
               <span class="label ff-bg-blue">TUTORADOS</span>
            @else
               @if ($actividad->idTipoActividad != 8 && $actividad->idTipoActividad  != 9)
                  <span class="label ff-bg-aqua">INDIVIDUAL</span>
               @else
                  <span class="label ff-bg">LIBRE</span>
               @endif
            @endif
         </h5>
      </div>
   </div>
</li>
