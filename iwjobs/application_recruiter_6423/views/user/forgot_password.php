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


<!--main Content Start-->
<div class="contentmainsocial">
<?php //$this->load->view('include/social_link'); ?>
</div>
				
<div class="contentmaininner">



<div class="singlebody">

<h1 class="login">Forgot your password </h1>
<div class="msgreq"><span>*</span> Fields are required</div>
<form name="forgot_pswd_frm" id="forgot_pswd_frm" action="" method="post" onsubmit="return validate_forgot_password();">
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
<div class="leftreg">Email <span>*</span>:</div>
<div class="mdreg"><input type="text" class="box_textinput" name="email" id="email" value="<?php if (isset($email) && $email  != "") echo $email; ?>"  /></div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Word verification <span>*</span>:</div>
<div class="mdreg">
<img class="bd" src="<?php echo base_url(); ?>security_captcha/captcha.php" alt="verfification code" id="verfification_code_img" width="170" />
<a style="cursor:pointer;"><img src="<?php echo base_url(); ?>image/cref.gif" onclick="reset_verfication_code();" /></a>
</div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">&nbsp;</div>
<div class="mdreg"><input type="text" class="box_textinput" name="captcha" id="captcha" maxlength="8" /></div>

<br class="clr" />
</div>


<div class="rigrow">
<div class="leftreg">&nbsp;</div>
<div class="countrybox">
<input name="btn_forgot_pswd" id="forgotpswd_btn_container" type="submit" class="submitreg_btn" value="Submit" />
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
