@extends('layouts.admin', ['titulo' => 'Editar Actividad', 'nombreTabla' => '', 'item' => 'actiTodas'])
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
									<h3 class="box-title">Datos Generales de la Actividad de {{ $actividad->tipoActividad['tipo'] }} &nbsp; &nbsp; &nbsp; &nbsp;
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
														<!-- /.modal -->
														<div class="modal fade" id="modal-default">
															 <!-- /.modal-dialog -->
										          <div class="modal-dialog">
																 <!-- /.modal-content -->
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
											<div id="selectResponsables" style='display:none;'>
																	<div class="form-group">
																			 <label for="idResponsable" id="etiquetaResponsable"  >Responsable *</label>
																			 <select name="idResponsable" id="selectIdResponsable" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
																				 <a id="enlaceRespInvitado" onclick="mostrarNuevoResponsable()" style='display:none;'>Añadir Responsable Invitado</a>
																	</div>
											 </div>
												<div id="selectAlumnosI" style='display:none;'>
															<div class="form-group">
																 <label for="idAlumnoI" >Alumnos *</label>
		 														 <select name="idAlumno" id="selectIdAlumnoI"  class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
															</div>
												</div>
												<div id="selectAlumnosTutorados" style='display:none;'>
															<div class="form-group">
																 <label for="idAlumnoTutorado" >Tutorados *</label>
		 														 <select name="idAlumnoTutorado[]" id="selectIdAlumnoTutorado"  class="selectpicker form-control" multiple title="Selecciona Tutorado.."data-size="15" data-live-search="true" data-show-subtext="true"> </select>
															</div>
												</div>
												<div id="divNoHayTutor" class="callout callout-danger" style='display:none;'>
							                <h4>Tutores</h4>
							                <p id="mensajeTutor">No hay tutor dentro del bla bla.</p>
					              </div>
												<div id="divCuposTotales" style='display:none;'>
															<div class="form-group">
																		<label for="cuposTotales">N° Cupos *</label>
																		@if ($actividad->cuposTotales > 1)
																			<input type="number" id="cuposTotales" min="2" name="cuposTotales" class="form-control" value ="{{ $actividad->cuposTotales }}">
																		@endif
															</div>
												</div>
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
        $(document).ready(function(){
          var hora='{{ date("g:i A",strtotime($actividad->horaProgramacion)) }}'
          $('.timepicker').timepicker({
                defaultTime:hora,
  				      showInputs: false
  				})
					document.getElementById('boxDatosEspecificos').style.display = 'block';
          if ({{ $actividad->idTipoActividad }} == '1' || {{ $actividad->idTipoActividad }} == '2') {
              //console.log('tipo actividad 1     -       2');
              document.getElementById('selectAlumnosI').style.display = 'block';
              dListaAlumnos('listaAlumnos','Alumnos');
          }else if ({{ $actividad->idTipoActividad }} == '3') {
              //console.log('tipo actividad 3');
              document.getElementById('selectResponsables').style.display = 'block';
              if({{ $actividad->modalidad }} == '1'){//individual
                document.getElementById('selectAlumnosI').style.display = 'block';
              }else{//grupal
                document.getElementById('divCuposTotales').style.display = 'block';
              }
              dListaResponsables('listaResponsablesAdm','Responsable');
              dListaAlumnos('listaAlumnos','Alumnos');
          }else if ({{ $actividad->idTipoActividad }} == '4') {
              //console.log('tipo actividad 4');
              document.getElementById('selectResponsables').style.display = 'block';
              document.getElementById('selectAlumnosTutorados').style.display = 'block';
              document.getElementById('etiquetaResponsable').innerHTML = 'Tutor *';
              dListaTutores('listaResponsablesTutores','Tutor',{{ $actividad->anioSemestre }},{{ $actividad->numeroSemestre }});
							var op ="";
							$.ajax({
								type:'GET',
								url: '/listaTutorados',
								data: {idPersona:{{ $actividad->idPersonaResp }}, anioSemestre:{{ $actividad->anioSemestre }}, numeroSemestre:{{ $actividad->numeroSemestre }}},
								dataType: 'json',
								success:function(data) {
											//console.log($('input:radio[name=modalidad]').val());
											//console.log('Cantidad de Tutorados'+data.length);
											//console.log({{ $idAlumnos }});
											for (var i = 0; i < data.length; i++) {
												if({{ count($actividad->inscripcionesADA) }} !=0 ){
													//console.log(data[i].idAlumno);console.log({{ $idAlumnos["0"]}});
														if(in_array(data[i].idAlumno, {{ $idAlumnos }})){
															op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
														}else{
															op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
														}
												}
												$("#selectIdAlumnoTutorado").append(op);
											}
											$("#selectIdAlumnoTutorado").selectpicker("refresh");
								},
								error:function() {
										console.log("Error ");
								}
							});
          }else if ({{ $actividad->idTipoActividad }} == '5' || {{ $actividad->idTipoActividad }} == '6' || {{ $actividad->idTipoActividad }} == '7' ) {
              //console.log('tipo actividad 5     -       6     -     7');
              document.getElementById('selectResponsables').style.display = 'block';
              document.getElementById('divCuposTotales').style.display = 'block';
              document.getElementById('enlaceRespInvitado').style.display = 'block';
							if ( '{{ $actividad->invitado }}' != '--' ) {
								//console.log('invitado -> '+'{{ $actividad->invitado }}');
                document.getElementById('boxResponsableInvitado').style.display = 'block';
								@php($array = preg_split("/[-]/",$actividad->invitado))
                $('#nombreResponsable').attr('value', '{{ $array[0]  }}');
                $('#apellidosResponsable').attr('value', '{{ $array[1]  }}');
                $('#emailResponsable').attr('value', '{{ $array[2]  }}');
							}
              dListaResponsables('listaResponsablesGen','Responsable');
          }else if ({{ $actividad->idTipoActividad }} == '8') {
              //console.log('tipo actividad 8');
              document.getElementById('selectResponsables').style.display = 'block';
              //document.getElementById('boxDatosAdicionales').style.display = 'block';
              document.getElementById('fechasConvocatoria').style.display = 'block';
              dListaResponsables('listaResponsablesAdmDoc','Responsable');
          }else if ({{ $actividad->idTipoActividad }} == '9') {
              //console.log('tipo actividad 9');
              document.getElementById('selectResponsables').style.display = 'block';
              //document.getElementById('boxDatosAdicionales').style.display = 'block';
							document.getElementById('fechaInicioConvocatoria').style.display = 'block';
              dListaResponsables('listaResponsablesAdm','Responsable');
          }else{
              //console.log('tipo actividad 10');
              document.getElementById('selectResponsables').style.display = 'block';
              //document.getElementById('divModalidad').style.display = 'block';
              if({{ $actividad->modalidad }} == '1'){//individual
								document.getElementById('selectAlumnosI').style.display = 'block';
              }else{//grupal
								document.getElementById('divCuposTotales').style.display = 'block';
              }
              document.getElementById('enlaceRespInvitado').style.display = 'block';
              if ( '{{ $actividad->invitado }}' != '--' ) {
                document.getElementById('boxResponsableInvitado').style.display = 'block';
                @php($array = preg_split("/[-]/",$actividad->invitado))
                $('#nombreResponsable').attr('value', '{{ $array[0]  }}');
                $('#apellidosResponsable').attr('value', '{{ $array[1]  }}');
                $('#emailResponsable').attr('value', '{{ $array[2]  }}');
							}
              dListaResponsables('listaResponsablesGen','Responsable');
              dListaAlumnos('listaAlumnos','Alumnos');
          }
        });
				$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				});

				var dListaResponsables = function(url, placeholder) {
				    var op ="";
						var tamSelectIdResp=document.getElementById("selectIdResponsable").length;
						if(tamSelectIdResp>0){
							$("#selectIdResponsable").children('option').remove();
							console.log('Borrando');
						}
						//Preparando el AJAX
				    $.ajax({
				      type:'GET',
				      url: '/'+url+'',
				      data: '',
				      dataType: 'json',
				      success:function(data) {
				          op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
				          $("#selectIdResponsable").append(op);
				          console.log('Cantidad de responsables'+data.length);
				          for (var i = 0; i < data.length; i++) {
                    if({{ $actividad->idPersonaResp }} == data[i].idPersona){
                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                    }else{
                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                    }
				            $("#selectIdResponsable").append(op);
				          }
				          $("#selectIdResponsable").selectpicker("refresh");
				      },
				      error:function() {
				          console.log("Error ");
				      }
				    });
				    //Fin del AJAX
				};

				var dListaAlumnos = function(url, placeholder) {
				    var op ="";
					var tamSelectIdAlumno=document.getElementById("selectIdAlumnoI").length;
					if(tamSelectIdAlumno>0){
						$("#selectIdAlumnoI").children('option').remove();
						console.log('Borrando');
					}
				    //Preparando el AJAX
				    $.ajax({
				      type:'GET',
				      url: '/'+url+'',
				      data: "",
				      dataType: 'json',
				      success:function(data) {
				          op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
				          $("#selectIdAlumnoI").append(op);
									console.log('Cantidad de alumnos'+data.length);
				          for (var i = 0; i < data.length; i++) {
											if({{ count($actividad->inscripcionesADA) }} !=0 ){
												//console.log(data[i].idAlumno);console.log({/{ $idAlumnos["0"]}});
													if(in_array(data[i].idAlumno, {{ $idAlumnos }})){
														op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
													}else{
														op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
													}
											}
					            $("#selectIdAlumnoI").append(op);
				          }
				          $("#selectIdAlumnoI").selectpicker("refresh");
				      },
				      error:function() {
				          console.log("Error ");
				      }
				    });
				    //Fin del AJAX
				};

				var dListaTutores = function(url, placeholder,anioSemestre, numeroSemestre) {
				    var op ="";
				    //Preparando el AJAX
				    $.ajax({
				      type:'GET',
				      url: '/'+url+'',
				      data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
				      dataType: 'json',
				      success:function(data) {
				        if(data.length == 0){
				              document.getElementById('divNoHayTutor').style.display = 'block';
				              document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+anioSemestre+'-'+numeroSemestre+'.';
				        }else {
				              op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
				              $("#selectIdResponsable").append(op);
											console.log('Cantidad de Tutores'+data.length);
				              for (var i = 0; i < data.length; i++) {
												if({{ $actividad->idPersonaResp }} == data[i].idPersona){
		                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'" selected>'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
		                    }else{
		                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
		                    }
				                $("#selectIdResponsable").append(op);
				              }
				              $("#selectIdResponsable").selectpicker("refresh");
				        }
				      },
				      error:function() {
				          console.log("Error ");
				      }
				    });
				    //Fin del AJAX
				};

				$("#selectIdResponsable").change(function(){
				    if($('#selectIdTipoActividad').val() == 4){
				          var op ="";
				          var tamSelectIdAlumno=document.getElementById("selectIdAlumnoI").length;
				          if(tamSelectIdAlumno>0){
				            $("#selectIdAlumnoI").children('option').remove();
				            console.log('Borrando');
				          }
				          var tamSelectIdAlumno=document.getElementById("selectIdAlumnoTutorado").length;
				          if(tamSelectIdAlumno>0){
				            $("#selectIdAlumnoTutorado").children('option').remove();
				            console.log('Borrando');
				          }
				          var numeroSemestre = $('#numeroSemestre').val();
				          var anioSemestre = $('#anioSemestre').val();
				          //Preparando el AJAX console.log("TutorTutoradoooo");
				          $.ajax({
				            type:'GET',
				            url: '/listaTutorados',
				            data: {idPersona:$(this).val(), anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
				            dataType: 'json',
				            success:function(data) {
				              		//console.log($('input:radio[name=modalidad]').val());
				              		//console.log('Cantidad de Tutorados'+data.length);
				                  for (var i = 0; i < data.length; i++) {
				                    op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" title="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
				                    $("#selectIdAlumnoTutorado").append(op);
				                  }
				                  $("#selectIdAlumnoTutorado").selectpicker("refresh");
				            },
				            error:function() {
				                console.log("Error ");
				            }
				          });
				          //Fin del AJAX
				    }
				});

				$("#anioSemestre").click(function(){
				      document.getElementById('divNoHayTutor').style.display = 'none';
				      if($('#selectIdTipoActividad').val() == 4){
				        var op ="";
				        //Preparando el AJAX
				        $.ajax({
				          type:'GET',
				          url: '/listaResponsablesTutores',
				          data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
				          dataType: 'json',
				          success:function(data) {
				            if(data.length == 0){
				                  document.getElementById('divNoHayTutor').style.display = 'block';
				                  document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+anioSemestre+'-'+numeroSemestre+'.';
				            }else {
				                  op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
				                  $("#selectIdResponsable").append(op);
				                  for (var i = 0; i < data.length; i++) {
				                    op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
				                    $("#selectIdResponsable").append(op);
				                  }
				                  $("#selectIdResponsable").selectpicker("refresh");
				            }
				          },
				          error:function() {
				              console.log("Error ");
				          }
				        });
				        //Fin del AJAX
				      }
				});

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
				$('#daterangepicker').daterangepicker({
					//autoUpdateInput: false,
					locale: {
						format: 'DD/MM/YYYY'
					},
					minDate :  '{{ date("d")-2 }}',
				});
				function mostrarNuevoResponsable(){
					document.getElementById('boxResponsableInvitado').style.display = 'block';
				}

				function ocultarNuevoResponsable(){
					document.getElementById('boxResponsableInvitado').style.display = 'none';
					document.getElementById("nombreResponsable").value = "";
					document.getElementById("apellidosResponsable").value = "";
					document.getElementById("emailResponsable").value = "";
				}

				function mostrarSegunModalidad(modalidad){
						document.getElementById('selectAlumnosI').style.display = 'none';
						document.getElementById('selectAlumnosTutorados').style.display = 'none';
						document.getElementById('divCuposTotales').style.display = 'none';
						switch (modalidad) {
							case 1:
										if({{ $actividad->idTipoActividad }} == '4'){
												document.getElementById('selectAlumnosTutorados').style.display = 'block';
										}else {
												document.getElementById('selectAlumnosI').style.display = 'block';
										}
										$('#emailResponsable').attr('value', null);
								break;
							case 2:
										document.getElementById('divCuposTotales').style.display = 'block';
								break;
							default:
						}
				}

				function in_array(valor, array){
						var noExiste = true;
						var i = 0;
						var cant = array.length;
						while ( i<cant && noExiste) {
								if (array[i]==valor) {
									noExiste = false;
								}
								i++;
						}
						if (!noExiste) {
								return true;
						} else {
								return false;
						}
				}

</script>

<style type="text/css">
	.table-fixed{
		height: 100px;
	}
	textarea{
		resize: none;
	}
</style>

@endsection
