<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indexdb extends CI_Model {


    function insert_newsletter($data)
    {
          $this->db->insert(TABLE_NEWS_LETTER, $data);
    }


    function newsletter_email_exist($email) {

        $this->db->select('count(Id) as `TotalRecords`')
            ->from(TABLE_NEWS_LETTER)
            ->where('Email', $email)
            ->where('Status <>', '3');

        $query = $this->db->get()->result_array();
        $val=$query[0]['TotalRecords'];

        return $val;

    }
}

?>