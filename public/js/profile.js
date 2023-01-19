$(document).ready(function() {
        $Initfname=$('#fname').val();
    $InitlastName=$('#lastName').val();

    $('.inputName').keyup(()=>{
        $fname=$('#fname').val();
        $lastName=$('#lastName').val();
        if ($fname.trim()=='' || $lastName.trim()=='') {
            $('.change-btn').attr("disabled",true);
            if($fname.trim()==''){
                $('.ferror').css('display','block');
            }
            if($lastName.trim()==''){
                $('.sec_error').css('display','block');
            }

        }else{
            $('.ferror').css('display','none');
            $('.sec_error').css('display','none');
            if($Initfname == $fname && $InitlastName ==$lastName){
                $('.change-btn').attr("disabled",true);
            }else{
                $('.change-btn').removeAttr('disabled');
            }
        }

    })
})


