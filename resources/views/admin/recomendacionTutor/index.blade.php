@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Tabla1: Recomendaciones para el profesor tutor <a href="recomendaciontutor/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('admin.recomendaciontutor.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Situacion Especifica</th>
						<th>Recomendacion</th>
					</thead>
					@foreach ($situaciones as $sit)
					<tr>
						<td>{{$sit->idTabla1}}</td>
						<td>{{$sit->situacionEspecifica}}</td>
						<td>{{$sit->recomendacion}}</td>
						<td>
							<a href="{{URL::action('RecomendaciontutorController@edit',$sit->idTabla1)}}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$sit->idTabla1}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('admin.recomendaciontutor.modal')
					@endforeach
				</table>
			</div>
			{{$situaciones->render()}}
		</div>
	</div>
@endsection
