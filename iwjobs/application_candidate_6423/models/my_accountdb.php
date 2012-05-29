<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_accountdb extends CI_Model {

  /*
 * this function is match with the old password.
 */
function matchwith_oldpassword($user_id,$to_match_password)
{

     $this->db->select('count(UserId) as `TotalMatch`')
        ->from(TABLE_USER_MASTER)
        ->where('UserId', $user_id)
        ->where('Password', md5($to_match_password))
        ->where('Status', '1');

        $query = $this->db->get()->result_array();
        $val=$query[0]['TotalMatch'];

        return $val;

}

/*
 * this function is used to update user master data
 */
function update_user_data($user_id , $data)
{
    $this->db->where('UserId', $user_id);
    $this->db->update(TABLE_USER_MASTER, $data);
}

}

?>