<div class="modal fade modal-slide-in-right" aria-hidden = "true" role = "dialog" tabindex = "-1" id="modal-delete-{{ $tipoActividad->idTipoActividad }}">
	{{ Form::open( array('action'=>array('TipoActividadController@destroy', $tipoActividad), 'method'=>'delete')) }}

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
					<h4 class="modal-title"><b>Eliminar Categoría de Actividad </b></h4>
				</div>
				<div class="modal-body">
					@if (in_array($tipoActividad->idTipoActividad, $idTiposActividad))
						@php($sePuedeEliminar = false)
						<h5><b> Categoría {{ $tipoActividad->tipo }} </b></h5>
						@if ($tipoActividad->idTipoActividad < 11 )
							<p style="color:red">Esta es una categoría por defecto, no puede ser eliminada.</p>
						@else
							<p style="color:red">Existen Actividades que pertenecen a esta categoría.</p>
						@endif
					@else
						@php($sePuedeEliminar = true)
						<p>Confirme si desea ELIMINAR la Categoría <b>{{ $tipoActividad->tipo }} .</b></p>
					@endif
				</div>
				<div class="modal-footer">
					@if ($tipoActividad->idTipoActividad < 11 && $sePuedeEliminar)
						<button type="submit" class="btn btn-ff"><i class="fa fa-check"></i>Confirmar</button>
					@endif
					<button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
				</div>
			</div>
		</div>
	{{ Form::close() }}
</div>
