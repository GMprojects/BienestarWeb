<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	{!! Form::open(['action'=>'InscripcionADAController@index', 'method'=>'GET', 'autocomplete'=>'off']) !!}
	<div class="form-group">
		<div class="input-group">
			{!!Form::hidden('idActividad',$idActividad)!!}
			{!!Form::hidden('opcionBuscar',$opcionBuscar)!!}
				<span class="input-group-btn">
					<button  id="ejecutar" class="btn sinFondo">Buscar</button>
				</span>
				<input type="text" name="nombre" id="nombre"  class="form-control" onkeyup="filtrar(this)" value="{{$nombre}}" palceholder="Buscar...">
		</div>
	</div>
	{!! Form::close() !!}
</div>
