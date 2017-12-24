@extends('template')
@section ('contenido')
	{!!Form::open(['url'=>'admin/semestre','method'=>'POST','autocomplete'=>'off'])!!}
	{{Form::token()}}
	<div class="row">
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
										<input type="text" name="fechaInicio" required value="{{date("d/m/Y")}}" class="form-control"  id="fechaInicio" >
									@else
										<input type="text" name="fechaInicio" required value="{{old('fechaInicio')}}" class="form-control"  id="fechaInicio" >
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
										<input type="text" name="fechaFin" required value="{{date("d/m/Y")}}" class="form-control"  id="fechaFin" >
									@else
										<input type="text" name="fechaFin" required value="{{old('fechaFin')}}" class="form-control"  id="fechaFin" >
									@endif
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
							  <label for="anioSemestre">Año de Semestre </label><span class="ast">*</span>
							  <input type="number" required id="anioSemestre" min="{{date("Y")}}" max="{{date("Y")}}"name="anioSemestre" class="form-control" value ="{{old('anioSemestre')}}"  required placeholder="{{date("Y")}}">
						  </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
							  <label for="numeroSemestre">Número de Semestre </label><span class="ast">*</span>
							  <select name="numeroSemestre" id="numeroSemestre" required  class="form-control">
									  <option value="1">I</option>
									  <option value="2">II</option>
							  </select>
						  </div>
						</div>
					</div>
				</div>
				<div class="caja-footer">
					<div class="pull-right">
						<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
						<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
						<button class="btn btn-ff-default" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left"></i> Volver</button>
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
	</script>
	<style type="text/css">
		.ast{
			color: red;
			font-size: 20px;
		}
	</style>
	@endsection
