@extends('template')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		@if(count($errors)>0)
		<div class="alert alert-danger" >
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
@switch( $opt )
   @case('1') {{--encuesta de inscrito--}}
      {!!Form::open(['url'=>['miembro/encuesta/registrar_respuestas', 'id'=> $encResp->idEncuestaRespondidaInsc, 'opt'=>$opt],'method'=>'POST','autocomplete'=>'off'])!!}
      @break
   @case('2') {{--encuesta de responsable--}}
      {!!Form::open(['url'=>['miembro/encuesta/registrar_respuestas', 'id'=> $encResp->idEncuestaRespondidaResp, 'opt'=>$opt],'method'=>'POST','autocomplete'=>'off'])!!}
      @break
@endswitch
{{ Form::token() }}
 <div class="row">
     <div class="col-md-12">
         <div class="caja">
             <div class="caja-header large">
                 <div class="caja-icon">
                     <i class="fa fa-list-ul"></i>
                 </div>
                 <div class="caja-title">
                     {{ $encResp->encuesta->titulo }}
                 </div>
             </div>
             <div class="caja-body">
                <div class="">
                   @switch( $opt )
                      @case('1') {{--encuesta de inscrito--}}
                         <p class="ff-c-secondary">
                            En BienestarWeb nos interesa su opini'on,
                            por favor manifieste su conformidad con la
                            <strong>Actividad</strong>: <a href="">{{ $encResp->inscripcionADA->actividad->titulo }}</a>
                            de la cual particip'o como <small class="label ff-bg-green">Asistente</small>, llenando la siguiente encuesta.
                         </p>
                         @break
                      @case('2') {{--encuesta de responsable--}}
                         <p class="ff-c-secondary">
                           En BienestarWeb nos interesa su opini'on,
                           por favor manifieste su conformidad con la
                           <strong>Actividad</strong>: {{ $encResp->actividad->titulo }}
                           de la cual particip'o como <small class="label ff-bg-red">Responsable</small>
                        </p>
                         @break
                   @endswitch
                   <p><strong>Elija una de las siguientes opciones:</strong></p>
                   
                </div>
                <div class="items">
                   <div class="item hidden-xs hidden-sm">
                       <div class="question" style="background: white;"></div>
                       <div class="alternatives" style="background: white;">
                          @foreach ( $encResp->encuesta->alternativas as $alternativa )
                             <div class="env-alternative"  style="width:calc(100%/{{ count($encResp->encuesta->alternativas) }}); background-color: #D3C7E8; padding: 0px; border-radius: 7px 7px 0px 0px;">
                                <div class="alternative" style="text-align:left;">
                                   <label>{{ $alternativa->etiqueta }}</label>
                                </div>
                             </div>
                          @endforeach
                       </div>
                    </div>
                    <ol style="padding: 0px;" class="enc-list">
                       @foreach ( $encResp->encuesta->preguntas as $pregunta )
                          <div class="item">
                             <div class="question">
                               <li>
                                  <span class="quest-text">
                                     {{ $pregunta->enunciado }}
                                  </span>
                              </li>
                             </div>
                             <div class="alternatives">
                                @foreach ( $encResp->encuesta->alternativas as $alternativa )
                                   <div class="env-alternative"  style="width:calc(100%/{{ count($encResp->encuesta->alternativas) }});">
                                      <div class="alternative">
                                        <input required type="radio" name="{{ $pregunta->idPreguntaEncuesta }}" value="{{ $alternativa->valor }}"><label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
                                      </div>
                                   </div>

                                @endforeach
                             </div>
                          </div>
                       @endforeach
                    </ol>
                </div>

             </div>
             <div class="caja-footer">
                <button class="pull-right btn btn-ff" type="submit"><i class="fa fa-send"></i>Enviar</button>
             </div>
         </div>
     </div>
 </div>
 {!!Form::close()!!}
@endsection
