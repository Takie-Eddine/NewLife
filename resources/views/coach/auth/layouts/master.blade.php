<!DOCTYPE html>
<html lang="en">

	<head><base href="../../../"/>
		<title>@yield('title')</title>
		<meta charset="utf-8" />
        <link rel="shortcut icon" href="{{asset('images/logo/NewLife Brand Guidelines-18.png')}}" />

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        @stack('style')
	</head>
	<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
        @include('coach.auth.layouts.init')

        @yield('content')

		<script>var hostUrl = "{{asset('assets/')}}";</script>
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

        @stack('script')
	</body>
</html>
