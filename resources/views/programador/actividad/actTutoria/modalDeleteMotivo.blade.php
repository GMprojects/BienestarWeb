
<div class="modal fade modal-slide-in-right" aria-hidden = "true" role = "dialog" tabindex = "-1" id="modal-delete-{{ $detallePedagogia->idDetallePedagogia }}">
	{{Form::Open(['action'=>['DetallePedagogiaController@destroy',$detallePedagogia->idDetallePedagogia],'method'=>'delete'])}}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
						<h4 class="modal-title"><b>Eliminar Motivo</b></h4>
				</div>
				<div class="modal-body">
					<p>Confirme si desea ELIMINAR el MOTIVO: </p>
					<ul>
						<li><b>Motivo</b></li>
						<p>{{ $detallePedagogia->motivo }}</p>
						<li><b>Situación Específica</b></li>
						<p>{{ $detallePedagogia->situacionEspecifica }}</p>
						<li><b>Recomendación</b></li>
						<p>{{ $detallePedagogia->recomendacion }}</p>
					</ul>
				</div>
				<div class="modal-footer">
	            <div class="pull-left">
	               <button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
	      		</div>
	      		<div class="pull-right">
	      			<button class="btn btn-ff-red" type="submit"><i class="fa fa-check"></i> Confirmar</button>
	      		</div>
				</div>
			</div>
		</div>
	{{ Form::close() }}
</div>
