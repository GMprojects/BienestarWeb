<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
		<style type="text/css">
			* {
				margin: 0px;
				padding: 0px;
			}
			body {
				background: url('shattered-island.gif');
				background-position: center;
			}
			form {
				background: #fff;
				background-position: center;
				width: 300px;
				border: 1px;
				border-radius: 5px;
				box-shadow: 0 0 10px #000;
				margin:100px auto;
				height: 300px;
				padding-left: 10px;
				padding-right: 10px;
			}
			h3 {
				text-align: center;
			}
		</style>
	</head>
	<body>
		{!! Form::open(['url'=>'admin/persona','method'=>'POST','autocomplete'=>'off','files'=>'false']) !!}
		{{ Form::token() }}
			@section('content')
		{!! Form::close() !!}
		<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	</body>
</html>
