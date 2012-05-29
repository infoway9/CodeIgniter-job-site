<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model('Profiledb', '', TRUE);
    }

    function professional_profile() {
        $define_page_name = PROFESSIONALPROFILE_PG;
        require_once APPPATH . 'php_include/common_header.php';

        //----------- checking for authentication -------------//
        
        if ($user_id == "0") {
            redirect(base_url() . '?redirect_url=' . urlencode(base_url() . 'professional-profile'));
        }

        //----------- checking for authentication -------------//
        //-------- start for seo --------//

        $data_msg['meta_tag'] = array('MetaTitle' => 'Manage Your Profile',
            'MetaDesc' => 'Manage your profile to get the best jobs in the market',
            'MetaKeyword' => ''
        );

        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//
        //------------- load classes ---------------//

        $this->load->library('form_validation');
        //------------- load classes ---------------//
        //--- start initializing default values for input elements ---//
        $profile_detail_arr = $this->Profiledb->get_user_professional_details($user_id)->result_array();
        
        //--- end initializing default values for input elements ---//
        //--- start initializing an array to handle values and messages during error or success ---//
        $initial_array = array(
            'key_skills' => '',
            'key_skill_array'=>'',
            'functional_expertise' => '',
            'current_location' => '',
            'preferred_location' => '',
            'employment_status' => '',
            'experience' => '',
            'current_salary' => '',
            'expected_salary' => '',
            'current_company' => '',
            'current_designation' => '',
            'about_me' => '',
            'degree' => '',
            'error_msg'=>'',
            'success_msg'=>''
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
         
         //---------------- start for fetching all degree list ---------------//
         $degree_list= $this->all_function->get_alldegree();
         $data_msg['degree_list']=$degree_list;
         //---------------- end for fetching all degree list ---------------//
        
        //-------- show error message -----------------//
        if ($this->session->userdata('error_msg') && $this->session->userdata('error_msg') != null) {
            foreach ($initial_array as $key => $v) {
                // Collect message if it is in session...
                if ($this->session->userdata($key)) {
                    $data_msg[$key] = $this->session->userdata($key);

                    $this->session->unset_userdata(array($key => ''));
                }
            }
        } else {
            $data_msg['key_skill_array'] = unserialize($profile_detail_arr[0]['KeySkill']);
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
            
            
            $data_msg['functional_expertise'] = unserialize($profile_detail_arr[0]['FunctionalExpertise']);
            $data_msg['current_location'] = $this->all_function->get_name(TABLE_CITY,'CityId','CityName',$profile_detail_arr[0]['CurrentLoc']);
            $data_msg['preferred_location'] = $this->all_function->get_name(TABLE_CITY,'CityId','CityName',$profile_detail_arr[0]['PreferredLoc']);
            $data_msg['employment_status'] = $profile_detail_arr[0]['EmpStatus'];
            $data_msg['experience'] = $profile_detail_arr[0]['Experience'];
            $data_msg['current_salary'] = $profile_detail_arr[0]['CurrentSal'];
            $data_msg['expected_salary'] = $profile_detail_arr[0]['ExpectedSal'];
            $data_msg['current_company'] = $profile_detail_arr[0]['CurrentComp'];
            $data_msg['current_designation'] = $profile_detail_arr[0]['Designation'];
            $data_msg['about_me'] = $profile_detail_arr[0]['ResumeDesc'];
            $data_msg['degree'] = $this->all_function->get_name(TABLE_DEGREE,'Id','Degree',$profile_detail_arr[0]['Degree']);
        }
        

        //-------- end show error message -----------------//
        //----------------- start showing the success msg -----------//
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        //----------------- end showing the success msg -----------//
        //-------- start post action, validate errors, store into session, if success store into DB --------//
        if ($this->input->post('btn_editprofile')) {
            //--- start collecting values of input elements ---//
            $degree = trim(strip_tags($this->input->post('degree')));
            $key_skills      =   trim(strip_tags($this->input->post('key_skills'))); 
            $key_skill_array = explode(',', $key_skills,-1);
            $functional_expertise      =   $this->input->post('expertise');
            $current_location      =   trim(strip_tags($this->input->post('current_loc')));
            $preferred_location      =   trim(strip_tags($this->input->post('preferred_loc')));
            $employment_status      =   trim(strip_tags($this->input->post('emp_status')));
            $experience      =   trim(strip_tags($this->input->post('experience')));
            $current_company      =   trim(strip_tags($this->input->post('current_comp')));
            $current_designation      =   trim(strip_tags($this->input->post('designation')));
            $current_salary      =   trim(strip_tags($this->input->post('current_sal')));
            $expected_salary      =   trim(strip_tags($this->input->post('expected_sal')));
            $about_me = trim(strip_tags($this->input->post('resume_desc')));
            $resume_name = $_FILES['resume_name']['name'];
            $resume_size = $_FILES['resume_name']['size'];
            $resume_tmp_name = $_FILES['resume_name']['tmp_name'];
           
            //--- end collecting values of input elements ---//
            //--------------- Validating Degree------------//
            
            if($degree !='')
                $valid_degree = $this->all_function->valid_degree($degree);            
            
            //------------ End Validating Degree------------------//
            
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
            {
                $this->load->model('Userdb', '', TRUE);
                $valid_experience = $this->Profiledb->valid_experience($experience);
            }
            //----------End validating experience-----------//
             
            //--------------- start validating --------------//
            $error_msg = "";
            //-----------------Start validating professional details------------//
            
            if(!$this->form_validation->required($degree)){
                $error_msg = "Please enter degree";
            }elseif($valid_degree == false){
                $error_msg = "Please enter a valid degree";
            }elseif(!$this->form_validation->required($key_skill_array)){
                $error_msg = "Please enter key skills";
            }elseif($valid_key_skills == FALSE){
                $error_msg = "Please enter a valid skill";
            }elseif(!$this->form_validation->required($functional_expertise)){
                $error_msg = "Please add functional expertise";
            }elseif($valid_expertise == FALSE){
                $error_msg = "Please add a valid functional expertise";
            }else if ($this->form_validation->emp_status_chk($employment_status) == FALSE) {
                $error_msg = "Invalid Employment Status";
            }elseif($employment_status == 'E' && !$this->form_validation->required($experience)){
                $error_msg = "Please enter experience";
            }elseif($employment_status == 'E' && $valid_experience == null){
                $error_msg = "Please select a valid experience";
            }elseif($employment_status == 'E' && !$this->form_validation->required($current_company)){
                $error_msg = "Please enter current company";
            }elseif($employment_status == 'E' && !$this->form_validation->required($current_designation)){
                $error_msg = "Please enter current designation";
            }elseif($employment_status == 'E' && !$this->form_validation->required($current_salary)){
                $error_msg = "Please enter current salary";
            }elseif($employment_status == 'E' && !$this->form_validation->float($current_salary)){
                $error_msg = "Please enter valid current salary";
            }elseif($employment_status == 'E' && !$this->form_validation->required($current_location)){
                $error_msg = "Please select current location.";
            }elseif($employment_status == 'E' && $this->all_function->valid_city($current_location)==0){
                $error_msg = "Please select valid current location.";
            }elseif(!$this->form_validation->required($preferred_location)){
                $error_msg = "Please select preferred location.";
            }elseif($employment_status == 'E' && $this->all_function->valid_city($preferred_location)==0){
                $error_msg = "Please select valid preferred location.";
            }elseif(!$this->form_validation->required($expected_salary)){
                $error_msg = "Please enter expected salary";
            }elseif(!$this->form_validation->float($expected_salary)){
                $error_msg = "Please enter valid expected salary";
            }elseif(!$this->form_validation->required($about_me)){
                $error_msg = "Please write something about yourself";
            }elseif(isset($resume_name) && $resume_name != '' && !in_array($this->all_function->get_extension($resume_name), explode(",", UPLOAD_DOCTYPE))){
                $error_msg = "Please enter a valid resume";
            }elseif(is_uploaded_file($_FILES['resume_name']['tmp_name']) && $_FILES['resume_name']['size'] > (1048576 * UPLOAD_RESUME_SIZE)){
                $error_msg = "Please upload a resume smaller than ".UPLOAD_RESUME_SIZE."mb";
            }
            
            //-----------------End validating professional details------------//
          
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
                // Genarate user id
                
                if(isset($resume_name)){
                    $extension = $this->all_function->get_extension($resume_name);
                    $new_resume_name = $user_id.".".$extension;
                }
                // start building DB operation
                if($employment_status == 'E'){
                    $professional_details = array(
                        'KeySkill' => serialize($key_skill_array),
                        'FunctionalExpertise' => serialize($functional_expertise),
                        'CurrentLoc' => $this->all_function->get_name(TABLE_CITY,'CityName','CityId',$current_location),
                        'PreferredLoc' => $this->all_function->get_name(TABLE_CITY,'CityName','CityId',$preferred_location),
                        'EmpStatus' => $employment_status,
                        'Experience' => $experience,
                        'CurrentSal' => $current_salary,
                        'ExpectedSal' => $expected_salary,
                        'CurrentComp' => $current_company,
                        'Designation' => $current_designation,
                        'ResumeDesc' => $about_me,
                        'ResumeName' => $new_resume_name,
                        'Degree' => $this->all_function->get_name(TABLE_DEGREE,'Degree','Id',$degree)
                    );
                
                }else{
                    $professional_details = array(
                        'KeySkill' => serialize($key_skill_array),
                        'FunctionalExpertise' => serialize($functional_expertise),
                        'PreferredLoc' => $this->all_function->get_name(TABLE_CITY,'CityName','CityId',$preferred_location),
                        'EmpStatus' => $employment_status,
                        'Experience' => '0',
                        'ExpectedSal' => $expected_salary,
                        'ResumeDesc' => $about_me,
                        'ResumeName' => $resume_name,
                        'Degree' => $this->all_function->get_name(TABLE_DEGREE,'Degree','Id',$degree)
                    );
                    
                }
                $this->Profiledb->update_user_professional_data($user_id, $professional_details);
                if($resume_tmp_name!='')
                {
                    //unlink file......  
                    if(file_exists(UPLOAD_MEDIA_BASEFOLDER.'showcase/resume/'.$new_resume_name))
                        unlink(UPLOAD_MEDIA_BASEFOLDER.'showcase/resume/'.$new_resume_name);
                    
                    //move uploaded file.........
                    move_uploaded_file($resume_tmp_name,UPLOAD_MEDIA_BASEFOLDER.'showcase/resume/'.$new_resume_name);
                
                    
                }
                // End building DB operation
                $msg_create_account_success = "You have successfully updated your profile.";
                $this->session->set_userdata('success_msg', $msg_create_account_success);
            }
            redirect(base_url() . 'professional-profile');
            exit;
        }

        $this->load->view('profile/professional_profile', $data_msg);
    }
    function personal_profile() {
        $define_page_name = PERSONALPROFILE_PG;
        require_once APPPATH . 'php_include/common_header.php';

        //----------- checking for authentication -------------//

        if ($user_id == "0") {
            redirect(base_url() . '?redirect_url=' . urlencode(base_url() . 'personal-profile'));
        }

        //----------- checking for authentication -------------//
        //-------- start for seo --------//

        $data_msg['meta_tag'] = array('MetaTitle' => 'Manage Your Professional Profile',
            'MetaDesc' => 'Manage your profile to get the best jobs in the market',
            'MetaKeyword' => ''
        );

        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//
        //------------- load classes ---------------//

        $this->load->library('form_validation');
        //------------- load classes ---------------//
        //--- start initializing default values for input elements ---//
        $profile_detail_arr = $this->Profiledb->get_user_details($user_id)->result_array();
        $rec_email = $profile_detail_arr[0]['Email'];
        $rec_fname = $profile_detail_arr[0]['FirstName'];
        $rec_lname = $profile_detail_arr[0]['LastName'];

        //--- end initializing default values for input elements ---//
        //--- start initializing an array to handle values and messages during error or success ---//
        $initial_array = array(
            'fname' => '',
            'lname' => '',
            'gender' => '',
            'country' => '',
            'city' => '',
            'address' => '',
            'postal_code' => '',
            'error_msg' => '',
        );
        //--- end initializing an array to handle values and messages during error or success ---//
        
        //----------------- start populating city list ----------------//
         $city_list= $this->all_function->get_allcity();
         $data_msg['city_list']=$city_list;

        //----------------- end populating city list ----------------//
        
        //-------- show error message -----------------//
        if ($this->session->userdata('error_msg')) {

            foreach ($initial_array as $key => $v) {
                // Collect message if it is in session...
                if ($this->session->userdata($key)) {
                    $data_msg[$key] = $this->session->userdata($key);

                    $this->session->unset_userdata(array($key => ''));
                }
            }
        } else {
            $data_msg['fname'] = $rec_fname;
            $data_msg['lname'] = $rec_lname;
            $data_msg['gender'] = $profile_detail_arr[0]['Gender'];
            $data_msg['address'] = $profile_detail_arr[0]['Address'];
            $data_msg['postal_code'] = $profile_detail_arr[0]['PostalCode'];
            $data_msg['city'] = $this->all_function->get_name(TABLE_CITY,'CityId','CityName',$profile_detail_arr[0]['CityName']);
            $data_msg['country'] = $profile_detail_arr[0]['CountryCode'];
        }

        //-------- end show error message -----------------//
        //----------------- start showing the success msg -----------//
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        //----------------- end showing the success msg -----------//
        //-------- start post action, validate errors, store into session, if success store into DB --------//
        if ($this->input->post('btn_editprofile')) {

            //--- start collecting values of input elements ---//
            $fname = trim(strip_tags($this->input->post('fname')));
            $lname = trim(strip_tags($this->input->post('lname')));
            $gender = trim(strip_tags($this->input->post('gender')));
            $country = $data_msg['country'];//trim(strip_tags($this->input->post('country')));
            $city = trim(strip_tags($this->input->post('city')));
            $postal_code = trim(strip_tags($this->input->post('postal_code')));
            $address = trim(strip_tags($this->input->post('address')));

            //--- end collecting values of input elements ---//
            
            //--------------- start validating --------------//
            $error_msg = "";
            
            //--------- Validating City ----------//			

            if (!empty($city))
                $valid_city = $this->all_function->valid_city($city); 
            //--------- Validating City ----------//	
           
            //--------------- Validating Postal Code------------//
            
            if($postal_code !='')
                $valid_postal_code = $this->all_function->validateUSAZip($postal_code);
            
            
            //------------ End Validating Postal Code------------------//
            
            
            if (!$this->form_validation->required($fname)) {
                $error_msg = "Please enter your first name.";
            } elseif (!$this->form_validation->min_length($fname, 3)) {
                $error_msg = "First name should contain at least 3 characters.";
            } elseif (!$this->form_validation->max_length($fname, 20)) {
                $error_msg = "Please limit your first name within 20 characters.";
            } elseif (!$this->form_validation->required($lname)) {
                $error_msg = "Please enter your last name.";
            } elseif ($lname != "" && !$this->form_validation->min_length($lname, 3)) {
                $error_msg = "Last name should contain at least 3 characters.";
            } elseif ($lname != "" && !$this->form_validation->max_length($lname, 20)) {
                $error_msg = "Please limit your last name within 20 characters.";
            } elseif ($gender!='m' && $gender!='f' || $gender=='') {
                $error_msg = "Please select valid gender.";
            } elseif (!$this->form_validation->required($city)) {
                $error_msg = "Please select country.";
            } elseif ($valid_city==0) {
                $error_msg = "Plaese enter valid city.";
            } elseif (!$this->form_validation->required($postal_code)) {
                $error_msg = "Please enter your potal code.";
            } elseif (!$this->form_validation->alpha_numeric($postal_code) || $valid_postal_code==0) {
                $error_msg = "Please enter a valid postal code.";
            } elseif (!$this->form_validation->required($address)) {
                $error_msg = "Please enter address.";
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
                // start building DB operation
                $user_master_data = array(
                    'FName' => $fname,
                    'LName' => $lname,
                    'Gender' => $gender,
                    'CountryCode' => $country,
                    'CityName' => $this->all_function->get_name(TABLE_CITY,'CityName','CityId',$city),
                    'PostalCode ' => $postal_code,
                    'Address' => $address,
                    'UpdatedDate' => date("Y-m-d H:i:s")
                );

                $this->Profiledb->update_user_data($user_id, $user_master_data);
                $msg_create_account_success = "You have successfully updated your profile.";
                $this->session->set_userdata('success_msg', $msg_create_account_success);
            }


            redirect(base_url() . 'personal-profile');
            exit;
        }

        $this->load->view('profile/personal_profile', $data_msg);
    }
}

?>