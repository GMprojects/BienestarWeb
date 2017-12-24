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
         <div class="col-xs-6" style="text-align:right;">
				<a href="{{ action('TutorTutoradoController@edit',['idDocente' => $idTutor, 'anioSemestre' => $anioSemestre, 'numeroSemestre' => $numeroSemestre ]) }}">
               <button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nuevo Tutorado</button>
            </a>
			</div>
  		</div>

  	</div>

  	<div class="box-body">
      <div class="row">
			<div class="col-md-6">
				<label><i class="fa fa-user margin-r-5"></i><b>Tutor: </b></label> <b>  &nbsp; &nbsp; {{ $tutor->nombre.' '.$tutor->apellidoPaterno.' '.$tutor->apellidoMaterno }}</b>&nbsp; &nbsp;

			</div>
			<div class="col-md-3"></div>
			<div class="col-md-3 text-right">
				<label><i class="glyphicon glyphicon-calendar margin-r-5"></i><b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $anioSemestre.'-'.$numeroSemestre }}
			</div>
	   </div>
     <br>
     <div class="row">
        <div class="col-md-12">
           <div class="table">
   					<div class="table-responsive">
   						<table id="tabTutores" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
   							<thead>
   								<th>Id</th>
                           <th>Código</th>
    								<th>Nombres y Apellidos</th>
   								<th>Opciones</th>
   							</thead>
                      @php($i = 1)
                      @if (count($tutorados)>0)
                         @foreach($tutorados as $tutorado)
      							<tr>
                            <td>{{ $i }}</td>
                            <td>{{ $tutorado->codigo }}</td>
      								<td>{{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}</td>
      								<td><a href="" data-target = "#modal-delete-{{ $tutorado->idTutorTutorado }}" data-toggle = "modal"><button class="btn btn-ff-red"><i class="fa  fa-unlink" aria-hidden="true"></i> Desvincular</button></a></td>
                         @php($i++)
      							</tr>
                         @include('admin.tutorTutorado.modal')
      							@endforeach
                      @endif
   						</table>
   					</div>
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
			}
		})
	});
</script>
  @endsection
