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
                <div class="">
                         <p class="ff-c-secondary">
                           En Bienestar Farmacia nos interesa su opinión,
                           por favor manifieste su conformidad con la
                           <strong>Actividad</strong>: <a href="">Aqui el titulo de la actividad</a>
                           de la cual participó como <small class="label ff-bg-red">Responsable</small>
                        </p>
                   <p><strong>Elija una de las siguientes opciones:</strong></p>

                </div>
                <div class="items">
                   <div class="item hidden-xs hidden-sm">
                       <div class="question" style="background: white;"></div>
                       <div class="alternatives" style="background: white;">
                          @foreach ( $encuesta->alternativas as $alternativa )
                             <div class="env-alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }}); background-color: #D3C7E8; padding: 0px; border-radius: 7px 7px 0px 0px;">
                                <div class="alternative" style="text-align:left;">
                                   <label>{{ $alternativa->etiqueta }}</label>
                                </div>
                             </div>
                          @endforeach
                       </div>
                    </div>
                    <ol style="padding: 0px;" class="enc-list">
                       @foreach ( $encuesta->preguntas as $pregunta )
                          <div class="item">
                             <div class="question">
                               <li>
                                  <span class="quest-text">
                                     {{ $pregunta->enunciado }}
                                  </span>
                              </li>
                             </div>
                             <div class="alternatives">
                                @foreach ( $encuesta->alternativas as $alternativa )
                                   <div class="env-alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }});">
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
                <button class="pull-right btn btn-ff" type="button"><i class="fa fa-send"></i>Enviar</button>
             </div>
         </div>
     </div>
 </div>
 {!!Form::close()!!}
@endsection
