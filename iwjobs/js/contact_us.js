function validate_contactus(){
    var name=$.trim($('#name').val());var email=$.trim($('#email').val());var country=$.trim($('#country').val());var subject=$.trim($('#subject').val());var message=$.trim($('#message').val());var captcha=$.trim($('#captcha').val());var msg_txt="";
    if(name==""){
        msg_txt=msg['req-name'];$('#name').focus();
    }else if(name.length<3){
        msg_txt=msg['min-char-fr-name'];$('#name').focus();
    }else if(name.length>30){
        msg_txt=msg['max-char-fr-name'];$('#name').focus();
    }else if(email==""){
        msg_txt=msg['req-email'];$('#email').focus();
    }else if(email!=""&&isEmail(email)==false){
        msg_txt=msg['invalid-email'];$('#email').focus();
    }else if(country==""){
        msg_txt=msg['req-country'];$('#country').focus();
    }else if(subject==""){
        msg_txt=msg['req-subject'];$('#subject').focus();
    }else if(subject.length<10){
        msg_txt=msg['min-char-fr-subject'];$('#subject').focus();
    }else if(subject.length>30){
        msg_txt=msg['max-char-fr-subject'];$('#subject').focus();
    }else if(message==""){
        msg_txt=msg['req-message'];$('#message').focus();
    }else if(message.length<50){
        msg_txt=msg['min-char-fr-message'];$('#message').focus();
    }else if(message.length>500){
        msg_txt=msg['max-char-fr-message'];$('#message').focus();
    }else if(captcha==""){
        msg_txt=msg['req-captcha'];$('#captcha').focus();
    }
    if(msg_txt!=""){
        $.scrollTo("#contactus_frm",900);$('#succ_container').animate({
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