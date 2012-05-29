<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indexpg extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $define_page_name = INDEX_PG;
        require_once APPPATH . 'php_include/common_header.php';

        if ($recruiter_id != '0') {
            redirect(base_url().'recruiter-profile');

            exit;
        }
        //-------- start for seo --------//

        $data_msg['meta_tag'] = array('MetaTitle' => 'Jobs for Everyone',
            'MetaDesc' => 'Get your dream job',
            'MetaKeyword' => 'Jobs for Everyone, Get your dream job'
        );
        $data_msg['top_menu'] = $define_page_name;

        //-------- end for seo --------//


        if (isset($_REQUEST['redirect_url'])) {
            $redirect_url = $_REQUEST['redirect_url'];
            $data_msg['continue_signin'] = 'y';
        } else {
            $data_msg['continue_signin'] = 'n';
        }

        //------------- load classes ---------------//
        $this->load->library('form_validation');
        $this->load->model('Userdb','',TRUE);
        //------------- load classes ---------------//
        //--- start initializing an array to handle values and messages during error or success ---//

        $initial_array = array(
            'username' => '',
            'staysignin' => '',
            'error_msg' => '',
            'success_msg' => '',
        );

        $news_initial_array = array(
            'news_fname' => '',
            'news_lname' => '',
            'news_email' => '',
            'news_error_msg' => '',
            'news_success_msg' => '',
        );

        //--- end initializing an array to handle values and messages during error or success ---//
        //------------ start for error and success message --------------//

        if ($this->session->userdata('error_msg') != "") {

            foreach ($initial_array as $v => $key) {
                if ($this->session->userdata($v)) {

                    $data_msg[$v] = $this->session->userdata($v);
                }
            }
            $data_msg['continue_signin'] = 'n';
            $this->session->unset_userdata($initial_array);
        }

        if ($this->session->userdata('news_error_msg') != "") {

            foreach ($news_initial_array as $v => $key) {
                if ($this->session->userdata($v)) {

                    $data_msg[$v] = $this->session->userdata($v);
                }
            }
            $this->session->unset_userdata($news_initial_array);
        }
        if ($this->session->userdata('success_msg') != "") {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');

            $data_msg['continue_signin'] = 'n';
        }

        if ($this->session->userdata('news_success_msg') != "") {

            $data_msg['news_success_msg'] = $this->session->userdata('news_success_msg');
            $this->session->unset_userdata('news_success_msg');
        }

        //------------ end for error and success message --------------//
        //------------ start for sign in ----------//

        if ($this->input->post('btn_signin')) {
            $error_msg = "";
            $username = trim(strip_tags($this->input->post('textusername')));
            $password = trim(strip_tags($this->input->post('textpassword')));

            $stay_signin = trim(strip_tags($this->input->post('stay_sign')));

            if (!$this->form_validation->required($username)) {
                $error_msg = "Please enter your username.";
            } elseif (!$this->form_validation->required($password)) {
                $error_msg = "Please enter password.";
            }
            if ($error_msg == "") {
                $id_qry = $this->Userdb->get_recruiter_id($username);

                if ($id_qry->num_rows != 0) {
                    $id_arr = $id_qry->result_array();
                    $id = $id_arr[0]['RecruiterId'];
                    // Redirect to writeIO home page if user id is in-valid...
                    $recruiter_status = $id_arr[0]['Status'];
                    //Account is already active...
                    if ($recruiter_status == '0') {
                        $error_msg = "You have already registered. Please activate your account by clicking on the link in your activation email.";
                    } else {
                        if ($username == "") {
                            $error_msg = "Please enter your username / email.";
                        } else if ($password == "") {
                            $error_msg = "Please enter password.";
                        } else {
                            $password = md5($password);



                            $get_recruiter_information = $this->Userdb->matchrecruiter($username, $password);

                            if ($get_recruiter_information->num_rows == 0) {
                                $error_msg = "Invalid username / password.";
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
                                //-------- start for stay sign in ---------//

                                if ($stay_signin == '1') {
                                    $cookie = array(
                                        'name' => 'job_autologin_recruiter',
                                        'value' => $this->encrypt->encode($username . '~####~' . $password),
                                        'expire' => '157680000', // cookie set for 5 years
                                        'domain' => '',
                                        'path' => '/',
                                        'prefix' => '',
                                        'secure' => FALSE
                                    );

                                    $this->input->set_cookie($cookie);
                                }

                                //-------- end for stay sign in ---------//

                                //-------- start delete candidate session ---------//
                                
                                if($this->session->userdata('job_user_id'))
                                {
                                    $this->session->unset_userdata(array('job_user_id' => '', 'job_user_name' => ''));

                                    if (isset($_COOKIE['job_autologin'])) {
                                        delete_cookie('job_autologin');
                                    }
                                }
                                
                                //-------- end delete candidate session ---------//

                                if (isset($redirect_url)) {
                                    redirect($redirect_url);
                                } else {
                                    redirect(base_url() . 'recruiter-profile');
                                }
                            }
                        }
                    }
                } else {
                    $error_msg = "Invalid username / password.";
                }
            }

            if ($error_msg != "") {
                $session_array = array('username' => $username,
                    'staysignin' => $stay_signin,
                    'error_msg' => $error_msg,
                );

                $this->session->set_userdata($session_array);

                if (isset($redirect_url)) {
                    redirect(base_url() . '?redirect_url=' . urlencode($redirect_url));
                } else {
                    redirect(base_url());
                }
            }
        }

        //------------ end for sign in ----------//


        $this->load->view('index/indexpg', $data_msg);
    }

    function error404() {
        require_once APPPATH . 'php_include/common_header.php';

        $meta_title = "";
        $heading = "";
        $content = "";

        if (DEFAULT_LANGUAGE == "en") {
            $meta_title = "404 Page not found";
            $heading = "404 ERROR: Not Found";
            $content = "The page you seek can not be found, but countless more exist...<br />{LINKSTART}Click Here{LINKEND} to enter your site.";
        } else if (DEFAULT_LANGUAGE == "es") {
            $meta_title = utf8_encode("404 P�gina no encontrada");
            $heading = utf8_encode("ERROR 404: No encontrado");
            $content = utf8_encode("La p�gina que busca no se encuentra, pero existen muchos m�s...<br />{LINKSTART}Haga clic aqu�{LINKEND} para entrar en su sitio.");
        }

        $data_msg['meta_title'] = $meta_title;
        $data_msg['heading'] = $heading;
        $content = str_replace(array('{LINKSTART}', '{LINKEND}'), array('<a href="' . base_url() . '" class="errlink">', '</a>'), $content);
        $data_msg['content'] = $content;

        $this->load->view('index/error404', $data_msg);
    }

}