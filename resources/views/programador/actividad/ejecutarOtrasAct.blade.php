	<div class="caja">
		<div class="caja-header">
         <div class="caja-icon">2</div>
         <div class="caja-title">Ejecución de la Actividad</div>
   	</div>
		<div class="caja-body">
			{!! Form::open(['route'=>['actividad.updateExecute', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
			{{Form::token()}}
			<div class="row">
				@if ($actividad->fechaEjecutada == null)
					<div class="col-md-4">
					   <div class="form-group">
						   <label for="fechaEjecutada">Fecha de Ejecutada</label>
						   <div class="input-group date">
							  <div class="input-group-addon">
							   <i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" name="fechaEjecutada" class="form-control pull-right" required  value="{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}" id="datepicker1">
						  </div>
					   </div>
					</div>
					<div class="col-md-4">
					   <div class="bootstrap-timepicker">
						   <div class="form-group">
							   <label for="horaEjecutada">Hora de Ejecutada:</label>
							   <div class="input-group">
								   <div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
								   </div>
		 						  		<input type="text" name="horaEjecutada" required  value="{{ date('g:i A',strtotime($actividad->horaInicio)) }}" class="form-control timepicker">
							   </div>
						   </div>
					   </div>
					</div>
				@endif
					<div class="col-md-4">
						<div class="form-group">
							<label for="horaEjecutada">Asistencias &nbsp; &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i></label>
							<div class="input-group">
								@if ($numAsistentes == 0)
									<button type="button" name="button" data-target="#modal-asistencia" data-toggle="modal" class="btn btn-ff-yellow">Registrar</button> &nbsp;
									<span>
										<button type="button" class="btn btn-default btn-circle" data-toggle="modal" data-target="#modal-default">
											<i class="fa fa-question" style="padding-left:4px;"></i>
				           			</button>
									</span>
								@else
									<a href="{{ action('InscripcionADAController@index',['idActividad' => $actividad->idActividad,'opcionBuscar' => '4','cupos' => $actividad->cuposTotales]) }}">
										<button type="button" class="btn btn-success">Ver Asistencias </button>
									</a>
								@endif
							</div>
						</div>
					</div>
			</div>			
			<div class="form-group">
				@if ($actividad->fechaEjecutada != null)
					<label><b>Fecha de Ejecución: </b> </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividad->fechaEjecutada)) }} &nbsp;- &nbsp;{{ date("h:i A",strtotime($actividad->horaEjecutada)) }}<br>
				@endif
			</div>
			<div class="form-group">
			  <label for="titulo">Observaciones: </label>
			  @if ($actividad->observaciones != 'Ninguna')
				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" placeholder="Añadir algunas observaciones de la Actividad realizada">{{ $actividad->observaciones }}</textarea>
			  @else
				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" placeholder="Añadir algunas observaciones de la Actividad realizada"></textarea>
			  @endif
		  </div>
		  <div class="form-group">
			  <label for="titulo">Recomendaciones: </label>
			  @if ($actividad->recomendaciones != 'Ninguna')
				  <textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" placeholder="Añadir algunas recomendaciones de la Actividad realizada que se pueda tener en cuenta en la siguiente actividad">{{ $actividad->recomendaciones }}</textarea>
			  @else
				  <textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" placeholder="Añadir algunas recomendaciones de la Actividad realizada que se pueda tener en cuenta en la siguiente actividad"></textarea>
			  @endif
		  </div>
		</div>
		<div class="caja-footer">
			<div class="pull-right">
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar</button>
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
			</div>
      </div>
		{!!Form::close()!!}
		 @include('programador.actividad.modalAsistencia')
	</div>
	<div class="caja">
		<div class="caja-header">
         <div class="caja-icon">3</div>
         <div class="caja-title">
				Evidencias
				<button type="button" name="button" data-target="#modal-evidencia" data-toggle="modal" class="btn btn-ff-green pull-right" style="margin-top:4px;">
					<i class="fa fa-plus "></i>Nueva Evidencia
				 </button>
			</div>
			@include('programador.actividad.modalEvidencia')
   	</div>
		<div class="caja-body">
			<div class="panel-body">
				<div class="row">
					@foreach($actividad->evidenciasActividad as $evidenciaActividad)
						@php($array = preg_split("/[.]/",$evidenciaActividad->ruta))
						@php($count = count($array))
						<div class="col-lg-2 col-md-4 col-sm-3 col-xs-12">
							<div class="panel panel-default">
								@if($array[$count-1] == 'jpg'|| $array[$count-1] == 'png' || $array[$count-1] == 'jpeg')
									<div class="panel-body">
										<img src="{{ asset('storage/'.$evidenciaActividad->ruta) }}" alt="{{ $evidenciaActividad->ruta }}"  height="100px"  class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span> </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
										</div>
									</div>
								@elseif ($array[$count-1] == 'docx'|| $array[$count-1] == 'doc')
									<div class="panel-body" width="90px" >
										<img src="{{asset('images/Iconos/word.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span> </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
									   </div>
									</div>
								@elseif ($array[$count-1] == 'pdf')
									<div class="panel-body">
										<img src="{{asset('images/Iconos/pdf.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{asset('storage/'.$evidenciaActividad->ruta)}}" target="_blank"><span class="fa fa-eye"></span></a>
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
										</div>
									</div>
								@elseif ($array[$count-1] == 'xlsx' || $array[$count-1] == 'xls' || $array[$count-1] == 'xlsm')
									<div class="panel-body">
										<img src="{{asset('images/Iconos/excel.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
										</div>
									</div>
								@elseif ($array[$count-1] == 'pptx' || $array[$count-1] == 'ppt' || $array[$count-1] == 'pptm')
									<div class="panel-body">
										<img src="{{asset('images/Iconos/ppt.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
										</div>
									</div>
								@else
									<div class="panel-body">
										<img src="{{asset('images/Iconos/otro.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
										</div>
									</div>
								@endif
							</div>
						   @include('programador.evidenciaActividad.modal')
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
<!-- MODALES -->
	<div class="modal fade" id="modal-default">
		 <!-- /.modal-dialog -->
		 <div class="modal-dialog">
			   <!-- /.modal-content -->
			   <div class="modal-content">
			        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            <span aria-hidden="true" class="fa fa-remove"></span></button>
				          <h4 class="modal-title"><b>Ayuda</b></h4>
			        </div>
			        <div class="modal-body">
			          	<p>Sólo podrá registrar una vez la lista de asistencia, si comete algun error o desea añadir mas asistentes luego de haber registrado contactese con el programador.</p>
			        </div>
			        <div class="modal-footer">
			          	<button type="button" class="btn btn-ff-default pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
			        </div>
			   </div>
		      <!-- /.modal-content -->
		 </div>
	    <!-- /.modal-dialog -->
	</div>
