<div class="modal fade modal-slide-in-right" aria-hidden = "true" role = "dialog" tabindex = "-1" id="modal-delete-{{ $tipoActividad->idTipoActividad }}">
	{{ Form::open( array('action'=>array('TipoActividadController@destroy', $tipoActividad), 'method'=>'delete')) }}

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:red; color:white; border-radius:6px 6px 0px 0px;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
					<h4 class="modal-title"><b style="color:white;">Eliminar Categoría</b></h4>
				</div>
				<div class="modal-body">
					<h5><b> Categoría {{ $tipoActividad->tipo }} </b></h5>
					@if ($tipoActividad->idTipoActividad < 11 )
						@php($sePuedeEliminar = false)
						<p style="color:red">Esta es una categoría por defecto, no puede ser eliminada.</p>
					@else
						@if (in_array($tipoActividad->idTipoActividad, $idTiposActividad))
							@php($sePuedeEliminar = false)
							<p style="color:red">Existen Actividades que pertenecen a esta categoría, no puede ser eliminada.</p>
						@else
							@php($sePuedeEliminar = true)
							<p>Confirme si desea ELIMINAR.</b></p>
						@endif
					@endif
				</div>
				<div class="modal-footer">
					<div class="pull-left">
						<button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
					</div>
					<div class="pull-right">
						@if ($sePuedeEliminar)
							<button type="submit" class="btn btn-ff"><i class="fa fa-check"></i>Confirmar</button>
						@endif
					</div>
				</div>
			</div>
		</div>
	{{ Form::close() }}
</div>
