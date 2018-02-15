<!-- /.modal -->
<div class="modal fade modal-slide-in-right" id="modal-evidencia">
   {!! Form::open(['action'=>['EvidenciaActividadController@store'], 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true', 'onsubmit'=>'return validar()']) !!}
	<!-- /.modal-dialog -->
	<div class="modal-dialog">
		<!-- /.modal-content -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
             <h4 class="modal-title"><b>Añadir nueva Evidencia</b></h4>
			</div>
			<div class="modal-body">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  {{ Form::hidden('idActividad',$actividad->idActividad) }}
                  <div class="form-group">
                     <label for="nombre">Nombre</label>
                     <input type="text" name="nombre" required class="form-control" value ="{{old('nombre')}}" placeholder="Nombre...">
                  </div>
                  <div class="form-group">
                     <label for="ruta">Archivo y/o Imagen</label>
                     <input type="file" required name="rutaImagen" class="form-control dropify" data-height="200" data-allowed-file-extensions="png jpg jpge" data-max-file-size="4M" data-errors-position="outside" data-show-remove="false">
                  </div>
               </div>
            </div>
			</div>
			<div class="modal-footer">
            <div class="pull-left">
					<button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
				</div>
				<div class="pull-right">
					<!--<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>-->
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->

	{{!! Form::Close() !!}}
</div>
<!-- /.modal -->
