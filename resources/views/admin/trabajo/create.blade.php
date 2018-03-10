@extends('template')
@section('contenido')
{!! Form::open(['url'=>'admin/trabajo', 'method'=>'POST', 'autocomplete'=>'off']) !!}
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
	         <div class="caja-title">Datos Específicos del Trabajo
				</div>
	      </div>
	      <div class="caja-body">
				@if ($op == 1)
					<label><i class="fa fa-graduation-cap"></i><b>Egresado: </b></label> <b style="color:#4B367C">  &nbsp; &nbsp; {{ $egresado->nombre.' '.$egresado->apellidoPaterno.' '.$egresado->apellidoMaterno }}</b>&nbsp; &nbsp;
					<br><br>
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

				<div class="row">
					<div class="col-sm-12">
						<div class="form-horizontal">
							<p style="color:red;"> <span class="ast">*</span> Requerido	</p>
						</div>
						<div id="error" class="alert alert-danger" style='display:none;'>
							<p>No existen Egresados registrados</p>
						</div>
					</div>
					<div class="col-sm-6">
						@if ($op == 2)<!-- no viene desde egresado -->
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
						@else
							<input type="hidden" name="idEgresado"  value ="{{$idEgresado}}" >
						@endif
						<input type="hidden" name="op"  value ="{{$op}}" >
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
								@if (old('fechaInicio') == null)
									<input type="text" name="fechaInicio" required placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaInicio" >
								@else
									<input type="text" name="fechaInicio" required value="{{old('fechaInicio')}}" class="form-control"  id="fechaInicio" >
								@endif
							</div>
						</div>
						<div class="form-group">
							<label for="fechaFin" id="lblFechaFin">Fecha de Fin </label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								@if (old('fechaFin') == null)
									<input type="text" name="fechaFin" placeholder="{{date("d/m/Y")}}" class="form-control"  id="fechaFin" >
								@else
									<input type="text" name="fechaFin" value="{{old('fechaFin')}}" class="form-control"  id="fechaFin" >
								@endif
							</div>
						</div>
						<div class="form-group">
							<label for="nivelSatisfaccion">Nivel de Satisfacción  </label><span class="ast">*</span>
							<select required name="nivelSatisfaccion" class="form-control" >
								<option value="1">Muy Satisfactorio</option>
								<option value="2">Satisfactorio</option>
								<option value="3">Poco Satisfactorio</option>
								<option value="4">Mejorable</option>
								<option value="5">Insatisfactorio</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="recomendaciones">Recomendaciones</label>
							<textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas recomendaciones que pueda dar sobre su trabajo"></textarea>
						</div>
						<div class="form-group">
							<label for="observaciones">Observaciones</label>
							<textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas observaciones que pueda dar sobre su trabajo"></textarea>
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
	/*function validar(){
		if (({/{$egresados}}).length == 0) {
			document.getElementById('error').style.display = 'block';
		}
	}****/

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
