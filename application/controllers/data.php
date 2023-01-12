<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller{
 
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('excel');
	}

	public function index()
	{ 
		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Tampil Data';
		$data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('admin/data', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahdata()
	{
		$nama_wilayah = htmlspecialchars($this->input->post('nama_wilayah'));
		$kode_wilayah = htmlspecialchars($this->input->post('kode_wilayah'));
		$luas_tanam = htmlspecialchars($this->input->post('luas_tanam'));
		$luas_panen = htmlspecialchars($this->input->post('luas_panen'));
		$produktivitas = htmlspecialchars($this->input->post('produktivitas'));
		$produksi = htmlspecialchars($this->input->post('produksi'));
		$tahun = htmlspecialchars($this->input->post('tahun'));
		$jenis_tanaman = htmlspecialchars($this->input->post('jenis_tanaman'));

		if($nama_wilayah==''){
			$result['pesan'] = "Nama wilayah harus diisi";
		}elseif ($kode_wilayah=='') {
			$result['pesan'] = "Kode Wilayah harus diisi";
		}elseif ($luas_tanam=='') {
			$result['pesan'] = "Luas tanam harus diisi";
		}elseif ($luas_panen=='') {
			$result['pesan'] = "Luas panen harus diisi";
		}elseif ($produktivitas=='') {
			$result['pesan'] = "Produktivitas harus diisi";
		}elseif ($produksi=='') {
			$result['pesan'] = "Produksi harus diisi";
		}elseif ($tahun=='') {
			$result['pesan'] = "Tahun harus diisi";
		}elseif ($jenis_tanaman=='') {
			$result['pesan'] = "Jenis Tanaman harus diisi";
		}else{
			$result['pesan'] = "";

			$data = array(
			'kode_wilayah' => $kode_wilayah,
			'nama_wilayah' => $nama_wilayah,
			'luas_tanam' => $luas_tanam,
			'luas_panen' => $luas_panen,
			'produktivitas' => $produktivitas,
			'nama_wilayah' => $nama_wilayah,
			'produksi' => $produksi,
			'tahun' => $tahun,
			'jenis_tanaman' => $jenis_tanaman,
		);

		$this->adminmodel->tambahdata($data, 'tb_data_panen');
		}

		echo json_encode($result); 
	}

	public function fetch()
	{
		if($this->input->is_ajax_request()){
			$jenis_tanaman = $this->input->post('jenis_tanaman');
			$where = ['jenis_tanaman' => $jenis_tanaman];
			if($posts = $this->DataModel->edit_data($where,'tb_data_panen')->result()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function hapusdata()
	{
		$id = $this->input->post('del_id');
		$where = array('id_wilayah'=> $id);	

		$this->DataModel->hapus_data($where,'tb_data_panen');
		$data = 'success'; 
		json_encode($data);
	}

	public function edit()
	{
		if($this->input->is_ajax_request()){
			$id = $this->input->post('id');

			if($posts=$this->db->query('SELECT * FROM tb_rekap_data_kost WHERE id_rekap_data_kost = '.$id.'')->result_array()){
				
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function update()
	{
		if($this->input->is_ajax_request()){
			
			$id_wilayah = $this->input->post('id_wilayah');
			$kode_wilayah = $this->input->post('kode_wilayah');
			$nama_wilayah = $this->input->post('nama_wilayah');
			$luas_tanam = $this->input->post('luas_tanam');
			$luas_panen = $this->input->post('luas_panen');
			$produktivitas = $this->input->post('produktivitas');
			$produksi = $this->input->post('produksi');
			$tahun = $this->input->post('tahun');
			$jenis_tanaman = $this->input->post('jenis_tanaman');

			$where = array('id_wilayah' => $id_wilayah);

			$data_u = array(
			'kode_wilayah' => $kode_wilayah,
			'nama_wilayah' => $nama_wilayah,
			'luas_tanam' => $luas_tanam,
			'luas_panen' => $luas_panen,
			'produktivitas' => $produktivitas,
			'nama_wilayah' => $nama_wilayah,
			'produksi' => $produksi,
			'tahun' => $tahun,
			'jenis_tanaman' => $jenis_tanaman
			);
	
			$this->DataModel->update_data($where, $data_u, 'tb_data_panen');

			echo json_encode($data_u);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function datauji()
	{

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Data Uji';
		$data['tanaman'] = $this->DataModel->ambilTanaman()->result();
		$data['tahun'] = $this->DataModel->ambilTahun()->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('admin/datauji', $data);
		$this->load->view('templates_admin/footer');
	}

	public function fetch_uploaded()
	{ 
		if($this->input->is_ajax_request()){
			if($posts = $this->DataModel->get_entries2()){
				$data = ['responce' => 'success', 'posts' => $posts];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}
	}

	public function excel_import()
	{
		$this->db->truncate('tb_rekap_data_kost'); 
		if(isset($_FILES["file1"]["name"]))
		{
			$path = $_FILES["file1"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row=2; $row<=$highestRow; $row++)
				{
					// $nama_simpul = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					// $sLatitude = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					// $sLongitude = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$nama_kost = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$jenis_kost = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$alamat_lengkap = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$harga_kost = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$rute_ke_kampus = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$kondisi_air = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$luas_kamar = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$letak_kamar_mandi = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$dapur = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$wifi = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$garasi = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$latitude = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$longitude = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$narahubung = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$gambar = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

					$data[] = [

						// 'nama_simpul' => $nama_simpul,
						// 'sLatitude' => trim($sLatitude),
						// 'sLongitude' => trim($sLongitude),

						'nama_kost' => $nama_kost,
						'jenis_kost' => $jenis_kost,
						'alamat_lengkap' => $alamat_lengkap,
						'harga_kost' => trim($harga_kost),
						'rute_ke_kampus' => trim($rute_ke_kampus),
						'kondisi_air' => $kondisi_air,
						'luas_kamar' => $luas_kamar,
						'letak_kamar_mandi' => $letak_kamar_mandi,
						'dapur' => $dapur,
						'wifi' => $wifi,
						'garasi' => $garasi,
						'latitude' => trim($latitude),
						'longitude' => trim($longitude),
						'narahubung' => $narahubung,
						'gambar' => $gambar,
					];
				}// endfor

			} // end foreach
			// $this->DataModel->insert_batch_data($data, 'tb_datauji');
			$this->DataModel->insert_batch_data($data, 'tb_rekap_data_kost');
			echo json_encode($data);
		} // end if
	}

	public function excel_import_lat_long()
	{
		 
		if(isset($_FILES["file1"]["name"]))
		{
			$path = $_FILES["file1"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row=2; $row<=$highestRow; $row++)
				{
					$kriteria_kost = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$bobot = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$normalisasi_bobot = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					// $longitude = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

					$data[] = [

						'kriteria_kost' => $kriteria_kost,
						'bobot' => $bobot,
						'normalisasi_bobot' => $normalisasi_bobot,
						// 'longitude' => $longitude
					];
				}// endfor

			} // end foreach
			$this->DataModel->insert_batch_data($data, 'tb_marker');
			echo json_encode($data);
		} // end if
	}

	public function data_import()
	{
		// $this->db->truncate('tb_data_panen');
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row=2; $row<=$highestRow; $row++)
				{
					$kode_wilayah = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$nama_wilayah = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$luas_tanam = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$luas_panen = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$produktivitas = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$produksi = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$tahun = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$jenis_tanaman = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

					$data[] = [

						'kode_wilayah' => $kode_wilayah,
						'nama_wilayah' => $nama_wilayah,
						'luas_tanam' => $luas_tanam,
						'luas_panen' => $luas_panen,
						'produktivitas' => $produktivitas,
						'produksi' => $produksi,
						'tahun' => $tahun,
						'jenis_tanaman' => $jenis_tanaman
					];
				}// endfor

			} // end foreach
			$this->DataModel->insert_batch_data($data, 'tb_data_panen');
			echo json_encode($data);
		} // end if
	}

	public function regresi()
	{
		$jenis_tanaman = $this->input->post('jenis_tanaman');
		$tahun = $this->input->post('tahun');
		$where = ['jenis_tanaman' => $jenis_tanaman, 'tahun' => $tahun];
		// $where = ['jenis_tanaman' => $jenis_tanaman];
		$data = $this->DataModel->edit_data($where, 'tb_data_panen')->result();
		$this->db->truncate('tb_hasil'); 
		// Pecah data
		$i = 0;
		foreach($data as $row)
		{
			$luas_tanam[$i] = $row->luas_tanam;
			$luas_panen[$i] = $row->luas_panen;
			$produktivitas[$i] = $row->produktivitas;
			$produksi[$i] = $row->produksi;

			$i++;
		}//end foreach

		for($i=0; $i<count($luas_tanam); $i++)
		{
			$x1y[$i] = $luas_tanam[$i]*$produksi[$i];
			$x2y[$i] = $luas_panen[$i]*$produksi[$i];
			$x3y[$i] = $produktivitas[$i]*$produksi[$i];

			$x1x2[$i] = $luas_tanam[$i]*$luas_panen[$i];
			$x1x3[$i] = $luas_tanam[$i]*$produktivitas[$i];
			$x2x3[$i] = $luas_panen[$i]*$produktivitas[$i];

			$x1kuadrat[$i] = $luas_tanam[$i]*$luas_tanam[$i];
			$x2kuadrat[$i] = $luas_panen[$i]*$luas_panen[$i];
			$x3kuadrat[$i] = $produktivitas[$i]*$produktivitas[$i];
		}// endfor

		// SUM DATA
		$sumy = array_sum($produksi);
		$sumx1 = array_sum($luas_tanam);
		$sumx2 = array_sum($luas_panen);
		$sumx3 = array_sum($produktivitas);

		$sumx1y = array_sum($x1y);
		$sumx2y = array_sum($x2y);
		$sumx3y = array_sum($x3y);

		$sumx1x2 = array_sum($x1x2);
		$sumx1x3 = array_sum($x1x3);
		$sumx2x3 = array_sum($x2x3);

		$sumx1kuadrat = array_sum($x1kuadrat);
		$sumx2kuadrat = array_sum($x2kuadrat);
		$sumx3kuadrat = array_sum($x3kuadrat);


		// Data Tabel
		$b = 1;
		for ($i=0; $i < count($luas_tanam); $i++) { 
			$data_tabel[] = [

				'id' => $b++,
				'y' => $produksi[$i],
				'x1' => $luas_tanam[$i],
				'x2' => $luas_panen[$i],
				'x3' => $produktivitas[$i],
				'x1y' => $x1y[$i],
				'x2y' => $x2y[$i],
				'x3y' => $x3y[$i],
				'x1x2' => $x1x2[$i],
				'x1x3' => $x1x3[$i],
				'x2x3' => $x2x3[$i],
				'x1kuadrat' => $x1kuadrat[$i],
				'x2kuadrat' => $x2kuadrat[$i],
				'x3kuadrat' => $x3kuadrat[$i]
			];
			$b++;
		}

		$html = '';
		$html.= '<div class="card shadow mb-4">';
		$html.= '<div class="card-body">';
		$html.= '<center><h1>Regresi Linier Berganda</h1></center>';
		$html.= '<div class="table-responsive">';
		$html.= '<table class="table table-bordered" id="records2">
		          <thead>
		            <tr>
		              <th>No</th>
		              <th>Y</th>
		              <th>X1</th>
		              <th>X2</th>
		              <th>X3</th>
		              <th>X1Y</th>
		              <th>X2Y</th>
		              <th>X3Y</th>
		              <th>X1X2</th>
		              <th>X1X3</th>
		              <th>X2X3</th>
		              <th>X1^2</th>
		              <th>X2^2</th>
		              <th>X3^2</th>
		            </tr>
		          </thead>
		          
		          <tbody>';
		$a = 1;
		for($i=0; $i<count($luas_tanam); $i++)
		{
			$html.= '<tr>'.
						'<td>'.$a.'</td>'.
						'<td>'.$produksi[$i].'</td>'.
						'<td>'.$luas_tanam[$i].'</td>'.
						'<td>'.$luas_panen[$i].'</td>'.
						'<td>'.$produktivitas[$i].'</td>'.
						'<td>'.$x1y[$i].'</td>'.
						'<td>'.$x2y[$i].'</td>'.
						'<td>'.$x3y[$i].'</td>'.
						'<td>'.$x1x2[$i].'</td>'.
						'<td>'.$x1x3[$i].'</td>'.
						'<td>'.$x2x3[$i].'</td>'.
						'<td>'.$x1kuadrat[$i].'</td>'.
						'<td>'.$x2kuadrat[$i].'</td>'.
						'<td>'.$x3kuadrat[$i].'</td>'.					
					'</tr>';
			$a++;

		}// end for
		$html.= '</tbody>';
		$html.= '<tfoot>
		            <tr>
		              <th>#</th>
		              <th>Y</th>
		              <th>X1</th>
		              <th>X2</th>
		              <th>X3</th>
		              <th>X1Y</th>
		              <th>X2Y</th>
		              <th>X3Y</th>
		              <th>X1X2</th>
		              <th>X1X3</th>
		              <th>X2X3</th>
		              <th>X1^2</th>
		              <th>X2^2</th>
		              <th>X3^2</th>
		            </tr>
		          </tfoot>';
		$html.= ' <tfoot>
		            <tr>
		              <th>N = '.count($luas_tanam).'</th>
		              <th>'.$sumy.'</th>
		              <th>'.$sumx1.'</th>
		              <th>'.$sumx2.'</th>
		              <th>'.$sumx2.'</th>
		              <th>'.$sumx1y.'</th>
		              <th>'.$sumx2y.'</th>
		              <th>'.$sumx3y.'</th>
		              <th>'.$sumx1x2.'</th>
		              <th>'.$sumx1x3.'</th>
		              <th>'.$sumx2x3.'</th>
		              <th>'.$sumx1kuadrat.'</th>
		              <th>'.$sumx2kuadrat.'</th>
		              <th>'.$sumx3kuadrat.'</th>
		            </tr>
		          </tfoot>';
		$html.= '</table>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';

		// Penetuan Matriks

		$html.= '<div class="card shadow mb-4">';
		$html.= '<div class="card-body">';
		$html.= '<div class="row">';
		$html.= '<div class="col-md-6">';
		$html.= '<p>Matriks A</p>';
		$html.= '<p><img src="https://latex.codecogs.com/gif.latex?\
						begin{bmatrix}&space;
							'.count($luas_tanam).'&&space;'.$sumx1.'&&space;'.$sumx2.'&&space;'.$sumx3.'\\\\&space;
							'.$sumx1.'&&space;'.$sumx1kuadrat.'&&space;'.$sumx1x2.'&&space;'.$sumx1x3.'\\\\&space;
							'.$sumx2.'&&space;'.$sumx1x2.'&&space;'.$sumx2kuadrat.'&&space;'.$sumx2x3.'\\\\&space;
							'.$sumx3.'&&space;'.$sumx1x3.'&&space;'.$sumx2x3.'&&space;'.$sumx3kuadrat.'&space;
						\end{bmatrix}"/></p>';
		$html.= '</div>';
		$html.= '<div class="col-md-6">';
		$html.= '<p>Matriks H</p>';
		$html.= '<p><img src="https://latex.codecogs.com/gif.latex?\
						begin{bmatrix}&space;
							'.$sumy.'\\\\&space;
							'.$sumx1y.'\\\\&space;
							'.$sumx2y.'\\\\&space;
							'.$sumx3y.'&space;
						\end{bmatrix}"/></p>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';

		$html.= '<div class="card shadow mb-4">';
		$html.= '<div class="card-body">';
		$html.= '<div class="row">';
		$html.= '<div class="col-md-6">';		
		$html.= '<p>Matriks A1</p>';
		$html.= '<p><img src="https://latex.codecogs.com/gif.latex?\
						begin{bmatrix}&space;
							'.$sumy.'&&space;'.$sumx1.'&&space;'.$sumx2.'&&space;'.$sumx3.'\\\\&space;
							'.$sumx1y.'&&space;'.$sumx1kuadrat.'&&space;'.$sumx1x2.'&&space;'.$sumx1x3.'\\\\&space;
							'.$sumx2y.'&&space;'.$sumx1x2.'&&space;'.$sumx2kuadrat.'&&space;'.$sumx2x3.'\\\\&space;
							'.$sumx3y.'&&space;'.$sumx1x3.'&&space;'.$sumx2x3.'&&space;'.$sumx3kuadrat.'&space;
						\end{bmatrix}"/></p>';
		$html.= '</div>';
		$html.= '<div class="col-md-6">';	
		$html.= '<p>Matriks A2</p>';
		$html.= '<p><img src="https://latex.codecogs.com/gif.latex?\
						begin{bmatrix}&space;
							'.count($luas_tanam).'&&space;'.$sumy.'&&space;'.$sumx2.'&&space;'.$sumx3.'\\\\&space;
							'.$sumx1.'&&space;'.$sumx1y.'&&space;'.$sumx1x2.'&&space;'.$sumx1x3.'\\\\&space;
							'.$sumx2.'&&space;'.$sumx2y.'&&space;'.$sumx2kuadrat.'&&space;'.$sumx2x3.'\\\\&space;
							'.$sumx3.'&&space;'.$sumx3y.'&&space;'.$sumx2x3.'&&space;'.$sumx3kuadrat.'&space;
						\end{bmatrix}"/></p>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';

		$html.= '<div class="card shadow mb-4">';
		$html.= '<div class="card-body">';
		$html.= '<div class="row">';
		$html.= '<div class="col-md-6">';		
		$html.= '<p>Matriks A3</p>';
		$html.= '<p><img src="https://latex.codecogs.com/gif.latex?\
						begin{bmatrix}&space;
							'.count($luas_tanam).'&&space;'.$sumx1.'&&space;'.$sumy.'&&space;'.$sumx3.'\\\\&space;
							'.$sumx1.'&&space;'.$sumx1kuadrat.'&&space;'.$sumx1y.'&&space;'.$sumx1x3.'\\\\&space;
							'.$sumx2.'&&space;'.$sumx1x2.'&&space;'.$sumx2y.'&&space;'.$sumx2x3.'\\\\&space;
							'.$sumx3.'&&space;'.$sumx1x3.'&&space;'.$sumx3y.'&&space;'.$sumx3kuadrat.'&space;
						\end{bmatrix}"/></p>';
		$html.= '</div>';
		$html.= '<div class="col-md-6">';	
		$html.= '<p>Matriks A4</p>';
		$html.= '<p><img src="https://latex.codecogs.com/gif.latex?\
						begin{bmatrix}&space;
							'.count($luas_tanam).'&&space;'.$sumx1.'&&space;'.$sumx2.'&&space;'.$sumy.'\\\\&space;
							'.$sumx1.'&&space;'.$sumx1kuadrat.'&&space;'.$sumx1x2.'&&space;'.$sumx1y.'\\\\&space;
							'.$sumx2.'&&space;'.$sumx1x2.'&&space;'.$sumx2kuadrat.'&&space;'.$sumx2y.'\\\\&space;
							'.$sumx3.'&&space;'.$sumx1x3.'&&space;'.$sumx2x3.'&&space;'.$sumx3y.'&space;
						\end{bmatrix}"/></p>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';

		// Penentuan Determinan
		// count($luas_tanam) $sumx1 $sumx2 $sumx3| count($luas_tanam) $sumx1 $sumx2 $sumx3 
		// $sumx1 $sumx1kuadrat $sumx1x2 $sumx1x3| $sumx1 $sumx1kuadrat $sumx1x2 $sumx1x3
		// $sumx2 $sumx1x2 $sumx2kuadrat $sumx2x3| $sumx2 $sumx1x2 $sumx2kuadrat $sumx2x3
		// $sumx3 $sumx1x3 $sumx2x3 $sumx3kuadrat| $sumx3 $sumx1x3 $sumx2x3 $sumx3kuadrat

		$a = count($luas_tanam);
		$b = $sumx1;
		$c = $sumx2;
		$d = $sumx3;

		$e = $sumx1;
		$f = $sumx1kuadrat;
		$g = $sumx1x2;
		$h = $sumx1x3;

		$i = $sumx2;
		$j = $sumx1x2;
		$k = $sumx2kuadrat;
		$l = $sumx2x3;

		$m = $sumx3;
		$n = $sumx1x3;
		$o = $sumx2x3;
		$p = $sumx3kuadrat;

		$q = $sumy;
		$r = $sumx1y;
		$s = $sumx2y;
		$t = $sumx3y;

		$A1 = ($a*$f*$k*$p) - ($b*$g*$l*$m) + ($c*$h*$i*$n) - ($d*$e*$j*$o) - ($a*$h*$k*$n) + ($b*$e*$l*$o) - ($c*$f*$i*$p) + ($d*$g*$j*$m);

		$A2 = -($a*$f*$l*$o) + ($b*$g*$i*$p) - ($c*$h*$j*$m) + ($d*$e*$k*$n) + ($a*$h*$j*$o) - ($b*$e*$k*$p) + ($c*$f*$l*$m) - ($d*$g*$i*$n);

		$A3 = ($a*$g*$l*$n) - ($b*$h*$i*$o) + ($c*$e*$j*$p) - ($d*$f*$k*$m) - ($a*$g*$j*$p) + ($b*$h*$k*$m) - ($c*$e*$l*$n) + ($d*$f*$i*$o);

		$deta = $A1 + $A2 + $A3;
		

		// '.$sumy   $sumx1 $sumx2 $sumx3           |$sumy   $sumx1        $sumx2   $sumx3|
		// '.$sumx1y $sumx1k $sumx1x2 $sumx1x3      |$sumx1y $sumx1kuadrat $sumx1x2 $sumx1x3|
		// '.$sumx2y $sumx1x2 $sumx2kuadrat $sumx2x3|$sumx2y $sumx1x2      $sumx2kuadrat $sumx2x3|
		// '.$sumx3y $sumx1x3 $sumx2x3 $sumx3kuadrat|$sumx3y $sumx1x3 $sumx2x3      $sumx3kuadrat|

		$A11 = ($q*$f*$k*$p) - ($b*$g*$l*$t) + ($c*$h*$s*$n) - ($d*$r*$j*$o) - ($q*$h*$k*$n) + ($b*$r*$l*$o) - ($c*$f*$s*$p) + ($d*$g*$j*$t);

		$A12 = -($q*$f*$l*$o) + ($b*$g*$s*$p) - ($c*$h*$j*$t) + ($d*$r*$k*$n) + ($q*$h*$j*$o) - ($b*$r*$k*$p) + ($c*$f*$l*$t) - ($d*$g*$s*$n);

		$A13 = ($q*$g*$l*$n) - ($b*$h*$s*$o) + ($c*$r*$j*$p) - ($d*$f*$k*$t) - ($q*$g*$j*$p) + ($b*$h*$k*$t) - ($c*$r*$l*$n) + ($d*$f*$s*$o);

		$deta1 = $A11 + $A12 + $A13;

		$A21 = ($a*$r*$k*$p) - ($q*$g*$l*$m) + ($c*$h*$i*$t) - ($d*$e*$s*$o) - ($a*$h*$k*$t) + ($q*$e*$l*$o) - ($c*$r*$i*$p) + ($d*$g*$s*$m);

		$A22 = -($a*$r*$l*$o) + ($q*$g*$i*$p) - ($c*$h*$s*$m) + ($d*$e*$k*$t) + ($a*$h*$s*$o) - ($q*$e*$k*$p) + ($c*$r*$l*$m) - ($d*$g*$i*$t);

		$A23 = ($a*$g*$l*$t) - ($q*$h*$i*$o) + ($c*$e*$s*$p) - ($d*$r*$k*$m) - ($a*$g*$s*$p) + ($q*$h*$k*$m) - ($c*$e*$l*$t) + ($d*$r*$i*$o);

		$deta2 = $A21 + $A22 + $A23;

		$A31 = ($a*$f*$s*$p) - ($b*$r*$l*$m) + ($q*$h*$i*$n) - ($d*$e*$j*$t) - ($a*$h*$s*$n) + ($b*$e*$l*$t) - ($q*$f*$i*$p) + ($d*$r*$j*$m);
		
		$A32 = -($a*$f*$l*$t) + ($b*$r*$i*$p) - ($q*$h*$j*$m) + ($d*$e*$s*$n) + ($a*$h*$j*$t) - ($b*$e*$s*$p) + ($q*$f*$l*$m) - ($d*$r*$i*$n);

		$A33 = ($a*$r*$l*$n) - ($b*$h*$i*$t) + ($q*$e*$j*$p) - ($d*$f*$s*$m) - ($a*$r*$j*$p) + ($b*$h*$s*$m) - ($q*$e*$l*$n) + ($d*$f*$i*$t);

		$deta3 = $A31 + $A32 + $A33;

		$A41 = ($a*$f*$k*$t)-($b*$g*$s*$m)+($c*$r*$i*$n)-($q*$e*$j*$o)-($a*$r*$k*$n)+($b*$e*$s*$o)-($c*$f*$i*$t)+($q*$g*$j*$m);
		
		$A42 = -($a*$f*$s*$o)+($b*$g*$i*$t)-($c*$r*$j*$m)+($q*$e*$k*$n)+($a*$r*$j*$o)-($b*$e*$k*$t)+($c*$f*$s*$m)-($q*$g*$i*$n);
		$A43 = ($a*$g*$s*$n)-($b*$r*$i*$o)+($c*$e*$j*$t)-($q*$f*$k*$m)-($a*$g*$j*$t)+($b*$r*$k*$m)-($c*$e*$s*$n)+($q*$f*$i*$o);
		$deta4 = $A41 + $A42 + $A43;

		$html.= '<div class="row">';	
		$html.= '<div class="col-md-6">';	
		$html.= '<div class="card shadow mb-4 col-md-12">';
		
		$html.= '<div class="card-body">';
		
		$html.= '<p>Det(A)</p>';
		$html.= '<p>'.round($deta,2).'</p>';
		$html.= '<p>Det(A1)</p>';
		$html.= '<p>'.round($deta1,2).'</p>';
		$html.= '<p>Det(A2)</p>';
		$html.= '<p>'.round($deta2,2).'</p>';
		$html.= '<p>Det(A3)</p>';
		$html.= '<p>'.$deta3.'</p>';
		$html.= '<p>Det(A4)</p>';
		$html.= '<p>'.round($deta4,2).'</p>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';
		

		$b1 = $deta1/$deta;
		$b2 = $deta2/$deta;
		$b3 = $deta3/$deta;
		$b4 = $deta4/$deta;

		$html.= '<div class="col-md-6">';
		$html.= '<div class="card shadow mb-4 col-md-12">';

		$html.= '<div class="card-body">';
		
		$html.= '<p>b1 =</p>';
		$html.= '<p>'.$b1.'</p>';
		$html.= '<p>b2 =</p>';
		// $html.= '<p>'.($b2*10).'</p>';
		$html.= '<p>'.$b2.'</p>';
		$html.= '<p>b3 =</p>';
		$html.= '<p>'.$b3.'</p>';
		$html.= '<p>b4 =</p>';
		// $html.= '<p>'.($b4/100).'</p>';
		$html.= '<p>'.$b4.'</p>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';

		$dataq = $this->DataModel->get_data('tb_datauji')->result();
		// $dataq = $this->DataModel->edit_data($where, 'tb_datauji')->result();
		$i = 0;
		foreach($dataq as $row)
		{
			$kode_wilayah[$i] = $row->kode_wilayah;
			$nama_wilayah[$i] = $row->nama_wilayah;
			$x1[$i] = $row->luas_tanam;
			$x2[$i] = $row->luas_panen;
			$x3[$i] = $row->produktivitas;
			$tanaman = $row->jenis_tanaman;			

			$i++;
		}//end foreach

		for($i=0;$i<count($x1);$i++)
		{
			$y[$i] = $b1+($b2*$x1[$i])+($b3*$x2[$i])+($b4*$x3[$i]);
		}


		$html.= '<div class="card shadow mb-4">';
		$html.= '<div class="card-body">';
		$html.= '<center><h1>HASIL PERAMALAN DENGAN REGERESI LINIER BERGANDA</h1></center>';
		$html.= '<div class="table-responsive">';

		$html.= '	<div class="row"> 
				     	<div class="col-6">
				     		
				     			<div class="input-group mb-3">
								  <form action="'.base_url().'data/cetak" target="_blank" method="POST" class="input-group-prepend" id="button-addon3">
								    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-print"></i> Print</button>	
								  </form>
								  <form action="'.base_url().'data/pdf" target="_blank" method="POST" class="input-group-prepend" id="button-addon3">
								    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-download"></i> PDF</button>
								  </form>
								  <form action="'.base_url().'data/excel" target="_blank" method="POST" class="input-group-prepend" id="button-addon3">
								    <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-file"></i> Excel</button>	
								  </form>
								  
								</div>
				     		    		
				     	</div>
				     </div>';

		$html.= '<table class="table table-bordered" id="dataTable">
		          <thead>
		            <tr>
		              <th>No</th>	
		              <th>Wilayah</th>	              
		              <th>X1</th>
		              <th>X2</th>
		              <th>X3</th>
		              <th>Produksi (Y)</th>		              
		            </tr>
		          </thead>
		          
		          <tbody>';
		$a = 1;
		for($i=0; $i<count($x1); $i++)
		{
			$html.= '<tr>'.
						'<td>'.$a.'</td>'.
						'<td>'.$nama_wilayah[$i].'</td>'.
						'<td>'.$x1[$i].'</td>'.
						'<td>'.$x2[$i].'</td>'.
						'<td>'.$x3[$i].'</td>'.
						'<td>'.round($y[$i],2).' Ton</td>'.			
					'</tr>';
			
			$a++;

		}// end for

		unset($data);
		for($i=0; $i<count($x1); $i++){

			$data[] = [

				'kode_wilayah' => $kode_wilayah[$i],
				'nama_wilayah' => $nama_wilayah[$i],
				'x1' => $x1[$i],
				'x2' => $x2[$i],
				'x3' => $x3[$i],
				'y' => round($y[$i],2)
			];
		}
		$this->DataModel->insert_batch_data($data, 'tb_hasil');

		$html.= '</tbody>';
		$html.= '</table>';
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';

		

		$html.= '<div class="card shadow mb-4">';
		$html.= '<div class="card-body">';
		$html.= '<center><h1>GRAFIK DATA PANEN '.strtoupper($tanaman).'</h1></center>';
		
		$html.= '<canvas id="myChart" width="600" height="200"></canvas>';
		$html.= "<script>
				var ctx = document.getElementById('myChart');
				var myChart = new Chart(ctx, {
				    type: 'line',
				    data: {
				        labels: [";
				        for($i=0;$i<count($nama_wilayah);$i++)
						{
							$html.= "'".$nama_wilayah[$i]."',";
						}

						
		$html.= "],
				        datasets: [{
				            label: 'Produksi',
				            data: [";
				            for($i=0;$i<count($nama_wilayah);$i++)
							{
								$html.= "'".$y[$i]."',";
							}
		$html.= "],
				            backgroundColor: [
				                'rgba(255, 99, 132, 0.2)',
				                'rgba(54, 162, 235, 0.2)',
				                'rgba(255, 206, 86, 0.2)',
				                'rgba(75, 192, 192, 0.2)',
				                'rgba(153, 102, 255, 0.2)',
				                'rgba(255, 159, 64, 0.2)'
				            ],
				            borderColor: [
				                'rgba(255, 99, 132, 1)',
				                'rgba(54, 162, 235, 1)',
				                'rgba(255, 206, 86, 1)',
				                'rgba(75, 192, 192, 1)',
				                'rgba(153, 102, 255, 1)',
				                'rgba(255, 159, 64, 1)'
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				        scales: {
				            y: {
				                beginAtZero: true
				            }
				        }
				    }
				});
				</script>";
		$html.= '</div>';
		$html.= '</div>';

		$table = 'tb_hasil';
		$table2 = 'tb_marker';
		$on = 'tb_hasil.kode_wilayah=tb_marker.kode_wilayah';
		$datajoin = $this->adminmodel->joinTabel($table,$table2,$on)->result();
		$dataTerbesar = $this->db->query('SELECT * FROM `tb_hasil` ORDER BY y DESC LIMIT 1')->result();

		foreach ($dataTerbesar as $dT) 
		{
			$marker = $dT->y;
			$kWilayah = $dT->kode_wilayah;
		}

		$i=0;
		foreach ($datajoin as $key) 
		{
			$nama_wilayah[$i] = $key->nama_wilayah;
			$latitude[$i] = $key->latitude;
			$longitude[$i] = $key->longitude;
			$kode_wil[$i] = $key->kode_wilayah;

			$i++;
		}



		$html.= '<div class="card shadow mb-4">';
		$html.= '<div class="card-body">';
		$html.= '<center><h1>GIS DATA PANEN '.strtoupper($tanaman).'</h1></center>';
		$html.= '<br>'; 
		$html.= '<div id="mapid" style="width: 100%; height: 400px;">';
		$html.= "<script>";
		$html.=		"  var map = L.map('mapid').setView([5.154999353388613, 97.19732716435323], 10);

					  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					      attribution: '&copy;"; $html.= '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'; $html.= "contributors'
					  }).addTo(map);";
		
		for ($i=0; $i < count($nama_wilayah); $i++) 
		{ 
			if($kode_wil[$i] != $kWilayah)
			{
				$html.= "var greenIcon = L.icon({
						    iconUrl: 'http://localhost/regresi/leaf-green.png',
						    shadowUrl: 'http://localhost/regresi/leaf-shadow.png', 

						    iconSize:     [38, 95], // size of the icon
						    shadowSize:   [50, 64], // size of the shadow
						    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
						    shadowAnchor: [4, 62],  // the same for the shadow
						    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
						});";
				$html.= "L.marker([";
				$html.= ''.$latitude[$i].','.$longitude[$i].'';
				$html.= ']).bindPopup("<b><center>'.$nama_wilayah[$i].'</center></b><br>X1 = '.$x1[$i].'<br>X2 = '.$x2[$i].'<br>X3 = '.$x3[$i].'<br>Y = '.$y[$i].'")
					.addTo(map);';

			}else{
				$html.= "var redIcon = L.icon({
						    iconUrl: 'http://localhost/regresi/pngwing.png',
						    shadowUrl: 'http://localhost/regresi/leaf-shadow.png',

						    iconSize:     [26, 44], // size of the icon
						    shadowSize:   [50, 64], // size of the shadow
						    iconAnchor:   [13, 44], // point of the icon which will correspond to marker's location
						    shadowAnchor: [4, 62],  // the same for the shadow
						    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
						});";
				$html.= "L.marker([";
				$html.= ''.$latitude[$i].','.$longitude[$i].'';
				$html.= '], {icon: redIcon}).bindPopup("<b><center>'.$nama_wilayah[$i].'</center></b><br>X1 = '.$x1[$i].'<br>X2 = '.$x2[$i].'<br>X3 = '.$x3[$i].'<br>Y = '.$y[$i].'")
					.addTo(map);';
			}
			
		}
		
		$html.= "</script>";
		$html.= '</div>';
		$html.= '</div>';
		$html.= '</div>';
		

		
		
		echo json_encode($html);
	}

	public function map()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Map';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar', $data);
		$this->load->view('admin/map', $data);
		$this->load->view('templates_admin/footer');
	}

	public function truncate()
	{
		if($this->input->is_ajax_request()){
			
			if($this->db->truncate('tb_data_panen')){
				$data = ['responce' => 'success'];
			}else{
				$data = ['responce' => 'error', 'message' => 'failed to fetch data'];
			}
			echo json_encode($data);
		}else{
			echo "No direct script access allowed";
		}

	}

	public function cetak()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Print';
		$data['data_panen'] = $this->DataModel->get_data('tb_hasil')->result();
		$this->load->view('laporan/print', $data);
	}

	public function pdf()
	{
		$this->load->library('mypdf');	
		// $this->load->library('dompdf_gen');	
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'PDF';
		$data['data_panen'] = $this->DataModel->get_data('tb_hasil')->result();
		$this->mypdf->generate('Laporan/pdf', $data);
		
	}

	public function excel()
	{
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Excel';
		$datapanen = $this->DataModel->get_data('tb_hasil')->result();
		// $this->load->library('Excel');
		// require(APPPATH. 'libraries/PHPExcel.php');
		require(APPPATH. 'libraries/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator('Regresi');
		$object->getProperties()->setLastModifiedBy('Saparuddin');
		$object->getProperties()->setTitle('Hasil Peramalan');
		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'LAPORAN HASIL PERAMALAN');
		$object->getActiveSheet()->setCellValue('A3', 'No');
		$object->getActiveSheet()->setCellValue('B3', 'Wilayah');
		$object->getActiveSheet()->setCellValue('C3', 'Luas Tanam');
		$object->getActiveSheet()->setCellValue('D3', 'Luas Panen');
		$object->getActiveSheet()->setCellValue('E3', 'Produktivitas');
		$object->getActiveSheet()->setCellValue('F3', 'Produksi');

		// MERGING
		$object->getActiveSheet()->mergeCells('A1:F1');

		// aligning
		$object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
		$object->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal('center');

		// Styling
		$object->getActiveSheet()->getStyle('A1')->applyFromArray(
			array(
				'font' => array(
					'size' => 24,
				)
			)
		);
		$object->getActiveSheet()->getStyle('A3:F3')->applyFromArray(
			array(
				'font' => array(
					'bold' => true
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)	
		);
		$baris = 4;
		// Border Data
		
		
		$no =1;

		foreach($datapanen as $d)
		{
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $d->nama_wilayah);
			$object->getActiveSheet()->setCellValue('C'.$baris, $d->x1);
			$object->getActiveSheet()->setCellValue('D'.$baris, $d->x2);
			$object->getActiveSheet()->setCellValue('E'.$baris, $d->x3);
			$object->getActiveSheet()->setCellValue('F'.$baris, $d->y);

			$baris++;
		}

		$object->getActiveSheet()->getStyle('A4:F'.($baris-1))->applyFromArray(
			array(
				'borders' => array(
					'outline' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					),
					'vertical' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		$object->getActiveSheet()->setCellValue('F'.($baris+3), 'Lhokseumawe, '.date('d F Y'));
		$object->getActiveSheet()->getStyle('F'.($baris+3))->getAlignment()->setHorizontal('center');
		$object->getActiveSheet()->setCellValue('F'.($baris+6), $user['name']);
		$object->getActiveSheet()->getStyle('F'.($baris+6))->getAlignment()->setHorizontal('center');
		// Lebar Kolom
		$object->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$object->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$object->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$object->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$object->getActiveSheet()->getColumnDimension('F')->setWidth(30);

		//
		$filename ="Data Hasil Peramalan".'.xlsx';

		$object->getActiveSheet()->setTitle('Data Peramalan');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;
	}
	
}

