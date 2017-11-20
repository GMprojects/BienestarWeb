<div class="caja">
	{!! Form::open(['route'=>['actividad.updateExecute', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
	{{Form::token()}}
	<div class="caja-header">
		<div class="caja-icon">2</div>
		<div class="caja-title">Ejecución de la Actividad</div>
	</div>
	<div class="caja-body">
      @if ($actividad->fechaEjecutada == null)
         <div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="fechaEjecutada">Fecha de Ejecutada:</label>
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
							<label for="horaEjecutada">Hora de Ejecutada:</label>
							<div class="input-group">
								<div class="input-group-addon">
								  <i class="fa fa-clock-o"></i>
								</div>
								<input type="text" name="horaEjecutada"  class="form-control timepicker" value="{{ date("h:i A",strtotime($actividad->horaInicio)) }}" required>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="bootstrap-timepicker">
						<div class="form-group">
							<label for="formaTutoria">Forma de Tutoría:</label>
							<div class="input-group">
								<select name="formaTutoria" id="formaTutoria" required class="form-control">
										<option value="">Seleccione la Forma de Tutoría</option>
										<option value="1">Presencial</option>
										<option value="2">Telefónica</option>
										<option value="3">Correo Electrónico</option>
								</select>
							</div>
						</div>
					</div>
				</div>
	 		</div>
      @else
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="form-group">
                  <label><b>Fecha de Ejecución: </b> </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividad->fechaEjecutada)) }} &nbsp;- &nbsp;{{ date("h:i A",strtotime($actividad->horaEjecutada)) }}<br>
               </div>
               <div class="form-group">
                  @if ($actividad->actividadesPedagogia[0] != null)
                        <label><b>Forma Tutoría: </b> </label> &nbsp; &nbsp;
                        @switch($actividad->actividadesPedagogia[0]->formaTutoria)
                           @case('1')Presencial
                           @break
                           @case('2')Telefónica
                           @break
                           @case('3')Correo Electrónico
                           @break
                        @endswitch
                  @endif
               </div>
            </div>
         </div>
      @endif
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div class="form-group">
   			  <label for="titulo">Observaciones: </label>
   			  @if ($actividad->observaciones != 'Ninguna')
   				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" placeholder="Añadir algunas observaciones de la Actividad realizada">{{ $actividad->observaciones }}</textarea>
   			  @else
   				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" placeholder="Añadir algunas observaciones de la Actividad realizada"></textarea>
   			  @endif
   		  </div>
   		  <div class="form-group">
   			  <label for="titulo">Recomendaciones: </label>
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
			<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
			<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
		</div>
   </div>
	{!!Form::close()!!}
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
               <th>Opciones</th>
               </thead>
               <tbody>
                  @php($i=0)
                  @if($inscripciones != null)
                     @foreach($inscripciones as $inscripcionADA)
                       <tr>
                           @php($i++)
                           <td> {{ $inscripcionADA->codigo }} </td>
                           <td> {{ $inscripcionADA->nombre }}  {{ $inscripcionADA->apellidoPaterno }}  {{ $inscripcionADA->apellidoMaterno }} </td>
                           <td>
                              <a href="{{ action('ActPedagogiaController@create',[$actividad->idActividad,  $inscripcionADA->idInscripcionADA]) }}"><button class="btn btn-ff-blues"> <i class="fa fa-eye"></i> Ver Detalles</button></a>
                           </td>
                       </tr>
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
