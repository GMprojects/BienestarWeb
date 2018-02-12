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
			@if ($user->sexo == 'm')
				<label>&nbsp; &nbsp; <i class="fa fa-user margin-r-5"></i>&nbsp; &nbsp;<b>Alumna: </b> </label>
			@else
				<label>&nbsp; &nbsp; <i class="fa fa-user margin-r-5"></i>&nbsp; &nbsp;<b>Alumno: </b> </label>
			@endif
			<b>  &nbsp; &nbsp; {{ $user->nombre.' '.$user->apellidoPaterno.' '.$user->apellidoMaterno }}</b>&nbsp; &nbsp; <br>
			<div class="pull-right"><label>&nbsp; &nbsp; <i class="fa fa-calendar margin-r-5"></i>&nbsp; &nbsp;<b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $tutorTutorado->anioSemestre.'-'.$tutorTutorado->numeroSemestre }}</div>
			<label>&nbsp; &nbsp; <i class="fa fa-qrcode margin-r-5"></i>&nbsp; &nbsp;<b>Código: </b></label> <b>  &nbsp; &nbsp; {{ $user->codigo }}</b>&nbsp; &nbsp; <br>
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
			@php($i=0)
			@php($total=0)
			@foreach ( $encuesta->alternativas as $alternativa )
				<label>&nbsp; &nbsp;  {{ $alternativa->etiqueta }} ({{ $alternativa->valor }}) : </label> {{ $respuesta_cantidad[$i] }} <br>
				@php($total = $total + ($respuesta_cantidad[$i]*$alternativa->valor))
				@php($i++)
			@endforeach
			<br>
			<label style="color:#4B367C">Totales: </label><br>
			<br>
			<label>&nbsp; &nbsp;  Total : </label> {{ $total }} ptos.<br>
		</div>
	 </div>
</div>

<div class="row">
	 <div class="col-md-12">
		  <div class="box box-info">
			  <div class="box-header">
			  		<h3 class="box-title">Hábitos de Estudio</h3>
			  	</div>
			   <div class="box-body">
					<!--fin  -->
				  <p style="font-size: 1.3em;"> <strong>Respuestas del alumno.</strong> </p>
				  <!-- NOTA NO-SECCION:  por si hay preguntas que no están dentro de alguna sección -->
				  @if(count($encuesta->preguntas->where('idSeccion', null))> 0)
					  <div class="no-sec-items items">
						  <div class="alternatives hidden-xs hidden-sm">
							  @foreach ( $encuesta->alternativas as $alternativa )
								  <div class="alternative alt-header"  style="width:calc(100%/{{ count($encuesta->alternativas) }}); ">
									 <span>{{ $alternativa->etiqueta }}</span>
								 </div>
							  @endforeach
						  </div>
						  <ol class="enc-list">
							  @foreach ($encuesta->preguntas->where('idSeccion', null) as $pregunta)
								<div class="item">
									<div class="question">
									  <li>
										  <span class="quest-text">
											  {{ $pregunta->enunciado }}
										  </span>
									 </li>
									</div>
									<div class="alternatives">
										@foreach ( $encuesta->alternativas as $alternativa )
											<div class="alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }});">
												<input required type="radio" name="{{ $pregunta->idPregunta }}" value="{{ $alternativa->valor }}"><label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
											</div>
										@endforeach
									</div>
								</div>
								@endforeach
						  </ol>
					  </div>
				  @endif
				  <!-- FIN de la NOTA NO-SECCION-->

				  @if(count($encuesta->secciones) > 0)
					  <div class="secciones">
						  @foreach ($encuesta->secciones as $seccion)
							  <div class="seccion">
								  <div class="s-header">
									  <div class="s-icon"> {{ $seccion->orden }} </div>
									  <div class="s-title"> {{ $seccion->titulo }} </div>
								  </div>
								  <div class="s-body">
									  <div class="s-description"> {{ $seccion->descripcion }} </div>
									  <div class="items">
										  <div class="alternatives hidden-xs hidden-sm">
											  @foreach ( $encuesta->alternativas as $alternativa )
												  <div class="alternative alt-header"  style="width:calc(100%/{{ count($encuesta->alternativas) }}); ">
													 <span>{{ $alternativa->etiqueta }}</span>
												 </div>
											  @endforeach
										  </div>
										  <ol class="enc-list">
											  @php($i = 0)
											  @foreach ($seccion->preguntas as $pregunta)
												@php($i++)
												<div class="item">
													<div class="question">
													  <li>
														  <span class="quest-text">
															  {{ $pregunta->enunciado }}
														  </span>
													 </li>
													</div>
													<div class="alternatives">
														@foreach ( $encuesta->alternativas as $alternativa )
															<div class="alternative"  style="width:calc(100%/{{ count($encuesta->alternativas) }});">
															   @if ( $alternativa->valor == $respuestas[$i]->respuesta )
															   	<input  type="radio" checked name="{{ $pregunta->idPregunta }}" value="{{ $alternativa->valor }}"><label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
															   @else
															   	<input disabled type="radio" name="{{ $pregunta->idPregunta }}" value="{{ $alternativa->valor }}"><label class="hidden-lg hidden-md">{{ $alternativa->etiqueta }}</label>
															   @endif
															</div>
														@endforeach
													</div>
												</div>
												@endforeach
										  </ol>
									  </div>
								  </div>
							  </div>
						  @endforeach
					  </div>
				  @endif
			   </div>
		  </div>
	 </div>
</div>

<script type="text/javascript">

var data = new Array();
@for ($i=0; $i < count($alternativas); $i++)
	data[{{ $i }}] = [{{ $i }}, {{ ($respuesta_cantidad[$i])*1.85 }}];
@endfor

var dataset = [
	{//label:'Respuesta',
	data:data, color: '#3c8dbc'}
];

var ticks = new Array();
@for ($i=0; $i < count($alternativas); $i++)
	ticks[{{ $i }}] = [{{ $alternativas[$i]['valor'] }}, '{{ $alternativas[$i]['etiqueta'] }}'];
@endfor

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

$(document).ready(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%' // optional
	});
	$('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });

	$.plot($("#bar-chart"), dataset, options);
	$("#bar-chart").UseTooltip();

});

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
