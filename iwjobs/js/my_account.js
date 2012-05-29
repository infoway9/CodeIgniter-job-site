function validate_passwordchange(){
    var current_password=$.trim($('#current_password').val());var new_password=$.trim($('#new_password').val());var password_confirmation=$.trim($('#password_confirmation').val());var msg_txt="";
    if(current_password==""){
        msg_txt="Please enter current password.";
        $('#current_password').focus();
    }else if(new_password==""){
        msg_txt="Please enter new password.";
        $('#new_password').focus();
    }else if(current_password==new_password){
        msg_txt="Old and new password must be different.";
        $('#new_password').focus();
    }else if(new_password.length<6){
        msg_txt="Password should be at least 6 characters in length.";
        $('#new_password').focus();
    }else if(new_password.length>20){
        msg_txt="Please limit your password within 20 characters.";
        $('#new_password').focus();
    }else if(password_confirmation==""){
        msg_txt="Please confirm your password.";
        $('#password_confirmation').focus();
    }else if(password_confirmation!=new_password){
        msg_txt="There seems to be a password mismatch.";
        $('#password_confirmation').focus();
    }
    if(msg_txt!=""){
        $.scrollTo("#frm_change_pswd",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}
    function validate_emailchange(){
    var current_email=$.trim($('#current_email').val());var new_email=$.trim($('#new_email').val());var confirm_email=$.trim($('#confirm_email').val());var msg_txt="";
    if(new_email==""){
        msg_txt="Please enter new email.";
        $('#new_email').focus();
    }else if(current_email==new_email){
        msg_txt="Old and new email must be different.";
        $('#new_email').focus();
    }else if(new_email!=""&&isEmail(new_email)==false){
        msg_txt="Please enter valid email.";$('#email').focus();
    }else if(new_email!="" && unique_email(new_email)=='Exists'){
        msg_txt="Email already exists.";$('#email').focus();
    }else if(confirm_email==""){
        msg_txt="Please confirm your email.";
        $('#confirm_email').focus();
    }else if(new_email!=confirm_email){
        msg_txt="There seems to be an email mismatch.";
        $('#confirm_email').focus();
    }
    if(msg_txt!=""){
        $.scrollTo("#frm_change_email",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true;
        },500)
    }
}