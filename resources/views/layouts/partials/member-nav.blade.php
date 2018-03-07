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
                  <a class="hamburger" href="#">
                     <i class="fa fa-bars" style="font-size: 1.4em;"  aria-hidden="true"></i>
                  </a>
               </li>
               <li>
                  <a href="{{ route('home') }}" class="ff-tool"  data-toggle="tooltip" data-placement="bottom" title="Inicio">
                     <i class="fa fa-home" style="font-size: 1.6em;" aria-hidden="true"></i> <span class="hidden-sm hidden-xs" style="font-size: 1.3em;">Inicio</span>
                  </a>
               </li>
               <li>
                  <a href="{{ action('ActividadController@indexCategorias') }}" class="ff-tool"  data-toggle="tooltip" data-placement="bottom" title="Categorías">
                     <i class="fa fa-tags" aria-hidden="true"></i> <span class="hidden-sm hidden-xs" style="font-size: 1.3em;">Categorías</span>
                  </a>
               </li>
            </ul>
            <ul class="nav navbar-nav pull-right">
               <li class="dropdown menu-notificaciones">
                  <a href="#" class="dropdown-toggle icon-nav" data-toggle="dropdown">
                     <i class="fa fa-bell-o"></i>
                     @php
                        $diasRestantesSemestre = intval((strtotime(config('semestre')['fechaFin']) - strtotime(date('Y-m-d')))/86400);
                     @endphp
                     @php( $i=0 )
                     @if (!Auth::user()->confirmed)
                        @php( $i++ )
                     @endif
                     @if (!Auth::user()->changed_pass)
                        @php( $i++ )
                     @endif
                     @if ( $diasRestantesSemestre<=2 && $diasRestantesSemestre>0 )
                        @php( $i++ )
                     @endif
                     @if ( $i != 0 )
                        <span class="label label-danger">{{ $i }}</span>
                     @endif
                  </a>
                  <ul class="dropdown-menu">
                     <li class="header-notif">Tu tienes {{ $i }} notificaciones.</li>
                     <li class="divider"></li>
                     <li>
                        <ul class="menu">
                           @if (!Auth::user()->confirmed)
                           <li>
                              <a href="" data-target = "#modal-enviarMailVerificacion" data-toggle = "modal">
                                 <i class="fa fa-at" style="color:#006400;"></i> Debe verificar su correo.
                              </a>
                           </li>
                           @endif
                           @if (!Auth::user()->changed_pass)
                           <li>
                              <a href="{{ action('MiPerfilController@editPassword',['id' => Auth::user()->id ]) }}">
                                 <i class="fa fa-lock" style="color:#4B367C;"></i> Debe cambiar su contraseña.
                              </a>
                           </li>
                           @endif
                           <li>
                              <a href="{{ action('SemestreController@index') }}">
                                @if ($diasRestantesSemestre<=2 && $diasRestantesSemestre>0)
                                  <p> <i class="fa fa-calendar" style="color:red;"></i> Debe agregar nuevo semestre. </p>
                                  <p style="color:#7d8187"> &nbsp; &nbsp; &nbsp;  Queda(n) {{ $diasRestantesSemestre }} día(s).</p>
                                @elseif($diasRestantesSemestre<0)
                                  <p> <i class="fa fa-calendar" style="color:red;"></i> Debe agregar nuevo semestre. </p>
                                  <p style="color:#7d8187"> &nbsp; &nbsp; &nbsp;  Esta excedido en {{ (-1)*$diasRestantesSemestre }} día(s).</p>
                                @endif
                              </a>
                           </li>

                           {{--@if ($encuestasPendientes>0)
                           <li>
                              <a href="{{ action('MiPerfilController@editPassword',['id' => Auth::user()->id ]) }}">
                                 <i class="fa fa-file-text" style="color:#4B367C;"></i> Tiene {{ $encuestasPendientes }}  encuestas pendientes por responder.
                              </a>
                           </li>
                         @endif--}}
                        </ul>
                     </li>
                  </ul>
               </li>

               <li class="dropdown menu-usu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     @if(Auth::user()->foto != null)
                        <img src="{{ asset('storage/'.Auth::user()->foto ) }}" class="img-usu" alt="not found">
                     @else
                           @if (Auth::user()->sexo == 'h'){{-- Hombre --}}
                              <img src="{{ asset('img/avatar5.png') }}" class="img-usu" alt="No Disponible">
                           @else{{-- Mujer --}}
                              <img src="{{ asset('img/avatar2.png') }}" class="img-usu" alt="No Disponible">
                           @endif
                        {{--<img src="{{ asset('img/user.png') }}" class="img-usu" alt="not found">--}}
                     @endif
                     <span class="hidden-xs hidden-sm" style="padding-left:5px;">{{ Auth::user()->nombre }}</span>
                  </a>
                  <ul class="dropdown-menu">
                     <li class="header-usu">
                        @if(Auth::user()->foto != null)
                           <img src="{{ asset('storage/'.Auth::user()->foto ) }}" class="img-circle" alt="not found">
                        @else
                              @if (Auth::user()->sexo == 'h'){{-- Hombre --}}
                                 <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="No Disponible">
                              @else{{-- Mujer --}}
                                 <img src="{{ asset('img/avatar2.png') }}" class="img-circle" alt="No Disponible">
                              @endif
                           {{--<img src="{{ asset('img/user.png') }}" class="img-circle" alt="not found">--}}
                        @endif<p>{{ Auth::user()->nombre }} -
                           @switch ( Auth::user()->idTipoPersona )
                              @case(1) Estudiante @break
                              @case(2) Docente @break
                              @case(3) Administrativo @break
                           @endswitch
                              <br />
                           @if(Auth::user()->fechaNacimiento != null)
                              <small><i class="fa fa-birthday-cake"></i> {{ Date::make(Auth::user()->fechaNacimiento)->format('d \d\e F') }}</small>
                           @else
                              <small><i class="fa fa-birthday-cake"></i> - </small>
                           @endif
                        </p>
                     </li>
                     <li class="footer-usu">
                        <div class="pull-left">
                           <a href="{{ action('MiPerfilController@show', ['idPerfil' => Auth::user()->id ]) }}" class="btn btn-default"> <i class="fa fa-user"> </i> Perfil</a>
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

   <!---- MODALES ---->
   <div class="modal fade modal-slide-in-right" aria-hidden = "true" role = "dialog" tabindex = "-1" id="modal-enviarMailVerificacion">
      {{Form::Open(['action'=>['UserController@enviarMailVerificacion'],'method'=>'post'])}}
      {{ Form::hidden('id', Auth::user()->id) }}
   		<div class="modal-dialog">
   			<div class="modal-content">
   				<div class="modal-header" style="background-color:#337AB7; color:white; border-radius:4px 4px 0px 0px;">
   					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
   					<h4 class="modal-title"><b style="color:white;">Verificación de Correo</b></h4>
   				</div>
   				<div class="modal-body">
   					<p> Enviar link de verificación de correo.</p>
   				</div>
   				<div class="modal-footer">
   					<div class="pull-left">
   						<button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
   					</div>
   					<div class="pull-right">
   						<button class="btn btn-ff" type="submit"><i class="fa fa-send"></i> Enviar</button>
   					</div>
   				</div>
   			</div>
   		</div>
   	{{ Form::close() }}
   </div>

   <!---- FIN DE MODALES ---->


</header>
<script>
   $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();
   });
   $('.hamburger').on('click', function(){
      $('#wrapper').toggleClass('toggled');
   })
</script>
