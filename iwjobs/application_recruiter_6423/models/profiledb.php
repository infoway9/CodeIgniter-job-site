<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profiledb extends CI_Model {

    /* fetch user details by user id */
    function get_recruiter_details($recruiter_id) {

        $this->db->select('UserName as `UserName`, Email as `Email`, Organization as `Organization`, Country  as `Country`, CityName as `CityName`, PostalCode as `PostalCode`, Address  as `Address`, CompanyLogo as `CompanyLogo`, CompanyLink as `CompanyLink`',FALSE)
            ->from(TABLE_RECRUITER_MASTER)
            //->join(TABLE_COUNTRY.' as c','c.CountryCode=um.CountryCode')
            ->where('RecruiterId', $recruiter_id)
            ->where('Status', '1');

        $query = $this->db->get();

        return $query;

    }
}

?>