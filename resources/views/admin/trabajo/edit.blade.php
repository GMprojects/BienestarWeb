@extends('template')
@section('contenido')
{!! Form::model($trabajo, ['method'=>'PATCH', 'route'=>['trabajo.update', $trabajo->idTrabajo]]) !!}
{{ Form::token() }}
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
	         <div class="caja-icon">	<i class="fa fa-briefcase"></i></div>
	         <div class="caja-title">Editar datos específicos del trabajo
				</div>
	      </div>
	      <div class="caja-body">
				<label><i class="fa fa-graduation-cap"></i><b>Egresado: </b></label> <b style="color:#4B367C">  &nbsp; &nbsp; {{ $trabajo->egresado->nombre.' '.$trabajo->egresado->apellidoPaterno.' '.$trabajo->egresado->apellidoMaterno }}</b>&nbsp; &nbsp;
				<br><br>
				{{ Form::hidden('op', $op) }}
				<div  class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
						@if (count($errors) >0)
						<div class="alert alert-danger">
							<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
							</ul>
						</div>
						@endif
					</div>
				</div>
				<div class="form-horizontal">
					<p style="color:red;"> <span class="ast">*</span> Requerido	</p>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="institucion">Institución </label><span class="ast">*</span>
							<input type="text" minlength="3" name="institucion" required class="form-control" value ="{{ $trabajo->institucion }}" placeholder="Institución">
						</div>
						<div class="form-group">
							<label for="lugar">Lugar </label><span class="ast">*</span>
							<input type="text" minlength="3" name="lugar" required class="form-control" value ="{{ $trabajo->lugar }}" placeholder="Lugar">
						</div>
						<div class="form-group">
							<label for="fechaInicio" id="lblFechaInicio">Fecha de Inicio </label><span class="ast">*</span>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="fechaInicio" required class="form-control" required  value="{{ date("d/m/Y",strtotime($trabajo->fechaInicio)) }}" id="fechaInicio">
							</div>
						</div>
						<div class="form-group">
							<label for="fechaFin" id="lblFechaFin">Fecha de Fin  </label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								@if ($trabajo->fechaFin != null)
									<input type="text" name="fechaInicio" required class="form-control" required  value="{{ date("d/m/Y",strtotime($trabajo->fechaFin)) }}" id="fechaFin">
								@else
									<input type="text" name="fechaFin" class="form-control"  placeholder="{{ date("d/m/Y") }}" id="fechaFin">
								@endif
							</div>
						</div>
						<div class="form-group">
							<label for="nivelSatisfaccion">Nivel de Satisfacción  </label><span class="ast">*</span>
							<select required name="nivelSatisfaccion" class="form-control" >
								@switch($trabajo->nivelSatisfaccion)
									@case(1)
									<option value="1" selected>Muy Satisfactorio</option>
									<option value="2">Satisfactorio</option>
									<option value="3">Poco Satisfactorio</option>
									<option value="4">Mejorable</option>
									<option value="5">Insatisfactorio</option>
									@break
									@case(2)
									<option value="1">Muy Satisfactorio</option>
									<option value="2" selected>Satisfactorio</option>
									<option value="3">Poco Satisfactorio</option>
									<option value="4">Mejorable</option>
									<option value="5">Insatisfactorio</option>
									@break
									@case(3)
									<option value="1">Muy Satisfactorio</option>
									<option value="2">Satisfactorio</option>
									<option value="3" selected>Poco Satisfactorio</option>
									<option value="4">Mejorable</option>
									<option value="5">Insatisfactorio</option>
									@break
									@case(4)
									<option value="1">Muy Satisfactorio</option>
									<option value="2">Satisfactorio</option>
									<option value="3">Poco Satisfactorio</option>
									<option value="4" selected>Mejorable</option>
									<option value="5">Insatisfactorio</option>
									@break
									@case(5)
									<option value="1">Muy Satisfactorio</option>
									<option value="2">Satisfactorio</option>
									<option value="3">Poco Satisfactorio</option>
									<option value="4">Mejorable</option>
									<option value="5" selected>Insatisfactorio</option>
									@break
								@endswitch
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="recomendaciones">Recomendaciones</label>
							<textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas recomendaciones que pueda dar sobre su trabajo">{{ $trabajo->recomendaciones }}</textarea>
			 			</div>
						<div class="form-group">
							<label for="observaciones">Observaciones</label>
							<textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas observaciones que pueda dar sobre su trabajo">{{ $trabajo->observaciones }}</textarea>
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
{!! Form::close() !!}
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
	$('textarea#observaciones').maxlength({
					alwaysShow: true
	});
	$('textarea#recomendaciones').maxlength({
					alwaysShow: true
	});
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
