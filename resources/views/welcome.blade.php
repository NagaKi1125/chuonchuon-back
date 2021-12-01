<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

		<title>Compass Starter by Ariona, Rian</title>

		<!-- Loading third party fonts -->
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/guest.css') }}">


		<!-- Loading main css file -->
		<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

		<link rel='shortcut icon' href='{{ asset('img/system/logo_chuonchuon.png') }}' />
	</head>

	<body>

		<div class="site-content">
			<div class="site-header">
				<div class="container">
					<a href="welcome.blade.php" class="branding">
						<img src="{{ asset('img/system/logo_chuonchuon.png') }}" alt="" class="logo" width="70px" border-radius="10px">
						<div class="logo-type">
							<h1 class="site-title">Chuon Chuon</h1>
							<small class="site-description">Dự báo thời tiết</small>
						</div>
					</a>

					<!-- Default snippet for navigation -->
					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item current-menu-item"><a href="index.html">Thời tiết hôm nay</a></li>
							<li class="menu-item"><a href="news.html">Hàng giờ</a></li>
							<li class="menu-item"><a href="#livecamera">7 ngày kế tiếp</a></li>
							<li class="menu-item"><a href="photos.html">Giới thiệu</a></li>
                            @auth
                            <div class="dropdown">
								<button class="dropbtn"> {{ Auth::user()->name }}</button>
                                <div class="dropdown-content">
									<a href="#">Đăng Xuất</a>
								</div>
							</div>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Đăng nhập</a>
                                <a href="{{ route('register') }}" class="btn btn-sm primary bt-sm">Đăng ký</a>
                            @endauth

					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>

				</div>
			</div> <!-- .site-header -->

			<div class="hero" style="background-image: url({{ asset('img/system/download.jpg') }})">
				<div class="container">
					<form action="#" class="find-location">
						<input type="text" placeholder="Find your location...">
						<input type="submit" value="Find">
					</form>

				</div>
			</div>
			<div class="forecast-table">
				<div class="container">
					<div class="forecast-container">
						<div class="today forecast">
							<div class="forecast-header">
								<div class="day">Monday</div>
								<div class="date">6 Oct</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="location">New York</div>
								<div class="degree">
									<div class="num">23<sup>o</sup>C</div>
									<div class="forecast-icon">
										<img src="{{ asset('img/icons/icon-1.svg') }}" alt="" width=90>
									</div>
								</div>
								<span><img src="{{ asset('img/icons/icon-umberella.png') }}" alt="">20%</span>
								<span><img src="{{ asset('img/icons/icon-wind.png') }}" alt="">18km/h</span>
								<span><img src="{{ asset('img/icons/icon-compass.png') }}" alt="">East</span>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Tuesday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="images/icons/icon-3.svg" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Wednesday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="images/icons/icon-5.svg" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Thursday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="images/icons/icon-7.svg" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Friday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="images/icons/icon-12.svg" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Saturday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="images/icons/icon-13.svg" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Sunday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="images/icons/icon-14.svg" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
					</div>
				</div>
			</div>

			<main class="main-content">
				<div class="fullwidth-block">
					<div class="container">
						<h2 class="section-title" id="livecamera">Hourly Weather</h2>
						<div class="row">
							<div class="col-md-3 col-sm-6">
								<div class="live-camera">
									<figure class="live-camera-cover"><img src="images/live-camera-1.jpg" alt=""></figure>
									<h3 class="location">New York</h3>
									<small class="date">8 oct, 8:00AM</small>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="live-camera">
									<figure class="live-camera-cover"><img src="images/live-camera-2.jpg" alt=""></figure>
									<h3 class="location">Los Angeles</h3>
									<small class="date">8 oct, 8:00AM</small>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="live-camera">
									<figure class="live-camera-cover"><img src="images/live-camera-3.jpg" alt=""></figure>
									<h3 class="location">Chicago</h3>
									<small class="date">8 oct, 8:00AM</small>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="live-camera">
									<figure class="live-camera-cover"><img src="images/live-camera-4.jpg" alt=""></figure>
									<h3 class="location">London</h3>
									<small class="date">8 oct, 8:00AM</small>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="fullwidth-block" data-bg-color="#262936">
					<div class="container">

					</div>
				</div>

				<div class="fullwidth-block">
					<div class="container">

					</div>
				</div>
			</main> <!-- .main-content -->


		</div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
         integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

	</body>

</html>
