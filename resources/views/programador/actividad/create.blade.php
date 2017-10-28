@extends('template')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
   </div>
</div>
{!! Form::open(['url'=>'programador/actividad', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true']) !!}
{{ Form::token() }}
   <div class="caja">
      <div class="caja-header">
         <div class="caja-icon">1</div>
         <div class="caja-title">Datos Generales</div>
      </div>
      <div class="caja-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="titulo">Título de la actividad *</label>
                  <input type="text" name="titulo" class="form-control"  required value ="{{old('titulo')}}" placeholder="De preferencia un título corto y llamativo">
               </div>
					<div class="form-group">
						<label for="idTipoActividad">Categoría *</label>
						<select name="idTipoActividad" id="selectIdTipoActividad"  required class="form-control">
							<option value="">Seleccione una Categoría</option>
							@foreach($tiposActividad as $tipo)
								<option value="{{$tipo->idTipoActividad}}">{{$tipo->tipo}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
					  <label for="titulo">Descripción *</label>
						<textarea style="resize: none;" name="descripcion"  class="form-control" required value ="{{old('descripcion')}}"  rows="6" cols="30" placeholder="Describir una breve reseña de Evento"></textarea>
				  	</div>
					<div class="form-group">
						<label for="titulo">Información Adicional </label>
						<textarea style="resize: none;" name="informacionAdicional"  class="form-control" value ="{{old('informacionAdicional')}}"  rows="6" cols="30" placeholder="Añadir información Adicional"></textarea>
					</div>
            </div>
				<div class="col-md-6">
					<div class="form-control-file">
						<label for="rutaImagen">Imagen</label>
						<input type="file" name="rutaImagen" class="form-control dropify"  data-allowed-file-extensions="png jpg jpge"  data-disable-remove="true">
					</div>
            </div>
         </div>
		</div>
      <div class="caja-footer">
      </div>
   </div>

	<div class="caja">
		<div class="caja-header">
			<div class="caja-icon">2</div>
			<div class="caja-title">Datos </div>
		</div>
		<div class="caja-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="fechaProgramacion">Fecha de Programación *</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" name="fechaProgramacion" class="form-control" required  placeholder="{{ date("d/m/Y") }}" id="datepicker1">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="bootstrap-timepicker">
						<div class="form-group">
							<label for="horaProgramacion">Hora de Programación *</label>
							<div class="input-group">
								<div class="input-group-addon">
								  <i class="fa fa-clock-o"></i>
								</div>
								<input type="text" name="horaProgramacion"  required  class="form-control timepicker">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="caja-footer"></div>
	</div>
{!! Form::close() !!}
@endsection
