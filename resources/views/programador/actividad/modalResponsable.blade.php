<!-- /.modal -->
<div class="modal fade" id="modal-default">
	 <!-- /.modal-dialog -->
	<div class="modal-dialog">
		 <!-- /.modal-content -->
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" ><i class="fa fa-remove"></i></span></button>
					<h4 class="modal-title"><i class="fa fa-user"></i>&nbsp; &nbsp;<b>Seleccionar al Alumno</b></h4>
				</div>
				<div class="modal-body">
					<div class="table">
							<div class="table-responsive">
								<table id="tabAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<th>Código</th>
										<th>Apellidos y Nombres</th>
										<th>Opciones</th>
									 </thead>
	 								 <tbody>
                               @foreach ($alumnos as $alumno)
                                  <tr>
                                     <td>{{ $alumno->codigo }}</td>
                                     <td>{{ $alumno->apellidoPaterno }} {{ $alumno->apellidoMaterno }} {{ $alumno->nombre }}</td>
                                     <td><input type="radio" name="alumno" value="{{ $alumno->idAlumno.'_'.$alumno->codigo.'_'.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre }}"></td>
                               @endforeach
	 								 </tobody>
	 							 </table>
							</div>
					 </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-ff" onclick="agregar()" data-dismiss="modal"> <i class="fa fa-save"></i> Grabar</button>
               <button type="button" class="btn btn-ff-default pull-right"  data-dismiss="modal"> <i class="fa fa-remove"></i>Cerrar</button>
				</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
