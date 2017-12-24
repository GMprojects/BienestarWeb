@extends('template')
@section('contenido')
   <div class="row">
      <div class="col-md-offset-2 col-md-8">
         {{ Form::hidden('opcion',  $opcion ,['id' => 'idOpcion']) }}
         <div class="ff-nav-box">
            <ul class="ff-nav-tab">
              <li id="inscLi"><a href="#insc" data-toggle="tab"><i class="fa fa-child"></i>Inscrito</a></li>
              <li id="respLi"><a href="#resp" data-toggle="tab"><i class="fa fa-tasks"></i>Responsable</a></li>
              <li id="progLi"><a href="#prog" data-toggle="tab"><i class="fa fa-calendar"></i>Programador</a></li>
            </ul>
            <div class="ff-nav-content">
               <div class="ff-nav-pane"  id="insc">
                  <ul class="ff-list-act">
                     @foreach ($mis_insc as $actividad)
                        @include('layouts.partials.list-act', $actividad)
                     @endforeach
                  </ul>
               </div>


               <div class="ff-nav-pane" id="resp">
                  <ul class="ff-list-act">
                     @foreach ($mis_resp as $actividad)
                        <div class="row">
                           <div class="col-md-9">
                              @include('layouts.partials.list-act', $actividad)
                           </div>
                           <div class="col-md-3 pull-right">
                             <div class="mis-act-op" valign="middle">
                                @if ( Auth::user()->id == $actividad->idUserResp)
                                    <a href="{{ action('ActividadController@execute',$actividad->idActividad) }}" class="btn btn-ff-greenOs" data-toggle="tooltip" data-placement="bottom" title="Ejecutar Actividad">
                                       <span>
                                         <i class="fa fa-child"><i class="fa fa-cogs"></i></i>
                                       </span>
                                    </a>
                                @endif
                            </div>
                           </div>
                        </div>
                     @endforeach
                  </ul>
               </div>
               <div class="ff-nav-pane" id="prog">
                  <ul class="ff-list-act">
                     @foreach ($mis_prog as $actividad)
                        <div class="row">
                           <div class="col-md-9">
                              @include('layouts.partials.list-act', $actividad)
                           </div>
                           <div class="col-md-3 pull-right">
                             <div class="mis-act-op" valign="middle">
                                @switch($actividad->estado)
                                   @case('1')
                                      <a href="{{ action('ActividadController@execute',$actividad->idActividad) }}">
                                         <button class="btn btn-ff-greenOs" data-toggle="tooltip" data-placement="bottom" title="Ejecutar Actividad">
                                            <span>
                                              <i class="fa fa-child"><i class="fa fa-cogs"></i></i>
                                            </span>
                                         </button>
                                      </a>
                                      <a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"  data-toggle="tooltip" data-placement="bottom" title="Editar o Habilitar Actividad"></i></button></a>
                                      <a href="" data-target = "#modal-cancel-{{ $actividad->idActividad }}" data-toggle = "modal"> <button  class="btn btn-ff-dark-red" data-toggle="tooltip" data-placement="bottom" title="Cancelar Actividad"><i class="fa fa-ban" ></i></button></a>
                                      <a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Actividad"><i class="fa fa-trash"></i></button></a>
                                   @break
                                   @case('2')
                                      <a href="{{ action('ActividadController@execute',$actividad->idActividad) }}">
                                         <button class="btn btn-ff-greenOs" data-toggle="tooltip" data-placement="bottom" title="Ejecutar Actividad">
                                            <span>
                                              <i class="fa fa-child"><i class="fa fa-cogs"></i></i>
                                            </span>
                                         </button>
                                      </a>
                                   @break
                                   @case('3')
                                      <a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"  data-toggle="tooltip" data-placement="bottom" title="Editar o Habilitar Actividad"></i></button></a>
                                      <a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Actividad"><i class="fa fa-trash"></i></button></a>
                                   @break
                                   @case('4')
                                      <a href="{{ action('ActividadController@edit',$actividad->idActividad) }}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"  data-toggle="tooltip" data-placement="bottom" title="Editar o Habilitar Actividad"></i></button></a>
                                      <a href="" data-target = "#modal-cancel-{{ $actividad->idActividad }}" data-toggle = "modal"> <button  class="btn btn-ff-dark-red" data-toggle="tooltip" data-placement="bottom" title="Cancelar Actividad"><i class="fa fa-ban" ></i></button></a>
                                      <a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Actividad"><i class="fa fa-trash"></i></button></a>
                                   @break
                                @endswitch
                            </div>
                           </div>
                        </div>
                        @include('programador.actividad.modal')
                        @include('programador.actividad.modalCancel')
                     @endforeach
                     </table>
                  </ul>
               </div>
            </div>

         </div>

      </div>
   </div>

   <script type="text/javascript">
      $(document).ready(function(){
         if ($('#idOpcion').val() == 1) {
            $('#insc').addClass('active');
            $('#inscLi').addClass('active');
         } else if($('#idOpcion').val() == 2){
            $('#resp').addClass('active');
            $('#respLi').addClass('active');
         } else{
            $('#prog').addClass('active');
            $('#progLi').addClass('active');
         }
      });
   </script>


@endsection
