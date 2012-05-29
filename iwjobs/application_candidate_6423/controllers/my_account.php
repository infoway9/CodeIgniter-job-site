<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('My_accountdb', '', TRUE);
        $this->load->library(array('form_validation'));
    }

    public function change_passowrd()
    {
         $define_page_name=CHANGEPASSWORD_PG;
         require_once APPPATH.'php_include/common_header.php';
         //----------- checking for authentication -------------//
         if($user_id=="0")
         {
             redirect(base_url() . '?redirect_url=' . urlencode(base_url() . 'change-password'));
         }

         //----------- checking for authentication -------------//


        //-------- start for seo --------//

            $data_msg['meta_tag']=array('MetaTitle' => 'Change your password',
            'MetaDesc' => 'Change your account password',
            'MetaKeyword' => ''
        );
            $data_msg['top_menu']=$define_page_name;

        //-------- end for seo --------//

        //--- start initializing an array to handle values and messages during error or success ---//

        $initial_array = array(
            'error_msg' => '',
            'success_msg' => ''
        );

        //--- end initializing an array to handle values and messages during error or success ---//

        /* --- if error session is set start displaying error message, unset the session index --- */

        if ($this->session->userdata('error_msg')) {
            $data_msg['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata(array('error_msg' => ''));
        }

        /* --- end error manipulation --- */

        /* --- if success session is set display success message from the session & unset the session index */

        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        /* --- end showing success message --- */

        if ($this->input->post('btn_changepassword')) {
            $error_msg="";
        //--- start collecting values of input elements ---//

            $current_password = trim(strip_tags($this->input->post('current_password')));
            $new_password = trim(strip_tags($this->input->post('new_password')));
            $password_confirmation = trim(strip_tags($this->input->post('password_confirmation')));

            //--- end collecting values of input elements ---//

            if ($current_password != "") {
                $get_valid_oldpswd = $this->My_accountdb->matchwith_oldpassword($user_id, $current_password);
            }

            //--- start validating errors ---//
            if (!$this->form_validation->required($current_password)) {
                $error_msg = 'Please enter current password.';
            } elseif ($get_valid_oldpswd == 0) {
                $error_msg = 'Please enter valid old password.';
            } elseif (!$this->form_validation->required($new_password)) {
                $error_msg = 'Please enter new password.';
            } elseif (!$this->form_validation->min_length($new_password, 6)) {
                $error_msg = 'Password should be at least 6 characters in length.';
            } elseif (!$this->form_validation->max_length($new_password, 20)) {
                $error_msg = 'Please limit your password within 20 characters.';
            } elseif ($current_password == $new_password) {
                $error_msg = 'Old and new password must be different.';
            } elseif (!$this->form_validation->required($password_confirmation)) {
                $error_msg = 'Please confirm your password.';
            } elseif ($password_confirmation != $new_password) {
                $error_msg = 'There seems to be a password mismatch.';
            }
            //--- end validating errors ---//
            //--- set error message into session if @error_msg is defined ---//
            if (isset($error_msg) && $error_msg!='') {

                $this->session->set_userdata('error_msg', $error_msg);
            }

            //--- else set DB operations on success, corresponding success message ---//
            else {
            //---- start changing password in database ----//

                $data = array(
                    'Password' => md5($password_confirmation),
                    'UpdatedDate' => date("Y-m-d H:i:s")
                );

                $this->My_accountdb->update_user_data($user_id, $data);

                //---- end changing password in database ----//
                //--- start loading user model and fetch user email ---//

                $user_email_detail=$this->all_function->get_user_emaildetail($user_id);
                $user_name = $user_email_detail['fullname'];
                $email = $user_email_detail['email'];

                //--- end loading user model and fetch user email---//
                // Build mail configuration...
                $support_email = SUPPORT_EMAIL;
                $support_name = SUPPORT_NAME;

                

                // Extract email template...
                $email_content = file_get_contents(base_url() . 'upload_media/email_templates/email_template.html');

                $email_content = str_replace("###image_folder###", base_url() . 'image/mail_images', $email_content);
                $email_content = str_replace("###user_name###", 'Hi '.$user_name, $email_content);
                $email_content = str_replace("###footer_text###", '&copy; '.date("Y") . " all rights reserverd." , $email_content);

                //--- start for constructing subject and message of email to writer ---//
                $result_array = $this->all_function->fetch_email_content('change_password');
                $subject = $result_array['Subject'];
                $email_msg = $result_array['Body'];
                $email_msg = str_replace("{SITEMGR_EMAIL}", $support_email, $email_msg);
                $email_content = str_replace("###email_message###", $email_msg, $email_content);

                //---------------- start shooting email -----------------------------//

                $this->load->library('Send_email');

                $this->send_email->shoot_email($support_name, $support_email, $email, $subject, $email_content);

                //------------------ end for shooting email ---------------------------//

                // on change of password , unset the autologin feature ....
                if (isset($_COOKIE['job_autologin'])) {
                    delete_cookie('job_autologin');
                }

                $msg_password_changed = "You have successfully changed your password.";

                $this->session->set_userdata('success_msg', $msg_password_changed);
            }


            redirect(base_url() . 'change-password');
            exit;
        }
        //--- end post action ---//

         $this->load->view('my_account/change_password',$data_msg);
    }
    public function change_email()
    {
         $define_page_name=CHANGEEMAIL_PG;
         require_once APPPATH.'php_include/common_header.php';
         //----------- checking for authentication -------------//
         if($user_id=="0")
         {
             redirect(base_url() . '?redirect_url=' . urlencode(base_url() . 'change-email'));
         }

         //----------- checking for authentication -------------//


        //-------- start for seo --------//

            $data_msg['meta_tag']=array('MetaTitle' => 'Change your email',
            'MetaDesc' => 'Change your account email',
            'MetaKeyword' => ''
        );
            $data_msg['top_menu']=$define_page_name;

        //-------- end for seo --------//
        //-------- assign initial values to the variables ------------//
            $user_email_detail=$this->all_function->get_user_emaildetail($user_id);
            $data_msg['old_email']=$user_email_detail['email'];

        //--- start initializing an array to handle values and messages during error or success ---//

        $initial_array = array(
            'new_email'=>'',
            'confirm_email'=>'',
            'error_msg' => '',
            'success_msg' => ''
        );

        //--- end initializing an array to handle values and messages during error or success ---//

        /* --- if error session is set start displaying error message, unset the session index --- */

        if ($this->session->userdata('error_msg')) {
            foreach ($initial_array as $key => $v) {
                // Collect values if it is in session...
                if ($this->session->userdata($key)) {
                    $data_msg[$key] = $this->session->userdata($key);

                    $this->session->unset_userdata(array($key => ''));
                }
            }
        }

        /* --- end error manipulation --- */

        /* --- if success session is set display success message from the session & unset the session index */

        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        /* --- end showing success message --- */

        if ($this->input->post('btn_changeemail')) {
            $error_msg="";
        //--- start collecting values of input elements ---//
            
            $current_email = $user_email_detail['email'];
            $new_email = trim(strip_tags($this->input->post('new_email')));
            $confirm_email = trim(strip_tags($this->input->post('confirm_email')));

            //--- end collecting values of input elements ---//
            //--------- check if same email already exists -----------//
            if ($new_email != "") {
                $this->load->model('Userdb', '', TRUE);
                $email_exist_num = $this->Userdb->email_exist($new_email);
            }
            //--------- end checking if same email already exists -----------//
            

            //--- start validating errors ---//
            if (!$this->form_validation->required($new_email)) {
                $error_msg = 'Please enter new email.';
            } elseif (!$this->form_validation->valid_email($new_email)) {
                $error_msg = 'Please enter valid email.';
            } elseif ($email_exist_num > 0) {
                $error_msg = 'Email is already exists. Please enter a different email address.';
            } elseif (!$this->form_validation->required($confirm_email)) {
                $error_msg = 'Please confirm your email.';
            } elseif ($new_email != $confirm_email) {
                $error_msg = 'There seems to be a email mismatch.';
            }
            //--- end validating errors ---//
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
            //---- start changing password in database ----//

                $data = array(
                    'Email' => $new_email,
                    'UpdatedDate' => date("Y-m-d H:i:s")
                );

                $this->My_accountdb->update_user_data($user_id, $data);

                //---- end changing password in database ----//
                //--- start loading user model and fetch user email ---//

                $user_email_detail=$this->all_function->get_user_emaildetail($user_id);
                $user_name = $user_email_detail['fullname'];
                $email = $user_email_detail['email'];

                //--- end loading user model and fetch user email---//
                // Build mail configuration...
                $support_email = SUPPORT_EMAIL;
                $support_name = SUPPORT_NAME;

                

                // Extract email template...
                $email_content = file_get_contents(base_url() . 'upload_media/email_templates/email_template.html');

                $email_content = str_replace("###image_folder###", base_url() . 'image/mail_images', $email_content);
                $email_content = str_replace("###user_name###", 'Hi '.$user_name, $email_content);
                $email_content = str_replace("###footer_text###", '&copy; '.date("Y") . " all rights reserverd." , $email_content);

                //--- start for constructing subject and message of email to writer ---//
                $result_array = $this->all_function->fetch_email_content('change_email');
                $subject = $result_array['Subject'];
                $email_msg = $result_array['Body'];
                $email_msg = str_replace("{SITEMGR_EMAIL}", $support_email, $email_msg);
                $email_content = str_replace("###email_message###", $email_msg, $email_content);

                //---------------- start shooting email -----------------------------//

                $this->load->library('Send_email');

                $this->send_email->shoot_email($support_name, $support_email, $email, $subject, $email_content);

                //------------------ end for shooting email ---------------------------//

               

                $msg_email_changed = "You have successfully changed your email.";

                $this->session->set_userdata('success_msg', $msg_email_changed);
            }


            redirect(base_url() . 'change-email');
            exit;
        }
        //--- end post action ---//

         $this->load->view('my_account/change_email',$data_msg);
    }

}

    ?>