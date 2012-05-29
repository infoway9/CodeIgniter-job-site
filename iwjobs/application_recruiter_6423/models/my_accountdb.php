<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_accountdb extends CI_Model {

  /*
 * this function is match with the old password.
 */
function matchwith_oldpassword($recruiter_id,$to_match_password)
{

     $this->db->select('count(RecruiterId) as `TotalMatch`')
        ->from(TABLE_RECRUITER_MASTER)
        ->where('RecruiterId', $recruiter_id)
        ->where('Password', md5($to_match_password))
        ->where('Status', '1');

        $query = $this->db->get()->result_array();
        $val=$query[0]['TotalMatch'];

        return $val;

}

}

?>