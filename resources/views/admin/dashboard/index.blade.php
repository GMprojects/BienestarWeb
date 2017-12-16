@extends('template')
@section('contenido')
<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label for="semestre">Semestre </label>
         <select name="semestre" id="semestre" class="form-control">
            {{--<option value="">Seleccione una Categoría</option>--}}
            <option value="0-0">Todos</option>
            @foreach($semestres as $semestre)
               <option value="{{ $semestre['anioSemestre'].'-'.$semestre['numeroSemestre'] }}">
                     {{ $semestre['anioSemestre'].'-' }}
                     @if ($semestre['numeroSemestre'] == '1')
                        I
                     @else
                        II
                     @endif
               </option>
            @endforeach
         </select>
      </div>
   </div>
</div>
@php
   $anio = '0';
   $numero = '0';
@endphp
<div class="row">
   <div class="col-md-3 col-sm-3 col-xs-6">
      <div class="small-box ff-bg-blue">
         <div class="inner">
          <h3 id="cantPendientes">{{ $estados[0] }}</h3>
          <p>Pendientes</p>
         </div>
         <div class="icon">
            <i class="fa fa-calendar-plus-o"></i>
         </div>
         <a href="" id="ide" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
      </div>
   </div>

   <div class="col-md-3 col-sm-3 col-xs-6">
      <div class="small-box ff-bg-green">
         <div class="inner">
          <h3 id="cantEjecutadas">{{ $estados[1] }}</h3>
          <p>Ejecutadas</p>
         </div>
         <div class="icon">
            <i class="fa fa-thumbs-o-up"></i>
         </div>
         <a href="" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
      </div>
   </div>

   <div class="col-md-3 col-sm-3 col-xs-6">
      <div class="small-box ff-bg-red">
         <div class="inner">
          <h3 id="cantCanceladas">{{ $estados[2] }}</h3>
          <p>Canceladas</p>
         </div>
         <div class="icon">
            <i class="fa fa-calendar-plus-o"></i>
         </div>
         <a href="" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
      </div>
   </div>

   <div class="col-md-3 col-sm-3 col-xs-6">
      <div class="small-box ff-bg-orange">
         <div class="inner">
          <h3 id="cantExpiradas">{{ $estados[3] }}</h3>
          <p>Expiradas</p>
         </div>
         <div class="icon">
            <i class="fa fa-thumbs-o-up"></i>
         </div>
         <a href="" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
      </div>
   </div>
</div>


<script type="text/javascript">
	$.ajaxSetup({
	   headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ready(function(){
      {{--{{ $anio }} = '0';
      {{ $numero }} = '0';--}}
      {{--document.getElementById('ide').setAttribute('href',  {{ action('DashboardController@listarActividades') }});--}}
   });

	$("#semestre").change(function(){
      var semestre = ($(this).val()).split('-');
      console.log(semestre);

      //document.getElementById('anio').innerHTML = semestre[0];
      //document.getElementById('numero').innerHTML = semestre[1];
      {{--{{ $anio }} = semestre[0];
      {{ $numero }} = semestre[1];
      console.log({{ $anio }});--}}
      {{--document.getElementById('ide').setAttribute('href',  {{ action('DashboardController@listarActividades') }});
      document.getElementById('ide').href = {{ action('DashboardController@listarActividades') }};--}}

      //Preparando el AJAX
      $.ajax({
        type:'GET',
        url: '{{ action('DashboardController@reIndex') }}',
        data: {anioSemestre:semestre[0], numeroSemestre:semestre[1]},
        dataType: 'json',
        success:function(data) {
          console.log(data);
          if(data.length != 0){
             document.getElementById('cantPendientes').innerHTML = data[0];
             document.getElementById('cantEjecutadas').innerHTML = data[1];
             document.getElementById('cantCanceladas').innerHTML = data[2];
             document.getElementById('cantExpiradas').innerHTML = data[3];
          }
        },
        error:function() {
           console.log("Error dListaTutores");
        }
      });
	});
   {{--function destino(){
      return {{ action('DashboardController@listarActividades') }};
   }--}}

</script>
@endsection
