<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$tutorado->idTutorTutorado}}">
	{{Form::Open(['action'=>['TutorTutoradoController@destroy',$tutorado->idTutorTutorado],'method'=>'delete'])}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" class="fa fa-remove"></span>
                </button>
                <h4 class="modal-title">Eliminar Tutor - Tutorado</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea <strong>ELIMINAR</strong> de la lista de tutorados del docente
               <strong> {{ $tutor->nombre.' '.$tutor->apellidoPaterno.' '.$tutor->apellidoMaterno }} </strong> al tutorado <strong> {{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}</strong></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>
