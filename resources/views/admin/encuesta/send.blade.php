@extends('template')
@section ('contenido')
{!! Form::open(['route'=>['encuesta.store_send', $encuesta->idEncuesta], 'method'=>'POST', 'autocomplete'=>'off']) !!}
{{Form::token()}}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="caja">
				<div class="caja-header">
					<div class="caja-icon"> <i class="fa fa-send"></i> </div>
					<div class="caja-title"> Programar envío de encuesta </div>
				</div>
				<div class="caja-body">
					<label style="margin-right: 10px" for="">Título de encuesta: </label><span>{{ $encuesta->titulo }}</span>
					<br>
					<label style="margin-right: 10px" for="">Fecha de envío: </label>
					<input required style="width: auto;" type="date" class="ff-control" name="fecha_envio" value="{{ date("Y-m-d") }}" min={{ date("Y-m-d") }}>
					<label style="margin-right: 10px" for="">Hora de envío: </label>
					<input required style="width: auto;" type="time" class="ff-control" name="hora_envio" value="{{ date("H:i") }}">
					<p class="help-block">Esta encuesta estará disponible para los encuestados desde la <strong>Fecha</strong> y <strong>Hora</strong> indicadas</p>

					<div class="ff-nav-box">
		            <ul class="ff-nav-tab">
							@if( strpos($encuesta->destino, '1') !== false )
		              		<li id="op_1"><a href="#tb_1" data-toggle="tab"><i class="fa fa-child"></i>Alumnos</a></li>
							@endif
							@if( strpos($encuesta->destino, '2') !== false )
		              		<li id="op_2"><a href="#tb_2" data-toggle="tab"><i class="fa fa-tasks"></i>Docentes</a></li>
							@endif
							@if( strpos($encuesta->destino, '3') !== false )
		              		<li id="op_3"><a href="#tb_3" data-toggle="tab"><i class="fa fa-calendar"></i>Admninistrativos</a></li>
							@endif
							@if( strpos($encuesta->destino, 'd') !== false )
								<li id="op_d"><a href="#tu_d" data-toggle="tab"><i class="fa fa-child"></i>Tutores</a></li>
							@endif
							@if( strpos($encuesta->destino, 'a') !== false )
								<li id="op_a"><a href="#tu_a" data-toggle="tab"><i class="fa fa-child"></i>Tutorados</a></li>
							@endif
		            </ul>
		            <div class="ff-nav-content">
		               @if( strpos($encuesta->destino, '1') !== false )
								<div class="ff-nav-pane"  id="tb_1">
									<div class="table-responsive">
										<table id="tabAlumnos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
											<thead>
												<th>Código</th>
												<th>Alumno</th>
												<th>Selec.</th>
											</thead>
											<tbody>
	  											 @foreach ($alumnos as $alumno)
	  												 <tr>
	     											 	<td>{{ $alumno->codigo }}</td>
	     												<td>{{ $alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno }}</td>
	     												<td>
	     													<input checked type="checkbox" class="icheckbox_square-green" onchange="ocultarError(this)" value="{{$alumno->id}}" name="alumnos[]">
	     												</td>
	     											 </tr>
	  											 @endforeach
											</tobody>
										</table>
									</div>
								</div>
							@endif

							@if( strpos($encuesta->destino, '2') !== false )
								<div class="ff-nav-pane" id="tb_2">
									<div class="table-responsive">
										<table id="tabDocentes" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
											<thead>
												<th>Código</th>
												<th>Docente</th>
												<th>Selec.</th>
											</thead>
											<tbody>
	  											 @foreach ($docentes as $docente)
	  												 <tr>
	     											 	<td>{{ $docente->codigo }}</td>
	     												<td>{{ $docente->nombre.' '.$docente->apellidoPaterno.' '.$docente->apellidoMaterno }}</td>
	     												<td>
	     													<input checked type="checkbox" class="icheckbox_square-green" onchange="ocultarError(this)" value="{{ $docente->id }}" name="docentes[]">
	     												</td>
	     											 </tr>
	  											 @endforeach
											</tobody>
										</table>
									</div>
								</div>
							@endif

							@if( strpos($encuesta->destino, '3') !== false )
								<div class="ff-nav-pane" id="tb_3">
									<div class="table-responsive">
										<table id="tabAdministrativos" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
											<thead>
												<th>Código</th>
												<th>Administrativo</th>
												<th>Selec.</th>
											</thead>
											<tbody>
	  											 @foreach ($administrativos as $administrativo)
	  												 <tr>
	     											 	<td>{{ $administrativo->codigo }}</td>
	     												<td>{{ $administrativo->nombre.' '.$administrativo->apellidoPaterno.' '.$administrativo->apellidoMaterno }}</td>
	     												<td>
	     													<input checked type="checkbox" class="icheckbox_square-green" onchange="ocultarError(this)" value="{{$administrativo->id}}" name="administrativos[]">
	     												</td>
	     											 </tr>
	  											 @endforeach
											</tobody>
										</table>
									</div>
								</div>
						 	@endif

							@if( strpos($encuesta->destino, 'd') !== false )
								<div class="ff-nav-pane" id="tu_d">
									<table id="tabTutores" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<th>Código</th>
											<th>Tutor</th>
											<th>Selec.</th>
										</thead>
										@foreach($tutores as $tutor)
										<tr>
											<td>{{ $tutor->codigo }}</td>
											<td>{{ $tutor->nombre.' '.$tutor->apellidoPaterno.' '.$tutor->apellidoMaterno }}</td>
											<td>
												<input checked type="checkbox" class="icheckbox_square-green" onchange="ocultarError(this)" value="{{ $tutor->id }}" name="tutores[]">
											</td>
										</tr>
										@endforeach
									</table>
								</div>
							@endif

							@if( strpos($encuesta->destino, 'a') !== false )
								<div class="ff-nav-pane" id="tu_a">
									<table id="tabTutorados" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<th>Código</th>
											<th>Tutorado</th>
											<th>Selec.</th>
										</thead>
										@foreach($tutorados as $tutorado)
										<tr>
											<td>{{ $tutorado->codigo }}</td>
											<td>{{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}</td>
											<td>
												<input checked type="checkbox" class="icheckbox_square-green" onchange="ocultarError(this)" value="{{ $tutorado->id }}" name="tutorados[]">
											</td>
										</tr>
										@endforeach
									</table>
								</div>
							@endif

		            </div>
		         </div>
				</div>
				<div class="caja-footer">
					<button class="btn btn-ff pull-right" type="submit"><i class="fa fa-send"></i> Enviar</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {

		var destino = '{{ $encuesta->destino }}';
		switch ( {{ $encuesta->tipo }} ) {
			case 2:
				ar_destino = destino.split("_");
				$('#op_' + ar_destino[0]).addClass('active');
				$('#tb_' + ar_destino[0]).addClass('active');
			case 3:
				if( destino == 'd' ){
					$('#op_d').addClass('active');
					$('#tu_d').addClass('active');
				}else{
					$('#op_a').addClass('active');
					$('#tu_a').addClass('active');
				}
				break;
			}

		$('table').DataTable({
			"language": {
				  "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			 },
			 "scrollY": "265px",
			 "paging": false,
			 "info": false
		});

	});
	</script>
@endsection
