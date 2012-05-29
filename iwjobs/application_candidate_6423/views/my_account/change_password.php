<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollTo-1.4.2-min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>-->

<script type="text/javascript" src="<?php echo base_url();?>js/my_account.js"></script>
</head>

<body>
<div class="maincontent">
<!--Header Part Start-->
<?php $this->load->view('include/header'); ?>
<!--Header Part End-->

<!--main Content Start-->
				
<div class="contentmaininner">

<div class="singlebody">

<h1 class="login">My Settings</h1>
<div class="myacc">
<?php $this->load->view('include/profile_left'); ?>
<div class="myaccRgt">

<!--form start-->
<div class="formmyacc">
<h2>Change Your Password</h2>
<div class="msgreq"><span>*</span> Fields are required</div>
<form name="frm_change_pswd" id="frm_change_pswd" action="" method="post" onsubmit="return validate_passwordchange();">
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
<div class="leftreg">Current Password <span>*</span>:</div>
<div class="mdreg"><input type="password" class="box_textinput" name="current_password" id="current_password" /></div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">New Password <span>*</span>:</div>
<div class="mdreg"><input type="password" class="box_textinput" name="new_password" id="new_password" /></div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Confirm Password <span>*</span>:</div>
<div class="mdreg"><input type="password" class="box_textinput" name="password_confirmation" id="password_confirmation" /></div>

<br class="clr" />
</div>
<div class="rigrow">
  <div class="leftreg">&nbsp;</div>
<div class="countrybox">
<input type="submit" name="btn_changepassword" id="btn_container" value="Change Password" class="submitreg_btn" />
<div id="processing_status_container" style="display:none;">
<div><span><img src="<?php echo base_url(); ?>image/processing.gif" /></span></div>
<br class="clr" />
</div>
</div>

<br class="clr" />
</div>
</form>

</div>

<!--form end-->
</div>
<br class="clr" />
</div>
</div>

</div>
<!--main Content End-->

</div>

<!--Footer Start-->
<?php $this->load->view('include/footer'); ?>
<!--Footer End-->
</body>
</html>
