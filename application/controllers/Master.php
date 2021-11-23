<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Master extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_master');	
		$this->load->model('Model_master_indikator');
		$this->load->model('model_master_divisi');		
		$this->load->model('model_master_jabatan');	
		$this->load->model('Model_master_karyawan');
		$this->load->model('Model_master_pangkat');
		$this->load->model('Model_reset_password');
		$this->load->model('Model_master_urusan');
		$this->load->model('Model_master_bagian');
		$this->load->model('Model_master_hak_akses');
		$this->load->model('Model_master_buat_ski_kadiv');
		$this->load->model('Model_admin');
		$this->load->model('Model_karyawan');
		$this->load->model('Model_master_direktori');
		$this->load->model('Model_master_penalty');
		$this->load->model('Model_histori_karyawan_bag_admin');
		$this->load->model('Model_penetapan_baru');
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
	//end getting image

	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR AMBIL FOTO KARYAWAN 										*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*											MASTER KARYAWAN 											*/	
	/*																										*/
	/********************************************************************************************************/

	// lihat data
	public function karyawan()
	{
		$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']	= 'Data karyawan';
		$data['poto'] 	= $this->get_url_photo($nipeg);	

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','master/karyawan/lihat_data_karyawan',$data);
	}
	
	// tabel server side
	function get_data_karyawan()
    {
      $list = $this->Model_master_karyawan->get_datatables();
        $data = array();
        
        $no = $_POST['start'];
        foreach ($list as $r) {

            $no++;
            $row = array();
            $row[] = "<center>$no<center>";
            $row[] = $r->NIPEG;
            $row[] = $r->NAMA;
            $row[] = $r->DIVISI;
            $row[] = $r->JOBTITLE;
            $row[]	='<a href="details_karyawan/'.$r->NIPEG.'" class="btn btn-success btn-sm">L I H A T</a>';

            $data[] = $row;
            
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Model_master_karyawan->count_all(),
                        "recordsFiltered" => $this->Model_master_karyawan->count_filtered(),
                        "data" => $data
                );
        //output to json format
        echo json_encode($output);
    }

    // proses tambah karyawan dengan cara reload data menggunakan webservice
    function tambah_karyawan()
    {
    	date_default_timezone_set('Asia/Jakarta');

	    $appID = "10001";
	    $secretKey = "f3d1e401c6";
		$timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));

		// Computes the signature by hashing the salt with the secret key as the key
	    $signature = hash_hmac('sha256', '10001&'.$timestamp, $secretKey, true);

	    // base64 encode…
	    $encodedSignature = base64_encode($signature);

		$opts_get = array('http'=>array(
									    'method'=>"GET",
									    'header'=>"X-App-Id: ".$appID."\r\n" .
									              "X-Timestamp: ".$timestamp."\r\n" .
									              "X-Signature: ".$encodedSignature."\r\n"
		  )
		);

		$context_get = stream_context_create($opts_get);

		// Open the file using the HTTP headers set above
		$file_get = file_get_contents('https://api.inti.co.id:8086/get_all_pegawai', false, $context_get);

		$array_php = json_decode($file_get, true);

		$this->Model_master_karyawan->hapus_karyawan();

		$this->Model_master_karyawan->simpan_karyawan_2($array_php);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; menambahkan Data Karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
    }

    // lihat indikator karyawan
	public function details_karyawan($nipeg_param)
	{
		$data['judul']	= 'Details Karyawan';

		//menampilkan foto admin
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);	

		//menampilkan foto karyawann
		$data['poto_karyawan'] = $this->get_url_photo($nipeg_param);

		$jobtitle = $this->Model_karyawan->get_karyawan($nipeg_param)->result_array();

			foreach ($jobtitle as $jb) {
				$divisi = $jb['JOBTITLE'];
			}

		$data['data_karyawan'] 	= $this->Model_karyawan->get_data_karyawan_1($nipeg_param)->row_array();
		$data['direktori']		= $this->Model_master_direktori->get_data_direktori_karyawan($divisi)->result();
		$data['indikator']		= $this->Model_master_direktori->nama_indikator()->result();

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		//atasan 1
			$data['atasan_1']		= $this->Model_karyawan->get_atasan_langsung($nipeg_param)->row_array();
			$atasan_langsung = $this->Model_karyawan->get_atasan_langsung($nipeg_param);
			foreach ($atasan_langsung->result_array()  as $key ) {
					$nipegup_a1 = $key['NIPEG'];
						$data['atasan_2'] = $this->Model_karyawan->get_atasan_langsung($nipegup_a1)->row_array();
			}

		$this->template->load('template_admin','master/karyawan/details_karyawan',$data);
	}

	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR MASTER KARYAWAN 											*/	
	/*																										*/
	/********************************************************************************************************/
	
	/********************************************************************************************************/
	/*																										*/
	/*											MASTER HAK AKSES											*/	
	/*																										*/
	/********************************************************************************************************/
	
	// lihat data
	public function hak_akses()
	{
		$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']		= 'Data Hak Akses';
		$data['poto'] 		= $this->get_url_photo($nipeg);
		$data['hak']		= $this->Model_master_hak_akses->carilebih_hak();
		$data['karyawan'] 	= $this->Model_master_hak_akses->carilebih_karyawan();	
		$data['datahak']		= $this->Model_master_hak_akses->data_carilebih_hak()->result();
		$data['datakaryawan'] 	= $this->Model_master_hak_akses->data_carilebih_karyawan()->result();	
		$data['datakaryawanbelum'] 	= $this->Model_master_hak_akses->data_belum_punya_hak()->result();	

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['tst']	= $st['TST'];
				$data['thn']	= $st['tahun'];
			}

		$this->template->load('template_admin','master/hak_akses/hak',$data);
	}
	
	// tabel server side
	function get_data_hak_akses()
    {
      $list = $this->Model_master_hak_akses->get_datatables();
        $data = array();
        
        $no = $_POST['start'];
        foreach ($list as $r) {

            $no++;
            $row = array();
            $row[] = "<center>$no<center>";
            $row[] = $r->NIPEG;
            $row[] = $r->NAMA;
            $row[] = $r->E_MAIL;
            $row[] = $r->JOBTITLE;
            $row[] = $r->ROLE.', '.$r->ROLE1.', '.$r->ROLE2;
            $row[]	= '<button type="button" class="btn btn-info btn-sm" onclick="edit_hak_akses('."'".$r->NIPEG."'".')">E D I T</button>';
			$data[] = $row;
            
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Model_master_hak_akses->count_all(),
                        "recordsFiltered" => $this->Model_master_hak_akses->count_filtered(),
                        "data" => $data
                );
        //output to json format
        echo json_encode($output);
    }

    // proses tambah data hak akses
	public function proses_tambah_hak_akses()
	{	
		$nipeg 	=   $this->input->post('nipeg');
		$hak 	=   $this->input->post('hak');
		$hak1 	=   $this->input->post('hak1');
		$hak2 	=   $this->input->post('hak2');
		$sts 	=   $this->input->post('sts');

		$jml=count($nipeg);
         for($i=0; $i<$jml; $i++){
            if($sts[$i]=='insert'){
            	$data = array(
                    'NIPEG' => $nipeg[$i],
                    'ROLE' => $hak[$i],
                    'ROLE1' => $hak1[$i],
                    'ROLE2' => $hak2[$i]
                );

                $this->db->insert('role', $data);
            }
            else{
            	$data = array(
                    'NIPEG' => $nipeg[$i],
                    'ROLE' => $hak[$i],
                    'ROLE1' => $hak1[$i],
                    'ROLE2' => $hak2[$i]
                );
                $where=array(
                	'NIPEG' => $nipeg[$i]
                );
                $this->db->where($where);
                $this->db->update('role', $data);
            }

                
           }
		
	echo $this->session->set_flashdata('msg','<div class="alert alert-success"><i class="mdi mdi-check"></i>Sukses! Anda multiple insert Role karyawan.</div>');

	echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp;Anda sukses menambahkan Role karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

	redirect(base_url('master/hak_akses'));		
	}
	
	// proses update data hak akses
	public function update_hak_akses()
	{	
		$nipeg 	=   $this->input->post('nipeg');
		$hak 	=   $this->input->post('hak_akses');
		$hak1 	=   $this->input->post('hak_akses1');
		$hak2 	=   $this->input->post('hak_akses2');

        $data = array(
            'ROLE' => $hak,
            'ROLE1' => $hak1,
            'ROLE2' => $hak2
        );

		$this->db->where('NIPEG',$nipeg);
        $this->db->update('role', $data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp;Anda sukses mengedit hak akses karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		redirect(base_url('master/hak_akses'));		
	}
	
	// proses hapus
	public function proses_hapus_hak_akses()
	{	
		$nipeg =   $this->input->post('nipeg');
		$jml=count($nipeg);
         for($i=0; $i<$jml; $i++){
			 	$this->db->where('NIPEG',$nipeg[$i]);
                $this->db->delete('role');
           }

		echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp;Anda multiple hapus Role karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		redirect(base_url('master/hak_akses'));		
	}
	
	// proses ambil data dengan json
	public function ambil_data_ajax_hak_akses($id)
		{
			$data = $this->Model_master_hak_akses->get_edit_hak_akses($id); 
			echo json_encode($data);
		}

	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR MASTER HAK AKSES											*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*											MASTER INDIKATOR 	 										*/	
	/*																										*/
	/********************************************************************************************************/

	// lihat data
	public function indikator()
	{
		$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']		= 'Data Indikator';
		$data['poto'] 		= $this->get_url_photo($nipeg);
		$data['nama_proker']= $this->Model_master_indikator->nama_proker()->result();
     	$data['record'] 	= $this->Model_master_indikator->tampilkan_data_indikator();

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','master/indikator/lihat_data_indikator',$data);
	}
	
  	// tabel server side
	public function ajax_data_indikator()
    {
        $list = $this->Model_master_indikator->get_datatables();
        $data = array();
        
        $no = $_POST['start'];
        foreach ($list as $r) {

            $no++;
            $row = array();
            $row[] = "<center>$no</center>" ;
            $row[] = $r->nama_indikator;
            $row[] = $r->nama_proker;
            $row[] = $r->cara_pengukuran ;
            $row[] = $r->deliverable ;
      
            $row[] = '<center><a href="#" data-toggle="tooltip" data-placement="top" title="Update" onclick="edit_indikator('."'".$r->id_indikator."'".')"><i class="far fa-edit"></i></a>
            	<a href="#" data-toggle="tooltip" data-placement="top" title="Delete" onclick="delete_indikator('."'".$r->id_indikator."'".')"></i><i class="far fa-trash-alt"></i></a></center>';
         
            $data[] = $row;
            
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Model_master_indikator->count_all(),
                        "recordsFiltered" => $this->Model_master_indikator->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	// proses tambah indikator
	public function tambah_indikator()
	{
		$nama = $this->input->post('nama_indikator');
		$data = array(
			'nama_indikator' 	=> $this->input->post('nama_indikator') ,
			'id_proker' 	 	=> $this->input->post('id_proker') ,
			'satuan_indikator'	=> $this->input->post('satuan_indikator'),
			'cara_pengukuran' 	=> $this->input->post('cara_pengukuran') ,
			'deliverable' 		=> $this->input->post('deliverable'), 
			'nilai_maksimal'	=> $this->input->post('nilai_maksimal')
			 );
					
		$this->Model_master_indikator->tambah_indikator($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp;Anda berhasil menambahkan Indikator <strong>'.$nama.'</strong>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
	}

	// proses ambil data
	public function ambil_data_ajax_inidikator($id)
	{
		$data = $this->Model_master_indikator->get_by_id_indikator($id); 

		echo json_encode($data);
	}

	// proses ubah data
	public function ubah_data_ajax_inidikator()
	{
		$nama = $this->input->post('nama_indikator');
		$data = array(
			'nama_indikator' 	=> $this->input->post('nama_indikator') ,
			'id_proker' 	 	=> $this->input->post('id_proker') ,
			'satuan_indikator'	=> $this->input->post('satuan_indikator'),
			'cara_pengukuran' 	=> $this->input->post('cara_pengukuran') ,
			'deliverable' 		=> $this->input->post('deliverable'), 
			'nilai_maksimal'	=> $this->input->post('nilai_maksimal')
			 );

		$this->Model_master_indikator->ubah_data_inidikator(array('id_indikator'=>$this->input->post('id_indikator')),$data );

		echo $this->session->set_flashdata('msg','<div class="alert alert-warning"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp;Anda berhasil mengubah Indikator <strong>'.$nama.'</strong>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> true));

	}

	// proses hapus data
	public function delete_indikator($id)
	{
		$where = array('id_indikator' => $id);

		$this->Model_master_indikator->delete_indikator($where,'indikator');

		echo $this->session->set_flashdata('msg','<div class="alert alert-danger"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp;Anda berhasil menghapus Indikator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
	}
	
	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR MASTER INDIKATOR 	 										*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*											MASTER DIREKTORI											*/	
	/*																										*/
	/********************************************************************************************************/

	// lihat data direktori
	public function direktori()
	{
		$nipeg 	= $this->session->userdata('sess_nipeg');

		$data['poto']	= $this->get_url_photo($nipeg);
		$data['judul']	= "Data Direktori Karyawan";

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array() as $st) {
				$data['status']	= $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$data['jobtitle']	 = $this->Model_master_direktori->nama_jobtitle()->result();
		$data['job_belum']	 = $this->Model_master_direktori->get_job_belum()->result();	
		$data['job_belum_h'] = $this->Model_master_direktori->get_job_belum_h();	
		$data['job_sudah']	 = $this->Model_master_direktori->get_job_sudah()->result();	
		$data['job_sudah_h'] = $this->Model_master_direktori->get_job_sudah_h();	

		$this->template->load('template_admin','master/direktori/lihat_data_direktori', $data);
	}

	// server side tb_direktori
	public function get_data_jobtitle()
	{
		$jobtitle 	= $this->input->post('jobtitle');
		$list		= $this->Model_master_direktori->get_datatables($jobtitle);

		$data 	= array();

		$no 	= $_POST['start'];
		foreach ($list as $r) {
			$no++;
			$row = array();
			$row[]	= "<center>$no</center>";
			$row[]	= $r->nama_proker;
			$row[]	= $r->nama_indikator;
			$row[]	= "<center>$r->satuan_indikator</center>";
			$row[]	= $r->cara_pengukuran;
            $data[]	= $row;
		}

		$output = array(
					 "draw" => $this->input->post('draw'),
		                "recordsTotal" 		=> $this->Model_master_direktori->count_all($jobtitle),
		                "recordsFiltered" 	=> $this->Model_master_direktori->count_filtered($jobtitle),
		                "data" => $data
					);

		//output to json format
		echo json_encode($output);
	}

	// lihat indikator karyawan
	public function lihat_direktori($jobtitle)
	{
		$data['judul']	= 'Data Direktori';

		//menampilkan foto admin
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);

		$asal = array("_","dan","koma");	
		$ganti= array(" ","&",",");
		$hasil= str_replace($asal, $ganti, $jobtitle);

		$data['jobtitle'] = $hasil;

		$data['direktori']		= $this->Model_master_direktori->get_data_direktori_karyawan($hasil)->result();
		$data['indikator']		= $this->Model_master_direktori->nama_indikator()->result();

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','master/direktori/lihat_direktori_karyawan',$data);
	}

	public function tambah_direktori()
	{
		$data = array('JOBTITLE' => $this->input->post('jobtitle'), 'id_indikator' => $this->input->post('indikator'));

		$nama = $this->input->post('indikator');

		// cari nama indikator
		$nama_hasil = $this->Model_master_direktori->cari_nama_indikator($nama)->result();

		foreach ($nama_hasil as $n) {
			$hasil_nama = $n->nama_indikator;
		}

		// cari jobtitle pada tabel direktori
		$cari = $this->Model_master_direktori->cari_direktori($data);

		if ($cari != 0) {
			echo $this->session->set_flashdata('msg','<div class="alert alert-danger"><span class="badge badge-pill badge-danger">Gagal! !</span>&nbsp;&nbsp;Indikator <strong>'.$hasil_nama.'</strong> telah ada pada tabel, Harap ganti!.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		} else {

			$this->Model_master_direktori->simpan_direktori($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp; menambahkan Indikator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		}

		
		echo json_encode(array("status"=>TRUE));
	}

	// proses ambil data
	public function ambil_data_ajax_direktori($id)
	{
		$data = $this->Model_master_direktori->get_by_id_direktori($id); 

		echo json_encode($data);
	}

	// proses ubah data
	public function ubah_data_ajax_direktori()
	{
		$data = array(
			'id_indikator' =>$this->input->post('indikator')
			 );

		$this->Model_master_direktori->ubah_data_direktori(array('id_direktori'=>$this->input->post('direktori')),$data );

		echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Sukses!</span> &nbsp;Anda sukses edit indikator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> true));

	}


	// proses hapus data
	public function delete_direktori($id)
	{
		$where = array('id_direktori' => $id);

		$this->Model_master_direktori->delete_direktori($where,'direktori');

		echo $this->session->set_flashdata('msg','<div class="alert alert-danger"><span class="badge badge-pill badge-danger">Sukses!</span>&nbsp; Anda sukses menghapus indikator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
	}

	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR MASTER DIREKTORI											*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*										MASTER PENALTY DIVISI											*/	
	/*																										*/
	/********************************************************************************************************/

	// Melihat data indikator penalty tiap divisi
	public function penalty()
	{
		$data['judul']	= "Buat Penalty SKI";

		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['tst'] 	= $st['TST'];
				$data['thn']	= $st['tahun'];
			}

		$data['divisi_belum']	= $this->Model_master_penalty->get_divisi_blm()->result();
		$data['divisi_belum_h']	= $this->Model_master_penalty->get_divisi_blm_h();
		$data['divisi_sudah']	= $this->Model_master_penalty->get_divisi_sdh()->result();
		$data['divisi_sudah_h']	= $this->Model_master_penalty->get_divisi_sdh_h();

		$this->template->load('template_admin','master/penalty/lihat_data', $data);
	}

	// Melihat target penalty divisi 
	public function lihat_penalty($divisi)
	{
		$nipeg 			= $this->session->userdata('ses_nipeg');

		$asal 	= array("_","dan");
		$ganti  = array(" ","&");
		$hasil 	= str_replace($asal, $ganti, $divisi);

		$data['divisi'] = $hasil;
		$data['judul']	= "Buat Target Penalty SKI Divisi";
		$data['poto'] 	= $this->get_url_photo($nipeg);

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['tst'] 	= $st['TST'];
				$data['thn']	= $st['tahun'];
			}

		$data['indikator']			= $this->Model_master_penalty->get_data_indikator()->result();
		$data['indikator_divisi']	= $this->Model_master_penalty->get_data_penalty_divisi($hasil)->result(); 

		$this->template->load('template_admin', 'master/penalty/lihat_penalty_divisi', $data);
	}

	public function tambah_indikator_div()
	{

		$ind = $this->input->post('indikator');
		$div = $this->input->post('divisi');

		$indikator = $this->Model_master_penalty->get_indikator_div($ind)->result_array();

		foreach ($indikator as $i) {
		  $id_proker 		=  $i['id_proker'];
		  $cara_pengukuran	=  $i['cara_pengukuran'];
		  $satuan_indikator =  $i['satuan_indikator'];
		  $nilai_maksimal	=  $i['nilai_maksimal'];
		  $deliverable		=  $i['deliverable'];
		}

		$data = array('divisi' 			=> $this->input->post('divisi'), 
					  'nama_indikator' 	=> $this->input->post('indikator'),
					  'id_proker' 		=> $id_proker,
					  'cara_pengukuran'	=> $cara_pengukuran,
					  'satuan_indikator'=> $satuan_indikator,
					  'nilai_maksimal'	=> $nilai_maksimal,
					  'deliverable'		=> $deliverable
					);

		$where = array('nama_indikator' => $ind, 'divisi' => $div);

		$cari = $this->Model_master_penalty->cari_indikator($where);

		if ($cari != 0) {
			echo $this->session->set_flashdata('msg','<div class="alert alert-danger"><span class="badge badge-pill badge-danger">Gagal!</span>&nbsp;&nbsp;Indikator <strong>'.$ind.'</strong> sudah ada pada tabel, Harap ganti!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		} else {
			$this->Model_master_penalty->simpan_indikator_div($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp; menambahkan Indikator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		}

		

		echo json_encode(array("status"=>TRUE));
	}

	public function get_data_penalty_div()
	{
		$divisi = $this->input->post('divisi');
		$list 	= $this->Model_master_penalty->get_datatables($divisi);

		$data 	= array();
		$no 	= $_POST['start'];

		foreach ($list as $r) {
			$no++;
			$row	= array();
			$row[]	= "<center>$no</center>";
			$row[]	= $r->nama_proker;
			$row[]	= $r->nama_indikator;
			$row[]	= "<center>$r->satuan_indikator</center>";
			$row[]	= $r->cara_pengukuran;
            $data[]	= $row;
		}

		$output = array(
					"draw" => $this->input->post('draw'),
	                "recordsTotal" 		=> $this->Model_master_penalty->count_all($divisi),
	                "recordsFiltered" 	=> $this->Model_master_penalty->count_filtered($divisi),
	                "data" => $data
					);

		//output to json format
		echo json_encode($output);
	}

	// proses ambil data
	public function ambil_data_ajax_pen_div($id)
	{
		$data = $this->Model_master_penalty->get_by_id_indikator_pen_div($id); 

		echo json_encode($data);
	}

	// proses ubah data
	public function ubah_data_ajax_pen_div()
	{
		$data = array(
			'nama_indikator' =>$this->input->post('nm_indikator')
			 );

		$this->Model_master_penalty->ubah_data_indikator_pen_div(array('id_indikator'=>$this->input->post('id_indikator')),$data );

		echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Sukses!</span> &nbsp;Anda sukses edit indikator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> true));

	}

	// proses hapus data
	public function delete_pen_div($id)
	{
		$where = array('id_indikator' => $id);

		$this->Model_master_penalty->delete_penalty_div($where,'indikator');

		echo $this->session->set_flashdata('msg','<div class="alert alert-danger"><span class="badge badge-pill badge-danger">Sukses!</span>&nbsp; Anda sukses menghapus indikator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status"=> TRUE));
	}

	/********************************************************************************************************/
	/*																										*/
	/*									AKHIR MASTER PENALTY DIVISI											*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*										MASTER BUAT PENALTY	SKI											*/	
	/*																										*/
	/********************************************************************************************************/

	// Melihat penetapan penalty
	public function penetapan_penalty()
	{
		$data['judul']	= "Buat Penalty SKI";

		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['tst'] 	= $st['TST'];
				$tahun 			= $st['tahun'];
			}

		$data['thn'] 	= $tahun;

		// Belum buat penalty SKI
		$data['divisi_belum'] 	= $this->Model_master_penalty->cari_divisi_blm_penetapan($tahun)->result();
		$data['divisi_belum_h'] = $this->Model_master_penalty->cari_divisi_blm_penetapan_h($tahun);
		// Ubah data penalty SKI
		$a = array('STATUS' => 'SIMPAN');
		$data['divisi_ubah'] 	= $this->Model_master_penalty->cari_divisi_ubah_submit_penetapan($a,$tahun)->result();
		$data['divisi_ubah_h'] 	= $this->Model_master_penalty->cari_divisi_ubah_submit_penetapan_h($a,$tahun);
		// Sudah submit	
		$b = array('STATUS' => 'KIRIM');
		$data['divisi_submit'] 	= $this->Model_master_penalty->cari_divisi_ubah_submit_penetapan($b,$tahun)->result();
		$data['divisi_submit_h']= $this->Model_master_penalty->cari_divisi_ubah_submit_penetapan_h($b,$tahun);	

		$this->template->load('template_admin', 'master/penalty/penetapan/lihat_data', $data);
	}

	// Melihat penilaian penalty triwulan
	public function penilaian_penalty($triwulan)
	{
		$nipeg 			= $this->session->userdata('ses_nipeg');

		$data['judul']	= "Buat Penalty SKI";
		$data['tw']		= $triwulan;
		$data['poto'] 	= $this->get_url_photo($nipeg);

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['tst'] 	= $st['TST'];
				$data['thn'] 	= $st['tahun'];
			}

		// Belum buat penilaian penalty SKI
		$c 	= array('JENIS_REALISASI' => $triwulan, 'TAHUN' => $st['tahun']);
		$data['divisi_belum']	= $this->Model_master_penalty->cari_divisi_blm_penilaian($c)->result();
		$data['divisi_belum_h']	= $this->Model_master_penalty->cari_divisi_blm_penilaian_h($c);

		// Ubah data penilaian penalty triwulan
		$a 	= array('STATUS' => 'SIMPAN', 'JENIS_REALISASI' => $triwulan, 'TAHUN' => $st['tahun']);
		$data['divisi_ubah']	= $this->Model_master_penalty->cari_divisi_ubah_submit_penilaian($a)->result();
		$data['divisi_ubah_h']	= $this->Model_master_penalty->cari_divisi_ubah_submit_penilaian_h($a);

		// Sudah submit
		$b 	= array('STATUS' => 'KIRIM', 'JENIS_REALISASI' => $triwulan, 'TAHUN' => $st['tahun']);
		$data['divisi_submit']	= $this->Model_master_penalty->cari_divisi_ubah_submit_penilaian($b)->result();
		$data['divisi_submit_h']= $this->Model_master_penalty->cari_divisi_ubah_submit_penilaian_h($b);

		$this->template->load('template_admin', 'master/penalty/penilaian/lihat_data', $data);
	}

	// menampilkan form buat Penalty
	public function buat_penalty_penetapan($divisi)
	{
		// Mengambil variabel untuk ditampilkan pada Template Admin
		$data['judul']		= "Buat Penalty Penetapan SKI";
		
		// Untuk menampilkan foto dengan web service
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);

		// Menampilkan status
		$status = $this->Model_karyawan->get_data_status();
		foreach ($status->result_array()  as $st ) {
			$data['status'] = $st['status_tw'];
			$data['tst']	= $st['TST'];
			$thn 			= $st['tahun'];
		}

		$data['thn'] 	= $thn;
		// Akhir mengambil variabel untuk ditampilkan pada Template Admin

		// Merubah string pada url direplace dengan string yang diijinkan
		$asli 	= array('_','dan');
		$ganti 	= array(' ','&');
		$hasil 	= str_replace($asli, $ganti, $divisi);
		// Akhir merubah string pada url direplace dengan string yang diijinkan
		
		$data['nama_divisi']  = strtoupper($hasil);
		$data['nama_penalty'] = $this->Model_master_penalty->get_nama_penalty($hasil)->result();

		// Untuk tampilan view
		$kondisi = array("p.DIVISI" => $hasil, "TAHUN_INSERT" => $thn);
		$data['penalty_pen'] = $this->Model_master_penalty->get_data_penalty_penetapan($kondisi)->result();
		$data['status_data'] = $this->Model_master_penalty->get_data_penalty_penetapan($kondisi)->row();

		$this->template->load('template_admin', 'master/penalty/penetapan/form_penetapan', $data);
	}

	// aksi menyimpan nilai penetapan Penalty
	public function simpan_penalty_penetapan()
	{	
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		// Jika menekan button dengan name = submit_data
		if (isset($_POST['submit_data'])) {
			$divisi = $this->input->post('nama_divisi');

			foreach ($divisi as $key => $value) {
				$data[] = array(
					"ID_INDIKATOR"		=> $_POST['id_indikator'][$key],
					"DIVISI"			=> $_POST['nama_divisi'][$key],
					"TARGET_PERTAHUN"	=> $_POST['target_pertahun'][$key],
					"BOBOT"				=> $_POST['bobot'][$key],
					"TOTAL_BOBOT"		=> $_POST['total_bobot'][$key],
					"TW1"				=> $_POST['tw1'][$key],
					"TW2"				=> $_POST['tw2'][$key],
					"TW3"				=> $_POST['tw3'][$key],
					"TW4"				=> $_POST['tw4'][$key],
					"STATUS" 			=> 'KIRIM',
					"TAHUN_INSERT"		=> $thn,
					"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
								);
			}

			$this->Model_master_penalty->simpan_penetapan($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Mengirim Data Penalty Penetapan SKI.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/penetapan_penalty','refresh');
		// Jika menekan button dengan name = submit_simpan
		} else {
			$divisi = $this->input->post('nama_divisi');

			foreach ($divisi as $key => $value) {
				$data[] = array(
					"ID_INDIKATOR"		=> $_POST['id_indikator'][$key],
					"DIVISI"			=> $_POST['nama_divisi'][$key],
					"TARGET_PERTAHUN"	=> $_POST['target_pertahun'][$key],
					"BOBOT"				=> $_POST['bobot'][$key],
					"TOTAL_BOBOT"		=> $_POST['total_bobot'][$key],
					"TW1"				=> $_POST['tw1'][$key],
					"TW2"				=> $_POST['tw2'][$key],
					"TW3"				=> $_POST['tw3'][$key],
					"TW4"				=> $_POST['tw4'][$key],
					"STATUS" 			=> 'SIMPAN',
					"TAHUN_INSERT"		=> $thn,
					"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
								);
			}

			$this->Model_master_penalty->simpan_penetapan($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Menyimpan Data Penalty Penetapan SKI.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/penetapan_penalty','refresh');
		}
	}

	// aksi menyimpan nilai penetapan Penalty saat telah disimpan data
	public function simpan_ubah_penalty_penetapan()
	{	
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		// Jika menekan button dengan name = submit_data
		if (isset($_POST['submit_data'])) {
			$divisi = $this->input->post('nama_divisi');
			$n = $divisi[0];

			foreach ($divisi as $key => $value) {
				$data[] = array(
					"ID_PENALTY_P"		=> $_POST['id_penalty_p'][$key],
					"ID_INDIKATOR"		=> $_POST['id_indikator'][$key],
					"DIVISI"			=> $_POST['nama_divisi'][$key],
					"TARGET_PERTAHUN"	=> $_POST['target_pertahun'][$key],
					"BOBOT"				=> $_POST['bobot'][$key],
					"TOTAL_BOBOT"		=> $_POST['total_bobot'][$key],
					"TW1"				=> $_POST['tw1'][$key],
					"TW2"				=> $_POST['tw2'][$key],
					"TW3"				=> $_POST['tw3'][$key],
					"TW4"				=> $_POST['tw4'][$key],
					"STATUS" 			=> 'KIRIM',
					"TAHUN_INSERT"		=> $thn,
					"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
								);
			}

			$this->Model_master_penalty->simpan_ubah_penetapan($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Mengirim Data Penalty Penetapan SKI Divisi '.$n.'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/penetapan_penalty','refresh');
		// Jika menekan button dengan name = submit_simpan
		} else {
			$divisi = $this->input->post('nama_divisi');
			$n = $divisi[0];

			$ganti 	= array('_','dan');
			$asli 	= array(' ','&');
			$hasil 	= str_replace($asli, $ganti, $n);


			foreach ($divisi as $key => $value) {
				$data[] = array(
					"ID_PENALTY_P"		=> $_POST['id_penalty_p'][$key],
					"ID_INDIKATOR"		=> $_POST['id_indikator'][$key],
					"DIVISI"			=> $_POST['nama_divisi'][$key],
					"TARGET_PERTAHUN"	=> $_POST['target_pertahun'][$key],
					"BOBOT"				=> $_POST['bobot'][$key],
					"TOTAL_BOBOT"		=> $_POST['total_bobot'][$key],
					"TW1"				=> $_POST['tw1'][$key],
					"TW2"				=> $_POST['tw2'][$key],
					"TW3"				=> $_POST['tw3'][$key],
					"TW4"				=> $_POST['tw4'][$key],
					"STATUS" 			=> 'SIMPAN',
					"TAHUN_INSERT"		=> $thn,
					"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
								);
			}

			$this->Model_master_penalty->simpan_ubah_penetapan($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Menyimpan Data Penalty Penetapan SKI Divisi '.$n.'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/BUAT_penalty_penetapan/'.$hasil,'refresh');
		}		
	}

	// Menampilkan form buat nilai realisasi
	public function buat_penalty_realisasi($divisi, $triwulan)
	{
		// Mengambil variabel untuk ditampilkan pada Template Admin
		$data['judul']		= "Buat Penalty Realisasi SKI Triwulan 1";
		$data['tw']			= $triwulan;
		
		// Untuk menampilkan foto dengan web service
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);

		// Menampilkan status
		$status = $this->Model_karyawan->get_data_status();
		foreach ($status->result_array()  as $st ) {
			$data['status'] = $st['status_tw'];
			$data['tst'] 	= $st['TST'];
			$thn 			= $st['tahun'];
			$data['thn'] 	= $st['tahun'];
		}
		// Akhir mengambil variabel untuk ditampilkan pada Template Admin

		// Merubah string pada url direplace dengan string yang diijinkan
		$asli 	= array('_','dan');
		$ganti 	= array(' ','&');
		$hasil 	= str_replace($asli, $ganti, $divisi);
		// Akhir merubah string pada url direplace dengan string yang diijinkan

		$d = array('p.DIVISI' => $hasil, 'p.TAHUN_INSERT' => $thn, 'p.STATUS' => 'KIRIM');

		$data['nama_divisi']		= strtoupper($hasil);
		$data['penalty_penetapan']	= $this->Model_master_penalty->get_data_penalty_pen($d)->result();
		$data['waktu'] 				= $this->Model_karyawan->get_data_status()->row_array();

		$e = array('pr.DIVISI' => $hasil, 'pr.TAHUN' => $thn, 'pr.JENIS_REALISASI' => $triwulan);
		$data['penalty_realisasi']	= $this->Model_master_penalty->get_data_penalty_nilai($e)->result();

		$data['realisasi']			= $this->Model_master_penalty->get_data_penalty_nilai($e)->row_array();

		$this->template->load('template_admin', 'master/penalty/penilaian/form_realisasi', $data);
	}

	// simpan nilai realisasi Penalty tiap triwulan
	public function simpan_penalty_realisasi()
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}
			
		if (isset($_POST['submit_data'])) {
			$divisi 	= $this->input->post('nama_divisi');
			$n 			= $divisi[0];
			$triwulan 	= $this->input->post('jenis_realisasi');
			$tw			= $triwulan[0];

			foreach ($divisi as $key => $value) {
				$data[] = array(
						"ID_INDIKATOR"		=> $_POST['id_indikator'][$key],
						"DIVISI"			=> $_POST['nama_divisi'][$key],
						"BOBOT"				=> $_POST['bobot'][$key],
						"TOTAL_BOBOT"		=> $_POST['total_bobot'][$key],
						"TARGET_PERTAHUN"	=> $_POST['target_pertahun'][$key],
						"NILAI_PENETAPAN"	=> $_POST['nilai_penetapan'][$key],
						"REALISASI"			=> $_POST['realisasi'][$key],
						"NILAI_REALISASI"	=> $_POST['nilai_realisasi'][$key],
						"JENIS_REALISASI"	=> $_POST['jenis_realisasi'][$key],
						"TOTAL_NILAI"		=> $_POST['total_nilai'][$key],
						"STATUS"			=> 'KIRIM',
						"TAHUN"				=> $thn,
						"TMT"				=> $_POST['TMT'][$key],
						"TST"				=> $_POST['TST'][$key],
						"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
				);
			}

			$this->Model_master_penalty->simpan_realisasi($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Mengirim Data Penalty Penilaian SKI Divisi '.$n.'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/penilaian_penalty/'.$tw,'refresh');

		} else {
			$divisi 	= $this->input->post('nama_divisi');
			$n 			= $divisi[0];
			$triwulan 	= $this->input->post('jenis_realisasi');
			$tw			= $triwulan[0];

			$ganti 	= array('_','dan');
			$asli 	= array(' ','&');
			$hasil 	= str_replace($asli, $ganti, $n);

			foreach ($divisi as $key => $value) {
				$data[] = array(
						"ID_INDIKATOR"		=> $_POST['id_indikator'][$key],
						"DIVISI"			=> $_POST['nama_divisi'][$key],
						"BOBOT"				=> $_POST['bobot'][$key],
						"TOTAL_BOBOT"		=> $_POST['total_bobot'][$key],
						"TARGET_PERTAHUN"	=> $_POST['target_pertahun'][$key],
						"NILAI_PENETAPAN"	=> $_POST['nilai_penetapan'][$key],
						"REALISASI"			=> $_POST['realisasi'][$key],
						"NILAI_REALISASI"	=> $_POST['nilai_realisasi'][$key],
						"JENIS_REALISASI"	=> $_POST['jenis_realisasi'][$key],
						"TOTAL_NILAI"		=> $_POST['total_nilai'][$key],
						"STATUS"			=> 'SIMPAN',
						"TAHUN"				=> $thn,
						"TMT"				=> $_POST['TMT'][$key],
						"TST"				=> $_POST['TST'][$key],
						"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
				);
			}

			$this->Model_master_penalty->simpan_realisasi($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Menyimpan Data Penalty Penetapan SKI Divisi '.$n.'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/buat_penalty_realisasi/'.$hasil.'/'.$tw,'refresh');	
		}
		
	}

	// Fungsi untuk aksi ubah atau simpan data
	public function simpan_ubah_penalty_realisasi()
	{
		if (isset($_POST['submit_data'])) {
			$divisi 	= $this->input->post('nama_divisi');
			$n 			= $divisi[0];
			$triwulan 	= $this->input->post('jenis_realisasi');
			$tw			= $triwulan[0];

			foreach ($divisi as $key => $value) {
				$data[] = array(
						"ID_PENALTY_R"		=> $_POST['id_penalty_r'][$key],
						"REALISASI"			=> $_POST['realisasi'][$key],
						"NILAI_REALISASI"	=> $_POST['nilai_realisasi'][$key],
						"JENIS_REALISASI"	=> $_POST['jenis_realisasi'][$key],
						"TOTAL_NILAI"		=> $_POST['total_nilai'][$key],
						"STATUS"			=> 'KIRIM',
						"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
				);
			}

			$this->Model_master_penalty->simpan_ubah_realisasi($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Mengirim Data Penalty Penilaian SKI Divisi <strong>'.$n.'</strong>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/penilaian_penalty/'.$tw,'refresh');

		} else {
			$divisi 	= $this->input->post('nama_divisi');
			$n 			= $divisi[0];
			$triwulan 	= $this->input->post('jenis_realisasi');
			$tw 		= $triwulan[0];

			$ganti 	= array('_','dan');
			$asli 	= array(' ','&');
			$hasil 	= str_replace($asli, $ganti, $n);

			foreach ($divisi as $key => $value) {
				$data[] = array(
						"ID_PENALTY_R"		=> $_POST['id_penalty_r'][$key],
						"REALISASI"			=> $_POST['realisasi'][$key],
						"NILAI_REALISASI"	=> $_POST['nilai_realisasi'][$key],
						"TOTAL_NILAI"		=> $_POST['total_nilai'][$key],
						"STATUS"			=> 'SIMPAN',
						"INPUT_TIME"		=> date('Y-m-d H:i:s', now('Asia/Jakarta'))
				);
			}

			$this->Model_master_penalty->simpan_ubah_realisasi($data);

			echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Mengubah Data Penalty Penetapan SKI Divisi <strong>'.$n.'</strong>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

			redirect('Master/buat_penalty_realisasi/'.$hasil.'/'.$tw,'refresh');	
		}
	} 

	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR MASTER PENALTY 											*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*										MASTER BUAT SKI KADIV 											*/	
	/*																										*/
	/********************************************************************************************************/

	// lihat data Penetapan SKI Karyawan
	public function penetapan_karyawan()
	{
		$nipeg=$this->session->userdata('ses_nipeg');

		$data['judul']	= 'Buat SKI Kadiv';
		$data['poto'] 	= $this->get_url_photo($nipeg);
	
		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

		// belum submit penetapan SKI
		$data['karyawan_blm'] 	=	$this->Model_master_buat_ski_kadiv->get_karyawan_blm($thn)->result();
		$data['karyawan_blm_h'] =	$this->Model_master_buat_ski_kadiv->get_karyawan_blm_h($thn);
		// ubah data penetapan SKI
		$data['karyawan_ubah'] 	=	$this->Model_master_buat_ski_kadiv->get_karyawan_ubah($thn)->result();
		$data['karyawan_ubah_h']=	$this->Model_master_buat_ski_kadiv->get_karyawan_ubah_h($thn);
		// sudah penetapan SKI
		$data['karyawan_sdh']	=	$this->Model_master_buat_ski_kadiv->get_karyawan_sdh($thn)->result();
		$data['karyawan_sdh_h'] =	$this->Model_master_buat_ski_kadiv->get_karyawan_sdh_h($thn);

		$this->template->load('template_admin','master/buat_ski_kadiv/lihat_penetapan',$data);
	}

	// lihat data penilaian triwulan SKI Karyawan
	public function penilaian_karyawan($tw)
	{
		$nipeg=$this->session->userdata('ses_nipeg');

		$data['judul']	= 'Buat SKI Kadiv';
		$data['poto'] 	= $this->get_url_photo($nipeg);
		$data['tw']		= $tw;
	
		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

		// belum submit penilaian tw
		$data['karyawan_blm'] 	=	$this->Model_master_buat_ski_kadiv->get_karyawan_tw_blm($thn,$tw)->result();
		$data['karyawan_blm_h'] =	$this->Model_master_buat_ski_kadiv->get_karyawan_tw_blm_h($thn,$tw);

		// ubah data submit penilaian tw
		$data['karyawan_ubah'] 	=	$this->Model_master_buat_ski_kadiv->get_karyawan_tw_ubah($thn,$tw)->result();
		$data['karyawan_ubah_h'] =	$this->Model_master_buat_ski_kadiv->get_karyawan_tw_ubah_h($thn,$tw);

		// sudah submit penilaian tw
		$data['karyawan_sdh'] 	=	$this->Model_master_buat_ski_kadiv->get_karyawan_tw_sdh($thn,$tw)->result();
		$data['karyawan_sdh_h'] =	$this->Model_master_buat_ski_kadiv->get_karyawan_tw_sdh_h($thn,$tw);

		$this->template->load('template_admin','master/buat_ski_kadiv/lihat_penilaian',$data);
	}

	function get_pen_kadiv_blm()
    {
      	$list = $this->Model_master_buat_ski_kadiv->get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {

            $no++;
            $row = array();
            $row[] = "<center>$no</center>";
            $row[] = $r->NIPEG;
            $row[] = $r->NAMA;
            $row[] = $r->JOBTITLE;
            $row[] = '<center><a class="btn btn-danger" href=" '.base_url().'Master/buat_ski/'.$r->NIPEG.'">B U A T - S K I</a></center>';
			$data[] = $row;
            
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Model_master_buat_ski_kadiv->count_all(),
                        "recordsFiltered" => $this->Model_master_buat_ski_kadiv->count_filtered(),
                        "data" => $data
                );
        //output to json format
        echo json_encode($output);
    }

    public function penilaian_ski($nipeg_param,$tw)
    {
    	$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']	= 'Buat Penilaian SKI Kadiv';
		$data['poto'] 	= $this->get_url_photo($nipeg);
		$data['nipeg']	= $nipeg_param;
		$data['buat_tw']= "kadiv";
		$data['waktu'] 	= $this->Model_karyawan->get_data_status()->row_array();
		$data['tw_param'] = $tw;
	
		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

		$data['versi']=$versi=$this->Model_karyawan->jumlah_penetapan_ski($nipeg_param,$thn);

		$data['data_karyawan'] 	= $this->Model_karyawan->get_data_karyawan_nilai($nipeg_param,$thn,$versi)->row_array();


		$data['data_target_utama']	= $this->Model_karyawan->get_target_utama_tw($nipeg_param,$thn,$versi)->result();
		$data['data_target_sla']	= $this->Model_karyawan->get_target_sla_tw($nipeg_param,$thn,$versi)->result();

		$data['data_utama_nilai']	= $this->Model_karyawan->get_preview_target_utama($nipeg_param,$thn,$tw)->result();
		$data['data_sla_nilai']		= $this->Model_karyawan->get_preview_target_sla($nipeg_param,$thn,$tw)->result();
		
		$data['status_nilai']		= $this->Model_karyawan->ambil_status($nipeg_param,$thn,$tw)->row();
		
		$ambil_divisi  = $this->Model_karyawan->get_data_karyawan($nipeg_param)->result_array();

			foreach ($ambil_divisi as $d) {
				$divisi = $d['DIVISI'];
				
				foreach ($status as $st ) { 
					$c = array('pr.DIVISI' => $divisi, 'TAHUN' => $thn, 'JENIS_REALISASI' => $tw);
					$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty_tw($c)->result();
				}
			}

    	$this->template->load('template_admin','ski/penilaian_ski', $data);
    }

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
			      "input_by"		=> "ADMIN",
			      "TMT"				=> $_POST['TMT'][$key],
			      "TST"				=> $_POST['TST'][$key]
					);
		    }  

		$this->Model_karyawan->realisasi_nilai($data);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; menyimpan Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		
		echo json_encode(array("status" => TRUE));
	}

	public function kirim_nilai_tw($tw)
	{
		$nipeg = $this->input->post('NIPEG');

		$nip = $nipeg[0];

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		$nama = $this->Model_karyawan->get_data_karyawan_1($nip)->row_array();

		$atasan = $this->Model_karyawan->get_nipeg_atasan($nip)->row_array();

		$atasan1 = $atasan['atasan1'];
		$atasan2 = $atasan['atasan2'];

		foreach($nipeg AS $key => $val)
		    {
			   $data[] = array(
			      "NIPEG"  			=> $_POST['NIPEG'][$key],
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
			      "ATASAN_1"		=> $atasan1,
			      "approve_atasan1_datetime"	=> date('Y-m-d H:i:s',now('Asia/Jakarta')),
			      "ATASAN_2"		=> $atasan2,
			      "approve_atasan2_datetime"	=> date('Y-m-d H:i:s',now('Asia/Jakarta')),
			      "input_time"		=> date('Y-m-d H:i:s',now('Asia/Jakarta')),
			      "input_by"		=> "ADMIN",
			      "TMT"				=> $_POST['TMT'][$key],
			      "TST"				=> $_POST['TST'][$key]
					);
		    }  

		$this->Model_karyawan->realisasi_nilai($data);

		$c = array("APPROVE_$tw" => "ATASAN2");

		$this->Model_karyawan->update_status_ski(array("NIPEG" => $nip), $c);

		
		echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengirim Nilai atas nama '.$nama['NAMA'].'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		echo json_encode(array("status" => TRUE));	
	}

	public function kirim_ubah_nilai_tw($tw)
	{
		$nipeg = $this->input->post('NIPEG');

		$nip = $nipeg[0];

		$atasan = $this->Model_karyawan->get_nipeg_atasan($nip)->row_array();

		$atasan1 = $atasan['atasan1'];
		$atasan2 = $atasan['atasan2'];
		
		foreach($nipeg AS $key => $val)
		    {
			   $data[] = array(
			   	  "id_realisasi"	=> $_POST['id_realisasi'][$key],
			      "realisasi"		=> $_POST['realisasi'][$key],
			      "nilai_realisasi" => $_POST['nilai_realisasi'][$key],
			      "total_realisasi" => $_POST['total_realisasi'][$key],
			      "nilai_ski"		=> $_POST['total_nilai_ski'][$key],
			      "status"			=> 'KIRIM',
			      "ATASAN_1"		=> $atasan1,
			      "approve_atasan1_datetime"	=> date('Y-m-d H:i:s',now('Asia/Jakarta')),
			      "ATASAN_2"		=> $atasan2,
			      "approve_atasan2_datetime"	=> date('Y-m-d H:i:s',now('Asia/Jakarta')),
			      "input_time"		=> date('Y-m-d H:i:s',now('Asia/Jakarta'))
					);
		    }  

		$this->Model_karyawan->ubah_realisasi_nilai($data);

		$c = array("APPROVE_$tw" => "ATASAN2");

		$this->Model_karyawan->update_status_ski(array("NIPEG" => $nip), $c);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; mengirim Nilai.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		
		echo json_encode(array("status" => TRUE));
	}

	/********************************************************************************************************/
	/*																										*/
	/*									AKHIR MASTER BUAT SKI KADIV 										*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*											MASTER STATUS												*/	
	/*																										*/
	/********************************************************************************************************/

	// lihat data status
	public function tampil_status()
	{			
		$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']	='Status Pembukaan SKI';
		$data['poto'] 	= $this->get_url_photo($nipeg);
		$data['status1']= $this->Model_admin->tampil_status()->result();

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','tampil_status', $data);
	}

	public function reset_ski(){
		if($this->input->post('nipeg')==$this->session->userdata('ses_nipeg')){
			$data=array(
				'buat_ski'=>'BELUM',
				'approve'=>'BELUM',
				'APPROVE_TW1'=>'BELUM',
				'APPROVE_TW2'=>'BELUM',
				'APPROVE_TW3'=>'BELUM',
				'APPROVE_TW4'=>'BELUM'
			);
			$this->db->set($data);
			$this->db->update('role');
			echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Anda sukses reset data seluruh ski karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		}else{
			echo $this->session->set_flashdata('msg','<div class="alert alert-danger"><span class="badge badge-pill badge-danger">Gagal!</span>&nbsp;&nbsp; Maaf anda salah memasukan NIPEG anda.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		}
		redirect(base_url('master/tampil_status'));
	}
	
	public function pembukaan_ski()
	{
		$id = 1;

		$data = array(
					'status_tw'	=> $this->input->post('status'),
					'TST'		=> $this->input->post('tst'),
					'TMT'		=> $this->input->post('tmt'),
					'tahun'		=> $this->input->post('tahun'));

		$this->Model_admin->ubah_pembukaan_ski($data,$id);

		echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; Anda sukses mengubah status SKI.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

		redirect('master/tampil_status');	
	}

	/********************************************************************************************************/
	/*																										*/
	/*										AKHIR MASTER STATUS												*/	
	/*																										*/
	/********************************************************************************************************/

	/*******************************************************************************************************
										SIDEBAR >>>> BUAT - SKI
	*******************************************************************************************************/

	public function buat_ski($id)
	{	
		$nip 				= $this->session->userdata('ses_nipeg');

		$data['judul']		= "Buat SKI";
		$data['buat_ski']	= "kadiv";
		$data['nip_kadiv']	= $id;			
		$data['poto'] 		= $this->get_url_photo($nip);

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$status_tw 		= $st['status_tw'];
				$data['tahun']	= $st['tahun'];
				$data['status'] = $status_tw;
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$thn = $st['tahun'];

		$jobtitle = $this->Model_karyawan->get_karyawan($id)->result_array();

			foreach ($jobtitle as $jb) {
				$job = $jb['JOBTITLE'];
			}
		$versi	=	$this->Model_karyawan->jumlah_penetapan_ski($id,$thn);

		$data['nm'] 					= $this->Model_karyawan->get_nama_karyawan_nilai_2($id,$thn,$versi)->row();
		$data['data_karyawan'] 			= $this->Model_karyawan->get_karyawan($id)->row_array();
		$data['cari_indikator'] 		= $this->Model_karyawan->get_nama_karyawan($job)->result();
		$data['data_target_utama'] 		= $this->Model_karyawan->get_target_utama($job)->result();
		$data['data_target_sla'] 		= $this->Model_karyawan->get_target_sla($job)->result();
		$data['versi']					= $this->Model_karyawan->jumlah_penetapan_ski($id,$thn)+1;

		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($id)->result_array();
		foreach ($ambil_divisi as $d) {
			$divisi = $d['DIVISI'];
			
			$c = array('pp.DIVISI' => $divisi, 'TAHUN_INSERT' => $thn);
			$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty($c)->result();
		}

		$this->template->load('template_admin','ski/buat_ski', $data);
		
	}

	/*******************************************************************************************************
										FUNGSI AKSI >>>> BUAT - SKI
	*******************************************************************************************************/
	public function tambah_ski()
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
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
		      "input_by"		=> "ADMIN",
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

	public function ubah_ski($id)
	{
		$nipeg 	= $id;
		$nip 	= $this->session->userdata('ses_nipeg');

		$data['judul']		='Ubah SKI';
		$data['poto'] 		= $this->get_url_photo($nip);
		$data['buat_ski']	= "kadiv";
		$data['nip_kadiv']	= $id;	

		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$thn 			= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$versi=$this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

		$data['data_karyawan']			= $this->Model_karyawan->get_data_karyawan_nilai($nipeg,$thn, $versi)->row_array();
		$data['nama_karyawan'] 			= $this->Model_karyawan->get_nama_karyawan_nilai($nipeg,$thn, $versi)->result();
		$data['nm'] 					= $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn, $versi)->row();
		$data['data_target_utama'] 		= $this->Model_karyawan->get_target_utama_nilai_his($nipeg,$thn,$versi)->result();
		$data['data_target_sla'] 		= $this->Model_karyawan->get_target_sla_nilai_his($nipeg,$thn,$versi)->result();

		$data['versi']					= $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn)+1;

		//penalti
		$ambil_divisi		= $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();
		foreach ($ambil_divisi as $d) {
			$divisi = $d['DIVISI'];
			
			$c = array('pp.DIVISI' => $divisi, 'TAHUN_INSERT' => $thn);
			$data['data_target_penalty']	= $this->Model_karyawan->get_target_penalty($c)->result();
			$data['data_target_penalti']	= $this->Model_karyawan->get_target_penalty($c)->row_array();

		}

		$this->template->load('template_admin','ski/ubah_ski',$data);
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

		$a = $this->Model_karyawan->get_data_karyawan_1($id)->row_array();	
		$atasan1 = $a['NIPEG_UP'];

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
			      "input_time"		=> date('Y-m-d H:i:s', now('Asia/Jakarta')),
			      "ATASAN_1"		=> $atasan1,
			      "approve_atasan1_datetime" => date('Y-m-d H:i:s', now('Asia/Jakarta'))
			      
				);
		    }  

		
		$data1 = [
		    'buat_ski' => 'SUDAH',
		    'approve'  => 'SUDAH'
		];
		
		$this->Model_karyawan->get_ubah_nilai($data);


		$this->Model_karyawan->update_status_ski(array('NIPEG' => $id) ,$data1);


		echo json_encode(array("status" => TRUE));
	}

	public function submit_nilai_langsung($id)
	{
		$status = $this->Model_karyawan->get_data_status();
			foreach ($status->result_array()  as $st ) {
				$thn = $st['tahun'];
			}

		$a = $this->Model_karyawan->get_data_karyawan_1($id)->row_array();	
		$atasan1 = $a['NIPEG_UP'];

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
			      "input_by"		=> "ADMIN",
			  	  "tahun_insert"  	=> $thn,
			  	  "input_time"		=> date('Y-m-d H:i:s', now('Asia/Jakarta')),
			  	  "ATASAN_1"		=> $atasan1,
			      "approve_atasan1_datetime" => date('Y-m-d H:i:s', now('Asia/Jakarta'))
					);
		    }   

		$this->Model_karyawan->simpan_nilai($result);

		// Merubah status buat SKI

		$data = [ 'buat_ski' => 'SUDAH', 'approve'  => 'SUDAH' ];

		$this->Model_karyawan->update_status_ski(array('NIPEG' => $n) ,$data);

		echo json_encode(array("status"=> TRUE));
	}

	/********************************************************************************************************/
	/*																										*/
	/*										MASTER status Model_karyawan									*/	
	/*																										*/
	/********************************************************************************************************/
	
	public function status_karyawan(){

		$nipeg = $this->session->userdata('ses_nipeg');

		$data['judul']	= 'Data karyawan';
		$data['poto'] 	= $this->get_url_photo($nipeg);	

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','master/status_karyawan/status_karyawan',$data);
	}

	function get_status_data_karyawan()
    {
      $list = $this->Model_master_karyawan->get_datatables();
        $data = array();
        
        $no = $_POST['start'];
        foreach ($list as $r) {
        	if($r->STATUS_KARYAWAN==null){
        		$status='AKTIF';
        	}
        	elseif($r->STATUS_KARYAWAN=='DIPEKERJAKAN'){
        		$status='DIPEKERJAKAN/DITUGASKAN';
        	}
        	else{
        		$status=$r->STATUS_KARYAWAN;
        	}

        	if($r->STATUS_KARYAWAN==null){
              $a='<option selected value="">AKTIF</option>
              <option  value="DIPEKERJAKAN">DIPEKERJAKAN/DITUGASKAN</option>
              <option value="DIREKSI">DIREKSI</option>
              <option value="KOMISARIS">KOMISARIS</option>
              <option value="MPP">MPP</option>';
            }
            elseif($r->STATUS_KARYAWAN=="MPP"){
              $a='<option value="">AKTIF</option>
              <option value="DIPEKERJAKAN">DIPEKERJAKAN/DITUGASKAN</option>
              <option value="DIREKSI">DIREKSI</option>
              <option value="KOMISARIS">KOMISARIS</option>
              <option selected value="MPP">MPP</option>';
            }
            elseif($r->STATUS_KARYAWAN=="DIPEKERJAKAN"){
              $a='<option value="">AKTIF</option>
              <option selected value="DIPEKERJAKAN">DIPEKERJAKAN/DITUGASKAN</option>
              <option value="DIREKSI">DIREKSI</option>
              <option value="KOMISARIS">KOMISARIS</option>
              <option value="MPP">MPP</option>';
            }
            elseif($r->STATUS_KARYAWAN=="DIREKSI"){
              $a='<option  selected   value="">AKTIF</option>
              <option value="DIPEKERJAKAN">DIPEKERJAKAN/DITUGASKAN</option>
              <option selected value="DIREKSI">DIREKSI</option>
              <option value="KOMISARIS">KOMISARIS</option>
              <option value="MPP">MPP</option>';
            }
            elseif($r->STATUS_KARYAWAN=='KOMISARIS'){
              $a='<option value="">AKTIF</option>
              <option value="DIPEKERJAKAN">DIPEKERJAKAN/DITUGASKAN</option>
              <option value="DIREKSI">DIREKSI</option>
              <option selected value="KOMISARIS">KOMISARIS</option>
              <option value="MPP">MPP</option>';
            }

            $no++;
            $row = array();
            $row[] = $r->NIPEG.'<input type="hidden" value='.$r->NIPEG.' name="nipeg[]">';
            $row[] = $r->NAMA;
            $row[] = $r->DIVISI;
            $row[] = $r->JOBTITLE;
            $row[] = '<select class="form-control border-input" name="status[]">'.$a.'
            		  </select><font size="1" style="background-color:green; color:white;"> Status Karyawan Saat ini: '.$status.' </font>';

            $data[] = $row;
            
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Model_master_karyawan->count_all(),
                        "recordsFiltered" => $this->Model_master_karyawan->count_filtered(),
                        "data" => $data
                );
        //output to json format
        echo json_encode($output);
    }

    public function action_status_karyawan()
    {
    	$nipeg 	= $this->input->post('nipeg');
    	$status = $this->input->post('status');

    	$jml 	= count($nipeg);

    	for($i=0; $i < $jml; $i++){

    		$data 	= array('STATUS_KARYAWAN' => $status[$i]);

    		$where 	= array('NIPEG' => $nipeg[$i]);

    		$this->Model_master_karyawan->ubah_status($data,$where);
    	}

    	echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp;Anda Sukses Mengubah Status Karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');

    	redirect(base_url("master/status_karyawan"));
    }

    
 	/********************************************************************************************************/
	/*																										*/
	/*										MASTER BUAT SKI BARU											*/	
	/*																										*/
	/********************************************************************************************************/
	public function buat_ski_baru()
	{
		$data['judul']	= 'Master Buat SKI Baru';
		$nipeg 			= $this->session->userdata('ses_nipeg');
		$data['poto'] 	= $this->get_url_photo($nipeg);
		$data['divisi'] = $this->Model_histori_karyawan_bag_admin->get_divisi()->result();

		$status = $this->Model_karyawan->get_data_status();

			foreach ($status->result_array()  as $st ) {
				$data['status'] = $st['status_tw'];
				$data['thn']	= $st['tahun'];
				$data['tst']	= $st['TST'];
			}

		$this->template->load('template_admin','master/buat_penetapan_baru/master_penetapan_baru',$data);
	}

	public function get_karyawan()
	{
		$divisi =  $this->input->post('divisi');
		$list 	= $this->Model_penetapan_baru->get_datatables($divisi);

		$data 	= array();

		$no 	= $_POST['start'];
		$nomor=-1;
		foreach ($list as $r) { 
			$nomor++;
			if($r->buat_ski=='SUDAH'){
				$a = '

				<div class="btn-group btn-group-toggle" data-toggle="buttons">
				  <label class="btn btn-success btn-sm active" style="font-size:13px;">
				    <input type="radio" value="SUDAH" autocomplete="off" name="options['.$nomor.']" checked>
				    SUDAH
				  </label>
				  <label class="btn btn-light btn-sm">
				    <input type="radio" value="BELUM" autocomplete="off" name="options['.$nomor.']">
				    BELUM
				  </label>
				  <label class="btn btn-light btn-sm">
				    <input type="radio" value="BARU" autocomplete="off" name="options['.$nomor.']">
				    SKI BARU
				  </label>
				</div>

				';
			}elseif($r->buat_ski=='BELUM'){
				$a = '

				<div class="btn-group btn-group-toggle" data-toggle="buttons">
				  <label class="btn btn-light btn-sm">
				    <input type="radio" value="SUDAH" autocomplete="off" name="options['.$nomor.']">
				    SUDAH
				  </label>
				  <label class="btn btn-danger btn-sm active" style="font-size:13px;">
				    <input type="radio" value="BELUM" autocomplete="off" name="options['.$nomor.']" checked>
				    BELUM
				  </label>
				  <label class="btn btn-light btn-sm">
				    <input type="radio" value="BARU" autocomplete="off" name="options['.$nomor.']">
				    SKI BARU
				  </label>
				</div>

				';
			}else{
				$a = '

				<div class="btn-group btn-group-toggle" data-toggle="buttons">
				  <label class="btn btn-light btn-sm">
				    <input type="radio" value="SUDAH" autocomplete="off" name="options['.$nomor.']">
				    SUDAH
				  </label>
				  <label class="btn btn-light btn-sm">
				    <input type="radio" value="BELUM" autocomplete="off" name="options['.$nomor.']">
				    BELUM
				  </label>
				  <label class="btn btn-primary btn-sm active" style="font-size:13px;">
				    <input type="radio" value="BARU" autocomplete="off" name="options['.$nomor.']" checked>
				    SKI BARU
				  </label>
				</div>

				';
			}

			


		    $no++;
		    $row = array();
		    $row[] = "<center>$no</center>";
		    $row[] = $r->NIPEG.'<input type="hidden" value="'.$r->NIPEG.'" name="nipeg[]">';
			$row[] = $r->NAMA;
			$row[] = $r->JOBTITLE;					
			$row[] = $r->DIVISI;
			$row[] = $a; 
		    $data[] = $row;            
		}

		$output = array(
		                 "draw" => $this->input->post('draw'),
		                "recordsTotal" => $this->Model_penetapan_baru->count_all(),
		                "recordsFiltered" => $this->Model_penetapan_baru->count_filtered($divisi),
		                "data" => $data,
		        	);

		//output to json format
		echo json_encode($output);
	  }

	 public function proses_buat_ski(){
	 	$nipeg 	=   $this->input->post('nipeg');
		$option1 	=   $this->input->post('options');
		$jml=count($nipeg);
         for($i=0; $i<$jml; $i++){        		
         		$data = array('buat_ski' => $option1[$i],
         						'approve'=>'BELUM'
         		 );
         		$kondisi=array('NIPEG' => $nipeg[$i] );
         		$this->db->update('role',$data,$kondisi);
        }

    	echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp; Anda Sukses Mengubah status penetapan SKI karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
        redirect(base_url('master/buat_ski_baru'));
	 }

	 public function proses_buat_ski_semua()
	 {
	 	$data = array("buat_ski" => "BARU");

	 	$this->db->update('role', $data);

	 	echo $this->session->set_flashdata('msg','<div class="alert alert-success"><span class="badge badge-pill badge-success">Success !</span>&nbsp;&nbsp; Anda Sukses Mengubah semua status penetapan SKI karyawan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
        redirect(base_url('master/buat_ski_baru'));
	 }
    
}