<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/profile.js"></script>

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
<h1>Recruiter Details</h1>
<div class="msgreq"><span>*</span> Fields are required</div>
<form name="editprofile_frm" id="editprofile_frm" action="" enctype="multipart/form-data" method="post" onsubmit="return validate_editprofile();">
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
<div class="leftreg">Organization <span>*</span>:</div>
<div class="countrybox"><input type="text" class="countyinp" name="organization" id="organization" value="<?php if (isset($organization) && $organization  != "") echo $organization; ?>" /></div>


<br class="clr" />
</div>
        
<div class="rigrow">
<div class="leftreg">Company Logo :</div>
<div class="countrybox"><img src="<?php echo SHOW_MEDIA_BASEFOLDER.'showcase/company_logo/'.$company_logo; ?>?123"  name="logo" id="logo" title="Company logo" alt="no logo" /></div>


<br class="clr" />
</div>

<div class="rigrow">
<div class="leftreg">Upload :</div>
<div class="countrybox"><input type="file" class="countyinp" name="company_logo" id="company_logo"  />(must be 70*44 in dimension.)</div>


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
<div class="leftreg">&nbsp;</div>
<div class="countrybox4">
<input name="btn_editprofile" id="btn_editprofile" type="submit" class="submitreg_btn" value="Update" />
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

