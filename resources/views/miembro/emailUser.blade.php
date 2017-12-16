<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-email{{ $op }}-{{ Auth::user()->id }}-{{ $actividad->responsable->id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" class="fa fa-remove"></span>
                </button>
                <h4 class="modal-title">Mensaje para
                   @if ($op == 1)
                      Programador
                   @else
                      Responsable
                   @endif
                </h4>
			</div>

			<div class="modal-body">
				<div class="row">
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="subject">Asunto</label>
	                    <input id="subject" type="text" name="subject" class="form-control" value="Asunto">
	                    <div class="help-block with-errors"></div>
	                </div>
	            </div>
	        </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <label for="mensaje">Mensaje </label>
                       <textarea id="mensaje" name="mensaje" required class="form-control" style="resize: none;" rows="4" >Se le pide por favor que llenen la encuesta de hábito de estudio, la cual es muy necesaria para las próximas sesiones de tutoría.</textarea>
                       <div class="help-block with-errors"></div>
                   </div>
               </div>
            </div>
			</div>

			<div class="modal-footer">
            <button type="button" onclick="enviar({{ $tutorado->idAlumno }})" class="btn btn-ff" data-dismiss="modal"> <i class="fa fa-send"></i> Enviar Correo </button>
				<button type="button" class="btn btn-ff-default" data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
			</div>
		</div>
	</div>
</div>
