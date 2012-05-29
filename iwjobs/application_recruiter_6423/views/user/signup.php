<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
<script type="text/javascript">
function reset_verfication_code()
            {
                document.getElementById('verfification_code_img').src='<?php echo base_url(); ?>security_captcha/captcha.php?'+Math.random();
            }
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/user.js"></script>
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


<!--Top Caption Start-->
<div class="singlebody">

<h1 class="login">Signup</h1>
<div class="msgreq"><span>*</span> Fields are required</div>
<form name="signup_frm" id="signup_frm" action="" enctype="multipart/form-data" method="post" onsubmit="return validate_signup();">
<div class="registrationbox">
    <h1>Recruiter Details</h1>
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
<div class="leftreg">Email address<span>*</span>:</div>
<div class="mdreg"><input type="text" class="box_textinput" name="email" id="email" value="<?php if (isset($email) && $email  != "") echo $email; ?>" />
<div class="note"><a id="email_availability_link" onclick="check_email_availability('');" href="javascript:void(0);">Check availability</a></div>
</div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Username<span>*</span>:</div>
<div class="mdreg"><input type="text" class="box_textinput" name="user_name" id="user_name" maxlength="20" onkeypress="javaScript: return keyValid(event,'1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');" value="<?php if( isset($user_name) && $user_name  != "") echo $user_name; ?>" />
<div class="note"><a id="username_availability_link" onclick="check_username_availability();" href="javascript:void(0);">Check availability</a></div>
</div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Password<span>*</span>:</div>
<div class="mdreg"><input type="password" class="box_textinput" name="password" maxlength="20" id="password" /></div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Confirm password<span>*</span>:</div>
<div class="mdreg"><input type="password" class="box_textinput" name="reenter_password" maxlength="20" id="reenter_password" /></div>

<br class="clr" />
</div>
    

        <h1>Company Details</h1>

<div class="rigrow">
<div class="leftreg">Organization <span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" name="organization" id="organization" value="<?php if (isset($organization) && $organization  != "") echo $organization; ?>" /></div>


<br class="clr" />
</div>
        
<div class="rigrow">
<div class="leftreg">Company Logo <span>*</span>:</div>
<div class="countrybox"><input type="file" class="countyinp" name="company_logo" id="company_logo"  /></div>


<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Company link <span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" name="company_link" id="company_link" value="<?php if (isset($company_link) && $company_link  != "") echo $company_link; ?>" /></div>


<br class="clr" />
</div>  
        
<div class="rigrow">
<div class="leftreg">Country<span>*</span>:</div>
<div class="countrybox"><?php echo $country; ?></div>
<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Select city<span>*</span>:</div>
<div class="mdreg">
<div class="countrybox3">
<select class="contrydropdown" name="city" id="city">
<option value="">----- Select city -----</option>
<?php foreach($city_list as $v): ?>
<option value="<?php echo $v['CityId']; ?>" <?php if( isset($city) && $v['CityId'] == $city) echo 'selected="selected"'; ?>><?php echo $v['CityName'] ?></option>
<?php endforeach; ?>
</select></div>
<br class="clr" />
</div>

<br class="clr" />
</div>


<div class="rigrow">
<div class="leftreg">Postal code<span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" maxlength="20"  name="postal_code" id="postal_code" value="<?php if (isset($postal_code) && $postal_code  != "") echo $postal_code; ?>" /></div>


<br class="clr" />
</div>
    
<div class="rigrow">
<div class="leftreg">Address<span>*</span>:</div>
<div class="mdreg"><textarea name="address" id="address"><?php if (isset($address) && $address  != "") echo $address; ?></textarea></div>

<br class="clr" />
</div>        
        
<div class="rigrow">
<div class="leftreg">Word Verification<span>*</span>:</div>
<div class="mdreg"><img src="<?php echo base_url(); ?>security_captcha/captcha.php" alt="verfification code" id="verfification_code_img" width="170" />&nbsp;&nbsp;<a style="cursor:pointer;"><img src="<?php echo base_url(); ?>image/cref.gif" onclick="reset_verfication_code();" /></a></div>
<div class="leftreg">&nbsp;</div><div class="countrybox4"><input type="text"  name="captcha" id="captcha" maxlength="8" /></div>
<br class="clr" />
</div>


<div class="rigrow">
<div class="leftreg">&nbsp;</div>
<div class="countrybox4"><input type="checkbox" name="terms_of_use" id="terms_of_use" value="1" <?php echo $terms_of_use=='1'?'checked="checked"':''; ?> /><a class="link" href="<?php echo base_url(); ?>terms" target="_blank">I agree to the terms of use.</a></div>

<br class="clr" />
</div>


<div class="rigrow">
<div class="leftreg">&nbsp;</div>
<div class="countrybox4">
<input name="btn_signup" id="signup_btn_container" type="submit" class="submitreg_btn" value="Signup" />
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
<!--main Content End-->

</div>

<!--Footer Start-->
<?php $this->load->view('include/footer'); ?>
<!--Footer End-->


</body>
</html>
