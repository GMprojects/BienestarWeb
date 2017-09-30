@extends('layouts.admin', ['titulo' => 'Programar Actividad', 'nombreTabla' => '', 'item' => 'actiTodas'])
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
{!! Form::open(['url'=>'programador/actividad', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true']) !!}
{{ Form::token() }}
				<div class="row">
						 <div class="col-md-6">
									<div class="box box-success">
											  <div class="box-header with-border">
												 		<h3 class="box-title">Datos Generales</h3>
											  </div>
												<div class="box-body">
															<div class="form-group">
																<label for="titulo">Título de la actividad</label>
																<input type="text" name="titulo" class="form-control" value ="{{old('titulo')}}" placeholder="Título">
															</div>

													    <div class="form-group">
													      <label for="idTipoActividad">Categoría</label>
													      <select name="idTipoActividad" id="selectIdTipoActividad" class="form-control">
																	<option value="">Seleccione Tipo de Actividad</option>
													        @foreach($tiposActividad as $tipo)
													          <option value="{{$tipo->idTipoActividad}}">{{$tipo->tipo}}</option>
													        @endforeach
													      </select>
													    </div>

													    <div class="form-group">
																<label for="anioSemestre">Año</label>
																<input type="number" min="{{ date('Y') }}" id="anioSemestre" name="anioSemestre" class="form-control" value ="{{ date('Y') }}" placeholder="{{ date('Y') }}">
															</div>

															<div class="form-group">
																<label for="numeroSemestre">Ciclo</label>
																<select name="numeroSemestre" id="numeroSemestre" class="form-control">
													          <option value="1">I</option>
																		<option value="2">II</option>
													      </select>
															</div>

															<div class="form-group">
																<label for="fechaProgramacion">Fecha de Programación</label>
																<div class="input-group date">
																  <div class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																  </div>
																  <input type="text" name="fechaProgramacion" class="form-control pull-right" placeholder="{{ date("d/m/yy") }}" id="datepicker">
															  </div>
															</div>

															<div class="bootstrap-timepicker">
																<div class="form-group">
																	<label for="horaProgramacion">Hora de Programación</label>
																	<div class="input-group">
																		<div class="input-group-addon">
																		  <i class="fa fa-clock-o"></i>
																		</div>
																		<input type="text" name="horaProgramacion" class="form-control timepicker">
																	</div>
																</div>
															</div>

															<div class="form-group">
																<label for="lugar">Lugar</label>
																<div class="input-group date">
																  <div class="input-group-addon">
																	<i class="fa fa-location-arrow"></i>
																  </div>
																  <input type="text" name="lugar" class="form-control" placeholder="Aula 202 - Segundo Piso - Ed. Bienestar">
																</div>
															</div>

															<div class="form-group">
											  					<label for="rutaImagen">Imagen</label>
											  					<input type="file" name="rutaImagen" class="form-control">
										    	  	</div>
												</div>
									</div>
						 </div>
						 <div class="col-md-6">
									<div class="box box-success">
											 <div class="box-header with-border">
												 		<h3 class="box-title"> Datos Específicos</h3>
											 </div>
			 							   <div class="box-body">
														<div id="selectResponsables" style='display:none;'>
																				<div class="form-group">
																						 <label for="idResponsable" id="etiquetaResponsable"  >Responsable</label>
																						 <select name="idResponsable" id="selectIdResponsable" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true">
																							 </select>
																							 <a id="enlaceRespInvitado" onclick="mostrarNuevoResponsable()" style='display:none;'>Añadir Responsable Invitado</a>
																				</div>
														 </div>
														 <div id="divModalidad" style='display:none;'>
																		<div class="form-group">
																		 			<label for="modalidad">Modalidad</label>
																			    <div class="row">
																								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																							        <input type="radio" id="rIndividual" name="modalidad" value="1" checked onchange="mostrarSegunModalidad(1)">Individual</option>
																							 </div>
																							 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																											<input type="radio" id="rGrupal" name="modalidad" value="2" onchange="mostrarSegunModalidad(2)">Grupal</option>
																								</div>
																			    </div>
																		</div>
															</div>
															<div id="selectAlumnosI" style='display:none;'>
																		<div class="form-group">
																			 <label for="idAlumnoI" >Alumnos</label>
					 														 <select name="idAlumno" id="selectIdAlumnoI"  class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true">
					  													 </select>
																		</div>
															</div>
															<div id="selectAlumnosTutorados" style='display:none;'>
																		<div class="form-group">
																			 <label for="idAlumnoTutorado" >Tutorados</label>
					 														 <select name="idAlumnoTutorado[]" id="selectIdAlumnoTutorado"  class="selectpicker form-control" multiple title="Selecciona Tutorado.."data-size="15" data-live-search="true" data-show-subtext="true">
					  													 </select>
																		</div>
															</div>
															<div id="divNoHayTutor" class="callout callout-danger" style='display:none;'>
										                <h4>Tutores</h4>
										                <p id="mensajeTutor">No hay tutor dentro del bla bla.</p>
								              </div>
															<div id="divCuposTotales" style='display:none;'>
																		<div class="form-group">
																					<label for="cuposTotales">N° Cupos</label>
																					<input type="number" id="cuposTotales" min="2" name="cuposTotales" class="form-control" value ="{{old('cuposTotales')}}" placeholder="2">
																		</div>
															</div>
															<div id="divListaAlumnos" style='display:none;'>
																					</br>
																					<div class="table-responsive table-fixed">
																								<table class="table table-striped table-bordered table-consdensed table-hover">
																											<thead>
																													<th>ID</th>
																													<th>Código</th>
																													<th>Nombres y Apellido</th>
																													<th>Ver</th>
																											</thead>

																								</table>
																					</div>
																</div>
											 </div>
									</div>
									<div class="box box-success" id="boxDatosAdicionales" style='display:none;'>
											 <div class="box-header with-border">
														<h3 class="box-title"> Datos Adicionales</h3>
											 </div>
											 <div class="box-body">
														 <div class="form-group">
															 <label for="fechaInicioConvocatoria">Fecha de Inicio Convocatoria</label>
															 <div class="input-group date">
																 <div class="input-group-addon">
																 <i class="fa fa-calendar"></i>
																 </div>
																 <input type="text" name="fechaInicioConvocatoria" class="form-control pull-right" value ="{{old('fechaInicioConvocatoria')}}" placeholder="{{ date("d/m/y") }}" id="datepicker">
															 </div>
														 </div>
														 <div class="form-group" id="inputFechaFinConvocatoria">
															 <label for="fechaFinConvocatoria">Fecha de Inicio Convocatoria</label>
															 <div class="input-group date">
																 <div class="input-group-addon">
																 <i class="fa fa-calendar"></i>
																 </div>
																 <input type="text" name="fechaFinConvocatoria" class="form-control pull-right" value ="{{old('fechaFinConvocatoria')}}" placeholder="{{ date("d/m/y") }}" id="datepicker">
															 </div>
														 </div>
											 </div>
									</div>
									<div class="box box-success" id="boxResponsableInvitado" style='display:none;'>
											 <div class="box-header with-border" ondblclick="ocultarNuevoResponsable()">
														<h3 class="box-title"> Responsable Invitado</h3>
											 </div>
											 <div class="box-body">
														 <div class="form-group">
															 <label for="nombreResponsable">Nombres</label>
															 <input type="text" name="nombreResponsable" class="form-control" value ="{{old('nombreResponsable')}}" placeholder="Nombres">
														 </div>
														 <div class="form-group">
															 <label for="apellidosResponsable">Apellidos</label>
															 <input type="text" name="apellidosResponsable" class="form-control" value ="{{old('apellidosResponsable')}}" placeholder="Apellidos">
														 </div>
														 <div class="form-group">
															 <label for="emailResponsable">Correo</label>
															 <input type="email" name="emailResponsable" class="form-control" value ="{{old('emailResponsable')}}" placeholder="xxx@xxx.xx">
														 </div>
											 </div>
									</div>
									<div>
										<button class="btn btn-primary" type="submit"> Programar</button>
										<button class="btn btn-danger" type="reset"> Cancelar</button>
									</div>
							</div>
			  </div>
			  <div class="row"  style="text-align: rigth;">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-2"></div>
			  </div>
{!! Form::close() !!}

<script src="{{ asset('dist/js/dropdown.js') }}"></script>
<script type="text/javascript">
				$('.timepicker').timepicker({
				showInputs: false
				})

				$('#datepicker').datepicker({
					autoclose: true,
					startDate :  '-3d',
					format: 'dd/mm/yyyy'
				})
				function mostrarNuevoResponsable(){
					document.getElementById('boxResponsableInvitado').style.display = 'block';
				}

				function ocultarNuevoResponsable(){
					document.getElementById('boxResponsableInvitado').style.display = 'none';
				}

				function mostrarSegunModalidad(modalidad){
						document.getElementById('selectAlumnosI').style.display = 'none';
						document.getElementById('selectAlumnosTutorados').style.display = 'none';
						document.getElementById('divCuposTotales').style.display = 'none';
						document.getElementById('divListaAlumnos').style.display = 'none';
						switch (modalidad) {
							case 1:
										if(document.getElementById('selectIdTipoActividad').value == 4){
												document.getElementById('selectAlumnosTutorados').style.display = 'block';
										}else {
												document.getElementById('selectAlumnosI').style.display = 'block';
										}
								break;
							case 2:
										if(document.getElementById('selectIdTipoActividad').value == 4){
												document.getElementById('selectAlumnosTutorados').style.display = 'block';
												document.getElementById('divListaAlumnos').style.display = 'block';
										}else {
												document.getElementById('divCuposTotales').style.display = 'block';
										}
								break;
							default:
						}
				}
</script>

<style type="text/css">
.table-fixed{
	height: 100px;
}
</style>

@endsection
