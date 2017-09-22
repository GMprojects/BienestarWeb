@extends('layouts.admin', ['titulo' => 'Usuarios', 'nombreTabla' => 'tabPersonas', 'item' => 'usuTodos'])
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Listado de Tipos de Persona <a href="tipoPersona/create"><button class="btn btn-success">Nuevo </button></a></h3>
		@include('admin.tipoPersona.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</thead>
				@foreach($tiposPersona as $tipoPersona)
				<tr>
					<td>{{$tipoPersona->idTipoPersona}}</td>
					<td>{{$tipoPersona->tipo}}</td>
					<td>
						<a href="{{URL::action('TipoPersonaController@edit',$tipoPersona->idTipoPersona)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$tipoPersona->idTipoPersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.tipoPersona.modal')
				@endforeach
			</table>
		</div>
		{{$tiposPersona->render()}}
	</div>
</div>
@endsection
