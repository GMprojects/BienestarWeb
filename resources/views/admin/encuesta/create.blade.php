@extends('template')
@section ('contenido')
{!!Form::open(['url'=>'admin/encuesta','method'=>'POST','autocomplete'=>'off'])!!}
{{Form::token()}}
<div class="row">
	<div class="col-md-12">
		<div class="caja">
			<div class="caja-header">
		      <div class="caja-icon">1</div>
		      <div class="caja-title">Datos de la Nueva Encuesta</div>
		   </div>

			<div class="caja-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						@if(count($errors)>0)
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
									<li> {{$error}} </li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="titulo">Título</label>
							<input type="text" name="titulo"  required value ="{{old('titulo')}}" class="form-control" placeholder="Título">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						 <div class="form-group">
							<label for="idTipoActividad">Categoría de Actividad</label>
							<select name="idTipoActividad" class="form-control">
								<option value="{{$tipo->idTipoActividad}}">Seleccione una categoría</option>
								@foreach($tiposActividad as $tipo)
									<option value="{{$tipo->idTipoActividad}}">{{$tipo->tipo}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						 <div class="form-group">
							<label for="destino">Dirigido A</label>
							<select name="destino" class="form-control">
									<option value="r">Responsable</option>
									<option value="i">Inscrito</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="caja-footer">
				<div class="pull-right">
					<button class="btn btn-ff" type="submit"><i class="fa fa-save"></i> Guardar </button>
					<button class="btn btn-ff-red" type="reset"><i class="fa fa-eraser"></i> Cancelar</button>
				</div>
			</div>
		</div>
	</div>
</div>
{!!Form::close()!!}
@endsection
