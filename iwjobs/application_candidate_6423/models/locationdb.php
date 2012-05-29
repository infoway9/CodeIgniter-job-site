<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locationdb extends CI_Model {


function get_province()
{
    $this->db->select('ProvinceId,ProvinceName')
            ->from(TABLE_SPAIN_PROVINCE)
            ->where('Status', '1');

        $query = $this->db->get()->result_array();

        return $query;
}

function get_municipality($province_id)
{
    $this->db->select('MunicipalityId,MunicipalityName')
            ->from(TABLE_SPAIN_MUNICIPALITY)
            ->where('ProvinceId', $province_id)
            ->where('Status', '1');

    $query = $this->db->get()->result_array();

    return $query;
}

function get_postalcode($municipality_id)
{
    $this->db->select('PostalId,PostalCode')
            ->from(TABLE_SPAIN_POSTAL)
            ->where('MunicipalityId', $municipality_id)
            ->where('Status', '1');

        $query = $this->db->get()->result_array();

        return $query;
}

function check_postalcode($province_id,$municipality_id,$postalcode_id)
{
     $this->db->select('count(PostalId) as TotalId')
            ->from(TABLE_SPAIN_POSTAL)
            ->where('ProvinceId', $province_id)
            ->where('MunicipalityId', $municipality_id)
            ->where('PostalId', $postalcode_id)
            ->where('Status', '1');

        $query = $this->db->get()->result_array();
        $val=$query[0]['TotalId'];

        return $val;
}

}

?>