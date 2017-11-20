@extends('template')
@section('contenido')
@php($valorAux = 0)
<div class="box box-info">
  <div class="box-header">
    <div class="row">
      <div class="col-xs-6">
        <h3 class="box-title">Lista de Inscritos</h3>
      </div>
    </div>
  </div>

  <div class="box-body">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
  			<h3>Inscripciones
          @switch ($opcionBuscar)
            @case ('1')
              de Alumnos
              @break;
            @case ('2')
              de Docentes
              @break;
            @case ('3')
              de Administrativos
              @break
            @default
              @break
          @endswitch
        </h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
        <div class="card">
          <h5 class="text-bold"> {{ $numAsistentes }} </h5>
          <h4> Asistentes  </h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
        <div class="card">
          <h5 class="text-bold">  {{ $numAusentes }}  </h5>
          <h4> Ausentes </h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
        <div class="card">
          <h5 class="text-bold">  {{ $numInscritos }}  </h5>
          <h4> Inscritos </h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-4">
        <div class="card">
          <h5 class="text-bold">
            @if ($numInscritos != 0)
              @php($porcentajeAsistencia = round(($numAsistentes/$numInscritos)*100))
           @else
              @php($porcentajeAsistencia=0)
           @endif
            {{ $porcentajeAsistencia }}%
          </h5>
          <h4> Asistencia </h4>
        </div>
      </div>
    </div>
    <br><br>
    <div class="row" style="marggin-left: auto; margin-right:auto;">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <div class="form-group">
          <div class="input-group">
            <div class="btn-group">
                @switch ($opcionBuscar)
                  @case ('1')
                  <a  id="radioButton" class="btn btn-primary btn-md active" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '1'])}}'">Alumnos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '2'])}}'">Docentes</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '3'])}}'">Administrativos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '4'])}}'">Todos</a>
                    @break;
                  @case ('2')
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '1'])}}'">Alumnos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md active" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '2'])}}'" >Docentes</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '3'])}}'" >Administrativos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '4'])}}'" >Todos</a>
                    @break;
                  @case ('3')
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '1'])}}'" >Alumnos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '2'])}}'" >Docentes</a>
                  <a  id="radioButton" class="btn btn-primary btn-md active" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '3'])}}'" >Administrativos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '4'])}}'" >Todos</a>
                    @break
                  @default
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '1'])}}'" >Alumnos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '2'])}}'" >Docentes</a>
                  <a  id="radioButton" class="btn btn-primary btn-md notActive" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '3'])}}'" >Administrativos</a>
                  <a  id="radioButton" class="btn btn-primary btn-md active" data-toggle="funcionFiltro"  onClick="window.location.href='{{ action('InscripcionADAController@index',['idActividad' => $idActividad,'opcionBuscar' => '4'])}}'" >Todos</a>
                    @break
                @endswitch
            </div>
        	</div>
        </div>
      </div>
      @include('miembro.inscripcion.search')
    </div>
    <br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  		<div class="table-responsive">
  			<table class="table table-striped table-bordered table-condensed table-hover">
  				<thead>
  					<th>Id</th>
  					<th>Nombres y Apellidos</th>
  					<th>Asistencia</th>
  				</thead>

              @php($i=0)
              @if($inscripcionesAlumnos != null)
                <tr>
                    <td colspan="3">Alumnos</td>
                </tr>
                    @foreach($inscripcionesAlumnos as $inscripcionAlumno)
                      <tr>
                        @php($i++)
                          <td> {{ $i }} </td>
                          <td> {{ $inscripcionAlumno->nombre }}  {{ $inscripcionAlumno->apellidoPaterno }}  {{ $inscripcionAlumno->apellidoMaterno }} </td>
                          <td>
                            @if( $inscripcionAlumno->asistencia == 0 )
                                <i class="fa fa-times"> </i>
                            @else
                                <i class="fa fa-check"> </i>
                            @endif
                          </td>
                      </tr>
                    @endforeach
              @endif
              @if($inscripcionesDocentes != null)
                <tr>
                    <td colspan="3">Docentes</td>
                </tr>
                    @foreach($inscripcionesDocentes as $inscripcionDocente)
                      <tr>
                        @php($i++)
                          <td> {{ $i }} </td>
                          <td> {{ $inscripcionDocente->nombre }}  {{ $inscripcionDocente->apellidoPaterno }}  {{ $inscripcionDocente->apellidoMaterno }} </td>
                          <td>
                            @if( $inscripcionDocente->asistencia == 0 )
                                <i class="fa fa-times"> </i>
                            @else
                                <i class="fa fa-check"> </i>
                            @endif
                          </td>
                      </tr>
                    @endforeach
              @endif
              @if($inscripcionesAdministrativos != null)
                <tr>
                    <td colspan="3">Administrativos</td>
                </tr>
                    @foreach($inscripcionesAdministrativos as $inscripcionAdministrativo)
                      <tr>
                        @php($i++)
                          <td> {{ $i }} </td>
                          <td> {{ $inscripcionAdministrativo->nombre }}  {{ $inscripcionAdministrativo->apellidoPaterno }}  {{ $inscripcionAdministrativo->apellidoMaterno }} </td>
                          <td>
                            @if( $inscripcionAdministrativo->asistencia == 0 )
                                <i class="fa fa-times"> </i>
                            @else
                                <i class="fa fa-check"> </i>
                            @endif
                          </td>
                      </tr>
                    @endforeach
              @endif
  			</table>
  		</div>
  	</div>
  </div>
</div>

<style type="text/css">
.sinFondo{
  background: none;
}

#radioButton.notActive{
  color: #3276B1;
  background-color: #FFF;
}

h5 {
    text-align: center;
    font-size: 4em;
    font-weight: 700;
    line-height: 1.2857em;
    margin: 0;
}

h4 {
    text-align: center;
}

h6 {
    font-size: 1.28em;
}

.card {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top {
    display: block;
    width: 100%;
    height: auto;
}

.card-title {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
}

.card-text {
    clear: both;
    margin-top: .5em;
    color: rgba(0, 0, 0, .68);
}

.card-footer {
    font-size: 1em;
    position: static;
    top: 0;
    left: 0;
    max-width: 100%;
    padding: .75em 1em;
    color: rgba(0, 0, 0, .4);
    border-top: 1px solid rgba(0, 0, 0, .05) !important;
    background: #fff;
}

.card-inverse .btn {
    border: 1px solid rgba(0, 0, 0, .05);
}
</style>

<script type="text/javascript">
  function filtrar(componente){
    //var x = $("#nombre")
    var valor = componente.value;
  //  window.location.href = {/{ action('InscripcionADAController@buscarInscripciones',['idEvidencia' => $evidenciaActividad->idEvidenciaActividad ])}};
    var x = {{ $valorAux }};
    //console.log(valor.length);
    //
    console.log(x);
    if(valor.length > 2){
      console.log(valor);
      document.getElementById('ejecutar').click();
  //    $("aux").trigger("click");

      //Preparando el AJAX
      /*$.ajax({
        type:'GET',
        url: '/buscarInscripciones',
        data: {nombre:valor, idActividad:{/{//$idActividad}}, opcionBuscar:{/{//$opcionBuscar}}},
        //dataType: 'json',
        success:function(data) {
          console.log/$idActividad}});
          console.log({/{$opcionBuscar}});
          console.log("success");
        },
        error:function() {
            //console.log("nada");
        }
      });*/
      //Fin del AJAX
    }
  }
</script>
@endsection
