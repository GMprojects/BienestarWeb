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
                  <a class="hamburger" href="#">
                     <i class="fa fa-bars" aria-hidden="true"></i>
                  </a>
               </li>
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
               <li class="dropdown menu-notificaciones">
                  <a href="#" class="dropdown-toggle icon-nav" data-toggle="dropdown">
                     <i class="fa fa-bell-o"></i>
                     <span class="label label-danger">4</span>
                  </a>
               </li>

               <li class="dropdown menu-usu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     @if(Auth::user()->foto != null)
                        <img src="{{ asset('storage/'.Auth::user()->foto ) }}" class="img-usu" alt="not found">
                     @else
                        <img src="{{ asset('img/user-offline.png') }}" class="img-usu" alt="not found">
                     @endif
                     <span class="hidden-xs hidden-sm" style="padding-left:5px;">{{ Auth::user()->nombre }} {{ Auth::user()->apellidoPaterno }}</span>
                  </a>
                  <ul class="dropdown-menu">
                     <li class="header-usu">
                        @if(Auth::user()->foto != null)
                           <img src="{{ asset('storage/'.Auth::user()->foto ) }}" class="img-circle" alt="not found">
                        @else
                           <img src="{{ asset('img/user-offline.png') }}" class="img-circle" alt="not found">
                        @endif<p>{{ Auth::user()->nombre }} -
                           @switch ( Auth::user()->idTipoPersona )
                              @case(1) Estudiante @break
                              @case(2) Docente @break
                              @case(3) Administrativo @break
                           @endswitch
                              <br />
                           <small>Nov. 2016</small>
                        </p>
                     </li>
                     <li class="footer-usu">
                        <div class="pull-left">
                           <a href="{{ url('miembro/perfil') }}" class="btn btn-default"> <i class="fa fa-user"> </i> Perfil</a>
                        </div>
                        <div class="pull-right">
                           <a class="btn btn-default" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              <i class="fa fa-power-off"></i>Salir
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                           </form>
                        </div>
                     </li>
                  </ul>
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
