<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/profile.js"></script>
<script type="text/javascript">
function radio_chk(val)
            {
                if(val=='F')
                    {
                        $("#experience").attr("disabled","disabled");
                        $("#experience").val('----- Select experience -----');
                        $("#current_comp").attr("disabled","disabled");
                        $("#current_comp").val('');
                        $("#designation").attr("disabled","disabled");
                        $("#designation").val('');
                        $("#current_sal").attr("disabled","disabled");
                        $("#current_sal").val('');
                        $("#current_loc").attr("disabled","disabled");
                        $("#current_loc").val('----- Select city -----');
                    }
                else if(val=='E')
                    {
                        $("#experience").attr("disabled","");
                        $("#current_comp").attr("disabled","");
                        $("#designation").attr("disabled","");
                        $("#current_sal").attr("disabled","")
                        $("#current_loc").attr("disabled","");
                        //$("#experience").val('----- Select experience -----');
                    }
                else
                    {
                        alert("Wrong request.");
                    }
            }
$(document).ready(function(){
        var val=$('#emp_status:checked').val();
                if(val=='F')
                    {
                        $("#experience").attr("disabled","disabled");
                        $("#experience").val('----- Select experience -----');
                        $("#current_comp").attr("disabled","disabled");
                        $("#current_comp").val('');
                        $("#designation").attr("disabled","disabled");
                        $("#designation").val('');
                        $("#current_sal").attr("disabled","disabled");
                        $("#current_sal").val('');
                        $("#current_loc").attr("disabled","disabled");
                        $("#current_loc").val('----- Select city -----');
                    }
   
})

</script>
<script type="text/javascript" src="<?php echo base_url();?>js/user.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery-ui-1.8.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/autocomplete.css" />
<style>
	.ui-autocomplete-loading { background: white url('<?php echo base_url();?>image/loading.gif') right center no-repeat; }
</style>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.custom.min.js"></script>
<script type="text/javascript">
			$(function(){
				function split( val ) {
                                return val.split( /,\s*/ );
                                }
                                function extractLast( term ) {
                                        return split( term ).pop();
                                }
                                
				//attach autocomplete
				$("#skills")
                                        // don't navigate away from the field on tab when selecting an item
                                .bind( "keydown", function( event ) {
                                        if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "autocomplete" ).menu.active ) {
                                                event.preventDefault();
                                        }
                                })
                                .autocomplete({
					//define callback to format results
					source: function(request, response ){
                                                var term=extractLast( request.term );
                                                if(term!='')
                                                    {
                                                        //pass request to server
                                                        $.getJSON("<?php echo base_url();?>ajax-get-key-skill?callback=?", {term: term} , function(data) {

                                                                //create array for response objects
                                                                var suggestions = [];
                                                                //process response
                                                                $.each(data, function(i, val){

                                                                        suggestions.push(val.Name);
                                                                });

                                                                //pass array to callback
                                                                response(suggestions);
                                                        });
                                                    }
                                                    
                                                // delegate back to autocomplete, but extract the last term
					},
					search: function() {
                                            // custom minLength
                                            var term = extractLast( this.value );
                                            if ( term.length < 0 ) {
                                                    return false;
                                            }
                                        },
                                        focus: function() {
                                                // prevent value inserted on focus
                                                return false;
                                        },
					//define select handler
					select: function(e, ui) {
						var terms = split( this.value );
                                                // remove the current input
                                                terms.pop();
                                                var val=$("#key_skills").val();
                                                if(String(val).search (ui.item.value+",") == -1)
                                                    {
                                                        //create formatted skill
                                                        var skill = ui.item.value,
                                                            span = $("<span>").text(skill).attr({id:skill}),
                                                            a = $("<a>").addClass("remove").attr({
                                                                    href: "javascript:",
                                                                    title: "Remove " + skill
                                                            }).text("x").appendTo(span);

                                                        //add skill to skill contener div
                                                        span.insertBefore("#skills");
                                                        // add the selected item
                                                        terms.push(ui.item.value);
                                                    }
                                                // add placeholder to get the comma-and-space at the end
                                                terms.push( "" );
                                                $("#key_skills").val(val+terms.join( "," ));
                                                return false;
					},
					//define select handler
					change: function() {
						
						//prevent 'to' field being updated and correct position
						$("#skills").val("").css("top", 2);
					}
				});
				
				//add click handler to skill contener div
				$("#skills_contener").click(function(){
					
					//focus 'skill' field
					$("#skills").focus();
				});
				
				//add live handler for clicks on remove links
				$(".remove", document.getElementById("skills_contener")).live("click", function(){
				
                                var id=$(this).parent().attr('id');    
                                
                                        //fetch value...
					var val=$("#key_skills").val();
                                        if(String(val).search (id+",") != -1)
                                                    {
                                                        var term=val.split(",");
                                                        var idx=$.inArray(id, term);
                                                        if(idx!=-1)
                                                            {
                                                                term.splice(idx, 1);
                                                                $("#key_skills").val(term.join( "," ));
                                                                //remove current skill
                                                                $(this).parent().remove();
                                                            }
                                                    }
					//correct 'key_skills' field position
					if($("#skills_contener span").length === 0) {
						$("#skills").css("top", 0);
					}				
				});				
			});
		</script>
</head>

<body>
<div class="maincontent">
<!--Header Part Start-->
<?php $this->load->view('include/header'); ?>
<!--Header Part End-->

<!--Banner Part Start-->

<!--Banner Part End-->

<!--main Content Start-->
				
<div class="contentmaininner">
<?php if(isset ($error_msg)){echo $error_msg; }?>

<!--Top Caption Start-->
<div class="singlebody">
<h1 class="login">My Settings</h1>

<div class="myacc">
<?php $this->load->view('include/profile_left'); ?>
<div class="myaccRgt">

<div class="formmyacc">
<h2>My Personal profile</h2>
<div class="msgreq"><span>*</span> Fields are required</div>
<form name="editprofessional_frm" id="editprofessional_frm" action="" method="post" enctype="multipart/form-data" onsubmit="return validate_professional_profile();">
<div class="registrationbox">
<div class="rigrow">
<div class="succeswrap">
<div class="successbox" id="succ_container" style="<?php if(isset($success_msg) && $success_msg  != "") echo 'display:block;'; else echo 'display:none;'; ?>">

<div class="errordesc" id="succ_txt"><?php if(isset($success_msg) && $success_msg  != "") echo $success_msg; ?></div>
<br class="clr" />
</div>

<div class="errorbox" id="err_container" style="<?php if(isset($error_msg) && $error_msg  != "") echo 'display:block;'; else echo 'display:none;'; ?>">

<div class="errordesc" id="err_txt"><?php if(isset($error_msg) && $error_msg  != "") echo $error_msg; ?></div>
<br class="clr" />
</div>

</div>

</div>

<div class="rigrow">
<div class="leftreg">Highest Degree<span>*</span>:</div>
<div class="mdreg">
<div class="countrybox3">
<select class="contrydropdown" name="degree" id="degree">
<option value="">----- Select degree -----</option>
<?php foreach($degree_list as $v): ?>
<option value="<?php echo $v['Id']; ?>" <?php if( isset($degree) && $v['Id'] == $degree) echo 'selected="selected"'; ?> ><?php echo $v['DegreeName'] ?></option>
<?php endforeach; ?>
</select></div>
<br class="clr" />
</div>

<br class="clr" />
</div>
        
        <div class="rigrow">
<div class="leftreg">Key Skills<span>*</span>:</div>
<div class="countrybox"><div id="skills_contener" class="ui-helper-clearfix"><?php if(isset($key_skill_array) && is_array($key_skill_array) && count($key_skill_array)>0) { foreach($key_skill_array as $array):foreach($array as $key => $val):?><span id="<?php echo $val; ?>" ><?php echo $val; ?><a class="remove" href="javascript:" title="Remove <?php echo $val; ?>">x</a></span><?php endforeach;endforeach; } ?><input type="hidden" name="key_skills" id="key_skills" value="<?php if(isset ($key_skills) && $key_skills!='') echo $key_skills; ?>" /><input type="text" name="skills" id="skills" value="" size="10"/></div></div>


<br class="clr" />
</div>
        
        
        
        <div class="rigrow">
<div class="leftreg">Functional expertise<span>*</span>:</div>
<div class="mdreg">
<div class="countrybox3">
<select class="contrydropdown" name="expertise[]" id="expertise" multiple="multiple" style="height: 150px;">
<option value="">----- Select expertise -----</option>
<?php foreach($expertise_list as $v): ?>
<option value="<?php echo $v['Id']; ?>" <?php if(isset($functional_expertise) && is_array($functional_expertise) && count($functional_expertise) > 0): foreach($functional_expertise as $array): if($v['Name'] == $array['Name']): echo 'selected="selected"'; endif; endforeach; endif;?> ><?php echo $v['Name'] ?></option>
<?php endforeach; ?>
</select></div>
<br class="clr" />
</div>

<br class="clr" />
</div>
        
     
        
<div class="rigrow">
<div class="leftreg">Apply as<span>*</span>:</div>
<div class="mdreg">
    <input type="radio" name="emp_status" id="emp_status" value="F" onclick="radio_chk(this.value);" <?php if( isset ($employment_status) && $employment_status=='F') echo 'checked="checked"'; ?> />Fresher
    <input type="radio" name="emp_status" id="emp_status" value="E" onclick="radio_chk(this.value);" <?php if( isset ($employment_status) && $employment_status=='E') echo 'checked="checked"'; ?> />Experienced
</div>

<br class="clr" />
</div>
        
        <div class="rigrow">
<div class="leftreg">Experience (Yrs)<span>*</span>:</div>
<div class="mdreg">
<div class="countrybox3">
<select class="contrydropdown" name="experience" id="experience">
<option value="">----- Select experience -----</option>
<?php for($exp=1; $exp<=15; $exp++): ?>
<option value="<?php echo $exp; ?>" <?php if( isset($experience) && $exp == $experience) echo 'selected="selected"'; ?>><?php echo $exp ?></option>
<?php endfor; ?>
<option value="15+" <?php if( isset($experience) && $v['Id'] == $experience) echo 'selected="selected"'; ?>>15+</option>
</select></div>
<br class="clr" />
</div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Current company<span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" name="current_comp" id="current_comp" value="<?php if (isset($current_company) && $current_company  != "") echo $current_company; ?>" /></div>


<br class="clr" />
</div>
<div class="rigrow">
<div class="leftreg">Current designation<span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" name="designation" id="designation" value="<?php if (isset($current_designation) && $current_designation  != "") echo $current_designation; ?>" /></div>


<br class="clr" />
</div>
<div class="rigrow">
<div class="leftreg">Current salary(p/a)<span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" name="current_sal" id="current_sal" value="<?php if (isset($current_salary) && $current_salary  != "") echo $current_salary; ?>" /></div>



<br class="clr" />
</div>
        
<div class="rigrow">
<div class="leftreg">Current job location<span>*</span>:</div>
<div class="mdreg">
<div class="countrybox3">
<select class="contrydropdown" name="current_loc" id="current_loc">
<option value="">----- Select city -----</option>
<?php foreach($city_list as $v): ?>
<option value="<?php echo $v['CityId']; ?>" <?php if( isset($current_location) && $v['CityId'] == $current_location) echo 'selected="selected"'; ?>><?php echo $v['CityName'] ?></option>
<?php endforeach; ?>
</select></div>
<br class="clr" />
</div>

<br class="clr" />
</div>
        
        
<div class="rigrow">
<div class="leftreg">Preferred location<span>*</span>:</div>
<div class="mdreg">
<div class="countrybox3">
<select class="contrydropdown" name="preferred_loc" id="preferred_loc">
<option value="">----- Select city -----</option>
<?php foreach($city_list as $v): ?>
<option value="<?php echo $v['CityId']; ?>" <?php if( isset($preferred_location) && $v['CityId'] == $preferred_location) echo 'selected="selected"'; ?>><?php echo $v['CityName'] ?></option>
<?php endforeach; ?>
</select></div>
<br class="clr" />
</div>

<br class="clr" />
</div>
        
<div class="rigrow">
<div class="leftreg">Expected salary(p/a)<span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" name="expected_sal" id="expected_sal" value="<?php if (isset($expected_salary) && $expected_salary  != "") echo $expected_salary; ?>" /></div>


<br class="clr" />
</div>        
        
<div class="rigrow">
<div class="leftreg">About yourself<span>*</span>:</div>
<div class="mdreg"><textarea name="resume_desc" id="resume_desc"><?php if (isset($about_me) && $about_me  != "") echo $about_me; ?></textarea></div>

<br class="clr" />
</div>   
        
<div class="rigrow">
<div class="leftreg">Upload resume:</div>
<div class="countrybox"><input type="file" class="countyinp" name="resume_name" id="resume_name"  /></div>


<br class="clr" />
</div>


<div class="rigrow">
<div class="leftreg">&nbsp;</div>
<div class="countrybox">
<input name="btn_editprofile" id="btn_submit_container" type="submit" class="submitreg_btn" value="Submit" />
<div id="processing_status_container" style="display:none;">
<div><span><img src="<?php echo base_url(); ?>image/processing.gif" /></span></div>
<br class="clr" />
</div>
</div>
<br class="clr" />
</div>


</div>
</form>
</div>
</div>
</div>

</div>
<!--main Content End-->

</div>

<!--Footer Start-->
<?php $this->load->view('include/footer'); ?>
<!--Footer End-->

</div>
</body>
</html>

