<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/profile.js"></script>
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

<h1 class="login">My Settings</h1>

<div class="myacc">
<?php $this->load->view('include/profile_left'); ?>
<div class="myaccRgt">

<div class="formmyacc">
<h2>My Personal profile</h2>
<div class="msgreq"><span>*</span> Fields are required</div>
<form name="editprofile_frm" id="editprofile_frm" action="" method="post" onsubmit="return validate_editprofile();">
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
<div class="leftreg">First name<span>*</span>:</div>
<div class="mdreg"><input type="text" class="box_textinput" name="fname" id="fname" maxlength="30" value="<?php if( isset($fname) && $fname  != "") echo $fname; ?>" /></div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Last name:</div>
<div class="mdreg"><input type="text" class="box_textinput" name="lname" id="lname" maxlength="30" value="<?php if( isset($lname) && $lname  != "") echo $lname; ?>" /></div>

<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Gender<span>*</span>:</div>
<div class="mdreg">
    <div class="radobox"><input type="radio" name="gender" value="m" <?php if( $gender=='m') echo 'checked="checked"'; ?> /></div>
	<div class="radodesc">Male</div>
    <div class="radobox"><input type="radio" name="gender" value="f" <?php if( $gender=='f') echo 'checked="checked"'; ?> /></div>
	<div class="radodesc">Female</div>
    <br class="clr" />
</div>

<br class="clr" />
</div>



<div class="rigrow">
<div class="leftreg">Country:</div>
<div class="mdreg">
<div class="countrybox3"><?php if($country!=''): echo $country; endif; ?></div>


<br class="clr" />
</div>

<br class="clr" />
</div>






<div class="rigrow">
<div class="leftreg">City<span>*</span>:</div>
<div class="mdreg"><select class="contrydropdown" name="city" id="city">
<option value="">----- Select city -----</option>
<?php foreach($city_list as $v): ?>
<option value="<?php echo $v['CityId']; ?>" <?php if( isset($city) && $v['CityId'] == $city) echo 'selected="selected"'; ?>><?php echo $v['CityName'] ?></option>
<?php endforeach; ?>
</select></div>

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
<div class="leftreg">&nbsp;</div>
<div class="countrybox">
<input name="btn_editprofile" id="btn_container" type="submit" class="submitreg_btn" value="Submit" />
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
