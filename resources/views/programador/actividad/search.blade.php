{!! Form::open(['url'=>'programador/actividad', 'method'=>'GET', 'autocomplete'=>'off']) !!}
<div class="form-group">
	<div class="input-group">
		{!! Form::text('titulo', null, ['class'=>'form-control', 'palceholder'=>'Buscar...', 'aria-describedby'=>'titulo']) !!}
		<span class="input-group-btn" id="titulo">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
		{!!Form::hidden('idUserProgramador',$idUserProgramador)!!}
		{!!Form::hidden('idUserResponsable',$idUserResponsable)!!}
		{!!Form::hidden('idUserInscrito',$idUserInscrito)!!}
	</div>
</div>
{!! Form::close() !!}
