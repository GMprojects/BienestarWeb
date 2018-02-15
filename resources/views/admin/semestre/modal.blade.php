<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$semestre->idSemestre}}">
	{{Form::Open(['action'=>['SemestreController@destroy',$semestre->idSemestre],'method'=>'delete'])}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:red; color:white; border-radius:4px 4px 0px 0px;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
				<h4 class="modal-title"><b style="color:white;">Eliminar Semestre</b></h4>
			</div>
			<div class="modal-body">
				@if ($numSemestres == 1 )
					<p style="color:red">No se puede eliminar. Como minimo debe existir un semestre registrado. </p>
				@else
					<p>Confirme si desea ELIMINAR el semestre {{ $semestre->semestre }}</p>
				@endif
			</div>
			<div class="modal-footer">
				<div class="pull-left">
					<button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
				</div>
				<div class="pull-right">
					@if ($numSemestres > 1 )
  					 <button class="btn btn-ff" type="submit"><i class="fa fa-check"></i>Confirmar</button>
  				 @endif
				</div>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>
