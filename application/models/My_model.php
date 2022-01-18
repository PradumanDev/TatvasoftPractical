<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

	function __Construct(){
		$this->load->database();
	}

	public function selectData($params){
        /***
         $params = [
            'table' => TABLE_NAME,
            'where' => CONDITION,
            'limit' => DATA LIMIT
         ]
        */

        extract($params);
		$this->db->select(isset($fields)?$fields:'');
        $this->db->from($table);

        if(isset($where)){
            $this->db->where($where);
        }
		

        if(isset($limit)){
            if(is_array($limit)){
                $this->db->limit($limit['limit'] , $limit['offset']);
            }else{
                $this->db->limit($limit);
            }
        }
        return $this->db->get()->result_array();

	}

    public function insertData($params){
        /***
         $params = [
            'table' => TABLE_NAME,
            'data' => ALL_DATA
         ]
        */
        extract($params);

		$this->db->insert($table , $data);
        return $this->db->insert_id();
	}

    public function updateData($params){
        extract($params);
        /***
         $params = [
            'table' => TABLE_NAME,
            'where' CONDITION,
            'limit' => LIMIT
         ]
        */
        $this->db->where($where);
        $this->db->set($data);

        if(isset($limit)){
            $this->db->limit($limit);
        }
        return $this->db->update($table);
	}


    
    public function removeData($params){
        /***
         $params = [
            'table' => TABLE_NAME,
            'where' CONDITION,
            'limit' => LIMIT
         ]
        */
        extract($params);
        if(isset($limit)){
            $this->db->limit($limit);
        }
        return $this->db->delete($table, $where);
	}
    
}
