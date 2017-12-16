@extends('template')
@section('contenido')
{!! Form::model($trabajo, ['method'=>'PATCH', 'route'=>['trabajo.update', $trabajo->idTrabajo]]) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-md-12">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-briefcase" style="font-size: 1em;"></i></div>
	         <div class="caja-title">Datos Específicos del Trabajo
				</div>
	      </div>
	      <div class="caja-body">
				{{ $op }}
				<h4><b>Editar trabajo del egresado: </b> <b style="color:#4B367C">  &nbsp; &nbsp; {{ $trabajo->egresado->nombre.' '.$trabajo->egresado->apellidoPaterno.' '.$trabajo->egresado->apellidoMaterno }}</b>&nbsp; &nbsp;</h4>
				{{ Form::hidden('invisible', $op) }}
				<div  class="row">
					<div class="col-lg-6 col-sm-6 col-xs-12">
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
							<input type="text" minlength="3" name="lugar" required class="form-control" value ="{{ $trabajo->institucion }}" placeholder="Lugar">
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
									<input type="text" name="fechaInicio" required class="form-control" required  value="{{ date("d/m/Y",strtotime($trabajo->fechaFin)) }}" id="fechaInicio">
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
									<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									@break
									@case(2)
									<option value="1">1</option>
									<option value="2" selected>2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									@break
									@case(3)
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3" selected>3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									@break
									@case(4)
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4" selected>4</option>
									<option value="5">5</option>
									@break
									@case(5)
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5" selected>5</option>
									@break
								@endswitch
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="recomendaciones">Recomendaciones</label>
							<textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas recomendaciones que pueda dar sobre su trabajo">{{ $trabajo->recomendaciones }}</textarea>
			 				<p id="contadorRecomendaciones">0/500</p>
						</div>
						<div class="form-group">
							<label for="observaciones">Observaciones</label>
							<textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas observaciones que pueda dar sobre su trabajo">{{ $trabajo->observaciones }}</textarea>
			 				<p id="contadorRecomendaciones">0/500</p>
						</div>
					</div>
				</div>
			</div>
			<div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
				</div>
	      </div>
	   </div>
	</div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
	$('#fechaInicio').datepicker({
		autoclose: true,
		todayHighlight: true,
		format: 'dd/mm/yyyy'
	});
	$('#fechaFin').datepicker({
		autoclose: true,
		todayHighlight: true,
		format: 'dd/mm/yyyy'
	});
	$(document).ready(function() {
			 init_contador('#observaciones', '#contadorObservaciones');
			 init_contador('#recomendaciones', '#contadorRecomendaciones');
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
