<header class="header-princ">
   <nav class="navbar container-fluid navbar-fixed-top" >
      <div class="navbar-header">

         <a href="{{ route('home') }}"  class="logo-facfar">
            <span class="hidden-lg hidden-md">Facfar</span>
            <span class="hidden-xs hidden-sm">Facfar Bienestar</span>
         </a>

         <div class="div-buttons">
            <ul class="nav navbar-nav nav-izq">
               <li>
                  <a href="{{ url('actividades-demo') }}" class="ff-tool"  data-toggle="tooltip" data-placement="bottom" title="Actividades">
                     <i class="fa fa-calendar" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Actividades</span>
                  </a>
               </li>
               <li>
                  <a href="#" class="ff-tool"  data-toggle="tooltip" data-placement="bottom" title="Categorías">
                     <i class="fa fa-tags" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Categorías</span>
                  </a>
               </li>
               <li>
                  <a href="#" class="ff-tool"  data-toggle="tooltip" data-placement="bottom" title="Nosotros">
                     <i class="fa fa-star" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">Nosotros</span>
                  </a>
               </li>
               <li class="hidden-xs" style="overflow-x:hidden;">
                  <form class="navbar-form">
                    <div class="input-group">
                       <input type="search" class="form-control" placeholder="Buscar..">
                       <span class="input-group-btn">
                       <button class="btn btn-default rounded-right" type="button"><i class="fa fa-search "></i></button>
                     </span>
                    </div>
                  </form>
               </li>
            </ul>

            <ul class="nav navbar-nav pull-right">
               <li class="menu-usu">
                  <a href="{{ route('login') }}">
                     <i class="glyphicon glyphicon-user"></i>
                     <span class="" style="padding-left:5px;">Iniciar Sesión</span>
                  </a>
               </li>
            </ul>
         </div>

      </div>
   </nav>
</header>
<script>
   $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();
   });
   $('.hamburger').on('click', function(){
      $('#wrapper').toggleClass('toggled');
   })
</script>
