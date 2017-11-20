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
                           <div class="col-md-10">
                              @include('layouts.partials.list-act', $actividad)
                           </div>
                           <div class="col-md-2 pull-right">
                             <div class="mis-act-op" valign="middle">
                                @if ( Auth::user()->id == $actividad->idUserResp)
                                    <a href="{{ action('ActividadController@execute',$actividad->idActividad) }}" class="btn btn-success"> <i class="fa fa-cogs"></i> </a>
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
                           <div class="col-md-10">
                              @include('layouts.partials.list-act', $actividad)
                           </div>
                           <div class="col-md-2 pull-right">
                             <div class="mis-act-op" valign="middle">
                               <a href="{{ action('ActividadController@edit',$actividad->idActividad) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                               @if ($actividad->estado != 3 && $actividad->estado != 2)
                                  <a href="" data-target = "#modal-delete-{{ $actividad->idActividad }}" data-toggle = "modal" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                               @endif

                            </div>
                           </div>
                        </div>
                        @include('programador.actividad.modal')
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
