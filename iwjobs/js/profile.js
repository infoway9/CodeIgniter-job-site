function validate_editprofile(){
    var fname=$.trim($('#fname').val());var lname=$.trim($('#lname').val());var city=$.trim($('#city').val());var postal_code=$.trim($('#postal_code').val());var address=$.trim($("#address").val());var msg_txt="";

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
        $('#btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}
function validate_professional_profile()
{
    var degree=$.trim($('#degree').val());var key_skills=$.trim($('#key_skills').val());var expertise=$('#expertise option:selected').val() || [];var current_loc=$.trim($('#current_loc').val());var preferred_loc=$.trim($('#preferred_loc').val());var emp_status=$.trim($('input:radio[id=emp_status]:checked').val());var experience=$.trim($('#experience').val());var current_comp=$.trim($('#current_comp').val());var designation=$.trim($('#designation').val());var current_sal=$.trim($('#current_sal').val());var expected_sal=$.trim($('#expected_sal').val());var resume_desc=$.trim($('#resume_desc').val());var msg_txt="";
var reg_emp_status="^[FE]{1}?$";
    if(degree==""){
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
    }
    if(msg_txt!=""){
        $.scrollTo("#editprofessional_frm",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#btn_submit_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}


