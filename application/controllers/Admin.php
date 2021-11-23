<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Model_dashboard_karyawan');
		$this->load->model('Model_karyawan');
		$this->load->model('Model_history_ski');
		$this->load->model('Model_histori_karyawan_bag_admin');
		$this->load->model('Model_admin');
		$this->load->model('Model_master_rekap_data');
		if($this->session->userdata('masuk') != TRUE || $this->session->userdata('akses') != 'admin')
        {
            $url=base_url().'login';
            redirect($url);
        }

	}

	/********************************************************************************************************/
	/*										Ambil foto dengan WEB SERVICE 									*/
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
	//end getting image

	/********************************************************************************************************/
	/*										Akhir Ambil foto dengan WEB SERVICE 							*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*											DASHBOARD ADMIN 											*/
	/********************************************************************************************************/
	
	public function index()
	{		
		$data['judul']	= 'Dashboard Admin';

		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);

		$data['jml_karyawan'] = $this->Model_dashboard_karyawan->jml_karyawan();

		$div = $this->Model_dashboard_karyawan->jml_divisi()->result();
		$no = 1;
			foreach ($div as $key) {
				$data['jml_div'] = $no++;
			}

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$status 		= $st['status_tw'];
				$data['tst'] 	= $st['TST'];
				$thn 			= $st['tahun']; 

				$data['status']	= $status;
			}

		$tahun_insert =  array('tahun_insert' => $thn );
		$data['jml_ski_penetapan'] 	= $this->Model_dashboard_karyawan->jml_sdh_ski_penetapan($tahun_insert);
		$data['jml_blum_penetapan'] = $this->Model_dashboard_karyawan->jml_blm_ski_penetapan($tahun_insert);

		$data['sudah_approve_ski']	= $this->Model_dashboard_karyawan->jml_sdh_approve_ski($tahun_insert);
		$data['belum_approve_ski']	= $this->Model_dashboard_karyawan->jml_blm_approve_ski($tahun_insert);

		$data['chartpenetapan'] = $this->Model_dashboard_karyawan->chart_list()->result();
		$data['thn']= $thn;

		//bagian ambil divisi 
		$data['divisi'] = $this->Model_dashboard_karyawan->get_divisi()->result();

	   	$e 	= array('jenis_realisasi'=>$data['status'], 'tahun'=>$thn); 
		$data['sudahskitw'] = $this->Model_dashboard_karyawan->hitung_sudah_penilaian_tw($e);
		
		if ($status == 'SKI')
		{
		} else
		{  				
			$data['approve1'] = $this->Model_dashboard_karyawan->hitung_approve1($data['status']);			
			$data['approve2'] = $this->Model_dashboard_karyawan->hitung_approve2($data['status']);
		}

		$this->template->load('template_admin','dashboard_admin',$data);
	}

	/********************************************************************************************************/
	/*										AKHIR DASHBOARD ADMIN 											*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*								FUNGSI AKSI PADA DASHBOARD ADMIN 										*/
	/********************************************************************************************************/

	public function action()
	{
		// Mengambil status triwulan atau ski yang sedang aktif
		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$data['divisi'] = $this->Model_dashboard_karyawan->get_divisi()->result();

		// Mengambil foto dari web service
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);

		// Mengambil data dengan metode get
		$div = $this->input->post_get('divisi',TRUE);
		$hal = $this->input->post_get('page',TRUE);
		$data['tw']=$tw = $this->input->post_get('tw',TRUE);

		$data['DIVISI']	= $this->input->post('divisi');

		// Mengambil tahun dari tabel kondisi
		$thn_ins = $this->Model_dashboard_karyawan->thn_kondisi();

			foreach ($thn_ins->result_array() as $key) {			
				$thn 			= $key['tahun']; 
				$tahun_insert 	= array('tahun_insert' => $thn);

				$divisi 		= array('DIVISI' => $div);
				$data['judul']	= $hal;
				$data['title']  = $hal;

				$e=array('a.jenis_realisasi'=>$data['status'], 'a.tahun'=>$thn);  

				if ($hal == 'Data Karyawan Belum Buat SKI') 
				{			
					$data['div'] = $this->Model_dashboard_karyawan->get_karyawan_blm_perdivisi($tahun_insert,$divisi)->result();
				}
				elseif ($hal == 'Data Karyawan Sudah Membuat SKI')
				{			
					$data['div'] = $this->Model_dashboard_karyawan->get_karyawan_sdh_perdivisi($tahun_insert,$divisi)->result();
				}
				elseif ($hal == 'Data Karyawan sudah approve SKI')
				{			
					$data['div'] = $this->Model_dashboard_karyawan->sdh_approve_ski($div)->result();
				}
				elseif ($hal == 'Data Karyawan belum approve SKI') 
				{			
					$data['div'] = $this->Model_dashboard_karyawan->blm_approve_ski($div)->result();
				}
				elseif ($hal == 'Data Karyawan sudah buat penilaian '.$tw)
				{			
					$data['div'] = $this->Model_dashboard_karyawan->sudah_penilaian_tw($e,$div)->result();
				}
				elseif ($hal == 'Data Karyawan belum buat penilaian '.$tw)
				{			
					$data['div'] = $this->Model_dashboard_karyawan->belum_penilaian_tw($thn,$tw,$div)->result();
				}
				elseif ($hal == 'Data Karyawan sudah approve 1 '.$tw)
				{			
					$data['div'] = $this->Model_dashboard_karyawan->approve1($tw,$div,'ATASAN1')->result();
				}
				elseif($hal=='Data Karyawan belum approve 1 '.$tw)
				{			
					$data['div'] = $this->Model_dashboard_karyawan->belum_approve1($tw,$div,'BELUM')->result();
				}
				elseif ($hal == 'Data Karyawan sudah approve 2 '.$tw) 
				{			
					$data['div'] = $this->Model_dashboard_karyawan->approve1($tw,$div,'ATASAN2')->result();
				}
				elseif ($hal == 'Data Karyawan belum approve 2 '.$tw)
				{			
					$data['div'] = $this->Model_dashboard_karyawan->belum_approve1($tw,$div,'ATASAN1')->result();
				}
			}

		// load view
		$this->template->load('template_admin','dashboard_karyawan/view_karyawan',$data);
	}

	/********************************************************************************************************/
	/*							AKHIR FUNGSI AKSI PADA DASHBOARD ADMIN 										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*							Bagian Histori Ski karyawan Bagian Admin									*/
	/********************************************************************************************************/
	
	//halaman awal histori
	public function histori_karyawan()
	{
		$data['judul']	= 'History SKI Karyawan';
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);
		$data['divisi'] = $this->Model_histori_karyawan_bag_admin->get_divisi()->result();

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','master/histori_bag_admin/v_histori_karyawan',$data);
	}

	//pengambilan data server side untuk histori pada halaman awal histori
	public function get_data_history_bag_admin()
	{
		$divisi =  $this->input->post('divisi');
		$list 	= $this->Model_histori_karyawan_bag_admin->get_datatables($divisi);

		$data 	= array();

		$no 	= $_POST['start'];
		foreach ($list as $r) { 
		    $no++;
		    $row = array();
		    $row[] = "<center>$no</center>";
		    $row[] = $r->NIPEG;
			$row[] = $r->NAMA;
			$row[] = $r->DIREKT;					
			$row[] = $r->DIVISI;
			$row[] = '<a href="'.base_url().'admin/list_histori/'.$r->NIPEG.'" class="btn btn-success btn-sm">L I H A T</a>'; 
		    $data[] = $row;            
		}

		$output = array(
		                 "draw" => $this->input->post('draw'),
		                "recordsTotal" => $this->Model_histori_karyawan_bag_admin->count_all(),
		                "recordsFiltered" => $this->Model_histori_karyawan_bag_admin->count_filtered($divisi),
		                "data" => $data,
		        	);

		//output to json format
		echo json_encode($output);
	  }

	//list histori pertahun
	public function list_histori($nipeg_param)
	{
		$data['nip'] 	= $nipeg_param;
		$data['judul']	= 'Data Karyawan Sudah Membuat SKI';

		//menampilkan foto admin
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);	

		//menampilkan foto karyawann
		$data['poto_karyawan_histori'] = $this->get_url_photo($nipeg_param);

		$data['data_karyawan'] 	= $this->Model_history_ski->get_data_karyawan($nipeg_param)->row_array();
		$data['list_thn'] 		= $this->Model_histori_karyawan_bag_admin->list_tahun($nipeg_param)->result();

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','master/histori_bag_admin/v_histori_bag_admin',$data);
	}

	//halaman histori penetapan tw1 dll
	public function histori_penetapan_karyawan($thn_param ,$nipeg_param)
	{
		$nipeg_admin 	= $this->session->userdata('ses_nipeg');
		$nipeg 			= $nipeg_param;
		$param_tahun 	= $thn_param;

		$data['poto'] 		 			= $this->get_url_photo($nipeg_admin);
		$data['poto_karyawan_histori']  = $this->get_url_photo($nipeg);

		$data['judul']		 = 'Histori SKI Karyawan';
		$data['histori']	 = 'admin';
		$data['param_tahun'] = $param_tahun;
		$data['nipeg_param'] = $nipeg;

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

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

		$jobtitle = $this->Model_karyawan->get_karyawan($nipeg)->result_array();
			foreach ($jobtitle as $jb) {
				$job = $jb['JOBTITLE'];
			}

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

			
		$this->template->load('template_admin','ski/histori_penetapan',$data);
	}

	/********************************************************************************************************/
	/*						AKHIR Bagian Histori Ski karyawan Bagian Admin									*/
	/********************************************************************************************************/

	/********************************************************************************************************
											Rekap data Excel
	********************************************************************************************************/
	public function rekap_data(){
		$data['judul']	= 'Rekap Data Karyawan Sudah Membuat SKI';

		//menampilkan foto admin
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);	

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$data['thn_real'] = $this->Model_admin->get_tahun_realisasi()->result();
		$this->template->load('template_admin','master/rekap_data/rekap_data',$data);
	}
	public function ajax_rekap_data()
	    {

			$thn =  $this->input->post('tahun');
			$tw  =  $this->input->post('tw');
	        $list = $this->Model_master_rekap_data->get_datatables($thn,$tw);
	        $data = array();
	        
	        $no = $_POST['start'];
	        foreach ($list as $r) {
	        	
	        	$tu = $r->nilai_ski; 
                $posisi 	 = strpos($tu,".");
                $sub_kalimat = substr($tu,$posisi,3);

                $a = substr($tu,0,$posisi);
                $b = $a.$sub_kalimat;

	            $no++;
	            $row = array();
	            $row[] = "<center>$no</center>";
	            $row[] = $r->nipeg;
	            $row[] = $r->NAMA;
	            $row[] = $r->JOBTITLE;
	            $row[] = $r->DIVISI;
	            $row[] = $r->BAGIAN;
	            $row[] = $r->URUSAN;
	            $row[] = "<center>$r->jenis_realisasi</center>";
	            $row[] = "<center>$b</center>";
 				$row[] = "<center>$r->tahun</center>";
	            $data[] = $row;
	        }
	 
	        $output = array(
	                        "draw" => $this->input->post('draw'),
	                        "recordsTotal" => $this->Model_master_rekap_data->count_all($thn,$tw),
	                        "recordsFiltered" => $this->Model_master_rekap_data->count_filtered($thn,$tw),
	                        "data" => $data,
	                );
	        //output to json format
	        echo json_encode($output);
	    }

	    public function get_rekap_ski(){
	    	$thn = $this->input->post('tahun');
	    	$tw = $this->input->post('tw');

	    	 $data['rekap'] = $this->Model_master_rekap_data->get_rekap_excel($thn,$tw)->result();
	    	 $this->load->view('master/rekap_data/report/v_excel_rekap',$data);
	    }
	/********************************************************************************************************
											Rekap data Excel
	********************************************************************************************************/

	// STATUS SKI KARYAWAN

	public function status_ski_karyawan(){
		$data['judul']='Status SKI Karyawan';
		$nipeg = $this->session->userdata('ses_nipeg');
			//menampilkan foto admin
		$data['poto'] = $this->get_url_photo($nipeg);
		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}
			
			$data['jml_karyawan'] = $this->Model_dashboard_karyawan->jml_karyawan();

		$div = $this->Model_dashboard_karyawan->jml_divisi()->result();
		$no = 1;
			foreach ($div as $key) {
				$data['jml_div'] = $no++;
			}

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$status 		= $st['status_tw'];
				$data['tst'] 	= $st['TST'];
				$thn 			= $st['tahun']; 

				$data['status']	= $status;
			}

		$tahun_insert =  array('tahun_insert' => $thn );
		$data['jml_ski_penetapan'] 	= $this->Model_dashboard_karyawan->jml_sdh_ski_penetapan($tahun_insert);
		$data['jml_blum_penetapan'] = $this->Model_dashboard_karyawan->jml_blm_ski_penetapan($tahun_insert);

		$data['sudah_approve_ski']	= $this->Model_dashboard_karyawan->jml_sdh_approve_ski($tahun_insert);
		$data['belum_approve_ski']	= $this->Model_dashboard_karyawan->jml_blm_approve_ski($tahun_insert);

		$data['chartpenetapan'] = $this->Model_dashboard_karyawan->chart_list()->result();
		$data['thn']= $thn;

		//bagian ambil divisi 
		$data['divisi'] = $this->Model_dashboard_karyawan->get_divisi()->result();
		for($i = 1; $i < 5; $i++){
		   	$e 	= array('jenis_realisasi'=>'TW'.$i, 'tahun'=>$thn); 
			$data['sudahskitw'.$i] = $this->Model_dashboard_karyawan->hitung_sudah_penilaian_tw($e);				
				$data['approve1'.$i] = $this->Model_dashboard_karyawan->hitung_approve1('TW'.$i);			
				$data['approve2'.$i] = $this->Model_dashboard_karyawan->hitung_approve2('TW'.$i);
		}
		$this->template->load('template_admin','status_ski_karyawan',$data);
	}
}