@extends('template')
@section ('contenido')
{!!Form::open(['url'=>'admin/encuesta','method'=>'POST','autocomplete'=>'off'])!!}
{{Form::token()}}
<div class="row">
	<div class="col-xs-12">
		<div class="second-bar">
			<div class="pull-left">
				<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
			</div>
			<div class="pull-right">
				<button data-toggle="tooltip" data-placement="bottom" title="Agregar nuevo enunciado" type="button" name="btAddPregunta" id="btAddPregunta" class="btn btn-ff-green"><i class="fa fa-plus"></i>Enunciado</button>
				<button data-toggle="tooltip" data-placement="bottom" title="Agregar nueva etiqueta" type="button" name="btAddAlternativa" id="btAddAlternativa" class="btn btn-ff-greenOs"><i class="fa fa-plus"></i>Etiqueta</button>
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
					      <div class="caja-title">Nueva encuesta</div>
					   </div>
						<div class="caja-body">
							<div id="divErrorSubmit" class="alert alert-danger" style='display:none;'>
								<button type="button" class="close" onclick="ocultarErrorSubmit()"><span aria-hidden="true">&times;</span></button>
								<h4>Error</h4>
								<p>Por favor ingrese almenos <strong>2 etiquetas</strong> y almenos <strong>1 enunciado</strong></p>
							</div>
							<div class="form-group">
								<label for="titulo">Título: </label>
								<input required type="text" name="titulo" value ="{{old('titulo')}}" class="form-control" placeholder="Título que describa la categoría de actividades a la que va dirigida">
							</div>
							<div class="row">
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
										<label for="destino">Dirigido A: </label>
										<select name="destino" class="form-control">
											<option value="i">Inscritos</option>
											<option value="r">Responsable</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="col-md-12">
					<div class="caja">
						<div class="caja-header large">
					      <div class="caja-icon">2</div>
					      <div class="caja-title">Escala de valoración
							</div>
					   </div>

						<div class="caja-body">
							<p>
								Puede arrastrar las cajas de las <strong>etiquetas</strong> para cambiar el orden.
							</p>
							<div id="alternativas">
								 <ol style="padding: 0px;" class="enc-list" id="sortable2">

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
				</div>
		   </div>

			<div class="caja-body">
				<p>
					Puede arrastrar las cajas de los <strong>Enunciados</strong> para cambiar el orden
				</p>
				<div id="preguntas">
					 <ol style="padding: 0px;" class="enc-list" id="sortable">

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
