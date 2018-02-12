<div class="navbar navbar-fixed-top toggled" id="sidebar-wrapper" role="navigation">
   <ul id="buttons-list" class="nav sidebar-nav">
      <li>
         <a class="ff-li-a" href="{{ action('MiPerfilController@mis_actividades', ['id'=>Auth::user()->id, 'opcion'=>'1']) }}"><i class="fa fa-puzzle-piece"></i>Mis Actividades</a>
      </li>
      @if( Auth::user()->idTipoPersona == 1 && count(Auth::user()->alumno->soyTutorado) > 0)
         @foreach (Auth::user()->alumno->soyTutorado as $tutorado)
            @if($tutorado->habitoEstudioRespondido == '0')
               <li>
                   <a class="ff-li-a" href="{{ action('EncuestaController@getHabitoEstudio',[ 'idEncuestaRespondida' => $tutorado->habitoEstudio->idEncuestaRespondida  ]) }}">
                      <i class="fa fa-plus"></i> Habitos de Estudio</a>
               </li>
            @endif
         @endforeach
      @endif
      @if( Auth::user()->funcion == 2)
         <li>
            <a class="ff-li-a" href="{{ url('programador/actividad/create') }}"><i class="fa fa-plus"></i> Crear Actividad</a>
         </li>
      @endif
      <!-- PERMISOS DE ADMINISTRADOR -->
      @if( Auth::user()->funcion == 3)

         <li class="dropdown ">
            <a href="#" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-calendar"></i> Actividades <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('programador/actividad/create') }}"><i class="fa fa-plus"></i> Crear Actividad</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('programador/actividad') }}"><i class="fa fa-circle-o"></i> Todas</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/tipoActividad') }}"><i class="fa fa-circle-o"></i> Tipos</a></li>
            </ul>
         </li>
         <li class="dropdown ">
            <a href="#" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-book"></i> Tutoría <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('admin/tutorTutorado/create') }}"><i class="fa fa-circle-o"></i> Asignar Tutores</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/tutorTutorado') }}"><i class="fa fa-circle-o"></i> Tutores</a></li>
               {{--<li class="ff-li-nav"><a class="ff-li-b" href="#"><i class="fa fa-circle-o"></i> Tutorados</a></li>--}}
            </ul>
         </li>

         <li class="dropdown ">
            <a href="#" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-users"></i> Miembros <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('admin/user') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/alumnos') }}"><i class="fa fa-circle-o"></i> Alumnos</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/docentes') }}"><i class="fa fa-circle-o"></i> Docentes</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ url('admin/administrativos') }}"><i class="fa fa-circle-o"></i> Administrativos</a></li>
            </ul>
         </li>
         <li class="dropdown ">
            <a href="" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-file-text-o"></i> Encuestas<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('admin/encuesta') }}"><i class="fa fa-circle-o"></i> Todas</a></li>
            </ul>
         </li>
         <li class="dropdown ">
            <a href="" class="ff-li-a dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-graduation-cap"></i> Egresados<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
               <li class="ff-li-nav"><a style="margin-top: 5px;" class="ff-li-b" href="{{ url('admin/egresado') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
               <li class="ff-li-nav"><a class="ff-li-b" href="{{ action('TrabajoController@index',[ 'op' => '2'  ]) }}"><i class="fa fa-circle-o"></i> Trabajos</a></li>
            </ul>
         </li>
         {{--<li class="dropdown ">
            <a class="ff-li-a" href="{{ action('DashboardController@index')}}">
               <i class="fa fa-dashboard"></i> Dashboard
            </a>
         </li>--}}
         <li class="dropdown ">
            <a class="ff-li-a" href="{{ action('SemestreController@index')}}">
               <i class="fa fa-gear"></i> Configuración
            </a>
         </li>
      @endif

      <!-- SI SOY TUTOR -->

      <!-- HOLI -->

   </ul>
</div>

<script>
   $("#divs").click(function () {
          $(this).show("slide", { direction: "left" }, 1000);
    });
   $(document).ready(function (){

      $.ajax({
         type:'GET',
         url: '{{ action('TutorTutoradoController@soyTutor') }}',
         data: { id: {{ Auth::user()->id }} },
         dataType: 'json',
         success:function(data) {
            if(data.tutorados > 0){
               $('#buttons-list').append('<a class="ff-li-a" href="{{ action('TutorTutoradoController@misTutorados',[]) }}"><i class="fa fa-book"></i>Mis Tutorados</a>');
            }
         },
         error:function() {
            console.log("error AJAX - soyTutor");
         }
      });

   {{--   $.ajax({
         type:'GET',
         url: '{{ action('EncuestaController@misEncuPendientes') }}',
         data: { id: {{ Auth::user()->id }} },
         dataType: 'json',
         success:function(data) {
            if(data.insc_noresp.length > 0 || data.resp_noresp.length > 0){
               var encu = '';
               var dirInsc, dirResp;
               dirInsc = '{{ url('/miembro/encuestaInsc') }}';
               dirResp = '{{ url('/miembro/encuestaResp') }}';
               var total_encu = data.insc_noresp.length + data.resp_noresp.length;
               for (var i = 0; i < data.insc_noresp.length; i++) {
                  encu = encu + '<li class="ff-li-nav"><a class="ff-li-b" href="'+dirInsc+'/'+data.insc_noresp[i].idEncuestaRespondidaInsc+'"><i class="fa fa-circle-o"></i> '+data.insc_noresp[i].idEncuesta+'</a></li>';
               }
               for (var i = 0; i < data.resp_noresp.length; i++) {
                  encu = encu + '<li class="ff-li-nav"><a class="ff-li-b" href="'+dirResp+'/'+data.resp_noresp[i].idEncuestaRespondidaResp+'"><i class="fa fa-circle-o"></i> '+data.resp_noresp[i].idEncuesta+'</a></li>';
               }
               $('#buttons-list').append('<li class="dropdown "><a href="#" class="ff-li-a dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list-ul"></i>Mis Encuestas <span class="badge">' + total_encu + '</span></a><ul class="dropdown-menu" role="menu">'+encu+'</ul></li>');
            }
         },
         error:function() {
            console.log("error AJAX - misEncuPendientes");
         }
      });--}}
   //Fin del AJAX
   });
</script>
