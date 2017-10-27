@extends('layouts.admin', ['titulo' => 'Tipos de Hábitos de Estudio', 'nombreTabla' => 'tabTiposHabito', 'item' => 'encuHabitTipoH'])
@section ('contenido')
<div class="box box-info">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-6">
				<h3 class="box-title">Lista de Tipos de Hábito </h3>
			</div>
			<div class="col-xs-6" style="text-align:right;">
				<a href="tipoHabito/create"><button class="btn btn-success">Nueva Tipo</button></a>
			</div>
		</div>

	</div>

	<div class="box-body">
			<div class="table">
					<div class="table-responsive">
						<table id="tabTiposHabito" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<th>Id</th>
								<th>Nombre</th>
								<th>Estado</th>
								<th>Opciones</th>
							</thead>
							@foreach($tiposHabito as $tipoHabito)
							<tr>
								<td>{{$tipoHabito->idTipoHabito}}</td>
								<td>{{$tipoHabito->tipo}}</td>
								@if ($tipoHabito->estado == 1)
									<td style="text-align: center;"><small class="label pull-right bg-green">Activo</small></td>
								@else
									<td><small class="label pull-right bg-red">Inactivo</small></td>
								@endif
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
</div>
@endsection
