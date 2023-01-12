<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Auth extends CI_Controller {

	public function index()
	{

		if($this->session->userdata('email')){
			redirect('user');
		}
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','password','trim|required');

		if($this->form_validation->run() == false){

		$data['title']	= 'Login Page';	
		$this->load->view('templates_auth/auth_header', $data);
		$this->load->view('auth/login');
		$this->load->view('templates_auth/auth_footer');

		}else{
			//validasinya sukses
			$this->_login();

		}
				
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		//jika usernya ada
		if($user){

			// jika usernya aktif 
			if($user['is_active'] == 1){

				// cek password
				if(password_verify($password, $user['password'])){
					$data = [

						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);	
						
					if($user['role_id'] == 1){
						redirect('admin');
					}else{
						redirect('user');
					}

				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Password salah!
					</div>');
					redirect('auth');
				}

			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				 Email belum diaktivasi!
				</div>');
				redirect('auth');
			}

		}else{

			// user tidak ada
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email belum terdaftar!</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		if($this->session->userdata('email')){
			redirect('user');
		}
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[
			'is_unique' => 'Email sudah pernah terdaftar!'
		]);
		$this->form_validation->set_rules('password1','Password','required|trim|min_length[3]|matches[password2]',[
		'matches' => 'Password dont match!',
		'min_length' => 'Password terlalu pendek!'	]);
		$this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');

		if($this->form_validation->run() == false){

		$data['title'] = 'Aplikasiku Registration';
		$this->load->view('templates_auth/auth_header', $data);
		$this->load->view('auth/registration');
		$this->load->view('templates_auth/auth_footer');
		}else{

			$email = $this->input->post('email', true);
			$data = [

				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			//token

			$token = base64_encode(bin2hex(openssl_random_pseudo_bytes(32)));
			$user_token = [

				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			// $this->_sendEmail($token, 'verify');

			// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			// 	 Selamat! akun anda sudah dibuat. Silakan aktivasi akun melalui email
			// 	</div>');
			// redirect('auth');
			redirect(base_url().'auth/verify?email='. $this->input->post('email').'&token='.urlencode($token));
		}
		
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'sistemregresi@gmail.com',
			'smtp_pass' => 'sapar123',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email',$config);  
		$this->email->initialize($config);

		$this->email->from('sistemregresi@gmail.com', 'ADMIN SISTEM');
		$this->email->to($this->input->post('email'));

		if($type == 'verify')
		{
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account : <a href="'.base_url().'auth/verify?email='. $this->input->post('email').'&token='.urlencode($token).'">Activate </a>');

		}
		
		if ($this->email->send()) 
		{
			return true;

		}else{
			echo $this->email->print_debugger();
			die();
		}


	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if($user){

			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if($user_token){

				if(time() - $user_token['date_created'] < (60*60*24)){

					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');
					
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					'.$email.' Sudah aktif, silakan login!
					</div>');
					redirect('auth');
				}else{

					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					 Aktivasi gagal, token kadaluarsa!
					</div>');
					redirect('auth');
				}

			}else{

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				 Aktivasi gagal, token salah!
				</div>');
				redirect('auth');
			}

		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				 Aktivasi gagal, email salah!
				</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				 Anda telah logout!
				</div>');
			redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

} // end auth php
