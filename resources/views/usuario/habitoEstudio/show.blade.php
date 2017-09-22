@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Hábito de Estudio {{$habitoEstudio->tutorTutorado['anioSemestre']}} - {{$habitoEstudio->tutorTutorado['numeroSemestre']}}</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Enunciado</th>
					<th>Respuesta</th>
				</thead>
				@php($i=0)
				@php($aux=0)
				@foreach($habitoEstudio->preguntasHabito as $preguntaHabito)
					@php($i++)
					<tr>
						@if($preguntaHabito->idTipoHabito>$aux)
							@php($aux=$preguntaHabito->idTipoHabito)
							<td colspan="6">{{$preguntaHabito->tipoHabito['tipo']}}</td>
							<tr>
								<td>{{$i}}</td>
								<td>{{$preguntaHabito->enunciado}}</td>
								@switch ($preguntaHabito->pivot->rpta)
								        @case ('0')
													<td>No</td>
													@break
												@case ('1')
													<td>Pocas Veces</td>
													@break
												@case ('2')
													<td>Muchas Veces</td>
													@break
												@case ('3')
													<td>Sí</td>
													@break
								@endswitch
							</tr>
						@else
							<td>{{$i}}</td>
							<td>{{$preguntaHabito->enunciado}}</td>
							@switch ($preguntaHabito->pivot->rpta)
							        @case ('0')
												<td>No</td>
												@break
											@case ('1')
												<td>Pocas Veces</td>
												@break
											@case ('2')
												<td>Muchas Veces</td>
												@break
											@case ('3')
												<td>Sí</td>
												@break
							@endswitch
						@endif
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
