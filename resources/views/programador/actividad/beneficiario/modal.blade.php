<!--    MODALES   -->
@if ($actividad->idTipoActividad == 8)<!-- movilidad -->
   <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-deletebm-{{ $beneficiario->pivot->idBeneficiarioMovilidad }}">
   	{{Form::Open(['action'=>['BeneficiarioController@destroyBeneficiario', $actividad->idActividad,  $beneficiario->pivot->idBeneficiarioMovilidad],'method'=>'delete'])}}

   	<div class="modal-dialog">
   		<div class="modal-content">
   			<div class="modal-header" style="background-color:red; color:white; border-radius:4px 4px 0px 0px;">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-remove"></i></span></button>
                <h4 class="modal-title"><b style="color:white;">Eliminar beneficiario</b></h4>
   			</div>
   			<div class="modal-body">
   				<p>Confirme si desea ELIMINAR beneficiario </p>
   			</div>
   			<div class="modal-footer">
	            <div class="pull-left">
						<button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
					</div>
					<div class="pull-right">
						<button class="btn btn-ff-red" type="submit"><i class="fa fa-check"></i> Confirmar</button>
					</div>
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
	            <div class="pull-left">
						<button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
					</div>
					<div class="pull-right">
						<button class="btn btn-ff" type="submit"><i class="fa fa-check"></i> Confirmar</button>
					</div>
            </div>
   		</div>
   	</div>
   	{{Form::Close()}}

   </div>

@endif
