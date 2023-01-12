<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maut extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{ 
		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Rekap Data';
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('maut/rekap_data', $data);
		$this->load->view('templates_admin/footer');
	}

	public function kriteria_kost()
	{ 
		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Kriteria Kost';
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('maut/kriteria_kost', $data);
		$this->load->view('templates_admin/footer_kriteria');
	}

	public function f_rekap_data()
	{
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query('SELECT * FROM tb_rekap_data_kost')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function t_data_rekap()
	{
		$nama_kost = htmlspecialchars($this->input->post('nama_kost'));
		$jenis_kost = htmlspecialchars($this->input->post('jenis_kost'));
		$alamat_lengkap = htmlspecialchars($this->input->post('alamat_lengkap'));
		$harga_kost = htmlspecialchars($this->input->post('harga_kost'));
		$rute_ke_kampus = htmlspecialchars($this->input->post('rute_ke_kampus'));
		$kondisi_air = htmlspecialchars($this->input->post('kondisi_air'));
		$luas_kamar = htmlspecialchars($this->input->post('luas_kamar'));
		$letak_kamar_mandi = htmlspecialchars($this->input->post('letak_kamar_mandi'));
		$dapur = htmlspecialchars($this->input->post('dapur'));
		$wifi = htmlspecialchars($this->input->post('wifi'));
		$garasi = htmlspecialchars($this->input->post('garasi'));
		$latitude = htmlspecialchars($this->input->post('latitude'));
		$longitude = htmlspecialchars($this->input->post('longitude'));
		$narahubung = htmlspecialchars($this->input->post('narahubung'));

		$upload_image = $_FILES['image'];

		if($upload_image){
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['upload_path'] = realpath(FCPATH.'/assets/img/kostpict');

			$this->load->library('upload');
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){

				$old_image = $data['user']['image'];
				if($old_image != 'default.jpg'){
					unlink(FCPATH.'assets/img/kostpict/'.$old_image);
				}
				$new_image = $this->upload->data('file_name');
				// $this->db->set('image', $new_image);
			}else{
				$new_image = '';					
				
			}
		}

		if($nama_kost==''){
			$result['pesan'] = "Nama kost harus diisi";
		}elseif ($jenis_kost=='') {
			$result['pesan'] = "Jenis Kost harus diisi";
		}elseif ($alamat_lengkap=='') {
			$result['pesan'] = "Alamat Lengkap harus diisi";
		}elseif ($harga_kost=='') {
			$result['pesan'] = "Harga Kost harus diisi";
		}elseif ($rute_ke_kampus=='') {
			$result['pesan'] = "Rute ke Kampus harus diisi";
		}elseif ($kondisi_air=='') {
			$result['pesan'] = "Kondisi Air harus diisi";
		}elseif ($luas_kamar=='') {
			$result['pesan'] = "Luas Kamar diisi";
		}elseif ($letak_kamar_mandi=='') {
			$result['pesan'] = "Letak Kamar mandi harus diisi";
		}elseif ($dapur=='') {
			$result['pesan'] = "Dapur harus diisi";
		}elseif ($wifi=='') {
			$result['pesan'] = "WIFI harus diisi";
		}elseif ($garasi=='') {
			$result['pesan'] = "Garasi harus diisi";
		}elseif ($latitude=='') {
			$result['pesan'] = "latitude harus diisi";
		}elseif ($longitude=='') {
			$result['pesan'] = "longitude harus diisi";
		}elseif ($new_image=='') {
			$result['pesan'] = "harus diisi";
		}else{
			$result['pesan'] = "";

		$data = [
			'nama_kost' => $nama_kost,
			'jenis_kost' => $jenis_kost,
			'alamat_lengkap' => $alamat_lengkap,
			'harga_kost' => $harga_kost,
			'rute_ke_kampus' => $rute_ke_kampus,
			'kondisi_air' => $kondisi_air,
			'luas_kamar' => $luas_kamar,
			'letak_kamar_mandi' => $letak_kamar_mandi,
			'dapur' => $dapur,
			'wifi' => $wifi,
			'garasi' => $garasi,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'narahubung' => $narahubung,
			'gambar' => $new_image
		];

			$this->adminmodel->tambahdata($data, 'tb_rekap_data_kost');
		}
		echo json_encode($result);		
	}

	public function edit_data_rekap()
	{
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');

			if($posts[]=$this->db->query('SELECT * FROM tb_rekap_data_kost WHERE id_rekap_data_kost = '.$id.'')->result()){
				
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function u_data_rekap()
	{
		if($this->input->is_ajax_request()){
			
			$id_rekap_data_kost = htmlspecialchars($this->input->post('id_rekap_data_kost'));
			$nama_kost = htmlspecialchars($this->input->post('nama_kost2'));
			$jenis_kost = htmlspecialchars($this->input->post('jenis_kost2'));
			$alamat_lengkap = htmlspecialchars($this->input->post('alamat_lengkap2'));
			$harga_kost = htmlspecialchars($this->input->post('harga_kost2'));
			$rute_ke_kampus = htmlspecialchars($this->input->post('rute_ke_kampus2'));
			$kondisi_air = htmlspecialchars($this->input->post('kondisi_air2'));
			$luas_kamar = htmlspecialchars($this->input->post('luas_kamar2'));
			$letak_kamar_mandi = htmlspecialchars($this->input->post('letak_kamar_mandi2'));
			$dapur = htmlspecialchars($this->input->post('dapur2'));
			$wifi = htmlspecialchars($this->input->post('wifi2'));
			$garasi = htmlspecialchars($this->input->post('garasi2'));
			$latitude = htmlspecialchars($this->input->post('latitude2'));
			$longitude = htmlspecialchars($this->input->post('longitude2'));
			$narahubung = htmlspecialchars($this->input->post('narahubung2'));

			$upload_image = $_FILES['image2'];

			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['upload_path'] = realpath(FCPATH.'/assets/img/kostpict');

				$this->load->library('upload');
				$this->upload->initialize($config);

				if($this->upload->do_upload('image2')){

					$old_image = $data['user']['image2'];
					if($old_image != 'default.jpg'){
						unlink(FCPATH.'assets/img/kostpict/'.$old_image);
					}
					$new_image = $this->upload->data('file_name');
					// $this->db->set('image', $new_image);
				}else{
					$new_image = '';					
					
				}
			}

			$where = array('id_rekap_data_kost' => $id_rekap_data_kost);

			$data = [
			'nama_kost' => $nama_kost,
			'jenis_kost' => $jenis_kost,
			'alamat_lengkap' => $alamat_lengkap,
			'harga_kost' => $harga_kost,
			'rute_ke_kampus' => $rute_ke_kampus,
			'kondisi_air' => $kondisi_air,
			'luas_kamar' => $luas_kamar,
			'letak_kamar_mandi' => $letak_kamar_mandi,
			'dapur' => $dapur,
			'wifi' => $wifi,
			'garasi' => $garasi,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'narahubung' => $narahubung,
			'gambar' => $new_image
		];
	
			$this->DataModel->update_data($where, $data, 'tb_rekap_data_kost');

			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function del_data_rekap()
	{
		$id = $this->input->post('del_id');
		$where = ['id_rekap_data_kost'=> $id];	

		$this->DataModel->hapus_data($where,'tb_rekap_data_kost');
		$data = 'success';
		json_encode($data);
	}

	public function detail_data_rekap($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Detail Data';
		$where = ['id_rekap_data_kost' => $id];
		$data['detail'] = $this->DataModel->edit_data($where,'tb_rekap_data_kost')->result();
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('maut/detail', $data);
		$this->load->view('templates_admin/footer');
	}

	public function pembobotank()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Pembobotan Alternatif';
		$data['pembobotan'] = $this->db->query('SELECT * FROM tb_pembobotan_kriteria')->result();
		// $data['pembobitan'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('maut/pembobotan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function f_pembobotan_k()
	{
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query('SELECT * FROM tb_pembobotan_kriteria')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function f_solusi()
	{
		if($this->input->is_ajax_request()){
			$id_rekap_data_kost = $this->input->post('id_rekap_data_kost');
			$where = ['id_rekap_data_kost' => $id_rekap_data_kost];
			if($posts = $this->DataModel->edit_data($where,'tb_rekap_data_kost')->result()){
				foreach ($posts as $p) 
				{
					$id_rekap_data_kost = $p->id_rekap_data_kost;
					$nama_kost = $p->nama_kost;
					$jenis_kost = $p->jenis_kost;

				}
				$posts[0] = $id_rekap_data_kost;
				$posts[1] = $nama_kost;
				$posts[2] = $jenis_kost;
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function t_pembobotan_k()
	{
		$id_rekap_data_kost = htmlspecialchars($this->input->post('id_rekap_data_kost4'));
		$nama_kost = htmlspecialchars($this->input->post('nama_kost4'));
		$jenis_kost = htmlspecialchars($this->input->post('jenis_kost4'));
		$harga_kost = htmlspecialchars($this->input->post('harga_kost4'));
		$rute_ke_kampus = htmlspecialchars($this->input->post('rute_ke_kampus4'));
		$kondisi_air = htmlspecialchars($this->input->post('kondisi_air4'));
		$luas_kamar = htmlspecialchars($this->input->post('luas_kamar4'));
		$letak_kamar_mandi = htmlspecialchars($this->input->post('letak_kamar_mandi4'));
		$dapur = htmlspecialchars($this->input->post('dapur4'));
		$wifi = htmlspecialchars($this->input->post('wifi4'));
		$garasi = htmlspecialchars($this->input->post('garasi4'));

		

		if($nama_kost==''){
			$result['pesan'] = "Nama kost harus diisi";
		}elseif ($jenis_kost=='') {
			$result['pesan'] = "Jenis Kost harus diisi";
		}elseif ($harga_kost=='') {
			$result['pesan'] = "Harga Kost harus diisi";
		}elseif ($rute_ke_kampus=='') {
			$result['pesan'] = "Rute ke Kampus harus diisi";
		}elseif ($kondisi_air=='') {
			$result['pesan'] = "Kondisi Air harus diisi";
		}elseif ($luas_kamar=='') {
			$result['pesan'] = "Luas Kamar diisi";
		}elseif ($letak_kamar_mandi=='') {
			$result['pesan'] = "Letak Kamar mandi harus diisi";
		}elseif ($dapur=='') {
			$result['pesan'] = "Dapur harus diisi";
		}elseif ($wifi=='') {
			$result['pesan'] = "WIFI harus diisi";
		}elseif ($garasi=='') {
			$result['pesan'] = "Garasi harus diisi";
		}else{
			$result['pesan'] = "";

		$data = [
			'id_rekap_data_kost' => $id_rekap_data_kost,
			'nama_kost' => $nama_kost,
			'jenis_kost' => $jenis_kost,
			'harga_kost' => $harga_kost,
			'rute_ke_kampus' => $rute_ke_kampus,
			'kondisi_air' => $kondisi_air,
			'luas_kamar' => $luas_kamar,
			'letak_kamar_mandi' => $letak_kamar_mandi,
			'dapur' => $dapur,
			'wifi' => $wifi,
			'garasi' => $garasi
		];

			$this->adminmodel->tambahdata($data, 'tb_pembobotan_kriteria');
		}
		echo json_encode($result);		
	}

	public function edit_pembobotan_k()
	{
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');

			if($posts[]=$this->db->query('SELECT * FROM tb_pembobotan_kriteria WHERE id_pembobotan = '.$id.'')->result()){
				
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function u_pembobotan_k()
	{
		if($this->input->is_ajax_request()){
			
			$id_rekap_data_kost = htmlspecialchars($this->input->post('id_rekap_data_kost5'));
			$id_pembobotan = htmlspecialchars($this->input->post('id_pembobotan5'));
			$nama_kost = htmlspecialchars($this->input->post('nama_kost5'));
			$jenis_kost = htmlspecialchars($this->input->post('jenis_kost5'));
			
			$harga_kost = htmlspecialchars($this->input->post('harga_kost5'));
			$rute_ke_kampus = htmlspecialchars($this->input->post('rute_ke_kampus5'));
			$kondisi_air = htmlspecialchars($this->input->post('kondisi_air5'));
			$luas_kamar = htmlspecialchars($this->input->post('luas_kamar5'));
			$letak_kamar_mandi = htmlspecialchars($this->input->post('letak_kamar_mandi5'));
			$dapur = htmlspecialchars($this->input->post('dapur5'));
			$wifi = htmlspecialchars($this->input->post('wifi5'));
			$garasi = htmlspecialchars($this->input->post('garasi5'));
			
			$where = array('id_pembobotan' => $id_pembobotan);

			$data = [
			'id_pembobotan' => $id_pembobotan,
			'nama_kost' => $nama_kost,
			'jenis_kost' => $jenis_kost,
			'harga_kost' => $harga_kost,
			'rute_ke_kampus' => $rute_ke_kampus,
			'kondisi_air' => $kondisi_air,
			'luas_kamar' => $luas_kamar,
			'letak_kamar_mandi' => $letak_kamar_mandi,
			'dapur' => $dapur,
			'wifi' => $wifi,
			'garasi' => $garasi
		];
	
			$this->DataModel->update_data($where, $data, 'tb_pembobotan_kriteria');

			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function del_pembobotan_k()
	{
		$id = $this->input->post('del_id');
		$where = ['id_pembobotan'=> $id];	

		$this->DataModel->hapus_data($where,'tb_pembobotan_kriteria');
		$data = 'success';
		json_encode($data);
	}

	public function bobot()
	{ 
		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Bobot Kriteria';
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('maut/bobot', $data);
		$this->load->view('templates_admin/footer');
	}

	public function f_bobot()
	{
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query('SELECT * FROM tb_bobot_kriteria')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function t_bobot()
	{
		$kriteria_kost = htmlspecialchars($this->input->post('kriteria_kost'));
		$bobot = htmlspecialchars($this->input->post('bobot'));

		if($kriteria_kost==''){
			$result['pesan'] = "Kriteria kost harus diisi";
		}elseif ($bobot=='') {
			$result['pesan'] = "Bobot harus diisi";
		}else{
			$result['pesan'] = "";

		$data = [
			'kriteria_kost' => $kriteria_kost,
			'bobot' => $bobot
		];

			$this->adminmodel->tambahdata($data, 'tb_bobot_kriteria');
		}
		echo json_encode($result);		
	}

	public function edit_bobot()
	{
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');

			if($posts[]=$this->db->query('SELECT * FROM tb_bobot_kriteria WHERE id_bobot_k = '.$id.'')->result()){
				
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function u_bobot()
	{
		if($this->input->is_ajax_request()){
			
			$id_bobot_k = htmlspecialchars($this->input->post('id_bobot_k'));
			$kriteria_kost = htmlspecialchars($this->input->post('kriteria_kost2'));
			$bobot = htmlspecialchars($this->input->post('bobot2'));

			$where = array('id_bobot_k' => $id_bobot_k);

			$data = [
			'kriteria_kost' => $kriteria_kost,
			'bobot' => $bobot
		];
	
			$this->DataModel->update_data($where, $data, 'tb_bobot_kriteria');

			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}
	
	public function perhitungan()
	{  
		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Perhitungan Maut';
		$data['lokasi'] = $this->db->query('SELECT * FROM tb_rekap_data_kost')->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('maut/perhitungan', $data);
		$this->load->view('templates_admin/footer');
	}

	public function perhitungan_m()
	{
		$data_bobot = $this->DataModel->gets('tb_bobot_kriteria')->result();

		$i=0;
		foreach ($data_bobot as $datbot)
		{
			$bobot[$i] = $datbot->bobot;		 	
		 	$i++;
		}

		$factor = array_sum($bobot);

		$wc1 = $bobot[0]/$factor; 
		$wc2 = $bobot[1]/$factor; 
		$wc3 = $bobot[2]/$factor; 
		$wc4 = $bobot[3]/$factor; 
		$wc5 = $bobot[4]/$factor; 
		$wc6 = $bobot[5]/$factor; 
		$wc7 = $bobot[6]/$factor; 
		$wc8 = $bobot[7]/$factor; 

		$pembobotan = $this->DataModel->gets('tb_pembobotan_kriteria')->result();

		$i=0;
		foreach ($pembobotan as $pb) 
		{
			$nama_kost[$i] = $pb->nama_kost;
			$jenis_kost[$i] = $pb->jenis_kost;
			$id_rekap_data_kost[$i] = $pb->id_rekap_data_kost;
			$harga_kost[$i] = $pb->harga_kost;
			$rute_ke_kampus[$i] = $pb->rute_ke_kampus;
			$kondisi_air[$i] = $pb->kondisi_air;
			$luas_kamar[$i] = $pb->luas_kamar;
			$letak_kamar_mandi[$i] = $pb->letak_kamar_mandi;
			$dapur[$i] = $pb->dapur;
			$wifi[$i] = $pb->wifi;
			$garasi[$i] = $pb->garasi;

			$i++;
		}

		$minHargaKost = min($harga_kost);
		$minRuteKampus = min($rute_ke_kampus);
		$minKondisi_air = min($kondisi_air);
		$minLuasKamar = min($luas_kamar);
		$minLetakKamarMandi = min($letak_kamar_mandi);
		$minDapur = min($dapur);
		$minWifi = min($wifi);
		$minGarasi = min($garasi);

		$maxHargaKost = max($harga_kost);
		$maxRuteKampus = max($rute_ke_kampus);
		$maxKondisi_air = max($kondisi_air);
		$maxLuasKamar = max($luas_kamar);
		$maxLetakKamarMandi = max($letak_kamar_mandi);
		$maxDapur = max($dapur);
		$maxWifi = max($wifi);
		$maxGarasi = max($garasi);

		for ($i=0; $i < count($id_rekap_data_kost); $i++) 
		{ 
			$new_Harga_Kost[$i] = ($harga_kost[$i]-$minHargaKost)/($maxHargaKost-$minHargaKost);
			$new_Rute_Ke_Kampus[$i] = ($rute_ke_kampus[$i]-$minRuteKampus)/($maxRuteKampus-$minRuteKampus);
			$new_Kondisi_Air[$i] = ($kondisi_air[$i]-$minKondisi_air)/($maxKondisi_air-$minKondisi_air);

			$new_Luas_Kamar[$i] = ($luas_kamar[$i]-$minLuasKamar)/($maxLuasKamar-$minLuasKamar);
			$new_Letak_kamar_mandi[$i] = ($letak_kamar_mandi[$i]-$minLetakKamarMandi)/($maxLetakKamarMandi-$minLetakKamarMandi);

			$new_Dapur[$i] = ($dapur[$i]-$minDapur)/($maxDapur-$minDapur);
			$new_Wifi[$i] = ($wifi[$i]-$minWifi)/($maxWifi-$minWifi);
			$new_Garasi[$i] = ($garasi[$i]-$minGarasi)/($maxGarasi-$minGarasi);

		}

		for ($i=0; $i < count($id_rekap_data_kost); $i++) 
		{ 
			$preferensi[$i] = ($wc1*$new_Harga_Kost[$i])+($wc2*$new_Rute_Ke_Kampus[$i])+($wc3*$new_Kondisi_Air[$i])+($wc4*$new_Luas_Kamar[$i])+($wc5*$new_Letak_kamar_mandi[$i])+($wc6*$new_Dapur[$i])+($wc7*$new_Wifi[$i])+($wc8*$new_Garasi[$i]);
		}

		$this->db->truncate('tb_preferensi');
		for ($i=0; $i < count($id_rekap_data_kost); $i++) 
		{ 
			$data_b[] = [

				'id_rekap_data_kost' => $id_rekap_data_kost[$i],
				'preferensi' => $preferensi[$i]

			];
		}
		$this->DataModel->insert_batch_data($data_b, 'tb_preferensi');

		$html = '<div class="card shadow mb-4">';
		$html .= '<div class="card-body">';
		$html .= '<center><h1>PEMBOBOTAN</h1></center>';
		$html .= '<div class="table-responsive">';
		$html .= '<table class="table table-bordered" id="dataTable">';
		$html .= '<thead>
		            <tr>
		              <th>No</th>
		              <th>Nama Kost</th>            
		              <th>Harga Kost</th>
		              <th>Jarak Ke Kampus</th>
		              <th>Kondisi Air</th>
		              <th>Luas Kamar</th>
		              <th>Letak Kamar Mandi</th>
		              <th>Dapur</th>
		              <th>Wifi</th>
		              <th>Garasi</th>
		            </tr>
		          </thead>';
		$html .= '<tbody>';
		$a=1;
		foreach ($pembobotan as $pb) 
		{
			$html .= '<tr>
						<td>'.$a++.'</td>
						<td>'.$pb->nama_kost.'</td>
						<td>'.$pb->harga_kost.'</td>
						<td>'.$pb->rute_ke_kampus.'</td>
						<td>'.$pb->kondisi_air.'</td>
						<td>'.$pb->luas_kamar.'</td>
						<td>'.$pb->letak_kamar_mandi.'</td>
						<td>'.$pb->dapur.'</td>
						<td>'.$pb->wifi.'</td>
						<td>'.$pb->garasi.'</td>
					</tr>';
			
		}

			       
		$html .='</tbody>';
		$html .='</table>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';

		$html .= '<div class="card shadow mb-4">';
		$html .= '<div class="card-body">';
		$html .= '<center><h1>NILAI MIN DAN MAX</h1></center>';
		$html .= '<div class="table-responsive">';

		$html .= '<table class="table table-bordered" id="dataTable">';
		$html .= '<thead>
		            <tr>
		              <th></th>
		              <th>Harga Kost</th>
		              <th>Lokasi Ke kampus</th>             
		              <th>Kondisi Air</th>
		              <th>Luas Kamar</th>
		              <th>Letak Kamar Mandi</th>
		              <th>Dapur</th>
		              <th>Wifi</th>
		              <th>Garasi</th>
		            </tr>
		          </thead>';
		$html .= '<tbody>';

		$html .= '  <tr>
		              <th>Max</th>
		              <th>'.$maxHargaKost.'</th>
		              <th>'.$maxRuteKampus.'</th>             
		              <th>'.$maxKondisi_air.'</th>
		              <th>'.$maxLuasKamar.'</th>
		              <th>'.$maxLetakKamarMandi.'</th>
		              <th>'.$maxDapur.'</th>
		              <th>'.$maxWifi.'</th>
		              <th>'.$maxGarasi.'</th>
		            </tr>';		           

	    $html .= '  <tr>
				      <th>Min</th>
				      <th>'.$minHargaKost.'</th>
		              <th>'.$minRuteKampus.'</th>             
		              <th>'.$minKondisi_air.'</th>
		              <th>'.$minLuasKamar.'</th>
		              <th>'.$minLetakKamarMandi.'</th>
		              <th>'.$minDapur.'</th>
		              <th>'.$minWifi.'</th>
		              <th>'.$minGarasi.'</th>
				    </tr>';

		$html .='</tbody>';
		$html .='</table>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';

		$html .= '<div class="card shadow mb-4">';
		$html .= '<div class="card-body">';
		$html .= '<center><h1>NILAI UTILITAS</h1></center>';
		$html .= '<div class="table-responsive">';
		$html .= '<table class="table table-bordered" id="dataTable">';
		$html .= '<thead>
		            <tr>
		              <th>No</th>          
		              <th>Nama Kost</th>          
		              <th>Harga Kost</th>
		              <th>Jarak Ke Kampus</th>
		              <th>Kondisi Air</th>
		              <th>Luas Kamar</th>
		              <th>Letak Kamar Mandi</th>
		              <th>Dapur</th>
		              <th>Wifi</th>
		              <th>Garasi</th>
		            </tr>
		          </thead>';
		$html .= '<tbody>';

		$a=1;
		for ($i=0; $i < count($id_rekap_data_kost); $i++) 
		{

			$html .= '<tr>
						<td>'.$a++.'</td>
						<td>'.$nama_kost[$i].'</td>
						<td>'.$new_Harga_Kost[$i].'</td>
						<td>'.$new_Rute_Ke_Kampus[$i].'</td>
		 				<td>'.$new_Kondisi_Air[$i].'</td>
						<td>'.$new_Luas_Kamar[$i].'</td>
		 				<td>'.$new_Letak_kamar_mandi[$i].'</td>
		 				<td>'.$new_Dapur[$i].'</td>
		 				<td>'.$new_Wifi[$i].'</td>
		 				<td>'.$new_Garasi[$i].'</td>
					</tr>';

		}		

		$html .='</tbody>';
		$html .='</table>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';

		$html .= '<div class="card shadow mb-4">';
		$html .= '<div class="card-body">';
		$html .= '<center><h1>NORMALISASI BOBOT</h1></center>';
		$html .= '<div class="table-responsive">';
		$html .= '<table class="table table-bordered" id="dataTable">';
		$html .= '<thead>
		            <tr>
		              <th>Kriteria</th>          
		              <th>Harga Kost</th>
		              <th>Jarak Ke Kampus</th>
		              <th>Kondisi Air</th>
		              <th>Luas Kamar</th>
		              <th>Letak Kamar Mandi</th>
		              <th>Dapur</th>
		              <th>Wifi</th>
		              <th>Garasi</th>
		              <th>Total</th>
		            </tr>
		          </thead>';
		
		$html .= '<tr>
						<th>Weight</th>
						<td>'.$wc1.'</td>						
						<td>'.$wc2.'</td>						
						<td>'.$wc3.'</td>						
						<td>'.$wc4.'</td>						
						<td>'.$wc5.'</td>						
						<td>'.$wc6.'</td>						
						<td>'.$wc7.'</td>						
						<td>'.$wc8.'</td>						
						<th>1</th>						
					</tr>';
		
		$html .='</table>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';

		$html .= '<div class="card shadow mb-4">';
		$html .= '<div class="card-body">';
		$html .= '<center><h1>NILAI PREFERENSI</h1></center>';
		$html .= '<div class="table-responsive">';
		$html .= '<table class="table table-bordered" id="dataTable">';
		$html .= '<thead>
		            <tr>
		              <th>No</th>          
		              <th>Nama Kost</th>
		              <th>Preferensi</th>
		            </tr>
		          </thead>';
		$a=1;
		for ($i=0; $i < count($id_rekap_data_kost); $i++) 
		{

			$html .= '<tr>
						<td>'.$a++.'</td>
						<td>'.$nama_kost[$i].'</td>
		 				<td>'.$preferensi[$i].'</td>
					</tr>';

		}

		$html .='</table>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';

		$rangking = $this->db->query('SELECT * FROM tb_preferensi JOIN tb_rekap_data_kost ON tb_preferensi.id_rekap_data_kost = tb_rekap_data_kost.id_rekap_data_kost ORDER BY tb_preferensi.preferensi DESC')->result();

		$html .= '<div class="card shadow mb-4">';
		$html .= '<div class="card-body">';
		$html .= '<center><h1>RANGKING</h1></center>';
		$html .= '<div class="table-responsive">';
		$html .= '<table class="table table-bordered" id="dataTable">';
		$html .= '<thead>
		            <tr>
		              <th>No</th>          
		              <th>Nama Kost</th>
		              <th>Rangking</th>
		            </tr>
		          </thead>';

		$html .= '<tbody>';
		$a=1;
		$b=1;
		foreach ($rangking as $pb) 
		{
			$html .= '<tr>
						<td>'.$a++.'</td>
						<td><a href="'.base_url('maut/detail_data_rekap/'.$pb->id_rekap_data_kost).'">'.$pb->nama_kost.'</a></td>
						<td>'.$b++.'</td>
					</tr>';
			
		}

			       
		$html .='</tbody>';
		$html .='</table>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';


		echo json_encode($html);
	}
}