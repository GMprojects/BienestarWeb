@extends('template')
@section ('contenido')

{!!Form::model($encuesta,['method'=>'PATCH','route'=>['encuesta.update',$encuesta->idEncuesta]])!!}
{{Form::token()}}
<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
			<div class="pull-right">
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> <span class="hidden-xs">Grabar</span></button>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-top: 70px;">
	<div class="col-md-6">

		<div class="row">

				<div class="col-md-12">

					<div class="caja">
						<div class="caja-header large">
					      <div class="caja-icon">1</div>
					      <div class="caja-title">Editar encuesta de {{ $encuesta->tipoActividad->tipo }}</div>
					   </div>
						<div class="caja-body">
							<div id="divErrorSubmit" class="alert alert-danger" style='display:none;'>
								<button type="button" class="close" onclick="ocultarErrorSubmit()"><span aria-hidden="true">&times;</span></button>
								<h4>Error</h4>
								<p>Por favor ingrese almenos <strong>2 etiquetas</strong> y almenos <strong>1 enunciado</strong></p>
							</div>
							<div class="row">
								<div class="col-md-8">
									<p> <strong>Titulo:</strong>
										<input required type="text" name="titulo" value ="{{ $encuesta->titulo }}" class="form-control" placeholder="Título que describa la categoría de actividades a la que va dirigida">
									</p>

			   				</div>
								<div class="col-md-4">
									<p>
										<label for="destino">Dirigido A: </label>
										<select name="destino" class="form-control">
											@if($encuesta->destino == 'i')
												<option value="i" selected>Inscritos</option>
												<option value="r">Responsable</option>
											@else
												<option value="i">Responsable</option>
												<option value="r" selected>Responsable</option>
											@endif
										</select>
									</p>
			   					</div>
								</div>
							</div>
							<div class="caja-footer">
							</div>
						</div>
				</div>

				<div class="col-md-12">
					<div class="caja">
						<div class="caja-header large">
					      <div class="caja-icon">2</div>
					      <div class="caja-title">Escala de valoración
								<div class="pull-right">
									<button data-toggle="tooltip" data-placement="bottom" title="Agregar nueva etiqueta" type="button" name="btAddAlternativa" id="btAddAlternativa" class="btn btn-ff-green"><i class="fa fa-plus"></i>Etiqueta</button>
								</div>
							</div>
					   </div>

						<div class="caja-body">
							<p>
								Puede arrastrar las cajas de las <strong>etiquetas</strong> para cambiar el orden
							</p>
							<div id="alternativas">
								 <ol style="padding: 0px;" class="enc-list" id="sortable2">
									 @for ( $i = 0; $i < count($encuesta->alternativas); $i++ )

										   <li class="item-edit" id="a{{$encuesta->alternativas[$i]->idAlternativa}}">
				  								 <button data-toggle="tooltip" data-placement="top" title="Eliminar etiqueta" type="button" class="close close-red" onclick="removeElemento('a{{$encuesta->alternativas[$i]->idAlternativa}}')"><span aria-hidden="true">&times;</span></button>
				  								 <label for="etiqueta">Etiqueta: </label>
				  				 				<input id="e{{ $encuesta->alternativas[$i]->idAlternativa }}" type="text" name="e{{ $encuesta->alternativas[$i]->idAlternativa }}" required value = "{{ $encuesta->alternativas[$i]->etiqueta }}" class="form-control" placeholder="Una etiqueta que indique la valoración">

					  						</li>
									 @endfor

								 </ol>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="caja">
			<div class="caja-header">
		      <div class="caja-icon">3</div>
		      <div class="caja-title">Lista de enunciados
					<div class="pull-right">
						<button data-toggle="tooltip" data-placement="bottom" title="Agregar nuevo enunciado" type="button" name="btAddPregunta" id="btAddPregunta" class="btn btn-ff-green"><i class="fa fa-plus"></i>Enunciado</button>
					</div>
				</div>
		   </div>

			<div class="caja-body">
				<p>
					Puede arrastrar las cajas de las preguntas para cambiar el orden
				</p>
				<div id="preguntas">
					 <ol style="padding: 0px;" class="enc-list" id="sortable">
						 @foreach ( $encuesta->preguntas as $pregunta )
							 @if( $pregunta->estado == 1 )
								 <li class="item-edit" id="p{{$pregunta->idPreguntaEncuesta}}">
									 <button data-toggle="tooltip" data-placement="top" title="Eliminar enunciado" type="button" class="close close-red" onclick="removeElemento('p{{$pregunta->idPreguntaEncuesta}}')"><span aria-hidden="true">&times;</span></button>
									 <textarea style="resize: none;" minlength="10" name="p{{ $pregunta->idPreguntaEncuesta }}" class="form-control" required rows="2" cols="30" >{{ $pregunta->enunciado }}</textarea>
								 </li>
							 @endif
						 @endforeach
					 </ol>
				</div>

			</div>

		</div>
	</div>
</div>
{!!Form::close()!!}

<script>
function removeElemento(elemento){
	$('#'+elemento).remove();
}
var pre_adds = 1, alt_adds = 1;
$('#btAddPregunta').on('click', function(){
	$('#preguntas ol').append('<li class="item-edit" id="p_a'+pre_adds+'"><button data-toggle="tooltip" data-placement="top" title="Eliminar enunciado" type="button" class="close close-red" onclick="removeElemento(\'p_a'+pre_adds+'\')"><span aria-hidden="true">&times;</span></button><textarea style="resize: none;" minlength="2" name="p_a'+pre_adds+'" class="form-control" required rows="2" cols="30" placeholder="Un nuevo enunciado..." autofocus></textarea></li>');
	pre_adds++;
});
$('#btAddAlternativa').on('click', function(){
	$('#alternativas ol').append('<li class="item-edit" id="a_a'+alt_adds+'"> <button data-toggle="tooltip" data-placement="top" title="Eliminar etiqueta" type="button" class="close close-red" onclick="removeElemento(\'a_a'+alt_adds+'\')"><span aria-hidden="true">&times;</span></button><div class="row"><div class="col-md-8 col-sm-8 col-xs-8"><label for="etiqueta">Etiqueta: </label><input id="e_a'+pre_adds+'" type="text" name="e_a'+pre_adds+'" class="form-control" required placeholder="Una etiqueta que indique la valoración"></div><div class="col-md-4 col-sm-4 col-xs-4"><label for="valor">Valor: </label><input id="v_a'+alt_adds+'" required type="number" name="v_a'+alt_adds+'" class="form-control"></div></div></li>');
	alt_adds++;
});
$( function() {
  $( "#sortable" ).sortable({
	 placeholder: "ui-state-highlight"
  });
  $( "#sortable" ).disableSelection();
} );

$( function() {
  $( "#sortable2" ).sortable({
	 placeholder: "ui-state-highlight"
  });
  $( "#sortable2" ).disableSelection();
} );

$('form').on('submit', function(event){
	var alt = $("#alternativas li").length;
	var enu = $("#preguntas li").length;
	if(enu > 0 && alt > 1){
		return;
	}else{
		event.preventDefault();
		document.getElementById('divErrorSubmit').style.display = 'block';
	}
});

function ocultarErrorSubmit(){
	document.getElementById('divErrorSubmit').style.display = 'none';
}
</script>
@endsection
