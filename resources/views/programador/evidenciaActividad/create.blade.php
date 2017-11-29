@extends('template')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Trabajo</h3>
			 @if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			{!! Form::open(['url'=>'programador/evidenciaActividad', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true']) !!}
			{{ Form::token() }}
					<input type="hidden" name="idActividad"  value ="{{$idActividad}}" >

        	<div class="form-group">
	  					<label for="ruta">Archivo y/o Imagen</label>
	  					<input type="file" name="ruta" class="form-control">
    	  	</div>

			   <div class="form-group">
  						<button class="btn btn-primary" type="submit"> Guardar</button>
  						<button class="btn btn-danger" type="reset"> Cancelar</button>
				 </div>
			{!! Form::close() !!}

		</div>
	</div>
@endsection
