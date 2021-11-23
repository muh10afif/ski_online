<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_karyawan');
		$this->load->model('Model_history_ski');
		$this->load->model('Model_histori_karyawan_bag_admin');
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
	/*											DASHBOARD KARYAWAN  										*/	
	/*																										*/
	/********************************************************************************************************/

	public function tes()
	{
		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$tst	= $st['TST'];
				$tmt	= $st['TMT'];
			}
		$a = date('Y-m-d H:i:s', now('Asia/Jakarta'));

		/*(abs(strtotime ($date1) - strtotime ($date2)) )/(60*60*24)

		echo (abs(strtotime ($date1) -  strtotime ($date2)) )/(60*60*24);
*/
		/*$awal = date_create($tst);
		$akhir = date_create($a); // waktu sekarang
		$diff  = date_diff( $awal, $akhir );

		echo 'Selisih waktu: ';
		echo $diff->y . ' tahun, ';
		echo $diff->m . ' bulan, ';
		echo $diff->d . ' hari, ';
		echo $diff->h . ' jam, ';
		echo $diff->i . ' menit, ';
		echo $diff->s . ' detik, ';*/
		// Output: Selisih waktu: 28 tahun, 5 bulan, 9 hari, 13 jam, 7 menit, 7 detik

		$awal  = strtotime('$a');
		$akhir = strtotime('$tst');
		echo $diff  = $akhir - $awal;

		$jam   = floor($diff / (60 * 60));
		$menit = $diff - $jam * (60 * 60);
		echo 'Waktu tinggal: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';

	}

	public function index()
	{
		$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']	= 'Dashboard karyawan';
		$data['poto'] 	= $this->get_url_photo($nipeg);

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['tst']	= $st['TST'];
				$thn=$data['thn']	= $st['tahun'];

				$hasil = array('r.tahun' => $st['tahun'], 'r.jenis_realisasi' => $st['status_tw'], 'r.NIPEG' => $nipeg );

				$data['w'] 			 = $this->Model_karyawan->get_data_waktu($hasil);
				$data['data_status'] = $this->Model_karyawan->get_data_status_real($hasil)->row();
			}

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $st['tahun']);

		//MEMBUAT KONDISI CHART UNTUK TW

		$versi=$this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

		$data['status_pembuatan_ski']	= $this->Model_karyawan->status_ski($nip_karyawan);	
		$data['data_karyawan']			= $this->Model_karyawan->get_data_karyawan_1($nipeg)->result(); 
		$data['nm'] 					= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$st['tahun'],$versi)->row();
		
		//parameter tahun untuk mengambil count grafik
		$thn_grafik = $st['tahun'];
		$st_tw 		= $st['status_tw'];
		// Mengambil variable untuk status pada chart.js
		$divisi 	= $this->Model_karyawan->get_data_karyawan_1($nipeg)->result();

			foreach ($divisi as $key) 
			{
				$id_divisi = array('k.DIVISI'=> $key->DIVISI);
				//penetapan
				$data['blum']	= $this->Model_karyawan->get_data_jml_blm_ski_divisi($id_divisi,$thn_grafik);
				$data['sdah']	= $this->Model_karyawan->get_data_jml_sdh_ski_divisi($id_divisi,$thn_grafik);
				
				//Triwulan
			    		
	    		$data['Sudah_submit_tw']	= $this->Model_karyawan->get_jumlah_sudah_tw($st_tw,$thn_grafik,$id_divisi);
				$data['Belum_submit_tw']	= $this->Model_karyawan->get_jumlah_belum_tw($st_tw,$thn_grafik,$id_divisi);

			}
		// Batas akhir mengambil variable untuk status pada chart.js

		// jika status SKI
		if ($st_tw == "SKI") {

			// cari data penetapan pada tabel nilai
			$np = array('tahun_insert' => $thn_grafik,'NIPEG'  => $nipeg );
			$count_nilai = $this->Model_karyawan->count_penetapan_karyawan($np);

			// cari nipeg pada tabel role
			$st_buat_ski = $this->Model_karyawan->status_buat_ski($nipeg)->result_array();
				foreach ($st_buat_ski as $bs) {
					$status_buat = $bs['buat_ski'];
				}	

			$versi	=	$this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn_grafik);

			// ambil nilai waktu approve dan submit SKI
			$get_time = $this->Model_karyawan->get_waktu_ski($nipeg,$thn_grafik,$versi);
				foreach ($get_time->result_array()  as $tm ) {
					$atasan 			=  $tm['ATASAN_1'];
					$tgl_time 			=  $tm['input_time'];
					$tgl_time_atasan 	=  $tm['approve_atasan1_datetime'];
				}

				// jika di tabel nilai tidak ada dan status buat ski = BELUM
				if ( ($count_nilai == 0) && ($status_buat == "BELUM") ) {
					$data['status_1'] 			= 'Belum Membuat';
					$data['gambar'] 			= './assets/images/blum.png';
					$data['menunggu_atasan'] 	= '';
					$data['tgl']				= '';	

				// jika di tabel nilai ADA dan status buat ski = BARU
				}elseif ($status_buat == "BARU") {
					$data['status_1'] 			= 'Belum Membuat';
					$data['gambar'] 			= './assets/images/blum.png';
					$data['menunggu_atasan'] 	= '';
					$data['tgl']				= '';	

				// jika di tabel nilai ADA dan status buat ski = BELUM
				} elseif(($count_nilai != 0) && ($status_buat == "BELUM")) {

					$data['status_1'] 			= 'Sudah Mwmbuat';
					$data['gambar'] 			= './assets/images/belum_submit1.jpg';
					$data['menunggu_atasan'] 	= '<b>Belum Submit</b>';
					$data['tgl']				= '( Tanggal :<span style="font-size: 13px;" class="badge badge-success"> '.tgl_indo_timestamp($tgl_time).'</span> )';	

				// jika di tabel nilai ADA dan status buat ski = SUDAH dan approve atasan = NULL
				} elseif(($count_nilai != 0) && ($status_buat != "BELUM") && ($atasan == null)) {

					$data['gambar'] 			= './assets/images/wait2.png';
					$data['status_1'] 			= 'Sudah Submit';
					$data['tgl']				= '( Tanggal :<span style="font-size: 13px;" class="badge badge-success"> '.tgl_indo_timestamp($tgl_time).'</span> )';					
					$data['menunggu_atasan'] 	= '<b>Menunggu Aprove Atasan 1</b>';

				// jika di tabel nilai ADA dan status buat ski = SUDAH dan approve atasan SUDAH diapprove
				} elseif(($count_nilai != 0) && ($status_buat != "BELUM") && ($atasan != null)) {

					$data['gambar'] 			= './assets/images/succes.png';
					$data['status_1'] 			= 'Sudah Submit';
					$data['menunggu_atasan'] 	= '<b>Sudah Approve Atasan 1 ( Tanggal : <span style="font-size: 13px;" class="badge badge-warning">'.tgl_indo_timestamp($tgl_time_atasan).'</span> )</b>';	
					$data['tgl']				= '( Tanggal : <span style="font-size: 13px;" class="badge badge-success"> '.tgl_indo_timestamp($tgl_time).'</span> )';	

				}

		}

		// jika status Triwulan 1 sampai 4
		else {

			// cek data nilai triwulan ada di tabel realisasi nilai atau tidak
			$cek_data_nilai = $this->Model_karyawan->status_gambar_tw($nipeg,$st_tw,$thn_grafik);

			$get_field_status = $this->Model_karyawan->get_field_status_tw($nipeg,$st_tw,$thn_grafik);
				foreach ($get_field_status->result_array() as $field) {
					 $field_status 	= $field['status'];
					 $tgl_realisasi = $field['input_time'];
					 $tgl_approve1 	= $field['approve_atasan1_datetime'];
					 $tgl_approve2 	= $field['approve_atasan2_datetime'];
					 $atasan1 		= $field['ATASAN_1'];
					 $atasan2 		= $field['ATASAN_2'];
				}

			// cek data ada atau tidak pada tabel realisasi nilai
			if ($cek_data_nilai == 0) {

				$data['status_1'] 			= 'Belum Membuat';
				$data['gambar'] 			= './assets/images/blum.png';
				$data['menunggu_atasan'] 	= '';
				$data['tgl']				= '';

			// jika data ADA dan status masih SIMPAN
			} elseif ( ($cek_data_nilai != 0) && ($field_status == "SIMPAN") ) {
				
				$data['gambar'] 			= './assets/images/belum_submit1.jpg';
				$data['status_1'] 			= 'Sudah Membuat';
				$data['menunggu_atasan'] 	= '<b>Belum Submit</b>';
				$data['tgl']				= '( Tanggal : <span style="font-size: 13px;" class="badge badge-success"> '.tgl_indo_timestamp($tgl_realisasi).'</span> )';

			// jika data ADA dengan status telah KIRIM
			} elseif ( ($cek_data_nilai != 0) && ($field_status == "KIRIM") ) {
				
				// jika data telah KIRIM tetapi belum approve atasan 1
				if (($atasan1 == null) && ($atasan2 == null)) {
					
					$data['gambar'] 			= './assets/images/atasan1.png';
					$data['status_1'] 			= 'Sudah Submit';
					$data['menunggu_atasan'] 	= '<b>Menunggu Aprove Atasan 1</b>';
					$data['tgl']				= '( Tanggal : <span style="font-size: 13px;" class="badge badge-success"> '.tgl_indo_timestamp($tgl_realisasi).'</span> )';

				// jika data telah KIRIM, sudah approve atasan1 tetapi belum approve atasan 2
				} elseif ( ($atasan1 != null) && ($atasan2 == null) ) {
					
					$data['gambar'] 			= './assets/images/wait2.png';
					$data['status_1'] 			= 'Sudah Approve atasan 1';
					$data['menunggu_atasan'] 	= '<b>Menunggu Aprove Atasan 2</b>';
					$data['tgl']				= '( Tanggal : <span style="font-size: 13px;" class="badge badge-success"> '.tgl_indo_timestamp($tgl_approve1).'</span> )';

				// jika data telah KIRIM, sudah approve atasan1 dan sudah approve atasan 2
				} elseif ( ($atasan1 != null) && ($atasan2 != null) ) {
					
					if ($st_tw  == 'TW1') {
						$triwulannya = 'I';
					}elseif ($st_tw  == 'TW2') {
						$triwulannya = 'II';
					}elseif ($st_tw  == 'TW3') {
						$triwulannya = 'III';
					}else{
						$triwulannya = 'IV';
					}

					$data['gambar'] 			= './assets/images/succes.png';
					$data['status_1'] 			= 'Sudah Submit ';
					$data['menunggu_atasan'] 	= '<b style="font-size:15px;">Triwulan '.$triwulannya.' sudah di ACC</b><br>
													Approve Atasan 1 ( Tanggal : <span style="font-size: 13px;" class="badge badge-success"> '.tgl_indo_timestamp($tgl_approve1).'</span> )<br>
													Approve Atasan 2 ( Tanggal : <span style="font-size: 13px;" class="badge badge-warning"> '.tgl_indo_timestamp($tgl_approve2).'</span> )';
					$data['tgl']				= '';	

				}

			} // akhir kondisi cek_data_nilai

		} // akhir kondisi pengecekan status $st_tw apakah SKI atau Triwulan

		$this->template->load('template_karyawan','dashboard_karyawan',$data);
	}

	/*******************************************************************************************************
										SIDEBAR >>>> BUAT - SKI
	*******************************************************************************************************/

	public function buat_ski()
	{
		// Mengambil session NIPEG
		$nipeg 	= $this->session->userdata('ses_nipeg'); 

		$data['judul']		= "Buat SKI";
		$data['poto']		= $this->get_url_photo($nipeg);
		$data['buat_ski']	= "karyawan";

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$status_tw 		= $st['status_tw'];
				$data['tahun']	= $st['tahun'];
				$data['status'] = $status_tw;
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

		$jobtitle = $this->Model_karyawan->get_karyawan($nipeg)->result_array();

			foreach ($jobtitle as $jb) {
				$job = $jb['JOBTITLE'];
			}

		$versi	=	$this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);	

		$data['nm'] 					= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn,$versi)->row();
		$data['status_pembuatan_ski'] 	= $this->Model_karyawan->status_ski($nip_karyawan);	
		$data['data_karyawan'] 			= $this->Model_karyawan->get_karyawan($nipeg)->row_array();
		$data['cari_indikator'] 		= $this->Model_karyawan->get_nama_karyawan($job)->result();
		$data['data_target_utama'] 		= $this->Model_karyawan->get_target_utama($job)->result();
		$data['data_target_sla'] 		= $this->Model_karyawan->get_target_sla($job)->result();
		$data['versi']					= $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn)+1;

		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();
		foreach ($ambil_divisi as $d) {
			$divisi = $d['DIVISI'];
			
			$c = array('pp.DIVISI' => $divisi, 'TAHUN_INSERT' => $thn);
			$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty($c)->result();
		}

		$this->template->load('template_karyawan','ski/buat_ski', $data);
	}

	/*******************************************************************************************************
										FUNGSI AKSI >>>> BUAT - SKI
	*******************************************************************************************************/

	public function tambah_ski()
	{
		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) 
			{
				$thn	= $st['tahun'];
			}

		$nipeg = $this->input->post('NIPEG');
		
		$result = array();
		foreach($nipeg AS $key => $val)
	    {
		     $result[] = array(
		      "NIPEG"  			=> $_POST['NIPEG'][$key],
		      "versi"  			=> $_POST['versi'][$key],
		      "id_indikator"  	=> $_POST['id_indikator'][$key],
		      "id_proker"		=> $_POST['id_proker'][$key],
		      "target_pertahun"	=> $_POST['target_pertahun'][$key],
		      "bobot"  			=> $_POST['bobot'][$key],
		      "tw1"  			=> $_POST['tw1'][$key],
		      "tw2"  			=> $_POST['tw2'][$key],
		      "tw3"  			=> $_POST['tw3'][$key],
		      "tw4"  			=> $_POST['tw4'][$key],
		      "H_JOBTITLE" 		=> $_POST['jobtitle'][$key],
		      "H_DIVISI"  		=> $_POST['divisi'][$key],
		      "H_BAGIAN"  		=> $_POST['bagian'][$key],
		      "H_URUSAN"  		=> $_POST['urusan'][$key],
		      "H_PANGKAT"  		=> $_POST['pangkat'][$key],
		  	  "tahun_insert"  	=> $thn,
		  	  "input_time"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
				);
	    }   
		$this->Model_karyawan->simpan_nilai($result);

		echo json_encode(array("status"=> TRUE));
	}

	/*******************************************************************************************************
										SIDEBAR >>>> UBAH - SKI
	*******************************************************************************************************/

	public function ubah_ski()
	{
		$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']		= "Penetapan SKI";
		$data['buat_ski']	= "karyawan";
		$data['poto']		= $this->get_url_photo($nipeg);

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$status_tw 		= $st['status_tw'];
				$data['thn']	= $st['tahun']; 
				$data['status'] = $status_tw;
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun']; 

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);	

		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();
		foreach ($ambil_divisi as $d) {
			$divisi = $d['DIVISI'];
			
			$c = array('pp.DIVISI' => $divisi, 'TAHUN_INSERT' => $thn);
			$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty($c)->result();
		}

		$versi=$this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

		$data['status_pembuatan_ski'] 	= $this->Model_karyawan->status_ski($nip_karyawan);	
		$data['data_karyawan']			= $this->Model_karyawan->get_data_karyawan_nilai($nipeg,$thn, $versi)->row_array();
		$data['nama_karyawan'] 			= $this->Model_karyawan->get_nama_karyawan_nilai($nipeg,$thn, $versi)->result();
		$data['nm'] 					= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn, $versi)->row();
		$data['data_target_utama'] 		= $this->Model_karyawan->get_target_utama_nilai_his($nipeg,$thn,$versi)->result();
		$data['data_target_sla'] 		= $this->Model_karyawan->get_target_sla_nilai_his($nipeg,$thn,$versi)->result();

		$data['versi']					= $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn)+1;

		$this->template->load('template_karyawan','ski/ubah_ski',$data);
	}

	/*******************************************************************************************************
										FUNGSI AKSI >>>> UBAH - SKI
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
			      "tahun_update" 	=> $thn,
			      "input_time"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
				);
		    }  

		$this->Model_karyawan->get_ubah_nilai($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengubah Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
	}

	/*******************************************************************************************************
									FUNGSI AKSI KIRIM NILAI >>>> UBAH - SKI
	*******************************************************************************************************/
	public function submit_nilai($id)
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
			      "tahun_update" 	=> $thn,
			      "input_time"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
				);
		    }  

		
		$this->Model_karyawan->get_ubah_nilai($data);
		
		$data1 = [
		    'BUAT_SKI' => 'SUDAH' 
		];


		$this->Model_karyawan->update_status_ski(array('NIPEG' => $id) ,$data1);


		echo json_encode(array("status" => TRUE));
	}


	public function submit_nilai_langsung()
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		$nipeg = $this->input->post('NIPEG');
		$n = $nipeg[0];
		
		$result = array();
		foreach($nipeg AS $key => $val)
		    {
			     $result[] = array(
			      "NIPEG"  			=> $_POST['NIPEG'][$key],
			      "versi"  			=> $_POST['versi'][$key],
			      "id_indikator"  	=> $_POST['id_indikator'][$key],
			      "id_proker"		=> $_POST['id_proker'][$key],
			      "target_pertahun"	=> $_POST['target_pertahun'][$key],
			      "bobot"  			=> $_POST['bobot'][$key],
			      "tw1"  			=> $_POST['tw1'][$key],
			      "tw2"  			=> $_POST['tw2'][$key],
			      "tw3"  			=> $_POST['tw3'][$key],
			      "tw4"  			=> $_POST['tw4'][$key],
			      "H_JOBTITLE" 		=> $_POST['jobtitle'][$key],
			      "H_DIVISI"  		=> $_POST['divisi'][$key],
			      "H_BAGIAN"  		=> $_POST['bagian'][$key],
			      "H_URUSAN"  		=> $_POST['urusan'][$key],
			      "H_PANGKAT"  		=> $_POST['pangkat'][$key],
			  	  "tahun_insert"  	=> $thn,
			  	  "input_time"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
					);
		    }   

		$this->Model_karyawan->simpan_nilai($result);

		// Merubah status buat SKI

		$data = [ 'buat_ski' => 'SUDAH' ];

		$this->Model_karyawan->update_status_ski(array('NIPEG' => $n) ,$data);

		echo json_encode(array("status"=> TRUE));
	}

	/*******************************************************************************************************
										SIDEBAR >>>> NILAI SKI
	*******************************************************************************************************/

	public function penilaian_ski()
	{
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto']	= $this->get_url_photo($nipeg);
		$data['judul']	= "Penilaian SKI";
		$data['buat_tw']= "karyawan";

		$status = $this->Model_karyawan->get_data_status()->result_array();

			foreach ($status as $st) {
				$nipeg = $this->session->userdata('ses_nipeg');
				$hasil = array('r.tahun' => $st['tahun'], 'r.jenis_realisasi' => $st['status_tw'], 'r.NIPEG' => $nipeg );

				$data['w'] 			 = $this->Model_karyawan->get_data_waktu($hasil);
				$data['data_status'] = $this->Model_karyawan->get_data_status_real($hasil)->row();
				$data['tst'] 	= $st['TST'];
				$data['thn']	= $st['tahun'];
				$status_tw 		= $st['status_tw'];
				$data['status'] = $status_tw;

				$thn 	= $st['tahun'];

				$data['versi']=$versi=$this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

				$data['data_target_utama']	= $this->Model_karyawan->get_target_utama_tw($nipeg,$thn,$versi)->result();
				$data['data_target_sla']	= $this->Model_karyawan->get_target_sla_tw($nipeg,$thn,$versi)->result();

				$data['data_utama_nilai']	= $this->Model_karyawan->get_preview_target_utama($nipeg,$thn,$status_tw)->result();
				$data['data_sla_nilai']		= $this->Model_karyawan->get_preview_target_sla($nipeg,$thn,$status_tw)->result();
				
				$data['status_nilai']		= $this->Model_karyawan->ambil_status($nipeg,$thn,$status_tw)->row();
			}

		

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);	
		$dt = array('NIPEG' => $nipeg, 'tahun'=> $thn);	

		$data['nm'] 					= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn,$versi)->row();
		$data['status_pembuatan_ski'] 	= $this->Model_karyawan->status_ski($nip_karyawan);	
		$data['status_penilaian_ski'] 	= $this->Model_karyawan->status_ski_2($dt);	

		$data['data_karyawan'] 			= $this->Model_karyawan->get_data_karyawan_nilai($nipeg,$thn,$versi)->row_array();
		$data['nama_karyawan'] 			= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn,$versi)->result();

		$data['waktu'] = $this->Model_karyawan->get_data_status()->row_array();
		
		$ambil_divisi  = $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();

			foreach ($ambil_divisi as $d) {
				$divisi = $d['DIVISI'];
				
				foreach ($status as $st ) { 
					$status_tw 			= $st['status_tw'];

					$c = array('pr.DIVISI' => $divisi, 'TAHUN' => $thn, 'JENIS_REALISASI' => $status_tw);
					$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty_tw($c)->result();
				}
			}

		$this->template->load('template_karyawan','ski/penilaian_ski',$data);
		
	}

	/*******************************************************************************************************
								FUNGSI AKSI KIRIM REALISASI NILAI >>>> NILAI - SKI
	*******************************************************************************************************/

	// Fungsi untuk tambah nilai ski triwulan
	public function tambah_nilai_tw()
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		$nipeg = $this->input->post('NIPEG');
		
		foreach($nipeg AS $key => $val)
		    {
			   $data[] = array(
			      "NIPEG"  			=> $_POST['NIPEG'][$key],
			      "versi"  			=> $_POST['versi'][$key],
			      "id_indikator"  	=> $_POST['id_indikator'][$key],
			      "id_proker"		=> $_POST['id_proker'][$key],
			      "target_pertahun"	=> $_POST['target_pertahun'][$key],
			      "bobot"			=> $_POST['bobot'][$key],
			      "nilai_penetapan" => $_POST['nilai_penetapan'][$key],
			      "realisasi"		=> $_POST['realisasi'][$key],
			      "nilai_realisasi" => $_POST['nilai_realisasi'][$key],
			      "total_realisasi" => $_POST['total_realisasi'][$key],
			      "jenis_realisasi" => $_POST['jenis_realisasi'][$key],
			      "nilai_ski"		=> $_POST['total_nilai_ski'][$key],
			      "status"			=> 'SIMPAN',
			      "tahun"			=> $thn,
			      "input_time"		=> date('Y-m-d H:i:s',now('Asia/Jakarta')),
			      "TMT"				=> $_POST['TMT'][$key],
			      "TST"				=> $_POST['TST'][$key]
					);
		    }  

		$this->Model_karyawan->realisasi_nilai($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; menyimpan Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		
		echo json_encode(array("status" => TRUE));
	}

	public function kirim_nilai_tw()
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		$nipeg = $this->input->post('NIPEG');
		
		foreach($nipeg AS $key => $val)
		    {
			   $data[] = array(
			      "NIPEG"  			=> $_POST['NIPEG'][$key],
			      "versi"  			=> $_POST['versi'][$key],
			      "id_indikator"  	=> $_POST['id_indikator'][$key],
			      "id_proker"		=> $_POST['id_proker'][$key],
			      "target_pertahun"	=> $_POST['target_pertahun'][$key],
			      "bobot"			=> $_POST['bobot'][$key],
			      "nilai_penetapan" => $_POST['nilai_penetapan'][$key],
			      "realisasi"		=> $_POST['realisasi'][$key],
			      "nilai_realisasi" => $_POST['nilai_realisasi'][$key],
			      "total_realisasi" => $_POST['total_realisasi'][$key],
			      "jenis_realisasi" => $_POST['jenis_realisasi'][$key],
			      "nilai_ski"		=> $_POST['total_nilai_ski'][$key],
			      "status"			=> 'KIRIM',
			      "tahun"			=> $thn,
			      "input_time"		=> date('Y-m-d H:i:s',now('Asia/Jakarta')),
			      "TMT"				=> $_POST['TMT'][$key],
			      "TST"				=> $_POST['TST'][$key]
					);
		    }  

		$this->Model_karyawan->realisasi_nilai($data);
		
		echo json_encode(array("status" => TRUE));	
	}

	// Fungsi simpan dari ubah nilai ski triwulan
	public function tambah_ubah_nilai_tw()
	{
		$nipeg = $this->input->post('NIPEG');
		
		foreach($nipeg AS $key => $val)
		    {
			   $data[] = array(
			   	  "id_realisasi"	=> $_POST['id_realisasi'][$key],
			      "realisasi"		=> $_POST['realisasi'][$key],
			      "nilai_realisasi" => $_POST['nilai_realisasi'][$key],
			      "total_realisasi" => $_POST['total_realisasi'][$key],
			      "nilai_ski"		=> $_POST['total_nilai_ski'][$key]
					);
		    }  

		$this->Model_karyawan->ubah_realisasi_nilai($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengubah Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		
		echo json_encode(array("status" => TRUE));
	}


	public function kirim_ubah_nilai_tw()
	{
		$nipeg = $this->input->post('NIPEG');
		
		foreach($nipeg AS $key => $val)
		    {
			   $data[] = array(
			   	  "id_realisasi"	=> $_POST['id_realisasi'][$key],
			      "realisasi"		=> $_POST['realisasi'][$key],
			      "nilai_realisasi" => $_POST['nilai_realisasi'][$key],
			      "total_realisasi" => $_POST['total_realisasi'][$key],
			      "status"			=> 'KIRIM',
			      "nilai_ski"		=> $_POST['total_nilai_ski'][$key]
					);
		    }  

		$this->Model_karyawan->ubah_realisasi_nilai($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengirim Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		
		echo json_encode(array("status" => TRUE));
	}

	/*******************************************************************************************************
											SIDEBAR >>>> HISTORY SKI
	*******************************************************************************************************/

	public function history_ski(){
		$data['judul']='Histori SKI';
		$nipeg = $this->session->userdata('ses_nipeg');
		$data['poto'] = $this->get_url_photo($nipeg);

		$status 	= $this->Model_karyawan->get_data_status();

		foreach ($status->result_array()  as $st ) {
			$status_tw = $st['status_tw'];
			$data['thn'] = $st['tahun'];
			$data['tst'] = $st['TST'];

			$data['status'] = $status_tw;

			$hasil = array('r.tahun' => $st['tahun'], 'r.jenis_realisasi' => $st['status_tw'], 'r.NIPEG' => $nipeg );

			$data['data_status'] = $this->Model_karyawan->get_data_status_real($hasil)->row();
		}

		$thn 		 = $st['tahun'];

		$versi =	$this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);	
		$data['status_pembuatan_ski'] = $this->Model_karyawan->status_ski($nip_karyawan);	
		$data['data_karyawan']	= $this->Model_karyawan->get_karyawan($nipeg)->row_array();
		$data['nama_karyawan']	= $this->Model_karyawan->get_nama_karyawan_nilai($nipeg,$thn,$versi)->result();
		$data['nm'] 			= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn,$versi)->row();

		$this->template->load('template_karyawan','ski/history', $data);
	}

    //MENGAMBIL DATA HISTORY TAHUNNYA SAJA
	function get_data_history()
    {
	  $nipeg = $this->session->userdata('ses_nipeg');
	  $nip = array('NIPEG' => $nipeg);
      $list = $this->Model_history_ski->get_datatables($nip);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) { 
            $no++;
            $row = array();
            $row[] = "<center>$no</center>";
            $row[] = "Penetapan dan Penilaian SKI tahun <strong>$r->tahun_insert</strong>";
  			$row[] = '<center><a href="histori_penetapan/'.$r->tahun_insert.'" class="btn btn-success btn-sm">V I E W</a></center>'; 
            $data[] = $row;            
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Model_history_ski->count_all($nip),
                        "recordsFiltered" => $this->Model_history_ski->count_filtered($nip),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    //REVIEW HISTORY PENETAPANNYA
	function histori_penetapan($thn)
	{
    	$nipeg = $this->session->userdata('ses_nipeg');

    	$data['judul']		 = 'Histori SKI Karyawan';
    	$data['histori']	 = 'karyawan';
    	$data['param_tahun'] = $thn;
		$data['poto'] 		 = $this->get_url_photo($nipeg);
    	$param_tahun 		 = $thn;

    	$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array() as $st ) {
				$status_tw 		= $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
				$data['status'] = $status_tw;

				$hasil = array('r.tahun' => $st['tahun'], 'r.jenis_realisasi' => $st['status_tw'], 'r.NIPEG' => $nipeg );

				$data['data_status'] = $this->Model_karyawan->get_data_status_real($hasil)->row();
			}

		$thn = $st['tahun'];

		$nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);

		$data['status_pembuatan_ski'] = $this->Model_karyawan->status_ski($nip_karyawan);	

    	//mengambil nama atasan

    	$nip = array('b.NIPEG' => $nipeg);

		$data['atasan1'] = $this->Model_karyawan->get_atasan($nip)->row_array();
		$data['atasan2'] = $this->Model_karyawan->get_atasan($nip)->row_array();
		
		//mengambil per triwulan

    	$tw = "TW1";

    	$data['total_tw1'] 				= $this->Model_karyawan-> get_total_tw($nipeg, $param_tahun, $tw)->row_array();
		$data['data_target_utama_tw1']  = $this->Model_karyawan->get_preview_target_utama($nipeg, $param_tahun, $tw)->result();
		$data['data_target_sla_tw1'] 	= $this->Model_karyawan-> get_preview_target_sla($nipeg, $param_tahun, $tw)->result();
		$data['count_tw1'] 				= $this->Model_karyawan->get_jumlah_tw($nipeg,$param_tahun,$tw);
		$data['waktu_tw1']			  	= $this->Model_karyawan->get_waktu_tw($nipeg,$param_tahun,$tw)->result();

    	$tw = "TW2";

    	$data['total_tw2'] 				= $this->Model_karyawan-> get_total_tw($nipeg, $param_tahun, $tw)->row_array();
		$data['data_target_utama_tw2'] 	= $this->Model_karyawan->get_preview_target_utama($nipeg, $param_tahun, $tw)->result();
		$data['data_target_sla_tw2'] 	= $this->Model_karyawan-> get_preview_target_sla($nipeg, $param_tahun, $tw)->result();
		$data['count_tw2'] 				= $this->Model_karyawan->get_jumlah_tw($nipeg,$param_tahun,$tw);
		$data['waktu_tw2']			 	= $this->Model_karyawan->get_waktu_tw($nipeg,$param_tahun,$tw)->result();

    	$tw = "TW3";

    	$data['total_tw3'] 				= $this->Model_karyawan-> get_total_tw($nipeg, $param_tahun, $tw)->row_array();
		$data['data_target_utama_tw3'] 	= $this->Model_karyawan->get_preview_target_utama($nipeg, $param_tahun, $tw)->result();
		$data['data_target_sla_tw3'] 	= $this->Model_karyawan-> get_preview_target_sla($nipeg, $param_tahun, $tw)->result();
		$data['count_tw3'] 				= $this->Model_karyawan->get_jumlah_tw($nipeg,$param_tahun,$tw);
		$data['waktu_tw3']			  	= $this->Model_karyawan->get_waktu_tw($nipeg,$param_tahun,$tw)->result();

		$tw = "TW4";

    	$data['total_tw4'] 				= $this->Model_karyawan-> get_total_tw($nipeg, $param_tahun, $tw)->row_array();
		$data['data_target_utama_tw4']  = $this->Model_karyawan->get_preview_target_utama($nipeg, $param_tahun, $tw)->result();
		$data['data_target_sla_tw4'] 	= $this->Model_karyawan-> get_preview_target_sla($nipeg, $param_tahun, $tw)->result();
		$data['count_tw4'] 				= $this->Model_karyawan->get_jumlah_tw($nipeg,$param_tahun,$tw);
		$data['waktu_tw4']			  	= $this->Model_karyawan->get_waktu_tw($nipeg,$param_tahun,$tw)->result();


		//pentapan
		$data['jml']=$jml 	= $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn)+1;		
		$versi				= $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

		$data['nm'] 				= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$param_tahun,$versi)->row();
		$data['data_karyawan'] 		= $this->Model_history_ski->get_data_karyawan_nilai($nipeg,$param_tahun,$versi)->row_array();
		$data['nama_karyawan'] 		= $this->Model_karyawan->get_nama_karyawan_nilai($nipeg,$param_tahun,$versi)->result();

		for($i=1; $i<$jml; $i++){
	    	$data['data_target_utama'.$i] =	$this->Model_karyawan->get_target_utama_nilai_his($nipeg,$param_tahun,$i)->result();
			$data['data_target_sla'.$i]   =	$this->Model_karyawan->get_target_sla_nilai_his($nipeg,$param_tahun,$i)->result();

			///status penetapan 
			$data['penetapan'.$i] = $this->Model_karyawan->get_data_karyawan_nilai($nipeg, $param_tahun,$i)->result_array();

			$data['waktu_ski'.$i] = $this->Model_karyawan->get_waktu_ski($nipeg,$param_tahun,$i)->row();
		}

		//pengambilan data penalti get_pinalti_penetapan($nipeg, $thn, $divisi)
		$nomor=0;
		$ambil_divisi = $this->Model_history_ski->get_divisi_baru($nipeg,$param_tahun)->result_array();
			foreach ($ambil_divisi as $key ) 
			{
				$nomor++;
				$data['divisi'.$nomor] = $key['H_JOBTITLE'];
				$divisi                = $key['H_DIVISI'];
			

				// penalti penetapan 
				$data['penalti_penetapan'.$nomor] = $this->Model_histori_karyawan_bag_admin->get_pinalti_penetapan($param_tahun, $divisi)->result();
			}

				//pinalti tw1
				$tw = 'TW1';
				$data['penalti_tw1'] 	= $this->Model_histori_karyawan_bag_admin->get_pinalti_tw($param_tahun, $divisi, $tw)->result();

				//pinalti tw2
				$tw = 'TW2';
				$data['penalti_tw2'] 	= $this->Model_histori_karyawan_bag_admin->get_pinalti_tw($param_tahun, $divisi, $tw)->result();

				//pinalti tw3
				$tw = 'TW3';
				$data['penalti_tw3'] 	= $this->Model_histori_karyawan_bag_admin->get_pinalti_tw($param_tahun, $divisi, $tw)->result();

				//pinalti tw4
				$tw = 'TW4';
				$data['penalti_tw4'] 	= $this->Model_histori_karyawan_bag_admin->get_pinalti_tw($param_tahun, $divisi, $tw)->result();
			

    	$this->template->load('template_karyawan','ski/histori_penetapan', $data);
    }

    	/*************************************************************************
						Halaman Atasan Langsung
    	*************************************************************************/
		
	public function atasan_langsung()
	{
		$nipeg_up 	= $this->session->userdata('ses_nipegup');
		$nipeg 		= $this->session->userdata('ses_nipeg');

		$data['judul']		 = 'SKI Atasan';
		$data['poto_atasan'] = $this->get_url_photo($nipeg_up);
		$data['poto']	 	 = $this->get_url_photo($nipeg);

		$status 	= $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$status_tw 	 	= $st['status_tw'];
				$data['thn'] 	= $st['tahun'];
				$data['status'] = $status_tw;
				$data['tst']	= $st['TST'];

				$hasil = array('r.tahun' => $st['tahun'], 'r.jenis_realisasi' => $st['status_tw'], 'r.NIPEG' => $nipeg );

				$data['data_status'] = $this->Model_karyawan->get_data_status_real($hasil)->row();
			}
	
		$thn 			= $st['tahun'];
		$nip_karyawan 	= array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);
		$nip_atasan 	= array('NIPEG' => $nipeg_up, 'tahun_insert'=> $thn);

		$versi				= $this->Model_karyawan->jumlah_penetapan_ski($nipeg_up,$thn);
		$versi1				= $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

		$data['data_target_utama']	 = $this->Model_karyawan->get_target_utama_nilai_his($nipeg_up,$thn, $versi)->result();
		$data['data_target_sla'] 	 = $this->Model_karyawan->get_target_sla_nilai_his($nipeg_up,$thn, $versi)->result();
		$data['data_karyawan'] 		 = $this->Model_history_ski->get_data_karyawan($nipeg_up)->row_array();
		$data['nama_karyawan'] 		 = $this->Model_karyawan->get_nama_karyawan($nipeg_up)->result();
		$data['nm'] 				 = $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn,$versi1)->row();
		$data['status_pembuatan_ski']= $this->Model_karyawan->status_ski($nip_karyawan);	
		$data['status_ski_atasan'] 	 = $this->Model_karyawan->status_ski($nip_atasan);	

		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();
		foreach ($ambil_divisi as $d) {
			$divisi = $d['DIVISI'];
			
			$c = array('pp.DIVISI' => $divisi, 'TAHUN_INSERT' => $thn);
			$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty($c)->result();
		}
			
		$this->template->load('template_karyawan','ski/preview_atasan', $data);

	}

		function print_penetapan()
		{
			$data['judul']='Print Penetapan SKI';
			$nipeg = $this->input->post('nipeg');
			$thn = $this->input->post('thn');
			$versi = $this->input->post('versi');

			$data['tahun'] = $thn ;
			$data['data_target_utama'] =$this->Model_karyawan->get_target_utama_nilai_his($nipeg,$thn,$versi)->result();
			$data['data_target_sla'] =$this->Model_karyawan->get_target_sla_nilai_his($nipeg,$thn,$versi)->result();

			$data['data_karyawan'] = $this->Model_history_ski->get_data_karyawan_nilai($nipeg,$thn,$versi)->row_array();
			$data['job_histori'] = $this->Model_karyawan->histori_job_karyawan($nipeg,$thn,$versi)->row_array();

			$ambil_divisi = $this->Model_history_ski->get_divisi_baru_satu($nipeg,$thn,$versi)->result_array();

			foreach ($ambil_divisi as $key ) {

				$divisi =  $key['H_DIVISI'];

				// penalti penetapan 

				$data['penalti_penetapan'] =$this->Model_histori_karyawan_bag_admin->get_pinalti_penetapan($thn, $divisi)->result();
				
			}

			$versi				= $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

			$e = array(
	          "a.NIPEG" 		=> $nipeg, 
	          "a.tahun_insert" 	=> $thn,
	      	  "a.versi" 		=> $versi);	
			
		    $data['ats1']= $this->Model_karyawan->get_atasan($e)->result(); 
			$this->load->view('ski/print/print_penetapan_karyawan',$data);	
		}

}
