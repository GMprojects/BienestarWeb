<div class="caja">
	{!! Form::open(['route'=>['actividad.updateExecute', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
	{{Form::token()}}
	<div class="caja-header">
		<div class="caja-icon">2</div>
		<div class="caja-title">Ejecución de la Actividad</div>
	</div>
	<div class="caja-body">
			@if ($actividad->fechaEjecutada == null)
			
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
                              <a href="{{ action('ActPedagogiaController@create',[$actividad->idActividad,  $inscripcionADA->idInscripcionADA]) }}"><button class="btn btn-warning">Registrar Detalles</button></a>
                           </td>
                       </tr>
                     @endforeach
                  @endif
               </tobody>
            </table>
         </div>
      </div>
	</div>
</div>
