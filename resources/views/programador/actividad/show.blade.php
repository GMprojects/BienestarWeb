@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Actividad ID {{$actividad->idActividad}} | {{ $actividad->anioSemestre }} - {{ $actividad->numeroSemestre }}</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="tipoActividad">Tipo Actividad</label>
      <input type="text" name="tipoActividad" class="form-control" disabled value ="{{ $actividad->tipoActividad['tipo'] }}" >
    </div>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="titulo">Título</label>
      <input type="text" name="titulo" class="form-control" disabled value ="{{ $actividad->titulo }}" >
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="fechaProgramacion">Fecha de Programación</label>
      <input type="text" name="fechaProgramacion" class="form-control" disabled value ="{{ $actividad->fechaProgramacion }}" >
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="horaProgramacion">Hora de Programación</label>
      <input type="text" name="horaProgramacion" class="form-control" disabled value ="{{ $actividad->horaProgramacion }}"  >
    </div>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="lugar">Lugar</label>
      <input type="text" name="lugar" class="form-control" disabled value ="{{ $actividad->lugar }}"  >
    </div>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="modalidad">Modalidad</label>
			@switch($actividad->modalidad)
				@case(1)
	      <input type="text" name="modalidad" class="form-control" disabled value ="Individual" >
					@break
				@case(2)
	      <input type="text" name="modalidad" class="form-control" disabled value ="Grupal" >
					@break
			@endswitch
    </div>
  </div>
	@if($actividad->cuposTotales == 0)
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="cuposTotales">Número de Cupos Totales</label>
				<input type="text" name="cuposTotales" class="form-control" disabled value ="Libre" >
			</div>
		</div>
	@elseif ($actividad->cuposTotales > 1)
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="cuposTotales">Número de Cupos Totales</label>
				<input type="text" name="cuposTotales" class="form-control" disabled value ="{{ $actividad->cuposTotales}}" >
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="cuposDisponibles">Número de Cupos Ocupados</label>
				<input type="text" name="cuposDisponibles" class="form-control" disabled value ="{{ $actividad->actividadesGrupal[0]->cuposOcupados}}" >
			</div>
		</div>
	@endif
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="estado">Estado</label>
			@switch($actividad->estado)
				@case(1)
	      <input type="text" name="estado" class="form-control" disabled value ="Programada" >
					@break
				@case(2)
	      <input type="text" name="estado" class="form-control" disabled value ="Ejecutada" >
					@break
				@case(3)
	      <input type="text" name="estado" class="form-control" disabled value ="Cancelada" >
					@break
				@case(4)
	      <input type="text" name="estado" class="form-control" disabled value ="No ejecutada" >
					@break
			@endswitch
    </div>
  </div>
	@if ($actividad->estado == 2)
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
	      <label for="fechaEjecutada">Fecha de Ejecución</label>
	      <input type="text" name="fechaEjecutada" class="form-control" disabled value ="{{ $actividad->fechaEjecutada}}" >
	    </div>
	  </div>
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
	      <label for="anioEgreso">Hora de Ejecución</label>
	      <input type="text" name="horaEjecutada" class="form-control" disabled value ="{{ $actividad->horaEjecutada}}" >
	    </div>
	  </div>
	@endif
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="programador">Programador</label>
      <input type="text" name="programador" class="form-control" disabled value ="{{ $actividad->programador['nombre']}} {{ $actividad->programador['apellidoPaterno']}} {{ $actividad->programador['apellidoMaterno']}}"  >
    </div>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label for="responsable">Responsable</label>
      <input type="text" name="responsable" class="form-control" disabled value ="{{ $actividad->responsable['nombre']}} {{ $actividad->responsable['apellidoPaterno']}} {{ $actividad->responsable['apellidoMaterno']}}"  >
    </div>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				@if(($actividad->rutaImagen)!="")
					<img src="{{asset('imagenes/actividades/'.$actividad->rutaImagen)}}" alt="{{ $actividad->idActividad}}" height="300em" width="300em">
				@else
					<img src="{{asset('imagenes/tipoActividad/'.$actividad->tipoActividad['rutaImagen'])}}" alt="Imagen Actividad" height="300em" width="300em">
				@endif
		</div>
	</div>
</div>
@if ($actividad->estado == 2)
	<a href="{{ action('InscripcionADAController@index',['idActividad' => $actividad->idActividad]) }}"><button class="btn btn-success">Ver Inscripciones </button></a>
	<a href="{{ action('EvidenciaActividadController@index',['idActividad' => $actividad->idActividad])}}"><button class="btn btn-success">Ver Evidencias </button></a>

	@switch($actividad->idTipoActividad)
		@case(1)
		@case(2)
					@break
		@case(4)
			<a href="{{ action('ActividadController@show',['idActividad' => $actividad->idActividad])}}"><button class="btn btn-info">Ver Más </button></a>
			<a href="{{ action('ActividadController@edit',['idActividad' => $actividad->idActividad]) }}"><button class="btn btn-warning">Editar</button></a>
					@break
		@case(3)
		@case(5)
		@case(6)
		@case(7)
		@case(10)
					@break
		@case(8)
			<a href="{{ action('BeneficiarioMovilidadController@index',['idActividadMovilidad' => $actividad->actividadesMovilidad[0]->idActMovilidad])}}"><button class="btn btn-info">Beneficiarios</button></a>
					@break
			<a href="{{ action('AlumnoController@showBeneficiarioComedor',['idActividadComedor' => $actividad->actividadesComedor[0]->idActividadComedor])}}"><button class="btn btn-info">Beneficiarios </button></a>
		@case(9)
					@break
		@case(11)
					@break
	@endswitch
@endif

@endsection
