<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$user->id}}">
	{{Form::open(array('action'=>array('UserController@destroy',$user->id),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class=modal-content>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
				<h4 class="modal-title"><b>Eliminar ></b></h4>
			</div>
			<div class="modal-body">
				<p> Confirme si desea Eliminar el USUARIO  con el ID: {{ $user->codigo }} </p>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-ff"><i class="fa fa-check"></i>Confirmar</button>
				<button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
</div>
