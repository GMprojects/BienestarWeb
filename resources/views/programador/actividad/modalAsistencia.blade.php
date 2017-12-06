<!-- /.modal -->
<div class="modal fade modal-slide-in-right" id="modal-asistencia">
   {!! Form::open(['route'=>['actividad.registrarAsistencias', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
	<!-- /.modal-dialog -->
	<div class="modal-dialog">
		<!-- /.modal-content -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
				<h4 class="modal-title"><b>Registrar asistencia</b></h4>
			</div>
			<div class="modal-body">
				<div class="table">
					<div class="table-responsive">
						<table id="tabAsistentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
							<th>Código</th>
							<th>Inscrito</th>
							<th>Asistencia  &nbsp; &nbsp; <input type="checkbox" id="checkTodos"/></th>
							</thead>
							<tbody>
								@php($i=0)
	                     @foreach($inscripciones as $inscripcion)
	                       <tr>
	                           @php($i++)
	                           <td> {{ $inscripcion->codigo }} </td>
	                           <td> {{ $inscripcion->nombre }}  {{ $inscripcion->apellidoPaterno }}  {{ $inscripcion->apellidoMaterno }} </td>
	                           <td>
                                 @if ($inscripcion->asistencia == 0)
                                    <input id="check" type="checkbox" value={{ $inscripcion->idInscripcionADA.'-'.$inscripcion->idTipoPersona }} name="asistencia[]">
                                 @else
                                    <input id="check" type="checkbox" checked value={{ $inscripcion->idInscripcionADA.'-'.$inscripcion->idTipoPersona }} name="asistencia[]">
                                 @endif
	                           </td>
	                       </tr>
	                     @endforeach
							</tobody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
            <button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
				<button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
   {{!! Form::Close() !!}}
</div>
<!-- /.modal -->
