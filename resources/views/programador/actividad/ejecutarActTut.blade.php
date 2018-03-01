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
			<div class="col-md-4">
				<div class="form-group">
					<label for="formaTutoria"><b>Forma Tutoría</b> <span class="ast">*</span></label>
					<select name="formaTutoria" id="formaTutoria" required class="form-control">
						@if (count($actividad->actividadesPedagogia)>0)
							@if ($actividad->actividadesPedagogia[0]->formaTutoria != null)
								<option value="">Seleccione la Forma de Tutoría</option>
								@switch($actividad->actividadesPedagogia[0]->formaTutoria)
									@case('1')
											<option value="1" selected>Presencial</option>
											<option value="2">Telefónica</option>
											<option value="3">Correo Electrónico</option>
									@break
									@case('2')
											<option value="1">Presencial</option>
											<option value="2" selected>Telefónica</option>
											<option value="3">Correo Electrónico</option>
									@break
									@case('3')
											<option value="1">Presencial</option>
											<option value="2">Telefónica</option>
											<option value="3" selected>Correo Electrónico</option>
									@break
								@endswitch
							@else
								<option value="">Seleccione la Forma de Tutoría</option>
								<option value="1">Presencial</option>
								<option value="2">Telefónica</option>
								<option value="3">Correo Electrónico</option>
							@endif
						@endif
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="horaEjecutada">Asistencias &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i><span class="ast">*</span></label>
					<div class="input-group">
							<button type="button" name="button" data-target="#modal-asistencia" data-toggle="modal" class="btn btn-ff-orange">Registrar</button>
					</div>
				</div>
			</div>
		</div>
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div class="form-group">
   			  <label for="titulo">Observaciones </label>
   			  @if ($actividad->observaciones != 'Ninguna')
   				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" placeholder="Añadir algunas observaciones de la Actividad realizada">{{ $actividad->observaciones }}</textarea>
   			  @else
   				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" placeholder="Añadir algunas observaciones de la Actividad realizada"></textarea>
   			  @endif
   		  </div>
   		  <div class="form-group">
   			  <label for="titulo">Recomendaciones </label>
   			  @if ($actividad->recomendaciones != 'Ninguna')
   				  <textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" placeholder="Añadir algunas recomendaciones de la Actividad realizada que se pueda tener en cuenta en la siguiente actividad">{{ $actividad->recomendaciones }}</textarea>
   			  @else
   				  <textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" placeholder="Añadir algunas recomendaciones de la Actividad realizada que se pueda tener en cuenta en la siguiente actividad"></textarea>
   			  @endif
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
	 @include('programador.actividad.modalAsistencia')
</div>
<div class="caja">
	<div class="caja-header">
		<div class="caja-icon">3</div>
		<div class="caja-title">Tutorados</div>
	</div>
	<div class="caja-body">
      <div class="table">
			<div class="table-responsive">
				<table id="tabTutorados" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<th>Código</th>
						<th>Inscrito</th>
						<th>Registrar Detalles de la Sesión</th>
					</thead>
					<tbody>
                  @php($i=0)
                  @if($inscripciones != null)
                     @foreach($inscripciones as $inscripcionADA)
							  @if ($inscripcionADA->asistencia == 1)
								  <tr>
   									<td> {{ $inscripcionADA->codigo }} </td>
   									<td> {{ $inscripcionADA->nombre }}  {{ $inscripcionADA->apellidoPaterno }}  {{ $inscripcionADA->apellidoMaterno }} </td>
   									<td>
   										<a href="{{ action('ActPedagogiaController@create',[$actividad->idActividad,  $inscripcionADA->idInscripcionADA]) }}"><button class="btn btn-ff-greenOs"> <i class="fa fa-pencil"></i></button></a>
   									</td>
   							  </tr>
							  @endif
							@endforeach
						@endif
					</tobody>
				</table>
			</div>
      </div>
   </div>
   <div class="caja-footer">
   </div>
</div>
