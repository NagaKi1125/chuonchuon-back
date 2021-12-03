<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

		<title>Chuồn Chuồn</title>

		<!-- Loading third party fonts -->
		{{--  <link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">  --}}

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/guest.css') }}">


		<!-- Loading main css file -->
        <link rel="stylesheet" href="{{ secure_asset('css/front.css') }}">
		<link rel="stylesheet" href="{{ secure_asset('css/styles.css') }}">

		<link rel='shortcut icon' href='{{ secure_asset('img/system/logo_chuonchuon.png') }}' />
	</head>

	<body>

		<div class="site-content">

            {{-- front navigation --}}
            @include('layouts.front-navigation')


            @yield('body')

            @include('layouts.footer-front')
		</div>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script src="js/plugins.js"></script>
		<script src="js/apps.js"></script>
        @yield('js')


	</body>

</html>
