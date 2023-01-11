// jsversion


const menuTag=qs('.menu-icon');
const headerTag=qs('.header');
const crossTag=qs('.cross-icon');
const navTag=qs('nav');
const mailsTag=document.querySelectorAll('.mails-warp');
const ReadPageTag=qs('.ReadPage');
const mailConteinerTag=qs('.mails-container');
const mailsCreateTag=qs('.mail-create')
const backbtnTag=qs('.back-btn');
const floatbtnTag=qs('.createFloat-btn');
const btnbackTag=qs('.btn-back');
const seoTag=qs('.seo');
const dropper=qs('.dropper');
const dropboxTag=qs('.dropbox');
const alertDark=qs('.alert-dark')
const menuItemTag=document.getElementsByClassName('menu-item');

// noti pop up
const crossBtn=qs('.cross-btn');
const notiAlertTag=qs('.notiAlert');
const notiwh=notiAlertTag.offsetWidth+50;
const alertname=qs('.alertname');
const alertMail=qs('.alertMail');
const notiText=qs('.notiText');
const image=qs('.Info-image');


function qs(el) {
    return document.querySelector(el);
}
menuTag.addEventListener('click',()=>{
    let menuTagStyle=menuTag.style.display;
    if(menuTagStyle!='none'){
        navTag.style.left='0';
        document.querySelector('.mobile-nav').style.visibility='visible';
    }

})
crossTag.addEventListener('click',crossFn)
function crossFn(){
    let crossTagStyle=crossTag.style.display;
    if(crossTagStyle!='none'){
        navTag.style.left='-100%';
        document.querySelector('.mobile-nav').style.visibility='visible';

    }
}
function readMore(id) {

    let unique=qs(`#m${id}`);
    unique.classList.remove('d-none');
    mailConteinerTag.style.display='none';
    ReadPageTag.style.display='block';
    floatbtnTag.style.display='none';
    seoTag.style.display='none';
    headerTag.textContent='Message';

}


floatbtnTag.addEventListener('click',()=>{
    createSection();
})
btnbackTag.addEventListener('click',()=>{
    hidecreateSection();
})




// functions
function back(id) {
    let unique=qs(`#m${id}`);
    unique.classList.add('d-none');
    mailConteinerTag.style.display='block';
    ReadPageTag.style.display='none';
    seoTag.style.display='flex';
    floatbtnTag.style.display='flex';
    headerTag.textContent='Inbox';

}
function createSection(){
    mailConteinerTag.style.display='none';
    seoTag.style.display="none";
    headerTag.textContent='Create Message';
    mailsCreateTag.style.display='block';
    floatbtnTag.style.display='none';
}
function hidecreateSection(){
    mailConteinerTag.style.display='block';
    seoTag.style.display="flex";
    headerTag.textContent='Inbox';
    mailsCreateTag.style.display='none';
    floatbtnTag.style.display='flex';
}
function send() {
    mailConteinerTag.style.display='none';
    seoTag.style.display="none";
    headerTag.textContent='Send Messages';
    mailsCreateTag.style.display='block';
    floatbtnTag.style.display='none';
}

dropper.addEventListener('click',()=>{
    if(dropboxTag.style.display=="block"){
        dropboxTag.style.display="none";
    }else{
        dropboxTag.style.display="block";
    }
});

window.addEventListener('click',(e)=>{
    if(dropboxTag.style.display=='block'){
        if(dropboxTag.contains(e.target) ||dropper.contains(e.target)){
            return;
        }else{
            dropboxTag.style.display="none";
        };
    }
})

for (const menu of menuItemTag) {
    menu.addEventListener('click',()=>{
        for (const e of menuItemTag) {
            e.classList.remove('active')
        }
        menu.classList.remove('active');
        let cl=menu.classList[1];
        let te=document.querySelectorAll(`.${cl}`)
        for (const t of te) {
            t.classList.add('active');
        }
        crossFn();
    })



}


function AlertDelete(id) {
    document.querySelectorAll(`.alert-${id}`).forEach(e => {
        e.style.display='block';
    });
    alertDark.style.display='block';
}
function alertCancle(id) {
    document.querySelectorAll(`.alert-${id}`).forEach(e => {
        e.style.display='none';
    });
    alertDark.style.display='none';
}

function a() {
    alert('hello');
}


function noti(kind,data) {
    if(kind=='inbox'){
        console.log(data)
        alertname.textContent=data.firstName;
        alertMail.textContent=data.sender;
        notiText.textContent=data.message.substr(0,50)+'.....';
        if(data.image){
            image.innerHTML=`<img class="pf-img dropper" src="{{ asset('storage/img/test.jpg') }}" alt="admin's profile photo"
            width="40px" height="40px">`;
        }else{
           image.innerHTML=`
            <div class="Textprofile dropper">
                ${data.firstName[0]}
            </div>
           `
        }
        notiAlertTag.addEventListener('click',directReadMore);
        function directReadMore(){
            readMore(data.mail_id);
            dispearNoti();
        }
        notiAlertTag.style.top='5%';
        crossBtn.addEventListener('click',dispearNoti);
        setTimeout(dispearNoti,3000);
    }
}

function dispearNoti(){
    notiAlertTag.style.top= -notiwh+'px';

}


