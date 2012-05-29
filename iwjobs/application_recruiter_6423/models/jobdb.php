<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobdb extends CI_Model {

    /*
     * Function to check if job title for particular company already exists ............
     */
    function job_name_exist($job_name,$recruiter_id,$job_id=null)
    {
        $this->db->select('count(Id) as `TotalNum`')
                ->from(TABLE_JOBS)
                ->where('JobName',$job_name);
        $this->db->where('RecruiterId',$recruiter_id);
        if($job_id!='')
        {
            $this->db->where('Id <>',$job_id);
        }
        $query = $this->db->get()->result_array();
        $val = $query[0]['TotalNum'];
        return $val;
    }
    /*
     * Function to check valid experience.........
     */
    
    function valid_experience($val){
        $years=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','15+');
        if(array_search($val, $years) === FALSE){
            return false;
        }
        else{
            return true;
        }
    }
    
    /*
     * this function is used to insert job information.
     */

    function insert_jobs($data) {
        $this->db->insert(TABLE_JOBS, $data);
    }
    /*
     * this function is used to fetch all jobs for specific recuiter id ........
     */
    function get_all_jobs($recruiter_id)
    {
        $this->db->select('Id as `Id`, JobName as `JobName`, JobLocation as `JobLocation`, JobAddedDate as `JobAddedDate`, Status as `Status`')
                ->from(TABLE_JOBS)
                ->where('RecruiterId',$recruiter_id)
                ->where('Status <>','3');
        $query=$this->db->get();
        return $query;
    }
    
    /*
     * This function is used to validate job id .........
     */
    function validate_job_id($job_id)
    {
        $this->db->select('count(`Id`) as `TotalNum`')
                ->from(TABLE_JOBS)
                ->where('Id',$job_id)
            ->where('Status <>','3');
        $query = $this->db->get()->result_array();
        $val = $query[0]['TotalNum'];
        return $val;
    }
    
    /*
     * This function is used to delete jobs .....
     */
    function delete_job($job_id)
    {
        $data=array(
            'Status'=>'3'
        );
        $this->db->update(TABLE_JOBS,$data,array('Id'=>$job_id));
    }
    
    /*
     * This function is user to get details of specific jobs .........
     */
    function get_job_byid($job_id)
    {
        $this->db->select('*')
                ->from(TABLE_JOBS)
                ->where('Id',$job_id)
                ->where('Status <>','3');
        $query=$this->db->get();
        return $query;
    }
    
    /*
     * This function wiil upadte the job details ..........
     */
    function update_job($job_id,$data)
    {
        $this->db->update(TABLE_JOBS,$data,array('Id'=>$job_id));
    }

}