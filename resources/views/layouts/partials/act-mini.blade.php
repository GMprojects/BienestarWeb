<div class="col-md-4 col-sm-6 act-mini-container">

   <div class="act-mini">
      <div class="act-mini-header">
         @if($actividad->rutaImagen == null)
            <a href="{{ url('actividad-demo') }}"><img class="img-rounded" src="{{ asset('storage/'.$actividad->tipoActividad->rutaImagen) }}" alt="No disponible"></a>
         @else
            <a href="{{ url('actividad-demo') }}"><img class="img-rounded" src="{{ asset('storage/'.$actividad->rutaImagen) }}" alt="No disponible"></a>
         @endif
      </div>
      <div class="act-mini-body" >
         <div class="ff-calendar">
            <span class="ff-month">{{ date('M', strtotime( $actividad->fechaProgramacion )) }}</span>
            <span class="ff-day">{{ date('d', strtotime( $actividad->fechaProgramacion )) }}</span>
         </div>
         <div class="act-mini-details">
            <div class="act-mini-1">
               <span class="act-mini-title"><a href="{{ url('actividad-demo') }}">{{ $actividad->titulo }}</a></span>
            </div>
            <div class="act-mini-2">
               <span>{{ date('l, d de F', strtotime( $actividad->fechaProgramacion )) }} - </span>
               <span>{{ date('G:i', strtotime( $actividad->horaProgramacion )) }} - </span>
               <span><a href="#">{{ $actividad->lugar }}</a></span>
            </div>
            <div class="act-mini-2">
               <h5 style="margin-top:0px;">
                  <span class="label label-success">14 asistirán</span>
                  <span class="label label-danger">6 restantes</span>
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
