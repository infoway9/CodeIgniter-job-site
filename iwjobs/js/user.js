function validate_signup(){
    var fname=$.trim($('#fname').val());var lname=$.trim($('#lname').val());var email=$.trim($('#email').val());var user_name=$.trim($('#user_name').val());var password=$.trim($('#password').val());var reenter_password=$.trim($('#reenter_password').val()); var country=$.trim($('#country').val());var city=$.trim($('#city').val());var postal_code=$.trim($('#postal_code').val());var address=$.trim($('#address').val());var degree=$.trim($('#degree').val());var key_skills=$.trim($('#key_skills').val());var expertise=$('#expertise option:selected').val() || [];var current_loc=$.trim($('#current_loc').val());var preferred_loc=$.trim($('#preferred_loc').val());var emp_status=$.trim($('input:radio[id=emp_status]:checked').val());var experience=$.trim($('#experience').val());var current_comp=$.trim($('#current_comp').val());var designation=$.trim($('#designation').val());var current_sal=$.trim($('#current_sal').val());var expected_sal=$.trim($('#expected_sal').val());var resume_desc=$.trim($('#resume_desc').val());var resume_name=$.trim($('#resume_name').val());var captcha=$.trim($('#captcha').val());var terms_of_use=$.trim($('#terms_of_use').val());var msg_txt="";
    var reg_emp_status="^[FE]{1}?$";
    if(fname==""){
        msg_txt="Please enter your first name.";$('#fname').focus();
    }else if(fname.length<3){
        msg_txt="First name should contain at least 3 characters.";$('#fname').focus();
    }else if(fname.length>20){
        msg_txt="Please limit your first name within 20 characters.";$('#fname').focus();
    }else if(lname==""){
        msg_txt="Please enter your last name.";$('#lname').focus();
    }else if(lname!="" && lname.length<3){
        msg_txt="Last name should contain at least 3 characters.";$('#lname').focus();
    }else if(lname!="" && lname.length>20){
        msg_txt="Please limit your last name within 20 characters.";$('#lname').focus();
    }else if(email==""){
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
    }else if(city==""){
        msg_txt="Please enter city.";$('#city').focus();
    }else if(postal_code=="" || validateUSAZip(postal_code)==false){
        msg_txt="Please enter a valid postal code.";$('#postal_code').focus();
    }else if(address==""){
        msg_txt="Please enter address.";$('#address').focus();
    }else if(degree==""){
        msg_txt="Please valid highest degree.";$('#degree').focus();
    }else if(key_skills==""){
        msg_txt="Please enter a key skills.";$('#key_skills').focus();
    }else if(expertise.length<1 ){
        msg_txt="Please select an expertise.";$('#expertise').focus();
    }else if(valid_status(reg_emp_status,emp_status)==false){
        msg_txt="Please enter valid status.";$('#emp_status').focus();
    }else if(experience=="" && valid_status(reg_emp_status,emp_status)==true && emp_status=="E"){
        msg_txt="Please select experience.";$('#experience').focus();
    }else if(current_comp=="" && valid_status(reg_emp_status,emp_status)==true && emp_status=="E"){
        msg_txt="Please enter current company name.";$('#current_comp').focus();
    }else if(designation=="" && valid_status(reg_emp_status,emp_status)==true && emp_status=="E"){
        msg_txt="Please enter designation.";$('#designation').focus();
    }else if((current_sal=="" || isFloat(current_sal)==false) && valid_status(reg_emp_status,emp_status)==true && emp_status=="E"){
        msg_txt="Please enter valid current salary.";$('#current_sal').focus();
    }else if(current_loc=="" && valid_status(reg_emp_status,emp_status)==true && emp_status=="E"){
        msg_txt="Please enter current job location.";$('#current_loc').focus();
    }else if(preferred_loc==""){
        msg_txt="Please enter preferred job location.";$('#preferred_loc').focus();
    }else if(expected_sal=="" || isFloat(expected_sal)==false){
        msg_txt="Please enter valid expected salary.";$('#expected_sal').focus();
    }else if(resume_desc==""){
        msg_txt="Please enter resume description.";$('#resume_desc').focus();
    }else if(resume_name==""){
        msg_txt="Please select a resume.";$('#resume_name').focus();
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

