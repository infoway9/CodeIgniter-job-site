<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript">
    function confirmation(id)
    {
        var agree=confirm("Do you realy want to delete ?");
        if(agree)
            {
                window.location="<?php echo base_url()."delete-job/"; ?>"+id;
                return true;
            }
        else
            {
                return false;
            }
    }
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


<!--Top Caption Start-->
<div class="singlebody">
    <h1 class="login">My Settings</h1>
    <div class="myacc">
        <div class="myaccleft">
<?php $this->load->view('include/profile_left'); ?>
        </div>
<div class="myaccRgt">
    <div class="formmyacc" style="width: 740px;">
<div>
    <div><h2>All jobs </h2></div><div style="float: right;margin-bottom: 10px;"><a href="<?php echo base_url()."add-job"; ?>" style="background: #000;color: #fff;padding: 5px;">Add job</a></div>
<br class="clr" />
<br class="clr" />
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
<br class="clr" />

<div style="width:900px; margin:0 auto; padding:0 0 15px 0;">
    
    <?php if(isset ($show_data) && $show_data!=''): ?>
<table width="750" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #ccc;">
  <tr style="background:#000; padding:5px 0; color:#fff;">
    <td>Job Name</td>
    <td>Job Location</td>
    <td>Added Date</td>
    <td>Status</td>
    <td>Action</td>
  </tr>
    <?php $i=0; $count=count($show_data); while($i<$count):?>
  <tr>
      
    <td><?php echo $this->all_function->wraptext($show_data[$i]['JobName'],20); ?></td>
    <td><?php echo $show_data[$i]['JobLocation']; ?></td>
    <td><?php echo $show_data[$i]['JobAddedDate']; ?></td>
    <td><?php if($show_data[$i]['Status']=='0'): echo "Inactive"; else: echo "Active"; endif;  ?></td>
    <td><a href="<?php echo base_url()."edit-job/".$show_data[$i]['Id'];?>" ><img src="<?php echo base_url().'image/edit.gif'; ?>"  title="Edit" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="return confirmation('<?php echo $show_data[$i]['Id'];?>');" ><img src="<?php echo base_url().'image/delete.gif'; ?>" title="Delete" /></a></td>
  </tr>
    
    <?php $i++; endwhile;?>
</table>
<?php else: ?>
No Records
<?php endif;?>

</div>
<br class="clr" />
</div>
    <br class="clr" />
</div>
<br class="clr" />
</div>
<!--main Content End-->
<br class="clr" />

</div>
</div>
</div>

<!--Footer Start-->
<?php $this->load->view('include/footer'); ?>
<!--Footer End-->

</div>
</body>
</html>