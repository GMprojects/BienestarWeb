@extends('template')
@section ('contenido')
  <script type="text/javascript">
      $(document).ready(function(){
           $('#li_0').addClass('active');
           $('#tab_0').addClass('active');
           $('table').DataTable({
     			"language": {
     				  "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
     			 },
     			 "scrollY": "200px",
     			 "paging": false,
     			 "info": false
     		   });
      });
      var alternativas = <?php echo json_encode( $alternativas ); ?>;
      var matriz_frecuencia_js = <?php echo json_encode($matriz_frecuencia); ?>;

      function graficar(key, idPregunta){
         var datos = [];
         var frecuencia = matriz_frecuencia_js[key][idPregunta];
         var chart_labels = [];
         var chart_data = [];
         var ctx = document.getElementById('tab' + key + '_p' + idPregunta);
         //console.log(ctx);
         alternativas.forEach(function(alternativa) {
            chart_labels.push(alternativa.etiqueta);
            chart_data.push(frecuencia[alternativa.idAlternativa]);
         });
         var myPieChart = new Chart(ctx,{
             type: 'pie',
             data: {
                   datasets: [{
                       data: chart_data,
                       backgroundColor: [
                         'rgba(244, 67, 54, 1.0)',
                         'rgba(3, 169, 244, 1.0)',
                         'rgba(255, 235, 59, 1.0)',
                         'rgba(139, 195, 74, 1.0)',
                         'rgba(255, 152, 0, 1.0)',
                         'rgba(171, 71, 188, 1.0)',

                         'rgba(255, 205, 210, 1.0)',
                         'rgba(179, 229, 252, 1.0)',
                         'rgba(197, 225, 165, 1.0)',
                         'rgba(255, 249, 196, 1.0)',
                         'rgba(255, 204, 128, 1.0)',
                         'rgba(225, 190, 231, 1.0)'

                     ],
                   }],
                   // These labels appear in the legend and in the tooltips when hovering different arcs
                   labels: chart_labels
               }
         });
      }
   </script>

   <div class="row">
      <div class="col-md-8 col-md-offset-2">
         <div class="caja">
            <div class="caja-header">
               <div class="caja-icon"> <i class="fa fa-bar-chart-o"></i> </div>
               <div class="caja-title"> Datos Generales </div>
            </div>
            <div class="caja-body">
              <div class="row">
                 <div class="col-xs-12">
                    <h4><strong>Titulo: </strong> {{ $encuesta->titulo }} </h4>
                 </div>
                 <div class="col-sm-6">
                    <h5><strong>Nro. de Secciones: </strong> {{ count($encuesta->secciones) }}</h5>
                    <h5><strong>Nro. de Preguntas: </strong> {{ count($encuesta->preguntas->where('estado', 1)) }}</h5>
                    <h5><strong>Nro. de Alternativas: </strong> {{ count($encuesta->alternativas) }}</h5>
                 </div>
                 <div class="col-sm-6">
                    @switch( $encuesta->tipo )
                       @case(1)
                          <h5><strong>Nro. de Actividades: </strong> {{ count($respXfh) }}</h5>
                          @break
                       @case(2)
                          <h5><strong>Nro. de Envíos: </strong> {{ count($respXfh) }}</h5>
                          @break
                       @case(3)
                          <h5><strong>Nro. de Envíos: </strong> {{ count($respXfh) }}</h5>
                          @break
                    @endswitch
                    <h5><strong>Nro de Enviadas: </strong> {{ count($encuesta->enviadas) }}</h5>
                    <h5><strong>Nro de Respondidas: </strong> {{ count($encuesta->enviadas->where('estado', 1)) }}</h5>
                 </div>
              </div>
            </div>
         </div>

         <div class="caja">
            <div class="caja-header">
               @switch( $encuesta->tipo )
                  @case(2)
                     <div class="caja-icon"> <i class="fa fa-send"></i> </div>
                     <div class="caja-title"> Envíos </div>
                     @break
                  @case(1)
                     <div class="caja-icon"> <i class="fa fa-puzzle-piece"></i> </div>
                     <div class="caja-title"> Actividades </div>
                     @break
                  @case(3)
                     @if( $encuesta->idEncuesta > 3 )
                        <div class="caja-icon"> <i class="fa fa-book"></i> </div>
                        <div class="caja-title"> Envíos </div>
                     @else
                        <div class="caja-icon"> <i class="fa fa-book"></i> </div>
                        <div class="caja-title"> Envíos por Semestre </div>
                     @endif
                     @break
               @endswitch
            </div>
            <div class="caja-body">
               <div class="ff-nav-box-inside">
                  <ul class="ff-nav-tab">
                    @foreach ($respXfh as $key => $envio)
                       @switch( $encuesta->tipo )
                          @case(2)
                             <li id="li_{{ $key }}"><a href="#tab_{{ $key }}" data-toggle="tab"><i class="fa fa-send"></i>{{ $key + 1 }}</a></li>
                             @break
                          @case(1)
                             <li id="li_{{ $key }}"><a href="#tab_{{ $key }}" data-toggle="tab"><i class="fa fa-puzzle-piece"></i>{{ $key + 1 }}</a></li>
                             @break
                          @case(3)
                             <li id="li_{{ $key }}"><a href="#tab_{{ $key }}" data-toggle="tab"><i class="fa fa-book"></i>{{ $key + 1 }}</a></li>
                             @break
                       @endswitch

                    @endforeach
		            </ul>
                <div class="ff-nav-content-inside">
                   @foreach ($respXfh as $key => $envio)
                      <div class="ff-nav-pane"  id="tab_{{ $key }}">

                         <div class="row">
                            <div class="col-md-12">
                               @switch($encuesta->tipo)
                                  @case(1) @break
                                  @case(2)
                                     <h5><strong>Fecha y hora de Registro: </strong> {{ Date::make($envio[0]->fh_registro)->format('\E\l l d \d\e F \d\e\l Y \a \l\a\s H:i') }}</h5>
                                     <h5><strong>Fecha y hora de Envío: </strong> {{ Date::make($envio[0]->fh_envio)->format('\E\l l d \d\e F \d\e\l Y \a \l\a\s H:i') }}</h5>
                                     <h5><strong>Nro de Enviadas: </strong> {{ count($envio) }}</h5>
                                     @break
                                  @case(3)
                                     @if( $encuesta->idEncuesta > 4 )
                                        <h5><strong>Fecha y hora de Registro: </strong> {{ Date::make($envio[0]->fh_registro)->format('\E\l l d \d\e F \d\e\l Y \a \l\a\s H:i') }}</h5>
                                        <h5><strong>Fecha y hora de Envío: </strong> {{ Date::make($envio[0]->fh_envio)->format('\E\l l d \d\e F \d\e\l Y \a \l\a\s H:i') }}</h5>
                                        <h5><strong>Nro de Enviadas: </strong> {{ count($envio) }}</h5>
                                     @else
                                        <h5><strong>Semestre: </strong> {{ $semestres[$key]->semestre }} : {{ $semestres[$key]->fechaInicio }} - {{ $semestres[$key]->fechaFin }}</h5>
                                        <h5><strong>Nro de Enviadas: </strong> {{ count($envio) }} </h5>
                                     @endif
                                  @break
                               @endswitch
                               <h5><strong>Nro de Respondidas: </strong> {{ count($envio->where('estado', 1)) }}</h5>
                            </div>
                         </div>

                         <table id="tabEncuestados_{{ $key }}" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                               <th>Código</th>
                               <th>Encuestado</th>
                               <th>Respuestas</th>
                            </thead>
                            <tbody>
                               @foreach ($envio as $enviada)
                                  <tr>
                                     <td>{{ $enviada->user->codigo }}</td>
                                     <td><a href="{{ action('MiPerfilController@show', ['id' =>$enviada->user->id]) }}">{{ $enviada->user->apellidoPaterno }} {{ $enviada->user->apellidoMaterno }} {{ $enviada->user->nombre }}</a></td>
                                     @if( $enviada->estado == 1 )
                                        <td> <a href="#!" data-toggle="modal" data-target="#modal{{ $enviada->idEncuestaRespondida }}">Ver</a></td>
                                        <div class="modal fade" id="modal{{ $enviada->idEncuestaRespondida }}">
                                           <!-- /.modal-dialog -->
                                           <div class="modal-dialog modal-lg" role="document">
                                              <!-- /.modal-content -->
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true" class="fa fa-remove"></span></button>
                                                     <h4 class="modal-title"><b> {{ $enviada->user->apellidoPaterno }} {{ $enviada->user->apellidoMaterno }} {{ $enviada->user->nombre }} </b></h4>
                                                  </div>
                                                  <div class="modal-body">
                                                         @include('admin.encuesta.modal_show', [$encuesta, $enviada, $key])
                                                  </div>
                                                  <div class="modal-footer">
                                                      <div class="pull-right">
                                                        <a class="btn btn-ff pull-right" data-dismiss="modal"> <i class="fa fa-check"></i> Aceptar</a>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- /.modal-content -->
                                           </div>
                                           <!-- /.modal-dialog -->
                                        </div>
                                     @else
                                        <td>-</td>
                                     @endif
                                  </tr>
                               @endforeach
                            </tbody>
                         </table>

                         @if( count($envio->where('estado', 1))>0 )
                            <ol class="enc-list" style="margin-top: 10px;">
                               @foreach ($encuesta->preguntas->where('estado', 1)->where('idSeccion', null)->sortBy('orden') as $pregunta)
                                  <div class="item">
                           <div class="question" >
                            <li>
                              <span class="quest-text">
                                {{ $pregunta->enunciado }}
                              </span>
                            </li>
                           </div>
                                   <div class="alternatives">
                                      <div class="alternative">
                                         <canvas id="tab{{ $key }}_p{{ $pregunta->idPregunta }}" style="height: 500px;">


                                 </canvas>
                                      </div>
                                   </div>
                           <script>
                                      graficar({{ $key }}, {{ $pregunta->idPregunta }} );
                                   </script>
                         </div>
                               @endforeach
                            </ol>
                            @if(count($encuesta->secciones) > 0)
                        <div class="secciones">
                                  @foreach ($encuesta->secciones->where('estado', 1)->sortBy('orden') as $seccion)
                            <div class="seccion">
                              <div class="s-header">
                                <div class="s-icon"> {{ $seccion->orden }} </div>
                                <div class="s-title"> {{ $seccion->titulo }} </div>
                              </div>
                                        <div class="s-body">
                                <div class="items">
                                  @if( count($seccion->preguntas) > 0 )
                                    <ol class="enc-list">
                                      @foreach ($seccion->preguntas->where('estado', 1)->sortBy('orden') as $pregunta)
                                       <div class="item">
                                         <div class="question">
                                          <li>
                                            <span class="quest-text">
                                              {{ $pregunta->enunciado }}
                                            </span>
                                          </li>
                                         </div>
                                                        <div class="alternatives">
                                                          <div class="alternative">
                                                             <canvas id="tab{{ $key }}_p{{ $pregunta->idPregunta }}" style="height: 500px;">


                                                     </canvas>
                                                          </div>
                                                       </div>
                                               <script>
                                                          graficar({{ $key }}, {{ $pregunta->idPregunta }} );
                                                       </script>
                                       </div>
                                       @endforeach
                                    </ol>
                                  @endif
                                </div>
                              </div>
                                     </div>
                                  @endforeach
                               </div>
                            @endif
                         @endif
                      </div>
                   @endforeach
                </div>
              </div>
            </div>
         </div>

      </div>
   </div>

@endsection

<style media="screen">
   .ff-nav-box-inside{

   }
   .ff-nav-content-inside{
      padding: 10px;
      background: white;
   }
   .ff-nav-content-inside>.active{
      display: block;
   }
</style>
