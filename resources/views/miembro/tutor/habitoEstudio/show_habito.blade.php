@extends('template')
@section ('contenido')
   <div class="row">
       <div class="col-md-12">
           <div class="caja">
              <div class="caja-header large">
                   <div class="caja-icon">
                       <i class="fa fa-list-ul"></i>
                   </div>
                   <div class="caja-title">
                       {{ $encuesta->titulo }}
                   </div>
              </div>
              <div class="caja-body">
                  <!--fin  -->
                  <div class="encu-description">
                     <h4 style="color: black;"><strong>Tutorado: </strong>
                       <a href="{{ action('MiPerfilController@show', ['id' =>$enviada->user->id]) }}">{{ ucwords(strtolower($enviada->user->nombre.' '.$enviada->user->apellidoPaterno.' '.$enviada->user->apellidoMaterno)) }}</a>
                     </h4>
                     <h4 style="color: black;"><strong>Fecha y hora de Envío: </strong> {{ Date::make($enviada->fh_envio)->format('\E\l l d \d\e F \d\e\l Y \a \l\a\s H:i') }}</h4>
                     <h4 style="color: black;"><strong>Fecha y hora de Respuesta: </strong> {{ Date::make($enviada->updated_at)->format('\E\l l d \d\e F \d\e\l Y \a \l\a\s H:i') }}</h4>
                     <br>
                     <p>{{ $encuesta->descripcion }}</p>
                 </div>
                 <!-- NOTA NO-SECCION:  por si hay preguntas que no están dentro de alguna sección -->
                 @if(count($encuesta->preguntas->where('idSeccion', null)->where('estado', 1))> 0)
                    <div class="no-sec-items items">
                       <div class="alternatives hidden-xs hidden-sm">
                          @foreach ( $encuesta->alternativas->sortBy('valor') as $alternativa )
                             <div class="alternative alt-header"  style="width:calc(100%/{{ count($encuesta->alternativas) }}); ">
                              <span>{{ $alternativa->etiqueta }}</span>
                           </div>
                          @endforeach
                       </div>

                       <ol class="enc-list">
                          @foreach ($enviada->preguntas->where('idSeccion', null)->where('estado', 1)->sortBy('orden') as $pregunta)
                           <div class="item">
                              <div class="question">
                                <li>
                                   <span class="quest-text">
                                      {{ $pregunta->enunciado }}
                                   </span>
                              </li>
                              </div>
                              <div class="alternatives">
                                 @foreach ( $encuesta->alternativas->sortBy('valor') as $alternativa )
                                    <div class="alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }});">
                                       @if( $pregunta->pivot->respuesta == $alternativa->idAlternativa )
                                          <input type="radio" name="{{ $pregunta->idPregunta }}_{{ $enviada->user->id }}" value="{{ $alternativa->valor }}" checked>
                                          <label class="hidden-lg hidden-md" >{{ $alternativa->etiqueta }}</label>
                                       @else
                                          <input disabled type="radio" name="{{ $pregunta->idPregunta }}_{{ $enviada->user->id }}" value="{{ $alternativa->valor }}">
                                          <label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
                                       @endif
                                    </div>
                                 @endforeach
                              </div>
                           </div>
                           @endforeach
                       </ol>
                    </div>
                 @endif
                 <!-- FIN de la NOTA NO-SECCION-->

                 @if(count($encuesta->secciones) > 0)
                    <div class="secciones">
                       @foreach ($encuesta->secciones->where('estado', 1)->sortBy('orden') as $seccion)
                          <div class="seccion">
                             <div class="s-header">
                                <div class="s-icon"> {{ $seccion->orden }} </div>
                                <div class="s-title"> {{ $seccion->titulo }} </div>
                             </div>
                             <div class="s-body">
                                <div class="s-description"> {{ $seccion->descripcion }} </div>
                                <div class="items">
                                   @if( count($seccion->preguntas) > 0 )
                                      <div class="alternatives hidden-xs hidden-sm">
                                         @foreach ( $encuesta->alternativas->sortBy('valor') as $alternativa )
                                            <div class="alternative alt-header"  style="width:calc(100%/{{ count($encuesta->alternativas) }}); ">
                                              <span>{{ $alternativa->etiqueta }}</span>
                                           </div>
                                         @endforeach
                                      </div>

                                      <ol class="enc-list">
                                         @foreach ($enviada->preguntas->where('estado', 1)->where('idSeccion', $seccion->idSeccion)->sortBy('orden') as $pregunta)
                                          <div class="item">
                                             <div class="question">
                                               <li>
                                                  <span class="quest-text">
                                                     {{ $pregunta->enunciado }}
                                                  </span>
                                              </li>
                                             </div>
                                             <div class="alternatives">
                                                @foreach ( $encuesta->alternativas->sortBy('valor') as $alternativa )
                                                  <div class="alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }});">
                                                     @if( $pregunta->pivot->respuesta == $alternativa->idAlternativa )
                                                        <input type="radio" name="{{ $pregunta->idPregunta }}_{{ $enviada->user->id }}" value="{{ $alternativa->valor }}" checked>
                                                        <label class="hidden-lg hidden-md" >{{ $alternativa->etiqueta }}</label>
                                                     @else
                                                        <input disabled type="radio" name="{{ $pregunta->idPregunta }}_{{ $enviada->user->id }}" value="{{ $alternativa->valor }}">
                                                        <label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
                                                     @endif
                                                  </div>
                                                @endforeach
                                             </div>
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
              </div>

           </div>
       </div>
   </div>
   <script type="text/javascript">
     $(document).ready(function(){
        $('input').iCheck({
           checkboxClass: 'icheckbox_square-green',
           radioClass: 'iradio_square-green',
           increaseArea: '20%' // optional
        });
           $('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
     });
   </script>
@endsection
