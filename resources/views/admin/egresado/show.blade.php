@extends('layouts.admin', ['titulo' => 'Egresado', 'nombreTabla' => '', 'item' => 'egre'])
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Egresado de código   {{$egresado->codigo}}</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="nombre">Nombres</label>
      <input type="text" name="nombre" class="form-control" disabled value ="{{ $egresado->nombre }}" placeholder="Nombres...">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="apellidoPaterno">Apellidos</label>
      <input type="text" name="apellidoPaterno" class="form-control" disabled value ="{{ $egresado->apellidoPaterno }} {{ $egresado->apellidoMaterno }}" placeholder="Apellido Paterno...">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="anioEgreso">Año Egreso</label>
      <input type="text" name="anioEgreso" class="form-control" disabled value ="{{ $egresado->anioEgreso }}" placeholder="Año Egreso...">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="numeroSemestre">Númetro de Semestre </label>
      <input type="text" name="numeroSemestre" class="form-control" disabled value ="{{ $egresado->numeroSemestre }}" placeholder="Semestre ...">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="grado">Grado</label>
      <select name="grado" class="form-control" disabled>
          @if($egresado->grado==1)
            <option value="1" selected>Bachiller</option>
            <option value="2" >Magister</option>
            <option value="3" >Doctor</option>
            <option value="4" >PhD</option>
          @elseif($egresado->grado==2)
            <option value="1" >Bachiller</option>
            <option value="2" selected>Magister</option>
            <option value="3" >Doctor</option>
            <option value="4" >PhD</option>
          @elseif($egresado->grado==3)
            <option value="1" >Bachiller</option>
            <option value="2" >Magister</option>
            <option value="3" selected>Doctor</option>
            <option value="4" >PhD</option>
          @elseif($egresado->grado==4)
            <option value="1" >Bachiller</option>
            <option value="2" >Magister</option>
            <option value="3" >Doctor</option>
            <option value="4" selected>PhD</option>
          @endif
      </select>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="direccion">Direccion</label>
      <input type="text" name="direccion" class="form-control"  disabled value ="{{ $egresado->direccion }}" placeholder="Direccion...">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="telefono">Telefono</label>
      <input type="text" name="telefono" class="form-control" disabled value="{{ $egresado->telefono }}" placeholder="Telefono...">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="celular">Celular</label>
      <input type="text" name="celular" class="form-control" disabled value="{{ $egresado->celular }}" placeholder="Celular...">
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="text" name="email" class="form-control" disabled value="{{ $egresado->email }}" placeholder="Correo Electrónico...">
    </div>
  </div>
</div>
<h3> Lsita de Trabajos </h3>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Institución</th>
					<th>Lugar</th>
					<th>Inicio</th>
					<th>Fin</th>
					<th>Nivel Satisfacción</th>
					<th>Recomendaciones</th>
					<th>Observaciones</th>
					<th>Opciones</th>
				</thead>

				@foreach($egresado->trabajos as $trabajo)
					<tr>
						<td>{{ $trabajo->idTrabajo }}</td>
						<td>{{ $trabajo->institucion }}</td>
						<td>{{ $trabajo->lugar }}</td>
						<td>{{ $trabajo->fechaInicio }}</td>
						<td>{{ $trabajo->fechaFin }}</td>
						<td>{{ $trabajo->nivelSatisfaccion }}</td>
						<td>{{ $trabajo->recomendaciones }}</td>
						<td>{{ $trabajo->observaciones }}</td>
						<td>
								<a href="{{URL::action('TrabajoController@edit',$trabajo->idTrabajo)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target = "#modal-delete-{{ $trabajo->idTrabajo }}" data-toggle = "modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('admin.trabajo.modal')
				@endforeach

			</table>
		</div>
	</div>
</div>
@endsection
