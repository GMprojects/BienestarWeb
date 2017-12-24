@extends ('template')
@section ('contenido')
<div class="box box-info">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Detalles del Habito de Estudio </h3>
			</div>
		</div>

	</div>

	<div class="box-body">
		<div class="col-md-12">
			@if ($alumno->sexo == 'm')
				<label>&nbsp; &nbsp; <i class="fa fa-user margin-r-5"></i>&nbsp; &nbsp;<b>Alumna: </b> </label>
			@else
				<label>&nbsp; &nbsp; <i class="fa fa-user margin-r-5"></i>&nbsp; &nbsp;<b>Alumno: </b> </label>
			@endif
			<b>  &nbsp; &nbsp; {{ $alumno->nombre.' '.$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno }}</b>&nbsp; &nbsp; <br>
			<div class="pull-right"><label>&nbsp; &nbsp; <i class="fa fa-calendar margin-r-5"></i>&nbsp; &nbsp;<b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $tutorTutorado->anioSemestre.'-'.$tutorTutorado->numeroSemestre }}</div>
			<label>&nbsp; &nbsp; <i class="fa fa-qrcode margin-r-5"></i>&nbsp; &nbsp;<b>Código: </b></label> <b>  &nbsp; &nbsp; {{ $alumno->codigo }}</b>&nbsp; &nbsp; <br>
		</div>
	 </div>
</div>

<div class="box box-info">
	<div class="box-header">
		<h3 class="box-title">Análisis del Hábito de Estudio  </h3>
	</div>

	<div class="box-body"  id="box" class="collapse">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6" id="chart">
			<div id="bar-chart" style="width:450px;height:300px;margin:0 auto"></div><br>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6">
			<label style="color:#4B367C">Resumen de respuestas: </label><br>
			<br>
			<label>&nbsp; &nbsp;  Nunca (1) : </label> {{ $respuesta_cantidad[0]['cantidad'] }} <br>
			<label>&nbsp; &nbsp;  Pocas Veces (2) : </label> {{ $respuesta_cantidad[1]['cantidad'] }} <br>
			<label>&nbsp; &nbsp;  Muchas Veces (3) : </label> {{ $respuesta_cantidad[2]['cantidad'] }} <br>
			<label>&nbsp; &nbsp;  Siempre (4) : </label> {{ $respuesta_cantidad[3]['cantidad'] }} <br>
			<br>
			<label style="color:#4B367C">Totales: </label><br>
			<br>
			<label>&nbsp; &nbsp;  Total : </label> {{ ($respuesta_cantidad[0]['cantidad']*1)+($respuesta_cantidad[1]['cantidad']*2)+($respuesta_cantidad[2]['cantidad']*3)+($respuesta_cantidad[3]['cantidad']*4) }} ptos.<br>
		</div>
	 </div>
</div>

<div class="box box-info">
	<div class="box-header">
		<h3 class="box-title">Habito de Estudio </h3>
	</div>

	<div class="box-body">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-consdensed ">
					<thead>
						<tr>
							<th rowspan="2" style="text-align:center; vertical-align:middle;">Id</th>
							<th rowspan="2" style="text-align:center; vertical-align:middle;"> Enunciado</th>
							<th colspan="4" style="text-align:center;">Respuesta</th>
						</tr>
						<tr>
							<th style="text-align:center;"> Nunca (1) </th>
							<th style="text-align:center;"> Pocas Veces (2) </th>
							<th style="text-align:center;"> Muchas Veces  (3) </th>
							<th style="text-align:center;"> Siempre (4) </th>
						</tr>
					</thead>
					@php($i=0)
					@php($aux=6)
					<tbody>
						@foreach($tutorTutorado->habitoEstudio->respuestasHabito as $respuestaHabito)
							@php($i++)
							<tr>
								@if($respuestaHabito->idTipoHabito < $aux)
										@php($aux=$respuestaHabito->idTipoHabito)
									<td colspan="6" style="background:#808080;"> <h4 style="color:white;">{{$respuestaHabito->tipoHabito['tipo']}}</h4> </td>
									<tr>
										<td>{{$i}}</td>
										<td>{{$respuestaHabito->enunciado}}</td>
										@switch ($respuestaHabito->pivot->rpta)
												@case ('1')
													<td class="radioCC"> <input type="radio" checked> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													@break
												@case ('2')
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" checked> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													@break
												@case ('3')
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" checked> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													@break
												@case ('4')
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" disabled> </td>
													<td class="radioCC"> <input type="radio" checked> </td>
													@break
										@endswitch
									</tr>
								@else
									<td>{{$i}}</td>
									<td>{{$respuestaHabito->enunciado}}</td>
									@switch ($respuestaHabito->pivot->rpta)
											@case ('1')
												<td class="radioCC"> <input type="radio" checked> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												@break
											@case ('2')
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" checked> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												@break
											@case ('3')
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" checked> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												@break
											@case ('4')
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" disabled> </td>
												<td class="radioCC"> <input type="radio" checked> </td>
												@break
									@endswitch
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	 </div>
</div>

<style type="text/css">
	.radioCC{
		text-align:center;
	}
</style>
<script type="text/javascript">
	var data = [
		[0, {{ ($respuesta_cantidad[0]['cantidad'])*1.85 }}],
		[1, {{ ($respuesta_cantidad[1]['cantidad'])*1.85 }}],
		[2, {{ ($respuesta_cantidad[2]['cantidad'])*1.85 }}],
		[3, {{ ($respuesta_cantidad[3]['cantidad'])*1.85 }}],
	];
	var dataset = [
		{//label:'Respuesta',
		data:data, color: '#3c8dbc'}
	];
	var ticks = [
		[0,'Nunca'], [1,'Pocas Veces'], [2,'Muchas Veces'], [3,'Siempre']
	];
	var data = [
		[0, 10], [1, 80], [2, 20], [3, 50],
	];
	var options = {
		series: {
			bars:   {
				show: true,
			}
		},
		bars:   {
			align: "center",
			barWidth:0.5
		},
		xaxis: {
		 //axisLabel: "World Cities",
		 axisLabelUseCanvas: true,
		 axisLabelFontSizePixels: 15,
		 axisLabelFontFamily: 'Verdana, Arial',
		 axisLabelPadding: 10,
		 ticks: ticks

		},
		yaxis: {
			 //axisLabel: "Average Temperature",
			 axisLabelUseCanvas: true,
			 axisLabelFontSizePixels: 12,
			 axisLabelFontFamily: 'Verdana, Arial',
			 axisLabelPadding: 3,
			 tickFormatter: function (v, axis) {
				  return v + "%";
			 }
		},
		/*legend: {
			 noColumns: 0,
			 labelBoxBorderColor: "#000000",
			 position: "nw"
		},*/
		grid: {
			 hoverable: true,
			 borderWidth: 2,
			 backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
		}
	}
	$(document).ready(function () {
	    $.plot($("#bar-chart"), dataset, options);
	    $("#bar-chart").UseTooltip();
	});
		//color: '#3c8dbc'
		function gd(year, month, day) {
	    return new Date(year, month, day).getTime();
	}

	var previousPoint = null, previousLabel = null;

	$.fn.UseTooltip = function () {
	    $(this).bind("plothover", function (event, pos, item) {
	        if (item) {
	            if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
	                previousPoint = item.dataIndex;
	                previousLabel = item.series.label;
	                $("#tooltip").remove();
	                var x = item.datapoint[0];
	                var y = item.datapoint[1];
	                var color = item.series.color;
	                //console.log(item.series.xaxis.ticks[x].label);
	                showTooltip(item.pageX,
	                        item.pageY,
	                        color,
	                        //"<strong>" + item.series.label + "</strong><br>" +
	                        item.series.xaxis.ticks[x].label + " : <strong>" + y + "</strong> %");
	            }
	        } else {
	            $("#tooltip").remove();
	            previousPoint = null;
	        }
	    });
	};

	function showTooltip(x, y, color, contents) {
	    $('<div id="tooltip">' + contents + '</div>').css({
	        position: 'absolute',
	        display: 'none',
	        top: y - 40,
	        left: x - 120,
	        border: '2px solid ' + color,
	        padding: '3px',
	        'font-size': '9px',
	        'border-radius': '5px',
	        'background-color': '#fff',
	        'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
	        opacity: 0.9
	    }).appendTo("body").fadeIn(200);
}
</script>
@endsection
