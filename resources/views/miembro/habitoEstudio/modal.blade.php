<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$preguntaHabito->idPreguntaHabito}}">
	{{Form::Open(['action'=>['PreguntaHabitoController@destroy',$preguntaHabito->idPreguntaHabito],'method'=>'delete'])}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Preguntas de la Encuesta de Hábitos de Estudio</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea ELIMINAR la pregunta "{{$preguntaHabito->enunciado}}"</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>
