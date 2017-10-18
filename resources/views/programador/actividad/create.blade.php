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
{!! Form::open(['url'=>'programador/actividad', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true']) !!}
{{ Form::token() }}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header with-border">
				 		<h3 class="box-title">Datos Generales</h3>
				</div>
				<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="titulo">Título de la actividad *</label>
										<input type="text" name="titulo" class="form-control"  required value ="{{old('titulo')}}" placeholder="Título">
									</div>
							    <div class="form-group">
							      <label for="idTipoActividad">Categoría *</label>
							      <select name="idTipoActividad" id="selectIdTipoActividad"  required class="form-control">
											<option value="">Seleccione Tipo de Actividad</option>
							        @foreach($tiposActividad as $tipo)
							          <option value="{{$tipo->idTipoActividad}}">{{$tipo->tipo}}</option>
							        @endforeach
							      </select>
							    </div>
							    <div class="form-group">
										<label for="anioSemestre">Año *</label>
										<input type="number" min="{{ date('Y') }}" id="anioSemestre" name="anioSemestre" class="form-control" value ="{{ date('Y') }}"  required placeholder="{{ date('Y') }}">
									</div>
									<div class="form-group">
										<label for="numeroSemestre">Ciclo *</label>
										<select name="numeroSemestre" id="numeroSemestre" required  class="form-control">
							          <option value="1">I</option>
												<option value="2">II</option>
							      </select>
									</div>
									<div class="form-group">
										<label for="fechaProgramacion">Fecha de Programación *</label>
										<div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" name="fechaProgramacion" class="form-control pull-right" required  placeholder="{{ date("d/m/Y") }}" id="datepicker1">
									  </div>
									</div>
									<div class="bootstrap-timepicker">
										<div class="form-group">
											<label for="horaProgramacion">Hora de Programación *</label>
											<div class="input-group">
												<div class="input-group-addon">
												  <i class="fa fa-clock-o"></i>
												</div>
												<input type="text" name="horaProgramacion"  required  class="form-control timepicker">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="lugar">Lugar *</label>
										<div class="input-group">
										  <div class="input-group-addon">
											<i class="fa fa-location-arrow"></i>
										  </div>
										  <input type="text" name="lugar" class="form-control" value="{{ old('lugar') }}" required  placeholder="Av. Juan Pablo II S/N - Ciudad Universitaria">
										</div>
									</div>
									<div class="form-group">
										<label for="referencia">Referencia</label>
										<div class="input-group">
										  <div class="input-group-addon">
											<i class="fa fa-map-signs"></i>
										  </div>
										  <input type="text" name="referencia" class="form-control" value="{{ old('referencia') }}" placeholder="Aula 202 - Segundo Piso Bienestar Universitario">
										</div>
									</div>
								</div>
									<div class="col-md-6">
										<div class="form-control-file">
						  					<label for="rutaImagen">Imagen</label>
												<input type="file" name="rutaImagen" class="form-control dropify"  data-allowed-file-extensions="png jpg jpge"  data-disable-remove="true">
						  					<!--<input type="file" name="rutaImagen" class="form-control">-->
					    	  	</div>
										<div class="form-group">
										  <label for="titulo">Descripción *</label>
											<textarea name="descripcion"  class="form-control" required value ="{{old('descripcion')}}"  rows="6" cols="30" placeholder="Describir una breve reseña de Evento"></textarea>
									  </div>
									  <div class="form-group">
										  <label for="titulo">Información Adicional </label>
											<textarea name="informacionAdicional"  class="form-control" value ="{{old('informacionAdicional')}}"  rows="6" cols="30" placeholder="Añadir información Adicional"></textarea>
									  </div>
									</div>
							</div>
					</div>
			</div>
		</div>
		<div class="col-md-12">
				<div class="box box-success"  id="boxDatosEspecificos" style='display:none;'>
						 <div class="box-header with-border">
							 		<h3 class="box-title"> Datos Específicos</h3>
						 </div>
						   <div class="box-body">
								<div class="col-md-6">
									<div id="selectResponsables" style='display:none;'>
															<div class="form-group">
																	 <label for="idResponsable" id="etiquetaResponsable">Responsable *</label>
																	 <select name="idResponsable" id="selectIdResponsable" class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
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
														 <label for="idAlumnoI">Alumnos *</label>
															 <select name="idAlumno" id="selectIdAlumnoI"  class="selectpicker form-control" data-size="15" data-live-search="true" data-show-subtext="true"> </select>
													</div>
										</div>
										<div id="selectAlumnosTutorados" style='display:none;'>
													<div class="form-group">
														 <label for="idAlumnoTutorado">Tutorados *</label>
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
																<input type="number" id="cuposTotales" min="2" name="cuposTotales" class="form-control" value ="{{old('cuposTotales')}}" placeholder="2">
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
										 <input type="text" name="fechasConvocatoria" class="form-control pull-right" id="daterangepicker">
									 </div>
								 </div>
									<div class="form-group" style='display:none;' id="fechaInicioConvocatoria">
										<label for="fechaInicioConvocatoria">Fecha de Inicio Convocatoria *</label>
										<div class="input-group date">
											<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="fechaInicioConvocatoria" class="form-control pull-right" value ="{{old('fechaInicioConvocatoria')}}" placeholder="{{ date("d/m/Y") }}" id="datepicker2">
										</div>
									</div>
								</div>
						 </div>
				</div>
				<div class="box box-success" id="boxResponsableInvitado" style='display:none;'>
						 <div class="box-header with-border">
									<h3 class="box-title"> Responsable Invitado </h3>
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
										 <input type="text"  name="nombreResponsable" class="form-control" value ="{{old('nombreResponsable')}}" placeholder="Nombres">
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


<script type="text/javascript">
				$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
				$("#selectIdTipoActividad").change(function(){
							document.getElementById('boxDatosEspecificos').style.display = 'block';
				      //console.log("esta cambiando");
				      console.log("Val "+ $(this).val());

				      var tamSelectIdResponsable=document.getElementById("selectIdResponsable").length;
				      var tamSelectIdAlumno=document.getElementById("selectIdAlumnoI").length;

				      if(tamSelectIdResponsable>0){
				        $("#selectIdResponsable").children('option').remove();
				        ////console.log('Borrando');
				      }
				      if(tamSelectIdAlumno>0){
				        $("#selectIdAlumnoI").children('option').remove();
				        ////console.log('Borrando');
				      }

				      tamSelectIdAlumno=document.getElementById("selectIdAlumnoTutorado").length;
				      if(tamSelectIdAlumno>0){
				        $("#selectIdAlumnoTutorado").children('option').remove();
				        ////console.log('Borrando');
				      }
				      document.getElementById('selectResponsables').style.display = 'none';
							document.getElementById('selectAlumnosI').style.display = 'none';
				      document.getElementById('selectAlumnosTutorados').style.display = 'none';

							document.getElementById('divCuposTotales').style.display = 'none';
							document.getElementById('divModalidad').style.display = 'none';
							//document.getElementById('boxDatosAdicionales').style.display = 'none';
							document.getElementById('fechasConvocatoria').style.display = 'none';
							document.getElementById('fechaInicioConvocatoria').style.display = 'none';
							document.getElementById('boxResponsableInvitado').style.display = 'none';
				      document.getElementById('enlaceRespInvitado').style.display = 'none';
				      document.getElementById('divNoHayTutor').style.display = 'none';
				      document.getElementById('etiquetaResponsable').innerHTML = 'Responsable *';

				      switch ($(this).val()) {

				              case '1':        case '2':
				                    document.getElementById('selectAlumnosI').style.display = 'block';
				                    dListaAlumnos('listaAlumnos','Alumnos');
				                break;
				              case '3':
				                    document.getElementById('selectResponsables').style.display = 'block';
				        						document.getElementById('divModalidad').style.display = 'block';
				              			document.getElementById('selectAlumnosI').style.display = 'block';
				                    document.getElementById('rIndividual').checked = true;
				                    dListaResponsables('listaResponsablesAdm','Responsable');
				                    dListaAlumnos('listaAlumnos','Alumnos');
				                break;
				              case '4':
				                    document.getElementById('selectResponsables').style.display = 'block';
				                  	document.getElementById('selectAlumnosTutorados').style.display = 'block';
				                    document.getElementById('etiquetaResponsable').innerHTML = 'Tutor *';
				                    var numeroSemestre = $('#numeroSemestre').val();
				                    var anioSemestre = $('#anioSemestre').val();
				                    dListaTutores('listaResponsablesTutores','Tutor',anioSemestre,numeroSemestre);
				                break;
				              case '5':        case '6':        case '7':
				                    document.getElementById('selectResponsables').style.display = 'block';
				              			document.getElementById('divCuposTotales').style.display = 'block';
				                    document.getElementById('enlaceRespInvitado').style.display = 'block';
				                    dListaResponsables('listaResponsablesGen','Responsable');
				                break;
				              case '8':
				                    document.getElementById('selectResponsables').style.display = 'block';
				        						//document.getElementById('boxDatosAdicionales').style.display = 'block';
														document.getElementById('fechasConvocatoria').style.display = 'block';
				                    dListaResponsables('listaResponsablesAdmDoc','Responsable');
				                break;
				              case '9':
				                    document.getElementById('selectResponsables').style.display = 'block';
				      							//document.getElementById('boxDatosAdicionales').style.display = 'block';
														document.getElementById('fechaInicioConvocatoria').style.display = 'block';
				      						  dListaResponsables('listaResponsablesAdm','Responsable');
				                break;
				              case '10':
				                    document.getElementById('selectResponsables').style.display = 'block';
				                    document.getElementById('divModalidad').style.display = 'block';
				                    document.getElementById('enlaceRespInvitado').style.display = 'block';
				              			document.getElementById('selectAlumnosI').style.display = 'block';
				                    dListaResponsables('listaResponsablesGen','Responsable');
				                    dListaAlumnos('listaAlumnos','Alumnos');
				                break;
				              default:
				              // code...
				              break;
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
				            op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
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
				            op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
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
				          //Preparando el AJAX
				          console.log("TutorTutoradoooo");
				          $.ajax({
				            type:'GET',
				            url: '/listaTutorados',
				            data: {idPersona:$(this).val(), anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
				            dataType: 'json',
				            success:function(data) {
				              		console.log($('input:radio[name=modalidad]').val());
				              		console.log('Cantidad de Tutorados'+data.length);
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
						switch (modalidad) {
							case 1:
										if(document.getElementById('selectIdTipoActividad').value == 4){
												document.getElementById('selectAlumnosTutorados').style.display = 'block';
										}else {
												document.getElementById('selectAlumnosI').style.display = 'block';
										}
								break;
							case 2:
										document.getElementById('divCuposTotales').style.display = 'block';
								break;
							default:
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
