@extends('template')
@section ('contenido')
	<script>
		//EDITARRRRR//
		$(document).ready(function(){
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green',
					increaseArea: '20%' // optional
				});
				$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
			var destino = '{{ $encuesta->destino }}';
			switch ( {{ $encuesta->tipo }} ) {
				case 1:
					$('#rad_1').prop('checked', true);
					$('#tipo_1').css('display', 'block');
					if( destino == 'r' ){
						$('#op_r').prop('selected', true);
					}
					break;
				case 2:
					$('#rad_2').prop('checked', true);
					$('#tipo_2').css('display', 'block');
					if(destino.includes('1')){
						$('#cb_alumnos').prop('checked', true);
					}
					if(destino.includes('2')){
						$('#cb_docentes').prop('checked', true);
					}
					if(destino.includes('3')){
						$('#cb_administrativos').prop('checked', true);
					}
					break;
				case 3:
					$('#rad_3').prop('checked', true);
					$('#tipo_3').css('display', 'block');
					if( destino == 'd' ){
						$('#op_d').prop('selected', true);
					}else{
						$('#op_a').prop('selected', true);
					}
					break;

			}
			if( {{ $encuesta->tipo }} == 1 ){ //encuesta de ACTIVIDADES

			}else if( {{ $encuesta->tipo }} == 2){
				$('#rad_2').prop('checked', true);
				$('#tipo_1').css('display', 'none');

			}
		});
		//IDs de los elementos
		var seccion = {{ count( $encuesta->secciones ) + 1 }};
		var enunciado = {{ count( $encuesta->preguntas ) + 1 }};
		var alternativa = {{ count( $encuesta->alternativas ) + 1 }};
		//CANTIDAD de los elementos
		//ALTERNATIVAS
		var array_alternativas = [];
		var array_enunciados = []; //items -- enunciados
		var array_secciones = [];
		//--- funciones de ENCUESTA ---//
		function removeSeccion(seccion) {
			$('#'+seccion).remove();
			array_secciones = array_secciones.filter(item => item !== seccion);
		}
		function removeEnunciado(seccion, enunciado) {
			array_enunciados = array_enunciados.filter(item => item !== enunciado);
			$('#'+enunciado).remove();
			if($('#'+seccion+' .item').length == 0) {
				$('#'+seccion+' .alt-headers').html("");
			}
		}
		function removeAlternativa(alternativa) {
			array_alternativas = array_alternativas.filter(item => item !== alternativa);
			$('#'+alternativa).remove();
			actualizar_items();
			actualizar_headers();
		}
		function addEnunciado( seccion ) {
			var alternativas = my_alternatives( enunciado );
			if( $('#'+seccion+' .item').length == 0 ){
				$('#'+seccion+' .alt-headers').html(my_headers());
			}
			$('#'+seccion+' ol').append(
				'<div class="item" id="'+ seccion + '_i' + enunciado +'_new">'+
					'<div class="question">'+
					  '<li>'+
						  '<span class="quest-text">'+
							  '<textarea required minlength="2" name="'+ seccion + '_e' + enunciado +'_new" rows="1" class="ff-control" placeholder="Ingrese aquí el enunciado">Un nuevo enunciado - '+ enunciado +'</textarea>'+
						  '</span>'+
					 '</li>'+
					'</div>'+
					'<div class="alternatives">'+ alternativas +
					'</div>'+
					'<div class="i-tools"><a href="#!"><i class="fa fa-remove" onclick="removeEnunciado(\''+ seccion + '\', \''+ seccion + '_i' + enunciado +'_new\')"></i></a></div>'+
				'</div>'
			);
			array_enunciados.push( seccion + '_i' + enunciado + '_new');
			enunciado++;
		}
		function verificarOrden() {
			array_alternativas = [];
			$( '#entrada_alternativas input' ).each( function(){
				array_alternativas.push($(this).attr('name'));
			});
			console.log( array_alternativas );
		}
		function verEnun() {
			array_enunciados = [];
			$( '.items .item' ).each( function(){
				array_enunciados.push($(this).attr('id'));
			});
			console.log( array_enunciados );
		}
		function verSecc() {
			array_secciones = ['s0'];
			$( '#secciones .seccion' ).each( function(){
				array_secciones.push($(this).attr('id'));
			});
			console.log( array_secciones );
		}
		function actualizar_items() {
			for (var i = 0; i < array_enunciados.length; i++) {
				$('#'+array_enunciados[i]+ ' .alternatives').html(my_alternatives(array_enunciados[i]));
			}
		}
		function actualizar_headers() {
			for (var i = 0; i < array_secciones.length; i++) {
				if($('#'+array_secciones[i]+' .item').length > 0) {
					$('#'+array_secciones[i]+' .alt-headers').html(my_headers());
				} else {
					$('#'+array_secciones[i]+' .alt-headers').html("");
				}
			}
		}
		function my_headers() {
			var headers = "";
			for (var i = 0; i < array_alternativas.length; i++) {
				headers = headers +
					'<div class="alternative alt-header">'+
						'<span>' + $('#'+ array_alternativas[i]+' input').val() + '</span>'+
					'</div>'
			}
			return headers;
		}
		function my_alternatives( enunciado ) {
			var alternativas = "";
			for (var i = 0; i < array_alternativas.length; i++) {
				alternativas = alternativas +
					'<div class="alternative">'+
						'<input type="radio" name="p' + enunciado + '" value="">'+
						'<label class="hidden-lg hidden-md">'+ $('#'+ array_alternativas[i]+' input').val() +'</label>'+
					'</div>';
			}
			return alternativas;
		}
	</script>

{!!Form::model($encuesta,['method'=>'PATCH','route'=>['encuesta.update',$encuesta->idEncuesta], 'onsubmit'=>'return validar()'])!!}
{{Form::token()}}

<div class="modal fade" id="enc-motivo">
	 <!-- /.modal-dialog -->
	 <div class="modal-dialog">
			<!-- /.modal-content -->
			<div class="modal-content">
				  <div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="fa fa-remove"></span></button>
						 <h4 class="modal-title"><b>Destino</b></h4>
				  </div>
				  <div class="modal-body">
					  <div class="caja-body">
						  <div class="form-group">
							  <label for="">Tipo de encuesta: </label>
							  <div class="row" style="margin-left: 10px;">
								  <div class="col-md-12 col-xs-12" style="margin-bottom: 15px;">
									  <input id="rad_1" type="radio" name="tipo_encuesta" value="1" onchange="cambiarTipo(1)" checked>
									  <span style="margin-left: 10px;"  for="tipo_encuesta">
										  <strong>Encuesta asociada a un Tipo de Actividad</strong>. Se enviará a los participantes de una activdad ejecutada.
									  </span>
								  </div>
								  <div class="col-md-12 col-xs-12">
									  <input id="rad_2" type="radio" name="tipo_encuesta" value="2" onchange="cambiarTipo(2)" >
									  <span style="margin-left: 10px;" for="tipo_encuesta">
										  <strong>Encuesta libre</strong>. Se podrá enviar en cualquier momento.
									  </span>
								  </div>
								  <div class="col-md-12 col-xs-12">
									  <input id="rad_3" type="radio" name="tipo_encuesta" value="3" onchange="cambiarTipo(3)" >
									  <span style="margin-left: 10px;" for="tipo_encuesta">
										  <strong>Encuesta Tutoría</strong>. Se podrá enviar en cualquier momento a tutores o tutorados.
									  </span>
								  </div>
							  </div>
						  </div>
						  <div class="row" id="tipo_1" style="display: none;">
							  <div class="col-md-8">
								  <div class="form-group">
									  <label for="idTipoActividad">Categoría de Actividad: </label>
									  <select name="idTipoActividad" class="form-control" id="tiposActividad">
										  @foreach($tipos as $tipo)
											  @if($encuesta->tipo == 1 && $encuesta->idTipoActividad == $tipo->idTipoActividad)
												  <option value={{$tipo->idTipoActividad}} selected>{{$tipo->tipo}}</option>
											  @else
												  <option value={{$tipo->idTipoActividad}}>{{$tipo->tipo}}</option>
											  @endif
										  @endforeach
									  </select>
								  </div>
							  </div>
							  <div class="col-md-4">
								  <div class="form-group">
									  <label for="destino_1">Dirigida a: </label>
									  <select name="destino_1" class="form-control">
										  <option id="op_i" value="i">Inscritos</option>
										  <option id="op_r" value="r">Responsable</option>
									  </select>
								  </div>
							  </div>
						  </div>
						  <div class="form-group"  id="tipo_2" style="display: none;">
							  <label for="">Dirigida a:</label>
							  <div class="row" style="margin-left: 10px;">

									  <div class="col-md-12">
										  <input type="checkbox" id="cb_alumnos" name="destino_2[]" value="1"><label style="margin-left: 10px;" for=""> Alumnos</label>
									  </div>
									  <div class="col-md-12">
										  <input type="checkbox" id="cb_docentes" name="destino_2[]" value="2"><label style="margin-left: 10px;" for=""> Docentes</label>
									  </div>
									  <div class="col-md-12">
										  <input type="checkbox" id="cb_administrativos" name="destino_2[]" value="3"><label style="margin-left: 10px;" for=""> Administrativos</label>
									  </div>

							  </div>
						  </div>

						  <div class="form-group"  id="tipo_3" style="display: none;">
							  <div class="form-group">
								  <label for="destino_3">Dirigida a: </label>
								  <select name="destino_3" class="form-control">
									  <option id="op_d" value="d">Tutores</option>
									  <option id="op_a" value="a">Tutorados</option>
								  </select>
							  </div>
						  </div>

							<span class="help-block"  style='display:none;' id="spanErrorResponsable">
								<strong style="color:red;"><p>Debe dirigir las encuestas a al menos un tipo de usuario.</p></strong>
							</span>
					  </div>

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

<div class="modal fade" id="enc-alternativas">
	 <!-- /.modal-dialog -->
	 <div class="modal-dialog">
			<!-- /.modal-content -->
			<div class="modal-content">
				  <div class="modal-header">
					 <b style="font-size: 1.5em;">Lista de Alternativas</b>
					  <div class="pull-right">
						  <button type="button" name="button1" id="btAddAlternativa" class="btn btn-ff-green"><i class="fa fa-plus"></i>Añadir Alternativa</button>
					  </div>
				  </div>
				  <div class="modal-body">
					  <div class="caja-body">
						  <ul class="enc-list" id="entrada_alternativas" style="margin-bottom: 0px;  padding-left:0px; list-style:none;">
							  @php $i_header = 1; @endphp
							  @foreach ($encuesta->alternativas->sortBy('valor') as $alternativa)
								  <li class="item-edit"  id="a_{{ $alternativa->idAlternativa }}" >
									  	@if($i_header > 2)
											<button data-toggle="tooltip" data-placement="top" title="Eliminar alternativa" type="button" class="close close-red" onclick="removeAlternativa('a_{{ $alternativa->idAlternativa }}')">
												<span aria-hidden="true">&times;</span>
											</button>
										@endif
										<input value="{{ $alternativa->etiqueta }}" maxlength="20" type="text" name="a_{{ $alternativa->idAlternativa }}"  required  class="form-control" placeholder="Una alternativa" />
									</li>
									@php $i_header++; @endphp
							  @endforeach
			 			 </ul>
					  </div>

				  </div>
				  <div class="modal-footer">
						  <div class="pull-right">
							  <a class="btn btn-ff pull-right" data-dismiss="modal" onclick="verificarOrden(); actualizar_items(); actualizar_headers();"> <i class="fa fa-refresh"></i> Actualizar</a>
						  </div>
				  </div>
			</div>
			<!-- /.modal-content -->
	 </div>
	 <!-- /.modal-dialog -->
</div>

<div class="caja encuesta">
	 <div class="caja-header">
		  <div class="caja-icon">
				<i class="fa fa-list-ul"></i>
		  </div>
		  <div class="caja-title">
				<textarea required autofocus minlength="2" name="titulo" rows="1" class="ff-control" placeholder="Ingrese aquí el título de la encuesta">{{ $encuesta->titulo }}</textarea>
		  </div>
		  <div class="caja-tools">
			  <div class="dropdown">
				  <a href="#!" class="dropdown-toggle" data-toggle="dropdown">
					  <i class="fa fa-ellipsis-v"></i>
				  </a>
				  <ul class="dropdown-menu">
					  <li class="s-option"> <a href="#!" id="btAddSeccion">Añadir seccion</a> </li>
					  <li class="s-option"> <a href="#!" id="btAddEnunciado" onclick="addEnunciado('s0')">Añadir enunciado</a> </li>
					  <li role="separator" class="divider"></li>
					  <li class="s-option"> <a href="#!" data-toggle="modal" data-target="#enc-alternativas">Editar Alternativas</a> </li>
					  <li class="s-option"> <a href="#!" data-toggle="modal" data-target="#enc-motivo">Editar destino</a> </li>
				  </ul>
			  </div>
		  </div>
	 </div>
	 <div class="caja-body">
		 <div id="divErrorSubmit" class="alert alert-danger" style='display:none;'>
			 <button type="button" class="close" onclick="ocultarErrorSubmit()"><span aria-hidden="true">&times;</span></button>
			 <h4>Ups!</h4>
			 <p>Por favor ingrese almenos <strong>2 alternativas</strong> y almenos <strong>1 enunciado</strong></p>
		 </div>
		 <div class="encu-description">
			 <textarea minlength="2" name="descripcion" rows="1" class="ff-control" placeholder="Puede ingresar aquí una descripción de la encuesta (opcional)">{{ $encuesta->descripcion }}</textarea>
		 </div>

		 <div class="items" id="s0">
			 <div class="alternatives hidden-xs hidden-sm alt-headers">
			 </div>
			 <ol class="enc-list">
				 @foreach ($encuesta->preguntas->where('idSeccion', null)->where('estado', 1)->sortBy('orden') as $pregunta_ns)
					 <div class="item" id="s0_i{{ $pregunta_ns->idPregunta }}">
			 			<div class="question">
			 			  <li>
			 				  <span class="quest-text">
			 					  <textarea required minlength="2" name="s0_e{{ $pregunta_ns->idPregunta }}" rows="1" class="ff-control" placeholder="Un enunciado">{{ $pregunta_ns->enunciado }}</textarea>
			 				  </span>
			 			 </li>
			 			</div>
			 			<div class="alternatives">
			 			</div>
			 			<div class="i-tools"><a href="#!"><i class="fa fa-remove" onclick="removeEnunciado('s0', 's0_i{{ $pregunta_ns->idPregunta }}')"></i></a></div>
			 		</div>
				 @endforeach

			 </ol>
		 </div>
		 <div class="secciones" id="secciones">
			 @foreach ($encuesta->secciones->where('estado', 1)->sortBy('orden') as $seccion)
				 <div class="seccion" id="s{{ $seccion->idSeccion }}">
 			 		<div class="s-header">
 			 			<div class="s-icon">{{ $seccion->orden }}</div>
 			 			<div class="s-title"><textarea required minlength="2" name="titulo_s{{ $seccion->idSeccion }}" rows="1" class="ff-control" placeholder="Ingrese aquí el título de la sección">{{ $seccion->titulo }}</textarea></div>
 			 			<div class="s-tools">
 			 				<div class="s-button">
 			 					<a data-toggle="collapse" href="#box_s{{ $seccion->idSeccion }}" aria-expanded="false" aria-controls="items_s{{ $seccion->idSeccion }}" > <i class="fa fa-minus"></i></a>
 			 				</div>
 			 				<div class="s-button">
 			 					<div class="dropdown">
 			 						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
 			 							<i class="fa fa-ellipsis-v"></i>
 			 						</a>
 			 						<ul class="dropdown-menu">
 			 							<li class="s-option"> <a href="#!" onclick="addEnunciado('s{{ $seccion->idSeccion }}')">Añadir enunciado</a> </li>
 			 						</ul>
 			 					</div>
 			 				</div>
 			 				<div class="s-button">
 			 					<a href="#!" data-toggle="tooltip" data-placement="top" title="Eliminar sección" type="button" onclick="removeSeccion('s{{ $seccion->idSeccion }}')"><i class="fa fa-remove"></i></a>
 			 				</div>
 			 			</div>

 			 		</div>
 			 		<div class="s-body">
 			 			<div class="s-description">
 			 				<textarea minlength="2" name="descripcion_s{{ $seccion->idSeccion }}" rows="1" class="ff-control" placeholder="Puede ingresar aquí una descripción de la sección (opcional)">{{ $seccion->descripcion }}</textarea>
 			 			</div>
 			 			<div class="items"  id="box_s{{ $seccion->idSeccion }}">
 							<div class="alternatives hidden-xs hidden-sm alt-headers">
 			 				</div>
 			 				<ol class="enc-list">
								@foreach ($seccion->preguntas->where('estado', 1)->sortBy('orden') as $pregunta)
									<div class="item" id="s{{ $seccion->idSeccion }}_i{{ $pregunta->idPregunta }}">
	 			  			 			<div class="question">
	 			  			 			  <li>
	 			  			 				  <span class="quest-text">
	 			  			 					  <textarea required minlength="2" name="s{{ $seccion->idSeccion }}_e{{ $pregunta->idPregunta }}" rows="1" class="ff-control" placeholder="empty">{{ $pregunta->enunciado }}</textarea>
	 			  			 				  </span>
	 			  			 			 </li>
	 			  			 			</div>
	 			  			 			<div class="alternatives">
	 			  			 			</div>
	 			  			 			<div class="i-tools"><a href="#!"><i class="fa fa-remove" onclick="removeEnunciado('s{{ $seccion->idSeccion }}', 's{{ $seccion->idSeccion }}_i{{ $pregunta->idPregunta }}')"></i></a></div>
	 			  			 		</div>
								@endforeach
 			 				</ol>
 			 			</div>
 			 		</div>
 				</div>
			 @endforeach
			<script>
				verificarOrden();
				verSecc();
				verEnun();
				actualizar_items();
				actualizar_headers();
				$( ".items ol" ).sortable({
					placeholder: "ui-state-highlight"
			   });
			   $( ".items ol" ).disableSelection();
			</script>
		 </div>
	 </div>
	 <div class="caja-footer">
		 <button class="btn btn-ff pull-right" type="submit"><i class="fa fa-save"></i> Guardar</button>
	 </div>
</div>

{!!Form::close()!!}

<script>

function validar(){
		var todoBien = true;
		if ($('#rad_2').is(':checked')) {
			if (!$('.destino').is(':checked')) {
				document.getElementById('spanErrorResponsable').style.display = 'block';
				todoBien = false;
			}
		}
		if (!todoBien) {
			$("#enc-motivo").modal("show");
		}
		return todoBien;
}

$("#enc-motivo").on('hidden.bs.modal', function () {
		document.getElementById('spanErrorResponsable').style.display = 'block';
});

$('#btAddSeccion').on('click', function(){
	$('#secciones').append(
	'<div class="seccion" id="s'+ seccion +'_new">'+
		'<div class="s-header">'+
			'<div class="s-icon">'+ seccion +'</div>'+
			'<div class="s-title"><textarea required minlength="2" name="titulo_s'+ seccion +'_new" rows="1" class="ff-control" placeholder="Ingrese aquí el título de la sección">Una nueva sección - '+ seccion +'</textarea></div>'+
			'<div class="s-tools">'+
				'<div class="s-button">'+
					'<a data-toggle="collapse" href="#box_s'+ seccion +'_new" aria-expanded="false" aria-controls="items_s'+ seccion +'" > <i class="fa fa-minus"></i></a>'+
				'</div>'+
				'<div class="s-button">'+
					'<div class="dropdown">'+
						'<a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
							'<i class="fa fa-ellipsis-v"></i>'+
						'</a>'+
						'<ul class="dropdown-menu">'+
							'<li class="s-option"> <a href="#!" onclick="addEnunciado(\'s'+ seccion +'_new\')">Añadir enunciado</a> </li>'+
						'</ul>'+
					'</div>'+
				'</div>'+
				'<div class="s-button">'+
					'<a href="#!" data-toggle="tooltip" data-placement="top" title="Eliminar sección" type="button" onclick="removeSeccion(\'s'+seccion+'_new\')"><i class="fa fa-remove"></i></a>'+
				'</div>'+
			'</div>'+

		'</div>'+
		'<div class="s-body">'+
			'<div class="s-description">'+
				'<textarea minlength="2" name="descripcion_s'+ seccion +'_new" rows="1" class="ff-control" placeholder="Puede ingresar aquí una descripción de la sección (opcional)"></textarea>'+
			'</div>'+
			'<div class="items"  id="box_s'+ seccion +'_new">'+

				'<div class="alternatives hidden-xs hidden-sm alt-headers">'+
					//aquí irán las ALTERNATIVAS que se vayan agregando
				'</div>'+
				'<ol class="enc-list sortable">'+
					//aquí irán los ENUNCIADOS que se vayan agregando
				'</ol>'+
			'</div>'+
		'</div>'+
	'</div>');
	array_secciones.push('s' + seccion + '_new');
	seccion++;
	$( ".items ol" ).sortable({
		placeholder: "ui-state-highlight"
	});
	$( ".items ol" ).disableSelection();
});
$('#btAddAlternativa').on('click', function(){
	$('#entrada_alternativas').append('<li class="item-edit"  id="a_'+alternativa+'_new"> <button data-toggle="tooltip" data-placement="top" title="Eliminar alternativa" type="button" class="close close-red" onclick="removeAlternativa(\'a_'+alternativa+'_new\')"><span aria-hidden="true">&times;</span></button><input maxlength="20" type="text" name="a_'+alternativa+'_new"  required  class="form-control" placeholder="Una nueva alternativa" /></li>');
	array_alternativas.push('a_'+alternativa+'_new');
	actualizar_items();
	actualizar_headers();
	alternativa++;
});

$('#enc-motivo').modal('show');
$( function() {
  $( "#s0 ol" ).sortable({
	 placeholder: "ui-state-highlight"
  });
  $( "#s0 ol" ).disableSelection();
} );
$( function() {
  $( "#entrada_alternativas" ).sortable({
	 placeholder: "ui-state-highlight"
  });
  $( "#entrada_alternativas" ).disableSelection();
} );
$('form').on('submit', function(event){
	for (var i = 0; i < array_alternativas.length; i++) {
		if($('#'.array_alternativas[i]).val() == ""){
			$('#entrada_alternativas').modal('show');
		}
	}
	if(array_enunciados.length == 0 && array_alternativas.length < 2){
		event.preventDefault();
		document.getElementById('divErrorSubmit').style.display = 'block';
	}else{
		return;
	}
});
function ocultarErrorSubmit(){
	document.getElementById('divErrorSubmit').style.display = 'none';
}

$(document).on('change keyup keydown paste cut', 'textarea', function(){
	$(this).css('height','auto');
	$(this).height(this.scrollHeight);
});
$(document).on('focus', 'textarea', function() {
	this.select();
	this.onmouseup = function() {
		this.onmouseup = null;
		return false;
	}
});
$(document).on('ready', function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%' // optional
	});
	$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
});
function cambiarTipo(tipo){
	$('#tipo_1').css('display', 'none');
	$('#tipo_2').css('display', 'none');
	$('#tipo_3').css('display', 'none');
	switch (tipo) {
		case 1: $('#tipo_1').css('display', 'block'); break;
		case 2: $('#tipo_2').css('display', 'block'); break;
		case 3: $('#tipo_3').css('display', 'block'); break;
	}
}
</script>

<style media="screen">
	textarea{
		resize: none;
		overflow:hidden;
		background-color: transparent;
	}
	.dropdown-menu{
	   padding: 1px 0 0 0;
	   border-top-width: 0;
	   width: auto;
	   right: 0px;
	   left: auto;
	}

	.ui-state-highlight {
	   height: 70px;
	   background-color: #D3C7E8;
		border: 1px solid #D3C7E8;;
	}
	.item{
		cursor: all-scroll;
	}
	.item-edit{
		cursor: all-scroll;
		margin-bottom: 5px;
		background-color: rgba(0, 0, 0, 0.03);
		display: list-item;
    	text-align: -webkit-match-parent;
		padding: 5px;
	}
	.item-edit:nth-child(even){
		background-color: rgba(0, 0, 0, 0.1);
	}
</style>
@endsection
