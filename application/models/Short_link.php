<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class short_link extends CI_Model {

	public function getAll()
	{
		if ($id === 0)
        {
            $query = $this->db->get('long_url');
            return $query->result_array();
        }
 		$this->db->join('short_link', 'short_link.id = redirection_link.short_id');
        $query = $this->db->get_where('long_url', array('long_url.id' => $id));
		//
        return $query->row_array();
	
	}

	public function getById($id)
	{
		if ($id === 0)
        {
            $query = $this->db->get('short_link');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('short_link', array('id' => $id));
        return $query->row_array();

	}
	public function create($data)
	{

     $save=$this->db->insert('short_link', $data);
     $insert_id = $this->db->insert_id();

   		return  $insert_id;
	}
	public function update($data)
	{
		$this->db->set('long_url',$data['long_url'])
         ->where('id',$data['id'])
        ->update('short_link');

	}
	
	public function recreate($data)
	{

     $save=$this->db->insert('redirection_link', $data);
     $insert_id = $this->db->insert_id();

   		return  $insert_id;
	}
	public function reGetById($id){
		if ($id === 0)
        {
            $query = $this->db->get('redirection_link');
            return $query->result_array();
        }
 		$this->db->join('short_link', 'short_link.id = redirection_link.short_id');
        $query = $this->db->get_where('redirection_link', array('redirection_link.id' => $id));
		//
        return $query->row_array();
	}
	
	function getSqlData($sql){
       	$query = $this->db->query($sql);
      	$result=$query->result_array();
     
      	return $result;

	}

        function getData($tableName, $where_data){

        try{

            if (isset($tableName) && isset($where_data)) {



                $this->db->trans_start();

                $query = $this->db->get_where($tableName, $where_data);



                $this->db->trans_complete();

                if ($query->num_rows() > 0){

                    $rows = $query->result_array();

                    return $rows;

                }else{

                    return false;

                }

            }else{

                return false;

            }

        } catch (Exception $e){

            return false;

        }

    }
}