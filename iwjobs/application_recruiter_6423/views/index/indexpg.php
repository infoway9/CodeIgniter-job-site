<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
</head>

<body>
<div class="maincontent">
<!--Header Part Start-->
<?php $this->load->view('include/header'); ?>
<script src="<?php echo base_url(); ?>js/jquery.cycle.all.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/user.js"></script>
<!--Header Part End-->



<!--main Content Start-->

				
<div class="contentmain">

<!--Top Caption Start-->
<div class="mainarea">
<div class="body_left">
    
   
<?php if($recruiter_id=="0"): ?>
<div class="userlogin">
<a name="signin"></a>
<form name="signin_frm" id="signin_frm" action="" method="post" onsubmit="return validate_signin();">
<div class="bwcornera bwlfttop_bodya"></div><div class="bwmdltop_bodyad"></div><div class="bwcornera bwrgttop_bodyad"></div>
<div class="bwmiddle_bodya">

<h1 class="login">Login</h1>
<div class="fault">
<div class="errorbox" id="signin_err_container" style="<?php if(isset($error_msg) && $error_msg  != "") echo 'display:block;'; else echo 'display:none;'; ?>"><?php if(isset($error_msg) && $error_msg  != "") echo $error_msg; ?></div>
<div class="successbox" id="signin_succ_container" style="<?php if(isset($success_msg) && $success_msg  != "") echo 'display:block;'; else echo 'display:none;'; ?>"><?php if(isset($success_msg) && $success_msg  != "") echo $success_msg; ?></div>

<div class="pleasesign" id="continue_signin" style="<?php if(isset($continue_signin) && $continue_signin=="y") echo 'display:block;'; else echo 'display:none;'; ?>">
<img src="<?php echo base_url(); ?>image/signuparrow.gif" />
Please sign in to continue.
<br class="clr" />
</div>

</div>
<div class="formarea">
<div class="titleform"><strong>Username</strong></div>
<div class="formbox"><input class="loginbox" type="text" name="textusername" id="textusername" value="<?php if(isset($username)&& $username!=""){echo $username;} ?>" /></div>
<div class="titleform"><strong>Password</strong></div>
<div class="formbox"><input class="loginbox" type="password" name="textpassword" id="textpassword" value="" /></div>


<div class="rememberme">
<div class="reminput"><input type="checkbox" name="stay_sign" value="1" <?php if(isset($staysignin) && $staysignin=='1'){echo 'checked'; } ?> /></div>
<div class="reminputdesc"><strong>Stay sign in</strong></div>
<div class="reminputbtn">
    
<input name="btn_signin" id="signin_btn_container" type="submit" value="Signin" class="login_btn" />
<div id="processing_status_container" style="display:none;">
<div><span><img src="<?php echo base_url(); ?>image/processing.gif" /></span></div>
<br class="clr" />
</div>
</div>
<br class="clr" />
</div>

<p><a href="<?php echo base_url(); ?>forgot-password">Forgot your password?</a></p>
<p><a href="<?php echo base_url(); ?>signup">Create an account</a></p>

</div>

</div>
<div class="bwcornera bwlftbtm_bodya"></div><div class="bwmdlbtm_bodyad"></div><div class="bwcornera bwrgtbtm_bodyad"></div>
<br class="clr" />
</form>
</div>
<?php endif; ?>






</div>
<!--Left Content End-->

<!--Right Content Start-->
<div class="body_right">



<div class="body_txt">
    <strong>About Us: </strong> 

Try Recruitment Solutions from Job search. We enable you to:
<p><ul>
    <li>Source the best talent from a database of over 29.7 million searchable resumes.</li>
    <li>Enhance your reach by publishing your jobs in leading print publications who we have partnered with.</li>
    <li>Organize and simplify your recruitment process using our response management tools.</li>
</ul>
    </p>





	
</div>

</div>
<!--Right Content End-->

<!--Right Content Start-->

<!--Right Content End-->
</div>

</div>
<!--main Content End-->

</div>

<!--Footer Start-->
<?php $this->load->view('include/footer'); ?>
<!--Footer End-->


</body>
</html>
