<?php

session_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('Jobdb','',TRUE);
          
    }
    function all_jobs()
    {
        $define_page_name = ALLJOB_PG;
        require_once APPPATH . 'php_include/common_header.php';

        if ($recruiter_id == '0') {
            redirect(base_url());

            exit;
        }

        //-------- start for seo --------//

        $data_msg['meta_tag'] = array ('MetaTitle' => 'Post Online Jobs| Post Your Jobs & search Best candidates Now',
            'MetaDesc' => 'Register for free, post your jobs online and search for stuidents, candidates, exprienced, enggneers  through us',
            'MetaKeyword' => 'Adding job'
        );
        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//
       
        //------------- load classes ---------------//
        $this->load->library('form_validation');
        //------------- load classes ---------------//
        
        //--------- Start displaying error & success message ----------------//
        if ($this->session->userdata('error_msg')) {

            $data_msg['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata(array('error_msg' => ''));
        }
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        //------------ End displaying error & success mesage--------------//
        
        //------------- start fetch all jobs ------------//
        
        $jobs=$this->Jobdb->get_all_jobs($recruiter_id);
        if($jobs->num_rows() > 0)
        {
            $jobs_arr=$jobs->result_array();
        }
        else
        {
            $jobs_arr="";
        }
        $data_msg['show_data']=$jobs_arr;
        
        //------------- end fetch all jobs -------------//
        $this->load->view('job/show_all_jobs', $data_msg);
        
    }
    function add_job(){
         $define_page_name = ADDJOB_PG;
        require_once APPPATH . 'php_include/common_header.php';

        if ($recruiter_id == '0') {
            redirect(base_url());

            exit;
        }

        //-------- start for seo --------//

        $data_msg['meta_tag'] = array ('MetaTitle' => 'Post Online Jobs| Post Your Jobs & search Best candidates Now',
            'MetaDesc' => 'Register for free, post your jobs online and search for stuidents, candidates, exprienced, enggneers  through us',
            'MetaKeyword' => 'Adding job'
        );
        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//
       
        //------------- load classes ---------------//
        $this->load->library('form_validation');
        //------------- load classes ---------------//
        
        //--- start initializing an array to handle values and messages during error or success ---//
        
        $initial_array = array(
            'job_name' => '',
            'job_desc' => '',
            'job_loc' =>  '',
            'key_skills' =>  '',
            'key_skill_array'=>'',
            'functional_expertise' =>  '',
            'salary' =>  '',
            'experience' =>  '',            
            'error_msg' => ''            
        );
        
        //--- end initializing an array to handle values and messages during error or success ---//
        
        //----------------- start populating city list ----------------//
         $city_list= $this->all_function->get_allcity();
         $data_msg['city_list']=$city_list;

        //----------------- end populating city list ----------------//
         
         //---------------- start for fetching all expertise area list ---------------//
         $expertise_list= $this->all_function->get_allexpertise();
         $data_msg['expertise_list']=$expertise_list;
         //---------------- end for fetching all expertise area list ---------------//
         
         //----------------- start showing the error msg and given values -----------//
        if ($this->session->userdata('error_msg')) {
            foreach ($initial_array as $key => $v) {
                // Collect message if it is in session...
                if ($this->session->userdata($key)) {
                    $data_msg[$key] = $this->session->userdata($key);

                    $this->session->unset_userdata(array($key => ''));
                }
            }
        }
        //----------------- end showing the error msg and given values -----------//
        
        //----------------- start showing the success msg -----------//
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        //----------------- end showing the success msg -----------//
        
        //-------- start post action, validate errors, store into session, if success store into DB --------//
        
        if ($this->input->post('btn_jobpost')) {

            //--- start collecting values of input elements ---//
            $job_name = trim(strip_tags($this->input->post('job_name')));
            $job_desc = trim(strip_tags($this->input->post('job_desc')));
            $job_loc             =   trim(strip_tags($this->input->post('job_loc')));
            $key_skills      =   trim(strip_tags($this->input->post('key_skills'))); 
            $key_skill_array = explode(',', $key_skills,-1);
            $functional_expertise      = $this->input->post('expertise');
            $salary=trim(strip_tags($this->input->post('salary')));
            $experience      =   trim(strip_tags($this->input->post('experience')));
            
             //--- end collecting values of input elements ---//
            
            //--------------- start validating --------------//
            
            //--------- start check if job title for same company already exists -----------//
            if ($job_name != "") {

                $job_name_exist_num = $this->Jobdb->job_name_exist($job_name,$recruiter_id);
            }
            //--------- end check if job title for same company already exists -----------//
            //--------- Validating City ----------//			

            if (!empty($job_loc))
                $valid_job_loc = $this->all_function->valid_city($job_loc); 
           
            //------------Validating functional expertise----------//
            
            if(!empty ($functional_expertise))
                $valid_expertise = $this->all_function->valid_multiple_values(TABLE_EXPERTISE_AREA,'Name','Id',$functional_expertise);            
            
            //------------End validating functional expertise----------//
            //-----------Start validating key skills--------------------//
            if(!empty ($key_skill_array))
                $valid_key_skills = $this->all_function->valid_multiple_values(TABLE_KEY_SKILLS,'SkillName','SkillName',$key_skill_array);
            //---------------End------------------//
            //----------Start validating experience-----------//
            
            if(!empty($experience))
                $valid_experience = $this->Jobdb->valid_experience($experience);
            
            //----------End validating experience-----------//
            
            $error_msg = "";
            
            if(! $this->form_validation->required($job_name)){
                $error_msg="Please enter job title.";
            }elseif($job_name_exist_num > 0){
                $error_msg="Job title already exists.";
            }elseif(! $this->form_validation->required($job_desc)) {
                $error_msg = "Please enter job description.";
            }elseif(! $this->form_validation->required($job_loc)) {
                $error_msg = "Please select job location.";
            }else if ($job_loc != '' && $valid_job_loc == '0') {
                $error_msg = "Please select a valid job location.";
            }elseif(!$this->form_validation->required($key_skill_array)){
                $error_msg = "Please enter key skills.";
            }elseif($valid_key_skills == FALSE){
                $error_msg = "Please enter a valid skill.";
            }elseif(!$this->form_validation->required($functional_expertise)){
                $error_msg = "Please select functional expertise.";
            }elseif($valid_expertise == FALSE){
                $error_msg = "Please select valid functional expertise.";
            }elseif(!$this->form_validation->required($salary)){
                $error_msg = "Please enter salary.";
            }elseif(!$this->form_validation->float($salary)){
                $error_msg = "Please enter valid salary.";
            }elseif(!$this->form_validation->required($experience)){
                $error_msg = "Please select experience";
            }elseif($valid_experience==false){
                $error_msg = "Please select a valid experience";
            }
            
            //--------------- end validating --------------//
            
            //--- set error message into session if @error_msg is defined ---//
            if ($error_msg != "") {
                $sess_array = array();
                foreach ($initial_array as $key => $v) {
                    // Collect input value if it is defined...
                    if (isset($$key)) {
                        $sess_array[$key] = $$key;
                    }
                }
                $this->session->set_userdata($sess_array);
            }

            //--- else set DB operations on success, corresponding success message ---//
            
            else {
                // Genarate job id
                $job_id = $this->all_function->rand_string(6);
                
                // start building DB operation
                $job_data = array(
                    'Id' => $job_id,
                    'RecruiterId' => $recruiter_id,
                    'JobName' => $job_name,
                    'JobDescription' => $job_desc,
                    'JobLocation' => $this->all_function->get_name(TABLE_CITY,'CityName','CityId',$job_loc),
                    'Skill' => serialize($this->all_function->get_names(TABLE_KEY_SKILLS,'SkillName','SkillName',$key_skill_array)),
                    'FunctionalExpertise'=>serialize($this->all_function->get_names(TABLE_EXPERTISE_AREA,'Name','Id',$functional_expertise)),
                    'Salary'=>$salary,
                    'Experience'=>$experience,
                    'JobAddedDate' => date("Y-m-d H:i:s"),
                    'Status' => '1'
                );
                
                $this->Jobdb->insert_jobs($job_data);    
                $msg_create_job_success = "Job is successfully added.";
                $this->session->set_userdata('success_msg', $msg_create_job_success);
        }
            redirect(base_url() . 'add-job');
            exit;
        }
        $this->load->view('job/add_job', $data_msg);
        
    }
    function edit_job($job_id){
         $define_page_name = EDITJOB_PG;
        require_once APPPATH . 'php_include/common_header.php';

        if ($recruiter_id == '0') {
            redirect(base_url());

            exit;
        }

        //-------- start for seo --------//

        $data_msg['meta_tag'] = array ('MetaTitle' => 'Post Online Jobs| Post Your Jobs & search Best candidates Now',
            'MetaDesc' => 'Register for free, post your jobs online and search for stuidents, candidates, exprienced, enggneers  through us',
            'MetaKeyword' => 'Adding job'
        );
        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//
       
        //------------- load classes ---------------//
        $this->load->library('form_validation');
        //------------- load classes ---------------//
        
        //--- start initializing an array to handle values and messages during error or success ---//
        
        $initial_array = array(
            'job_name' => '',
            'job_desc' => '',
            'job_loc' =>  '',
            'key_skills' =>  '',
            'key_skill_array'=>'',
            'functional_expertise' =>  '',
            'salary' =>  '',
            'experience' =>  '',
            'status'=>'',
            'error_msg' => ''            
        );
        
        //--- end initializing an array to handle values and messages during error or success ---//
        
        //----------------- start populating city list ----------------//
         $city_list= $this->all_function->get_allcity();
         $data_msg['city_list']=$city_list;

        //----------------- end populating city list ----------------//
         
         //---------------- start for fetching all expertise area list ---------------//
         $expertise_list= $this->all_function->get_allexpertise();
         $data_msg['expertise_list']=$expertise_list;
         //---------------- end for fetching all expertise area list ---------------//
         
         
        
        
        
       
        
        //---------------- Start get job details by job id -----------------//
        
        $job_arr=$this->Jobdb->get_job_byid($job_id)->result_array();
        if(count($job_arr) <= 0)
        {
            redirect(base_url().'all-jobs');
        }
        //----------------- start showing the error msg and given values -----------//
        if ($this->session->userdata('error_msg')) {
            foreach ($initial_array as $key => $v) {
                // Collect message if it is in session...
                if ($this->session->userdata($key)) {
                    $data_msg[$key] = $this->session->userdata($key);

                    $this->session->unset_userdata(array($key => ''));
                }
            }
        }
        else
        {
            $data_msg['job_name']=$job_arr[0]['JobName'];
            $data_msg['job_desc']=$job_arr[0]['JobDescription'];
            $data_msg['job_loc']=$this->all_function->get_name(TABLE_CITY,'CityId','CityName',$job_arr[0]['JobLocation']);
            $data_msg['key_skill_array'] = unserialize($job_arr[0]['Skill']);
            if(!is_array($data_msg['key_skill_array']))
            {
            $data_msg['key_skills']='';
            }
            else
            {
                $str=array();
                $i=0;
                foreach($data_msg['key_skill_array'] as $array)
                {
                        $str[$i]=$array['SkillName'];
                    $i++;
                }
                
                $data_msg['key_skills']=implode(",", $str);
                $data_msg['key_skills'].=",";
            }
            $data_msg['functional_expertise']=unserialize($job_arr[0]['FunctionalExpertise']);
            $data_msg['salary']=$job_arr[0]['Salary'];
            $data_msg['experience']=$job_arr[0]['Experience'];
            $data_msg['status']=$job_arr[0]['Status']==1?'A':"I";
        }
        //----------------- end showing the error msg and given values -----------//
        
        //---------------- End get job details by job id ------------------//
        
         //----------------- start showing the success msg -----------//
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        //----------------- end showing the success msg -----------//
        
        //-------- start post action, validate errors, store into session, if success store into DB --------//
        
        if ($this->input->post('btn_jobedit')) {

            //--- start collecting values of input elements ---//
            $job_name = trim(strip_tags($this->input->post('job_name')));
            $job_desc = trim(strip_tags($this->input->post('job_desc')));
            $job_loc             =   trim(strip_tags($this->input->post('job_loc')));
            $key_skills      =   trim(strip_tags($this->input->post('key_skills'))); 
            $key_skill_array = explode(',', $key_skills,-1);
            $functional_expertise      = $this->input->post('expertise');
            $salary=trim(strip_tags($this->input->post('salary')));
            $experience      =   trim(strip_tags($this->input->post('experience')));
            $status=trim(strip_tags($this->input->post('status')));
             //--- end collecting values of input elements ---//
            
            //--------------- start validating --------------//
            
            //--------- start check if job title for same company already exists -----------//
            if ($job_name != "") {

                $job_name_exist_num = $this->Jobdb->job_name_exist($job_name,$recruiter_id,$job_id);
            }
            //--------- end check if job title for same company already exists -----------//
            //--------- Validating City ----------//			

            if (!empty($job_loc))
                $valid_job_loc = $this->all_function->valid_city($job_loc); 
           
            //------------Validating functional expertise----------//
            
            if(!empty ($functional_expertise))
                $valid_expertise = $this->all_function->valid_multiple_values(TABLE_EXPERTISE_AREA,'Name','Id',$functional_expertise);            
            
            //------------End validating functional expertise----------//
            //-----------Start validating key skills--------------------//
            if(!empty ($key_skill_array))
                $valid_key_skills = $this->all_function->valid_multiple_values(TABLE_KEY_SKILLS,'SkillName','SkillName',$key_skill_array);
            //---------------End------------------//
            //----------Start validating experience-----------//
            
            if(!empty($experience))
                $valid_experience = $this->Jobdb->valid_experience($experience);
            
            //----------End validating experience-----------//
            
            $error_msg = "";
            
            if(! $this->form_validation->required($job_name)){
                $error_msg="Please enter job title.";
            }elseif($job_name_exist_num > 0){
                $error_msg="Job title already exists.";
            }elseif(! $this->form_validation->required($job_desc)) {
                $error_msg = "Please enter job description.";
            }elseif(! $this->form_validation->required($job_loc)) {
                $error_msg = "Please select job location.";
            }else if ($job_loc != '' && $valid_job_loc == '0') {
                $error_msg = "Please select a valid job location.";
            }elseif(!$this->form_validation->required($key_skill_array)){
                $error_msg = "Please enter key skills.";
            }elseif($valid_key_skills == FALSE){
                $error_msg = "Please enter a valid skill.";
            }elseif(!$this->form_validation->required($functional_expertise)){
                $error_msg = "Please select functional expertise.";
            }elseif($valid_expertise == FALSE){
                $error_msg = "Please select valid functional expertise.";
            }elseif(!$this->form_validation->required($salary)){
                $error_msg = "Please enter salary.";
            }elseif(!$this->form_validation->float($salary)){
                $error_msg = "Please enter valid salary.";
            }elseif(!$this->form_validation->required($experience)){
                $error_msg = "Please select experience";
            }elseif($valid_experience==false){
                $error_msg = "Please select a valid experience";
            }elseif($status=="" || $status!='A' && $status!='I'){
                $error_msg = "Please select a valid status.";
            }
                
            
            //--------------- end validating --------------//
            
            if(isset($key_skill_array) && $key_skill_array != null)
               { 
               $key_skill_array = $this->all_function->get_names(TABLE_KEY_SKILLS,'SkillName','SkillName',$key_skill_array);
               
               }
               if(isset($functional_expertise) && $functional_expertise != null){
                $functional_expertise = $this->all_function->get_names(TABLE_EXPERTISE_AREA,'Name','Id',$functional_expertise);
               }
            
            //--- set error message into session if @error_msg is defined ---//
            if ($error_msg != "") {
                $sess_array = array();
                foreach ($initial_array as $key => $v) {
                    // Collect input value if it is defined...
                    if (isset($$key)) {
                        $sess_array[$key] = $$key;
                    }
                }
                $this->session->set_userdata($sess_array);
            }

            //--- else set DB operations on success, corresponding success message ---//
            
            else {                
                // start building DB operation
                $job_data = array(
                    'RecruiterId' => $recruiter_id,
                    'JobName' => $job_name,
                    'JobDescription' => $job_desc,
                    'JobLocation' => $this->all_function->get_name(TABLE_CITY,'CityName','CityId',$job_loc),
                    'Skill' => serialize($key_skill_array),
                    'FunctionalExpertise'=>serialize($functional_expertise),
                    'Salary'=>$salary,
                    'Experience'=>$experience,
                    'JobAddedDate' => date("Y-m-d H:i:s"),
                    'Status' => $status=="A"?'1':'0'
                );
                
                $this->Jobdb->update_job($job_id,$job_data);    
                $msg_update_job_success = "Job is successfully Updated.";
                $this->session->set_userdata('success_msg', $msg_update_job_success);
        }
            redirect(base_url() . 'edit-job/'.$job_id);
            exit;
        }
        $this->load->view('job/edit_job', $data_msg);
        
    }
    function delete_job($job_id)
    {
        require_once APPPATH . 'php_include/common_header.php';

        if ($recruiter_id == '0') {
            redirect(base_url());

            exit;
        }
        else{
            
            //---------- start validate job id -----------------//
            
            $valid_job_num=$this->Jobdb->validate_job_id($job_id);
            
            //---------- end validate job id ---------------//
            if($valid_job_num > 0 )
            {
                $this->Jobdb->delete_job($job_id);
                $this->session->set_userdata('success_msg','Job is successfully deleted.');
                redirect(base_url()."all-jobs");
            }
            else
            {
                $this->session->set_userdata('error_msg','Wrong request');
                redirect(base_url()."all-jobs");
            }
            
        }
    }
}