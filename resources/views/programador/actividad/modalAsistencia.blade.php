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
            <div class="row">
               <div class="col-md-12">
                  <div class="pull-left"></div>
                  <div class="pull-right">
                     <p>Seleccionar todos los inscritos <input type="checkbox"  class="icheckbox_square-green" id="checkTodos"> </p>
                  </div>
               </div>
            </div>
				<div class="table">
					<div class="table-responsive">
						<table id="tabAsistentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
   							<th>Código</th>
   							<th>Inscrito</th>
   							<th>Asistencia</th>
							</thead>
							<tbody>
	                     @foreach($inscripciones as $inscripcion)
	                       <tr>
	                           <td> {{ $inscripcion->codigo }} </td>
	                           <td> {{ preg_split("/[ ]/",$inscripcion->nombre)[0] }}  {{ $inscripcion->apellidoPaterno }}  {{ $inscripcion->apellidoMaterno }} </td>
	                           <td>
                                 @if ($inscripcion->asistencia == 0)
                                    <input id="check" type="checkbox"  class="icheckbox_square-green" value={{ $inscripcion->idInscripcionADA.'-'.$inscripcion->idTipoPersona }} name="asistencia[]">
                                 @else
                                    <input id="check" type="checkbox" class="icheckbox_square-green" checked value={{ $inscripcion->idInscripcionADA.'-'.$inscripcion->idTipoPersona }} name="asistencia[]">
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
            <div class="pull-left">
					<button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
				</div>
				<div class="pull-right">
					<button class="btn btn-ff-red" type="reset" onclick="limpiar()"><i class="fa fa-eraser"></i> Limpiar</button>
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
   {{!! Form::Close() !!}}
</div>
<!-- /.modal -->
