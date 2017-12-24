@extends('template')
@section ('contenido')
<div class="caja">
	<div class="caja-header">
		<div class="caja-icon">1</div>
		<div class="caja-title">Beneficiario</div>
	</div>
	<div class="caja-body">
      <div id="divNoHayAlumno" class="alert alert-danger" style='display:none;'>
				<p>Debe elegir a un alumno para que sea un beneficiario</p>
		</div>
     	<div class="row">
   			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
   					 <label for="codigo">Código</label>
   					 <input type="text" id="codigo" name="codigo" required class="form-control" disabled>
   				</div>
   				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
   					 <label for="nombreApellidos">Apellidos y Nombres</label>
   					 <input type="text" id="nombreApellidos"name="nombreApellidos" required class="form-control" disabled>
   				</div>
   				 	 <button type="button" class="btn btn-ff-blues" style="margin-top: 24px;"data-toggle="modal" data-target="#modal-default"> <i class="fa fa-search"></i> Buscar</button>
   			</div>
   	</div><br>
  </div>
</div>

{!! Form::open(['route'=>['beneficiario.store', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off', 'onsubmit'=>'return validar()']) !!}
{{ Form::token() }}
{{ Form::hidden('idAlumno', '-',['id' => 'idAlumno']) }}
<div class="caja">
	<div class="caja-header">
		<div class="caja-icon">2</div>
		<div class="caja-title">Detalles de Beneficiario</div>
	</div>
	<div class="caja-body">
		<p style="color:red;"> <span class="ast">*</span> Requerido
		<div class="row">
      	@if ($tipoActividad == '8') <!-- movilidada -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
                  <label for="fechaInicio">Fecha de Inicio </label><span class="ast">*</span>
                  <div class="input-group date">
                    <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                    </div>
						  @if (old('fechaInicio') == null)
							  <input type="text" required name="fechaInicio"  placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaInicio" >
						  @else
							  <input type="text" required name="fechaInicio"  value="{{old('fechaInicio')}}" class="form-control"  id="fechaInicio" >
						  @endif
                    {{--<input type="text" name="fechaInicio" class="form-control" required   placeholder="{{ date("d/m/Y") }}" id="fechaInicio">--}}
                 </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
                  <label for="fechaFin">Fecha de Fin </label><span class="ast">*</span>
						<div class="input-group date">
                    <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                    </div>
						  @if (old('fechaFin') == null)
							  <input type="text" required name="fechaFin"  placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaFin" >
						  @else
							  <input type="text" required name="fechaFin"  value="{{old('fechaFin')}}" class="form-control"  id="fechaFin" >
						  @endif
                    {{--<input type="text" name="fechaFin" class="form-control pull-right" required   placeholder="{{ date("d/m/Y") }}" id="fechaFin">--}}
                 </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
                        <label for="duracionMeses">N° Meses </label><span class="ast">*</span>
                        <input type="number" id="duracionMeses"  min="0" name="duracionMeses" class="form-control" value ="{{old('duracionMeses')}}"required  placeholder="0">
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
                        <label for="duracionAnio">N° Años </label><span class="ast">*</span>
                        <input type="number" id="duracionAnio" min="0" name="duracionAnio" class="form-control" value ="{{old('duracionAnio')}}" required placeholder="0">
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
                  <label for="institucion">Intitución </label><span class="ast">*</span>
                  <input type="text" name="institucion" class="form-control"  required value ="{{old('institucion')}}" placeholder="Institución">
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
                  <label for="pais">País </label><span class="ast">*</span>
                  <input type="text" name="pais" class="form-control"  required value ="{{old('pais')}}" placeholder="País">
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
                  <label for="observaciones">Observaciones </label>
                  <textarea name="observaciones" id="observaciones" class="form-control" value ="{{old('observaciones')}}"  rows="6" cols="30" placeholder="Describir observaciones... "></textarea>
						<p id="contadorObservaciones">0/500</p>
              </div>
           </div>
      	@else<!-- comedor -->
	         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            <div class="form-group">
	               <label for="fechaBeneficio">Fecha de Beneficio </label><span class="ast">*</span>
	               <div class="input-group date">
	                 <div class="input-group-addon">
	                  <i class="fa fa-calendar"></i>
	                 </div>
						  @if (old('fechaBeneficio') == null)
							  <input type="text" required name="fechaBeneficio"  placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaBeneficio" >
						  @else
							  <input type="text" required name="fechaBeneficio"  value="{{old('fechaBeneficio')}}" class="form-control"  id="fechaBeneficio" >
						  @endif
	                 {{--<input type="text" name="fechaBeneficio" class="form-control pull-right" required  placeholder="{{ date("d/m/Y",strtotime(old('fechaBeneficio'))) }}" id="fechaBeneficio">--}}
	              </div>
	            </div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            <div class="form-group">
	               <label for="tipoBeneficio">Tipo Beneficio </label><span class="ast">*</span>
	               <select name="tipoBeneficio" id="tipoBeneficio"  required class="form-control">
	                     <option value="">Seleccione Tipo de Actividad</option>
	                     <option value="1">Beca</option>
	                     <option value="2">Media Beca</option>
	                     <option value="3">Especial</option>
	                     <option value="4">Otro</option>
	               </select>
	            </div>
	         </div>
      	@endif
	 	</div>
	</div>
	<div class="caja-footer">
		<div class="pull-right">
			<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
			<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
		</div>
	</div>
</div>
{!! Form::Close() !!}
<!-- MODALES -->
<!-- /.modal -->
<div class="modal fade" id="modal-default">
	 <!-- /.modal-dialog -->
	<div class="modal-dialog">
		 <!-- /.modal-content -->
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" ><i class="fa fa-remove"></i></span></button>
					<h4 class="modal-title"><b>Seleccionar al Alumno</b></h4>
				</div>
				<div class="modal-body">
					<div class="table">
							<div class="table-responsive">
								<table id="tabAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<th>Código</th>
										<th>Apellidos y Nombres</th>
										<th>Opciones</th>
									 </thead>
	 								 <tbody>
                               @foreach ($alumnos as $alumno)
                                  <tr>
                                     <td>{{ $alumno->codigo }}</td>
                                     <td>{{ $alumno->apellidoPaterno }} {{ $alumno->apellidoMaterno }} {{ $alumno->nombre }}</td>
                                     <td><input type="radio" name="alumno" value="{{ $alumno->idAlumno.'_'.$alumno->codigo.'_'.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre }}"></td>
                               @endforeach
	 								 </tobody>
	 							 </table>
							</div>
					 </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-ff" onclick="agregar()" data-dismiss="modal"> <i class="fa fa-save"></i> Grabar</button>
               <button type="button" class="btn btn-ff-default pull-right"  data-dismiss="modal"> <i class="fa fa-remove"></i>Cerrar</button>
				</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
			increaseArea: '20%' // optional
		});
		$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
	});
	$('#fechaBeneficio').datetimepicker({
		format: 'DD/MM/YYYY',
	});
	$('#fechaInicio').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	$('#fechaFin').datetimepicker({
		format: 'DD/MM/YYYY',
		useCurrent: false // Important! See issue #1075
	});
	$('#fechaInicio').on("dp.change", function(e){
		$('#fechaFin').data("DateTimePicker").minDate(e.date);
	});
	$('#fechaFin').on("dp.change", function(e){
		$('#fechaInicio').data("DateTimePicker").maxDate(e.date);
	});
	$(document).ready(function() {
		 init_contador('#observaciones', '#contadorObservaciones');
		 init_contador('#recomendaciones', '#contadorRecomendaciones');
		 $('#tabAlumnos').DataTable({
				"lengthMenu": [ 10, 25, 50, 75, 100 ],
				"oLanguage" : {
					 "sProcessing":     "Procesando...",
					 "sLengthMenu":     "Mostrar _MENU_ registros",
					 "sZeroRecords":    "No se encontraron resultados",
					 "sEmptyTable":     "Ningún dato disponible en esta tabla",
					 "sInfo":           "Reg. actuales: _START_ - _END_ / Reg. totales: _TOTAL_",
					 "sInfoEmpty":      "Reg. actuales: 0 - 0 / Reg. totales: 0",
					 "sInfoFiltered":   "(filtrado de un total _MAX_ registros)",
					 "sInfoPostFix":    "",
					 "sSearch":         "Buscar:",
					 "sUrl":            "",
					 "sInfoThousands":  ",",
					 "sLoadingRecords": "Cargando...",
					 "oPaginate": {
						 "sFirst":    "Primero",
						 "sLast":     "Último",
						 "sNext":     "Sig",
						 "sPrevious": "Ant"
					 },
					 "oAria": {
						 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
					 }
				},
				"order": [[ 1, 'asc' ]]
		 });
			//FalumnosLibres
	});

	function init_contador(idTextArea, idContador){
		function update_Contador(idTextArea, idContador){
			var contador = $(idContador);
			var ta = $(idTextArea);
			contador.html(ta.val().length+'/500');
		}
		$(idTextArea).keyup(function(){
			update_Contador(idTextArea, idContador);
		});
		$(idTextArea).change(function(){
			update_Contador(idTextArea, idContador);
		});
	}

	function agregar(){
		document.getElementById('divNoHayAlumno').style.display = 'none';
	  $('input[type=radio]').each(function(){
	       if (this.checked) {
	         var str = this.value;
	         var res = str.split("_");
						$('#idAlumno').val(res[0]);
						$('#codigo').val(res[1]);
						$('#nombreApellidos').val(res[2]);
	       }
	   });
	}
	function validar(){
		var existeUnSeleccionado = false;
		console.log('On Validate');
		if ($('#codigo').val() == '') {
			document.getElementById('divNoHayAlumno').style.display = 'block';
			return false;
		}

	}

	$("#duracionMeses").focus(function(){
		var fInicio = $('#fechaInicio').val();
		var fFin = $('#fechaFin').val();

		spliFI = fInicio.split("/");
		spliFF = fFin.split("/");

		var dFI = moment(spliFI[2]+'-'+spliFI[1]+'-'+spliFI[0]);
		var dFF = moment(spliFF[2]+'-'+spliFF[1]+'-'+spliFF[0]);

		$('#duracionMeses').val(dFF.diff(dFI,'months'));
		$('#duracionAnio').val(dFF.diff(dFI,'years'));
	});
	$("#duracionAnio").focus(function(){
		var fInicio = $('#fechaInicio').val();
		var fFin = $('#fechaFin').val();

		spliFI = fInicio.split("/");
		spliFF = fFin.split("/");

		var dFI = moment(spliFI[2]+'-'+spliFI[1]+'-'+spliFI[0]);
		var dFF = moment(spliFF[2]+'-'+spliFF[1]+'-'+spliFF[0]);

		$('#duracionMeses').val(dFF.diff(dFI,'months'));
		$('#duracionAnio').val(dFF.diff(dFI,'years'));
	});
	function restarFechas(componente){
	  var valor = componente.value;
	  console.log(valor);
	  if(valor.length > 2){
	    console.log(valor);
	    document.getElementById('ejecutar').click();
	  }
	}
</script>

<style type="text/css">
	textarea{
		resize: none;
	}
	.ast{
		color: red;
		font-size: 20px;
	}
</style>
@endsection
