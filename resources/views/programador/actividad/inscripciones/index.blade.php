@extends('template')
@section('contenido')
<div class="row">
   <div class="col-md-12">
      <div class="caja">
         <div class="caja-header">
            <div class="caja-icon"><i class="fa fa-heart-o"></i></div>
            <div class="caja-title">Nivel de Satisfacción</div>
         </div>
         <div class="caja-body">
            <div class="row">
            	 <div class="col-md-12">
            			<div class="box box-primary">
            				<div class="box-header">
            					<h3 class="box-title">Análisis de las Encuestas Respondidas  </h3>
            				</div>
            				<div class="box-body"  id="box" class="collapse">
            					<div class="col-12 col-sm-12 col-md-6 col-lg-6" id="chart">
            						<div id="bar-chart" style="width:450px;height:300px;margin:0 auto"></div><br>
            					</div>
            					<div class="col-12 col-sm-12 col-md-6 col-lg-6" style="font-size:1.3em;">
            						<label style="color:#4B367C;">Resumen de respuestas: </label><br>
            						<br>
            						{{--@php($i=0)
            						@php($total=0)
            						@foreach ( $encuesta->alternativas as $alternativa )
            							<label>&nbsp; &nbsp;  {{ $alternativa->etiqueta }} ({{ $alternativa->valor }}) : </label> {{ $respuesta_cantidad[$i] }} <br>
            							@php($total = $total + ($respuesta_cantidad[$i]*$alternativa->valor))
            							@php($i++)
            						@endforeach--}}
            						<br>
            						<label style="color:#4B367C">Totales: </label><br>
            						<br>
            						{{--<label>&nbsp; &nbsp;  Total : </label> {{ $total }} ptos.<br>--}}
            					</div>
            				 </div>
            			</div>
            	 </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="caja">
         <div class="caja-header">
            <div class="caja-icon"><i class="fa fa-check-square-o"></i></div>
            <div class="caja-title">Asistencias</div>
         </div>
         <div class="caja-body">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
                <div class="card">
                  <h5 class="text-bold"> {{ $numAsistentes }} </h5>
                  <h4> Asistentes  </h4>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
                <div class="card">
                  <h5 class="text-bold">  {{ $numAusentes }}  </h5>
                  <h4> Ausentes </h4>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
                <div class="card">
                  <h5 class="text-bold">  {{ $numInscritos }}  </h5>
                  <h4> Inscritos </h4>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
                <div class="card">
                  <h5 class="text-bold">
                    @if ($numInscritos != 0)
                      @php($porcentajeAsistencia = round(($numAsistentes/$numInscritos)*100))
                    @else
                       @php($porcentajeAsistencia = 0)
                    @endif
                    {{ $porcentajeAsistencia }}%
                  </h5>
                  <h4> Asistencia </h4>
                </div>
              </div>
            </div>
            <br><br>
            <div class="row">
               <div class="col-md-12">
                  <div class="ff-nav-box">
                     {{ Form::hidden('opcion',  $opcion ,['id' => 'idOpcion']) }}
                     <ul class="ff-nav-tab">
                       <li id="alumnosLi"><a href="#alumnos" data-toggle="tab"><i class="fa fa-child"></i>Alumnos</a></li>
                       <li id="docentesLi"><a href="#docentes" data-toggle="tab"><i class="fa fa-tasks"></i>Docentes</a></li>
                       <li id="administrativosLi"><a href="#administrativos" data-toggle="tab"><i class="fa fa-calendar"></i>Administrativos</a></li>
                       <li id="todosLi"><a href="#todos" data-toggle="tab"><i class="fa fa-calendar"></i>Todos</a></li>
                     </ul>
                     <div class="ff-nav-content">
                        <div class="ff-nav-pane"  id="alumnos">
                           <div class="table">
                     			<div class="table-responsive">
                     				<table id="tabAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                     					<thead>
                                       <th>Id</th>
                          					<th>Nombres y Apellidos</th>
                          					<th>Asistencia</th>
                     					</thead>
                     					<tbody>@php($i=0)
                                       @foreach($inscripcionesAlumnos as $inscripcionAlumno)
                                        <tr>
                                          @php($i++)
                                            <td> {{ $i }} </td>
                                            <td> {{ $inscripcionAlumno->nombre }}  {{ $inscripcionAlumno->apellidoPaterno }}  {{ $inscripcionAlumno->apellidoMaterno }} </td>
                                            <td>
                                              @if( $inscripcionAlumno->asistencia == 0 )
                                                  <i class="fa fa-times"> </i>
                                              @else
                                                  <i class="fa fa-check"> </i>
                                              @endif
                                            </td>
                                        </tr>
                                      @endforeach
                     					</tbody>
                     				</table>
                     			</div>
                     		</div>
                        </div>
                        <div class="ff-nav-pane" id="docentes">
                           <div class="table">
                              <div class="table-responsive">
                                 <table id="tabDocentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                       <th>Id</th>
                                       <th>Nombres y Apellidos</th>
                                       <th>Asistencia</th>
                                    </thead>
                                    <tbody>@php($i=0)
                                       @foreach($inscripcionesDocentes as $inscripcionDocente)
                                        <tr>
                                          @php($i++)
                                            <td> {{ $i }} </td>
                                            <td> {{ $inscripcionDocente->nombre }}  {{ $inscripcionDocente->apellidoPaterno }}  {{ $inscripcionDocente->apellidoMaterno }} </td>
                                            <td>
                                              @if( $inscripcionDocente->asistencia == 0 )
                                                  <i class="fa fa-times"> </i>
                                              @else
                                                  <i class="fa fa-check"> </i>
                                              @endif
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="ff-nav-pane" id="administrativos">
                           <div class="table">
                              <div class="table-responsive">
                                 <table id="tabDocentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                       <th>Id</th>
                                       <th>Nombres y Apellidos</th>
                                       <th>Asistencia</th>
                                    </thead>
                                    <tbody>@php($i=0)
                                       @foreach($inscripcionesAdministrativos as $inscripcionAdministrativo)
                                        <tr>
                                          @php($i++)
                                            <td> {{ $i }} </td>
                                            <td> {{ $inscripcionAdministrativo->nombre }}  {{ $inscripcionAdministrativo->apellidoPaterno }}  {{ $inscripcionAdministrativo->apellidoMaterno }} </td>
                                            <td>
                                              @if( $inscripcionAdministrativo->asistencia == 0 )
                                                  <i class="fa fa-times"> </i>
                                              @else
                                                  <i class="fa fa-check"> </i>
                                              @endif
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="ff-nav-pane" id="todos">
                           <div class="table">
                              <div class="table-responsive">
                                 <table id="tabTodos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                       <th>Id</th>
                                       <th>Nombres y Apellidos</th>
                                       <th>Asistencia</th>
                                    </thead>
                                    <tbody>@php($i=0)
                                       <tr>
                                           <td colspan="3">Alumnos</td>
                                       </tr>
                                       @foreach($inscripcionesAlumnos as $inscripcionAlumno)
                                          <tr>
                                             @php($i++)
                                             <td> {{ $i }} </td>
                                             <td> {{ $inscripcionAlumno->nombre }}  {{ $inscripcionAlumno->apellidoPaterno }}  {{ $inscripcionAlumno->apellidoMaterno }} </td>
                                             <td>
                                               @if( $inscripcionAlumno->asistencia == 0 )
                                                  <i class="fa fa-times"> </i>
                                               @else
                                                  <i class="fa fa-check"> </i>
                                               @endif
                                             </td>
                                          </tr>
                                       @endforeach
                                       <tr>
                                           <td colspan="3">Docentes</td>
                                       </tr>
                                       @foreach($inscripcionesDocentes as $inscripcionDocente)
                                          <tr>
                                             @php($i++)
                                             <td> {{ $i }} </td>
                                             <td> {{ $inscripcionDocente->nombre }}  {{ $inscripcionDocente->apellidoPaterno }}  {{ $inscripcionDocente->apellidoMaterno }} </td>
                                             <td>
                                                @if( $inscripcionDocente->asistencia == 0 )
                                                   <i class="fa fa-times"> </i>
                                                @else
                                                   <i class="fa fa-check"> </i>
                                                @endif
                                             </td>
                                          </tr>
                                       @endforeach
                                       <tr>
                                           <td colspan="3">Administrativos</td>
                                       </tr>
                                       @foreach($inscripcionesAdministrativos as $inscripcionAdministrativo)
                                          <tr>
                                             @php($i++)
                                             <td> {{ $i }} </td>
                                             <td> {{ $inscripcionAdministrativo->nombre }}  {{ $inscripcionAdministrativo->apellidoPaterno }}  {{ $inscripcionAdministrativo->apellidoMaterno }} </td>
                                             <td>
                                               @if( $inscripcionAdministrativo->asistencia == 0 )
                                                   <i class="fa fa-times"> </i>
                                               @else
                                                   <i class="fa fa-check"> </i>
                                               @endif
                                             </td>
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
            </div>
         </div>
      </div>
   </div>
</div>


<style type="text/css">
   .sinFondo{
     background: none;
   }

   #radioButton.notActive{
     color: #3276B1;
     background-color: #FFF;
   }

   h5 {
       text-align: center;
       font-size: 4em;
       font-weight: 700;
       line-height: 1.2857em;
       margin: 0;
   }

   h4 {
       text-align: center;
   }

   h6 {
       font-size: 1.28em;
   }

   .card {
       font-size: 1em;
       overflow: hidden;
       padding: 0;
       border: none;
       border-radius: .28571429rem;
       box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
   }

   .card-block {
       font-size: 1em;
       position: relative;
       margin: 0;
       padding: 1em;
       border: none;
       border-top: 1px solid rgba(34, 36, 38, .1);
       box-shadow: none;
   }

   .card-img-top {
       display: block;
       width: 100%;
       height: auto;
   }

   .card-title {
       font-size: 1.28571429em;
       font-weight: 700;
       line-height: 1.2857em;
   }

   .card-text {
       clear: both;
       margin-top: .5em;
       color: rgba(0, 0, 0, .68);
   }

   .card-footer {
       font-size: 1em;
       position: static;
       top: 0;
       left: 0;
       max-width: 100%;
       padding: .75em 1em;
       color: rgba(0, 0, 0, .4);
       border-top: 1px solid rgba(0, 0, 0, .05) !important;
       background: #fff;
   }

   .card-inverse .btn {
       border: 1px solid rgba(0, 0, 0, .05);
   }
</style>

<script type="text/javascript">
   $(document).ready(function(){
      if ($('#idOpcion').val() == 1) {
         $('#alumnos').addClass('active');
         $('#alumnosLi').addClass('active');
      } else if($('#idOpcion').val() == 2){
         $('#docentes').addClass('active');
         $('#docentesLi').addClass('active');
      } else if($('#idOpcion').val() == 3){
         $('#administrativos').addClass('active');
         $('#administrativosLi').addClass('active');
      }else{
         $('#todos').addClass('active');
         $('#todosLi').addClass('active');
      }
   	/*$.plot($("#bar-chart"), dataset, options);
   	$("#bar-chart").UseTooltip();*/
   });
   {{--var data = new Array();
   @for ($i=0; $i < count($alternativas); $i++)
   	data[{{ $i }}] = [{{ $i }}, {{ ($respuesta_cantidad[$i])*1.85 }}];
   @endfor
   var dataset = [
   	{//label:'Respuesta',
   	data:data, color: '#3c8dbc'}
   ];
   var ticks = new Array();
   @for ($i=0; $i < count($alternativas); $i++)
   	ticks[{{ $i }}] = [{{ $i }}, '{{ $alternativas[$i]['etiqueta'] }}'];
   	//ticks[{{ $i }}] = [{{ $alternativas[$i]['valor'] }}, '{{ $alternativas[$i]['etiqueta'] }}'];
   @endfor
   var options = {
   	series: {
   		bars:   {
   			show: true,
   		}
   	},
   	bars:   {
   		align: "center",
   		barWidth:0.5
   	},
   	xaxis: {
   	 //axisLabel: "World Cities",
   	 axisLabelUseCanvas: true,
   	 axisLabelFontSizePixels: 25,
   	 axisLabelFontFamily: 'Verdana, Arial',
   	 axisLabelPadding: 10,
   	 ticks: ticks

   	},
   	yaxis: {
   		 //axisLabel: "Average Temperature",
   		 axisLabelUseCanvas: true,
   		 axisLabelFontSizePixels: 25,
   		 axisLabelFontFamily: 'Verdana, Arial',
   		 axisLabelPadding: 5,
   		 tickFormatter: function (v, axis) {
   			  return v + "%";
   		 }
   	},
   	/*legend: {
   		 noColumns: 0,
   		 labelBoxBorderColor: "#000000",
   		 position: "nw"
   	},*/
   	grid: {
   		 hoverable: true,
   		 borderWidth: 2,
   		 backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
   	}
   }
   function gd(year, month, day) {
    	return new Date(year, month, day).getTime();
   }
   var previousPoint = null, previousLabel = null;
   $.fn.UseTooltip = function () {
       $(this).bind("plothover", function (event, pos, item) {
           if (item) {
               if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                   previousPoint = item.dataIndex;
                   previousLabel = item.series.label;
                   $("#tooltip").remove();
                   var x = item.datapoint[0];
                   var y = item.datapoint[1];
                   var color = item.series.color;
                   //console.log(item.series.xaxis.ticks[x].label);
                   showTooltip(item.pageX,
                           item.pageY,
                           color,
                           //"<strong>" + item.series.label + "</strong><br>" +
                           item.series.xaxis.ticks[x].label + " : <strong>" + y + "</strong> %");
               }
           } else {
               $("#tooltip").remove();
               previousPoint = null;
           }
       });
   };
   function showTooltip(x, y, color, contents) {
       $('<div id="tooltip">' + contents + '</div>').css({
           position: 'absolute',
           display: 'none',
           top: y - 40,
           left: x - 120,
           border: '2px solid ' + color,
           padding: '3px',
           'font-size': '9px',
           'border-radius': '5px',
           'background-color': '#fff',
           'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
           opacity: 0.9
       }).appendTo("body").fadeIn(200);
    }--}}
</script>
@endsection
