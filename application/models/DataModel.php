<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model{

	public function tampil_data(){ 
		return $this->db->get('tb_data_panen'); 
	}

	public function gets($table){ 
		return $this->db->get($table); 
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

	public function hapus_data($where,$table)
	{
		return $this->db->delete($table,$where);
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

	public function get_entries2()
	{		
		$query = $this->db->get('tb_datauji');
		if(count($query->result()) > 0){
			return $query->result_array();
		}
		
	}

	public function edit_entry($id)
	{
		$this->db->select('*');
		$this->db->from('tb_data_panen');
		$this->db->where('id_wilayah', $id);
		$query = $this->db->get();
		if(count($query->result()) > 0){
			return $query->row();
		}
		
	}

	function insert_batch_data($data, $table)
	{
		$this->db->insert_batch($table, $data);
	}

	function get_data($table)
	{
		return $this->db->get($table); 
	}

	public function ambilTanaman()
	{
		return $this->db->query('select jenis_tanaman from tb_data_panen group by jenis_tanaman');
	}

	public function ambilTahun()
	{
		return $this->db->query('select tahun from tb_data_panen group by tahun');
	}

} //end class Modeladmin
