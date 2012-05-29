<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_functiondb extends CI_Model {


/*
 * this function fetches the email subject and body.
 */

    function fetch_email_content($email_code) {

        $this->db->select('Subject AS `Subject`, Body AS `Body`')
       // $this->db->select('Subject_en AS `Subject`, Body_en AS `Body`')
            ->from(TABLE_EMAIL_NOTIFICATION)
            ->where('EmailCode', $email_code)
            ->where('Status', '1');

        $query = $this->db->get();
        return $query;
    }

/*
 * this function fetches the list of countries.
 */

    function get_allcountry() {
        $this->db->select('CountryCode, CountryName as `CountryName`')
            ->from(TABLE_COUNTRY)
            ->where('Status', '1')
            ->order_by('CountryName','asc');

        $query = $this->db->get();
        return $query;

    }
    
    
    
    
    /*
 * this function fetches the list of area of expertise.
 */

    function get_allexpertise() {
        $this->db->select('Id, Name as `Name`')
            ->from(TABLE_EXPERTISE_AREA)
            ->order_by('Name','asc');

        $query = $this->db->get();
        return $query;

    }
/*
 * this function fetches the list of countries.
 */

    function get_allcity() {
        $this->db->select('CityId, CityName as `CityName`')
            ->from(TABLE_CITY)
            ->where('Status', '1')
            ->order_by('CityName','asc');

        $query = $this->db->get();
        return $query;

    }
    
 /*
 * this function fetches the list of degree.
 */

    function get_alldegree() {
        $this->db->select('Id, Degree as `DegreeName`')
            ->from(TABLE_DEGREE)
            ->order_by('Degree','asc');

        $query = $this->db->get();
        return $query;

    }
    
/*
 * this function fetches all key skills ......
 */
    function get_key_skills($param)
    {
            $this->db->select('*')
                    ->from(TABLE_KEY_SKILLS)
                    ->like('SkillName',$param);
            $query = $this->db->get();
            return $query;
            
    }
    
/*
 * check if the city is valid or not ......
 */

    function valid_city($city='') {
        if (!empty($city)) {
            $this->db->select('CityId')->from(TABLE_CITY)->where('CityId', $city);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return 1; else
                return 0;
        }else
            return 0;
    }
    
/*
 * check if the degree is valid or not ......
 */


    function valid_degree($degree='') {
        if (!empty($degree)) {
            $this->db->select('Id')->from(TABLE_DEGREE)->where('Id', $degree);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return 1; else
                return 0;
        }else
            return 0;
    }
    
    /*
     * To get the attribute from a single result
     */
    function get_name($table_name,$attribute,$where,$id){
        if($id!='')
        {
            $this->db->select($attribute)
                    ->from($table_name)
                    ->where($where,$id);
            $query = $this->db->get();
            $array = $query->result_array();
            if(count($array) > 0)
            {
                $name = $array[0][$attribute];
            }
            else
            {
                $name="";
            }
        }
        else
        {
            $name="";
        }
        
        return $name;
        
    }    
    /*
     * to get the atribute from multiple result........
     */
    function valid_multiple_values($table_name,$attribute,$field,$id){
        $this->db->select($attribute)
                ->from($table_name)
                ->where_in($field,$id);
        $result = $this->db->count_all_results();
        if($result == count($id)){
            return TRUE;
        }
        else{
            return FALSE;
        }        
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
    
    /* fetch user details by user id */
    function get_user_details($user_id) {

        $this->db->select('UserName as `UserName`, Email as `Email`, concat( FName, " ", LName) as `Name`',FALSE)
            ->from(TABLE_USER_MASTER)
            ->where('UserId', $user_id)
            ->where('Status', '1');

        $query = $this->db->get();

        return $query;

    }
    
}
?>