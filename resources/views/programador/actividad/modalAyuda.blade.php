<div class="modal fade" id="modal-ayuda">
	 <!-- /.modal-dialog -->
	 <div class="modal-dialog">
		   <!-- /.modal-content -->
		   <div class="modal-content">
				  <div class="modal-header" style="background-color:#4C4C4C; color:white; border-radius:4px 4px 0px 0px;">
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
						  <h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp; &nbsp;<b>Ayuda</b></h4>
				  </div>
		        <div class="modal-body">
		          	<p> Las campos a llenar <b>requeridos y no requeridos</b> dependerán de la categoría de actividad elegida. Los campos comunes son los siguientes:
                  </p>
                  <ul>
                     <li>Título de la Actividad</li>
                     <li>Categoría de la Actividad</li>
                     <li>Descripción</li>
                     <li>Información Adicional</li>
                     <li>Fecha de Inicio</li>
                     <li>Hora de Inicio</li>
                     <li>Fecha de Fin</li>
                     <li>Hora de Fin</li>
                     <li>Lugar</li>
                     <li>Referencia</li>
                  </ul>

                  <p>En <b>actividades Individuales</b> deberá seleccionar al alumno para quien se le esta programando la actividad. </p>
                  <p>En <b>actividades Grupales</b> deberá seleccionar la cantidad de cupos totales para la actividad. </p>
                  <p>Si asigna un <b>Responsable Invitado</b> deberá llenar: </p>
                  <ul>
                     <li>Nombres</li>
                     <li>Apellidos</li>
                     <li>Email</li>
                  </ul>
						<p>El <b style="color:red;">tamaño máximo</b> de la imagen debe ser de <b style="color:red;">4MB</b>.</p>
		        </div>
		        <div class="modal-footer">
						  <div class="pull-left">
							  <button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
						  </div>
		        </div>
		   </div>
	      <!-- /.modal-content -->
	 </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-errorTut">
	 <!-- /.modal-dialog -->
	 <div class="modal-dialog">
		   <!-- /.modal-content -->
		   <div class="modal-content">
		        <div class="modal-header" style="background-color:red; color:white; border-radius:4px 4px 0px 0px;">
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true"  class="fa fa-remove"></span></button>
			          <h4 class="modal-title"  style="color:white;"><i class="fa fa-warning"></i>&nbsp; &nbsp;<b>Error</b></h4>
		        </div>
		        <div class="modal-body">
		          	<p> Antes de publicar una actividad de tutoría se deben registrar tutores en el semestre académico.</p>
		        </div>
		        <div class="modal-footer">
						  <div class="pull-right">
							  <button class="btn btn-ff-default" type="button"  onclick="seleccionarCero()" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
						  </div>
		        </div>
		   </div>
	      <!-- /.modal-content -->
	 </div>
    <!-- /.modal-dialog -->
</div>
