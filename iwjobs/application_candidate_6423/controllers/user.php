<?php

session_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Userdb', '', TRUE);
        $this->load->model('Locationdb');
        $this->load->model('All_functiondb');
        $this->load->library('form_validation');        
    }

    public function signup() {     
        
        
        $define_page_name = SIGNUP_PG;
        require_once APPPATH . 'php_include/common_header.php';

        if ($user_id != '0') {
            redirect(base_url());

            exit;
        }

        //-------- start for seo --------//

        $data_msg['meta_tag'] = array ('MetaTitle' => 'Submit Resume Online | Post Your CV & Apply For Best Jobs Now',
            'MetaDesc' => 'Register for free, post your resume online and apply for Sales, IT, marketing, software jobs  through us',
            'MetaKeyword' => 'Candidate registration, apply jobs'
        );
        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//
       
        //------------- load classes ---------------//
        $this->load->library('form_validation');
        //------------- load classes ---------------//
        
        //--- start initializing default values for input elements ---//
        $data_msg['gender'] = 'm';
        $data_msg['country']='USA';
        $data_msg['employment_status']="F";
        $data_msg['terms_of_use'] = '';
        //--- end initializing default values for input elements ---//
        
        //--- start initializing an array to handle values and messages during error or success ---//

        $initial_array = array(
            'fname' => '',
            'lname' => '',
            'user_name' => '',
            'gender' => '',
            'email' => '',
            'country'       =>  '',
            'city'          =>  '',
            'postal_code'   =>  '',
            'address'   =>  '',
            'key_skills' =>  '',
            'key_skill_array'=>'',
            'functional_expertise' =>  '',
            'current_location' =>  '',
            'preferred_location' =>  '',
            'employment_status' =>  '',
            'experience' =>  '',
            'current_company' =>  '',
            'current_designation' =>  '',
            'current_salary' =>  '',
            'expected_salary' =>  '',
            'about_me' =>  '',
            'degree' =>'',
            'terms_of_use' => '',
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
         
         //---------------- start for fetching all degree list ---------------//
         $degree_list= $this->all_function->get_alldegree();
         $data_msg['degree_list']=$degree_list;
         //---------------- end for fetching all degree list ---------------//
         
        //----------------- start showing the error msg and given values -----------//
        if ($this->session->userdata('error_msg')) {

            foreach ($initial_array as $key => $v) {
                // Collect message if it is in session...
                if ($this->session->userdata($key)) {
                    $data_msg[$key] = $this->session->userdata($key);

                    $this->session->unset_userdata(array($key => ''));
                }
            }

            //print_r($data_msg);
        }

        //----------------- end showing the error msg and given values -----------//
        //----------------- start showing the success msg -----------//
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        //----------------- end showing the success msg -----------//
        //-------- start post action, validate errors, store into session, if success store into DB --------//
        if ($this->input->post('btn_signup')) {

            //--- start collecting values of input elements ---//
            
            //---------Start collecting inputs from Personal Details-----------------//
            
            $fname = trim(strip_tags($this->input->post('fname')));
            $lname = trim(strip_tags($this->input->post('lname')));
            $gender = trim(strip_tags($this->input->post('gender')));
            $user_name = trim(strip_tags($this->input->post('user_name')));
            $email = trim(strip_tags($this->input->post('email')));
            $password = trim(strip_tags($this->input->post('password')));
            $reenter_password = trim(strip_tags($this->input->post('reenter_password')));
            $country          =   "USA";
            $city             =   trim(strip_tags($this->input->post('city')));
            $postal_code      =   trim(strip_tags($this->input->post('postal_code')));
            $address      =   trim(strip_tags($this->input->post('address')));            
            
            //---------End collecting inputs from personal details------//
            
            //---------Start collecting inputs from professional Details-----------------//
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
            //echo "<pre>";
            //print_r($functional_expertise);exit;
            
            //---------Start collecting inputs from professional Details-----------------//
            
            //---------Start collecting general inputs------------//
            
            $terms_of_use = trim(strip_tags($this->input->post('terms_of_use')));
            $captcha          =   trim(strip_tags($this->input->post('captcha')));
            
            //---------End collecting general inputs------------//
            //
            //--- end collecting values of input elements ---//
            
            //--------------- start validating --------------//
            
            //--------- check if same email already exists -----------//
            if ($email != "") {

                $email_exist_num = $this->Userdb->email_exist($email);
            }
            //--------- end checking if same email already exists -----------//
            
            //--------- check if same username already exists -----------//
            if ($user_name != "") {

                $username_exist_num = $this->Userdb->username_exist($user_name);
            }
            //--------- end checking if same username already exists -----------//
            //--------- Validating City ----------//			

            if (!empty($city))
                $valid_city = $this->all_function->valid_city($city); 
           
            //--------------- Validating Postal Code------------//
            
            if($postal_code !='')
                $valid_postal_code = $this->all_function->validateUSAZip($postal_code);
            
            
            //------------ End Validating Postal Code------------------//
            
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
             //echo $this->db->last_query();
            //----------Start validating experience-----------//
            
            if(!empty($experience))
                $valid_experience = $this->Userdb->valid_experience($experience);
            
            //----------End validating experience-----------//
            
            //----------Start validating resume--------------//
            //----------End validating resume------------//
            
            $error_msg = "";
            
            //-----------------Start validating personal details------------//
            
            if (!$this->form_validation->required($fname)) {
                $error_msg = "Please enter your first name.";
            } 
            elseif (!$this->form_validation->min_length($fname, 3)) {
                $error_msg = "First name should contain at least 3 characters.";
            } 
            elseif (!$this->form_validation->max_length($fname, 20)) {
                $error_msg = "Please limit your first name within 20 characters.";
            }
            elseif (!$this->form_validation->required($lname)) {
                $error_msg = "Please enter your last name.";
            }
            elseif ($lname != "" && !$this->form_validation->min_length($lname, 3)) {
                $error_msg = "Last name should contain at least 3 characters.";
            }
            elseif ($lname != "" && !$this->form_validation->max_length($lname, 20)) {
                $error_msg = "Please limit your last name within 20 characters.";
            }
            else if ($this->form_validation->gender_chk($gender) == FALSE) {
                $error_msg = "Invalid Gender input";
            }
            elseif (!$this->form_validation->required($email)) {
                $error_msg = "Please enter email.";
            } 
            elseif (!$this->form_validation->valid_email($email)) {
                $error_msg = "Please enter valid email.";
            }
            elseif ($email_exist_num > 0) {
                $error_msg = "This email already exist.";
            }
            elseif (!$this->form_validation->required($user_name)) {
                $error_msg = "Please enter username.";
            } 
            elseif (!$this->form_validation->min_length($user_name, 6)) {
                $error_msg = "Username should be at least 6 characters.";
            }
            elseif (!$this->form_validation->max_length($user_name, 20)) {
                $error_msg = "Please limit your username within 20 characters.";
            }
            elseif (!$this->form_validation->alpha_numeric($user_name)) {
                $error_msg = "Username must be alpha-numeric. Other characters are disallowed.";
            }
            elseif ($username_exist_num > 0) {
                $error_msg = "Username already exist.";
            }
            elseif (!$this->form_validation->required($password)) {
                $error_msg = "Please enter password";
            }
            elseif (!$this->form_validation->min_length($password, 6)) {
                $error_msg = "Password is too weak. It should contain at least 6 characters.";
            }
            elseif (!$this->form_validation->max_length($password, 20)) {
                $error_msg = "Please limit your password within 20 characters.";
            } 
            elseif (!$this->form_validation->required($reenter_password)) {
                $error_msg = "Please confirm your password.";
            }
            elseif ($reenter_password != $password) {
                $error_msg = "Passwords seem to mismatch.";
            }
            elseif(  ! $this->form_validation->required($city)) {
                $error_msg = "Please enter city.";
            }
            else if ($city != '' && $valid_city == '0') {
                $error_msg = "Please enter a valid city";
            }
            elseif(  ! $this->form_validation->required($postal_code)) {
                $error_msg = "Please enter your potal code.";
            }
            elseif( $valid_postal_code == FALSE) {
                $error_msg = "Please enter a valid postal code.";
            } 
            elseif(!$this->form_validation->required($address)){
                $error_msg = "Please enter address";
            }
            
            //-----------------End validating personal details------------//
            
            //-----------------Start validating professional details------------//
            
            elseif(!$this->form_validation->required($degree)){
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
            }elseif($resume_name == ''){
                $error_msg = "Please enter your resume";
            }elseif(isset($resume_name) && $resume_name != '' && !in_array($this->all_function->get_extension($resume_name), explode(",", UPLOAD_DOCTYPE))){
                $error_msg = "Please enter a valid resume";
            }elseif(is_uploaded_file($_FILES['resume_name']['tmp_name']) && $_FILES['resume_name']['size'] > (1048576 * UPLOAD_RESUME_SIZE)){
                $error_msg = "Please upload a resume smaller than ".UPLOAD_RESUME_SIZE."mb";
            }
            
            //-----------------End validating professional details------------//
            
            elseif ( ! $this->form_validation->required($captcha)) {
                $error_msg = "Please enter the verification code.";
            }
            elseif ( empty($_SESSION['captcha']) || trim(strtolower($captcha)) != $_SESSION['captcha']) {
                $error_msg = "Invalid verification code. Please try again.";
            }  
            elseif (!$this->form_validation->required($terms_of_use)) {
                $error_msg = "Please agree to our terms of usage.";
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
                // Genarate user id
                $user_id = $this->all_function->rand_string(6);
                if(isset($resume_name)){
                    $extension = $this->all_function->get_extension($resume_name);
                    $new_resume_name = $user_id.".".$extension;
                }
                // start building DB operation
                $user_master_data = array(
                    'UserId' => $user_id,
                    'UserName' => $user_name,
                    'Password' => md5($password),
                    'Email' => $email,
                    'FName' => $fname,
                    'LName' => $lname,
                    'Gender' => $gender,
                    'CountryCode' => $country,
                    'CityName'=>$this->all_function->get_name(TABLE_CITY,'CityName','CityId',$city),
                    'PostalCode' => $postal_code,
                    'Address'=>$address,
                    'Ip' => $_SERVER['REMOTE_ADDR'],
                    'JoinDate' => date("Y-m-d H:i:s"),
                    'Status' => '1'
                );
                if($employment_status == 'E'){
                    $professional_details = array(
                        'Id' => $this->all_function->rand_string(6),
                        'UserId' => $user_id,
                        'KeySkill' => serialize($this->Userdb->get_names(TABLE_KEY_SKILLS,'SkillName','SkillName',$key_skill_array)),
                        'FunctionalExpertise' => serialize($this->Userdb->get_names(TABLE_EXPERTISE_AREA,'Name','Id',$functional_expertise)),
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
                
                }
                else{
                    $professional_details = array(
                        'Id' => $this->all_function->rand_string(6),
                        'UserId' => $user_id,
                        'KeySkill' => serialize($this->Userdb->get_names(TABLE_KEY_SKILLS,'SkillName','SkillName',$key_skill_array)),
                        'FunctionalExpertise' => serialize($this->Userdb->get_names(TABLE_EXPERTISE_AREA,'Name','Id',$functional_expertise)),
                        'PreferredLoc' => $this->all_function->get_name(TABLE_CITY,'CityName','CityId',$preferred_location),
                        'EmpStatus' => $employment_status,
                        'Experience' => '0',
                        'ExpectedSal' => $expected_salary,
                        'ResumeDesc' => $about_me,
                        'ResumeName' => $resume_name,
                        'Degree' => $this->all_function->get_name(TABLE_DEGREE,'Degree','Id',$degree)
                    );
                    
                }

                $this->Userdb->insert_user_data($user_master_data);
                $this->Userdb->insert_prof_data($professional_details);
                if($resume_tmp_name!='')
                {
                    //unlink file......  
                    if(file_exists(UPLOAD_MEDIA_BASEFOLDER.'showcase/resume/'.$new_resume_name))
                        unlink(UPLOAD_MEDIA_BASEFOLDER.'showcase/resume/'.$new_resume_name);
                    
                    //move uploaded file.........
                    move_uploaded_file($resume_tmp_name,UPLOAD_MEDIA_BASEFOLDER.'showcase/resume/'.$new_resume_name);
                
                    
                }
                // End building DB operation
                // Build mail configuration...
                $support_email = SUPPORT_EMAIL;
                $support_name = SUPPORT_NAME;


                // Extract email template...
                $email_content = file_get_contents(base_url() . 'upload_media/email_templates/email_template.html');

                $email_content = str_replace("###image_folder###", base_url() . 'image/mail_images', $email_content);
                $email_content = str_replace("###user_name###",  'Hi ' . $user_name, $email_content);//$data_msg['m_hi'] .
                $email_content = str_replace("###footer_text###", '&copy; ' . date("Y") . " " ."all rights reserved ." , $email_content);//$this->all_function->get_heading('h_footer')


                //--- start for constructing subject and message of email to user ---//
                $result_array = $this->all_function->fetch_email_content('candidate_signup');
                $subject = $result_array['Subject'];
                $email_msg = $result_array['Body'];
                //--- end  for constructing subject and message of email to user ---//
                // start replacing essential links and texts...
                $email_msg = str_replace("{BASE_URL}", base_url(), $email_msg);
                $email_msg = str_replace("{ACCOUNT_USERNAME}", $user_name, $email_msg);
                $email_msg = str_replace("{ACCOUNT_PASSWORD}", $password, $email_msg);
                $email_msg = str_replace("{ACCOUNT_ACTIVATION_LINK}", '<a href="' . base_url() . 'activate-account?id=' . $user_id . '" style="color:#025F79;">Click here to proceed</a>.', $email_msg);
                $email_msg = str_replace("{SITEMGR_EMAIL}", $support_email, $email_msg);
                $email_content = str_replace("###email_message###", $email_msg, $email_content);


                //---------------- start shooting email -----------------------------//
                $this->load->library('Send_email');
                $this->send_email->shoot_email($support_name, $support_email, $email, $subject, $email_content);
                //------------------ end for shooting email ---------------------------//


                $msg_create_account_success = "Please check the activation email to activate your account.";
                $this->session->set_userdata('success_msg', $msg_create_account_success);
            }


            redirect(base_url() . 'signup');
            exit;
        }

        $this->load->view('user/signup', $data_msg);
    }

    public function activate_user_account() {
        // if user_id param is not fetched by get method, redirect to writeIO home....

        if (!$this->input->get('id')) {
            redirect(base_url());

            exit;
        }

        // if user is already logged in, redirect to writeIO home....
        require_once APPPATH . 'php_include/authenticate.php';

        if ($user_id != '0') {
            redirect(base_url());

            exit;
        }


        //--- start getting user details (status) corresponding to the id ---//



        $id = trim(strip_tags($this->input->get('id')));

        $get_value = $this->Userdb->get_user_status($id);

        // Redirect to writeIO home page if user id is in-valid...
        if ($get_value->num_rows == 0) {

            redirect(base_url());

            exit;
        }
        // Else fetch the status and render messages / action accordingly as defined below...
        else {

            $get_result = $get_value->result_array();

            $user_status = $get_result[0]['Status'];


            //Account is already active...
            if ($user_status == '1') {
                $message = "Your account is already active.";

                $this->session->set_userdata('error_msg', $message);
            }
            else {

                $message = "Your account has been successfully activated.";

                $this->session->set_userdata('success_msg', $message);

                $this->Userdb->activate_useraccount($id);
            }

             redirect(base_url());
            //redirect(base_url() . '#signin');

            exit;
        }

        //--- end getting user details (status) corresponding to the id ---//
    }

    public function signout() {
        require_once APPPATH . 'php_include/authenticate.php';

        if ($user_id != '0') {
            $this->session->unset_userdata(array('job_user_id' => '', 'job_user_name' => ''));

            if (isset($_COOKIE['job_autologin'])) {
                delete_cookie('job_autologin');
            }
        }

        redirect(base_url());
        exit;
    }

    public function autologin() {

        $auto_login = $this->input->get('auto_login');


        if ($auto_login != "") {
            $redirect_pg = urldecode($auto_login);
        } else {
            $redirect_pg = base_url();
        }



        $get_autolog = $this->encrypt->decode(get_cookie('job_autologin'));
        $get_autolog = explode('~####~', $get_autolog);

        $auto_username = $get_autolog[0];
        $auto_password = $get_autolog[1];


        $get_userinformation = $this->Userdb->matchuser($auto_username, $auto_password);



        if ($get_userinformation->num_rows == 0) {
            if (isset($_COOKIE['autologin'])) {
                delete_cookie('autologin');
            }
        } else {
            $user_information = $get_userinformation->result_array();
            $user_id = $user_information[0]['UserId'];
            $user_name = $user_information[0]['UserName'];

            $this->session->set_userdata(array('job_user_id' => $user_id, 'job_user_name' => $user_name));

            $db_insert = array(
                'UserId' => $user_id,
                'LogDate' => date('Y-m-d H:i:s'),
                'Ip' => $_SERVER['REMOTE_ADDR']
            );

            $this->Userdb->insert_user_login($db_insert);

            header('location: ' . $redirect_pg);
        }
    }

    public function forgot_password() {
        $define_page_name = FORGOTPASSWORD_PG;

        //--- start common header inclusion ---//
        require_once APPPATH . 'php_include/common_header.php';
        //--- end common header inclusion ---//
        //----------- start for checking sign in ---------//
        if ($user_id != '0') {
            redirect(base_url());
        }
        //----------- end for checking sign in ---------//
        //--- start fetching meta tag data ---//
        $data_msg['meta_tag'] = array ('MetaTitle' => 'Forgot Password',
            'MetaDesc' => 'Password recovery assistance',
            'MetaKeyword' => 'Recover password'
        );
        //--- end fetching meta tag data ---//
        //------------- load classes ---------------//

        $this->load->library('form_validation');
        //------------- load classes ---------------//
        //--- start initializing an array to handle values and messages during error or success ---//
        $initial_array = array(
            'email' => '',
            'error_msg' => '',
            'success_msg' => '',
        );

        //--- end initializing an array to handle values and messages during error or success ---//
        //------------ start for error and success message --------------//
        if ($this->session->userdata('error_msg') != "") {

            foreach ($initial_array as $v => $key) {
                if ($this->session->userdata($v)) {

                    $data_msg[$v] = $this->session->userdata($v);
                }
            }

            $this->session->unset_userdata($initial_array);
        }


        if ($this->session->userdata('success_msg') != "") {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        //------------ start for error and success message --------------//




        if ($this->input->post('btn_forgot_pswd')) {

            //--- start collecting values of input elements ---//
            $email = trim(strip_tags($this->input->post('email')));
            $captcha = trim(strip_tags($this->input->post('captcha')));

            //--- end collecting values of input elements ---//


            if ($email != "") {
                $email_exist_num = $this->Userdb->email_exist($email);
            }

            //---- start validating errors ----//
            if (!$this->form_validation->required($email)) {
                $error_msg = "Please enter your email.";
            } elseif (!$this->form_validation->valid_email($email)) {
                $error_msg = "Please enter a valid email.";
            } elseif (isset($email_exist_num) && $email_exist_num == 0) {
                $error_msg = "This email does not exist.";
            } elseif (!$this->form_validation->required($captcha)) {
                $error_msg = "Please enter the verification code.";
            } elseif (empty($_SESSION['captcha']) || trim(strtolower($captcha)) != $_SESSION['captcha']) {
                $error_msg = "Please enter valid verification code.";
            }
            //---- end validating errors ----//
            //--- set error message into session if @error_msg is defined ---//
            if (isset($error_msg)) {
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
                // genarate forgot_password_id
                $id = $this->all_function->rand_string(6);


                //---- start inserting forgot password request to DB -----//
                $get_result = $this->Userdb->user_information_by_email($email)->result_array();

                $user_id = $get_result[0]['UserId'];
                //$user_name=$get_result[0]['UserName'];
                $user_name = $get_result[0]['Name'];

                $data = array(
                    'Id' => $id,
                    'UserId' => $user_id,
                    'Ip' => getenv('REMOTE_ADDR'),
                    'ForgotDate' => date("Y-m-d H:i:s"),
                    'Status' => '0'
                );


                $this->Userdb->add_password_request($data);
                //---- end inserting forgot password request to DB -----//
                // Build mail configuration...
                $support_email = SUPPORT_EMAIL;
                $support_name = SUPPORT_NAME;


                // Extract email template...
                $email_content = file_get_contents(base_url() . 'upload_media/email_templates/email_template.html');

                $email_content = str_replace("###image_folder###", base_url() . 'image/mail_images', $email_content);
                $email_content = str_replace("###user_name###", 'Hi ' . $user_name, $email_content);
                $email_content = str_replace("###footer_text###", '&copy; ' . date("Y") . " all rights reserved.", $email_content);



                //--- start for constructing subject and message of email to user ---//
                $result_array = $this->all_function->fetch_email_content('forgot_password');
                $subject = $result_array['Subject'];
                $email_msg = $result_array['Body'];
                //--- end  for constructing subject and message of email to user ---//
                // start replacing essential links and texts...
                $email_msg = str_replace("{RESET_PASSWORD_LINK}", '<a href="' . base_url() . 'reset-password?id=' . $id . '" style="color:#025F79;">Click here to proceed</a>.', $email_msg);
                $email_msg = str_replace("{SITEMGR_EMAIL}", $support_email, $email_msg);
                $email_content = str_replace("###email_message###", $email_msg, $email_content);


                //---------------- start  for shooting email -----------------------------//
                $this->load->library('Send_email');
                $this->send_email->shoot_email($support_name, $support_email, $email, $subject, $email_content);
                //------------------ end for shooting email ---------------------------//


                $msg_forgot_password_requested = "Please check your email and click on the link to reset your password.";

                $this->session->set_userdata('success_msg', $msg_forgot_password_requested);
            }

            redirect(base_url() . 'forgot-password');
            exit;
        }


        //--- start loading the view ---//
        $this->load->view('user/forgot_password', $data_msg);
        //--- end loading the view ---//
    }

    public function reset_password() {
        $define_page_name = RESETPASSWORD_PG;

        if (!$this->input->get('id')) {
            redirect(base_url());
        }

        //--- start common header inclusion ---//
        require_once APPPATH . 'php_include/common_header.php';
        //--- end common header inclusion ---//
        //----------- start for checking sign in ---------//
        if ($user_id != '0') {
            redirect(base_url());
        }
        //----------- end for checking sign in ---------//
        //--- start getting details (status) corresponding to the id ---//
        $id = $this->input->get('id');
        $get_result = $this->Userdb->get_forgotpassword_detail($id);

        // Redirect to home page if user id is in-valid...
        if ($get_result->num_rows == 0) {
            redirect(base_url());
            exit;
        } else {

            $details_arr = $get_result->result_array();
            $user_id = $details_arr[0]['UserId'];
        }
        //--- end getting details (status) corresponding to the id ---//
        //--- start loading libraries and classes ---//
        $this->load->library(array('form_validation'));

        //--- end loading libraries and classes ---//
        //--- start fetching meta tag data ---//
        $data_msg['meta_tag'] = array ('MetaTitle' => 'Reset Password',
            'MetaDesc' => 'Reset your password',
            'MetaKeyword' => ''
        );
        //--- end fetching meta tag data ---//
        //--- start initializing an array to handle values and messages during error or success ---//
        $initial_array = array(
            'error_msg' => '',
            'success_msg' => ''
        );
        //--- end initializing an array to handle values and messages during error or success ---//
        //----------------- start showing the error msg and given values -----------//
        if ($this->session->userdata('error_msg')) {
            $data_msg['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata(array('error_msg' => ''));
        }

        //----------------- end showing the error msg and given values -----------//
        //----------------- start showing the success msg -----------//
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        //----------------- end showing the success msg -----------//



        if ($this->input->post('btn_reset_pswd')) {

            //--- start collecting values of input elements ---//
            $new_password = trim(strip_tags($this->input->post('new_password')));
            $password_confirmation = trim(strip_tags($this->input->post('password_confirmation')));

            //--- end collecting values of input elements ---//
            //--- start validating errors ---//
            if (!$this->form_validation->required($new_password)) {
                $error_msg = "Please enter the new password.";
            } elseif (!$this->form_validation->min_length($new_password, 6)) {
                $error_msg = "Password is too weak. It should contain at least 6 characters.";
            } elseif (!$this->form_validation->max_length($new_password, 20)) {
                $error_msg = 'Please limit your password within 20 characters.';
            } elseif (!$this->form_validation->required($password_confirmation)) {
                $error_msg = 'Please confirm your password.';
            } elseif ($password_confirmation != $new_password) {
                $error_msg = 'There seems to be a password mismatch';
            }
            //--- end validating errors ---//
            //--- set error message into session if @error_msg is defined ---//
            if (isset($error_msg)) {

                $this->session->set_userdata('error_msg', $error_msg);

                redirect(base_url() . 'reset-password?id=' . $id);
                exit;
            }

            //--- else set DB operations on success, corresponding success message ---//
            else {

                //---- start changing password in database ----//
                // Change password .....

                $usermaster_data = array(
                    'Password' => md5($password_confirmation),
                    'UpdatedDate' => date("Y-m-d H:i:s")
                );

                $this->load->model('Personal_profiledb');
                $this->Personal_profiledb->update_user_data($user_id, $usermaster_data);

                // Update date for password reset....

                $forgotpswd_data = array(
                    'Status' => '1',
                    'UpdateDate' => date("Y-m-d H:i:s")
                );

                $this->Userdb->update_forgotpassword($id, $forgotpswd_data);

                //---- end changing password in database ----//
                // on change of password , unset the autologin feature ....
                if (isset($_COOKIE['autologin'])) {
                    delete_cookie('autologin');
                }


                $msg_password_changed = "Your new password has been saved. Please login to continue.";
                $this->session->set_userdata('success_msg', $msg_password_changed);

                redirect(base_url() . '#signin');
                exit;
            }
        }
        //--- end post action ---//
        //--- start loading the view ---//
        $this->load->view('user/reset_password', $data_msg);
        //--- end loading the view ---//
    }

}