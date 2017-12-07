<div class="caja">
	{!! Form::open(['route'=>['actividad.updateExecute', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
	{{Form::token()}}
	<div class="caja-header">
		<div class="caja-icon">2</div>
		<div class="caja-title">Ejecución de la Actividad</div>
	</div>
	<div class="caja-body">
		<div class="row">
			@if ($actividad->fechaEjecutada == null)
				<p style="color:red;"> <span class="ast">*</span> Requerido
				<div class="col-md-4">
					<div class="form-group">
						<label for="fechaEjecutada">Fecha de Ejecutada:</label><span class="ast">*</span>
						<div class="input-group date">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" name="fechaEjecutada" class="form-control pull-right" required  value="{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}" id="datepicker1">
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="bootstrap-timepicker">
						<div class="form-group">
							<label for="horaEjecutada">Hora de Ejecutada:</label><span class="ast">*</span>
							<div class="input-group">
								<div class="input-group-addon">
								  <i class="fa fa-clock-o"></i>
								</div>
									<input type="text" name="horaEjecutada"  class="form-control timepicker" value="{{ date("h:i A",strtotime($actividad->horaEjecutada)) }}" required>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="form-group">
					<label><b>Fecha de Convocatoria: </b> </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}<br>
				</div>
				<div class="form-group">
					<label><b>Fecha de Ejecución: </b> </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividad->fechaEjecutada)) }} &nbsp;- &nbsp;{{ date("h:i A",strtotime($actividad->horaEjecutada)) }}<br>
				</div>
			@endif
		</div>
	</div>
	@if ($actividad->fechaEjecutada == null)
		<p style="color:red;"> <span class="ast">*</span> Requerido
		<div class="caja-footer">
			<div class="pull-right">
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
			</div>
		</div>
	@endif
	{!!Form::close()!!}
</div>

<div class="caja">
	<div class="caja-header">
		<div class="caja-icon">3</div>
		<div class="caja-title">
			Beneficiarios
			<a href="{{ action('BeneficiarioController@createBeneficiario',[$actividad->idActividad]) }}"><button type="button" name="button" class="btn btn-ff-green pull-right" style="margin-top:4px;"><i class="fa fa-plus "></i> Nuevo Beneficiario </button></a>
		</div>
	</div>
	<div class="caja-body">
      <div class="table">
         <div class="table-responsive">
            <table id="tabBeneficiarios" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" width="100%">
               <thead>
               <th>Código</th>
               <th>Beneficiario</th>
               <th>Opciones</th>
               </thead>
               <tbody>
						@if (count($actividad->beneficiariosComedor) != 0)
							@foreach ($actividad->beneficiariosComedor as $beneficiario)
								<tr>
									<td>{{ $beneficiario->user->codigo }}</td>
									<td>{{ $beneficiario->user->nombre.' '.$beneficiario->user->apellidoPaterno.' '.$beneficiario->user->apellidoMaterno }}</td>
									<td>
										<a href="{{ action('BeneficiarioController@editBeneficiario',[$actividad->idActividad,  $beneficiario->pivot->idBeneficiarioComedor ]) }}"><button class="btn btn-ff-blues"><i class="fa fa-eye"></i> </button></a>
										<a href="" data-target = "#modal-deletebc-{{ $beneficiario->pivot->idBeneficiarioComedor }}" data-toggle = "modal"><button class="btn btn-ff-red"> <i class="fa fa-remove"></i> </button></a>
									</td>
								</tr>
								@include('programador.actividad.beneficiario.modal')
							@endforeach
						@endif
               </tobody>
            </table>
         </div>
      </div>
	</div>
</div>
