<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_function {

    function __construct() {
        
    }

    function get_extension($file_name) {
        $ext_name = $file_name;
        $ext_arr = explode('.', $ext_name);
        $total_val = count($ext_arr);
        if ($total_val > 1) {
            $ext = $ext_arr[$total_val - 1];
            $ext = strtolower($ext);
        } else {
            $ext = '';
        }


        return $ext;
    }

    /*
     * this function returns the date and hour.
     */

    function date_diff($start, $end) {
        $sdate = strtotime($start);
        $edate = strtotime($end);

        if ($edate > $sdate) {

            $time = $edate - $sdate;
            if ($time >= 0 && $time <= 59) {
                // Seconds
                $timeshift = $time . ' seconds ';
            } elseif ($time >= 60 && $time <= 3599) {
                // Minutes + Seconds
                $pmin = ($edate - $sdate) / 60;
                $premin = explode('.', $pmin);

                $presec = $pmin - $premin[0];
                $sec = $presec * 60;

                $timeshift = $premin[0] . ' min ' . round($sec, 0) . ' sec ';
            } elseif ($time >= 3600 && $time <= 86399) {
                // Hours + Minutes
                $phour = ($edate - $sdate) / 3600;
                $prehour = explode('.', $phour);

                $premin = $phour - $prehour[0];
                $min = explode('.', $premin * 60);

                // $presec = '0.'.$min[1];
                // $sec = $presec*60;

                $timeshift = $prehour[0] . ' hrs ' . $min[0] . ' min ';
            } elseif ($time >= 86400) {
                // Days + Hours + Minutes
                $pday = ($edate - $sdate) / 86400;
                $preday = explode('.', $pday);

                $phour = $pday - $preday[0];
                $prehour = explode('.', $phour * 24);

                $premin = ($phour * 24) - $prehour[0];
                $min = explode('.', $premin * 60);

                // $presec = '0.'.$min[1];
                // $sec = $presec*60;

                $timeshift = $preday[0] . ' days ' . $prehour[0] . ' hrs ';
            }
            return $timeshift;
        } else {
            return "0";
        }
    }

    /*
     * this function generates a random string. Basically used for auto-generated ids.
     */

    function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // generate the random string
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        $time = mktime();
        $val = $time . $rand;

        return $val;
    }

    function splittext($str, $no) {

        $str = trim($str);

        $str_length = strlen($str);

        if ($str_length > $no) {
            $val = substr($str, 0, $no) . "...";
        } else {
            $val = $str;
        }

        return $val;
    }

    function wraptext($str, $no) {
        $var1 = $str;
        if (trim($var1) == '') {
            return '';
        } else {


            $spacesplit = explode(' ', $var1);
            $str2 = "";

            for ($i = 0; $i < count($spacesplit); $i++) {
                $numberof = strlen($spacesplit[$i]);
                $str1 = $spacesplit[$i];
                if ($numberof > $no) {
                    $str1 = chunk_split($str1, $no, " ");
                }
                $str2.=$str1 . " ";
            }

            $str2 = trim($str2);

            return $str2;
        }
    }

    /*
     * this function is used for put a parameter and get a new url with that parameter.
     */

    function dynamic_parameter($parameter_name, $parameter_value) {
        $page_name = $_SERVER['REQUEST_URI'];
        $page_name = basename($page_name);

        $page1 = explode("?", $page_name);
        if (count($page1) > 1 && $page1[1] != NULL) {
            $page2 = explode("&", $page1[1]);
            $array = array();

            foreach ($page2 as $v) {
                $v = explode("=", $v);
                if (count($v) > 1) {
                    $array[$v[0]] = $v[1];
                }
            }

            $page_array = $array; // for previous page

            $page_array[$parameter_name] = $parameter_value;

            $page_display = "";
            foreach ($page_array as $v => $v1) {
                $page_display.=$v . "=" . $v1 . "&";
            }
            $page_display = rtrim($page_display, "&");


            $page_display = base_url() . uri_string() . "?" . $page_display;

            unset($array);
            unset($page_array);
        } else {
            $page_display = base_url() . uri_string() . "?$parameter_name=$parameter_value";
        }

        return $page_display;
    }

    /*
     * this function fetches the email subject and body.
     */

    function fetch_email_content($email_code) {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);

        $result_array = $CI->All_functiondb->fetch_email_content($email_code)->result_array();
        return $result_array[0];
    }

    /*
     * this function fetches the country list.
     */

    function get_allcountry() {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $result_array = $CI->All_functiondb->get_allcountry()->result_array();
        return $result_array;
    }

    /*
     * this function fetches the area of expertise list.
     */

    function get_allexpertise() {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $result_array = $CI->All_functiondb->get_allexpertise()->result_array();
        return $result_array;
    }

    /*
     * this function fetches the user email.
     */

    function get_user_emaildetail($user_id) {
        $CI = & get_instance();
        $CI->load->model('Profiledb', '', TRUE);

        $val = $CI->Profiledb->get_user_details($user_id)->result_array();

        $fullname = $val[0]['Name'];
        $email = $val[0]['Email'];

        $val = array('fullname' => $fullname, 'email' => $email);

        return $val;
    }

    /*
     * this function fetches the country list.
     */

    function get_allcity() {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $result_array = $CI->All_functiondb->get_allcity()->result_array();
        return $result_array;
    }

    /*
     * this function fetches the degree list.
     */

    function get_alldegree() {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $result_array = $CI->All_functiondb->get_alldegree()->result_array();
        return $result_array;
    }
    
    /*
     * this function fetches the key skill list.
     */

    function get_key_skills($param) {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $result_array = $CI->All_functiondb->get_key_skills($param)->result_array();
        return $result_array;
    }

    /*
     * Function to validate US Postal Code.
     */

    function validateUSAZip($zip_code) {
        if (preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $zip_code))
            return true;
        else
            return false;
    }
    /*
     * Function to validate city........
     */
    function valid_city($city)
    {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $chk_valid = $CI->All_functiondb->valid_city($city);
        return $chk_valid;
    }
    /*
     * Function to validate degree........
     */
    function valid_degree($degree)
    {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $chk_valid = $CI->All_functiondb->valid_degree($degree);
        return $chk_valid;
    }
    /*
     * Function to get attribute name by id........
     */
    function get_name($table_name,$attribute,$field,$value)
    {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $value = $CI->All_functiondb->get_name($table_name,$attribute,$field,$value);
        return $value;
    }
    /*
     * Function to check valid multiple values....
     */
    function valid_multiple_values($table_name,$attribute,$field,$value_array)
    {
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $chk_valid = $CI->All_functiondb->valid_multiple_values($table_name,$attribute,$field,$value_array);
        return $chk_valid;
    }
    
    /*
     * To get the attribute from multiple result
     */
    
    function get_names($table_name,$attribute,$where,$id){
        $CI = & get_instance();
        $CI->load->model('All_functiondb', '', TRUE);
        $value = $CI->All_functiondb->get_names($table_name,$attribute,$where,$id);
        return $value;
              
    }
}

?>