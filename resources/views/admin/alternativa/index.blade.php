@extends('layouts.admin', ['titulo' => 'Alternativa', 'nombreTabla' => '', 'item' => 'encuTodas'])
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>
				Alternativas de la Encuesta
				<a href="{{ action('AlternativaController@create',['idEncuesta' => $idEncuesta ])}}"><button class="btn btn-success">Nuevo </button></a>
		</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Etiqueta</th>
					<th>Opciones</th>
				</thead>
				@foreach($alternativas as $alternativa)
				<tr>
					<td>{{$alternativa->idAlternativa}}</td>
					<td>{{$alternativa->etiqueta}}</td>
					<td>
						<a href="{{URL::action('AlternativaController@edit',$alternativa->idAlternativa)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$alternativa->idAlternativa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.alternativa.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
