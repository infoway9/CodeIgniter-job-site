<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_search extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Job_searchdb', '', TRUE);
    }

    public function index() {
        
        $define_page_name = JOBSEARCH_PG;
        require_once APPPATH . 'php_include/common_header.php';

        //-------- start for seo --------//

        $data_msg['meta_tag'] = array('MetaTitle' => 'Jobs for Everyone',
            'MetaDesc' => 'Get your dream job',
            'MetaKeyword' => 'Jobs for Everyone, Get your dream job'
        );
        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//

        //------------- load classes ---------------//
        $this->load->library('form_validation');
        $this->load->model('Userdb');
        //------------- load classes ---------------//
        
        //--- start initializing an array to handle values and messages during error or success ---//

        $initial_array = array(
            'keyword' => '',
            'location' => '',
            'key_skills'=>'',
            'key_skill_array'=>'',
            'expertise' => '',
            'salary'=>'',
            'experience'=>'',
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
        
        
        //------------ start for error and success message --------------//

        if ($this->session->userdata('error_msg') != "") {
            $data_msg['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');    
        }

        if ($this->session->userdata('success_msg') != "") {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }

        //------------ end for error and success message --------------//
        
        //------ Start fetch get values ----------//
        $keyword=$this->input->get('keyword') && $this->input->get('keyword')!=''?$this->input->get('keyword'):'';
        $location=$this->input->get('location') && $this->input->get('location')!=''?$this->input->get('location'):'';
        $key_skills=$this->input->get('key_skills') && count($this->input->get('key_skills')) >0 ?$this->input->get('key_skills'):'';
        
        $key_skills = trim(strip_tags($this->input->get('key_skills')));
        $key_skill_array = explode(',', $key_skills,-1);
        
        $expertise=$this->input->get('expertise') && $this->input->get('expertise')!=''?explode("|", $this->input->get('expertise')):'';
        $salary=$this->input->get('salary') && $this->input->get('salary')!=''?$this->input->get('salary'):'';
        $experience=$this->input->get('experience') && $this->input->get('experience')!=''?$this->input->get('experience'):'';
        //------ End fetch get values ----------//
        
        //------------ start for search ----------//
        if ($this->input->post('btn_jobsearch')) {
            
            //----------- start fetching post data -------------------//

            $keyword = trim(strip_tags($this->input->post('keyword')));
            $location = trim(strip_tags($this->input->post('location')));
            $key_skills = trim(strip_tags($this->input->post('key_skills')));
            $key_skill_array = explode(',', $key_skills,-1);
            $expertise = $this->input->post('expertise');
            $salary=trim(strip_tags($this->input->post('salary')));
            $experience      =   trim(strip_tags($this->input->post('experience')));
            
            //----------- end fetching post data ---------------------//
            
        }
        //------------ end for search ----------//
        
        $error_msg = "";
        
        //--------- Validating City ----------//			

            if (!empty($location))
                $valid_job_loc = $this->all_function->valid_city($location); 
           
            //------------Validating functional expertise----------//
            
            if(!empty ($expertise))
                $valid_expertise = $this->all_function->valid_multiple_values(TABLE_EXPERTISE_AREA,'Name','Name',$expertise);            
            
            //------------End validating functional expertise----------//
            //-----------Start validating key skills--------------------//
            if(!empty ($key_skill_array))
                $valid_key_skills = $this->all_function->valid_multiple_values(TABLE_KEY_SKILLS,'SkillName','SkillName',$key_skill_array);
            //---------------End validating key skills------------------//
           
             
            //----------Start validating experience-----------//
            
            if(!empty($experience))
                $valid_experience = $this->Userdb->valid_experience($experience);
            
            //----------End validating experience-----------//
            
            if ($location != '' && $valid_job_loc == '0') {
                $error_msg = "Please select a valid job location.";
            }elseif($key_skills !='' && strpos($key_skills, ",")!==FALSE && isset ($valid_key_skills) && $valid_key_skills == FALSE){
                $error_msg = "Please enter a valid skill.";
            }elseif(isset($expertise) && count($expertise) > 0 && isset ($valid_expertise) && $valid_expertise == false){
                $error_msg = "Please select valid functional expertise.";
            }elseif($salary!='' && !$this->form_validation->float($salary)){
                $error_msg = "Please enter valid salary.";
            }elseif($experience!='' && $valid_experience==false){
                $error_msg = "Please select a valid experience";
            }


            if ($error_msg == "" && $this->input->post('btn_jobsearch')) {
                $query_str="";
                if($keyword!=''){
                $query_str.="keyword=".$keyword;
                }
                
                if($keyword=='' && $location!=''){
                $query_str.="location=".$location;
                }elseif($keyword!='' && $location!=''){
                    $query_str.="&location=".$location;
                }
                
                if($keyword=='' && $location=='' && $key_skills!=''){
                $query_str.="key_skills=".$key_skills;
                }elseif(($keyword!='' || $location!='') && $key_skills!=''){
                    $query_str.="&key_skills=".$key_skills;
                }
                
                if($keyword=='' && $location=='' && $key_skills=='' && is_array($expertise)){
                $query_str="expertise=".implode("|", $expertise);
                }elseif(($keyword!='' || $location!='' || $key_skills!='') && is_array($expertise)){
                    $query_str.="&expertise=".implode("|", $expertise);
                }
                
                if($keyword=='' && $location=='' && $key_skills=='' && is_array($expertise)===false && $salary!=''){
                $query_str="salary=".$salary;
                }elseif(($keyword!='' || $location!='' || $key_skills!='' || is_array($expertise)) && $salary!=''){
                    $query_str.="&salary=".$salary;
                }
                
                if($keyword=='' && $location=='' && $key_skills=='' && is_array($expertise)===false && $salary=='' && $experience!=''){
                $query_str="experience=".$experience;
                }elseif(($keyword!='' || $location!='' || $key_skills!='' || is_array($expertise) || $salary!='') && $experience!=''){
                    $query_str.="&experience=".$experience;
                }
                
                redirect(base_url().'job-search?'.$query_str);
            }

            //-------- starting setting values to the variables ------//
            
                $sess_array = array();
                foreach ($initial_array as $key => $v) {
                    // Collect input value if it is defined...
                    if (isset($$key)) {
                        $sess_array[$key] = $$key;
                    }
                }
                $this->session->set_userdata($sess_array);
                if ($error_msg != "") {
                $this->session->set_userdata('error_msg',$error_msg);
                }
            //-------- end setting values to the variables ------//
        
        //---------- start fetch result from database --------------//
                
        $search_array=array(
                    'JobName'=>$keyword,
                    'JobDescription'=>$keyword,
                    'JobLocation'=>$this->all_function->get_name(TABLE_CITY,'CityName','CityId',$location),
                    'Skill'=>  $key_skill_array,
                    'FunctionalExpertise'=> $expertise,
                    'Salary'=>$salary,
                    'Experience'=>$experience
                );
        
                $qry_result = $this->Job_searchdb->job_search($search_array);

                if ($qry_result->num_rows != 0) {
                    $result_arr = $qry_result->result_array();
                    $search_result=$result_arr;
                    
                }
                else {
                    $search_result='';
                }
        //---------- end fetch result from database --------------//
        
        foreach ($initial_array as $v => $key) {
                if ($this->session->userdata($v)) {

                    $data_msg[$v] = $this->session->userdata($v);
                }
            }
            $this->session->unset_userdata($initial_array);        
                
        $data_msg['search_result']=$search_result;
        
        $this->load->view('job_search/job_search', $data_msg);
    }

    

}
