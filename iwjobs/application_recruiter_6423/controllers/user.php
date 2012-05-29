<?php

session_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Userdb', '', TRUE);
        $this->load->library('form_validation');        
    }

    public function signup() {     
        
        
        $define_page_name = SIGNUP_PG;
        require_once APPPATH . 'php_include/common_header.php';

        if ($recruiter_id != '0') {
            redirect(base_url());

            exit;
        }

        //-------- start for seo --------//

        $data_msg['meta_tag'] = array ('MetaTitle' => 'Submit Online Jobs| Post Your Jobs & search Best candidates Now',
            'MetaDesc' => 'Register for free, post your jobs online and search for stuidents, candidates, exprienced, enggneers  through us',
            'MetaKeyword' => 'Recruiter registration, search candidates'
        );
        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//
       
        //------------- load classes ---------------//
        $this->load->library('form_validation');
        //------------- load classes ---------------//
        
        //--- start initializing default values for input elements ---//
        $data_msg['country']='USA';
        $data_msg['terms_of_use'] = '';
        //--- end initializing default values for input elements ---//
        
        //--- start initializing an array to handle values and messages during error or success ---//

        $initial_array = array(
            'user_name' => '',
            'email' => '',
            'country'       =>  '',
            'city'          =>  '',
            'postal_code'   =>  '',
            'address'   =>  '',
            'organization' =>  '',
            'company_logo'=>'',
            'company_link' =>  '',
            'terms_of_use' => '',
            'error_msg' => ''            
        );

        //--- end initializing an array to handle values and messages during error or success ---//
        
        //----------------- start populating city list ----------------//
         $city_list= $this->all_function->get_allcity();
         $data_msg['city_list']=$city_list;

        //----------------- end populating city list ----------------//
        
        
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
        if ($this->input->post('btn_signup')) {

            //--- start collecting values of input elements ---//
            
            //---------Start collecting inputs from Recruiter Details-----------------//
            
            $user_name = trim(strip_tags($this->input->post('user_name')));
            $email = trim(strip_tags($this->input->post('email')));
            $password = trim(strip_tags($this->input->post('password')));
            $reenter_password = trim(strip_tags($this->input->post('reenter_password')));
            
            //---------End collecting inputs from Recruiter details------//
            
            //---------Start collecting inputs from professional Details-----------------//
            $country          =   "USA";
            $city             =   trim(strip_tags($this->input->post('city')));
            $postal_code      =   trim(strip_tags($this->input->post('postal_code')));
            $address      =   trim(strip_tags($this->input->post('address')));
            $organization = trim(strip_tags($this->input->post('organization')));
            $company_link      =   trim(strip_tags($this->input->post('company_link'))); 
            $company_logo = $_FILES['company_logo']['name'];
            $company_logo_size = $_FILES['company_logo']['size'];
            $company_logo_tmp_name = $_FILES['company_logo']['tmp_name'];
            
            //---------Start collecting inputs from professional Details-----------------//
            
            //---------Start collecting general inputs------------//
            
            $terms_of_use = trim(strip_tags($this->input->post('terms_of_use')));
            $captcha          =   trim(strip_tags($this->input->post('captcha')));
            
            //---------End collecting general inputs------------//
            
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
            
           //------------- start get image dimention --------------//
            list($width, $height, $type, $attr) = getimagesize($company_logo_tmp_name);
           //------------- end get image dimention -----------------//
            $error_msg = "";
            
            //-----------------Start validating details------------//
            
            if (!$this->form_validation->required($email)) {
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
            
            
            //-----------------End validating personal details------------//
            
            //-----------------Start validating company details------------//
            
            elseif(!$this->form_validation->required($organization)){
                $error_msg = "Please enter organization.";
            }elseif($company_logo == ''){
                $error_msg = "Please select company logo.";
            }elseif(isset($company_logo) && $company_logo != '' && !in_array($this->all_function->get_extension($company_logo), explode(",", UPLOAD_LOGO_TYPE))){
                $error_msg = "Please enter a valid logo";
            }elseif(is_uploaded_file($_FILES['company_logo']['tmp_name']) && $_FILES['company_logo']['size'] > (1048576 * UPLOAD_LOGO_SIZE)){
                $error_msg = "Please upload a logo smaller than ".UPLOAD_LOGO_SIZE."mb";
            }elseif($width!=70 || $height!=44){
                $error_msg = "Please upload a logo of 70*44 dimention.";
            }elseif(!$this->form_validation->required($company_link)){
                $error_msg = "Please enter company link.";
            }elseif(!$this->form_validation->validateUrlWithoutHttp($company_link)){
                $error_msg = "Please enter valid company link.";
            }elseif(  ! $this->form_validation->required($city)) {
                $error_msg = "Please enter city.";
            }else if ($city != '' && $valid_city == '0') {
                $error_msg = "Please enter a valid city";
            }elseif(  ! $this->form_validation->required($postal_code)) {
                $error_msg = "Please enter your potal code.";
            }elseif( $valid_postal_code == FALSE) {
                $error_msg = "Please enter a valid postal code.";
            }elseif(!$this->form_validation->required($address)){
                $error_msg = "Please enter address";
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
                $recruiter_id = $this->all_function->rand_string(6);
                if(isset($company_logo)){
                    $extension = $this->all_function->get_extension($company_logo);
                    $new_company_logo_name = $recruiter_id.".".$extension;
                }
                // start building DB operation
                $recruiter_master_data = array(
                    'RecruiterId' => $recruiter_id,
                    'UserName' => $user_name,
                    'Password' => md5($password),
                    'Email' => $email,
                    'Organization' => $organization,
                    'Country' => $country,
                    'CityName'=>$this->all_function->get_name(TABLE_CITY,'CityName','CityId',$city),
                    'PostalCode' => $postal_code,
                    'Address'=>$address,
                    'CompanyLogo'=>$new_company_logo_name,
                    'CompanyLink'=>$company_link,
                    'AddedDate' => date("Y-m-d H:i:s"),
                    'Status' => '1'
                );
                
                $this->Userdb->insert_recruiter_data($recruiter_master_data);
                if($company_logo_tmp_name!='')
                {
                    //unlink file......  
                    if(file_exists(UPLOAD_MEDIA_BASEFOLDER.'showcase/company_logo/'.$new_company_logo_name))
                        unlink(UPLOAD_MEDIA_BASEFOLDER.'showcase/company_logo/'.$new_company_logo_name);
                    
                    //move uploaded file.........
                    move_uploaded_file($company_logo_tmp_name,UPLOAD_MEDIA_BASEFOLDER.'showcase/company_logo/'.$new_company_logo_name);
                
                    
                }
                // End building DB operation
                // Build mail configuration...
                $support_email = SUPPORT_EMAIL;
                $support_name = SUPPORT_NAME;


                // Extract email template...
                $email_content = file_get_contents(base_url() . '../upload_media/email_templates/email_template.html');

                $email_content = str_replace("###image_folder###", base_url() . '../image/mail_images', $email_content);
                $email_content = str_replace("###user_name###",  'Hi ' . $user_name, $email_content);//$data_msg['m_hi'] .
                $email_content = str_replace("###footer_text###", '&copy; ' . date("Y") . " " ."all rights reserved ." , $email_content);//$this->all_function->get_heading('h_footer')


                //--- start for constructing subject and message of email to user ---//
                $result_array = $this->all_function->fetch_email_content('recruiter_signup');
                $subject = $result_array['Subject'];
                $email_msg = $result_array['Body'];
                //--- end  for constructing subject and message of email to user ---//
                // start replacing essential links and texts...
                $email_msg = str_replace("{BASE_URL}", base_url(), $email_msg);
                $email_msg = str_replace("{ACCOUNT_USERNAME}", $user_name, $email_msg);
                $email_msg = str_replace("{ACCOUNT_PASSWORD}", $password, $email_msg);
                $email_msg = str_replace("{ACCOUNT_ACTIVATION_LINK}", '<a href="' . base_url() . 'activate-account?id=' . $recruiter_id . '" style="color:#025F79;">Click here to proceed</a>.', $email_msg);
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

        if ($recruiter_id != '0') {
            redirect(base_url());

            exit;
        }


        //--- start getting user details (status) corresponding to the id ---//



        $id = trim(strip_tags($this->input->get('id')));

        $get_value = $this->Userdb->get_recruiter_status($id);

        // Redirect to writeIO home page if user id is in-valid...
        if ($get_value->num_rows == 0) {

            redirect(base_url());

            exit;
        }
        // Else fetch the status and render messages / action accordingly as defined below...
        else {

            $get_result = $get_value->result_array();

            $recruiter_status = $get_result[0]['Status'];


            //Account is already active...
            if ($recruiter_status == '1') {
                $message = "Your account is already active.";

                $this->session->set_userdata('error_msg', $message);
            }
            else {

                $message = "Your account has been successfully activated.";

                $this->session->set_userdata('success_msg', $message);

                $this->Userdb->activate_recruiter_account($id);
            }

             redirect(base_url());
            exit;
        }

        //--- end getting user details (status) corresponding to the id ---//
    }

    public function signout() {
        require_once APPPATH . 'php_include/authenticate.php';

        if ($recruiter_id != '0') {
            $this->session->unset_userdata(array('job_recruiter_id' => '', 'job_recruiter_name' => ''));

            if (isset($_COOKIE['job_autologin_recruiter'])) {
                delete_cookie('job_autologin_recruiter');
            }
        }

        redirect(base_url());
        exit;
    }

    public function autologin() {

        $auto_login = $this->input->get('auto_login_recruiter');
        if ($auto_login != "") {
            $redirect_pg = urldecode($auto_login);
        } else {
            $redirect_pg = base_url();
        }
        $get_autolog = $this->encrypt->decode(get_cookie('job_autologin_recruiter'));
        $get_autolog = explode('~####~', $get_autolog);

        $auto_username = $get_autolog[0];
        $auto_password = $get_autolog[1];


        $get_recruiter_information = $this->Userdb->matchrecruiter($auto_username, $auto_password);



        if ($get_recruiter_information->num_rows == 0) {
            if (isset($_COOKIE['autologin_recruiter'])) {
                delete_cookie('autologin_recruiter');
            }
        } else {
            $recruiter_information = $get_recruiter_information->result_array();
            $recruiter_id = $recruiter_information[0]['RecruiterId'];
            $recruiter_name = $recruiter_information[0]['UserName'];

            $this->session->set_userdata(array('job_recruiter_id' => $recruiter_id, 'job_recruiter_name' => $recruiter_name));

            $db_insert = array(
                'UserId' => $recruiter_id,
                'LogDate' => date('Y-m-d H:i:s'),
                'Ip' => $_SERVER['REMOTE_ADDR']
            );

            $this->Userdb->insert_recuiter_login($db_insert);

            header('location: ' . $redirect_pg);
        }
    }

    public function forgot_password() {
        $define_page_name = FORGOTPASSWORD_PG;

        //--- start common header inclusion ---//
        require_once APPPATH . 'php_include/common_header.php';
        //--- end common header inclusion ---//
        //----------- start for checking sign in ---------//
        if ($recruiter_id != '0') {
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
                $get_result = $this->Userdb->recruiter_information_by_email($email)->result_array();

                $recruiter_id = $get_result[0]['RecruiterId'];
                $user_name = $get_result[0]['UserName'];

                $data = array(
                    'Id' => $id,
                    'UserId' => $recruiter_id,
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
                $email_content = file_get_contents(base_url() . '../upload_media/email_templates/email_template.html');

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
        if ($recruiter_id != '0') {
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

                $recruitermaster_data = array(
                    'Password' => md5($password_confirmation),
                    'LastUpdatedDate' => date("Y-m-d H:i:s")
                );

                $this->Userdb->update_recruiter_data($recruiter_id, $recruitermaster_data);

                // Update date for password reset....

                $forgotpswd_data = array(
                    'Status' => '1',
                    'UpdateDate' => date("Y-m-d H:i:s")
                );

                $this->Userdb->update_forgotpassword($id, $forgotpswd_data);

                //---- end changing password in database ----//
                // on change of password , unset the autologin feature ....
                if (isset($_COOKIE['autologin_recruiter'])) {
                    delete_cookie('autologin_recruiter');
                }


                $msg_password_changed = "Your new password has been saved. Please login to continue.";
                $this->session->set_userdata('success_msg', $msg_password_changed);

                redirect(base_url());
                exit;
            }
        }
        //--- end post action ---//
        
        //--- start loading the view ---//
        $this->load->view('user/reset_password', $data_msg);
        //--- end loading the view ---//
    }

}