{!!Form::open(['url'=>'admin/trabajo','method'=>'GET','autocomplete'=>'off'])!!}
<div class="form-group">
	<div class="input-group">
		{!!Form::text('institucion',null,['class'=>'form-control', 'placeholder'=>'Buscar...','aria-describedby'=>'search'])!!}
		<span class="input-group-btn" id="search">
			<button type="submit" class="btn btn-primarry">Buscar </button>
		</span>
		{!!Form::hidden('idEgresado',$idEgresado)!!}
	</div>
</div>
{!!Form::close()!!}
