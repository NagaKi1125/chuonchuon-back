<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="text-center">
                <h1>Welcome to Chuon chuon's Admin Panel</h1>
                This page is only available for administrators. Please log in to your account if you're an administrator...
            </div>
            <div class="guest-footer text-center container">
                Or you can try our's application
                <div class="row">
                    <div class="col-md">
                        <a class="btn btn-outline-primary btn-sm" href="">Chuonchuon Website</a>
                    </div>
                    <div class="col-md">
                        <a class="btn btn-outline-primary btn-sm" href="">Chuonchuon for android</a>
                    </div>
                    <div class="col-md">
                        <a class="btn btn-outline-primary btn-sm" href="">Desktop application</a>
                    </div>
                </div>
            </div>
        </x-slot>
        <b class="text-center title">Admin Login</b>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

</x-guest-layout>
