<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-newEncuesta">
	{!! Form::open(['action'=>['EncuestaController@store'], 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true']) !!}
	{{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
				<h4 class="modal-title"><b>Crear Nueva Ecuesta</b></h4>
			</div>
			<div class="modal-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label for="titulo">Título</label>
						<input type="text" name="titulo"  required value ="{{old('titulo')}}" class="form-control" placeholder="Título">
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 <div class="form-group">
						<label for="idTipoActividad">Tipo de Actividad</label>
						<select name="idTipoActividad" class="form-control">
							@foreach($tiposActividad as $tipo)
								<option value="{{$tipo->idTipoActividad}}">{{$tipo->tipo}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 <div class="form-group">
						<label for="destino">Dirigido A</label>
						<select name="destino" class="form-control">
								<option value="r">Responsable</option>
								<option value="i">Inscrito</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-ff"><i class="fa fa-check"></i>Confirmar</button>
				<button type="button" class="btn btn-ff-default"  data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>
