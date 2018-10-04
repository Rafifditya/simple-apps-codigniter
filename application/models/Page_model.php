<?php
class Page_model extends CI_Model{

    function getAllUser(){
        $this->db->order_by('id', 'ASC');
        $query=$this->db->get('user');
        return $query->result();
    }

    function getAllPending(){
        $array = array('status >' => 1);
        $query = $this->db->get_where('proyek', $array);
        return $query->result();
    }
}
