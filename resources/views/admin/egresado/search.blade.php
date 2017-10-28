{!! Form::open(['url'=>'admin/egresado', 'method'=>'GET', 'autocomplete'=>'off']) !!}
<div class="form-group">
	<div class="input-group">
		{!! Form::text('texto', null, ['class'=>'form-control', 'palceholder'=>'Buscar...', 'aria-describedby'=>'texto']) !!}
		<span class="input-group-btn" id="texto">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>
{!! Form::close() !!}