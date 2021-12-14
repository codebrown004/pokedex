<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="shortcut icon" href="{{ asset('/img/Poké_Ball_icon.svg.png') }}" type="image/x-icon">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	@stack('styles')
	<title>@yield('title')</title>
</head>
<body>

	@if(auth()->check())
		@include('layouts.nav')
	@endif
	
	<div id="app" class="container">
		@yield('content')
	</div>

@include('layouts.footer')


</body>
</html>