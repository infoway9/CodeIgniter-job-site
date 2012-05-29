function validate_signup(){
    var email=$.trim($('#email').val());var user_name=$.trim($('#user_name').val());var password=$.trim($('#password').val());var reenter_password=$.trim($('#reenter_password').val()); var country=$.trim($('#country').val());var city=$.trim($('#city').val());var postal_code=$.trim($('#postal_code').val());var address=$.trim($('#address').val());var organization=$.trim($('#organization').val()); var company_logo=$.trim($('#company_logo').val()); var company_link=$('#company_link').val(); var captcha=$.trim($('#captcha').val());var terms_of_use=$.trim($('#terms_of_use').val());var msg_txt="";
    if(email==""){
        msg_txt="Please enter email.";$('#email').focus();
    }else if(email!=""&&isEmail(email)==false){
        msg_txt="Please enter valid email.";$('#email').focus();
    }else if(email!="" && unique_email(email)=='Exists'){
        msg_txt="Email already exists.";$('#email').focus();
    }else if(user_name==""){
        msg_txt="Please enter username.";$('#user_name').focus();
    }else if(user_name.length<6){
        msg_txt="Username should be at least 6 characters.";$('#user_name').focus();
    }else if(user_name.length>20){
        msg_txt="Please limit your username within 20 characters.";$('#user_name').focus();
    }else if(user_name!=""&&isAlphaNumeric(user_name)==false){
        msg_txt="Username must be alpha-numeric. Other characters are disallowed.";$('#user_name').focus();
    }else if(user_name!="" && unique_username(user_name)=='Exists'){
        msg_txt="Username already exists.";$('#user_name').focus();
    }else if(password==""){
        msg_txt="Please enter password";$('#password').focus();
    }else if(password.length<6){
        msg_txt="Password is too weak. It should contain at least 6 characters.";$('#password').focus();
    }else if(password.length>20){
        msg_txt="Please limit your password within 20 characters.";$('#password').focus();
    }else if(reenter_password==""){
        msg_txt="Please confirm your password.";$('#reenter_password').focus();
    }else if(reenter_password!=password){
        msg_txt="Passwords seem to mismatch.";$('#reenter_password').focus();
    }/*else if(country==""){
        msg_txt="Please select country.";$('#country').focus();
    }*/else if(organization==""){
        msg_txt="Please enter organization.";$('#organization').focus();
    }else if(company_logo==""){
        msg_txt="Please select company logo.";$('#company_logo').focus();
    }else if(company_link==""){
        msg_txt="Please enter company link.";$('#company_link').focus();
    }else if(company_link!="" && validateUrl(company_link)==false){
        msg_txt="Please enter valid company link.";$('#company_link').focus();
    }else if(city==""){
        msg_txt="Please enter city.";$('#city').focus();
    }else if(postal_code=="" || validateUSAZip(postal_code)==false){
        msg_txt="Please enter a valid postal code.";$('#postal_code').focus();
    }else if(address==""){
        msg_txt="Please enter address.";$('#address').focus();
    }else if(captcha==""){
        msg_txt="Please enter the verification code.";$('#captcha').focus();
    }else if(!$('#terms_of_use').is(':checked')){
        msg_txt="Please agree to our terms of usage.";$('#terms_of_use').focus();
    }
    if(msg_txt!=""){
        $.scrollTo("#signup_frm",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#signup_btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}



function check_username_availability(){
    var user_name=$("#user_name").attr("value");var msg_txt="";$('#username_availability_link').html('<img src="'+full_path+'image/loading.gif" border="0" alt="" title="" />');
    setTimeout(function(){
        if(user_name==""){
            msg_txt="Please enter username.";$('#user_name').focus();
        }else if(user_name.length<6){
            msg_txt="Username should be at least 6 characters.";$('#user_name').focus();
        }else if(user_name.length>20){
            msg_txt="Please limit your username within 20 characters.";$('#user_name').focus();
        }else if(user_name!=""&&isAlphaNumeric(user_name)==false){
            msg_txt="Username must be alpha-numeric. Other characters are disallowed.";$('#user_name').focus();
        }
        if(msg_txt!=""){
            $.scrollTo("#signup_frm",900);$('#succ_container').animate({
                height:'hide',
                width:'hide',
                opacity:'hide'
            },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);
        }else{
            if(unique_username(user_name)=="Exists"){
                        $.scrollTo("#signup_frm",900);$('#succ_container').animate({
                            height:'hide',
                            width:'hide',
                            opacity:'hide'
                        },500);$('#err_container').fadeIn(1500);$('#err_txt').text("Username already exist.");
                    }else{
                        $.scrollTo("#signup_frm",900);$('#err_container').animate({
                            height:'hide',
                            width:'hide',
                            opacity:'hide'
                        },500);$('#succ_container').fadeIn(1500);$('#succ_txt').text("Username is available.");
                    }
        }$('#username_availability_link').html("Check availability")
    },400)
}
function check_email_availability(){
    var email=$("#email").attr("value");var msg_txt="";$('#email_availability_link').html('<img src="'+full_path+'image/loading.gif" border="0" alt="" title="" />');
    setTimeout(function(){
        if(email==""){
            msg_txt="Please enter email.";$('#email').focus();
        }else if(email!=""&&isEmail(email)==false){
            msg_txt="Please enter valid email.";$('#email').focus();
        }if(msg_txt!=""){
            $.scrollTo("#signup_frm",900);$('#succ_container').animate({
                height:'hide',
                width:'hide',
                opacity:'hide'
            },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);
        }else{
            if(unique_email(email)=='Exists'){
                        $.scrollTo("#signup_frm",900);$('#succ_container').animate({
                            height:'hide',
                            width:'hide',
                            opacity:'hide'
                        },500);$('#err_container').fadeIn(1500);$('#err_txt').text("This email already exist.");
                    }else{
                        $.scrollTo("#signup_frm",900);$('#err_container').animate({
                            height:'hide',
                            width:'hide',
                            opacity:'hide'
                        },500);$('#succ_container').fadeIn(1500);$('#succ_txt').text("This email is available.");
                    }
        }$('#email_availability_link').html("Check availability")
    },400)
}

function validate_signin(){
    var user_name=$.trim($('#textusername').val());var password=$.trim($('#textpassword').val());var msg_txt="";
   if(user_name==""){
        msg_txt="Please enter your username.";
        $('#textusername').focus();
    }else if(password==""){
        msg_txt="Please enter password.";
        $('#textpassword').focus();
    }
    if(msg_txt!=""){
        $.scrollTo("#signin_frm",900);$('#signin_succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);
        $('#continue_signin').hide();

        $('#signin_err_container').fadeIn(1500).text(msg_txt);return false;
    }else{
        $('#signin_btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true;
        },500)
    }
}



$(document).ready(function(){
    $('#reenter_password').bind('paste',function(e){
        $('#reenter_password').val('');return false;
    })
});

function validate_forgot_password(){
    var email=$.trim($('#email').val());var captcha=$.trim($('#captcha').val());var msg_txt="";
    if(email==""){
        msg_txt="Please enter your email.";
        $('#email').focus();
    }else if(email!="" && isEmail(email)==false){
        msg_txt="Please enter a valid email.";
        $('#email').focus();
    }else if(email!="" && unique_email(email)=='Notexists'){
        msg_txt="Email does not exists.";
        $('#email').focus();
    }else if(captcha==""){
        msg_txt="Please enter varification code.";
        $('#captcha').focus();
    }
    if(msg_txt!=""){
        $.scrollTo("#forgot_pswd_frm",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#forgotpswd_btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}

function validate_reset_password(){
    var new_password=$.trim($('#new_password').val());var password_confirmation=$.trim($('#password_confirmation').val());var msg_txt="";
    if(new_password==""){
        msg_txt='Please enter the new password.';
        $('#new_password').focus();
    }else if(new_password.length<6){
        msg_txt="Password is too weak. It should contain at least 6 characters.";
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
        $.scrollTo("#reset_pswd_frm",900);$('#succ_container').animate({
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

