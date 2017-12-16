@extends('template')
@section ('contenido')

   <div class="row">
      <div class="col-md-offset-2 col-md-8">
         <div class="ff-nav-box">
            <ul class="ff-nav-tab">
              <li><a href="#insc" data-toggle="tab"><i class="fa fa-child"></i>Inscrito</a></li>
              <li><a href="#resp" data-toggle="tab"><i class="fa fa-tasks"></i>Responsable</a></li>
            </ul>
            <div class="ff-nav-content">
               <div class="ff-nav-pane"  id="insc">
                  @foreach ($insc_noresp as $insc_noresp)
                        @include('layouts.partials.list-act', $actividad)
                  @endforeach
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

            </div>

         </div>

      </div>
   </div>

@endsection
