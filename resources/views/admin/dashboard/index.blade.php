@extends('template')
@section('contenido')
<div class="row">
   <div class="col-md-12">
         <h3 style="color:#4B367C;"><i class="fa fa-dashboard"></i>Dashboard</h3>
   </div>
</div>
<hr style="margin-bottom:10px; margin-top:0px;">
<div class="row">
   <div class="col-md-12">
      <div class="caja">
         <!--<div class="caja-header">
            <div class="caja-icon">
               <i class="fa fa-dashboard"></i>
            </div>
            <div class="caja-title">
               Dashboard
            </div>
         </div>-->

         <div class="caja-body">
            <div class="row">
               <div class="col-md-6">
                  <br>
                  <div class="form-group">
                     <label for="semestre">Semestre </label>
                     <select name="semestre" id="semestre" class="form-control">
                        {{--<option value="">Seleccione una Categoría</option>--}}
                        <option value="0-0">Todos</option>
                        @foreach($semestres as $semestre)
                           <option value="{{ $semestre['anioSemestre'].'-'.$semestre['numeroSemestre'] }}">
                                 {{ $semestre['anioSemestre'].'-' }}
                                 @if ($semestre['numeroSemestre'] == '1')
                                    I
                                 @else
                                    II
                                 @endif
                           </option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            @php
               $anio = '0';
               $numero = '0';
            @endphp
            <div class="row">
               <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="small-box small-box-pendiente">
                     <div class="inner">
                      <h3 id="cantPendientes">{{ $estados[0] }}</h3>
                      <p>Pendientes</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-calendar-minus-o"></i>
                     </div>
                     <a id="hrefPendiente" href="{{ action('DashboardController@listarActividades', [ 'estado' => '1', 'aS' => '0', 'nS' => '0']) }}" id="ide" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>

               <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="small-box small-box-ejecutada">
                     <div class="inner">
                      <h3 id="cantEjecutadas">{{ $estados[1] }}</h3>
                      <p>Ejecutadas</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-calendar-check-o"></i>
                     </div>
                     <a id="hrefEjecutada" href="{{ action('DashboardController@listarActividades', [ 'estado' => '2', 'aS' => '0', 'nS' => '0']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>

               <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="small-box small-box-cancelada">
                     <div class="inner">
                      <h3 id="cantCanceladas">{{ $estados[2] }}</h3>
                      <p>Canceladas</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-times-circle"></i>
                     </div>
                     <a id="hrefCancelada" href="{{ action('DashboardController@listarActividades', [ 'estado' => '3', 'aS' => '0', 'nS' => '0']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>

               <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="small-box small-box-expirada">
                     <div class="inner">
                      <h3 id="cantExpiradas">{{ $estados[3] }}</h3>
                      <p>Expiradas</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-calendar-times-o"></i>
                     </div>
                     <a id="hrefExpirada" href="{{ action('DashboardController@listarActividades', [ 'estado' => '4', 'aS' => '0', 'nS' => '0']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@if (count($actividadesProximas) > 0)
   <div class="row">
      <div class="col-md-12">
         <div class="caja">
            <div class="caja-header">
               <div class="caja-icon">
                  <i class="fa fa-puzzle-piece"></i>
               </div>
               <div class="caja-title">
                  Actividades Próximas
               </div>
            </div>
            <div class="caja-body">
               <div class="table">
                  <div class="table-responsive">
                     <table id="tabActividades" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                           <th>Id</th>
                           <th>Título</th>
                           <th>Tipo Actividad</th>
                           <th>Modalidad</th>
                           <th>Cupos</th>
                           <th>Fecha Inicio</th>
                           <th>Hora Inicio</th>
                        </thead>
                        <tbody>
                           @php
                              $i = 0;
                           @endphp
                           @foreach($actividadesProximas as $actividadProximas)
                              @php($i++)
                              <tr>
                                 <td>{{ $i }}</td>
                                 <td><a href="{{ action('ActividadController@member_show', ['id'=>$actividadProximas->idActividad]) }}">{{ $actividadProximas->titulo }}</a></td>
                                 <td>{{ $actividadProximas->tipoActividad->tipo }}</td>
                                 @switch($actividadProximas->modalidad)
                                    @case(1)
                                    <td><small class="label ff-bg-aqua rounded">Individual</small></td>
                                    @break
                                    @case(2)
                                    @if ($actividadProximas->idTipoActividad == 9 || $actividadProximas->idTipoActividad == 8)
                                    <td><small class="label ff-bg-purple rounded">Libre</small></td>
                                    @else
                                    <td><small class="label ff-bg-green2 rounded">Grupal</small></td>
                                    @endif
                                    @break
                                 @endswitch
                                 @if ($actividadProximas->idTipoActividad == 9 || $actividadProximas->idTipoActividad == 8)
                                    <td>Libre</td>
                                 @else
                                    <td>{{ $actividadProximas->cuposTotales }}</td>
                                 @endif
                                 <td>{{ date("d/m/Y",strtotime($actividadProximas->fechaInicio)) }}</td>
                                 <td>{{ date("g:i A",strtotime($actividadProximas->horaInicio)) }}</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endif

@if (count($actividadesAltas) > 0)
   <div class="row">
      <div class="col-md-12">
         <div class="caja">
            <div class="caja-header">
               <div class="caja-icon">
                  <i class="fa fa-arrow-up"></i>
               </div>
               <div class="caja-title">
                  Actividades Altas
               </div>
            </div>
            <div class="caja-body">
               <div class="row">
                  @php($i = 0)
                  @foreach ($actividadesAltas as $actividadAlta)
                     <div class="col-md-3">
                        <div class="member">
                           <div class="member-img pull-left">
                              @if($actividadAlta->actividadRutaImagen == null)
                                 <a href="{{ action('ActividadController@verEstadisticaActividad', ['id'=>$actividadAlta->idActividad]) }}"><img src="{{ asset('storage/'.$actividadAlta->tipoActividadRutaImagen) }}" alt="No disponible" class="img-circle"></a>
                              @else
                                 <a href="{{ action('ActividadController@verEstadisticaActividad', ['id'=>$actividadAlta->idActividad]) }}"><img src="{{ asset('storage/'.$actividadAlta->actividadRutaImagen) }}" alt="No disponible" class="img-circle"></a>
                              @endif
                           </div>
                           <div class="member-data">
                              <div class="member-name"><a href="{{ action('ActividadController@verEstadisticaActividad', ['id'=>$actividadAlta->idActividad]) }}">{{ $actividadAlta->titulo }}</a></div>
                              {{--<div class="member-email"><a href="#" data-target = "#modal-email-p" data-toggle = "modal">{{ $responsableFrecuente->email }}</a></div>--}}
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
@endif

<div class="row">
   @if (count($responsablesFrecuentes) > 0)
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="caja">
            <div class="caja-header">
               <div class="caja-icon">
                  <i class="fa fa-tasks"></i>
               </div>
               <div class="caja-title">
                  Responsables Frecuentes
               </div>
            </div>
            <div class="caja-body">
                  @foreach($responsablesFrecuentes as $responsableFrecuente)
                     <div class="member">
                        <div class="member-img pull-left">
                           @if($responsableFrecuente->foto != null)
                              <a href="{{ action('MiPerfilController@show', ['id' =>$responsableFrecuente]) }}"><img src="{{ asset('storage/'.$responsableFrecuente->foto) }}" alt="No Disponible" class="img-circle"></a>
                           @else
                              @if ($responsableFrecuente->sexo == 'h'){{-- Hombre --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$responsableFrecuente]) }}"><img src="{{ asset('img/avatar5.png') }}" alt="No Disponible" class="img-circle"></a>
                              @else{{-- Mujer --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$responsableFrecuente]) }}"><img src="{{ asset('img/avatar2.png') }}" alt="No Disponible" class="img-circle"></a>
                              @endif
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="{{ action('MiPerfilController@show', ['id' =>$responsableFrecuente]) }}">{{ $responsableFrecuente->nombre }} {{ $responsableFrecuente->apellidoPaterno }} </a></div>
                           <div class="member-email"><a href="" style="color:#4B367C;">{{ $responsableFrecuente->tipo }}</a></div>
                        </div>
                     </div>
                  @endforeach
            </div>
         </div>
      </div>
   @endif
   @if (count($programadoresFrecuentes) > 0)
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="caja">
            <div class="caja-header">
               <div class="caja-icon">
                  <i class="fa fa-calendar"></i>
               </div>
               <div class="caja-title">
                  Programadores Frecuentes
               </div>
            </div>
            <div class="caja-body">
                  @foreach($programadoresFrecuentes as $programadorFrecuente)
                     <div class="member">
                        <div class="member-img pull-left">
                           @if($programadorFrecuente->foto != null)
                              <a href="{{ action('MiPerfilController@show', ['id' =>$programadorFrecuente]) }}"><img src="{{ asset('storage/'.$programadorFrecuente->foto) }}" alt="No Disponible" class="img-circle"></a>
                           @else
                              @if ($programadorFrecuente->sexo == 'h'){{-- Hombre --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$programadorFrecuente]) }}"><img src="{{ asset('img/avatar5.png') }}" alt="No Disponible" class="img-circle"></a>
                              @else{{-- Mujer --}}
                                 <a href="{{ action('MiPerfilController@show', ['id' =>$programadorFrecuente]) }}"><img src="{{ asset('img/avatar2.png') }}" alt="No Disponible" class="img-circle"></a>
                              @endif
                           @endif
                        </div>
                        <div class="member-data">
                           <div class="member-name"><a href="{{ action('MiPerfilController@show', ['id' =>$programadorFrecuente]) }}">{{ $programadorFrecuente->nombre }} {{ $programadorFrecuente->apellidoPaterno }} </a></div>
                           <div class="member-email"><a href="" style="color:#4B367C;">{{ $programadorFrecuente->tipo }}</a></div>
                        </div>
                     </div>
                  @endforeach
            </div>
         </div>
      </div>
   @endif
</div>


<script type="text/javascript">
	$.ajaxSetup({
	   headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ready(function(){
      document.getElementById('semestre').selectedIndex = '0';
      {{--{{ $anio }} = '0';
      {{ $numero }} = '0';--}}
      {{--document.getElementById('ide').setAttribute('href',  {{ action('DashboardController@listarActividades') }});--}}
   });

	$("#semestre").change(function(){
      var semestre = ($(this).val()).split('-');
      console.log(semestre);

      //Preparando el AJAX
      $.ajax({
        type:'GET',
        url: '{{ action('DashboardController@reIndex') }}',
        data: {anioSemestre:semestre[0], numeroSemestre:semestre[1]},
        dataType: 'json',
        success:function(data) {
          console.log(data);
          if(data.length != 0){
             document.getElementById('cantPendientes').innerHTML = data[0];
             document.getElementById('cantEjecutadas').innerHTML = data[1];
             document.getElementById('cantCanceladas').innerHTML = data[2];
             document.getElementById('cantExpiradas').innerHTML = data[3];
             $('#hrefPendiente').attr('href', '{{ action('DashboardController@listarActividades', [ 'estado' => '1']) }}'+'?aS='+semestre[0]+'&nS='+semestre[1] );
             $('#hrefEjecutada').attr('href', '{{ action('DashboardController@listarActividades', [ 'estado' => '2']) }}'+'?aS='+semestre[0]+'&nS='+semestre[1] );
             $('#hrefCancelada').attr('href', '{{ action('DashboardController@listarActividades', [ 'estado' => '3']) }}'+'?aS='+semestre[0]+'&nS='+semestre[1] );
             $('#hrefExpirada').attr('href', '{{ action('DashboardController@listarActividades', [ 'estado' => '4']) }}'+'?aS='+semestre[0]+'&nS='+semestre[1] );
          }
        },
        error:function() {
           console.log("Error dListaTutores");
        }
      });
	});
   {{--function destino(){
      return {{ action('DashboardController@listarActividades') }};
   }--}}

</script>
@endsection
