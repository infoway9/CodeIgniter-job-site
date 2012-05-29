<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userdb extends CI_Model {

/*
 * this function is used to insert recruiter_master_data.
 */
    function insert_recruiter_data($data) {
        $this->db->insert(TABLE_RECRUITER_MASTER, $data);
    }
/*
 * this function is used to check user existence by same username.
 */
    function username_exist($user_name) {

        $this->db->select('count(RecruiterId) as `TotalRecords`')
            ->from(TABLE_RECRUITER_MASTER)
            ->where('UserName', $user_name)
            ->where('Status <>', '3');

        $query = $this->db->get()->result_array();
        $val=$query[0]['TotalRecords'];

        return $val;

    }


/*
 * this function is used to check user existence by same email.
 */
    function email_exist($email) {

        $this->db->select('count(RecruiterId) as `TotalRecords`')
            ->from(TABLE_RECRUITER_MASTER)
            ->where('Email', $email)
            ->where('Status <>', '3');

        $query = $this->db->get()->result_array();
        $val=$query[0]['TotalRecords'];

        return $val;
    }

    function get_recruiter_id($username) {

        $this->db->select('`RecruiterId`,`Status`')
            ->from(TABLE_RECRUITER_MASTER)
            ->where('UserName', $username)
            ->where('Status <>', '3');

        $query = $this->db->get();
        return $query;

    }

    function matchrecruiter($username,$password) {
        $this->db->select('RecruiterId as `RecruiterId`, UserName as `UserName`')
            ->from(TABLE_RECRUITER_MASTER)
            ->where('UserName', $username)
            ->where('Password', $password)
            ->where('Status', '1');
        return $query = $this->db->get();
    }

/*
 * this function is used to insert each login record during login.
 */

    function insert_recuiter_login($data) {
        $this->db->insert(TABLE_RECRUITER_LOGIN, $data);
    }


/*
 * this function is used to authenticate an user during profile activation.
 */
    function get_recruiter_status($recruiter_id) {

        $this->db->select('Status')
            ->from(TABLE_RECRUITER_MASTER)
            ->where('RecruiterId', $recruiter_id)
            ->where('Status <>', '3');

        $query = $this->db->get();

        return $query;

    }


/*
 * this function is used to activate user profile by status.
 */
    function activate_recruiter_account($recruiter_id) {

        $data=array(
            'Status'=>'1'
        );

        $this->db->where('RecruiterId', $recruiter_id);
        $this->db->update(TABLE_RECRUITER_MASTER, $data);
    }


/*
 * this function is used to fetch an user's information by email.
 */
    function recruiter_information_by_email($email) {
        $this->db->select('RecruiterId, UserName', FALSE)
            ->from(TABLE_RECRUITER_MASTER)
            ->where('Email', $email)
            ->where('Status', '1');

        $query = $this->db->get();

        return $query;

    }


/*
 * this function adds a new password recovery request data.
 */
    function add_password_request($data) {
        $this->db->insert(TABLE_FORGOT_PASSWORD, $data);
    }


    function update_forgotpassword($id , $data) {
        $this->db->where('Id', $id);
        $this->db->update(TABLE_FORGOT_PASSWORD, $data);
    }


    /*
     * this function is used to authenticate an user during reset password.
     */
    function get_forgotpassword_detail($id) {
        
        $this->db->select('UserId,Status')
            ->from(TABLE_FORGOT_PASSWORD)
            ->where('Id', $id)
            ->where('Status', '0');

        $query = $this->db->get();

        return $query;

    }
   
    /*
     * this function is used to update recruiter master data
     */
    function update_recruiter_data($recruiter_id,$data) {
        $this->db->where('RecruiterId ', $recruiter_id);
        $this->db->update(TABLE_RECRUITER_MASTER, $data);
    }
    
}

?>