{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles_login.css">
</head>
<body>
<div class="center">
      <h1>Đăng ký</h1>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="txt_field">
          <input  id="name" type="text" name="name" :value="old('name')" required autofocus />
          <span></span>
          <label for="name" value="__('Name')">Tên người dùng</label>
        </div>

        <div class="txt_field">
            <input id="email" type="email" name="email" :value="old('email')" required autofocus>
            <span></span>
            <label for="email" value="__('Email')">E-mail</label>
          </div>

        <div class="txt_field">
          <input  id="password" type="password" name="password" required autocomplete="new-password">
          <span></span>
          <label for="password" value="__('Password')">Mật khẩu</label>
        </div>

        <div class="txt_field">
          <input id="password_confirmation" type="password" name="password_confirmation" required >
          <span></span>
          <label for="password_confirmation" value="__('Confirm Password')" >Nhập lại mật khẩu</label>
        </div>

        <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <input type="submit" value=" Đăng ký">

        <div class="signup_link">
          Đã có tài khoản. <a href="{{ route('login') }}">Đến đăng nhập</a>
        </div>

      </form>

    </div>

</body>
</html>
