<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1B1E32" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('custom_css/registerstyle.css')}}">
</head>

<body>
    <div class="container">
        <div class="form-control">
            <div class="header">
                Ghost's Registration
            </div>
            <div class="form" >

                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="name-form">
                        <div class="input-gp name">
                            <input class="input" type="text" name="firstName" placeholder="Enter your First Name" id="" value="{{old('firstName')}}">
                            @error('firstName')
                            <span class="alert alert-danger">*required first name</span>
                            @enderror

                        </div>

                        <div class="input-gp name">
                            <input class="input" type="text" name="secondName" id="" placeholder="Enter your Second Name" value="{{old('secondName')}}">
                            @error('secondName')
                            <span class="alert alert-danger">*required second name</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mail-form input-gp">
                        <input class="input mail" type="text" name="ghostmail" placeholder="User Name" id="" autocomplete="false"  value="{{old('ghostmail')}}">
                        <div class="ghostmail">@ghost.com</div>
                    </div>
                    @error('ghostmail')
                    <span class="alert alert-danger">*This user name is already use</span>
                    @enderror

                    <div class="name-form">
                        <div class="input-gp name">
                            <input class="input" type="password" name="password" placeholder="Enter Password" id="">
                            @error('password')
                            <span class="alert alert-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-gp name">
                            <input class="input" type="password" name="password_confirmation" id="" placeholder="Confirm Password">
                            @error('password_confirmation')
                            <span class="alert alert-danger">*password require</span>
                            @enderror
                        </div>
                    </div>
                    <div class="btn-gp">

                        <span class=" privcy-text">Creating account,You Accept <a href="">Our Team&Privacy Policy of Ghost</a></span>
                        <button class="register-btn">Register</button>
                    </div>
                </form>
            </div>

            <div class="login-media">
                <img src="{{asset('asset/img/media.png')}}" alt="">
                <span class="media-text">Easy to Create,<br>Easy to Use</span>
                <a href="{{route('login')}}" class="redirect-login">Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
