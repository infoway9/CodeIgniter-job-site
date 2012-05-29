<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profiledb extends CI_Model {


    /*
     * this function is used to update user master data
     */
    function update_user_data($user_id,$data) {
        $this->db->where('UserId', $user_id);
        $this->db->update(TABLE_USER_MASTER, $data);
    }

    /*
     * This function is used to update user professional data .......
     */
    function update_user_professional_data($user_id,$data)
    {
        $this->db->where('UserId', $user_id);
        $this->db->update(TABLE_USER_PROFESSIONAL_DETAILS, $data);
    }


    /* fetch user details by user id */
    function get_user_details($user_id) {

        $this->db->select('UserName as `UserName`, Email as `Email`, concat( FName, " ", LName) as `Name`, FName as `FirstName`, LName as `LastName`, ImageName as `ImageName`, Biography as `Biography`, Gender as `Gender`, CountryCode as `CountryCode`, PostalCode as `PostalCode`, CityName as `CityName`, Address as `Address`',FALSE)
            ->from(TABLE_USER_MASTER)
            //->join(TABLE_COUNTRY.' as c','c.CountryCode=um.CountryCode')
            ->where('UserId', $user_id)
            ->where('Status', '1');

        $query = $this->db->get();

        return $query;

    }
    /* fetch user details by user id */
    function get_user_professional_details($user_id) {

        $this->db->select('KeySkill as `KeySkill`, FunctionalExpertise as `FunctionalExpertise`, CurrentLoc as `CurrentLoc`, PreferredLoc as `PreferredLoc`, EmpStatus as `EmpStatus`, Experience as `Experience`, CurrentSal as `CurrentSal`, ExpectedSal as `ExpectedSal`, CurrentComp as `CurrentComp`, Designation as `Designation`, ResumeDesc as `ResumeDesc`, Degree as `Degree`',FALSE)
            ->from(TABLE_USER_PROFESSIONAL_DETAILS)
            //->join(TABLE_COUNTRY.' as c','c.CountryCode=um.CountryCode')
            ->where('UserId', $user_id);

        $query = $this->db->get();

        return $query;

    }
    
    /*
     * This function check valid experience value ........
     */
    
    function valid_experience($val){
        $years=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','15+');
        if(array_search($val, $years) == null){
            return false;
        }
        else{
            return true;
        }
    }




}

?>