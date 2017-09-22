{!! Form::open(['url'=>'programador/actividad', 'method'=>'GET', 'autocomplete'=>'off']) !!}
<div class="form-group">
	<div class="input-group">
		{!! Form::text('titulo', null, ['class'=>'form-control', 'palceholder'=>'Buscar...', 'aria-describedby'=>'titulo']) !!}
		<span class="input-group-btn" id="titulo">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
		{!!Form::hidden('idPersonaProgramador',$idPersonaProgramador)!!}
		{!!Form::hidden('idPersonaResponsable',$idPersonaResponsable)!!}
		{!!Form::hidden('idPersonaInscrito',$idPersonaInscrito)!!}
	</div>
</div>
{!! Form::close() !!}
