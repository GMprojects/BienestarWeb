<header class="header-princ">
   <nav class="navbar container-fluid navbar-fixed-top" >
      <div class="navbar-header">

         {{--<a href="{{ route('home') }}"  class="logo-facfar">
            <span class="hidden-lg hidden-md">Facfar</span>
            <span class="hidden-xs hidden-sm">Facfar Bienestar</span>
         </a>--}}
         <span  class="logo-facfar">
            <span class="hidden-lg hidden-md">Bienestar Web</span>
            <span class="hidden-xs hidden-sm">Bweb</span>
         </span>

         <div class="div-buttons">
            <ul class="nav navbar-nav nav-izq">
               <li>
                  <a href="{{ route('home') }}" class="ff-tool"  data-toggle="tooltip" data-placement="bottom" title="Inicio">
                     <i class="fa fa-home" style="font-size: 1.6em;" aria-hidden="true"></i> <span class="hidden-sm hidden-xs" style="font-size: 1.3em;">Inicio</span>
                  </a>
               </li>
            </ul>
         {{--<div class="div-buttons">
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
                       <input type="search" class="form-control input-addon-right" placeholder="Buscar..">
                       <span class="input-group-btn">
                       <button class="btn btn-default rounded-right" type="button"><i class="fa fa-search "></i></button>
                     </span>
                    </div>
                  </form>
               </li>
            </ul>
--}}
            <ul class="nav navbar-nav pull-right">
               <li class="menu-usu">
                  <a href="{{ route('login') }}">
                     <i style="font-size: 1.4em;" class="fa fa-user"></i>
                     <span class="" style="font-size: 1.3em; padding-left:5px;">Iniciar Sesión</span>
                  </a>
               </li>
            </ul>
         </div>

      </div>
   </nav>
</header>
<script>
   $('.hamburger').on('click', function(){
      $('#wrapper').toggleClass('toggled');
   })
</script>
