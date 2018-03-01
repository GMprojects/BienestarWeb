<div class="caja">
	{!! Form::open(['route'=>['actividad.updateExecute', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
	{{Form::token()}}
	<div class="caja-header">
		<div class="caja-icon">2</div>
		<div class="caja-title">Ejecución de la Actividad</div>
	</div>
	<div class="caja-body">
		@if ($actividad->estado == 2)
			<div class="row">
				<div class="col-md-12">
					<a href="{{ action('ActividadController@verEstadisticaActividad', ['id'=>$actividad->idActividad]) }}"><i class="fa fa-eye"></i>  Ver datos de la actividad ejecutada
					</a>
				</div>
			</div>
			<br>
		@endif
		<!--<p style="color:red;"> <span class="ast">*</span> Requerido-->
		<div class="row">
			<div class="col-md-4">
			   <div class="form-group">
				   <label for="fechaEjecutada">Fecha de Ejecutada <span class="ast">*</span></label>
				   <div class="input-group date">
					  <div class="input-group-addon">
					   <i class="fa fa-calendar"></i>
					  </div>
					  @if ($actividad->fechaEjecutada == null)
						  @if (old('fechaEjecutada') == null)
							  <input type="text" required name="fechaEjecutada"  placeholder="{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}" class="form-control pull-right"  id="fechaEjecutada" >
						  @else
							  <input type="text" required name="fechaEjecutada"  value="{{old('fechaEjecutada')}}" class="form-control pull-right"  id="fechaEjecutada" >
						  @endif
					  @else
						  <input type="text" required name="fechaEjecutada"  value="{{ date("d/m/Y",strtotime($actividad->fechaEjecutada)) }}" class="form-control pull-right"  id="fechaEjecutada" >
					  @endif
				  </div>
			   </div>
			</div>
			<div class="col-md-4">
			   <div class="bootstrap-timepicker">
				   <div class="form-group">
					   <label for="horaEjecutada">Hora de Ejecutada <span class="ast">*</span></label>
					   <div class="input-group">
						   <div class="input-group-addon">
							  <i class="fa fa-clock-o"></i>
						   </div>
							  @if ($actividad->horaEjecutada == null)
								  @if (old('horaEjecutada') == null)
									  <input type="text" required name="horaEjecutada"  value="{{ date('g:i A',strtotime($actividad->horaInicio)) }}" class="form-control timepicker">
								  @else
									  <input type="text" required name="horaEjecutada"  value="{{old('horaEjecutada')}}" class="form-control timepicker">
								  @endif
							  @else
								  <input type="text" required name="horaEjecutada"  value="{{ date("g:i A",strtotime($actividad->horaEjecutada)) }}" class="form-control timepicker">
							  @endif
					   </div>
				   </div>
			   </div>
			</div>
		</div>
	</div>
	<div class="caja-footer">
		<div class="pull-right">
			<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
			<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
		</div>
	</div>
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
										<a href="{{ action('BeneficiarioController@editBeneficiario',[$actividad->idActividad,  $beneficiario->pivot->idBeneficiarioComedor ]) }}"><button class="btn btn-ff-yellow"><i class="fa fa-edit"></i> </button></a>
										<a href="" data-target = "#modal-deletebc-{{ $beneficiario->pivot->idBeneficiarioComedor }}" data-toggle = "modal"><button class="btn btn-ff-red"> <i class="fa fa-trash"></i> </button></a>
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
