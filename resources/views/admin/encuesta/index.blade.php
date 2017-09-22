@extends('layouts.admin', ['titulo' => 'Encuestas', 'nombreTabla' => 'tabEncuestas', 'item' => 'encuTodas'])
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Encuestas <a href="encuesta/create"><button class="btn btn-success">Nuevo </button></a></h3>
		@include('admin.encuesta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table">
			<table id="tabEncuestas" class="table table-striped table-bordered table-consdensed table-hover dt-responsive nowrap">
				<thead>
					<th>Id</th>
					<th>Título</th>
					<th>Tipo Actividad</th>
					<th>Destino</th>
					<th>Modificar</th>
					<th>Opciones</th>
				</thead>
				@foreach($encuestas as $encuesta)
				<tr>
					<td>{{$encuesta->idEncuesta}}</td>
					<td>{{$encuesta->titulo}}</td>
					<td>{{$encuesta->tipoActividad['tipo']}}</td>
					@if($encuesta->destino === 'r')
						<td>Responsable</td>
					@else
						<td>Inscrito</td>
					@endif
					<td>
						<a href="{{ action('AlternativaController@index',['texto' => $encuesta->idEncuesta ])}}"><button class="btn btn-info">Alternativas</button></a>
						<a href="{{ action('PreguntaEncuestaController@index',['idEncuesta' => $encuesta->idEncuesta ])}}"><button class="btn btn-warning">Preguntas Encuesta</button></a>
					</td>
					<td>
						<a href="{{URL::action('EncuestaController@edit',$encuesta->idEncuesta)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$encuesta->idEncuesta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						<a href="{{URL::action('EncuestaController@show',$encuesta->idEncuesta)}}"><button class="btn btn-warning">Vista Preliminar</button></a>
					</td>
				</tr>
				@include('admin.encuesta.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
