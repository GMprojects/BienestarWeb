@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Preguntas de Encuesta de Hábitos de Estudio
			<a href="preguntaHabito/create">
				<button class="btn btn-success">Nuevo </button>
			</a>
		</h3>
		@include('admin.preguntaHabito.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Enunciado</th>
					<th>Tipo de Hábito</th>
					<th>Opciones</th>
				</thead>
				@foreach($preguntasHabito as $preguntaHabito)
				<tr>
					<td>{{$preguntaHabito->idPreguntaHabito}}</td>
					<td>{{$preguntaHabito->enunciado}}</td>
					<td>{{$preguntaHabito->tipoHabito['tipo']}}</td>
					<td>
						<a href="{{URL::action('PreguntaHabitoController@edit',$preguntaHabito->idPreguntaHabito)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$preguntaHabito->idPreguntaHabito}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.preguntaHabito.modal')
				@endforeach
			</table>
		</div>
		{{$preguntasHabito->render()}}
	</div>
</div>
@endsection
