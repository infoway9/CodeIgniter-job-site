<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model('Profiledb', '', TRUE);
        $this->load->model('Userdb', '', TRUE);
    }

    function recruiter_profile() {
        $define_page_name = PROFILE_PG;
        require_once APPPATH . 'php_include/common_header.php';

        //----------- checking for authentication -------------//
        
        if ($recruiter_id == "0") {
            redirect(base_url() . '?redirect_url=' . urlencode(base_url() . 'recruiter-profile'));
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
        $profile_detail_arr = $this->Profiledb->get_recruiter_details($recruiter_id)->result_array();
        
        //--- end initializing default values for input elements ---//
        //--- start initializing an array to handle values and messages during error or success ---//
        $initial_array = array(
            'organization' => '',
            'country'=>'',
            'city' => '',
            'postal_code' => '',
            'address' => '',
            'company_logo' => '',
            'company_link' => '',
            'error_msg'=>''
        );
        
        //--- end initializing an array to handle values and messages during error or success ---//
        
        //----------------- start populating city list ----------------//
         $city_list= $this->all_function->get_allcity();
         $data_msg['city_list']=$city_list;

        //----------------- end populating city list ----------------//
          
        //-------- show error message -----------------//
        if ($this->session->userdata('error_msg') && $this->session->userdata('error_msg') != null) {
            foreach ($initial_array as $key => $v) {
                // Collect message if it is in session...
                if ($this->session->userdata($key)) {
                    $data_msg[$key] = $this->session->userdata($key);
                    $this->session->unset_userdata(array($key => ''));
                }
            }
        } 
        if(count($profile_detail_arr) <= 0 )
        {
            redirect(base_url());
        }else {
            
            $data_msg['organization'] = $profile_detail_arr[0]['Organization'];
            $data_msg['country'] = $profile_detail_arr[0]['Country'];
            $data_msg['city'] = $this->all_function->get_name(TABLE_CITY,'CityId','CityName',$profile_detail_arr[0]['CityName']);
            $data_msg['postal_code'] = $profile_detail_arr[0]['PostalCode'];
            $data_msg['address'] = $profile_detail_arr[0]['Address'];
            $data_msg['company_logo'] = $profile_detail_arr[0]['CompanyLogo'];
            $data_msg['company_link'] = $profile_detail_arr[0]['CompanyLink'];
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
            
            $country          =   "USA";
            $city             =   trim(strip_tags($this->input->post('city')));
            $postal_code      =   trim(strip_tags($this->input->post('postal_code')));
            $address      =   trim(strip_tags($this->input->post('address')));
            $organization = trim(strip_tags($this->input->post('organization')));
            $company_link      =   trim(strip_tags($this->input->post('company_link'))); 
            $company_logo = $_FILES['company_logo']['name'];
            $company_logo_size = $_FILES['company_logo']['size'];
            $company_logo_tmp_name = $_FILES['company_logo']['tmp_name'];
            
            //--- end collecting values of input elements ---//
            
            //--------- Validating City ----------//			

            if (!empty($city))
                $valid_city = $this->all_function->valid_city($city); 
           
            //--------------- Validating Postal Code------------//
            
            if($postal_code !='')
                $valid_postal_code = $this->all_function->validateUSAZip($postal_code);
            
            
            //------------ End Validating Postal Code------------------//
            
           //------------- start get image dimention --------------//
            if($company_logo!='')
            list($width, $height, $type, $attr) = getimagesize($company_logo_tmp_name);
           //------------- end get image dimention -----------------//
             
            //--------------- start validating profile --------------//
            $error_msg = "";
            
            if(!$this->form_validation->required($organization)){
                $error_msg = "Please enter organization.";
            }elseif(isset($company_logo) && $company_logo != '' && !in_array($this->all_function->get_extension($company_logo), explode(",", UPLOAD_LOGO_TYPE))){
                $error_msg = "Please enter a valid logo";
            }elseif(is_uploaded_file($_FILES['company_logo']['tmp_name']) && $_FILES['company_logo']['size'] > (1048576 * UPLOAD_LOGO_SIZE)){
                $error_msg = "Please upload a logo smaller than ".UPLOAD_LOGO_SIZE."mb";
            }elseif($company_logo!='' && ($width!=70 || $height!=44)){
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
            }else{
                //ok.....
            }
            
            //-----------------End validating profile ------------//
          
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
                
                if($company_logo!=''){
                    $extension = $this->all_function->get_extension($company_logo);
                    $new_company_logo_name = $recruiter_id.".".$extension;
                }
                // start building DB operation
                $recruiter_master_data = array(
                    'Organization' => $organization,
                    'Country' => $country,
                    'CityName'=>$this->all_function->get_name(TABLE_CITY,'CityName','CityId',$city),
                    'PostalCode' => $postal_code,
                    'Address'=>$address,
                    'CompanyLink'=>$company_link,
                    'LastUpdatedDate' => date("Y-m-d H:i:s")
                );
                if($company_logo!='')
                $recruiter_master_data['CompanyLogo']=$new_company_logo_name;
                $this->Userdb->update_recruiter_data($recruiter_id,$recruiter_master_data);
                if($company_logo_tmp_name!='')
                {
                    //unlink file......  
                    if(file_exists(UPLOAD_MEDIA_BASEFOLDER.'showcase/company_logo/'.$new_company_logo_name))
                        unlink(UPLOAD_MEDIA_BASEFOLDER.'showcase/company_logo/'.$new_company_logo_name);
                    
                    //move uploaded file.........
                    move_uploaded_file($company_logo_tmp_name,UPLOAD_MEDIA_BASEFOLDER.'showcase/company_logo/'.$new_company_logo_name);
                
                    
                }
                // End building DB operation
                $msg_create_account_success = "You have successfully updated your profile.";
                $this->session->set_userdata('success_msg', $msg_create_account_success);
            }
            redirect(base_url() . 'recruiter-profile');
            exit;
        }

        $this->load->view('profile/profile', $data_msg);
    }

}

?>