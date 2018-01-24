@extends('template')
@section ('contenido')
	{!!Form::open(['url'=>'admin/semestre','method'=>'POST','autocomplete'=>'off', 'onsubmit'=>'return validar()'])!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-xs-12">
			<div class="second-bar">
				<div class="pull-left">
					<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Volver</span></button>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="margin-top: 70px;">
		<div class="col-md-12">
			<div class="caja">
				<div class="caja-header">
			      <div class="caja-icon">1</div>
			      <div class="caja-title">Nuevo Semestre</div>
			   </div>

				<div class="caja-body">
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
					<div id="error" class="alert alert-danger" style='display:none;'>
							<p>La <b>Fecha Fin </b> debe ser diferente y mayor a la <b>Fecha Inicio</b>.</p>
					</div>
					<div class="row">
						<p style="color:red;"> <span class="ast">*</span> Requerido
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="fechaInicio">Fecha Inicio </label><span class="ast">*</span>
								<div class="input-group date" >
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									@if (old('fechaInicio') == null)
										<input type="text" name="fechaInicio" required value="{{date("d/m/Y")}}" onclick="ocultarError()" class="form-control"  id="fechaInicio" >
									@else
										<input type="text" name="fechaInicio" required value="{{old('fechaInicio')}}" onclick="ocultarError()" class="form-control"  id="fechaInicio" >
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="fechaFin">Fecha Fin </label><span class="ast">*</span>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									@if (old('fechaFin') == null)
										<input type="text" name="fechaFin" required value="{{date("d/m/Y")}}" onclick="ocultarError()" class="form-control"  id="fechaFin" >
									@else
										<input type="text" name="fechaFin" required value="{{old('fechaFin')}}" onclick="ocultarError()" class="form-control"  id="fechaFin" >
									@endif
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
							  <label for="anioSemestre">Año de Semestre </label><span class="ast">*</span>
							  <input type="number" required id="anioSemestre" min="{{date("Y")}}" max="{{date("Y")}}" onclick="ocultarError()" name="anioSemestre" class="form-control" value ="{{old('anioSemestre')}}"  required placeholder="{{date("Y")}}">
						  </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
							  <label for="numeroSemestre">Número de Semestre </label><span class="ast">*</span>
							  <select name="numeroSemestre" id="numeroSemestre" required onclick="ocultarError()" class="form-control">
									  <option value="1">I</option>
									  <option value="2">II</option>
							  </select>
						  </div>
						</div>
					</div>
				</div><br><br><br>
				<div class="caja-footer">
					<div class="pull-right">
						<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
						<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
					</div>
		      </div>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
	<script type="text/javascript">
		$('#fechaInicio').datetimepicker({
			format: 'DD/MM/YYYY'
		});
		$('#fechaFin').datetimepicker({
			format: 'DD/MM/YYYY',
			useCurrent: false // Important! See issue #1075
		});
		$('#fechaInicio').on("dp.change", function(e){
			var array1 = ($('#fechaInicio').val()).split('/');
			var array2 = ($('#fechaFin').val()).split('/');
			$('#fechaFin').data("DateTimePicker").minDate(e.date);
			$('#anioSemestre').attr("min",array1[2]);
			$('#anioSemestre').attr("max",array2[2]);
		});
		$('#fechaFin').on("dp.change", function(e){
			var array1 = ($('#fechaInicio').val()).split('/');
			var array2 = ($('#fechaFin').val()).split('/');
			$('#fechaInicio').data("DateTimePicker").maxDate(e.date);
			$('#anioSemestre').attr("min",array1[2]);
			$('#anioSemestre').attr("max",array2[2]);
		});

		function ocultarError(){
			document.getElementById('error').style.display = 'none';
		}

		function validar(){
			var array1 = ($('#fechaInicio').val()).split('/');
			var array2 = ($('#fechaFin').val()).split('/');
			if((array1[0] === array2[0]) && (array1[1] === array2[1]) && (array1[2] === array2[2])){
				document.getElementById('error').style.display = 'block';
				return false;
			}else{
				return true;
			}
		}
	</script>
	<style type="text/css">
		.ast{
			color: red;
			font-size: 20px;
		}
	</style>
	@endsection
