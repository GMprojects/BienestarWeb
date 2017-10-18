
<div class="col-md-4 col-sm-6 act-mini-container">

   <div class="act-mini">
      <div class="act-mini-header">
         <a href="#"><img class="img-rounded" src="{{ asset('img/img5.jpg') }}" alt="No disponible"></a>
      </div>
      <div class="act-mini-body" >
         <div class="ff-calendar">
            <span class="ff-month">{{ date("m",strtotime($actividad->fechaProgramacion)) }}</span>
            <span class="ff-day">{{ date("d",strtotime($actividad->fechaProgramacion)) }}</span>
         </div>
         <div class="act-mini-details">
            <div class="act-mini-1">
               <span class="act-mini-title"><a href="#">{{ $actividad->titulo }}</a></span>
            </div>
            <div class="act-mini-2">
               <span>{{ $actividad->fechaProgramacion }} - </span>
               <span>{{ $actividad->horaProgrmacion }} - </span>
               <span><a href="#">{{ $actividad->lugar }}</a></span>
            </div>
            <div class="act-mini-2">
               <h5 style="margin-top:0px;">
                  <span class="label label-success">{{ $actividad->actGrupal[0]->cuposOcupados}} asistirán</span>
                  <span class="label label-danger">{{ $actividad->actGrupal[0]->cuposDisponibles}} restantes</span>
               </h5>
            </div>
         </div>
      </div>
      <div class="act-mini-footer">
         Categoría: <a href="#">{{ $actividad->tipoActividad[0]->tipo }}</a>
         <button type="btn" class="btn btn-default btn-xs pull-right"><i class="fa fa-smile-o"></i>Asistiré</button>
      </div>
   </div>

</div>
