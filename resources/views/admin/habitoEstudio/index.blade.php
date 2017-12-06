@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Mi Hábito de Estudio </h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Año</th>
					<th>Semestre</th>										
					<th>Fecha de Respuesta</th>
					<th>Ver</th>
				</thead>
				@php($i=0)
				@foreach($habitosEstudio as $habitoEstudio)
				@php($i++)
				<tr>
					<td>{{$i}}</td>
					<td>{{$habitoEstudio->tutorTutorado['anioSemestre']}}</td>
					<td>{{$habitoEstudio->tutorTutorado['numeroSemestre']}}</td>
					<td>{{$habitoEstudio->created_at}}</td>
					<td>
						<a href="{{URL::action('HabitoEstudioController@show',$habitoEstudio->idHabitoEstudio)}}"><button class="btn btn-warning">Ver</button></a>
					</td>
				</tr>
				@endforeach
				@foreach($tutorTutorados as $tutorTutorado)
				@php($i++)
				<tr>
					<td>{{$i}}</td>
					<td>{{$tutorTutorado->anioSemestre}}</td>
					<td>{{$tutorTutorado->numeroSemestre}}</td>
					<td> - </td>
					<td>
						<a href="habitoEstudio/create"><button class="btn btn-success">Llenar</button></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$habitosEstudio->render()}}
	</div>
</div>
@endsection
