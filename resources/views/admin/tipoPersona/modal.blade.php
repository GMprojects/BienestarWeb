<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$tipoPersona->idTipoPersona}}">
	{{Form::Open(array('action'=>array('TipoPersonaController@destroy',$tipoPersona->idTipoPersona),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar tipos de persona</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea ELIMINAR el tipo persona "{{$tipoPersona->tipo}}"</p>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-ff"><i class="fa fa-check"></i>Confirmar</button>
				<button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>
