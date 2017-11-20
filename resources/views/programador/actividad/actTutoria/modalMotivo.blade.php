<!-- /.modal -->
<div class="modal fade modal-slide-in-right" id="modal-motivo">
   {!! Form::open(['route'=>['detallePedagogia.store', $actPedagogia->idActPedagogia], 'method'=>'POST', 'autocomplete'=>'off']) !!}
	{{ Form::token() }}
	<!-- /.modal-dialog -->
	<div class="modal-dialog">
		<!-- /.modal-content -->
		<div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="fa fa-remove"></i></span>
             </button>
             <h4 class="modal-title"><b> <i class="fa fa-comment-o"></i>Nuevo Motivo</b></h4>
         </div>
			<div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="motivo">Motivo</label>
							<textarea name="motivo"  class="form-control" required value ="{{old('motivo')}}"  rows="4" cols="30" placeholder="Describir el motivo"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="situacionEspecifica">Situación Específica</label>
							<textarea name="situacionEspecifica"  class="form-control" required value ="{{old('situacionEspecifica')}}"  rows="4" cols="30" placeholder="Describir una Situación Específica"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="recomendacion">Recomendación </label>
						  <textarea name="recomendacion"  class="form-control" required value ="{{old('recomendacion')}}"  rows="4" cols="30" placeholder="Describir una Recomendación"></textarea>
                  </div>
               </div>
            </div>
			</div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-ff"><i class="fa fa-check"></i> Confirmar</button>
            <button type="button" class="btn btn-ff-default pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
         </div>
      </dissv>
   </div>
   {{Form::Close()}}
</div>
<!-- /.modal -->
