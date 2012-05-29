<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indexdb extends CI_Model {
    
    /*
     * Function to fetch all company .....
     */
    function all_company_logo()
    {
        $this->db->select('RecruiterId,Organization,CompanyLogo,CompanyLink')
                ->from(TABLE_RECRUITER_MASTER)
                ->where('Status','1');
        $query=$this->db->get();
        return $query;
    }
}

?>