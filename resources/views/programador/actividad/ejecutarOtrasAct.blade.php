	<div class="caja">
		<div class="caja-header">
         <div class="caja-icon">2</div>
         <div class="caja-title">Ejecución de la Actividad</div>
   	</div>
		<div class="caja-body">
			<p style="color:red;"> <span class="ast">*</span> Requerido
			{!! Form::open(['route'=>['actividad.updateExecute', $actividad->idActividad], 'method'=>'POST', 'autocomplete'=>'off']) !!}
			{{Form::token()}}
			<div class="row">
					<div class="col-md-4">
					   <div class="form-group">
						   <label for="fechaEjecutada">Fecha de Ejecutada <span class="ast">*</span></label>
						   <div class="input-group date">
							  <div class="input-group-addon">
							   <i class="fa fa-calendar"></i>
							  </div>
							  @if ($actividad->fechaEjecutada == null)
								  @if (old('fechaEjecutada') == null)
									  <input type="text" required name="fechaEjecutada"  placeholder="{{ date("d/m/Y",strtotime($actividad->fechaInicio)) }}" class="form-control pull-right"  id="fechaEjecutada" >
								  @else
									  <input type="text" required name="fechaEjecutada"  value="{{old('fechaEjecutada')}}" class="form-control pull-right"  id="fechaEjecutada" >
								  @endif
							  @else
								  <input type="text" required name="fechaEjecutada"  value="{{ date("d/m/Y",strtotime($actividad->fechaEjecutada)) }}" class="form-control pull-right"  id="fechaEjecutada" >
							  @endif
						  </div>
					   </div>
					</div>
					<div class="col-md-4">
					   <div class="bootstrap-timepicker">
						   <div class="form-group">
							   <label for="horaEjecutada">Hora de Ejecutada <span class="ast">*</span></label>
							   <div class="input-group">
								   <div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
								   </div>
	 							  @if ($actividad->horaEjecutada == null)
									  @if (old('horaEjecutada') == null)
		 								  <input type="text" required name="horaEjecutada"  value="{{ date('g:i A',strtotime($actividad->horaInicio)) }}" class="form-control timepicker">
		 							  @else
		 								  <input type="text" required name="horaEjecutada"  value="{{old('horaEjecutada')}}" class="form-control timepicker">
		 							  @endif
	 							  @else
	 								  <input type="text" required name="horaEjecutada"  value="{{ date("g:i A",strtotime($actividad->horaEjecutada)) }}" class="form-control timepicker">
	 							  @endif
							   </div>
						   </div>
					   </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="horaEjecutada">Asistencias &nbsp; <i class="fa fa-check-square-o" aria-hidden="true"></i><span class="ast">*</span></label>
							<div class="input-group">
									<button type="button" name="button" data-target="#modal-asistencia" data-toggle="modal" class="btn btn-ff-yellow">Registrar</button>
							</div>
						</div>
					</div>
			</div>
			<div class="form-group">
			  <label for="titulo">Observaciones </label>
			  @if ($actividad->observaciones != 'Ninguna')
				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas observaciones de la Actividad realizada">{{ $actividad->observaciones }}</textarea>
			  @else
				  <textarea name="observaciones" class="form-control" id="observaciones" rows="6" cols="30" maxlength="500" value ="{{ old('observaciones') }}" placeholder="Añadir algunas observaciones de la Actividad realizada"></textarea>
			  @endif
				  <p id="contadorObservaciones">0/500</p>
		  </div>
		  <div class="form-group">
			  <label for="titulo">Recomendaciones </label>
			  @if ($actividad->recomendaciones != 'Ninguna')
				  <textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" maxlength="500" placeholder="Añadir algunas recomendaciones de la Actividad realizada que se pueda tener en cuenta en la siguiente actividad">{{ $actividad->recomendaciones }}</textarea>
			  @else
				  <textarea name="recomendaciones" class="form-control" id="recomendaciones" rows="6" cols="30" maxlength="500" value ="{{ old('recomendaciones') }}"placeholder="Añadir algunas recomendaciones de la Actividad realizada que se pueda tener en cuenta en la siguiente actividad"></textarea>
			  @endif
				  <p id="contadorRecomendaciones">0/500</p>
		  </div>
		</div>
		<div class="caja-footer">
			<div class="pull-right">
				<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Limpiar</button>
				<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Grabar</button>
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
			@include('programador.evidenciaActividad.modalNueva')
   	</div>
		<div class="caja-body">
			<div class="panel-body">
				<div class="row">
					@foreach($actividad->evidenciasActividad as $evidenciaActividad)
						@php($array = preg_split("/[.]/",$evidenciaActividad->ruta))
						@php($count = count($array))
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<div class="panel panel-default">
								@if($array[$count-1] == 'jpg'|| $array[$count-1] == 'png' || $array[$count-1] == 'jpeg')
									<div class="panel-body">
										<img src="{{ asset('storage/'.$evidenciaActividad->ruta) }}" alt="No Encontrada"  height="80px"  class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span> </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-trash"></span>  </a>
										</div>
									</div>
								@elseif ($array[$count-1] == 'docx'|| $array[$count-1] == 'doc')
									<div class="panel-body" width="90px" >
										<img src="{{asset('img/iconos/word.png')}}" alt="WORD"  height="80px" width="120px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span> </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-trash"></span>  </a>
									   </div>
									</div>
								@elseif ($array[$count-1] == 'pdf')
									<div class="panel-body" style="margin:0 auto;">
										<img src="{{asset('img/iconos/pdf.png')}}" alt="PDF"  height="100px" width="120px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{asset('storage/'.$evidenciaActividad->ruta)}}" target="_blank"><span class="fa fa-eye"></span></a>
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-trash"></span>  </a>
										</div>
									</div>
								@elseif ($array[$count-1] == 'xlsx' || $array[$count-1] == 'xls' || $array[$count-1] == 'xlsm')
									<div class="panel-body">
										<img src="{{asset('img/iconos/excel.png')}}" alt="EXCEL"  height="80px" width="120px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-trash"></span>  </a>
										</div>
									</div>
								@elseif ($array[$count-1] == 'pptx' || $array[$count-1] == 'ppt' || $array[$count-1] == 'pptm')
									<div class="panel-body">
										<img src="{{asset('img/iconos/ppt.png')}}" alt=""  height="80px" width="120px" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-trash"></span>  </a>
										</div>
									</div>
								@else
									<div class="panel-body">
										<img src="{{asset('img/iconos/otro.png')}}" alt="{{ $array[$count-1] }}"  height="80px" width="120px" alt="Otro Archivo" class="img-responsive">
									</div>
									<div class="panel-footer">
										{{ $evidenciaActividad->nombre }}
										<div class="pull-right">
											<a href="{{ action('EvidenciaActividadController@descargarEvidencia',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}}" id="{{$evidenciaActividad->idEvidenciaActividad}}"><span class="fa fa-download"></span>  </a>
											<a href="" data-target="#modal-delete-{{$evidenciaActividad->idEvidenciaActividad}}" data-toggle="modal"><span class="fa fa-trash"></span>  </a>
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
