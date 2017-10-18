@extends('layouts.admin', ['titulo' => 'Ejecutar Actividad', 'nombreTabla' => '', 'item' => 'actiTodas'])
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
{!! Form::model($actividad, ['method'=>'PATCH', 'route'=>['actividad.update', $actividad->idActividad], 'files'=>'true']) !!}
{{ Form::token() }}
<div class="row">
		 <div class="col-md-12">
					<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">Detalles de la Actividad {{ $actividad->idActividad }}  &nbsp; &nbsp; &nbsp; &nbsp;
										@if ($actividad->modalidad == '1')
												<td><small class="label pull-right bg-aqua">Individual</small></td>
										@else
												<td><small class="label pull-right bg-purple">Grupal</small></td>
										@endif
									</h3>
								</div>
								<div class="box-body">
										<div class="row">
											<div class="col-md-6">
														<div class="form-group">
															<label for="titulo">Título de la actividad *</label>
															<input type="text" name="titulo" class="form-control" value ="{{$actividad->titulo}}" >
														</div>
												    <div class="form-group">
															<label for="anioSemestre">Año *</label>
															<input type="number" min="{{ date('Y') }}" id="anioSemestre" name="anioSemestre" class="form-control" value ="{{ $actividad->anioSemestre }}">
														</div>
														<div class="form-group">
															<label for="numeroSemestre">Ciclo *</label>
															<select name="numeroSemestre" id="numeroSemestre" class="form-control">
		                              <option value="">Seleccione el ciclo...</option>
		                              @if ($actividad->numeroSemestre == '1')
		                                  <option value="1" selected>I</option>
		                                  <option value="2">II</option>
		                              @else
		                                  <option value="1">I</option>
		                                  <option value="2" selected>II</option>
		                              @endif
												      </select>
														</div>
														<div class="form-group">
															<label for="fechaProgramacion">Fecha de Programación *</label>
															<div class="input-group date">
															  <div class="input-group-addon">
																<i class="fa fa-calendar"></i>
															  </div>
															  <input type="text" name="fechaProgramacion" class="form-control pull-right" value="{{ date("d/m/Y",strtotime($actividad->fechaProgramacion)) }}" id="datepicker1">
														  </div>
														</div>
														<div class="bootstrap-timepicker">
															<div class="form-group">
																<label for="horaProgramacion">Hora de Programación *</label>
																<div class="input-group">
																	<div class="input-group-addon">
																	  <i class="fa fa-clock-o"></i>
																	</div>
																	<input type="text" name="horaProgramacion" class="form-control timepicker">
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="lugar">Lugar *</label>
															<div class="input-group">
															  <div class="input-group-addon">
																<i class="fa fa-location-arrow"></i>
															  </div>
															  <input type="text" name="lugar" class="form-control" value="{{ $actividad->lugar }}">
															</div>
														</div>
														<div class="form-group">
															<label for="referencia">Referencia</label>
															<div class="input-group">
															  <div class="input-group-addon">
																<i class="fa fa-map-signs"></i>
															  </div>
															  <input type="text" name="referencia" class="form-control" value="{{ $actividad->referencia }}" placeholder="Aula 202 - Segundo Piso Bienestar Universitario">
															</div>
														</div>
											</div>
											<div class="col-md-6">
														<div class="form-group">
										  					<label for="rutaImagen">Imagen</label>
																@if ($actividad->rutaImagen != null)
																	<!--<img src="{/{ '../../../storage/'.$actividad->rutaImagen }}" data-default-file="{/{ asset('images/avatar3.png') }}"  width="440px" class="img-responsive">-->
																	<input type="file" name="rutaImagen" class="form-control dropify"data-default-file="{{ asset('storage/'.$actividad->rutaImagen) }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
																@else
																	<!--<img src="{/{ '../../../storage/'.$actividad->tipoActividad['rutaImagen'] }}" data-default-file="{/{ asset('images/avatar3.png') }}"  width="440px" class="img-responsive">-->
																	<input type="file" name="rutaImagen" class="form-control dropify"data-default-file="{{ asset('storage/'.$actividad->tipoActividad['rutaImagen']) }}"  data-allowed-file-extensions="png jpg jpge" data-disable-remove="true">
																@endif
												    </div>
														<div class="form-group">
														  <label for="titulo">Descripción *</label>
															<textarea id="descripcion" name="descripcion"  class="form-control" required rows="6" cols="30"  placeholder="Describir una breve reseña de Evento">{{ $actividad->descripcion }}</textarea>
													  </div>
													  <div class="form-group">
														  <label for="titulo">Información Adicional </label>
															<textarea id="informacionAdicional" name="informacionAdicional"  class="form-control" rows="6" cols="30" placeholder="Añadir información Adicional">{{ $actividad->informacionAdicional }}</textarea>
													  </div>
														<div class="form-group">
															<input type="checkbox" id="envioCorreos" name="envioCorreos" class="minimal"><b>Enviar correos a todos los inscritos</b>&nbsp; &nbsp;
															<span>
																<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
																		<i class="fa fa-question"></i>
								              	</button>
															</span>
													  </div>
														<div class="modal fade" id="modal-default">
										          <div class="modal-dialog">
										            <div class="modal-content">
										              <div class="modal-header">
										                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										                  <span aria-hidden="true">&times;</span></button>
										                <h4 class="modal-title"><b>Ayuda</b></h4>
										              </div>
										              <div class="modal-body">
										                <p>Seleccione esta opción si desea comunicar a todos los inscritos de esta actividad los cambios realizados.</p>
										              </div>
										              <div class="modal-footer">
										                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
										              </div>
										            </div>
										            <!-- /.modal-content -->
										          </div>
										          <!-- /.modal-dialog -->
										        </div>
										        <!-- /.modal -->
											</div>
									</div>
						 </div>
					 </div>
 		 </div>
		 <div class="col-md-12">
						<div class="box box-success" id="boxDatosEspecificos" style='display:none;'>
								 <div class="box-header with-border">
									 		<h3 class="box-title"> Datos Específicos</h3>
								 </div>
 							   <div class="box-body">
									 <div class="col-md-6">

									 </div>
									 <div class="col-md-6">
											 <div class="form-group" style='display:none;'id="fechasConvocatoria">
													<label for="fechasConvocatoria">Rango de la Convocatoria *</label>
													<div class="input-group">
														<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
														</div>
														@if ($actividad->actividadMovilidad != null)
														 <input type="text" name="fechasConvocatoria" class="form-control pull-right" value="{{date("d/m/Y",strtotime($actividad->actividadMovilidad['fechaInicioConvocatoria'])).' - '.date("d/m/Y",strtotime($actividad->actividadMovilidad['fechaFinConvocatoria']))}}" id="daterangepicker">
														@else
															<input type="text" name="fechasConvocatoria" class="form-control pull-right" value="" id="daterangepicker">
														@endif
													</div>
											</div>
											 <div class="form-group" style='display:none;' id="fechaInicioConvocatoria">
													 <label for="fechaInicioConvocatoria">Fecha de Inicio Convocatoria *</label>
													 <div class="input-group date">
														 <div class="input-group-addon">
														 <i class="fa fa-calendar"></i>
														 </div>
														 @if ($actividad->actividadComedor != null)
															<input type="text" name="fechaInicioConvocatoria" class="form-control pull-right" value="{{ date("d/m/Y",strtotime($actividad->actividadComedor['fechaConvocatoria'])) }}" id="datepicker2">
														 @else
															 <input type="text" name="fechaInicioConvocatoria" class="form-control pull-right" value="" id="datepicker2">
														 @endif
													 </div>
											 </div>
									  </div>
								 </div>
						</div>
						<div class="box box-success" id="boxResponsableInvitado" style='display:none;'>
								 <div class="box-header with-border" ondblclick="ocultarNuevoResponsable()">
											<h3 class="box-title"> Responsable Invitado</h3>
											<div class="box-tools pull-right">
												<button type="button" class="btn btn-box-tool" onclick="ocultarNuevoResponsable()" onc>
													<i class="fa fa-times"></i>
												</button>
											</div>
								 </div>
								 <div class="box-body">
									 <div class="col-md-6">
											 <div class="form-group">
												 <label for="nombreResponsable">Nombres</label>
												 <input type="text" id="nombreResponsable" name="nombreResponsable" class="form-control" value ="{{ $actividad->nombreResponsable }}">
											 </div>
											 <div class="form-group">
												 <label for="apellidosResponsable">Apellidos</label>
												 <input type="text" id="apellidosResponsable" name="apellidosResponsable" class="form-control" value ="{{ $actividad->apellidosResponsable }}">
											 </div>
											 <div class="form-group">
												 <label for="emailResponsable">Correo</label>
												 <input type="email" id="emailResponsable" name="emailResponsable" class="form-control" value ="{{ $actividad->emailResponsable }}">
											 </div>
									 </div>
								 </div>
						</div>
						<div>
							<button class="btn btn-primary" type="submit"> Guardar</button>
							<button class="btn btn-danger" type="reset"> Cancelar</button>
						</div>
		</div>
</div>
{!! Form::close() !!}

<script type="text/javascript">
			$('.timepicker').timepicker({
				showInputs: false
			})
			$('#datepicker1').datepicker({
				autoclose: true,
				todayHighlight: true,
				startDate :  '-3d',
				format: 'dd/mm/yyyy'
			})
			$('#datepicker2').datepicker({
				autoclose: true,
				todayHighlight: true,
				startDate :  '-3d',
				format: 'dd/mm/yyyy'
			})
			$('#datepicker3').datepicker({
				autoclose: true,
				todayHighlight: true,
				startDate :  '-3d',
				format: 'dd/mm/yyyy'
			})
</script>

<style type="text/css">

</style>

@endsection
