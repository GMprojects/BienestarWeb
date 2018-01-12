@extends('template')
@section ('contenido')
	{!! Form::model($semestre, ['method'=>'PATCH', 'route'=>['semestre.update', $semestre->idSemestre]]) !!}
	{{ Form::token() }}
	<div class="row">
		<div class="col-md-12">
			<div class="caja">
				<div class="caja-header">
			      <div class="caja-icon">1</div>
			      <div class="caja-title">Editar Semestre {{ $semestre->semestre }} </div>
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
									<input type="text" name="fechaInicio" required value="{{ date("d/m/Y",strtotime($semestre->fechaInicio )) }}" class="form-control"  id="fechaInicio" >
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
									<input type="text" name="fechaFin" required value="{{ date("d/m/Y",strtotime($semestre->fechaFin )) }}" class="form-control"  id="fechaFin" >
								</div>
							</div>
						</div>
					</div>
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
			$('#fechaFin').data("DateTimePicker").minDate(e.date);
		});
		$('#fechaFin').on("dp.change", function(e){
			$('#fechaInicio').data("DateTimePicker").maxDate(e.date);
		});
	</script>
	<style type="text/css">
		.ast{
			color: red;
			font-size: 20px;
		}
	</style>
	@endsection
