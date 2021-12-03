<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ secure_asset('css/styles_login.css') }}">
</head>
<body>
<div class="center">
      <h1>Đăng nhập</h1>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="txt_field">
          <input type="text" id ="email" name="email" autofocus autocomplete required>
          <span></span>
          <label for="email" value="__('Email')">E-mail</label>
        </div>

        <div class="txt_field">
          <input type="password" id="password" name="password" required autocomplete="current-password" >
          <span></span>
          <label for="password" value="__('Password')">Mật khẩu</label>
        </div>

        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Quên mật khẩu') }}
            </a>
        @endif

        <input type="submit" value="Đăng nhập">
        <div class="signup_link">
          Not a member? <a href="{{ route('register') }}">Sign up</a>
        </div>

        {{-- <div class="flex items-center justify-end mt-4">
            <x-button class="ml-3">
                {{ __('Log in') }}
            </x-button>
        </div>
            <!-- Remember Me -->
            <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

      </form>


    </div>

</body>
</html>
