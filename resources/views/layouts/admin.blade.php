<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>BienestarWeb | Admin</title>
      @include('layouts.libs.losCss')
   </head>

   <body class="hold-transition skin-purple-light sidebar-mini">
      <div class="wrapper">
         <header class="main-header">
            <a href="{{ route('home') }}" class="logo">
               <span class="logo-mini"><b>F</b>Bi</span>
               <span class="logo-lg"><b>Farmacia</b>Bienestar</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            @include('layouts/partials/nav')
         </header>
         @include('layouts/partials.sideBar', [ $item ])
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>{{ $titulo }}<small>Control panel</small></h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">{{ $titulo }}</li>
               </ol>
            </section>
            <section class="content">
               @yield('contenido', 'Default')
            </section>
         </div>

         <footer class="main-footer">
            <div class="pull-right hidden-xs"><b>Version</b> 2.4.0</div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
         </footer>

      </div>

      @include('layouts.libs.losJS')

      @if( $nombreTabla != '' )
         <script>
            $(document).ready(function() {
               $('#{{ $nombreTabla }}').DataTable({
                  "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
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
      @endif
      <script>
         $('.dropify').dropify({
          messages: {
         	  'default': 'Click o arrastrar y soltar',
         	  'replace': 'Click o arrastrar y soltar',
         	  'remove':  'Quitar',
         	  'error':   'Ops! Ha ocurrido un error'
          },
          error: {
              'imageFormat': 'Formato de Imagen no permitido (solo .png .jpg y .jpge).'
           }
         });

      	$(document).ready(function(){
            $('input').iCheck({
               checkboxClass: 'icheckbox_square-green',
               radioClass: 'iradio_square-green',
               increaseArea: '20%' // optional
            });
            $('input').on('ifChanged', function (event) { $(event.target).trigger('change'); });
            $("#input-id").fileinput();
            $("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});
      	});
      </script>
   </body>
</html>
