<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$semestre->idSemestre}}">
	{{Form::Open(['action'=>['SemestreController@destroy',$semestre->idSemestre],'method'=>'delete'])}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
				<h4 class="modal-title"><b>Eliminar Semestre</b></h4>
			</div>
			<div class="modal-body">
				@if ($numSemestres == 1 )
					<p style="color:red">No se puede eliminar. Como minimo debe existir un semestre registrado. </p>
				@else
					<p>Confirme si desea ELIMINAR el semestre {{ $semestre->semestre }}</p>
				@endif
			</div>
			<div class="modal-footer">
				 @if ($numSemestres > 1 )
					 <button type="submit" class="btn btn-ff"><i class="fa fa-check"></i>Confirmar</button>
				 @endif
				<button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>
