@extends('user.profile.master.layout')
@section('body')
<div class="profile">
    <div class="profile-header">
       <a href="{{route('dashboard')}}" class="back-btn" > <i class="fa-solid fa-caret-left"></i> back</a>
    </div>
    @if (session('success'))
        <div class="profile-header status">
            {{session('success')}}
        </div>
    @endif
    <div class="profile-img info">
        @if (Auth::user()->image)
                    <img class="pf-img" src="{{ asset('storage/img/test.jpg') }}" alt="admin's profile photo">
        @else
            <div class="Textprofile ">
                    {{ Auth::user()->firstName[0] }}
            </div>
        @endif

    </div>
    <div class="profile-name info">
        <h4>{{ Auth::user()->firstName .' '. Auth::user()->secondName }}</h4>
    </div>
    <form action="{{route('profileUpdate')}}" method="POST">
        @csrf
        <div class="profile-information">
            <div class="names">
               <div class="fname input-gp">
                    <label for="fname" aria-label="First Name">First Name</label>
                    <input type="text" id="fname" name="fname" class="inputName" value="{{ Auth::user()->firstName }}">
                    <span class="error ferror">Require firstName</span>
               </div>
               <div class="lastName input-gp">
                    <label for="lastName" aria-label="last name">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="inputName" value="{{ Auth::user()->secondName }}">
                    <span class="error sec_error">Require firstName</span>
                </div>
            </div>
            <div class="profileMail  input-gp">
                <label for="mail" aria-label="mail">Mail</label>
                <input class="mail u-info" id="mail" value="{{Auth::user()->ghostmail}}" disabled>
            </div>
            <div class="btn-gp">
                <button type="submit" class="change-btn btn" disabled>
                    Save Change
                </button>
               <a href="{{route('restartPasswordPage')}}" class="link-btn">
                    Restart Password
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('jquery')
<script src="{{asset('js/profile.js')}}"></script>
@endsection



