<div class="headerline"></div>
<div class="top_header">
<div class="topinner">
<div class="topinnerleft">
<div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>image/jobsrc.png" /></a></div>
</div>
<div style="position:absolute; top:3px; left:870px;">
<ul class="example2">
<li>
<a href="<?php echo base_url(); ?>../"><span>Candidate zone</span></a>
</li>
</ul>
</div>
<div class="topinnerright">
<div class="signuptoparaareab">

<?php if($recruiter_id=="0"): ?>
<div class="socialbtn">

			
<?php /*?><a class="signupnow_btn" href="<?php echo base_url(); ?>recruiter/signup">Recruiter zone</a><?php */?>
</div>
<?php else: ?>
    <div class="myaccount">Hi <b style="color: #000"><?php if($recruiter_name!=''): echo $recruiter_name; endif; ?></b> | 
<a href="<?php echo base_url(); ?>change-password">My account</a> | <a href="<?php echo base_url(); ?>signout">Logout</a>
</div>

<?php endif; ?>
</div>

<!--Navigation Start-->
<ul>
<?php if($login_status!="" && $login_status=="no"):?><li><a href="<?php echo base_url(); ?>" <?php if($top_menu==INDEX_PG): ?>class="current"<?php endif; ?>><span>Home</span></a></li><?php endif;?>
<li><a href="<?php echo base_url(); ?>candidate-search" <?php if($top_menu==CANDIDATE_SEARCH): ?>class="current"<?php endif; ?>><span>Candidate Search</span></a></li>
<?php if($login_status!="" && $login_status=="no"): ?><li><a href="<?php echo base_url(); ?>signup" <?php if($top_menu==SIGNUP_PG): ?>class="current"<?php endif; ?>><span>Register</span></a></li><?php endif; ?>
</ul>
<!--Navigation End-->

</div>
<br class="clr" />
</div>

</div>