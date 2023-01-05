
@extends('user.Auth.master.AuthLayout')
@section('css',asset('/custom_css/loginstyle.css'))

@section('layouts')
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
                <input class="input" type="text" name="email" placeholder="Enter ghost mail" id="" auto value="{{old('email')}}">
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

@endsection

