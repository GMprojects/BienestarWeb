<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>FacFar | Actividad</title>
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
      <header>
         @include('layouts.partials.nav')
      </header>
      <section class="content-princ container">
         <div class="encuesta">
            <form class="" action="index.html" method="post" style="width: 100%;">
               <div class="enc-title">Aquí va el título de la encuesta no importa lo largo que sea</div>
               <div class="row item hidden-xs hidden-sm">
                  <div class="question">
                  </div>
                  <div class="alternatives">
                     <div class="choice" style="width:20%;">
                       <label class="">Etiqueta 1</label>
                     </div>
                     <div class="choice" style="width:20%;">
                       <label class="">Etiqueta 2</label>
                     </div>
                     <div class="choice" style="width:20%;">
                       <label class="">Etiqueta 3</label>
                     </div>
                     <div class="choice" style="width:20%;">
                       <label class="">Etiqueta 4</label>
                     </div>
                     <div class="choice" style="width:20%;">
                       <label class="">Etiqueta 5</label>
                     </div>
                  </div>
               </div>
               <ol style="padding: 0px;" class="enc-list">
                  <hr class="act-hr">
                  @include('layouts.partials.item')
                  <hr class="act-hr">
                  @include('layouts.partials.item')
                  <hr class="act-hr">
                  @include('layouts.partials.item')
                  <hr class="act-hr">
                  @include('layouts.partials.item')
               </ol>
               <hr class="act-hr">
               <div class="text-right" style="margin-right:15px; padding-bottom: 15px;">
                  <button class="btn btn-ff" type="button" name="button"><i class="fa fa-send"></i>Enviar</button>
               </div>

            </form>

         </div>
      </section>

   </body>
   @include('layouts.partials.footer')
</html>
