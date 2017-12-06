@extends('template')
@section ('contenido')
  <div class="box box-info">
  	<div class="box-header">
  		<div class="row">
  			<div class="col-xs-6">
  				<h3 class="box-title">
            Relación de Tutorados
          </h3>
  			</div>
  		</div>

  	</div>

  	<div class="box-body">
        <label><b>Tutor: </b> </label> <b>  &nbsp; &nbsp; {{ $tutor->nombre.' '.$tutor->apellidoPaterno.' '.$tutor->apellidoMaterno }}</b>&nbsp; &nbsp;
        <br> <br>
  			<div class="table">
  					<div class="table-responsive">
  						<table id="tabTutores" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
  							<thead>
                        <th>Código</th>
								<th>Nombres y Apellidos</th>
                        <th>Semestre Académico</th>
  								<th>Opciones</th>
  							</thead>
                     @php($i = 1)
                     @foreach($tutorados as $tutorado)
     							<tr>
                           <td>{{ $tutorado->codigo }}</td>
     								<td>{{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}</td>
                           <td>{{ $tutorado->anioSemestre.'-'.$tutorado->numeroSemestre }}</td>
                           @if ($tutorado->habitoEstudioRespondido == '0')
                             <td>
                               <a href="" data-target = "#modal-email-{{ $tutorado->idAlumno }}-{{ $idTutor }}" data-toggle = "modal">
                                 <button class="btn btn-ff-greenOs" ><i class="fa fa-envelope" aria-hidden="true"></i></i> Enviar Mensaje</button>
                               </a>
                             </td>
                           @else
                             <td>
                               <a href="{{ action('HabitoEstudioController@show',['$idTutorTutorado' => $tutorado->idTutorTutorado ])}}">
                                 <button type="button" class="btn btn-ff-blues" >
                                    <span>
                                      <i class="fa fa-eye"><i class="glyphicon glyphicon-list-alt"></i></i>
                                    </span>
                                    Ver Hábitos
                                 </button>
                               </a>
                            </td>
                           @endif
     							</tr>
                        @include('admin.tutorTutorado.modalEmail')
  							@endforeach
  						</table>
  					</div>
  		   </div>
  	 </div>
  </div>

<script>
	$(document).ready(function() {
		$('#tabTutores').DataTable({
			"lengthMenu": [ 10, 25, 50, 75, 100 ],
			"oLanguage" : {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Reg. actuales: _START_ - _END_ / Reg. totales: _TOTAL_",
				"sInfoEmpty":      "Reg. actuales: 0 - 0 / Reg. totales: 0",
				"sInfoFiltered":   "(filtrado de un total _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				  "sFirst":    "Primero",
				  "sLast":     "Último",
				  "sNext":     "Sig",
				  "sPrevious": "Ant"
				},
				"oAria": {
				  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
         "order":[[2,"asc"]]
		})
	});
</script>
  @endsection
