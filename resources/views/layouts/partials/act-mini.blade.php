<div class="col-md-4 col-sm-6 act-mini-container">

   <div class="act-mini">
      <div class="act-mini-header">
         @if($actividad->rutaImagen == null)
            <a href="{{ action('ActividadController@member_show', $actividad->idActividad) }}"><img style="height: 220px;" class="img-rounded" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="Not found"></a>
         @else
            <a href="{{ action('ActividadController@member_show', $actividad->idActividad) }}"><img class="img-rounded" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="Not found"></a>
         @endif
      </div>
      <div class="act-mini-body" >
         <div class="ff-calendar">
            <span class="ff-month">{{ date('M', strtotime( $actividad->fechaInicio )) }}</span>
            <span class="ff-day">{{ date('d', strtotime( $actividad->fechaInicio )) }}</span>
         </div>
         <div class="act-mini-details">
            <div class="act-mini-1">
               <span class="act-mini-title"><a href="{{ action('ActividadController@member_show', $actividad->idActividad) }}">{{ $actividad->titulo }}</a></span>
            </div>
            <div class="act-mini-2">
               <span>{{ date('l, d', strtotime( $actividad->fechaInicio )) }} de {{ date('F', strtotime( $actividad->fechaInicio )) }} - </span>
               <span>{{ date('G:i', strtotime( $actividad->horaInicio )) }} - </span>
               <span><a href="#">{{ $actividad->lugar }}</a></span>
            </div>
            <div class="act-mini-2">
               <h5 style="margin-top:0px;">
                  @if($actividad->idTipoActividad != 4)
                     <span class="label label-success">{{ $actividad->actividadGrupal->cuposOcupados }} Asistirán</span>
                     <span class="label label-danger">{{ $actividad->actividadGrupal->cuposDisponibles }} Disponibles</span>
                  @else
                     <span class="label label-danger">TUTORADOS</span>
                  @endif
               </h5>
            </div>
         </div>
      </div>
      <div class="act-mini-footer">
         Categoría: <a href="#">{{ $actividad->tipoActividad->tipo }}</a>
         @if($actividad->idTipoActividad != 4)
            <button type="btn" class="btn btn-default btn-xs pull-right"><i class="fa fa-smile-o"></i>Asistiré</button>
         @endif
      </div>
   </div>

</div>
