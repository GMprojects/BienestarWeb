@extends('template')
@section ('contenido')

{!!Form::open(['url'=>'admin/encuesta','method'=>'POST','autocomplete'=>'off'])!!}
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
									  <input type="radio" name="tipo_encuesta" value="1" onchange="cambiarTipo(1)" checked>
									  <span style="margin-left: 10px;"  for="tipo_encuesta">
										  <strong>Encuesta asociada a un Tipo de Actividad</strong>. Se enviará a los participantes de una activdad ejecutada.
									  </span>
								  </div>
								  <div class="col-md-12 col-xs-12">
									  <input type="radio" name="tipo_encuesta" value="2" onchange="cambiarTipo(2)"  >
									  <span style="margin-left: 10px;" for="tipo_encuesta">
										  <strong>Encuesta libre</strong>. Se podrá enviar en cualquier momento.
									  </span>
								  </div>
							  </div>
						  </div>
						  <div class="row" id="tipo_1" >
							  <div class="col-md-8">
								  <div class="form-group">
									  <label for="idTipoActividad">Categoría de Actividad: </label>
									  <select name="idTipoActividad" class="form-control" id="tiposActividad">
										  @foreach($tipos as $tipo)
											  <option value={{$tipo->idTipoActividad}}>{{$tipo->tipo}}</option>
										  @endforeach
									  </select>
								  </div>
							  </div>
							  <div class="col-md-4">
								  <div class="form-group">
									  <label for="destino">Dirigida a: </label>
									  <select name="destino" class="form-control">
										  <option value="i">Inscritos</option>
										  <option value="r">Responsable</option>
									  </select>
								  </div>
							  </div>
						  </div>
						  <div class="form-group"  id="tipo_2" style="display: none;">
							  <label for="">Dirigida a:</label>
							  <div class="row" style="margin-left: 10px;">
								  <div class="col-md-12">
									  <input type="checkbox" name="destino[]" value="1"><b style="margin-left:12px;">Alumnos</b>
								  </div>
								  <div class="col-md-12">
									  <input type="checkbox" name="destino[]" value="2"><b style="margin-left:12px;">Docentes</b>
								  </div>
								  <div class="col-md-12">
									  <input type="checkbox" name="destino[]" value="3"><b style="margin-left:12px;">Administrativos</b>
								  </div>
							  </div>
						  </div>
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
<div class="caja encuesta">
	 <div class="caja-header">
		  <div class="caja-icon">
				<i class="fa fa-list-ul"></i>
		  </div>
		  <div class="caja-title">
				<textarea required autofocus minlength="2" name="titulo" rows="1" class="ff-control" placeholder="Ingrese aquí el título de la encuesta">Una encuesta sin título</textarea>
		  </div>
		  <div class="caja-tools">
			  <div class="dropdown">
				  <a href="#!" class="dropdown-toggle" data-toggle="dropdown">
					  <i class="fa fa-ellipsis-v"></i>
				  </a>
				  <ul class="dropdown-menu">
					  <li class="s-option"> <a href="#!" id="btAddAlternativa">Añadir alternativa</a> </li>
					  <li class="s-option"> <a href="#!" id="btAddSeccion">Añadir seccion</a> </li>
					  <li class="s-option"> <a href="#!" id="btAddEnunciado" onclick="addEnunciado(0)">Añadir enunciado</a> </li>
					  <li role="separator" class="divider"></li>
					  <li class="s-option"> <a href="#!" data-toggle="modal" data-target="#enc-motivo">Configurar destino</a> </li>
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
			 <textarea minlength="2" name="descripcion" rows="1" class="ff-control" placeholder="Puede ingresar aquí una descripción de la encuesta (opcional)"></textarea>
		 </div>
		 <div class="items" id="seccion_0">
			 <ul class="alternatives" id="alternativas_ns" style="margin-bottom: 0px;  padding-left:0px; list-style:none;">
				<li class="alternative alt-header" id="alt_li_1">
					<span><textarea required maxlength="20" minlength="2" style="text-align: center;" name="a_1" id="a_1" rows="1" class="ff-control" placeholder="Alternativa-1">Alternativa-1</textarea></span>
				</li>
				<li class="alternative alt-header" id="alt_li_2">
					<span><textarea required maxlength="20" minlength="2" style="text-align: center;" name="a_2" id="a_2" rows="1" class="ff-control" placeholder="Alternativa-2">Alternativa-2</textarea></span>
				</li>
			 </ul>
			 <ol class="enc-list sortable" id="ol_s0">
				 <div class="item" id="item_1">
		 			<div class="question">
		 			  <li>
		 				  <span class="quest-text">
		 					  <textarea required minlength="2" name="s0_e1" rows="1" class="ff-control" placeholder="Un nuevo enunciado">Un nuevo enunciado - 1</textarea>
		 				  </span>
		 			 </li>
		 			</div>
		 			<div class="alternatives" id="div_alt_1">
						<div class="alternative">
							<input type="radio" name="alternativas1" value="">
							<label class="hidden-lg hidden-md">Alternativa-1</label>
						</div>
						<div class="alternative">
							<input type="radio" name="alternativas1" value="">
							<label class="hidden-lg hidden-md">Alternativa-2</label>
						</div>
		 			</div>
		 			<div class="i-tools"><a href="#!"><i class="fa fa-remove" onclick="removeEnunciado('item_1')"></i></a></div>
		 		</div>
			 </ol>
		 </div>
		 <div class="secciones" id="secciones">
		 </div>
	 </div>
	 <div class="caja-footer">
		 <button class="btn btn-ff pull-right" type="submit"><i class="fa fa-save"></i> Guardar</button>
	 </div>
</div>

{!!Form::close()!!}

<script>
//IDs de los elementos
var seccion = 1;
var enunciado = 2;
var alternativa = 3;
//CANTIDAD de los elementos
var n_sec = 0;
var n_enu = 1;
var n_alt = 2;
//ALTERNATIVAS
var array_alternativas = [];
//--- funciones de ENCUESTA ---//
function removeElemento(elemento){
	$('#'+elemento).remove();
}
function removeSeccion(seccion){
	$('#'+seccion).remove();
	n_sec--;
}
function removeEnunciado(enunciado){
	$('#'+enunciado).remove();
	n_enu--;
}
function removeAlternativa(alternativa){
	$('#'+alternativa).remove();
	n_alt--;
	actualizar_items();
}
function addEnunciado( seccion ){
	var alternativas = my_alternatives( enunciado );
	$('#ol_s'+seccion).append(
		'<div class="item" id="item_'+ enunciado +'">'+
			'<div class="question">'+
			  '<li>'+
				  '<span class="quest-text">'+
					  '<textarea required minlength="2" name="s'+ seccion + '_e' + enunciado +'" rows="1" class="ff-control" placeholder="Ingrese aquí el enunciado">Un nuevo enunciado - '+ enunciado +'</textarea>'+
				  '</span>'+
			 '</li>'+
			'</div>'+
			'<div class="alternatives" id="div_alt_'+ enunciado +'">'+ alternativas +
			'</div>'+
			'<div class="i-tools"><a href="#!"><i class="fa fa-remove" onclick="removeEnunciado(\'item_'+ enunciado+'\')"></i></a></div>'+
		'</div>'
	);
	enunciado++;
	n_enu++;
}
$('#btAddSeccion').on('click', function(){
	$('#secciones').append(
	'<div class="seccion" id="seccion_'+ seccion +'">'+
		'<div class="s-header">'+
			'<div class="s-icon">'+ seccion +'</div>'+
			'<div class="s-title"><textarea required minlength="2" name="titulo_s'+ seccion +'" rows="1" class="ff-control" placeholder="Ingrese aquí el título de la sección">Una nueva sección - '+ seccion +'</textarea></div>'+
			'<div class="s-tools">'+
				'<div class="s-button">'+
					'<a data-toggle="collapse" href="#box_s'+ seccion +'" aria-expanded="false" aria-controls="items_s'+ seccion +'" > <i class="fa fa-minus"></i></a>'+
				'</div>'+
				'<div class="s-button">'+
					'<div class="dropdown">'+
						'<a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
							'<i class="fa fa-ellipsis-v"></i>'+
						'</a>'+
						'<ul class="dropdown-menu">'+
							'<li class="s-option"> <a href="#!" onclick="addEnunciado('+ seccion +')">Añadir enunciado</a> </li>'+
						'</ul>'+
					'</div>'+
				'</div>'+
				'<div class="s-button">'+
					'<a href="#!" data-toggle="tooltip" data-placement="top" title="Eliminar sección" type="button" onclick="removeSeccion(\'seccion_'+seccion+'\')"><i class="fa fa-remove"></i></a>'+
				'</div>'+
			'</div>'+

		'</div>'+
		'<div class="s-body">'+
			'<div class="s-description">'+
				'<textarea minlength="2" name="descripcion_s'+ seccion +'" rows="1" class="ff-control" placeholder="Puede ingresar aquí una descripción de la sección (opcional)"></textarea>'+
			'</div>'+
			'<div class="items"  id="box_s'+ seccion +'">'+

				'<div class="alternatives hidden-xs hidden-sm" id="alternativas_s'+ seccion +'">'+
					//aquí irán las ALTERNATIVAS que se vayan agregando
				'</div>'+
				'<ol class="enc-list sortable" id="ol_s'+ seccion +'">'+
					//aquí irán los ENUNCIADOS que se vayan agregando
				'</ol>'+
			'</div>'+
		'</div>'+
	'</div>');
	n_sec++; seccion++;
});
$('#btAddAlternativa').on('click', function(){
	n_alt++;
	$('#alternativas_ns').append(
		'<li class="alternative alt-header" id="alt_li_'+ alternativa +'">'+
		  '<span><textarea required maxlength="20" minlength="2" style="text-align: center;" name="a_'+ alternativa +'" id="a_'+ alternativa +'" rows="1" class="ff-control" placeholder="Alternativa">Alternativa-'+ alternativa +'</textarea></span>'+
		  '<div class="a-tools"><a href="#!"><i class="fa fa-remove" onclick="removeAlternativa(\'alt_li_'+ alternativa+'\')"></i></a></div>'+
		'</li>');
	alternativa++;
	actualizar_items();
});
function actualizar_items(){
	var i=0; var id=1;
	while (i < n_enu) {
		if($('#item_'+id).length > 0 ){
			$('#div_alt_'+id).html(my_alternatives( id ));
			i++;
		}
		id++;
	}
}
function my_alternatives( enunciado ){
	var i=0; var id=1;
	var alternativas = "";
	var test = "";
	while (i < n_alt) {
		if($('#a_'+id).length > 0){
			alternativas = alternativas +
				'<div class="alternative">'+
					'<input readonly type="radio" name="alternativas" value="" class="icheckbox_square-green">'+
					'<label class="hidden-lg hidden-md">'+ $('#a_'+id).val() +'</label>'+
				'</div>';
				test = test + $('#a_'+id).val() + " - ";
				i++;
		}
		id++;
	}
	if(alternativas == ""){
		return "<p>No hay alternativas</p>"
	}else{
		return alternativas;
	}
}
$('#enc-motivo').modal('show');
$( function() {
  $( "#alternativas_ns" ).sortable({
	 placeholder: "ui-state-highlight"
  });
  $( "#alternativas_ns" ).disableSelection();
} );
$( function() {
  $( "#ol_ns" ).sortable({
	 placeholder: "ui-state-highlight"
  });
  $( "#ol_ns" ).disableSelection();
} );
$('form').on('submit', function(event){
	if(n_enu > 0 && n_alt > 1){
		return;
	}else{
		event.preventDefault();
		document.getElementById('divErrorSubmit').style.display = 'block';
	}
});

function ocultarErrorSubmit(){
	document.getElementById('divErrorSubmit').style.display = 'none';
}

/*
//--- funciones de API ---//
$(document).on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight);
    }).find('textarea').change();
*/
 $(document).on('keyup keydown paste cut', 'textarea', function(){
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
/*$('textarea').focus(function() {
	this.select();
	this.onmouseup = function() {
		this.onmouseup = null;
		return false;
	}
});*/
$(document).ready(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%' // optional
	});
	$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
});
function cambiarTipo(tipo){
	if(tipo == 1){
		document.getElementById('tipo_2').style.display = 'none';
		document.getElementById('tipo_1').style.display = 'block';
	}else{
		document.getElementById('tipo_1').style.display = 'none';
		document.getElementById('tipo_2').style.display = 'block';
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
</style>
@endsection
