@extends('template')
@section('contenido')
{!! Form::open(['route'=>['encuesta.storeHabitoEstudio', $idEncuestaRespondida], 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{ Form::token() }}
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
                <!--fin  -->
					<p style="font-size: 1.3em;"> <strong>Por favor, elija una de las alternativas siguientes.</strong> </p>
					<!-- NOTA NO-SECCION:  por si hay preguntas que no están dentro de alguna sección -->
					@if(count($encuesta->preguntas->where('idSeccion', null))> 0)
						<div class="no-sec-items items">
							<div class="alternatives hidden-xs hidden-sm">
								@foreach ( $encuesta->alternativas as $alternativa )
									<div class="alternative alt-header"  style="width:calc(100%/{{ count($encuesta->alternativas) }}); ">
									  <span>{{ $alternativa->etiqueta }}</span>
								  </div>
								@endforeach
							</div>

							<ol class="enc-list">

								@foreach ($encuesta->preguntas->where('idSeccion', null) as $pregunta)
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
											 <div class="alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }});">
												 <input required type="radio" name="{{ $pregunta->idPregunta }}" value="{{ $alternativa->valor }}"><label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
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
							@foreach ($encuesta->secciones as $seccion)
								<div class="seccion">
									<div class="s-header">
										<div class="s-icon"> {{ $seccion->orden }} </div>
										<div class="s-title"> {{ $seccion->titulo }} </div>
									</div>
									<div class="s-body">
										<div class="s-description"> {{ $seccion->descripcion }} </div>
										<div class="items">
											<div class="alternatives hidden-xs hidden-sm">
												@foreach ( $encuesta->alternativas as $alternativa )
													<div class="alternative alt-header"  style="width:calc(100%/{{ count($encuesta->alternativas) }}); ">
													  <span>{{ $alternativa->etiqueta }}</span>
												  </div>
												@endforeach
											</div>

											<ol class="enc-list">
												@foreach ($seccion->preguntas as $pregunta)
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
															 <div class="alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }});">
																 <input required type="radio" name="{{ $pregunta->idPregunta }}" value="{{ $alternativa->valor }}"><label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
															 </div>
														 @endforeach
													 </div>
												 </div>
												 @endforeach
											</ol>
										</div>
									</div>
								</div>
							@endforeach


						</div>
					@endif
             </div>
             <div class="caja-footer">
                <button class="pull-right btn btn-ff" type="submit" data-toggle="tooltip" data-placement="bottom" title="Enviar Hábitos"><i class="fa fa-send"></i>Enviar</button>
             </div>
         </div>
     </div>
 </div>
 {!!Form::close()!!}
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
