<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Menu_user extends CI_Controller{

	public function index()
	{
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();	
			$title = 'Hasil Klaster';
			$tahun ="2016";
			$uji = "1";
			$tahun = $this->input->post('tahun');
			$uji = $this->input->post('uji');
			$tahun_skr = date('Y')-1;	
			
			if(is_null($tahun)){

				$queryPn = "SELECT *
                    FROM `tb_data_panen` JOIN `simp_hasil_predikat`
                    ON `tb_data_panen`.`id_wilayah` = `simp_hasil_predikat`.`id_wilayah`                    
                    WHERE `tb_data_panen`.`tahun` = $tahun_skr 
                    AND `simp_hasil_predikat`.`uji` = 1               
                     ";			
            	$data_hasil_predikat = $this->db->query($queryPn);
            	$queryQ = "SELECT * from `simp_cent_temp` where `tahun` = $tahun_skr and `uji` = 1 group by `iterasi`";
				$q = $this->db->query($queryQ);
			}else{

				$queryPn = "SELECT *
                    FROM `tb_data_panen` JOIN `simp_hasil_predikat`
                    ON `tb_data_panen`.`id_wilayah` = `simp_hasil_predikat`.`id_wilayah`                    
                    WHERE `tb_data_panen`.`tahun` = $tahun 
                    AND `simp_hasil_predikat`.`uji` = $uji                  
                     ";			
            	$data_hasil_predikat = $this->db->query($queryPn);

            	$queryQ = "SELECT * from `simp_cent_temp` where `tahun` = $tahun and `uji` = $uji group by `iterasi`";
				$q = $this->db->query($queryQ);
			}
			
					

			$data = array(				
				
				'data_hasil_predikat'=> $data_hasil_predikat,
				'user' => $user,
				'tahun' => $tahun,
				'uji' => $uji,
				'q' => $q,
				'title' => $title
				
			);			

			$data['hasil_cent_awal'] = $this->db->get_where('simp_cent_awal', ['tahun' => $tahun, 'uji' => $uji])->result_array();
			$data['hasil_cent_baru'] = $this->db->get_where('simp_hasil_cent_baru', ['tahun' => $tahun, 'uji' => $uji])->result_array();
			$data['hasil_cent_temp'] = $this->db->get_where('simp_cent_temp', ['tahun' => $tahun, 'uji' => $uji])->result_array();
			$data['ket'] = $this->db->get_where('keterangan', ['tahun' => $tahun, 'uji' => $uji])->result_array();
			

			$this->load->view('templates_admin/header',$data);
			$this->load->view('templates_admin/sidebar',$data);
			$this->load->view('member/hasil_klaster',$data);
			$this->load->view('templates_admin/footer');
		
	}

	public function cetak()
	{
		$tahun = $this->input->post('tahun');
		$uji = $this->input->post('uji');
		if(is_null($tahun)|| $tahun == ""){
			
			redirect('menu_user/hasil_klaster');
		}else{
			$queryPn = "SELECT *
                    FROM `tb_data_panen` JOIN `simp_hasil_predikat`
                    ON `tb_data_panen`.`id_wilayah` = `simp_hasil_predikat`.`id_wilayah`                    
                    WHERE `tb_data_panen`.`tahun` = $tahun 
                    AND `simp_hasil_predikat`.`uji` = $uji                  
                     ";			
            $data['hasil'] = $this->db->query($queryPn);           
		}
		$data['tahun'] = $tahun;
		
		$this->load->view('templates_laporan/header');
		$this->load->view('laporan/print', $data);
		$this->load->view('templates_laporan/footer');
	}

	public function pdf()
	{
		$this->load->library('dompdf_gen');
		$tahun = $this->input->post('tahun');
		$uji = $this->input->post('uji');
		if(is_null($tahun)|| $tahun == ""){
			
			redirect('menu_user/hasil_klaster');
		}else{
			$queryPn = "SELECT *
                    FROM `tb_data_panen` JOIN `simp_hasil_predikat`
                    ON `tb_data_panen`.`id_wilayah` = `simp_hasil_predikat`.`id_wilayah`                    
                    WHERE `tb_data_panen`.`tahun` = $tahun 
                    AND `simp_hasil_predikat`.`uji` = $uji                  
                     ";			
            $data['hasil'] = $this->db->query($queryPn);           
		}

		$data['tahun'] = $tahun;
		
		$this->load->view('templates_laporan/header');
		$this->load->view('laporan/pdf', $data);
		$this->load->view('templates_laporan/footer');

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('laporan'.$tahun.'.pdf', ['Attachment' => FALSE]);

	}

	public function excel()
	{
		$tahun = $this->input->post('tahun');
		$uji = $this->input->post('uji');
		if(is_null($tahun)|| $tahun == ""){
			
			redirect('kmeans/hasil_akhir');
		}else{
			$queryPn ="SELECT *
                    FROM `tb_data_panen` JOIN `simp_hasil_predikat`
                    ON `tb_data_panen`.`id_wilayah` = `simp_hasil_predikat`.`id_wilayah`                    
                    WHERE `tb_data_panen`.`tahun` = $tahun 
                    AND `simp_hasil_predikat`.`uji` = $uji                  
                     ";		
            $data['hasil'] = $this->db->query($queryPn)->result_array();           
		}

		$data['tahun'] = $tahun;

		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator('Aplikasiku');
		$object->getProperties()->setLastModifiedBy('Aplikasiku');
		$object->getProperties()->setTitle('Hasil Klaster');
		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'No');
		$object->getActiveSheet()->setCellValue('B1', 'Wilayah');
		$object->getActiveSheet()->setCellValue('C1', 'Tahun');
		$object->getActiveSheet()->setCellValue('D1', 'Luas Tanam');
		$object->getActiveSheet()->setCellValue('E1', 'Luas Panen');
		$object->getActiveSheet()->setCellValue('F1', 'Produktivitas');
		$object->getActiveSheet()->setCellValue('G1', 'Produksi');
		$object->getActiveSheet()->setCellValue('H1', 'Persentase Luas Panen');
		$object->getActiveSheet()->setCellValue('I1', 'Persentase Produksi');
		$object->getActiveSheet()->setCellValue('J1', 'Predikat');

		$baris = 2;
		$no =1;

		foreach($data['hasil'] as $d)
		{
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $d['nama_wilayah']);
			$object->getActiveSheet()->setCellValue('C'.$baris, $d['tahun']);
			$object->getActiveSheet()->setCellValue('D'.$baris, $d['luas_tanam']);
			$object->getActiveSheet()->setCellValue('E'.$baris, $d['luas_panen']);
			$object->getActiveSheet()->setCellValue('F'.$baris, $d['produktivitas']);
			$object->getActiveSheet()->setCellValue('G'.$baris, $d['produksi']);
			$object->getActiveSheet()->setCellValue('H'.$baris, $d['presentasi_luas_panen']);
			$object->getActiveSheet()->setCellValue('I'.$baris, $d['presentasi_produksi']);
			$object->getActiveSheet()->setCellValue('J'.$baris, $d['predikat']);

			$baris++;
		}

		$filename ="Data Klaster".'.xlsx';

		$object->getActiveSheet()->setTitle('Data Klaster');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;


	}

	public function grafik($tahun,$uji)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Grafik";

		if(is_null($tahun) OR $tahun=="" )
		{
			redirect('menu_user/hasil_klaster');
		}

		$data['graph'] = $this->db->query('SELECT COUNT(wilayah) as jum,predikat,tahun FROM `simp_hasil_predikat` WHERE tahun ='.$tahun.' and uji = '.$uji.' group by predikat desc');
		$data['tahun'] = $tahun;
		$data['uji'] = $uji;

		$this->load->view('templates_grafik/header',$data);		
		$this->load->view('templates_grafik/sidebar',$data);
		$this->load->view('grafik/graph',$data);
		$this->load->view('templates_grafik/footer',$data);
	}
	





	}// akhir class menu user