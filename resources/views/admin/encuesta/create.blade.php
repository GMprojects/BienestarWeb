@extends('template')
@section ('contenido')
{!!Form::open(['url'=>'admin/encuesta','method'=>'POST','autocomplete'=>'off'])!!}
<meta name="_token" content="{{ csrf_token() }}" />
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li> {{$error}} </li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="caja">
			<div class="caja-header">
				<div class="caja-icon">1</div>
				<div class="caja-title">Datos de la Nueva Encuesta</div>
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
			<div class="caja-footer">

			</div>
		</div>

		<div class="caja">
			<div class="caja-header">
				<div class="caja-icon">2</div>
				<div class="caja-title">Escala de Valoración</div>
			</div>
			<div class="caja-body">
				<div id="divErrorEscala" class="alert alert-danger" style='display:none;'>
					<button type="button" class="close" onclick="ocultarErrorEs()"><span aria-hidden="true">&times;</span></button>
					<h4>Error</h4>
					<p>Por favor llene el campo etiqueta</p>
				</div>
				<div class="row">
				  <div class="col-md-8 col-sm-8 col-xs-8">
					  <div class="form-group">
						  <label for="etiqueta">Etiqueta: </label>
						  <input id="etiqueta" type="text" name="etiqueta" value ="{{old('etiqueta')}}" class="form-control" placeholder="Una etiqueta que indique la valoración">
					  </div>
				  </div>
				  <div class="col-md-4 col-sm-4 col-xs-4">
					 <div class="form-group">
						 <label for="valor">Valor: </label>
						 <input id="valor" type="number" name="valor" value="1" class="form-control">
					 </div>
				 </div>
				</div>
				<div class="row">
					  <div class="col-md-4 col-sm-4 col-xs-4">
						  <div class="form-group">
							  <button type="button" name="button1" id="addRow" class="form-control btn btn-ff-green"><i class="fa fa-plus"></i>Agregar</button>
						  </div>
					 </div>
					 <div class="col-md-offset-4 col-md-4 col-sm-4 col-xs-4">
						 <div class="form-group">
							 <button type="button" name="button2" id="removeRow" class="form-control btn btn-ff-red"><i class="fa fa-minus"></i>Eliminar</button>
						 </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table id="tabAlternativas" class="table table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<th>ID</th>
								<th>Etiqueta</th>
								<th>Valor</th>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="caja-footer">
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="caja">
			<div class="caja-header">
				<div class="caja-icon">3</div>
				<div class="caja-title">Preguntas</div>
			</div>
			<div class="caja-body">
				<div id="divErrorEnunciados" class="alert alert-danger" style='display:none;'>
						<button type="button" class="close" onclick="ocultarErrorEn()"><span aria-hidden="true">&times;</span></button>
						<h4>Error</h4>
						<p>Por favor llene el campo Enunciado</p>
				</div>
				<div class="row">
				  <div class="col-md-12 col-sm-12 col-xs-12">
					  <div class="form-group">
						  <label for="enunciado">Enunciado: </label>
						  <input id="enunciado" type="text" name="enunciado" value ="{{old('enunciado')}}" class="form-control" placeholder="Enunciado expresado con claridad">
					  </div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-4 col-sm-4 col-xs-4">
					  <div class="form-group">
						  <button type="button" name="button1" id="addRowE" class="form-control btn btn-ff-green"><i class="fa fa-plus"></i>Agregar</button>
					  </div>
				 </div>
				 <div class="col-md-offset-4 col-md-4 col-sm-4 col-xs-4">
					 <div class="form-group">
						 <button type="button" name="button2" id="removeRowE" class="form-control btn btn-ff-red"><i class="fa fa-minus"></i>Eliminar</button>
					 </div>
				</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table id="tabPreguntas" class="table table-bordered table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<th>ID</th>
								<th>Enunciado</th>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="caja-footer">
				<div class="pull-left">
					<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> Volver</button>
				</div>
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="hidden" id="oculta">

</div>

<script>
var table;
var tabla;
function ocultarErrorEn(){
	document.getElementById('divErrorEnunciados').style.display = 'none';
}
function ocultarErrorEs(){
	document.getElementById('divErrorEscala').style.display = 'none';
}
function ocultarErrorSubmit(){
	document.getElementById('divErrorSubmit').style.display = 'none';
}
$(document).ready(function() {
	    table = $('#tabAlternativas').DataTable({
			 "language": {
				   "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			  },
	        "scrollY": "70px",
	        "paging": false,
			  "searching": false,
			  "info": false
	    });
	    $('a.toggle-vis').on( 'click', function (e) {
	        e.preventDefault();
	        // Get the column API object
	        var column = table.column( $(this).attr('data-column') );
	        // Toggle the visibility
	        column.visible( ! column.visible() );
	    });
		 var counter = 1;
		 $('#addRow').on( 'click', function () {
			 if($('#etiqueta').val() != ''){
				 table.row.add( [
	 				 counter,
	 				 $('#etiqueta').val(),
	 				 $('#valor').val(),

	 		   ] ).draw( false );
	 			$('#oculta').append('<input type="hidden" id="e' + counter + '" name="e' + counter + '" value="' + $('#etiqueta').val() + '"/>'); //add input box
	 			$('#oculta').append('<input type="hidden" id="v' + counter + '" name="v' + counter + '" value="' + $('#valor').val() + '"/>'); //add input box
	 		   counter++;
	 			$('#etiqueta').val("");
	 			$('#valor').val(counter);
			}else{
				document.getElementById('divErrorEscala').style.display = 'block';
			}
		 });

		 $('#tabAlternativas tbody').on( 'click', 'tr', function () {
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	        }
	        else {
	            table.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	        }
	    } );

	    $('#removeRow').click( function () {
			 	$('#e'+(table.row('.selected').data())[0]).remove();
				$('#v'+(table.row('.selected').data())[0]).remove();
	        table.row('.selected').remove().draw( false );
	    });
		 tabla = $('#tabPreguntas').DataTable( {
	 		"language": {
	 			  "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
	 		 },
	 		 "scrollY": "305px",
	 		 "paging": false,
	 		 "searching": false,
			 "info" : false
	 	} );
	 	$('a.toggle-vis').on( 'click', function (e) {
	 		 e.preventDefault();
	 		 // Get the column API object
	 		 var column = tabla.column( $(this).attr('data-column') );
	 		 // Toggle the visibility
	 		 column.visible( ! column.visible() );
	 	});
	 	var cont = 1;
	 	$('#addRowE').on( 'click', function () {
			if( $('#enunciado').val() != ''){
				tabla.row.add( [
	 	 			cont,
	 	 			$('#enunciado').val(),

	 	 	  ]).draw( false );
	 		  $('#oculta').append('<input type="hidden" id="p' + cont + '" name="p' + cont + '" value="' + $('#enunciado').val() + '"/>'); //add input box
	 	 	  cont++;
	 		  $('#enunciado').val("");
			}else{
				document.getElementById('divErrorEnunciados').style.display = 'block';
			}
	 	});

	 	$('#tabPreguntas tbody').on( 'click', 'tr', function () {
	 		 if ( $(this).hasClass('selected') ) {
	 			  $(this).removeClass('selected');
	 		 }
	 		 else {
	 			  tabla.$('tr.selected').removeClass('selected');
	 			  $(this).addClass('selected');
	 		 }
	 	});

	 	$('#removeRowE').click( function () {
			$('#p'+(tabla.row('.selected').data())[0]).remove();
	 		 tabla.row('.selected').remove().draw( false );
	 	} );
		//datos_alternativas.length > 1 && datos_enunciados.length > 0

});
$('form').on('submit', function(event){
	if(tabla.rows().data().length > 0 && table.rows().data().length > 1){
		return;
	}else{
		event.preventDefault();
		document.getElementById('divErrorSubmit').style.display = 'block';
	}
});
</script>
@endsection
