@extends('template')
@section ('contenido')
<div class="caja">
	<div class="caja-header">
		<div class="caja-icon">1</div>
		<div class="caja-title">Beneficiario</div>
	</div>
	<div class="caja-body">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label><i class="fa fa-qrcode margin-r-5"></i>&nbsp; &nbsp;Código:  </label> &nbsp; &nbsp; {{ $alumno->user->codigo }} <br>
					<label><i class="fa fa-calendar margin-r-5"></i>&nbsp; &nbsp;Beneficiario:  </label> &nbsp; &nbsp; {{ $alumno->user->nombre.' '.$alumno->user->apellidoPaterno.' '.$alumno->user->apellidoMaterno }}
            </div>
	 	</div>
	</div>
</div>

<div class="caja">
	<div class="caja-header">
		<div class="caja-icon">2</div>
		<div class="caja-title">Detalles del Beneficio</div>
	</div>
	<div class="caja-body">
		<p style="color:red;"> <span class="ast">*</span> Requerido
		@if ($idTipoActividad == '8')
			{!! Form::open(['route'=>['beneficiario.update', 'idActividad' => $idActividad, 'idBeneficiario' => $beneficiario->idBeneficiarioMovilidad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
			{{ Form::token() }}
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="fechaInicio">Fecha de Inicio </label><span class="ast">*</span>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					  <input type="text" name="fechaInicio" class="form-control pull-right" required value="{{ date("d/m/Y",strtotime($beneficiario->fechaInicio)) }}"  placeholder="{{ date("d/m/Y") }}" id="fechaInicio">
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
					  <input type="text" name="fechaFin" class="form-control pull-right" required value="{{ date("d/m/Y",strtotime($beneficiario->fechaFin)) }}"  placeholder="{{ date("d/m/Y") }}" id="fechaFin">
				  </div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
							<label for="duracionMeses">N° Meses </label><span class="ast">*</span>
							<input type="number" id="duracionMeses"  min="0" name="duracionMeses" class="form-control" value ="{{ $beneficiario->duracionMeses }}"required  placeholder="0">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
							<label for="duracionAnio">N° Años </label><span class="ast">*</span>
							<input type="number" id="duracionAnio" min="0" name="duracionAnio" class="form-control" value ="{{ $beneficiario->duracionAnio }}" required placeholder="0">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="institucion">Intitución </label><span class="ast">*</span>
					<input type="text" name="institucion" class="form-control"  required value ="{{ $beneficiario->institucion }}" placeholder="Institución">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="pais">País </label><span class="ast">*</span>
					<input type="text" name="pais" class="form-control"  required value ="{{ $beneficiario->pais }}" placeholder="País">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="observaciones">Observaciones </label>
					<textarea name="observaciones" id="observaciones" class="form-control" rows="6" cols="30" placeholder="Describir observaciones... ">{{ $beneficiario->observaciones }}</textarea>
			  </div>
		  </div>

		@else
			{!! Form::open(['route'=>['beneficiario.update', 'idActividad' => $idActividad, 'idBeneficiario' => $beneficiario->idBeneficiarioComedor], 'method'=>'POST', 'autocomplete'=>'off']) !!}
			{{ Form::token() }}
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="fechaBeneficio">Fecha de Beneficio </label><span class="ast">*</span>
					<div class="input-group date">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					  <input type="text" name="fechaBeneficio" class="form-control pull-right" required value="{{ date("d/m/Y",strtotime($beneficiario->fechaBeneficio)) }}" id="fechaBeneficio">
				  </div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="tipoBeneficio">Tipo Beneficio </label><span class="ast">*</span>
					<select name="tipoBeneficio" id="tipoBeneficio"  required class="form-control">
							<option value="">Seleccione Tipo de Actividad</option>
							@switch($beneficiario->tipoBeneficio)
								@case(1)<!-- Beca -->
									<option value="1" selected>Beca</option>
									<option value="2">Media Beca</option>
									<option value="3">Especial</option>
									<option value="4">Otro</option>
								@break
								@case(2)<!-- Media Beca -->
									<option value="1">Beca</option>
									<option value="2" selected>Media Beca</option>
									<option value="3">Especial</option>
									<option value="4">Otro</option>
								@break
								@case(3)<!-- Especial -->
									<option value="1">Beca</option>
									<option value="2">Media Beca</option>
									<option value="3" selected>Especial</option>
									<option value="4">Otro</option>
								@break
								@case(4)<!-- Otros -->
									<option value="1">Beca</option>
									<option value="2">Media Beca</option>
									<option value="3">Especial</option>
									<option value="4" selected>Otro</option>
								@break
							@endswitch
						</select>
				</div>
			</div>
		@endif
	</div><br><br><br>
	<div class="caja-footer">
		<div class="pull-left">
			<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> Volver</button>
		</div>
		<div class="pull-right">
			<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
			<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
		</div>
	</div>
</div>
{!! Form::Close() !!}

<script type="text/javascript">
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
	$('textarea#observaciones').maxlength({
					alwaysShow: true
	});
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
