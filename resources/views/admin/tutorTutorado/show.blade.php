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
        <div class="pull-right"><label><b>Semestre Académico: </b> </label> &nbsp; &nbsp;{{ $tutorados[0]->anioSemestre.'-'.$tutorados[0]->numeroSemestre }}</div>
        <br> <br>
  			<div class="table">
  					<div class="table-responsive">
  						<table id="tabTutores" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
  							<thead>
  								<th>Id</th>
                        <th>Código</th>
								<th>Nombres y Apellidos</th>
                        <th>Habito Estudio</th>
  								<th>Opciones</th>
  							</thead>
                     @php($i = 1)
                     @foreach($tutorados as $tutorado)
  							<tr>
                        <td>{{ $i }}</td>
                        <td>{{ $tutorado->codigo }}</td>
  								<td>{{ $tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno }}</td>
                        @if ($tutorado->habitoEstudioRespondido == '0')
                          <td>
                            <a href="" data-target = "#modal-email-{{ $tutorado->idAlumno }}-{{ $idTutor }}" data-toggle = "modal">
                              <button class="btn btn-info" ><i class="fa fa-envelope" aria-hidden="true"></i></i> Enviar Mensaje</button>
                            </a>
                          </td>
                        @else
                          <td>
                            <a href="#">
                              <button type="button" class="btn btn-info" ><i class="fa  fa-eye" aria-hidden="true"></i> Ver Hábitos  </button>
                            </a>
                          </td>
                        @endif
  								<td><a href="#"><button class="btn btn-danger">Desvincular</button></a></td>
                     @php($i++)
  							</tr>
                     @include('admin.tutorTutorado.modalEmail')
  							@endforeach
  						</table>
  					</div>
  		   </div>
  	 </div>
  </div>
  <!--<a href="" data-target = "#modal-delete-{/{ $actividad->idActividad }}" data-toggle = "modal"><button class="btn btn-danger">ELiminar</button></a>
      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">-->

<!-- /.modal -->
<div class="modal fade" id="modal-default">
   <!-- /.modal-dialog -->
   <div class="modal-dialog">
       <!-- /.modal-content -->
      <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title"><b>Enviar Email</b></h4>
         </div>
         <div class="modal-body">
           <p>Seleccione esta opción si desea comunicar a todos los inscritos de esta actividad los cambios realizados.</p>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
