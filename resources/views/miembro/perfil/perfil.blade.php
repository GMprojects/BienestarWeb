<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      <title>FacFar | Home</title>
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('facfar/facfar.css') }}"/>
      <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Raleway" rel="stylesheet">
      <!-- Scripts -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   </head>
   <body>
      @if($du['user'] != null)
         @include('layouts.partials.member-nav')
      @else
         @include('layouts.partials.nav')
      @endif

      <div id="wrapper">
         <section id="page-content-wrapper" class="content-princ container">
            @if($du['user'] != null)
               @include('layouts.partials.sidebar')
            @endif
            <div class="row">
               <div class="col-lg-3 col-md-3 perfil">
                  <div class="ff-card">
                     <div class="header-card" style="width:inherit !important;">
                        <span class="label title-box"> Mi Perfil</span>
                     </div>
                     <div class="img-profile">
                        @if ( $du['user']->foto != null )
                           <img src="{{ asset('storage/'.$du['user']->foto) }}" class="img-circle img-profile-img">
                        @else
                           <img src="{{ asset('img/user.png') }}" class="img-circle img-profile-img">
                        @endif
                     </div>
                     <hr class="act-hr"/>
                     <div class="body-card">
                        <p><i class="fa fa-user"></i>{{ $du['user']->nombre }}</p>
                        <p><i class="fa fa-user"></i>{{ $du['user']->apellidoPaterno }} {{ $du['user']->apellidoMaterno }}</p>
                        <p><i class="fa fa-map-marker"></i>{{ $du['user']->direccion }}</p>
                        <p><i class="fa fa-phone"></i>{{ $du['user']->telefono }}</p>
                        <p><i class="fa fa-mobile-phone"></i>{{ $du['user']->celular }}</p>
                        <p><i class="fa fa-birthday-cake"></i>{{ date("d F",strtotime($du['user']->fechaNacimiento)) }}</p>
                        @switch ( $du['user']->idTipoPersona )
                           @case(1) <p><i class="fa fa-graduation-cap"></i><span class="label label-success">Alumno</span></p> @break
                           @case(2) <p><i class="fa fa-briefcase"></i><span class="label label-warning">Docente</span></p>
                              @switch($du['user']->docente->deptoAcademico)
                                 @case(1) <p><i class="fa fa-briefcase"></i><span>Dpto. Académico de Bioquímica</span></p> @break
                                 @case(2) <p><i class="fa fa-briefcase"></i><span>Dpto. Académico de Farmacología</span></p> @break
                                 @case(3) <p><i class="fa fa-briefcase"></i><span>Dpto. Académico de Farmacotecnia</span></p> @break
                              @endswitch
                                    <p><i class="fa fa-graduation-cap"></i><span>{{ $du['user']->docente->maestria }}</span></p>
                                    <p><i class="fa fa-graduation-cap"></i><span>{{ $du['user']->docente->doctorado }}</span></p>@break
                           @case(3) <p><i class="fa fa-graduation-cap"></i><span class="label label-danger">Administrativo</span></p>
                                    <p><i class="fa fa-briefcase"></i><span>{{ $du['user']->administrativo->cargo }}</span></p>@break
                        @endswitch

                        @switch( $du['user']->funcion)
                           @case(1) <p><i class="fa fa-key"></i><span class="label label-success">Miembro</span></p> @break
                           @case(2) <p><i class="fa fa-key"></i><span class="label label-warning">Programador</span></p> @break
                           @case(3) <p><i class="fa fa-key"></i><span class="label label-danger">Administrador</span></p> @break
                        @endswitch

                     </div>
                     <hr class="act-hr"/>

                     <div class="footer-card">
                        @if(Auth::user()->id == $du['user']->id)
                           <a href="{{ action('MiPerfilController@edit', ['id'=>Auth::user()->id]) }}" class="btn btn-ff" type="button" name="button"><i class="fa fa-edit"></i>Editar</a>
                        @endif
                     </div>

                  </div>
               </div>

               <div class="col-lg-9 col-md-9 col-xs-12">
                  <div class="inscrito" style="display: flex;">
                     <div class="ff-card">

                        <div class="header-card" style="margin-bottom:20px;">
                           @if( $du['user']->sexo == 'm' )
                              <span class="label title-box"><i class="fa fa-child"></i>Estoy Inscrita</span>
                           @else
                              <span class="label title-box"><i class="fa fa-child"></i>Estoy Inscrito</span>
                           @endif
                        </div>

                        <div class="body-card" style="margin-left:0px;">

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['inscInscripcion'] }}</h3>
                                   <p>Inscripciones</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'1']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['inscAsistencia'] }}</h3>
                                   <p>Asistencias</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-up"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'1']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div>

                  <div class="responsable" style="display: flex;">
                     <div class="ff-card">
                        <div class="header-card" style="margin-bottom:20px;">
                           <span class="label title-box"><i class="fa fa-tasks"></i>Soy Responsable</span>
                        </div>
                        <div class="body-card" style="margin-left:0px;">

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['respEjecutadas'] }}</h3>
                                   <p>Ejecutadas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'2']) }}"  class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['respPendientes'] }}</h3>
                                   <p>Pendientes</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-up"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'2']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div>

                  @if( $du['user']->funcion != 1 )
                  <div class="organizador" style="display: flex;">
                     <div class="ff-card">
                        <div class="header-card" style="margin-bottom:20px;">
                           @if( $du['user']->sexo == 'm' )
                              <span class="label title-box"><i class="fa fa-tasks"></i>Soy Programadora</span>
                           @else
                              <span class="label title-box"><i class="fa fa-tasks"></i>Soy Programador</span>
                           @endif
                        </div>
                        <div class="body-card" style="margin-left:0px;">

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['progExpiradas'] }}</h3>
                                   <p>Expiradas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'3']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['progEjecutadas'] }}</h3>
                                   <p>Ejecutadas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-up"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'3']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['progPendientes'] }}</h3>
                                   <p>Pendientes</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-minus-o"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'3']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3>{{ $du['progCanceladas'] }}</h3>
                                   <p>Canceladas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-down"></i>
                                 </div>
                                 <a href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'3']) }}" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div>
                  @endif

               </div>


            </div>
         </section>
      </div>
   </body>
</html>
