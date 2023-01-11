<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1B1E32" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ghost Mail</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/img/media.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('asset/img/media.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('asset/img/media.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('asset/img/media.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('custom_css/mailboard.css') }}">
</head>

<body>
    <?php $path = request()->segment(count(request()->segments())); ?>
    <nav class="mobile-nav">
        <div class="logo">
            <span class="cross-icon"><i class="fa-solid fa-xmark"></i></span>
            <div class="mobile-logo me-2"><i class="fa-solid fa-ghost me-2"></i><span>Ghost</span></div>

        </div>
        <div class="list">
            <ul class="menu-list">
                <a href="/">
                    <li class="menu-item inbox {{ $path == 'dashboard' ? 'active' : '' }} mb"><span><i
                                class="fa-solid fa-inbox me-2"></i>Inbox</span> <span
                            class="badge-inbox {{ $path == 'dashboard' ? 'unread' : 'd-none' }}">0</span></li>
                </a>
                <a href="{{ route('SendedMailview') }}">
                    <li class="menu-item send mb {{ $path == 'view' ? 'active' : '' }}"><span><i
                                class="fa-solid fa-paper-plane me-2"></i>Send</span></li>
                </a>
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
                <a href="/">
                    <li class="menu-item inbox {{ $path == 'dashboard' ? 'active' : '' }}"><span><i
                                class="fa-solid fa-inbox me-2"></i>Inbox</span> <span
                            class="badge-inbox {{ $path == 'dashboard' ? 'unread' : 'd-none' }} ">0</span></li>
                </a>
                <a href="{{ route('SendedMailview') }}">
                    <li class="menu-item send {{ $path == 'view' ? 'active' : '' }}"><span><i
                                class="fa-solid fa-paper-plane me-2"></i>Send</span></li>
                </a>
                <li class="menu-item archive"><span><i class="fa-solid fa-box-archive me-2"></i>Archive</span></li>
                <li class="menu-item trash"><span><i class="fa-solid fa-trash me-2"></i>Trash</span></li>
            </ul>
        </div>

        <div class="nav-copyright">
            <span>&copy; All right reveres by <span class="logo-text">Ghost</span></span>
        </div>
        <div class="alert-dark"></div>
    </nav>
    <section class="inbox-section">
        <header class="inbox-header">
            <h1 class="header">@yield('header')</h1>
            <div class="logo res-logo">
                <i class="fa-solid fa-ghost me-2"></i><span>Ghost</span>
            </div>
            <div class="header-accInfo">
                <span class="mail">{{ Auth::user()->ghostmail }}</span>
                @if (Auth::user()->image)
                    <img class="pf-img dropper" src="{{ asset('storage/img/test.jpg') }}" alt="admin's profile photo"
                        width="40px" height="40px">
                @else
                    <div class="Textprofile dropper">
                        {{ Auth::user()->firstName[0] }}
                    </div>
                @endif

                <div class="dropbox">
                    <div class="userProfile db-fe">
                        <a href=""><i class="fa-solid fa-user"></i>Profile</a>

                    </div>
                    <div class="logout db-fe">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <input type="hidden" name="">
                            <a href="#" onclick="this.parentNode.submit();"><i class="fa-solid fa-door-closed">
                                </i>Logout</a>
                        </form>
                    </div>
                </div>
            </div>

        </header>

        <section class="seo">

            <div class="search">
                <div class="sub-menu">
                    <span class=" search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <span class="menu-icon"> <i class="fa-solid fa-bars"></i></span>
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


        <div class="condition search-key">
            {{-- From <i class="from fa-solid fa-sort-down"></i> --}}
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
        <section class="ReadPage test readmore">
            <div class="">
            </div>
        </section>
        <section class="mail-create">

            <div class="creation-header">
                <button class="btn-back"><i class="fa-solid fa-arrow-left-long"
                        style="padding-right: 5px;"></i>Back</button>
            </div>
            <div class="form-gp">
                <form action="{{ route('sendMail') }}">
                    <div class="input-gp">
                        <label for="#mail-address">Mail Address</label>
                        <input type="email" name="ghostmail_rev" placeholder="Eg. email@ghost.com"
                            class="mail-address g_mail">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"
    integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/mailboard.js') }}"></script>


<script>
    $(document).ready(function() {
        $currentRoute = `@stack('route')`;
        $test = 'test';
        $interval = true;
        $auto=true;
        // @stack('mailsDisplay');

        if ($currentRoute == 'inbox') {
            ajax(mailsDisplay);
        } else if ($currentRoute == 'send') {
            ajax(mailsDisplay, {
                sendData: 'send'
            }, '/mail/getSendMail');
        }
        //security
        function escapeHtml(text) {
            var map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, function(m) {
                return map[m];
            });
        }

        //to show mails
        function mailsDisplay(mails) {
            if (mails.length > 0) {
                $count = 0;
                mails.forEach(m => {
                    if (m.read_status == 0) {
                        $count++;
                    }
                    $('.unread').text($count);
                    $('.mails-warp').append(mailsTag(m));
                    $('.readmore').append(readmore(m));


                });
            } else {
                $('.mails-warp').append(
                    '<div class="noMail"><i class="fa-regular fa-face-sad-tear"></i>Ooops!There is no mail to show</div>'
                    )
            }

            autoUpdate();

        }
        // auto update data
        function autoUpdate() {
            return setInterval(() => {
                if($auto==true){
                    if ($interval) {
                    $sortVal = $('.sort').val()
                    if ($sortVal != 'all') {
                        $data = {
                            'data': $sortVal,
                            sendData: 'send'
                        };
                        if ($currentRoute == 'inbox') {
                            ajax(mailappend, $data, '/mail/getMailSorting');
                        } else if ($currentRoute == 'send') {
                            ajax(mailappend, $data, '/mail/getSendMail');
                        }

                    } else {
                        if ($currentRoute == 'inbox') {
                            ajax(mailappend);
                        } else if ($currentRoute == 'send') {
                            ajax(mailappend, {
                                sendData: 'send'
                            }, '/mail/getSendMail');
                        }
                    }
                    }
                }


            }, 1000);
        }
        //to append mail
        function mailappend(mails) {
            $mailDataLength = mails.length;
            if ($mailDataLength > 0) {
                $oriMailsLength = $('.mails').length;
                // console.log($oriMailsLength);
                // console.log('-----------------start-----------------');
                $count = 0;
                mails.forEach(m => {
                    if (m.read_status == 0) {
                        $count++;
                    }
                    $('.unread').text($count);
                });
                if (mails.length > $oriMailsLength) {
                    $newMails = mails.length - $oriMailsLength;
                    $('.noMail').text('');
                    for (let i = 0; i < $newMails; i++) {

                        $mailsort = $newMails - (i + 1);
                        $('.mails-warp').prepend(mailsTag(mails[$mailsort]));
                        $('.readmore').append(readmore(mails[$mailsort]));
                    }

                }
            } else {
                $('.mails-warp').text('');
                $('.readmore').text('');
                $('.mails-warp').append(
                    '<div class="noMail"><i class="fa-regular fa-face-sad-tear"></i>Ooops!There is no mail to show</div>'
                    )
            }
        }
        // realtime update

        //ajax call
        function ajax(funcForDisplay, $data = {}, $route = '/mail') {
            $.ajax({
                type: 'get',
                url: $route,
                dataType: 'json',
                data: $data,
                success: (mails) => {
                    funcForDisplay(mails.data)
                },
            })
        }
        //html mails tags
        function mailsTag(data) {
            $date=new Date(data.created_at);
            return `
                <div class="mails" id="${data.mail_id}" onclick="readMore(${data.mail_id});">

                    <div class="info mails-item" >
                        ${data.img?`<img class="pf-img" src="{{ asset('storage/img/test.jpg') }}" alt="admin's profile photo" width="40px" height="40px">`:
                        `<div class="Textprofile" >
                            ${data.sender[0]}
                        </div>`}
                    <span class="se-name">${data.name} <span class="p-mail mail">${data.sender}</span></span>
                    <div class="res-tools mails-item">


                        <span class="date">${$date.toLocaleDateString()}</span>
                        ${$currentRoute=='inbox'?
                            data.read_status==0 ?`<span class="unread-spot"><i class="fa-solid fa-circle me-2"></i></span>`:''
                        :data.read_status==0 ?`<span class="unread-spot fs-2"><i class="fa-solid fa-check me-2 "></i></span>`:'<span class="read-spot fs-2"><i class="fa-solid fa-check-double"></i></span>'}




                    </div>
                </div>
                <div class="message mails-item">
                    <p>${escapeHtml(data.message.substr(0,80))}......</p>
                </div>
                <div class="tools mails-item">
                    ${$currentRoute=='inbox'?
                        data.read_status==0 ?`<span class="unread-spot"><i class="fa-solid fa-circle me-2"></i></span>`:''
                        :data.read_status==0 ?`<span class="unread-spot fs-2"><i class="fa-solid fa-check me-2 "></i></span>`:'<span class="read-spot fs-2"><i class="fa-solid fa-check-double me-2"></i></span>'}
                        <span class="date">${$date.toLocaleDateString()}</span>


                </div>

            </div>
            `
        }

        //htmm readmor tags
        function readmore(data) {
            $date=new Date(data.created_at);
            return `
            <div class="d-none" id="m${data.mail_id}">
                <div class="btn-gp d-none" >
                    <span class="back-btn" onclick="back(${data.mail_id})"> <i class="me-2 fa-solid fa-arrow-left"></i>Back</span>
                    <div class="action-btn">
                        <span class="archive-btn me-2"><i class="fa-solid fa-box-archive"></i></span>
                        <span class="delete-btn deletebtn" onclick="AlertDelete(${data.mail_id})"><i class="fa-solid fa-trash"></i></span>
                    </div>
                </div>

                    <div class="mail-header">
                        <h2>
                            ${data.subject?escapeHtml(data.subject):'No Subject'}
                        </h2>
                        <span class="mail-date">
                           ${$date.toLocaleString('en-US')}
                        </span>
                    </div>
                    <div class="mail-text">
                        <p>${escapeHtml(data.message)}</p>
                    </div>


            </div>
            <div class="alert-dark alert-${data.mail_id}"></div>
                    <div class="del-alert  alert-${data.mail_id}">
                            <h2>Are you sure to delete</h2>
                            <div class="alert-btngp">
                                <form method="POST" action="{{route('deleteMail')}}">
                                    @csrf
                                    <input type="button" class="btn alert-cancle" onclick="alertCancle(${data.mail_id})" value="Cancle">
                                    <button class="btn alert-delete">Delete</button></a>
                                    <input type="hidden" name="id" value="${data.mail_id}">

                                </form>
                            </div>
                    </div>
            </div>
            `
        }

        $(document).on("click", ".mails", function(ev) {
            if ($currentRoute == 'inbox') {
                $id = $(this).attr('id');
                $(this).find('.unread-spot').css('display', 'none');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: 'mail/read_status',
                    data: {
                        'mail_id': $id
                    },
                    dataType: 'json',
                    success: function() {

                    }

                })
            }

        });


        //message create validation
        $mail_address = false;
        $Messages = false;
        $('.g_mail').keyup(() => {
            $value = $('.g_mail').val();

            if ($value.trim() != '') {
                $data={'mail': $value},
                ajax(malivalid,$data,'../mail/getMailsAddress');
                function malivalid(mails){
                    if (mails == 'true') {
                            // console.log('true');
                            $('.mail_error').html('');
                            $mail_address = true;
                        } else {
                            // console.log('false');
                            $('.mail_error').html('* Mail Not found ');
                            $mail_address = false;
                        }
                }
            } else {
                $('.mail_error').html('');
            }

        })
        $('.submit').click(() => {
            $mes = $('.text-mes').val().trim();
            if (!$mes == '') {
                $Messages = true;
                $('.message_error').html('');
            } else {
                $Messages = false;
            }
            if (!$Messages) {
                $('.message_error').html('*Message require');
            }
            if ($value = $('.g_mail').val().trim() == '') {
                $('.mail_error').html('*Mails  require');
            }
            if (!$mail_address || !$Messages) {
                event.preventDefault();
            }
        })

        $('.sort').change(() => {
            $sortData = $('.sort').val();
            if ($sortData != 'all') {
                $('.header').html(`Inbox <span class="sub-header">${$sortData}</span>`);
                $data = {
                    'data': $sortData,
                    sendData: 'send'
                };

                if ($currentRoute == 'inbox') {
                    ajax(mailSort,$data,'/mail/getMailSorting');

                } else if ($currentRoute == 'send') {
                    ajax(mailSort,$data,'/mail/getSendMail');
                    // ajax(mailappend, $data, '/mail/getSendMail');
                }


            } else {
                $('.header').text('Inbox');
                $('.mails-warp').text('');
                $('.readmore').text('');
                ajax(mailsDisplay);

            }

        })
 function mailSort(mails) {

                    $('.mails-warp').text('');
                    $('.readmore').text('');
                    if (mails.length > 0) {
                        mails.forEach(m => {
                            $('.mails-warp').append(mailsTag(m));
                            $('.readmore').append(readmore(m));
                        });
                    } else {
                        $('.mails-warp').append(
                            '<div class="noMail"><i class="fa-regular fa-face-sad-tear"></i>Ooops!There is no mail to show</div>'
                            )
                    }

                }

    $('.searchInput').keyup(()=>{
        $searchKey=$('.searchInput').val();
        if ($searchKey.trim()!="") {
            $auto=false;
            $('.search-key').html(`<div class="key-display"><a href="/"><i class="fa-regular fa-circle-xmark"></i></a>${$searchKey}</div>`)
        }else{
            $auto=true;
            $('.search-key').html('')
        }
        $route=$currentRoute=='inbox'?'receive':'send';
        $data={data:$searchKey,sort:$('.sort').val(),route:$route}
        ajax(mailSort,$data,'/search/searchInbox');
    })






    })
</script>
@stack('jsExtra')


</html>
