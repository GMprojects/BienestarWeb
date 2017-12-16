<div id="carousel-generic"
   class="carousel slide"
   data-ride="carousel"
   style="margin-right:15px; margin-left:15px;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
   <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
   <li data-target="#carousel-generic" data-slide-to="1"></li>
   <li data-target="#carousel-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
   <div class="item active text-center">
      <img src="{{ asset('img/frontis.jpg') }}" alt="" width="1200px" style="margin-right:auto; margin-left:auto">
      <!--<div class="carousel-caption" >
         <p>Este es un caption si pues yo lo pongo</p>
         <p><span class="btn btn-facfar">Este es un botón</span></p>
      </div>-->
   </div>

   <div class="item text-center">
      <img src="{{ asset('img/panel-equipos.jpg') }}" alt="" width="1200px" style="margin-right:auto; margin-left:auto">
      <div class="carousel-caption" >

      </div>
   </div>

   <div class="item text-center">
      <img src="{{ asset('img/panel-docentes.jpg') }}" alt="" width="1200px" style="margin-right:auto; margin-left:auto">
      <div class="carousel-caption" >

      </div>
   </div>

   <div class="item text-center">
      <img src="{{ asset('img/panel-calidad.jpg') }}" alt="" width="1200px" style="margin-right:auto; margin-left:auto">
      <div class="carousel-caption" >

      </div>
   </div>



  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-generic" data-slide="prev">
   <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-generic" data-slide="next">
   <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
