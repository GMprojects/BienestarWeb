@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>
				Preguntas de Encuesta
				<a href="{{ action('PreguntaEncuestaController@create',['idEncuesta' => $idEncuesta ])}}"><button class="btn btn-success">Nuevo </button></a>
		</h3>
		@include('admin.preguntaEncuesta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Enunciado</th>
					<th>Opciones</th>
				</thead>
				@foreach($preguntasEncuesta as $preguntaEncuesta)
				<tr>
					<td>{{$preguntaEncuesta->idPreguntaEncuesta}}</td>
					<td>{{$preguntaEncuesta->enunciado}}</td>
					<td>
						<a href="{{URL::action('PreguntaEncuestaController@edit',$preguntaEncuesta->idPreguntaEncuesta)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$preguntaEncuesta->idPreguntaEncuesta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.preguntaEncuesta.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
