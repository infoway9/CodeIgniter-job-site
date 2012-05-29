function validate_addjob()
{
    var job_name=$.trim($('#job_name').val());var job_desc=$.trim($('#job_desc').val());var job_loc=$.trim($('#job_loc').val()); var key_skills=$.trim($('#key_skills').val()); var expertise=$.trim($("#expertise option:selected").val()); var salary=$.trim($("#salary").val()); var experience=$.trim($("#experience").val()); var msg_txt="";
    
    if(job_name==""){
        msg_txt="Please enter job title.";$('#job_name').focus();
    }else if(job_name!="" && unique_jobname(job_name)=='Exists'){
        msg_txt="Job title alredy exists.";$('#job_name').focus();
    }else if(job_desc==""){
        msg_txt="Please enter job description.";$('#job_desc').focus();
    }else if(job_loc==""){
        msg_txt="Plaese enter job location.";$('#job_loc').focus();
    }else if(key_skills==""){
        msg_txt="Please enter key skills.";$('#key_skills').focus();
    }else if(expertise==""){
        msg_txt="Please select functional expertise.";$('#expertise').focus();
    }else if(salary == ""){
        msg_txt="Please enter salary.";$('#salary').focus();
    }else if(salary != "" && isFloat(salary)==false){
        msg_txt="Please enter valid salary.";$('#salary').focus();
    }else if(experience==""){
        msg_txt="Please select valid experience.";$('#experience').focus();
    }else{
        //ok..
    }
    if(msg_txt!=""){
        $.scrollTo("#jobpost_frm",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#jobpost_btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}
function check_jobname_availability(){
    var job_name=$("#job_name").attr("value");var msg_txt="";$('#jobname_availability_link').html('<img src="'+full_path+'image/loading.gif" border="0" alt="" title="" />');
    setTimeout(function(){
        if(job_name==""){
            msg_txt="Please enter job title.";$('#email').focus();
        }
        if(msg_txt!=""){
            $.scrollTo("#jobpost_frm",900);$('#succ_container').animate({
                height:'hide',
                width:'hide',
                opacity:'hide'
            },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);
        }else{
            if(unique_jobname(job_name)=='Exists'){
                        $.scrollTo("#jobpost_frm",900);$('#succ_container').animate({
                            height:'hide',
                            width:'hide',
                            opacity:'hide'
                        },500);$('#err_container').fadeIn(1500);$('#err_txt').text("Job title alredy exists.");
                    }else{
                        $.scrollTo("#jobpost_frm",900);$('#err_container').animate({
                            height:'hide',
                            width:'hide',
                            opacity:'hide'
                        },500);$('#succ_container').fadeIn(1500);$('#succ_txt').text("Job title is available.");
                    }
        }$('#jobname_availability_link').html("Check availability")
    },400)
}
function validate_editjob(id)
{
    var job_name=$.trim($('#job_name').val());var job_desc=$.trim($('#job_desc').val());var job_loc=$.trim($('#job_loc').val()); var key_skills=$.trim($('#key_skills').val()); var expertise=$.trim($("#expertise option:selected").val()); var salary=$.trim($("#salary").val()); var experience=$.trim($("#experience").val()); var status=$.trim($("input[@name=status]:checked").val()); var msg_txt="";
   
    if(job_name==""){
        msg_txt="Please enter job title.";$('#job_name').focus();
    }else if(job_desc==""){
        msg_txt="Please enter job description.";$('#job_desc').focus();
    }else if(job_loc==""){
        msg_txt="Plaese enter job location.";$('#job_loc').focus();
    }else if(key_skills==""){
        msg_txt="Please enter key skills.";$('#key_skills').focus();
    }else if(expertise==""){
        msg_txt="Please select functional expertise.";$('#expertise').focus();
    }else if(salary == ""){
        msg_txt="Please enter salary.";$('#salary').focus();
    }else if(salary != "" && isFloat(salary)==false){
        msg_txt="Please enter valid salary.";$('#salary').focus();
    }else if(experience==""){
        msg_txt="Please select valid experience.";$('#experience').focus();
    }else if(status !="A" && status!="I" || status==""){
        msg_txt="Please select valid status.";$('#status').focus();
    }else{
        //ok..
    }
    if(msg_txt!=""){
        $.scrollTo("#jobeditpost_frm",900);$('#succ_container').animate({
            height:'hide',
            width:'hide',
            opacity:'hide'
        },500);$('#err_container').fadeIn(1500);$('#err_txt').text(msg_txt);return false;
    }else{
        $('#jobedit_btn_container').hide("fast");$('#processing_status_container').show("fast");
        setTimeout(function(){
            return true
        },500)
    }
}