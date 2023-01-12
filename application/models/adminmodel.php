<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmodel extends CI_Model{

	public function tampil_data(){ 
		return $this->db->get('tb_data_panen'); 
	}

	public function tambahdata($data,$table){
		$this->db->insert($table,$data);
	}

	public function edit_data($where,$table)
	{
		return $this->db->get_where($table,$where);
	} 

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($where,$table,$id)
	{
		$this->db->query('delete from tb_data_panen where id_wilayah = '.$id.'');
	}

	public function tambah_cen($data,$table){
		$this->db->insert($table,$data);
	}

	public function get_entries()
	{
		$query = $this->db->get('tb_data_panen');
		if(count($query->result()) > 0){
			return $query->result();
		}
		
	}

	public function joinTabel($table,$table2,$on)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $on);
		// $this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

} //end class Modeladmin
