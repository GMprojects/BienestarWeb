{!!Form::open(['url'=>'admin/preguntaHabito','method'=>'GET','autocomplete'=>'off'])!!}
<div class="form-group">
	<div class="input-group">
		{!!Form::text('enunciado',null,['class'=>'form-control', 'placeholder'=>'Buscar...','aria-describedby'=>'search'])!!}		
		<span class="input-group-btn" id="search">
			<button type="submit" class="btn btn-primarry">Buscar </button>
		</span>
	</div>
</div>
{!!Form::close()!!}