@extends('user.mailboard.master.master')

@push('JavaScript')


<script>


$(document).ready(function () {
    $test='test';
    $interval=true;
    ajax(mailsDisplay,{data:'send'},'/mail/getSendMail');
    //security


    //to show mails
    function mailsDisplay(mails) {
        if(mails.length>0){
            $count=0;
            mails.forEach(m => {
                if(m.read_status==0){
                        $count++;
                    }
                $('.unread').text($count);
                $('.mails-warp').append(mailsTag(m));
                $('.readmore').append(readmore(m));


            });
        }
        else{
                $('.mails-warp').append('<div class="noMail"><i class="fa-regular fa-face-sad-tear"></i>Ooops!There is no mail to show</div>')
        }

        autoUpdate();

    }
    // auto update data
    function autoUpdate(){
        return setInterval(() => {
            if($interval){
                $sortVal=$('.sort').val()
                if($sortVal!='all'){
                    $data={'data':$sortVal};

                    ajax(mailappend,$data,'/mail/getMailSorting');

                }else{
                    ajax(mailappend,{data:'send'},'/mail/getSendMail');

                }
            }

        }, 1000);
    }
    //to append mail
    function mailappend(mails){
            $mailDataLength=mails.length;
            if($mailDataLength>0){
                $oriMailsLength=$('.mails').length;
                // console.log($oriMailsLength);
                // console.log('-----------------start-----------------');
                $count=0;
                mails.forEach(m => {
                    if(m.read_status==0){
                        $count++;
                    }
                    $('.unread').text($count);
                });
                if(mails.length>$oriMailsLength){
                    $newMails=mails.length-$oriMailsLength;

                    for (let i = 0; i < $newMails; i++) {

                        $mailsort=$newMails-(i+1);
                        $('.mails-warp').prepend(mailsTag(mails[$mailsort]));
                        $('.readmore').append(readmore(mails[$mailsort]));
                    }

                }
            }else{
                $('.mails-warp').text('');
                $('.readmore').text('');
                $('.mails-warp').append('<div class="noMail"><i class="fa-regular fa-face-sad-tear"></i>Ooops!There is no mail to show</div>')
            }
    }
    // realtime update

    //ajax call
    function ajax(funcForDisplay,$data={},$route='/mail') {
        $.ajax({
                type:'get',
                url :$route,
                dataType:'json',
                data:$data,
                success:(mails)=>{funcForDisplay(mails.data)},
        })
    }
    //html mails tags
    function mailsTag(data) {
        return `
            <div class="mails" id="${data.mail_id}" onclick="readMore(${data.mail_id});">

                <div class="info mails-item" >
                    ${data.img?`<img class="pf-img" src="{{asset('storage/img/test.jpg')}}" alt="admin's profile photo" width="40px" height="40px">`:
                    `<div class="Textprofile" >
                        ${data.sender[0]}
                    </div>`}
                <span class="se-name">${data.name} <span class="p-mail mail">${data.sender}</span></span>
                <div class="res-tools mails-item">

                    <span class=" date me-2">jun/2022</span>
                    ${data.read_status==0 ?`<span class="unread-spot"><i class="fa-solid fa-circle me-2"></i></span>`:''}
                    <!-- <span class="delete-btn min-btn"><i class="fa-solid fa-trash me-2"></i></span> -->

                </div>
            </div>
            <div class="message mails-item">
                <p>${escapeHtml(data.message.substr(0,80))}......</p>
            </div>
            <div class="tools mails-item">
                ${data.read_status==0 ?`<span class="unread-spot"><i class="fa-solid fa-circle me-2"></i></span>`:''}
                <span class="archive-btn min-btn"><i class="fa-solid fa-box-archive me-2"></i></span>
                <span class="delete-btn min-btn"><i class="fa-solid fa-trash me-2"></i></span>

            </div>

        </div>
        `
    }

    //htmm readmor tags
    function readmore(data) {
        return `
        <div class="d-none" id="m${data.mail_id}">
            <div class="btn-gp d-none" >
                <span class="back-btn" onclick="back(${data.mail_id})"> <i class="me-2 fa-solid fa-arrow-left"></i>Back</span>
                <div class="action-btn">
                    <span class="archive-btn me-2"><i class="fa-solid fa-box-archive"></i></span>
                    <span class="delete-btn"><i class="fa-solid fa-trash"></i></span>
                </div>
            </div>
            <div class="mails-info" id=''>
                <div class="mail-header">
                    <h2>
                        ${data.subject?escapeHtml(data.subject):'No Subject'}
                    </h2>
                    <span class="mail-date">
                        12-10-2022
                    </span>
                </div>
                <div class="mail-text">
                    ${escapeHtml(data.message)}
                </div>
            </div>

        </div>
        `
    }

    $(document).on("click", ".mails", function (ev) {
        $id=$(this).attr('id');
        $(this).find('.unread-spot').css('display','none');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url :'mail/read_status',
            data:{'mail_id':$id},
            dataType:'json',
            success:function(){

            }

        })
    });


    //message create validation
    $mail_address=false;
    $Messages=false;
    $('.g_mail').keyup(()=>{
        $value=$('.g_mail').val();

        if($value.trim()!=''){
            $.ajax({
                type:'get',
                url :'../mail/getMailsAddress',
                data:{'mail':$value},
                dataType:'json',
                success:(mails)=>{
                    if(mails.status=='true'){
                        // console.log('true');
                        $('.mail_error').html('');
                        $mail_address=true;
                    }else{
                        // console.log('false');
                        $('.mail_error').html('* Mail Not found ');
                        $mail_address=false;
                    }
                },

            })
        }else{
            $('.mail_error').html('');
        }

    })
    $('.submit').click(()=>{
        $mes=$('.text-mes').val().trim();
        if(!$mes==''){
            $Messages=true;
            $('.message_error').html('');
        }else{
            $Messages=false;
        }
        if(!$Messages){
            $('.message_error').html('*Message require');
        }
        if($value=$('.g_mail').val().trim()==''){
            $('.mail_error').html('*Mails  require');
        }
        if(!$mail_address || !$Messages) {
            event.preventDefault();
        }
    })

    $('.sort').change(()=>{
        $sortData=$('.sort').val();
        if($sortData!='all'){
            $('.header').html(`Inbox <span class="sub-header">${$sortData}</span>`);
            $data={'data':$sortData};
                    ajax(mailSort,$data,'/mail/getMailSorting');
                    function mailSort(mails){

                        $('.mails-warp').text('');
                        $('.readmore').text('');
                        if(mails.length>0){
                            mails.forEach(m => {
                                $('.mails-warp').append(mailsTag(m));
                                $('.readmore').append(readmore(m));
                            });
                        }else{
                            $('.mails-warp').append('<div class="noMail"><i class="fa-regular fa-face-sad-tear"></i>Ooops!There is no mail to show</div>')
                        }

                    }
        }else{
            $('.header').text('Inbox');
            $('.mails-warp').text('');
            $('.readmore').text('');
            // ajax(mailsDisplay);

        }

    })

// $('.send').click(()=>{
//     $('.condition').html('To <i class="to fa-solid fa-sort-up"></i>');
//     $('.mails-warp').html('');
//     $('.readmore').text('');
//     ajax(sendMails,{data:'send'},'/mail/getSendMail');
//     // function sendMails(mails) {
//     //     if(mails.length>0){

//     //         mails.forEach(m => {
//     //             $('.unread').text($count);
//     //             $('.mails-warp').append(mailsTag(m));
//     //             $('.readmore').append(readmore(m));


//     //         });

//     //     }
//     //     else{
//     //             $('.mails-warp').append('<div class="noMail"><i class="fa-regular fa-face-sad-tear"></i>Ooops!There is no mail to show</div>')
//     //     }


//     //     // clearInterval(autoUpdate());

//     // }

// })
// $('.inbox').click(()=>{
//     $('.condition').html('From <i class="from fa-solid fa-sort-down"></i>');
//     $('.mails-warp').html('')
//     ajax(mailsDisplay);
// })
})
</script>


@endpush

