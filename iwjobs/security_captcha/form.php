<?php
session_start();
if (!empty($_REQUEST['captcha'])) 
{
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) 
	{
        $note= 'Please enter valid text';
    } 
	else 
	{
	if($_SERVER["REQUEST_METHOD"] == "POST")
{

$name=htmlentities($_POST['name']); 
$message=htmlentities($_POST['message']);
// Insert SQL Statement 
$note= 'Values Inserted';
}

    }

  
    unset($_SESSION['captcha']);
}


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>9lessons Demo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
body{
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}
</style>
</head>

<body>

<div style="background-color:#ffffcc; padding:4px; border:#333 1px solid">9lessons programming Blog. Topics focused about jquery, ajax, mysql, php and java. <a href="http://9lessons.info">http://9lessons.info</a></div> 
<div><h3>Tutorial link <a href="http://www.9lessons.info/2010/06/facebook-like-extracting-url-data-with.html">click here</a></h3></div> 
<div style="margin:50px ">
<div style="width:300px;background:#ff99ff; margin-bottom:20px"><?php echo $note; ?></div>
<form method="post" >
<b>Name</b><br/>
<input type="text" name="name" /><br/>
<b>Message</b><br/>
<textarea name="message"></textarea><br/>
<img src="captcha.php" id="captcha" /><br/>
<a href="#" onclick="
    document.getElementById('captcha').src='captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Not readable? Change text.</a><br/><br/>
	<b>Human Test</b><br/>
	<input type="text" name="captcha" id="captcha-form" /><br/>
	
<input type="submit" />
</form>
</div>
</body>
</html>
