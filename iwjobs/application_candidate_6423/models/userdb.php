<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userdb extends CI_Model {

/*
 * this function is used to insert user_master_data.
 */
    function insert_user_data($data) {

        $this->db->insert(TABLE_USER_MASTER, $data);

    //echo $this->db->last_query();
    //exit;

    }
    
    function insert_prof_data($data) {

        $this->db->insert(TABLE_USER_PROFESSIONAL_DETAILS, $data);

    //echo $this->db->last_query();
    //exit;

    }


/*
 * this function is used to check user existence by same username.
 */
    function username_exist($user_name) {

        $this->db->select('count(UserId) as `TotalRecords`')
            ->from(TABLE_USER_MASTER)
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

        $this->db->select('count(UserId) as `TotalRecords`')
            ->from(TABLE_USER_MASTER)
            ->where('Email', $email)
            ->where('Status <>', '3');

        $query = $this->db->get()->result_array();
        $val=$query[0]['TotalRecords'];

        return $val;
    }

    function get_user_id($username) {

        $this->db->select('`UserId`,`Status`')
            ->from(TABLE_USER_MASTER)
            ->where('UserName', $username)
            ->where('Status <>', '3');

        $query = $this->db->get();
        return $query;

    }

    function matchuser($username,$password) {
        $this->db->select('UserId as `UserId`, UserName as `UserName`')
            ->from(TABLE_USER_MASTER)
            ->where('UserName', $username)
            ->where('Password', $password)
            ->where('Status', '1');
        return $query = $this->db->get();
    }

/*
 * this function is used to insert each login record during login.
 */

    function insert_user_login($data) {
        $this->db->insert(TABLE_USER_LOGIN, $data);
    }


/*
 * this function is used to authenticate an user during profile activation.
 */
    function get_user_status($user_id) {

        $this->db->select('Status')
            ->from(TABLE_USER_MASTER)
            ->where('UserId', $user_id)
            ->where('Status <>', '3');

        $query = $this->db->get();

        return $query;

    }


/*
 * this function is used to activate user profile by status.
 */
    function activate_useraccount($user_id) {

        $data=array(
            'Status'=>'1'
        );

        $this->db->where('UserId', $user_id);
        $this->db->update(TABLE_USER_MASTER, $data);
    }


/*
 * this function is used to fetch an user's information by email.
 */
    function user_information_by_email($email) {
        $this->db->select('UserId, UserName, concat( FName, " ", LName) as `Name`', FALSE)
            ->from(TABLE_USER_MASTER)
            ->where('Email', $email)
            ->where('Status', '1');

        $query = $this->db->get();

        return $query;

    }
    
    
    
    /*
     * To get the attribute from multiple result
     */
    
    function get_names($table_name,$attribute,$where,$id){
        $this->db->select($attribute)
                ->from($table_name)
                ->where_in($where,$id);
        $result = $this->db->get()->result_array();
        
       return $result;        
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
    
    
    //------------------checking functional expertise--------------------------//
    
    
    
 
    
    //------------------checking experience--------------------------//
    
    function valid_experience($val){
        $years=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','15+');
        if(array_search($val, $years) === FALSE){
            return false;
        }
        else{
            return true;
        }
    }
    
}

?>