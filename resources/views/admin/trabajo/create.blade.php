@extends('template')
@section('contenido')
{!! Form::open(['url'=>'admin/trabajo', 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-md-12">
		<div class="caja">
	      <div class="caja-header">
	         <div class="caja-icon">	<i class="fa fa-address-card" style="font-size: 1em;"></i></div>
	         <div class="caja-title">Datos Específicos del Trabajo
				</div>
	      </div>
	      <div class="caja-body">
				@if ($op == 1)
					<h4><b>Añadir un trabajo al egresado: </b> <b style="color:#4B367C">  &nbsp; &nbsp; {{ $egresado->nombre.' '.$egresado->apellidoPaterno.' '.$egresado->apellidoMaterno }}</b>&nbsp; &nbsp;</h4>
				@endif
				<div  class="row">
					<div class="col-lg-6 col-sm-6 col-xs-13">
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
					@if ($op == 2)<!-- no viene desde egresado -->
						<div class="col-sm-6">
							<div class="form-group">
								<label for="idEgresado">Egresado </label><span class="ast">*</span>
								<select required name="idEgresado" id="idEgresado" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true">
							      <option value="" selected> Seleccione un egresado</option>
									@if ( $egresados != null)
										@foreach ($egresados as $e)
											<option data-subtext="{{ $e->codigo }}" value="{{ $e->idEgresado }}">{{ $e->nombre }} {{ $e->apellidoPaterno }} {{ $e->apellidoMaterno }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
					@else
						<input type="hidden" name="idEgresado"  value ="{{$idEgresado}}" >
					@endif
					<input type="hidden" name="op"  value ="{{$op}}" >
					<div class="col-md-6">
						<div class="form-group">
							<label for="institucion">Institución </label><span class="ast">*</span>
							<input type="text"  minlength="3" name="institucion" required class="form-control" value ="{{old('institucion')}}" placeholder="Institución">
						</div>
						<div class="form-group">
							<label for="lugar">Lugar </label><span class="ast">*</span>
							<input type="text"  minlength="3" name="lugar" required class="form-control" value ="{{old('lugar')}}" placeholder="Lugar">
						</div>
						<div class="form-group">
							<label for="fechaInicio" id="lblFechaInicio">Fecha de Inicio </label><span class="ast">*</span>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="fechaInicio" required class="form-control" required placeholder="{{ date("d/m/Y") }}" id="fechaInicio">
							</div>
						</div>
						<div class="form-group">
							<label for="fechaFin" id="lblFechaFin">Fecha de Fin </label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="fechaFin" class="form-control" placeholder="{{ date("d/m/Y") }}" id="fechaFin">
							</div>
						</div>
						<div class="form-group">
							<label for="nivelSatisfaccion">Nivel de Satisfacción  </label><span class="ast">*</span>
							<select required name="nivelSatisfaccion" class="form-control" >
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="recomendaciones">Recomendaciones</label>
							<textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas recomendaciones que pueda dar sobre su trabajo"></textarea>
			 				<p id="contadorRecomendaciones">0/500</p>
						</div>
						<div class="form-group">
							<label for="observaciones">Observaciones</label>
							<textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas observaciones que pueda dar sobre su trabajo"></textarea>
			 				<p id="contadorObservaciones">0/500</p>
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
