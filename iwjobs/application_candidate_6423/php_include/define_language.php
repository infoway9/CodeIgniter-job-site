<?php

$header_language="en";
$header_language_arr=array("en","es");


if(isset($_REQUEST['secure_lan']) && $_REQUEST['secure_lan']!="" && in_array($_REQUEST['secure_lan'],$header_language_arr))
{
       $header_language=$_REQUEST['secure_lan'];

     setcookie("tax_secure_lang", $header_language, time()+31536000, "/"); // set cookie for 1 year
}
else if(isset($_COOKIE['tax_secure_lang']))
{
    $header_language=$_COOKIE['tax_secure_lang'];
}

if(!in_array($header_language,$header_language_arr))
{
    $header_language="en";
}
// echo $header_language;
if ( ! defined('DEFAULT_LANGUAGE')) define ( 'DEFAULT_LANGUAGE', $header_language)

?>
