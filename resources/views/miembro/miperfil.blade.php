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

      @include('layouts.partials.member-nav')
      <div id="wrapper">
         <section id="page-content-wrapper" class="content-princ container">
            @if(Auth::user() != null)
               @include('layouts.partials.sidebar')
            @endif
            <div class="row">
               <div class="col-lg-9 col-md-9 col-xs-12" id="pan-stats">

                  <div class="inscrito" style="display: flex;">
                     <div class="ff-card">

                        <div class="header-card" style="margin-bottom:20px;">
                           @if( Auth::user()->sexo == 'm' )
                              <span class="label title-box"><i class="fa fa-child"></i>Estoy Inscrita</span>
                           @else
                              <span class="label title-box">Estoy Inscrito</span>
                           @endif
                        </div>

                        <div class="body-card" style="margin-left:0px;">

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3 id="insc-inscripcion">Nada</h3>
                                   <p>Inscripciones</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3 id="insc-asistencia">Nada</h3>
                                   <p>Asistencias</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-up"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
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
                                   <h3 id="resp-ejecutadas">Nada</h3>
                                   <p>Ejecutadas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3 id="resp-pendientes">Nada</h3>
                                   <p>Pendientes</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-up"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div>

                  @if( Auth::user()->funcion != 1 )
                  <div class="organizador" style="display: flex;">
                     <div class="ff-card">
                        <div class="header-card" style="margin-bottom:20px;">
                           @if( Auth::user()->sexo == 'm' )
                              <span class="label title-box"><i class="fa fa-tasks"></i>Soy Organizadora</span>
                           @else
                              <span class="label title-box"><i class="fa fa-tasks"></i>Soy organizador</span>
                           @endif
                        </div>
                        <div class="body-card" style="margin-left:0px;">

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3 id="prog-expiradas">Nada</h3>
                                   <p>Expiradas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3 id="prog-ejecutadas">Nada</h3>
                                   <p>Ejecutadas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-up"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3 id="prog-pendientes">Nada</h3>
                                   <p>Pendientes</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-calendar-minus-o"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                           <div class="col-md-6 col-sm-6">
                              <div class="small-box">
                                 <div class="inner">
                                   <h3 id="prog-canceladas">Nada</h3>
                                   <p>Canceladas</p>
                                 </div>
                                 <div class="icon">
                                    <i class="fa fa-thumbs-o-down"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div>
                  @endif

               </div>

               <div class="col-lg-3 col-md-3">
                  <div class="ff-card">
                     <div class="header-card" style="width:inherit !important;">
                        <span class="label title-box"> Mi Perfil</span>
                     </div>
                     <div class="img-profile">
                        @if ( Auth::user()->foto != null )
                           <img src="{{ asset('storage/'.Auth::user()->foto) }}" class="img-circle img-profile-img">
                        @else
                           <img src="{{ asset('img/user-offline.png') }}" class="img-circle img-profile-img">
                        @endif
                     </div>
                     <hr class="act-hr"/>
                     <div class="body-card">
                        <p><i class="fa fa-user"></i>{{ Auth::user()->nombre }}</p>
                        <p><i class="fa fa-user"></i>{{ Auth::user()->apellidoPaterno }} {{ Auth::user()->apellidoMaterno }}</p>
                        <p><i class="fa fa-map-marker"></i>{{ Auth::user()->direccion }}</p>
                        <p><i class="fa fa-phone"></i>{{ Auth::user()->telefono }}</p>
                        <p><i class="fa fa-mobile-phone"></i>{{ Auth::user()->celular }}</p>
                        <p><i class="fa fa-birthday-cake"></i>{{ Auth::user()->fechaNacimiento }}</p>
                        @switch ( Auth::user()->idTipoPersona )
                           @case(1) <p><i class="fa fa-graduation-cap"></i><span class="label label-success">Alumno</span></p> @break
                           @case(2) <p><i class="fa fa-graduation-cap"></i><span class="label label-warning">Docente</span></p>
                                    <p><i class="fa fa-graduation-cap"></i><span id="docente-maestria"></span></p>
                                    <p><i class="fa fa-graduation-cap"></i><span id="docente-doctorado"></span></p>@break
                           @case(3) <p><i class="fa fa-graduation-cap"></i><span class="label label-danger">Administrativo</span></p>
                                    <p><i class="fa fa-briefcase"></i><span id="administrativo-cargo"></span></p>@break
                        @endswitch

                        <p><i class="fa fa-key"></i><span class="label label-danger">Administrador</span></p>
                     </div>
                     <hr class="act-hr"/>
                     <div class="footer-card">
                        <button class="btn btn-ff" type="button" name="button"><i class="fa fa-edit"></i>Editar</button>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>

      <script type="text/javascript">

         $(document).ready(function (){
            $.ajax({
               type:'GET',
               url: '/perfilTipo',
               data: {
                  idTipoPersona : {{ Auth::user()->idTipoPersona }},
                  id : {{ Auth::user()->id }}
               },
               dataType: 'json',
               success:function(data) {
                  console.log('Success AJAX - perfilTipo');
                  switch ( {{ Auth::user()->idTipoPersona }} ) {
                     case 2:  $('#docente-maestria').html(data[0].maestria);
                              $('#docente-doctorado').html(data[0].doctorado);
                              break;
                     case 3: $('#administrativo-cargo').html(data[0].cargo); break;
                  }
               },
               error:function() {
                     console.log("Error AJAX");
               }
            });
         //Fin del AJAX
         });
         $(document).ready(function (){
            $.ajax({
               type:'GET',
               url: '/verMisEstadisticas',
               data: {
                  idTipoPersona : {{ Auth::user()->idTipoPersona }},
                  id : {{ Auth::user()->id }},
                  funcion: {{ Auth::user()->funcion }}
               },
               dataType: 'json',
               success:function(data) {
                  console.log('Success AJAX - verMisEstadisticas');
                  if( {{ Auth::user()->funcion }} != 1 ){
                     $('#prog-ejecutadas').html(data.progEjecutadas);
                     $('#prog-pendientes').html(data.progPendientes);
                     $('#prog-canceladas').html(data.progCanceladas);
                     $('#prog-expiradas').html(data.progExpiradas);
                  }
                  $('#resp-ejecutadas').html(data.respEjecutadas);
                  $('#resp-pendientes').html(data.respPendientes);
                  $('#insc-inscripcion').html(data.inscInscripcion);
                  $('#insc-asistencia').html(data.inscAsistencia);
               },
               error:function() {
                     console.log("Error AJAX- verMisEstadisticas");
               }
            });
         //Fin del AJAX
         });
      </script>
   </body>
</html>
