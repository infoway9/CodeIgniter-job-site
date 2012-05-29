<?php

if($this->session->userdata('job_user_id')!='')
{
    $user_id=$this->session->userdata('job_user_id');
    $user_name=$this->session->userdata('job_user_name');

    $data_msg['user_name']=$user_name;  
    

    $data_msg['login_status']='yes';
}
else
{
    $user_id='0';
    
    $data_msg['login_status']='no';
}

$data_msg['user_id']=$user_id;

?>