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
{!!Form::open(['url'=>'miembro/habitoEstudio','method'=>'POST','autocomplete'=>'off'])!!}
{{ Form::token() }}
 <div class="row">
     <div class="col-md-12">
         <div class="caja">
             <div class="caja-header large">
                 <div class="caja-icon">
                     <i class="fa fa-list-ul"></i>
                 </div>
                 <div class="caja-title">
                     Habitos de Estudio
                 </div>
             </div>
             <div class="caja-body">
                <div class="">
                   <p class="ff-c-secondary">
                      En BienestarWeb nos preocupamos por sus H'abitos de Estudio.
                   </p>
                   <p><strong>Elija una de las siguientes opciones:</strong></p>

                </div>
                <div class="items">
                   <div class="item hidden-xs hidden-sm">
                       <div class="question" style="background: white;"></div>
                       <div class="alternatives" style="background: white;">
                          <div class="env-alternative"  style="width:25%; background-color: #D3C7E8; padding: 0px; border-radius: 7px 7px 0px 0px;">
                             <div class="alternative" style="text-align:left;">
                                <label>No</label>
                             </div>
                          </div>
                          <div class="env-alternative"  style="width:25%; background-color: #D3C7E8; padding: 0px; border-radius: 7px 7px 0px 0px;">
                             <div class="alternative" style="text-align:left;">
                                <label>Pocas Veces</label>
                             </div>
                          </div>
                          <div class="env-alternative"  style="width:25%; background-color: #D3C7E8; padding: 0px; border-radius: 7px 7px 0px 0px;">
                             <div class="alternative" style="text-align:left;">
                                <label>Muchas Veces</label>
                             </div>
                          </div>
                          <div class="env-alternative"  style="width:25%; background-color: #D3C7E8; padding: 0px; border-radius: 7px 7px 0px 0px;">
                             <div class="alternative" style="text-align:left;">
                                <label>Sí</label>
                             </div>
                          </div>
                       </div>
                    </div>
                    <ol style="padding: 0px;" class="enc-list">
                       @for ($i=0; $i < count($preguntas); $i++)
                          <div class="enc-type">
                             {{ $preguntas[$i][0]->tipoHabito->tipo }}
                          </div>
                          @for ($j=0; $j < count($preguntas[$i]); $j++)
                             <div class="item">
                                <div class="question">
                                  <li>
                                     <span class="quest-text">
                                        {{ $preguntas[$i][$j]->enunciado }}
                                     </span>
                                 </li>
                                </div>
                                <div class="alternatives">
                                   <div class="env-alternative"  style="width:25%;">
                                      <div class="alternative">
                                        <input required type="radio" name="{{ $preguntas[$i][$j]->idPreguntaHabito}}" value="1"><label class="hidden-lg hidden-md">No</label>
                                      </div>
                                   </div>
                                   <div class="env-alternative"  style="width:25%;">
                                      <div class="alternative">
                                        <input required type="radio" name="{{ $preguntas[$i][$j]->idPreguntaHabito}}" value="2"><label class="hidden-lg hidden-md">Pocas Veces</label>
                                      </div>
                                   </div>
                                   <div class="env-alternative"  style="width:25%;">
                                      <div class="alternative">
                                        <input required type="radio" name="{{ $preguntas[$i][$j]->idPreguntaHabito}}" value="3"><label class="hidden-lg hidden-md">Muchas Veces</label>
                                      </div>
                                   </div>
                                   <div class="env-alternative"  style="width:25%;">
                                      <div class="alternative">
                                        <input required type="radio" name="{{ $preguntas[$i][$j]->idPreguntaHabito}}" value="4"><label class="hidden-lg hidden-md">Sí</label>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          @endfor
                       @endfor
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
