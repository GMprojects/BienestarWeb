<div class="navbar navbar-fixed-top" id="sidebar-wrapper" role="navigation">
   <ul class="nav sidebar-nav">

      <!-- PERMISOS DE ADMINISTRADOR/PROGRAMADOR -->
      @if( Auth::user()->funcion != 1)
         <li>
            <a class="ff-li-a" href="{{ url('programador/actividad/create') }}"><i class="fa fa-plus"></i> Crear Actividad</a>
         </li>
         <li>
            @if( Auth::user()->sexo='m' )
               <a class="ff-li-a" href="#"><i class="fa fa-tasks"></i> Soy Programadora</a>
            @else
               <a class="ff-li-a" href="#"><i class="fa fa-tasks"></i> Soy Programador</a>
            @endif
         </li>
      @endif

      <!-- PERMISOS DE ADMINISTRADOR -->
      @if( Auth::user()->funcion == 3)
         <li class="dropdown ">
            <a href="#" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-users"></i> Miembros <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('admin/user') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="#"><i class="fa fa-circle-o"></i> Estudiantes</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="#"><i class="fa fa-circle-o"></i> Docentes</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="#"><i class="fa fa-circle-o"></i> Administrativos</a></li>
            </ul>
         </li>
         <li class="dropdown ">
            <a href="#" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-calendar"></i> Actividades <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('programador/actividad') }}"><i class="fa fa-circle-o"></i> Todas</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/tipoActividad') }}"><i class="fa fa-circle-o"></i> Tipos</a></li>
            </ul>
         </li>
         <li class="dropdown ">
            <a href="{{ url('actividades-demo') }}" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-file-text-o"></i> Encuestas<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('admin/preguntaHabito/') }}"><i class="fa fa-circle-o"></i> Hábitos de Estudio</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/encuesta') }}"><i class="fa fa-circle-o"></i> Todas</a></li>
            </ul>
         </li>

         <li class="dropdown ">
            <a href="{{ url('actividades-demo') }}" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-file-text-o"></i> Egresados<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('admin/egresado/') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/trabajo') }}"><i class="fa fa-circle-o"></i> Trabajos</a></li>
            </ul>
         </li>
      @endif
   </ul>
</div>

<script type="text/javascript">
   $("#divs").click(function () {
          $(this).show("slide", { direction: "left" }, 1000);
    });
   $(document).ready(function (){
      console.log('AJAX');
      //Preparando el AJAX
      $.ajax({
         type:'GET',
         url: '/actividadesResponsable',
         data: { id : {{ Auth::user()->id }}  },
         dataType: 'json',
         success:function(data) {
            console.log('HOl');
            if(data != null && data[0]){
               console
            }
         },
         error:function() {
            console.log("error AJAX - actividadesResponsable");
         }
      });
   //Fin del AJAX
   });
</script>
