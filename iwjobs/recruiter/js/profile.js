function validate_editprofile(){
    var organization=$.trim($('#organization').val());var company_link=$.trim($('#company_link').val()); var city=$.trim($('#city').val()); var postal_code=$.trim($("#postal_code").val()); var address=$.trim($("#address").val()); var msg_txt="";

    if(organization==""){
        msg_txt="Please enter organization name.";$('#organization').focus();
    }else if(organization.length<3){
        msg_txt="Organization name should contain at least 3 characters.";$('#organization').focus();
    }else if(company_link==""){
        msg_txt="Please enter company link.";$('#company_link').focus();
    }else if(company_link!="" && validateUrl(company_link)==false){
        msg_txt="Please enter valid company link.";$('#company_link').focus();
    }else if(city==""){
        msg_txt="Plaese enter city.";$('#city').focus();
    }else if(postal_code==""){
        msg_txt="Please enter your potal code.";$('#postal_code').focus();
    }else if(postal_code!="" && validateUSAZip(postal_code)==false){
        msg_txt="Please enter a valid postal code.";$('#postal_code').focus();
    }else if(address == ""){
        msg_txt="Please enter address.";$('#address').focus();
    }
    if(msg_txt!=""){
        $.scrollTo("#editprofile_frm",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#btn_editprofile').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}