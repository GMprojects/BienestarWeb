<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<title>Farmacia y Bioquímica</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
      <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('mini/mini.css') }}" />
      <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('bower_components/facfar/css/fontello.css') }}">
		<link rel="stylesheet" href="{{ asset('plugins/icheck/skins/square/grey.css') }}">
		<!-- Scripts -->
		<script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
      <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('mini/skel.min.js')}}"></script>
      <script src="{{ asset('mini/util.js')}}"></script>
		<script src="{{ asset('mini/mini.js')}}"></script>
		<script src="{{ asset('plugins/icheck/icheck.js') }}"></script>
	</head>
	<body style="background:#d2d6de;">
		<!-- Wrapper -->
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<!-- Header -->
					<header id="header">
						<a href="{{ route('home') }}" class="logo"><i class="fa fa-home"></i><strong> Farmacia </strong> y Bioquímica</a>
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
						</ul>
					</header>
            </div>
				@yield('contenido')
         </div>
      </div>
	</body>
</html>
