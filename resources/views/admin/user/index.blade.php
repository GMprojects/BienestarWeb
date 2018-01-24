@extends('template')
@section('contenido')
		<div class="box box-info">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-6">
						<h3 class="box-title">Todos los Usuarios</h3>
					</div>
					<div class="col-xs-6" style="text-align:right;">
						<a href="user/create"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nuevo Usuario</button></a>
					</div>
				</div>

			</div>

			<div class="box-body">
				<div class="table">
					<table id="tabUsers" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<th>Código</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Email</th>
							<th>Funcion</th>
							<th>Tipo</th>
							<th>Opciones</th>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{ $user->codigo }}</td>
								<td>{{$user->nombre}}</td>
								<td>{{$user->apellidoPaterno}} {{$user->apellidoMaterno}} </td>
								<td>{{$user->email}}</td>
								@switch( $user->funcion)
									@case(3) <td><span class="label label-danger rounded">Administrador</span></td> @break
									@case(2) <td><span class="label label-warning rounded">Programador</span></td> @break
									@case(1) <td><span class="label label-success rounded">Miembro</span></td> @break
								@endswitch
								@switch( $user->idTipoPersona)
									@case(1) <td><span class="label label-success rounded">Alumno</span></td> @break
									@case(2) <td><span class="label label-warning rounded">Docente</span></td> @break
									@case(3) <td><span class="label label-danger rounded">Administrativo</span></td> @break
								@endswitch
								<td>
									<a href="{{URL::action('UserController@edit',$user->id)}}">
										<button class="btn btn-ff-yellow" data-toggle="tooltip" data-placement="bottom" title="Editar Usuario">
											<i class="fa fa-edit"></i>
										</button>
									</a>
									<a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal">
										<button class="btn btn-ff-red" data-toggle="tooltip" data-placement="bottom" title="Eliminar Usuario">
											<i class="fa fa-trash"></i>
										</button>
									</a>
								</td>
							</tr>
							@include('admin.user.modal')
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

	<script>
	   $(document).ready(function() {
	      $('#tabUsers').DataTable({
	         "lengthMenu": [ 10, 25, 50, 75, 100 ],
	         "oLanguage" : {
	            "sProcessing":     "Procesando...",
	            "sLengthMenu":     "Mostrar _MENU_ registros",
	            "sZeroRecords":    "No se encontraron resultados",
	            "sEmptyTable":     "Ningún dato disponible en esta tabla",
	            "sInfo":           "Reg. actuales: _START_ - _END_ / Reg. totales: _TOTAL_",
	            "sInfoEmpty":      "Reg. actuales: 0 - 0 / Reg. totales: 0",
	            "sInfoFiltered":   "(filtrado de un total _MAX_ registros)",
	            "sInfoPostFix":    "",
	            "sSearch":         "Buscar:",
	            "sUrl":            "",
	            "sInfoThousands":  ",",
	            "sLoadingRecords": "Cargando...",
	            "oPaginate": {
	              "sFirst":    "Primero",
	              "sLast":     "Último",
	              "sNext":     "Sig",
	              "sPrevious": "Ant"
	            },
	            "oAria": {
	              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
				  }
	         },
				"order":[[2,"asc"]]
	      })
	   });
	</script>

@endsection
