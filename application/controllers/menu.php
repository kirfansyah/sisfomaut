<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Menu Management';

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required',[
			'required' => 'Tidak boleh kosong!']); 


		if($this->form_validation->run() == false){
			$this->load->view('templates_admin/header', $data);
			$this->load->view('templates_admin/sidebar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates_admin/footer');
		}else{
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data sudah tersimpan!</div>');
			redirect('menu');
		}
		
	}
 
	public function submenu()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Submenu Management';

		$this->load->model('Menu_model', 'menu');
		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required',[
			'required' => 'Tidak boleh kosong!']);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required',[
			'required' => 'Tidak boleh kosong!']);
		$this->form_validation->set_rules('url', 'Url', 'required',[
			'required' => 'Tidak boleh kosong!']);
		$this->form_validation->set_rules('icon', 'Icon', 'required',[
			'required' => 'Tidak boleh kosong!']);

		if($this->form_validation->run() == false){		
		$this->load->view('templates_admin/header', $data);
			$this->load->view('templates_admin/sidebar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates_admin/footer');
			}else{

				$data = [

					'title' => $this->input->post('title'),
					'menu_id' => $this->input->post('menu_id'),
					'url' => $this->input->post('url'),
					'icon' => $this->input->post('icon'),
					'is_active' => $this->input->post('is_active')
				];

				$this->db->insert('user_sub_menu', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data sudah tersimpan!</div>');
			redirect('menu/submenu');
			}
	}



} // end controller Menu