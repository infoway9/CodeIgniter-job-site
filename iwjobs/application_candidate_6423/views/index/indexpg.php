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
   
<?php if($user_id=="0"): ?>
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


<div class="platformbody">
<div class="bwcorner bwlfttop_body"></div><div class="bwmdltop_body"></div><div class="bwcorner bwrgttop_body"></div>
<div class="bwmiddle_body">
<h2>Our Hot Employers</h2>



</div>
<div class="bwcornerbtm bwlftbtm_body"></div>
<div class="bwmdlbtm_bodya"></div>
<div class="bwmdlbtm_bodyb"></div>
<div class="bwmdlbtm_bodyc"></div>
<div class="bwmdlbtm_bodyd">
<div class="morebtn"><a href="<?php echo base_url(); ?>" class="read_btnyl">read more</a></div>
</div>
<div class="bwcornerbtm bwrgtbtm_body"></div>
<br class="clr" />

</div>
<div class="body_boxone">
    
<div class="borderboxwrap">
    <?php if(is_array($companies) && count($companies) > 0 ) :?>
    <?php foreach($companies as $company):?>
    <div class="boxholder"><a target=" " href="<?php if(strpos($company['CompanyLink'], "http://")===false): echo "http://".$company['CompanyLink']; else: echo $company['CompanyLink']; endif; ?>"><img src="<?php echo SHOW_MEDIA_BASEFOLDER.'showcase/company_logo/'.$company['CompanyLogo'];?>" title="<?php echo $company['Organization'];?>" /></a></div>
<?php endforeach;?>
    <?php else:?>
    <div class="boxholder">Currently there are no companies.</div>
<?php endif;?>

<br class="clr" />
</div>
    
</div>
<div class="body_txt">
    <strong>About Us: </strong> 

Imagine viewing hundreds of job openings presented by Top Recruitment Consultants of India at a single page is so simple at this section! Professional & personalized job seeking service for Senior Professionals
Job Seek
An Umbrella solution that provides tailored value addition at every step of job seeking, starting from Job Search, profile optimization to interview homework.
<p><ul>
    <li>Jobs: We research, we recommend> you apply</li>
    <li>Profile: You provide raw data or Resume > We refine, rewrite and Highlight.</li>
    <li>Interview: You fix the time slot . We make sure you are coached and prepared.</li>
</ul>
    </p>

	
</div>

</div>
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
