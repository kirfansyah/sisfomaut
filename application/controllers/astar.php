<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Astar extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function simpul()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Simpul';
		$data['posts'] = $this->db->query('SELECT * FROM tb_simpul')->result();
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('astar/simpul', $data);
		$this->load->view('templates_astar/footer');
	}

	public function graph()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Graph';
		$data['posts'] = $this->db->query('SELECT * FROM tb_simpul')->result();
		$data['graph'] = $this->db->query('SELECT * FROM tb_graph')->result();
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('astar/graph', $data);
		$this->load->view('templates_astar/footer_graph',$data);
	}

	public function f_simpul()
	{
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query('SELECT * FROM tb_simpul')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function f_graph2()
	{
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query('SELECT * FROM tb_simpul')->result()){

				if($posts2 = $this->db->query('SELECT * FROM tb_graph')->result()){
					$i=0;
				foreach ($posts2 as $key ) {
					$id_graphAwal[$i] = $key->id_graphAwal;
					$id_graphAkhir[$i] = $key->id_graphAkhir;
					// $id[$i] = $key->id_graphAwal.','.$key->id_graphAkhir;
					$i++;					
					}

					for ($i=0; $i < count($id_graphAwal); $i++) { 
					$graphLat = $this->db->query('SELECT * FROM tb_simpul where id_simpul ='.$id_graphAwal[$i].'')->result();

						foreach ($graphLat as $key) {
						 	$latitude[$i] = $key->sLatitude;
						 	$longitude[$i] = $key->sLongitude;
						} 
					}
					for ($i=0; $i < count($id_graphAkhir); $i++) { 
						$graphLng = $this->db->query('SELECT * FROM tb_simpul where id_simpul ='.$id_graphAkhir[$i].'')->result();

						foreach ($graphLng as $key) {
						 	$latitude2[$i] = $key->sLatitude;
						 	$longitude2[$i] = $key->sLongitude;
						} 
					}
					
					for ($i=0; $i < count($latitude); $i++) { 
						$kordinat[] = [
							'latitude' => $latitude[$i],
							'longitude' => $longitude[$i],
							'latitude2' => $latitude2[$i],
							'longitude2' => $longitude2[$i],
						];
					}
				}else{
					$kordinat = '';
				}				
				
				$data = ['responce' => 'success', 'posts' => [$kordinat, $posts]];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function f_graph()
	{
		if($this->input->is_ajax_request()){
			if($posts = $this->db->query('SELECT * FROM tb_graph')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function t_simpul()
	{
		$nama_simpul = htmlspecialchars($this->input->post('nama_simpul'));
		$sLatitude = htmlspecialchars($this->input->post('sLatitude'));
		$sLongitude = htmlspecialchars($this->input->post('sLongitude'));
		

		if($nama_simpul==''){
			$result['pesan'] = "Nama simpul harus diisi";
		}elseif ($sLatitude=='') {
			$result['pesan'] = "Latitude harus diisi";
		}elseif ($sLongitude=='') {
			$result['pesan'] = "Longitude harus diisi";
		}else{
			$result['pesan'] = "";

		$data = [
			'nama_simpul' => $nama_simpul,
			'sLatitude' => $sLatitude,
			'sLongitude' => $sLongitude
		];

			$this->adminmodel->tambahdata($data, 'tb_simpul');
		}
		echo json_encode($result);	
	}

	public function t_graph()
	{
		$graphAwal = $this->input->post('graphAwal');
		$graphAkhir = $this->input->post('graphAkhir');

		// for ($i=0; $i < count($graphAwal); $i++) { 
		// 	$grA[$i] = explode('|', floatval($graphAwal[$i]));
		// }

		$grA = explode(',', $graphAwal);
		$grAk = explode(',', $graphAkhir);

		for ($i=0; $i < 2 ; $i++) { 
			if($i==0)
			{
				$id[$i] = intval($grA[2]);
			}else{
				$id[$i] += $grAk[2];
			}
			var_dump($id[$i]);
		}

		for ($i=0; $i < count($id); $i++) { 
			$nama_simpul = $this->db->query('SELECT * FROM tb_simpul where id_simpul ='.$id[$i].'')->result();
			foreach ($nama_simpul as $key) {
				$nama[$i] = $key->nama_simpul;
			}
		}
		

		$jarak = sqrt(pow(($grA[0]-$grAk[0]),2)+pow(($grA[1]-$grAk[1]),2))*111.322;

		if($graphAwal==''){
			$result['pesan'] = "Nama simpul harus diisi";
		}elseif ($graphAkhir=='') {
			$result['pesan'] = "Latitude harus diisi";
		}else{
			$result['pesan'] = "";

		$data = [
			'graphAwal' => $nama[0],
			'graphAkhir' => $nama[1],
			'graphJarak' => $jarak,
			'id_graphAwal' => $id[0],
			'id_graphAkhir' => $id[1]
		];

		$data2 = [
			'graphAwal' => $nama[1],
			'graphAkhir' => $nama[0],
			'graphJarak' => $jarak,
			'id_graphAwal' => $id[1],
			'id_graphAkhir' => $id[0]
		];

			$this->adminmodel->tambahdata($data, 'tb_graph');
			$this->adminmodel->tambahdata($data2, 'tb_graph');
		}
		echo json_encode($id);	
	}

	public function del_simpul()
	{
		$id = $this->input->post('del_id');
		$where = ['id_simpul'=> $id];	

		$this->DataModel->hapus_data($where,'tb_simpul');
		$data = 'success';
		json_encode($data);
	}

	public function del_graph()
	{
		$id = $this->input->post('del_id');
		$where = ['id_graph'=> $id];	

		$this->DataModel->hapus_data($where,'tb_graph');
		$data = 'success';
		json_encode($data);
	}

	public function rute()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Cari Rute';
		$data['posts'] = $this->db->query('SELECT * FROM tb_simpul')->result();
		// $data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('astar/rute', $data);
		$this->load->view('templates_astar/footer_rute');
	}

	public function cari_rute()
	{
		$id_simpul_awal = $this->input->post('titik_awal');//43
		$id_simpul_akhir = $this->input->post('titik_akhir');//79
		
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
				$hn[$i] = (sqrt(pow(($Alat - $Lt2[$i]),2)+pow(($Alng - $Ln2[$i]),2))*111.322);
				$fn[$i] = $gn[$i]+$hn[$i];
			}

		// // batas ..................................................................................
		
		// $A = $this->db->query('SELECT * FROM tb_simpul WHERE id_simpul = '.$id_simpul_akhir.'')->result();
		// foreach ($A as $key) {
		// 	$Alat = $key->sLatitude;
		// 	$Alng = $key->sLongitude;
		// }

		$rPendek = $this->db->query('SELECT * FROM tb_simpul')->result();
		$i=0;
		foreach ($rPendek as $key) {
			$id_simpul[$i] = $key->id_simpul;
			$lat[$i] = $key->sLatitude;
			$lng[$i] = $key->sLongitude;
			
			$i++;
		}
		// $a=0;
		// for ($i=0; $i < count($id_simpul); $i++) { 
		// 	if ($id_simpul[$i] != $id_simpul_awal && $id_simpul[$i] != $id_simpul_akhir) {
		// 		$gn[$a] = (sqrt(pow(($Slat - $lat[$i]),2)+pow(($Slng - $lng[$i]),2))*111.322);
		// 		$hn[$a] = (sqrt(pow(($Alat - $lat[$i]),2)+pow(($Alng - $lng[$i]),2))*111.322);
		// 		$fn[$a] =$gn[$a]+$hn[$a];
		// 		$id[$a] = $id_simpul[$i];
		// 	$a++;
		// 	}else{
		// 		$id_gn = $id_simpul[$i];
		// 	}
			
		// }
		

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

		// if(!empty($idn))
		// 	{
		// 		unset($idn);
		// 	}
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

			// // batas
			// 	$rPendek1 = $this->db->query('SELECT * FROM tb_simpul where id_simpul = '.$id2.'')->result();
			// foreach ($rPendek1 as $rp) {
			// 	$Lt1 = $rp->sLatitude; //41
			// 	$Ln1 = $rp->sLongitude; //41
			// }

			// // // ini yang bermasalah ...

			// $R = $this->db->query('SELECT * FROM tb_graph WHERE id_graphAwal = '.$id2.'')->result();
			// $i=0;
			// foreach ($R as $keyr) {
			// 	$id_graphAkhir[$i] = $keyr->id_graphAkhir;
			// 	$i++;
			// }
			// // // batas masalah....

			// // // // Ini juga bermasalah
			// $b=0;
			// $idn = [];
			// for ($i=0; $i < count($Closed); $i++) { 
			// 	for ($j=0; $j < count($id_graphAkhir); $j++) { 
			// 		if($Closed[$i]==$id_graphAkhir[$j]) {
			// 			$idn[$b] = $id_graphAkhir[$j];
			// 			$b++;						
			// 		}else{
			// 			$idn2[$b] = $id_graphAkhir[$j];
			// 		}
			// 	}
				
			// }
			// // empty(!$idn);
			// if(!empty($idn))
			// {
			// 		$b=0;
			// 	for ($i=0; $i < count($id_graphAkhir); $i++) { 
			// 			if ($id_graphAkhir[$i] != $idn[0]) {
			// 				$halo[$b] = $id_graphAkhir[$i];
			// 				$b++;
			// 			}
			// 	}
			// }else{
			// 	for ($i=0; $i < count($id_graphAkhir); $i++) { 
			// 		$halo[$i] = $id_graphAkhir[$i];
			// 	}
			// }					

			// // // //  batas masalah...
			
			// // $b=0;
			// for ($i=0; $i < count($halo); $i++) {				
			
			//  	$rPendek2 = $this->db->query('SELECT * FROM tb_simpul where id_simpul = '.$halo[$i].'')->result();
			// 	foreach ($rPendek2 as $rp) {
			// 		$Lt2[$i] = $rp->sLatitude;
			// 		$Ln2[$i] = $rp->sLongitude;
			// 		$id_new[$i] = $rp->id_simpul;
				
			//  	} 
				
			// }

			// for ($i=0; $i < count($Lt2); $i++) { 
			// 	$gc[$i] = (sqrt(pow(($Lt1 - $Lt2[$i]),2)+pow(($Ln1 - $Ln2[$i]),2))*111.322);
			// 	$hc[$i] = (sqrt(pow(($Alat - $Lt2[$i]),2)+pow(($Alng - $Ln2[$i]),2))*111.322);
			// 	$fc[$i] =$gc[$i]+$hc[$i];
			// }

			// for ($i=0; $i < count($fc); $i++) { 
			// 	if (min($fc) == $fc[$i]) {
			// 		array_push($Closed, $id_new[$i]);
			// 		$id2 = $id_new[$i];
			// 	}
			// }
			// batas
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

		
		$data = ['marker' => $marker, 'kordinat' => $kordinat];
		

		echo json_encode($data);
	}
}