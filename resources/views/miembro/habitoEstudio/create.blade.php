@extends ('template')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			{!!Form::open(['url'=>'alumno/habitoEstudio','method'=>'POST','autocomplete'=>'off'])!!}
			{{Form::token()}}
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-consdensed table-hover">
					<thead>
						<th>Id</th>
						<th>Enunciado</th>
						<th>No</th>
						<th>Pocas Veces</th>
						<th>Muchas Veces</th>
						<th>Si</th>
					</thead>
					@php($aux=0)
					@php($i=0)
					@foreach($preguntasHabito as $preguntaHabito)
						@php($i++)
						<tr>
							@if($preguntaHabito->idTipoHabito > $aux)
								@php($aux=$preguntaHabito->idTipoHabito)
								<td colspan="6">{{$preguntaHabito->tipoHabito['tipo']}}</td>
								<tr>
									<td>{{$i}}</td>
									<td>{{$preguntaHabito->enunciado}}</td>
									<td>
										<input  type="radio" value="1" required name="respuestasHabito[{{$i}}]">
									</td>
									<td>
										<input  type="radio" value="2"  name="respuestasHabito[{{$i}}]">
									</td>
									<td>
										<input  type="radio" value="3"  name="respuestasHabito[{{$i}}]">
									</td>
									<td>
										<input  type="radio" value="4"  name="respuestasHabito[{{$i}}]">
									</td>

								</tr>
							@else
								<td>{{$i}}</td>
								<td>{{$preguntaHabito->enunciado}}</td>
								<td>
									<input  type="radio" value="1" required  name="respuestasHabito[{{$i}}]">
								</td>
								<td>
									<input  type="radio" value="2"   name="respuestasHabito[{{$i}}]">
								</td>
								<td>
									<input  type="radio" value="3"  name="respuestasHabito[{{$i}}]">
								</td>
								<td>
									<input  type="radio" value="4"  name="respuestasHabito[{{$i}}]">
								</td>
							@endif
						</tr>
					@endforeach
				</table>
				<button class="btn btn-primary" type="submit">Guardar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
