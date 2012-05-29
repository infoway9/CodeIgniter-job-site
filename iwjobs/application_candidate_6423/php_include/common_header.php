<?php


$data_msg['top_menu']='';
require_once APPPATH.'php_include/authenticate.php';

//---------- start for auto login ---------//

if($user_id=='0' && isset($_COOKIE['tax_autologin']))
{
   redirect(base_url().'autologin/?auto_login='.urlencode($_SERVER['REQUEST_URI']));

}

//---------- start for auto login ---------//

?>