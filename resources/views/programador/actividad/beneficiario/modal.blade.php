<!--    MODALES   -->
@if ($actividad->idTipoActividad == 8)<!-- movilidad -->
   <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-deletebm-{{ $beneficiario->pivot->idBeneficiarioMovilidad }}">
   	{{Form::Open(['action'=>['BeneficiarioController@destroyBeneficiario', $actividad->idActividad,  $beneficiario->pivot->idBeneficiarioMovilidad],'method'=>'delete'])}}

   	<div class="modal-dialog">
   		<div class="modal-content">
   			<div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-remove"></i></span></button>
                <h4 class="modal-title"><b>Eliminar beneficiario</b></h4>
   			</div>
   			<div class="modal-body">
   				<p>Confirme si desea ELIMINAR beneficiario </p>
   			</div>
   			<div class="modal-footer">
               <button type="submit" class="btn btn-ff"><i class="fa fa-check"></i> Confirmar</button>
   				<button type="button" class="btn btn-ff-default pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
   			</div>
   		</div>
   	</div>
   	{{Form::Close()}}
   </div>

@else<!-- comedor -->
   <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-deletebc-{{ $beneficiario->pivot->idBeneficiarioComedor }}">
   	{{Form::Open(['action'=>['BeneficiarioController@destroyBeneficiario', $actividad->idActividad,  $beneficiario->pivot->idBeneficiarioComedor],'method'=>'delete'])}}

   	<div class="modal-dialog">
   		<div class="modal-content">
   			<div class="modal-header">
   				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-remove"></i></span>
                </button>
                <h4 class="modal-title"><b>Eliminar beneficiario</b></h4>
   			</div>
   			<div class="modal-body">
   				<p>Confirme si desea ELIMINAR beneficiario </p>
   			</div>
   			<div class="modal-footer">
               <button type="submit" class="btn btn-ff"><i class="fa fa-check"></i> Confirmar</button>
   				<button type="button" class="btn btn-ff-default  pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
   			</div>
   		</div>
   	</div>
   	{{Form::Close()}}

   </div>

@endif
