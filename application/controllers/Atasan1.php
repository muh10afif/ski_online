<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Atasan1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_atasan1');
        $this->load->model('Model_karyawan');
        if($this->session->userdata('masuk') != TRUE || $this->session->userdata('akses') != 'admin')
        {
            $url=base_url().'login';
            redirect($url);
        }
    }

    /********************************************************************************************************/
	/*																										*/
	/*											AMBIL FOTO KARYAWAN 										*/	
	/*																										*/
	/********************************************************************************************************/
    //getting image
	public function get_url_photo($nipeg){	
		$domain = "http://ess.inti.co.id/util/images/photo/";
		$file_ext = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG");
		$filename = $domain.'NoImageAvailable.jpg';

		foreach ($file_ext as $ext) {
			$url = $domain.$nipeg.".".$ext;
			if ($this->url_exists($url)){
				$filename = $url;
			}
	}

	return $filename;
	}

	public function url_exists($url) {
	    $hdrs = @get_headers($url);
	    //echo @$hdrs[1]."\n";
	    return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
	}
	//end
	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR AMBIL FOTO KARYAWAN 										*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*										DASHBOARD ATASAN 1												*/	
	/*																										*/
	/********************************************************************************************************/

    public function index()
    {
    	$data['judul']='Dashboard Atasan';
    	$nipeg = $this->session->userdata('ses_nipeg');    	
		$data['poto'] = $this->get_url_photo($nipeg);
	
		// Mengambil variable status untuk perubahan kondisi status
		$thn = $this->Model_atasan1->get_data_status()->result_array();
	    	foreach ($thn as $t) {
	    		$thn_periode 	= $t['tahun'];
	    		$data['status'] = $t['status_tw'];
				$data['tst'] 	= $t['TST'];
	    	}
	    $data['thn'] = $thn_periode;

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn_periode);	

		$data['status_pembuatan_ski']	= $this->Model_atasan1->status_ski($nip_karyawan);	
		$data['data_karyawan']			= $this->Model_atasan1->get_data_karyawan_1($nipeg)->result(); 


    	/* Menampilkan data Approve karyawan pada tabel saat pembukaan penilaian per triwulan */
    	$triwulan 	= $this->Model_atasan1->get_data_status();

    	foreach ($triwulan->result_array() as $tw) {
    		$jns_triwulan = $tw['status_tw'];

    		if ($jns_triwulan != 'SKI') {
    			$d = array( "rn.tahun" 				=> $thn_periode, 
    						"rn.jenis_realisasi" 	=> $jns_triwulan, 
    						"role.buat_ski" 		=> 'SUDAH',
    						"role.approve"			=> 'SUDAH');

	    		$data['belum_submit_nilai']		= $this->Model_atasan1->tampil_belum_submit_nilai($d,$nipeg)->result();
	    		$data['belum_submit_nilai_h']	= $this->Model_atasan1->tampil_belum_submit_nilai_h($d,$nipeg);

	    		$b = array("NIPEG_UP" 				=> $nipeg, 
    						"rn.tahun" 				=> $thn_periode, 
    						"rn.jenis_realisasi" 	=> $jns_triwulan, 
    						"APPROVE_$jns_triwulan" => 'BELUM');

	    		$data['belum_nilai_bawahan']		= $this->Model_atasan1->tampil_belum_nilai_bawahan($b)->result();
	    		$data['belum_nilai_bawahan_hitung']	= $this->Model_atasan1->tampil_belum_nilai_bawahan_h($b);

	    		$c = array("NIPEG_UP" 				=> $nipeg, 
	    					"rn.tahun" 				=> $thn_periode, 
	    					"rn.jenis_realisasi" 	=> $jns_triwulan, 
	    					"APPROVE_$jns_triwulan" => 'ATASAN1');

	    		$data['sudah_nilai_bawahan']		= $this->Model_atasan1->tampil_sudah_nilai_bawahan($c)->result();
	    		$data['sudah_nilai_bawahan_hitung']	= $this->Model_atasan1->tampil_sudah_nilai_bawahan_h($c);
    		} else {
    			$a 	= array('NIPEG_UP' => $nipeg, 'n.tahun_insert'=> $thn_periode);
    			$e 	= array( 'r.buat_ski' => 'BELUM', 'r.approve' => 'BELUM');

		    	/* Menampilkan data Approve karyawan pada tabel saat pembukaan SKI */
		    	$data['bawahan_1'] 				= $this->Model_atasan1->tampil_bawahan_1($a)->result(); 
		    	$data['bawahan'] 				= $this->Model_atasan1->tampil_bawahan($a); 
		    	$data['bawahan_sudah'] 			= $this->Model_atasan1->tampil_bawahan_sudah($a)->result(); 
		    	$data['bawahan_sudah_1'] 		= $this->Model_atasan1->tampil_bawahan_sudah_1($a); 
		    	$data['bawahan_belum_ski']		= $this->Model_atasan1->tampil_bawahan_blm_ski($e,$nipeg)->result();
		    	$data['bawahan_belum_ski_h']	= $this->Model_atasan1->tampil_bawahan_blm_ski_h($e,$nipeg);
		    	/* Batas akhir Menampilkan data Approve karyawan pada tabel saat pembukaan SKI */
    		}
    			
    	}
    	/* Batas akhir Menampilkan data Approve karyawan pada tabel saat pembukaan penilaian per triwulan */

    	$this->template->load('template_atasan_1', 'dashboard_atasan1',$data);
    }

    /********************************************************************************************************/
	/*																										*/
	/*										AKHIR DASHBOARD ATASAN 1										*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*										APPROVAL KARYAWAN												*/	
	/*																										*/
	/********************************************************************************************************/

    public function karyawan()
    {
    	$data['judul']='Data SKI Karyawan';
    	$nipeg = $this->session->userdata('ses_nipeg');
		$data['poto'] = $this->get_url_photo($nipeg);
    	$thn = $this->Model_atasan1->get_data_status()->result();
    	foreach ($thn as $t) {
    		$thn_periode = $t->tahun;
    	}
    	$data['thn'] = $thn_periode;

    	/* Menampilkan data Approve karyawan pada tabel saat pembukaan penilaian per triwulan */
    	$triwulan 	= $this->Model_atasan1->get_data_status();

    	foreach ($triwulan->result_array() as $tw) {
    		$jns_triwulan = $tw['status_tw'];

    		if ($jns_triwulan != 'SKI') {
    			$d = array( "rn.tahun" 				=> $thn_periode, 
    						"rn.jenis_realisasi" 	=> $jns_triwulan, 
    						"role.buat_ski" 		=> 'SUDAH',
    						"role.approve"			=> 'SUDAH');

	    		$data['belum_submit_nilai']		= $this->Model_atasan1->tampil_belum_submit_nilai($d,$nipeg)->result();
	    		$data['belum_submit_nilai_h']	= $this->Model_atasan1->tampil_belum_submit_nilai_h($d,$nipeg);

	    		$b = array("NIPEG_UP" 				=> $nipeg, 
    						"rn.tahun" 				=> $thn_periode, 
    						"rn.jenis_realisasi" 	=> $jns_triwulan, 
    						"APPROVE_$jns_triwulan" => 'BELUM');

	    		$data['belum_nilai_bawahan']		= $this->Model_atasan1->tampil_belum_nilai_bawahan($b)->result();
	    		$data['belum_nilai_bawahan_hitung']	= $this->Model_atasan1->tampil_belum_nilai_bawahan_h($b);

	    		$c = array("NIPEG_UP" 				=> $nipeg, 
	    					"rn.tahun" 				=> $thn_periode, 
	    					"rn.jenis_realisasi" 	=> $jns_triwulan, 
	    					"APPROVE_$jns_triwulan !=" => 'BELUM');

	    		$data['sudah_nilai_bawahan']		= $this->Model_atasan1->tampil_sudah_nilai_bawahan($c)->result();
	    		$data['sudah_nilai_bawahan_hitung']	= $this->Model_atasan1->tampil_sudah_nilai_bawahan_h($c);
    		} else {
    			$a 	= array('NIPEG_UP' => $nipeg, 'n.tahun_insert'=> $thn_periode);
    			$e 	= array( 'r.buat_ski' => 'BELUM', 'r.approve' => 'BELUM');

		    	/* Menampilkan data Approve karyawan pada tabel saat pembukaan SKI */
		    	$data['bawahan_1'] 				= $this->Model_atasan1->tampil_bawahan_1($a)->result(); 
		    	$data['bawahan'] 				= $this->Model_atasan1->tampil_bawahan($a); 
		    	$data['bawahan_sudah'] 			= $this->Model_atasan1->tampil_bawahan_sudah($a)->result(); 
		    	$data['bawahan_sudah_1'] 		= $this->Model_atasan1->tampil_bawahan_sudah_1($a); 
		    	$data['bawahan_belum_ski']		= $this->Model_atasan1->tampil_bawahan_blm_ski($e,$nipeg)->result();
		    	$data['bawahan_belum_ski_h']	= $this->Model_atasan1->tampil_bawahan_blm_ski_h($e,$nipeg);
		    	/* Batas akhir Menampilkan data Approve karyawan pada tabel saat pembukaan SKI */
    		}
    			
    	}
    	/* Batas akhir Menampilkan data Approve karyawan pada tabel saat pembukaan penilaian per triwulan */

    	$datatst 	= $this->Model_karyawan->get_data_tst(1)->result(); 
		foreach ($datatst as $key) {
			$data['tst'] = $key->TST;
		}
		// Batas akhir mengambil variable untuk Tanggal Count Down Date

		// Mengambil variable status untuk perubahan kondisi status
		$status = $this->Model_karyawan->get_data_status();

		foreach ($status->result_array()  as $st ) {
			$data['status'] = $st['status_tw'];
		}
		$this->template->load('template_atasan_1','atasan/lihat_data', $data);
    }

    /********************************************************************************************************/
	/*																										*/
	/*									AKHIR APPROVAL KARYAWAN												*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*							LIHAT PENETAPAN SKI KARYAWAN BAWAHAN										*/	
	/*																										*/
	/********************************************************************************************************/

    public function karyawan_penetapan($nipeg)
    {
    	$nipeg_up 		 = $this->session->userdata('ses_nipeg');
    	$param_nipeg = $nipeg;

    	$data['judul']		 = 'Approval Penetapan SKI';
    	$data['param_nipeg'] = $nipeg;
    	$data['poto'] 		 = $this->get_url_photo($nipeg_up);

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);

		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($param_nipeg)->result_array();

			foreach ($ambil_divisi as $d) {
				$divisi = $d['DIVISI'];
				
				$c = array('pp.DIVISI' => $divisi, 'TAHUN_INSERT' => $thn);
				$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty($c)->result();
			}

		$a = array('r.NIPEG' => $param_nipeg);	

		$data['data_karyawan'] 		= $this->Model_atasan1->get_data_karyawan_nilai($param_nipeg,$thn)->row_array();
		$data['status_approve'] 	= $this->Model_atasan1->get_nama_karyawan_nilai_2($a)->row();

    	$data['data_target_utama'] 	= $this->Model_atasan1->get_target_utama_nilai($param_nipeg,$thn)->result();
		$data['data_target_sla'] 	= $this->Model_atasan1->get_target_sla_nilai($param_nipeg,$thn)->result();

    	$this->template->load('template_atasan_1','atasan/lihat_penetapan', $data);
    }

    /********************************************************************************************************/
	/*																										*/
	/*								UBAH PENETAPAN SKI KARYAWAN BAWAHAN										*/	
	/*																										*/
	/********************************************************************************************************/

    public function ubah_penetapan($nipeg)
    {
    	$nipeg_up 		= $this->session->userdata('ses_nipeg');
    	$param_nipeg 	= $nipeg;
    	
    	$data['judul']		 = 'Ubah Penetapan SKI Karyawan';
    	$data['param_nipeg'] = $nipeg;
		$data['poto'] 		 = $this->get_url_photo($nipeg_up);

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($param_nipeg)->result_array();

			foreach ($ambil_divisi as $d) {
				$divisi = $d['DIVISI'];
				
				$c = array('pp.DIVISI' => $divisi, 'TAHUN_INSERT' => $thn);
				$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty($c)->result();
			}

		$data['data_karyawan'] 		= $this->Model_atasan1->get_data_karyawan_nilai($param_nipeg,$thn)->row_array();	
		$data['nm'] 		= $this->Model_atasan1->get_nama_karyawan_nilai($param_nipeg,$thn)->row();

    	$data['data_target_utama'] 	= $this->Model_atasan1->get_target_utama_nilai($param_nipeg,$thn)->result();
		$data['data_target_sla'] 	= $this->Model_atasan1->get_target_sla_nilai($param_nipeg,$thn)->result();

    	$this->template->load('template_atasan_1','atasan/ubah_penetapan', $data);
    }

    /*******************************************************************************************************
						SIDEBAR >>> KARYAWAN >>> FUNGSI UBAH NILAI PENETAPAN SKI KARYAWAN
	*******************************************************************************************************/
	
	public function ubah_nilai()
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}
			
		$nipeg = $this->input->post('NIPEG');
		
		$data = array();
		foreach($nipeg AS $key => $val)
		    {
			     $data[] = array(
			      "id_nilai"		=> $_POST['id_nilai'][$key],
			      "NIPEG"  			=> $_POST['NIPEG'][$key],
			      "id_indikator"  	=> $_POST['id_indikator'][$key],
			      "id_proker"		=> $_POST['id_proker'][$key],
			      "target_pertahun"	=> $_POST['target_pertahun'][$key],
			      "bobot"  			=> $_POST['bobot'][$key],
			      "tw1"  			=> $_POST['tw1'][$key],
			      "tw2"  			=> $_POST['tw2'][$key],
			      "tw3"  			=> $_POST['tw3'][$key],
			      "tw4"  			=> $_POST['tw4'][$key],
			      "tahun_update" 	=> date('Y')
					);
		    }  

		$this->Model_karyawan->get_ubah_nilai($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengubah Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
	}

	/*******************************************************************************************************
						SIDEBAR >>> KARYAWAN >>> FUNGSI SUBMIT NILAI PENETAPAN SKI KARYAWAN
	*******************************************************************************************************/

	public function submit_nilai($id)
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		$data = [
		    'approve' => 'SUDAH',
		    'approve_datetime' => date('Y-m-d H:i:s', now('Asia/Jakarta'))
		];

		$this->Model_atasan1->update_approve_ski(array('NIPEG' => $id) ,$data);

		$data = [
		    'ATASAN_1' 					=> $this->session->userdata('ses_nipeg'),
		    'approve_atasan1_datetime' 	=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
		];

		$this->Model_atasan1->update_approve_ski_nilai(array('NIPEG' => $id,'tahun_insert'=>$thn) ,$data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengirim Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status" => TRUE));
	}

	/*******************************************************************************************************
							SIDEBAR >>> KARYAWAN >>> LIHAT NILAI TRIWULAN SKI KARYAWAN
	*******************************************************************************************************/

	public function karyawan_penilaian($nipeg)
	{
    	$nipeg_up 	 = $this->session->userdata('ses_nipeg');
		$param_nipeg = $nipeg;
    	
		$data['judul']		= 'Approval Penilaian SKI Karyawan';
		$data['poto'] 		= $this->get_url_photo($nipeg_up);
    	$data['param_nipeg']= $param_nipeg;

		$triwulan 	= $this->Model_atasan1->get_data_status();

	    	foreach ($triwulan->result_array() as $tw) {
	    		$jns_triwulan 	= $tw['status_tw'];
	    		$thn 		  	= $tw['tahun'];
	    		$data['status'] = $tw['status_tw'];
				$data['thn']	= $tw['tahun'];
				$data['tst']	= $tw['TST'];

	    		$e = array(
	    			"rn.NIPEG" => $param_nipeg, 
	    			"tahun" => $thn, 
	    			"jenis_realisasi" => $jns_triwulan);

	    		$data['approve'] 			= "APPROVE_$jns_triwulan";
	    		$data['target_utama_nilai']	= $this->Model_atasan1->get_target_utama($e)->result();
	    		$data['ambil_nilai']		= $this->Model_atasan1->get_data($e)->row();
	    		$data['target_sla_nilai']	= $this->Model_atasan1->get_target_sla($e)->result();
	    	}

		$data['data_karyawan'] 		= $this->Model_atasan1->get_data_karyawan_nilai($param_nipeg,$thn)->row_array();	
		$data['nama_karyawan'] 		= $this->Model_atasan1->get_nama_karyawan_nilai($param_nipeg,$thn)->result();

    	// Mengambil data penalty
    	$status 			= $this->Model_karyawan->get_data_status();
		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();

			foreach ($ambil_divisi as $d) {
				$divisi = $d['DIVISI'];
				
				foreach ($status->result_array()  as $st ) { 
					$status_tw 			= $st['status_tw'];
					$data['status_tw'] 	= $st['status_tw'];

					$c = array('pr.DIVISI' => $divisi, 'TAHUN' => $thn, 'JENIS_REALISASI' => $status_tw);
					$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty_tw($c)->result();
				}
			}

    	$this->template->load('template_atasan_1','atasan/lihat_penilaian', $data);
	}

	/*******************************************************************************************************
							SIDEBAR >>> KARYAWAN >>> FUNGSI UBAH NILAI TRIWULAN SKI KARYAWAN
	*******************************************************************************************************/

	public function ubah_nilai_real($nipeg)
	{
		$data['judul']='Ubah Penilaian SKI Karyawan';
		$nip = $this->session->userdata('ses_nipeg');
		$data['poto'] = $this->get_url_photo($nip);

		$param_nipeg = $nipeg;
		$data['param_nipeg'] = $nipeg;
		

		// Mengambil data penalty
    	$status 			= $this->Model_karyawan->get_data_status();
		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();

			foreach ($ambil_divisi as $d) {
				$divisi = $d['DIVISI'];
				
				foreach ($status->result_array()  as $st ) { 
					$status_tw 			= $st['status_tw'];
					$data['status_tw'] 	= $st['status_tw'];
					$data['status'] 	= $st['status_tw'];
					$data['thn']		= $st['tahun'];
					$data['tst'] 		= $st['TST'];
					$thn 				= $st['tahun'];

					$c = array('pr.DIVISI' => $divisi, 'TAHUN' => $thn, 'JENIS_REALISASI' => $status_tw);
					$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty_tw($c)->result();
				}
			}

		$data['data_karyawan']	= $this->Model_atasan1->get_data_karyawan_nilai($param_nipeg,$thn)->row_array();
		$data['nama_karyawan']	= $this->Model_atasan1->get_nama_karyawan_nilai($param_nipeg,$thn)->result();

		$triwulan 	= $this->Model_atasan1->get_data_status();

	    	foreach ($triwulan->result_array() as $tw) {
	    		$jns_triwulan = $tw['status_tw'];

	    		$e = array(
	    			"rn.NIPEG" => $param_nipeg, 
	    			"tahun" => $thn, 
	    			"jenis_realisasi" => $jns_triwulan);

	    		$data['approve'] = "APPROVE_$jns_triwulan";
	    		$data['target_utama_nilai']	= $this->Model_atasan1->get_target_utama($e)->result();
	    		$data['ambil_nilai']	= $this->Model_atasan1->get_data($e)->row();
	    		$data['target_sla_nilai']	= $this->Model_atasan1->get_target_sla($e)->result();
	    	}
    	
		$this->template->load('template_atasan_1','atasan/ubah_penilaian', $data);
	}

	/*******************************************************************************************************
						SIDEBAR >>> KARYAWAN >>> FUNGSI SIMPAN UBAH NILAI TRIWULAN SKI KARYAWAN
	*******************************************************************************************************/

	public function simpan_nilai_real()
	{
		$nipeg = $this->input->post('NIPEG');

		foreach ($nipeg as $key => $value) 
		{
			$data[] = array(
				"id_realisasi"		=> $_POST['id_realisasi'][$key],
				"realisasi"			=> $_POST['realisasi'][$key],
				"nilai_realisasi"	=> $_POST['nilai_realisasi'][$key],
				"total_realisasi"	=> $_POST['total_realisasi'],
				"nilai_ski"			=> $_POST['total_nilai_ski'][$key]
			);
		}

		$this->Model_atasan1->get_ubah_nilai_real($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengubah realisasi Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
	}


	/*******************************************************************************************************
							SIDEBAR >>> KARYAWAN >>> FUNGSI SUBMIT NILAI TRIWULAN SKI KARYAWAN
	*******************************************************************************************************/

	public function submit_nilai_real($id)
	{
		$triwulan 	= $this->Model_atasan1->get_data_status();

    	foreach ($triwulan->result_array() as $tw) {
    		$jns_triwulan = $tw['status_tw'];
    		$thn 		  = $tw['tahun'];

    		$data = [
		    "APPROVE_$jns_triwulan" => 'ATASAN1',
		    "approve_nilai_datetime" => date('Y-m-d H:i:s', now('Asia/Jakarta'))
					];
			$this->Model_atasan1->update_approve_ski(array('NIPEG' => $id) ,$data);
    	}

    	$e = array(
    			"NIPEG" => $id, 
    			"tahun" => $thn, 
    			"jenis_realisasi" => $jns_triwulan);

	    	$updt = [
		    	"ATASAN_1" => $this->session->userdata('ses_nipeg'),
		    	"approve_atasan1_datetime"=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
			];
			$this->Model_atasan1->update_tgl_approve($e ,$updt);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengirim Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status" => TRUE));
	}

}