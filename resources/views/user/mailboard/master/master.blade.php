<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1B1E32" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ghost Mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('custom_css/mailboard.css')}}">
</head>
<body>
    <?php $path=request()->segment(count(request()->segments()));?>
    <nav class="mobile-nav">
        <div class="logo">
            <span class="cross-icon"><i class="fa-solid fa-xmark"></i></span>
            <div class="mobile-logo me-2"><i class="fa-solid fa-ghost me-2"></i><span>Ghost</span></div>

        </div>
        <div class="list">
            <ul class="menu-list">
                <li class="menu-item inbox active mb"><span><i class="fa-solid fa-inbox me-2"></i>Inbox</span> <span class="badge-inbox unread">0</span></li>
                <li class="menu-item send mb"><span><i class="fa-solid fa-paper-plane me-2"></i>Send</span></li>
                <li class="menu-item archive mb "><span><i class="fa-solid fa-box-archive me-2"></i>Archive</span></li>
                <li class="menu-item trash mb"><span><i class="fa-solid fa-trash me-2"></i>Trash</span></li>
            </ul>
        </div>

        <div class="nav-copyright">
            <span>&copy; All right reveres by <span class="logo-text">Ghost</span></span>
        </div>
    </nav>
    <nav>
        <div class="logo">
            <span class="cross-icon"><i class="fa-solid fa-xmark"></i></span>
            <div class="mobile-logo me-2"><i class="fa-solid fa-ghost me-2"></i><span>Ghost</span></div>

        </div>
        <div class="list">
            <ul class="menu-list">
                <a href="/"><li class="menu-item inbox {{$path=='dashboard'?'active':''}}"><span><i class="fa-solid fa-inbox me-2"></i>Inbox</span> <span class="badge-inbox unread">0</span></li></a>
                <a href="{{ route('SendedMailview') }}"><li class="menu-item send {{$path=='view'?'active':''}}"><span><i class="fa-solid fa-paper-plane me-2"></i>Send</span></li></a>
                <li class="menu-item archive"><span><i class="fa-solid fa-box-archive me-2"></i>Archive</span></li>
                <li class="menu-item trash"><span><i class="fa-solid fa-trash me-2"></i>Trash</span></li>
            </ul>
        </div>

        <div class="nav-copyright">
            <span>&copy; All right reveres by <span class="logo-text">Ghost</span></span>
        </div>
    </nav>
    <section class="inbox-section">
        <header class="inbox-header">
            <h1 class="header">Inbox</h1>
            <div class="logo res-logo">
                <i class="fa-solid fa-ghost me-2"></i><span>Ghost</span>
            </div>
            <div class="header-accInfo">
                <span class="mail">{{Auth::user()->ghostmail}}</span>
                @if (Auth::user()->image)
                <img class="pf-img dropper" src="{{asset('storage/img/test.jpg')}}" alt="admin's profile photo" width="40px" height="40px">
                @else
                <div class="Textprofile dropper">
                    {{Auth::user()->firstName[0]}}
                </div>

                @endif

                <div class="dropbox">
                    <div class="userProfile db-fe">
                        <a href=""><i class="fa-solid fa-user"></i>Profile</a>

                    </div>
                    <div class="logout db-fe">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf

                            <input type="hidden" name="">
                            <a href="#" onclick="this.parentNode.submit();"><i class="fa-solid fa-door-closed"> </i>Logout</a>
                        </form>
                    </div>
                </div>
            </div>

        </header>

        <section class="seo">

            <div class="search">
                <div class="sub-menu">
                    <span class=" search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <span  class="menu-icon" > <i class="fa-solid fa-bars"></i></span>
                    <input type="text" class="searchInput" placeholder="Search Mails.....">
                </div>

            </div>
            <div class="filter">
                <select name="sort" class="filter-opt sort" id="">
                    <option value="all">All</option>
                    <option value="read">Read</option>
                    <option value="unread">Unread</option>

                </select>


            </div>
        </section>


        <div class="condition">
            From <i class="from fa-solid fa-sort-down"></i>
        </div>
        <div class="mails-container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="mails-warp">

            </div>

        </div>
        <section class="ReadPage test">
            <div class="readmore">
            </div>
        </section>
        <section class="mail-create">

            <div class="creation-header">
                <button class="btn-back"><i class="fa-solid fa-arrow-left-long" style="padding-right: 5px;"></i>Back</button>
            </div>
            <div class="form-gp">
                <form action="{{route('sendMail')}}">
                    <div class="input-gp">
                        <label for="#mail-address">Mail Address</label>
                        <input type="email"  name="ghostmail_rev" placeholder="Eg. email@ghost.com" class="mail-address g_mail">
                        <span class="error mail_error"></span>
                    </div>
                    <div class="input-gp">
                        <label for="#mail-address">Subject</label>
                        <input type="text" name="subject" placeholder="Subject" class="mail-address">
                    </div>
                    <div class="input-gp">
                        <label for="#mail-address">Messages</label>
                        <textarea name="message" class="mail-address text-mes" id="" cols="30" rows="10"></textarea>
                        <span class="error message_error"></span>
                    </div>
                    <div class="create-submitbtn">
                        <button type="submit" class="submit">
                            <i class="fa-solid fa-paper-plane"></i> Send
                        </button>
                    </div>
                </form>
            </div>

        </section>

    </section>





<div class="createFloat-btn">
    <div class="icon"><i class="fa-regular fa-pen-to-square"></i></div>
    <div class="icon-text">create</div>

</div>


</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/mailboard.js')}}"></script>
@stack('JavaScript');


</html>
