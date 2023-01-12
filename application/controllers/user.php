<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('user/index');
		$this->load->view('templates_admin/footer');
	}

	public function edit_profile()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('name', 'Nama','required|trim',['required' => 'Nama tidak boleh kosong']);

		if($this->form_validation->run() == false){
			$this->load->view('templates_admin/header',$data);
			$this->load->view('templates_admin/sidebar');
			$this->load->view('user/edit_profile');
			$this->load->view('templates_admin/footer');
		}else{
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			//cek jika ada gambar yang akan diupload

			$upload_image = $_FILES['image']; 
			
			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['upload_path'] = realpath(FCPATH.'/assets/img/profile');

				$this->load->library('upload');
				$this->upload->initialize($config);

				if($this->upload->do_upload('image')){

					$old_image = $data['user']['image'];
					if($old_image != 'default.jpg'){
						unlink(FCPATH.'assets/img/profile/'.$old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');					
					
				}
			}

			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				 Profil diubah !
				</div>');
				redirect('user');

		}
		
	}

	public function changePassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('current_password','Current Password','required|trim');
		$this->form_validation->set_rules('new_password1','New Password','required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2','Confirm Password','required|trim|min_length[3]|matches[new_password1]');

		if($this->form_validation->run() == false){
			$this->load->view('templates_admin/header',$data);
			$this->load->view('templates_admin/sidebar');
			$this->load->view('user/changepassword');
			$this->load->view('templates_admin/footer');
		}else{
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');

			if(!password_verify($current_password, $data['user']['password'])){

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				 Current Password salah!
				</div>');
				redirect('user/changepassword');
			}else{
				if($current_password == $new_password){
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				 Password baru tidak boleh sama dengan password sebelumnya!
				</div>');
					redirect('user/changepassword');
				}else{
					// password ok

					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				 Password berhasil diganti!
				</div>');
				redirect('user/changepassword');
				}
			}
		}
		
		
	} 

}