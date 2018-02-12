@extends('template')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			 @if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
    </div>
  </div>

	<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="caja">
				<div class="caja-header">
					<div class="caja-icon">1</div>
					<div class="caja-title">Detalles Tutorado</div>
				</div>
				<div class="caja-body">
					<div class="row">
			            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			               <strong>
			                  &nbsp; &nbsp; <i class="fa fa-qrcode margin-r-5"></i>&nbsp; &nbsp;Código de Tutorado:
			               </strong>
			               <p>
			                   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ $tutorado->codigo }}
			               </p>
			               <strong>
			                  &nbsp; &nbsp; <i class="fa fa-user margin-r-5"></i>&nbsp; &nbsp;Tutorado:
			               </strong>
			               <p>
			                   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}
			               </p>
			            </div>
				 	</div>
				</div>
				<div class="caja-footer">
					<a href="http://aplicaciones.unitru.edu.pe/index.php"><button type="button" class="btn btn-ff-blues" name="button">Historial Académico</button></a>
					{{--<a href="#"><button type="button" class="btn btn-ff-blues" name="button">Información General</button></a>--}}
		{{--			@if ($tutorado->habitoEstudioRespondido == '1')
						<a href="{{ action('HabitoEstudioController@show',['$idTutorTutorado' => $tutorTutorado->idTutorTutorado ])}}"><button type="button" class="btn btn-ff-blues" name="button">&nbsp; Hábito de Estudio</button></a>
					@endif--}}
					<a href="#"><button type="button" class="btn btn-ff-blues" name="button">&nbsp; Hábito de Estudio</button></a>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="caja">
				{!! Form::open(['route'=>['actPedagogia.update', $actPedagogia->idActPedagogia], 'method'=>'POST', 'autocomplete'=>'off']) !!}
				{{ Form::token() }}
				<div class="caja-header">
					<div class="caja-icon">2</div>
					<div class="caja-title">Sesión de Tutoría - Canalización</div>
				</div>
				<div class="caja-body">
					   <div class="form-group">
						  <label for="canalizacion">Canalización</label>
						  <div class="row">
									@if ($actPedagogia->canalizacion == null)
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<input type="radio" id="rIndividual" required name="canalizacion" value="1" > &nbsp;Médico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="2" > &nbsp;Psicológico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="3" checked> &nbsp;Ninguno</option>
										 </div>
									@elseif ($actPedagogia->canalizacion == '1')
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<input type="radio" id="rIndividual" required name="canalizacion" value="1" checked> &nbsp;Médico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="2" > &nbsp;Psicológico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="3" > &nbsp;Ninguno</option>
										 </div>
									@elseif ($actPedagogia->canalizacion == '2')
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<input type="radio" id="rIndividual" required name="canalizacion" value="1" > &nbsp;Médico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="2" checked> &nbsp;Psicológico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="3" > &nbsp;Ninguno</option>
										 </div>
									@else
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<input type="radio" id="rIndividual" required name="canalizacion" value="1" > &nbsp;Médico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="2" > &nbsp;Psicológico</option>
										 </div>
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												 <input type="radio" id="rGrupal" required name="canalizacion" value="3" checked> &nbsp;Ninguno</option>
										 </div>
									@endif
						  </div>
					 	</div>
				</div>
				<div class="caja-footer">
					<div class="pull-right">
						 <button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
	 					 <button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
					 </div>
				</div>
				{!! Form::Close() !!}
			</div>
		</div>
	</div>

	<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="caja">
				<div class="caja-header">
					<div class="caja-icon">3</div>
					<div class="caja-title">
						Sesión de Tutoría - Motivo
						<button type="button" name="button" data-target="#modal-motivo" data-toggle="modal" class="btn btn-ff-green pull-right" style="margin-top:4px;">
							<i class="fa fa-plus "></i>Nuevo Motivo
						 </button>
					</div>
					<div class="caja-title"></div>
				</div>
				<div class="caja-body">
					 <div class="table">
						 <div class="table-responsive">
								 <table id="tabActividades" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
									 <thead>
											 <th>Motivo</th>
											 <th>Situación Específica</th>
											 <th>Recomendación</th>
											 <th>Opciones</th>
									 </thead>
									 <tbody>
										@foreach ($actPedagogia->detallesPedagogia as $detallePedagogia)
											<tr>
												<td>{{ $detallePedagogia->motivo }}</td>
												<td>{{ $detallePedagogia->situacionEspecifica }}</td>
												<td>{{ $detallePedagogia->recomendacion }}</td>
												<td>
													<a href="" data-target = "#modal-edit-{{ $detallePedagogia->idDetallePedagogia }}" data-toggle = "modal"><button class="btn btn-ff-yellow" data-toggle="tooltip" data-placement="bottom" title="Editar Motivo"><i class="fa fa-edit"></i></button></a>
													<a href="" data-target = "#modal-delete-{{ $detallePedagogia->idDetallePedagogia }}" data-toggle = "modal"><button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Motivo"><i class="fa fa-trash"></i></button></a>
												</td>
											</tr>
	  									 	@include('programador.actividad.actTutoria.modalDeleteMotivo')
											@include('programador.actividad.actTutoria.modalEditMotivo')
										@endforeach
									 </tbody>
									 @include('programador.actividad.actTutoria.modalMotivo')
								 </table>
						 </div>
					 </div>
				</div>
				<div class="caja-footer">

				</div>
			</div>
		</div>
	</div>



<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$(document).ready(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
				increaseArea: '20%' // optional
			});
			$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
		});
</script>

<style type="text/css">
	textarea{
		resize: none;
	}
</style>

@endsection
