@extends('layouts.admin', ['titulo' => 'Tipos de Habito', 'nombreTabla' => '', 'item' => 'encuHabitTipoH'])
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Tipos de Hábito <a href="tipoHabito/create"><button class="btn btn-success">Nuevo </button></a></h3>
		@include('admin.tipoHabito.search')
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
				@foreach($tiposHabito as $tipoHabito)
				<tr>
					<td>{{$tipoHabito->idTipoHabito}}</td>
					<td>{{$tipoHabito->tipo}}</td>
					<td>
						<a href="{{URL::action('TipoHabitoController@edit',$tipoHabito->idTipoHabito)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$tipoHabito->idTipoHabito}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.tipoHabito.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
