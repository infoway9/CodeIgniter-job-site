<?php

if($this->session->userdata('job_recruiter_id')!='')
{
    $recruiter_id=$this->session->userdata('job_recruiter_id');
    $recruiter_name=$this->session->userdata('job_recruiter_name');

    $data_msg['recruiter_name']=$recruiter_name;  
    

    $data_msg['login_status']='yes';
}
else
{
    $recruiter_id='0';
    
    $data_msg['login_status']='no';
}

$data_msg['recruiter_id']=$recruiter_id;

?>