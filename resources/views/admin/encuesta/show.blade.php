@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>
      Encuesta de {{$encuesta->tipoActividad['tipo']}} para
      @if($encuesta->destino == 'r')
        Responsable
      @else
        Isncrito
      @endif
    </h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-consdensed table-hover">
				<thead>
					<th>Id</th>
					<th>Enunciado</th>
          @foreach($encuesta->alternativas as $alternativa)
            <th>d</th>
          @endforeach
				</thead>
				@php($i=0)
				@php($aux=0)

			</table>
		</div>
	</div>
</div>
@endsection
