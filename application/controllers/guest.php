<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function home()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Home';
		$data['jenis_kost'] = $this->db->query('SELECT jenis_kost FROM tb_rekap_data_kost GROUP BY jenis_kost')->result();
		$data['harga_kost'] = $this->db->query('SELECT harga_kost FROM tb_rekap_data_kost GROUP BY harga_kost')->result();
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_guest/header_home', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('guest/home', $data);
		$this->load->view('templates_guest/footer_home');
	}

	public function f_data()
	{
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query('SELECT * FROM tb_rekap_data_kost')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($posts);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function f_filter1()
	{
		if($this->input->is_ajax_request()){
			$jenis_kost = $this->input->post('jenis_kost');
			$where = ['jenis_kost' => $jenis_kost];
			// $where = ['jenis_tanaman' => $jenis_tanaman];
			if($posts = $this->DataModel->edit_data($where, 'tb_rekap_data_kost')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($posts);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function f_filter2()
	{
		if($this->input->is_ajax_request()){
			$harga_kost = $this->input->post('harga_kost');
			if($harga_kost==1)
			{
				$A = 2000000;
				$B = 2500000;
			}elseif ($harga_kost==2) {
				$A = 2600000;
				$B = 3000000;
			}elseif ($harga_kost==3) {
				$A = 3100000;
				$B = 3500000;
			}elseif ($harga_kost==4) {
				$A = 3600000;
				$B = 4000000;
			}elseif ($harga_kost==5) {
				$A = 4100000;
				$B = 4500000;
			}elseif ($harga_kost==6) {
				$A = 4600000;
				$B = 5000000;
			}elseif ($harga_kost==7) {
				$A = 5100000;
				$B = 5500000;
			}else{
				$A = 5600000;
				$B = 9000000;
			}
			$where = ['harga_kost' => $harga_kost];
			// $where = ['jenis_tanaman' => $jenis_tanaman];
			if($posts = $this->db->query("SELECT * FROM tb_rekap_data_kost WHERE harga_kost BETWEEN '$A' AND '$B' ORDER BY harga_kost ASC")->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($posts);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function f_filter3()
	{
		if($this->input->is_ajax_request()){
			$rute_ke_kampus = $this->input->post('rute_ke_kampus');
			if($rute_ke_kampus==1)
			{
				$A = 0.6;
				$B = 1;
			}elseif ($rute_ke_kampus==2) {
				$A = 1.1;
				$B = 1.5;
			}elseif ($rute_ke_kampus==3) {
				$A = 1.6;
				$B = 2;
			}elseif ($rute_ke_kampus==4) {
				$A = 2.1;
				$B = 2.5;
			}elseif ($rute_ke_kampus==5) {
				$A = 2.6;
				$B = 3;
			}else{
				$A = 3.1;
				$B = 5000000;
			}
			$where = ['rute_ke_kampus' => $rute_ke_kampus];
			// $where = ['jenis_tanaman' => $jenis_tanaman];
			if($posts = $this->db->query("SELECT * FROM tb_rekap_data_kost WHERE rute_ke_kampus BETWEEN '$A' AND '$B' ORDER BY rute_ke_kampus ASC")->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($posts);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function f_filter4()
	{
		$keyword = $this->input->post('keyword');
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query("SELECT * FROM tb_rekap_data_kost WHERE 
						nama_kost LIKE '%$keyword%' OR 
						jenis_kost LIKE '%$keyword%' OR 
						alamat_lengkap LIKE '%$keyword%' OR 
						harga_kost LIKE '%$keyword%' OR 
						rute_ke_kampus LIKE '%$keyword%'")->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($posts);
		}else{
			echo "No direct script access allowed";
		}
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

		

		$rangking = $this->db->query('SELECT * FROM tb_preferensi JOIN tb_rekap_data_kost ON tb_preferensi.id_rekap_data_kost = tb_rekap_data_kost.id_rekap_data_kost ORDER BY tb_preferensi.preferensi DESC')->result();	


		echo json_encode($rangking);
	}

	function detail($id)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Detail';
		$where = ['id_rekap_data_kost' => $id];
		$data['data'] = $this->DataModel->edit_data($where, 'tb_rekap_data_kost')->result();
		
		$this->load->view('templates_guest/header_home', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('guest/detail', $data);
		$this->load->view('templates_guest/footer_detail',$data);
	}

	public function cari_rute()
	{
		$latitude = $this->input->post('latitude');//43
		$longitude = $this->input->post('longitude');//79
		$id_rekap_data_kost = $this->input->post('id_rekap_data_kost');//79
		$id_simpul_akhir = 58;

		$T = $this->db->query("SELECT * FROM tb_simpul WHERE sLatitude = '$latitude' AND sLongitude ='$longitude' GROUP BY sLatitude")->result();

		foreach ($T as $key) {
			$id_simpul_awal = $key->id_simpul;
		}
		
		$Closed = [];

		array_push($Closed, $id_simpul_awal);

		$S = $this->db->query('SELECT * FROM tb_simpul WHERE id_simpul = '.$id_simpul_awal.'')->result();
		foreach ($S as $key) {
			$Slat = $key->sLatitude;
			$Slng = $key->sLongitude;
		}
		// batas
		$R = $this->db->query('SELECT * FROM tb_graph WHERE id_graphAwal = '.$id_simpul_awal.'')->result();
			$i=0;
			foreach ($R as $keyr) {
				$id_graphAkhir[$i] = $keyr->id_graphAkhir;
				$i++;
			}

		$b=0;
			$idn = [];
			for ($i=0; $i < count($Closed); $i++) { 
				for ($j=0; $j < count($id_graphAkhir); $j++) { 
					if ($Closed[$i]==$id_graphAkhir[$j]) {
						$idn[$b] = $id_graphAkhir[$j];
						$b++;						
					}
				}
				
			}

		// 	// empty($idn);

			if(!empty($idn))
			{
					$b=0;
				for ($i=0; $i < count($id_graphAkhir); $i++) { 
						if ($id_graphAkhir[$i] != $idn[0]) {
							$halo[$b] = $id_graphAkhir[$i];
							$b++;
						}
				}
			}else{
				for ($i=0; $i < count($id_graphAkhir); $i++) { 
					$halo[$i] = $id_graphAkhir[$i];
				}
			}					

		// 	// //  batas masalah...
			
			// $b=0;
			for ($i=0; $i < count($halo); $i++) {				
			
			 	$rPendek2 = $this->db->query('SELECT * FROM tb_simpul where id_simpul = '.$halo[$i].'')->result();
				foreach ($rPendek2 as $rp) {
					$Lt2[$i] = $rp->sLatitude;
					$Ln2[$i] = $rp->sLongitude;
					$id[$i] = $rp->id_simpul;
				
			 	} 
				
			}
			$A = $this->db->query('SELECT * FROM tb_simpul WHERE id_simpul = '.$id_simpul_akhir.'')->result();
		foreach ($A as $key) {
			$Alat = $key->sLatitude;
			$Alng = $key->sLongitude;
		}
			for ($i=0; $i < count($Lt2); $i++) { 
				$gn[$i] = (sqrt(pow(($Slat - $Lt2[$i]),2)+pow(($Slng - $Ln2[$i]),2))*111.322);
				$hn[$i] = 0;
				$fn[$i] = $gn[$i]+$hn[$i];
			}
		

		$rPendek = $this->db->query('SELECT * FROM tb_simpul')->result();
		$i=0;
		foreach ($rPendek as $key) {
			$id_simpul[$i] = $key->id_simpul;
			$lat[$i] = $key->sLatitude;
			$lng[$i] = $key->sLongitude;
			
			$i++;
		}		
		

		for ($i=0; $i < count($fn); $i++) { 
			if (min($fn) == $fn[$i]) {
				array_push($Closed, $id[$i]);
				$id2 = $id[$i];
			}
		}
		unset($id_graphAkhir);
			unset($rPendek1);
			unset($rp);
			unset($Lt1);
			unset($Ln1);
			unset($Lt2);
			unset($Ln2);
			unset($R);
			unset($keyr);
			if(!empty($idn))
			{
				unset($idn);
			}			
			// unset($idn2);
			unset($halo);
			unset($rPendek2);
			unset($rp);
			unset($id_new);
			unset($gc);
			unset($hc);
			unset($fc);
		
		$w = count($Closed);
		//while
		$x=0;
		while ($id2 != $id_simpul_akhir) {
		// while ($x <3) {
			$rPendek1 = $this->db->query('SELECT * FROM tb_simpul where id_simpul = '.$id2.'')->result();
			foreach ($rPendek1 as $rp) {
				$Lt1 = $rp->sLatitude; //41
				$Ln1 = $rp->sLongitude; //41
			}

			// // ini yang bermasalah ...

			$R = $this->db->query('SELECT * FROM tb_graph WHERE id_graphAwal = '.$id2.'')->result();
			$i=0;
			foreach ($R as $keyr) {
				$id_graphAkhir[$i] = $keyr->id_graphAkhir;
				$i++;
			}
			// // // batas masalah....

			// // Ini juga bermasalah
			$b=0;
			$idn = [];
			for ($i=0; $i < count($Closed); $i++) { 
				for ($j=0; $j < count($id_graphAkhir); $j++) { 
					if ($Closed[$i]==$id_graphAkhir[$j]) {
						$idn[$b] = $id_graphAkhir[$j];
						$b++;						
					}
				}
				
			}

			// // // empty($idn);

			if(!empty($idn))
			{
					$b=0;
				for ($i=0; $i < count($id_graphAkhir); $i++) { 
						if ($id_graphAkhir[$i] != $idn[0]) {
							$halo[$b] = $id_graphAkhir[$i];
							$b++;
						}
				}
			}else{
				for ($i=0; $i < count($id_graphAkhir); $i++) { 
					$halo[$i] = $id_graphAkhir[$i];
				}
			}					

			// //  batas masalah...
			
			// $b=0;
			for ($i=0; $i < count($halo); $i++) {				
			
			 	$rPendek2 = $this->db->query('SELECT * FROM tb_simpul where id_simpul = '.$halo[$i].'')->result();
				foreach ($rPendek2 as $rp) {
					$Lt2[$i] = $rp->sLatitude;
					$Ln2[$i] = $rp->sLongitude;
					$id_new[$i] = $rp->id_simpul;
				
			 	} 
				
			}

			for ($i=0; $i < count($Lt2); $i++) { 
				$gc[$i] = (sqrt(pow(($Lt1 - $Lt2[$i]),2)+pow(($Ln1 - $Ln2[$i]),2))*111.322);
				$hc[$i] = (sqrt(pow(($Alat - $Lt2[$i]),2)+pow(($Alng - $Ln2[$i]),2))*111.322);
				$fc[$i] =$gc[$i]+$hc[$i];
			}

			for ($i=0; $i < count($fc); $i++) { 
				if (min($fc) == $fc[$i]) {
					array_push($Closed, $id_new[$i]);
					$id2 = $id_new[$i];
				}
			}

			unset($id_graphAkhir);
			unset($rPendek1);
			unset($rp);
			unset($Lt1);
			unset($Ln1);
			unset($Lt2);
			unset($Ln2);
			unset($R);
			unset($keyr);
			if(!empty($idn))
			{
				unset($idn);
			}			
			// unset($idn2);
			unset($halo);
			unset($rPendek2);
			unset($rp);
			unset($id_new);
			unset($gc);
			unset($hc);
			unset($fc);

			
			$x++;
		}

		$id_marker[0] = $Closed[0];
		$b = count($Closed)-1;
		array_push($id_marker, $Closed[$b]);

		for ($i=0; $i < count($id_marker); $i++) { 
			$graphLat = $this->db->query('SELECT * FROM tb_simpul where id_simpul ='.$id_marker[$i].'')->result();

				foreach ($graphLat as $key) {
				 	$mlatitude[$i] = $key->sLatitude;
				 	$mlongitude[$i] = $key->sLongitude;
				} 
			}

		for ($i=0; $i < count($Closed); $i++) { 
			$graphLat = $this->db->query('SELECT * FROM tb_simpul where id_simpul ='.$Closed[$i].'')->result();

				foreach ($graphLat as $key) {
				 	$rlatitude[$i] = $key->sLatitude;
				 	$rlongitude[$i] = $key->sLongitude;
				} 
			}
		
		for ($i=0; $i < count($mlatitude); $i++) { 
			$marker[] = [
				'mlatitude' => $mlatitude[$i],
				'mlongitude' => $mlongitude[$i]
			];
		}

		for ($i=0; $i < count($rlatitude); $i++) { 
			$kordinat[] = [
				'rlatitude' => $rlatitude[$i],
				'rlongitude' => $rlongitude[$i]
			];
		}

		$jarak = array_sum($fn);

		$data = ['marker' => $marker, 'kordinat' => $kordinat, 'jarak' => $jarak];
		

		echo json_encode($data);
	}
}