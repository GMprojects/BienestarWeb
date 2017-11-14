@extends('template')
@section('contenido')
   <div class="row">
      <div class="col-md-offset-2 col-md-8">

         <div class="ff-nav-box">
            <ul class="ff-nav-tab">
              <li class="active"><a href="#insc" data-toggle="tab"><i class="fa fa-child"></i>Inscrito</a></li>
              <li ><a href="#resp" data-toggle="tab"><i class="fa fa-tasks"></i>Responsable</a></li>
              <li ><a href="#prog" data-toggle="tab"><i class="fa fa-calendar"></i>Programador</a></li>
            </ul>
            <div class="ff-nav-content">
               <div class="ff-nav-pane active"  id="insc">
                  <ul class="ff-list-act">
                     @foreach ($mis_insc as $actividad)
                        @include('layouts.partials.list-act', $actividad)
                     @endforeach
                  </ul>
               </div>


               <div class="ff-nav-pane" id="resp">
                  <ul class="ff-list-act">
                     @foreach ($mis_resp as $actividad)
                        @include('layouts.partials.list-act', $actividad)
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
                               <a href="#" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                               <a href="#" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                            </div>
                           </div>
                        </div>
                     @endforeach
                     </table>
                  </ul>
               </div>
            </div>

         </div>

      </div>
   </div>


@endsection
