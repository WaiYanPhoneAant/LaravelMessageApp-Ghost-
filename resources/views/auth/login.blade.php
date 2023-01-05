<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1B1E32" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/custom_css/loginstyle.css')}}">
</head>
<body>
    <div class="container">
        <div class="form-control">
            <div class="header">
                <div class="logo">
                    <i class="fa-solid fa-ghost me-2"></i>Ghost
                </div>
                <div class="header-text">
                    <h3>Welcome back!</h3>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <x-jet-validation-errors class="text-danger header-error" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="input-container">
                    <input class="input" type="text" name="email" placeholder="Enter ghost mail" id="">
                    <span class="text-danger error-msg">*Mail required</span>
                </div>

                <div class="input-container">
                    <input class="input " type="password" name="password" placeholder="Enter Your Password" id="">

                    <span class="text-danger error-msg">*Password required</span>
                </div>
                <div class="check">
                    <div class="checkbox"><x-jet-checkbox id="remember_me" name="remember" />Remember me</div>
                    <a class="fg-pw" href="">forget password?</a>
                </div>
                <div class="button-login">
                    <button type="submit">
                        login
                    </button>
                </div>
                <div class="button-reg">
                    <a class="register" href="{{route('register')}}">
                        Create Account
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> --}}
