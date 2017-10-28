<div class="col-lg-2 col-md-2 col-sm-12 member-actions">
   <ul>
      <li>
         <a data-toggle="collapse" data-target="#menu-usuarios">
            <i class="fa fa-users"></i><span class=" hidden-xs">usuarios</span>
         </a>
         <div class="collapse" id="menu-usuarios">
            <ul class="sub-options" style="width: 90%; float:right;">
               <li>
                  <a class="sub-option"href="#"><i class="fa fa-circle-o"></i>Estudiantes</a>
               </li>
               <li>
                  <a class="sub-option"href="#"><i class="fa fa-circle-o"></i>Docentes</a>
               </li>
               <li>
                  <a class="sub-option"href="#"><i class="fa fa-circle-o"></i>Administrativos</a>
               </li>
            </ul>
         </div>
      </li>
      <li>
         <a data-toggle="collapse" data-target="#menu-encuestas">
               <i class="fa fa-users"></i><span class=" hidden-xs">Encuestas</span>
         </a>
         <div class="collapse" id="menu-encuestas">
            <ul class="sub-options" style="width: 90%; float:right;">
               <li>
                  <a class="sub-option"href="#"><i class="fa fa-circle-o"></i>Estudiantes</a>
               </li>
               <li>
                  <a class="sub-option"href="#"><i class="fa fa-circle-o"></i>Docentes</a>
               </li>
               <li>
                  <a class="sub-option"href="#"><i class="fa fa-circle-o"></i>Administrativos</a>
               </li>
            </ul>
         </div>
      </li>

   </ul>
   <button id="divs">
      el boton<div id="slide">
         este es el slide
      </div>
   </button>




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
               console.log("Me cago en este AJAX");
         }
      });
   //Fin del AJAX
   });
</script>
