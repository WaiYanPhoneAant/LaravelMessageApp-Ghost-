@extends('user.profile.master.layout')


@section('body')
<div class="profile">
    <div class="profile-header">
       <a href="{{route('profile')}}" class="back-btn" > <i class="fa-solid fa-caret-left"></i> back</a>
    </div>

    <div class="profile-header">
        Restart Password
     </div>
     @if (session('success'))
        <div class="profile-header status">
            {{session('success')}}
        </div>
    @endif
    @if (session('error'))
        <div class="profile-header status-error">
            {{session('error')}}
        </div>
    @endif
    <form action="{{route('restartPassword')}}" method="POST">
        @csrf
        <div class="profile-information">

            <div class="profileMail  input-gp">
                <label for="oldPw" aria-label="oldPw">Old Password</label>
                <input class="mail u-info" id="oldPw" type="password" name='old_pw'>
                @error('old_pw')
                    <span class="error">
                        *{{$message}}
                    </span>
                @enderror
            </div>
            <div class="profileMail  input-gp">
                <label for="Npw" aria-label="Npw">New Password</label>
                <input class="mail u-info" id="Npw" type="password"  name='new_pw'>
                @error('new_pw')
                    <span class="error">
                        *{{$message}}
                    </span>
                @enderror
            </div>
            <div class="profileMail  input-gp">
                <label for="cPw" aria-label="mail">Confirm Pasword</label>
                <input class="mail u-info" id="cPw" type="password"  name='confirm_pw'>
                @error('confirm_pw')
                    <span class="error">
                        *{{$message}}
                    </span>
                @enderror
            </div>
            <div class="btn-gp">
                <button type="submit" class="change-btn btn" >
                    Change Password
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
