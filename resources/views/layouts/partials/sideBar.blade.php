@php
if($item != null){
   $usu=''; //-- Usuarios -->
      $usuTodos=''; //--     Todos-->
      $usuAdmin=''; //--     Administrativos-->
      $usuAlumn=''; //--     Alumnos-->
      $usuDocen=''; //--     Docentes -->
   $egre=''; //-- Egresados -->
      $egreTodos='';
      $egreTraba='';
   $acti=''; //-- Actividades -->
      $actiTodas=''; //--     Todas -->
      $actiMisAc=''; //--     Mis Actividades -->
         $actiMisAcProgr='';
         $actiMisAcRespo='';
         $actiMisAcInscr='';
      $actiTipos=''; //--     Tipos -->
   $encu=''; //--     Encuestras -->
      $encuHabit=''; //--     Encuesta de habitos de estudio -->
         $encuHabitPregu=''; //--     Preguntas -->
         $encuHabitTipoH='';
      $encuTodas=''; //--     Todas -->
      $encuTipos=''; //--     Tipos -->
   $ac = 'active';
   switch($item){
      case 'usuTodos' : $usu = $ac; $usuTodos = $ac; break;
      case 'usuAdmin' : $usu = $ac; $usuAdmin = $ac; break;
      case 'usuAlumn' : $usu = $ac; $usuAlumn = $ac; break;
      case 'usuDocen' : $usu = $ac; $usuDocen = $ac; break;
      case 'egreTodos' : $egre = $ac; $egreTodos = $ac; break;
      case 'egreTraba' : $egre = $ac; $egreTraba = $ac; break;
      case 'actiTodas' : $acti = $ac; $actiTodas = $ac; break;
      case 'actiTipos' : $acti = $ac; $actiTipos = $ac; break;
      case 'actiMisAcProgr' : $acti = $ac; $actiMisAc = $ac; $actiMisAcProgr = $ac; break;
      case 'actiMisAcRespo' : $acti = $ac; $actiMisAc = $ac; $actiMisAcRespo = $ac; break;
      case 'actiMisAcInscr' : $acti = $ac; $actiMisAc = $ac; $actiMisAcInscr = $ac; break;
      case 'encuTodas' : $encu = $ac; $encuTodas = $ac; break;
      case 'encuTipos' : $encu = $ac; $encuTipos = $ac; break;
      case 'encuHabitPregu' : $encu = $ac; $encuHabit = $ac; $encuHabitPregu = $ac; break;
      case 'encuHabitTipoH' : $encu = $ac; $encuHabit = $ac; $encuHabitTipoH = $ac; break;
   }
}
@endphp

<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
         <div class="pull-left image">
            <img src="{{ asset('images/avatar3.png') }}" class="img-circle" alt="Imagen de Usuario">
         </div>
         <div class="pull-left info">
           <p>Gaby Alvarez</p>
           <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
         <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
               <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
               </button>
            </span>
         </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         <li class="header">PANEL PRINCIPAL</li>
         <li class="{{ $usu }} treeview">
            <a href="#">
               <i class="fa fa-user-o"></i>
               <span>Usuarios</span>
               <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
               <li class="{{ $usuTodos }}"><a href="{{ url('admin/persona') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
               <li class="{{ $usuAdmin }}"><a href="index.html"><i class="fa fa-circle-o"></i> Administrativos</a></li>
               <li class="{{ $usuAlumn }}"><a href="index2.html"><i class="fa fa-circle-o"></i> Alumnos</a></li>
               <li class="{{ $usuDocen }}"><a href="index2.html"><i class="fa fa-circle-o"></i> Docentes</a></li>
            </ul>
         </li>
         <li class="{{ $egre }} treeview">
            <a href="#">
               <i class="fa fa-graduation-cap"></i>
               <span>Egresados</span>
               <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
               <li class="{{ $egreTodos }}"><a href="{{ url('admin/egresado') }}"><i class="fa fa-circle-o"></i> Todos</a></li>
               <li class="{{ $egreTraba }}"><a href="{{ url('admin/trabajo')}}"><i class="fa fa-circle-o"></i> Trabajos</a></li>
            </ul>
         </li>
         <li class="{{ $acti }} treeview">
            <a href="#">
               <i class="fa fa-tasks"></i>
               <span>Actividades</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li class="{{ $actiTodas }}"><a href="#"><i class="fa fa-circle-o"></i> Todas</a></li>
               <li class="{{ $actiTipos }}"><a href="{{ url('admin/tipoActividad') }}"><i class="fa fa-circle-o"></i> Tipos</a></li>
               <li class="{{ $actiMisAc }} treeview">
                  <a href="#">
                     <i class="fa fa-circle-o"></i>
                     <span>Mis Actividades</span>
                     <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                     </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ $actiMisAcProgr }}"><a href="#"><i class="fa fa-circle-o"></i> Como Programador</a></li>
                     <li class="{{ $actiMisAcRespo }}"><a href="#"><i class="fa fa-circle-o"></i> Como Responsable</a></li>
                     <li class="{{ $actiMisAcInscr }}"><a href="#"><i class="fa fa-circle-o"></i> Como Inscrito</a></li>
                  </ul>
               </li>
            </ul>
         </li>

         <li class="{{ $encu }} treeview">
            <a href="#">
               <i class="fa  fa-file-text-o"></i>
               <span>Encuestas</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li class="{{ $encuHabit }} treeview">
                  <a href="#">
                     <i class="fa  fa-circle-o"></i>
                     <span>Hábitos de Estudio</span>
                     <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                     </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="{{ $encuHabitTipoH }}"><a href="{{ url('admin/tipoHabito')}}"><i class="fa fa-circle-o"></i>Tipos de Hábitos</a></li>
                     <li class="{{ $encuHabitPregu }}"><a href="{{ url('admin/preguntaHabito')}}"><i class="fa fa-circle-o"></i>Preguntas de Hábitos</a></li>
                  </ul>
               </li>
               <li class="{{ $encuTodas }}"><a href="{{ url('admin/encuesta')}}"><i class="fa fa-circle-o"></i> Todas</a></li>
               <li class="{{ $encuTipos }}"><a href="#"><i class="fa fa-circle-o"></i> Tipos</a></li>
            </ul>
         </li>
      </ul>
   </section>
</aside>
