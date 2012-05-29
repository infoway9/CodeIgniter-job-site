<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_searchdb extends CI_Model {

    /*
     * Function to fetch jobs that matches with array values ........
     */
    function job_search($search_array)
    {
        $this->db->select('*')
        ->from(TABLE_JOBS)
                ->join(TABLE_RECRUITER_MASTER,TABLE_JOBS.'.RecruiterId='.TABLE_RECRUITER_MASTER.'.RecruiterId');
        if(is_array($search_array) && count($search_array) > 0)
        {
            foreach($search_array as $key => $val)
            {
                if(is_array($val) && count($val) > 0 && $key=="Skill")
                {
                    foreach($val as $k =>$v)
                    {
                        $where = "Skill REGEXP '.*\"SkillName\";s:[0-9]+:\"".$v."\".*'";
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
                if($val!='' && $key!="Skill" && $key!="FunctionalExpertise" && $key!="Experience" && $key!="Salary" && $key!="JobDescription")
                $this->db->like($key,$val);
                if($val!='' && $key=="JobDescription")
                $this->db->or_like($key,$val);    
                if($val!='' && ($key=="Experience" || $key=="Salary"))
                    $this->db->where($key,$val);
            }
        }
        $this->db->where(TABLE_JOBS.'.Status','1');
        $query=$this->db->get();
        return $query;
    }

}