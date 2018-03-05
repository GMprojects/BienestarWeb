@extends('template')
@section ('contenido')

   <div class="box box-info">
      <div class="box-header">
         <div class="row">
            <div class="col-xs-6">
               <h3 class="box-title">Configuración de Semestre Académico</h3>
            </div>
            <div class="col-xs-6" style="text-align:right;">
               <a href="semestre/create"><button class="btn btn-ff-green"><i class="fa fa-plus"></i>Nuevo Semestre</button></a>
            </div>
         </div>
      </div>
      <div class="box-body">
         <div class="table-responsive">
            <table id="tabEgresados" class="table table-bordered table-striped table-hover dt-responsive nowrap" cellspacing="0" width="100%">
               <thead>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Semestre</th>
                  <th>Opciones</th>
               </thead>

               @foreach($semestres as $semestre)
                  <tr>
                     <td>{{ date("d/m/Y",strtotime($semestre->fechaInicio )) }}</td>
                     <td>{{ date("d/m/Y",strtotime($semestre->fechaFin )) }}</td>
                     <td>{{ $semestre->anioSemestre.' - '.(($semestre->numeroSemestre == 1) ? 'I' : 'II') }}</td>
                     <td>
                        <a href="{{ action('SemestreController@edit',$semestre->idSemestre) }}""><button class="btn btn-ff-yellow"><i class="fa fa-edit"></i></button></a>
                        <a href="" data-target = "#modal-delete-{{ $semestre->idSemestre }}" data-toggle = "modal"><button class="btn btn-ff-red"><i class="fa fa-trash"></i></button></a>
                     </td>
                  </tr>
                  @include('admin.semestre.modal')
               @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <script>
      $(document).ready(function() {
         $('#tabEgresados').DataTable({
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

         $('#fechas').daterangepicker();
         $('#fechasEdit').daterangepicker();
   </script>

@endsection
