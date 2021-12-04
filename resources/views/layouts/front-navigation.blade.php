

<div class="site-header">
    <div class="container">
        <a href="welcome.blade.php" class="branding">
            <img src="{{ secure_asset('img/system/logo_chuonchuon.png') }}" alt="" class="logo" width="70px" border-radius="10px">
            <div class="logo-type">
                <h1 class="site-title">Chuồn Chuồn</h1>
                <small class="site-description">Dự báo thời tiết</small>
            </div>
        </a>

        <!-- Default snippet for navigation -->
        <div class="main-navigation">
            <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
            <ul class="menu">
                <li class="menu-item {{ strpos(Route::currentRouteName(), 'homepage') === 0 ? ' current-menu-item': '' }}">
                    <a href="{{ route('homepage') }}">Thời tiết hôm nay</a></li>
                <li class="menu-item {{ strpos(Route::currentRouteName(), 'hourly-forecast') === 0 ? 'current-menu-item' : '' }}">
                    <a href="{{ route('hourly-forecast') }}">Hàng giờ</a></li>
                <li class="menu-item {{ strpos(Route::currentRouteName(), 'daily-forecast') === 0 ?'current-menu-item': '' }}">
                    <a href="{{ route('daily-forecast') }}">7 ngày</a></li>
                <li class="menu-item {{ strpos(Route::currentRouteName(), 'about') === 0 ? 'current-menu-item': '' }}">
                    <a href="{{ route('about') }}">Giới thiệu</a></li>
            </ul>
                @auth
                <div class="dropdown">
                    <button class="dropbtn"> {{ Auth::user()->name }}</button>
                    <div class="dropdown-content">
                        <form action="{{ route('logout') }}" method="POST">
                            <a><button type="submit">Đăng Xuất</button></a>
                        </form>
                    </div>
                </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm btn-rounded">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm btn-rounded">Đăng ký</a>
                @endauth

        </div> <!-- .main-navigation -->

        <div class="mobile-navigation"></div>

    </div>
</div> <!-- .site-header -->

