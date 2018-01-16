<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

      <title>FacFar | Home</title>
      <!-- CSS Generales -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}"/>
      <link rel="stylesheet" href="{{ asset('facfar/facfar.css') }}"/>
      <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Raleway" rel="stylesheet">

      <!-- Scripts Generales -->
      <script src="{{ asset('plugins/jQuery-3.2.1/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

   </head>

   <body>
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-7 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
               <div class="login-container">
                  <div  class="header-login-box" >
                     <span class="my-user"> <i class="fa fa-user"> </i></span>
                  </div>
                  <div class="form-box">
                     @if (session('status'))
                         <div class="alert alert-success">
                             {{ session('status') }}
                         </div>
                     @endif
                     <form class="form" style="text-align:left;" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ">
                           <b><h4>Ingrese su correo</h4></b>
                           <div class="input-group input-group-lg">
                                 <span class="input-group-addon rounded-left"><i class="fa fa-at"></i></span>
                                 <input required minlength="6" maxlength="100" type="email" class="form-control" name="email"  value="{{old('email')}}" placeholder="e.g. mguevaral@unitru.edu.pe" autofocus>
                           </div>
                           @if ($errors->has('email'))
                              <span class="help-block">
                                 <strong>{{ $errors->first('email') }}</strong>
                              </span>
                           @endif
                        </div>

                        <div class="form-group" style="text-align:right;">
                           <button type="submit" class="btn btn-lg btn-facfar">
                              Enviar Link de Recuperación
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <style type="text/css">
      .my-user{
         color: #4B367C;
         font-size: 7em;
         padding: 10px;
      }

      body{
         background-color: #4b367c;
         background-image:url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHhtbG5zOnhsaW5rPSdodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rJyB3aWR0aD0nMTkyMCcgaGVpZ2h0PSc5NjAnIHZpZXdCb3g9JzAgMCAzODQgMTkyJz4KCTxkZWZzPgoJCTxwYXRoIGlkPSdzJyBmaWxsPScjZmZmJyBkPSdNMCwwbDMyIDE2bC0zMiwxNnonLz4KCTwvZGVmcz4KCTxnIGlkPSdiJz4KCTx1c2UgeD0nLTMyJyB5PSctMTYnIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIGZpbGwtb3BhY2l0eT0nMC4zNicgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9JzAnIHk9JzAnIGZpbGwtb3BhY2l0eT0nMC41NCcgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9Jy0zMicgeT0nMTYnIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIGZpbGwtb3BhY2l0eT0nMC41NCcgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9JzAnIHk9JzMyJyBmaWxsLW9wYWNpdHk9JzAuNTQnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctMzInIHk9JzQ4JyB0cmFuc2Zvcm09J21hdHJpeCgtMSAwIDAgMSAwIDApJyBmaWxsLW9wYWNpdHk9JzAuNzInIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PScwJyB5PSc2NCcgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTMyJyB5PSc4MCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nMzInIHk9Jy0xNicgZmlsbC1vcGFjaXR5PScwLjU0JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTY0JyB5PScwJyB0cmFuc2Zvcm09J21hdHJpeCgtMSAwIDAgMSAwIDApJyBmaWxsLW9wYWNpdHk9JzAuNzInIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSczMicgeT0nMTYnIGZpbGwtb3BhY2l0eT0nMC41NCcgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9Jy02NCcgeT0nMzInIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIGZpbGwtb3BhY2l0eT0nMC4zNicgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9JzMyJyB5PSc0OCcgZmlsbC1vcGFjaXR5PScwLjE4JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTY0JyB5PSc2NCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nMzInIHk9JzgwJyBmaWxsLW9wYWNpdHk9JzAuNTQnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctOTYnIHk9Jy0xNicgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nNjQnIHk9JzAnIGZpbGwtb3BhY2l0eT0nMC4zNicgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9Jy05NicgeT0nMTYnIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIGZpbGwtb3BhY2l0eT0nMC41NCcgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9JzY0JyB5PSczMicgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTk2JyB5PSc0OCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjE4JyB4bGluazpocmVmPScjcycgLz4JCgk8dXNlIHg9JzY0JyB5PSc2NCcgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTk2JyB5PSc4MCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nOTYnIHk9Jy0xNicgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTEyOCcgeT0nMCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nOTYnIHk9JzE2JyBmaWxsLW9wYWNpdHk9JzAuMTgnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctMTI4JyB5PSczMicgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjU0JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nOTYnIHk9JzQ4JyBmaWxsLW9wYWNpdHk9JzAuNTQnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctMTI4JyB5PSc2NCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjE4JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nOTYnIHk9JzgwJyBmaWxsLW9wYWNpdHk9JzAuMzYnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctMTYwJyB5PSctMTYnIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIGZpbGwtb3BhY2l0eT0nMC41NCcgeGxpbms6aHJlZj0nI3MnIC8+CQoJPHVzZSB4PScxMjgnIHk9JzAnIGZpbGwtb3BhY2l0eT0nMC43MicgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9Jy0xNjAnIHk9JzE2JyB0cmFuc2Zvcm09J21hdHJpeCgtMSAwIDAgMSAwIDApJyBmaWxsLW9wYWNpdHk9JzAuMTgnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PScxMjgnIHk9JzMyJyBmaWxsLW9wYWNpdHk9JzAuMzYnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctMTYwJyB5PSc0OCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjU0JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nMTI4JyB5PSc2NCcgZmlsbC1vcGFjaXR5PScwLjE4JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTE2MCcgeT0nODAnIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIGZpbGwtb3BhY2l0eT0nMC41NCcgeGxpbms6aHJlZj0nI3MnIC8+Cgk8dXNlIHg9JzE2MCcgeT0nLTE2JyBmaWxsLW9wYWNpdHk9JzAuMzYnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctMTkyJyB5PScwJyB0cmFuc2Zvcm09J21hdHJpeCgtMSAwIDAgMSAwIDApJyBmaWxsLW9wYWNpdHk9JzAuMzYnIHhsaW5rOmhyZWY9JyNzJyAvPgkKCTx1c2UgeD0nMTYwJyB5PScxNicgZmlsbC1vcGFjaXR5PScwLjcyJyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nLTE5MicgeT0nMzInIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIGZpbGwtb3BhY2l0eT0nMC4zNicgeGxpbms6aHJlZj0nI3MnIC8+CQoJPHVzZSB4PScxNjAnIHk9JzQ4JyBmaWxsLW9wYWNpdHk9JzAuNTQnIHhsaW5rOmhyZWY9JyNzJyAvPgoJPHVzZSB4PSctMTkyJyB5PSc2NCcgdHJhbnNmb3JtPSdtYXRyaXgoLTEgMCAwIDEgMCAwKScgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTx1c2UgeD0nMTYwJyB5PSc4MCcgZmlsbC1vcGFjaXR5PScwLjM2JyB4bGluazpocmVmPScjcycgLz4KCTwvZz4KCTx1c2UgeD0nLTE5MicgeT0nOTYnIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAxIDAgMCknIHhsaW5rOmhyZWY9JyNiJyAvPgoJPHVzZSB4PSctMzg0JyB5PSctNjQnIHRyYW5zZm9ybT0nbWF0cml4KC0xIDAgMCAtMSAwIDApJyB4bGluazpocmVmPScjYicgLz4KCTx1c2UgeD0nMTkyJyB5PSctMTI4JyB0cmFuc2Zvcm09J21hdHJpeCgxIDAgMCAtMSAwIDApJyB4bGluazpocmVmPScjYicgLz4KCTx1c2UgeD0nMTkyJyB5PSctMjI0JyB0cmFuc2Zvcm09J21hdHJpeCgxIDAgMCAtMSAwIDApJyB4bGluazpocmVmPScjYicgLz4KPC9zdmc+Cg==);
      }

      html,body{
      position: relative;
      height: 100%;
      }

      .login-container{
      position: relative;
      margin: 80px auto;
      padding: 20px 40px 40px;
      text-align: center;
      background: #fff;
      border: 1px solid #ccc;
      -webkit-box-shadow: 1px 2px 6px 0px rgba(171,171,171,1);
      -moz-box-shadow: 1px 2px 6px 0px rgba(171,171,171,1);
      box-shadow: 1px 2px 6px 0px rgba(171,171,171,1);
      }

      #output{
      position: absolute;
      width: 300px;
      top: -75px;
      left: 0;
      color: #fff;
      }

      #output.alert-success{
      background: rgb(25, 204, 25);
      }

      #output.alert-danger{
      background: rgb(228, 105, 105);
      }

      .avatar{
      width: 100px;height: 100px;
      margin: 10px auto 30px;
      border-radius: 100%;
      border: 2px solid #aaa;
      background-size: cover;
      }

      .form-box input{
      width: 100%;
      padding: 10px;
      text-align: left;
      height:40px;
      border: 1px solid #ccc;;
      background: #fafafa;
      transition:0.2s ease-in-out;

      }

      .form-box input:focus{
      outline: 0;
      background: #eee;
      }

      .form-box input[type="text"]{
      border-radius: 5px 5px 0 0;
      text-transform: lowercase;
      }

      .form-box input[type="password"]{
      border-radius: 0 0 5px 5px;
      border-top: 0;
      }

      .form-box button.login{
      margin-top:15px;
      padding: 10px 20px;
      }

      .input-group{
      margin-bottom: 30px;
      }

      .animated {
      -webkit-animation-duration: 1s;
      animation-duration: 1s;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
      }

      @-webkit-keyframes fadeInUp {
      0% {
      opacity: 0;
      -webkit-transform: translateY(20px);
      transform: translateY(20px);
      }

      100% {
      opacity: 1;
      -webkit-transform: translateY(0);
      transform: translateY(0);
      }
      }

      @keyframes fadeInUp {
      0% {
      opacity: 0;
      -webkit-transform: translateY(20px);
      -ms-transform: translateY(20px);
      transform: translateY(20px);
      }

      100% {
      opacity: 1;
      -webkit-transform: translateY(0);
      -ms-transform: translateY(0);
      transform: translateY(0);
      }
      }

      .fadeInUp {
      -webkit-animation-name: fadeInUp;
      animation-name: fadeInUp;
      }

      </style>

   </body>

</html>
