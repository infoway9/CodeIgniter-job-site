<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidate_searchdb extends CI_Model {

    /*
     * Function to fetch jobs that matches with array values ........
     */
    function candidate_search($search_array)
    {
        $this->db->select('*')
        ->from(TABLE_USER_MASTER)
                ->join(TABLE_USER_PROFESSIONAL_DETAILS,TABLE_USER_MASTER.'.UserId='.TABLE_USER_PROFESSIONAL_DETAILS.'.UserId');
        if(is_array($search_array) && count($search_array) > 0)
        {
            foreach($search_array as $key => $val)
            {
                if(is_array($val) && count($val) > 0 && $key=="KeySkill")
                {
                    foreach($val as $k =>$v)
                    {
                        $where = "KeySkill REGEXP '.*\"SkillName\";s:[0-9]+:\"".$v."\".*'";
                        $this->db->where($where);
                    }
                }
                if(is_array($val) && count($val) > 0 && $key=="FunctionalExpertise")
                {
                    foreach($val as $k =>$v)
                    {
                        $where = "FunctionalExpertise REGEXP '.*\"Name\";s:[0-9]+:\"".$v."\".*'";
                        $this->db->where($where);
                    }
                }
                if($val!='' && $key!="KeySkill" && $key!="FunctionalExpertise" && $key!="Experience" && $key!="ExpectedSal" && $key!="ResumeDesc")
                $this->db->like($key,$val);
                if($val!='' && $key=="ResumeDesc")
                $this->db->or_like($key,$val);    
                if($val!='' && ($key=="Experience" || $key=="ExpectedSal" || $key=="EmpStatus"))
                    $this->db->where($key,$val);
            }
        }
        $query=$this->db->get();
        return $query;
    }
    /*
     * Function to insert data into contact table .........
     */
    function insert_contact($data)
    {
        $this->db->insert(TABLE_CONTACT,$data);
    }

}
