<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ski_mail extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('Model_karyawan');
    $this->load->model('Model_atasan1');
    $this->load->model('Model_history_ski');
    $this->load->model('Model_histori_karyawan_bag_admin');
  }

	public function index($id,$atasan)
    {
      $a=$this->Model_karyawan->get_atasan_langsung($atasan)->result();
      foreach ($a as $key) {
        $nm_atasan=$key->NAMA;
        $mail=$key->E_MAIL;
        $nipegatasan2=$key->NIPEG;
      }
      $tw=$this->Model_karyawan->get_data_status()->result();
      foreach ($tw as $key) {
        if($key->status_tw=='TW1'){
          $tw='1';
        }
        elseif($key->status_tw=='TW2'){
          $tw='2';
        }
        elseif($key->status_tw=='TW3'){
          $tw='3';
        }
        elseif($key->status_tw=='TW4'){
          $tw='4';
        };
      }
    $kond=$this->Model_karyawan->get_tahun_ski()->result();
    foreach ($kond as $key) {
      $thn=$key->tahun;
    }
      $config = Array(  
      'protocol' => 'smtp',  
      'smtp_host' => 'ssl://smtp.googlemail.com',  
      'smtp_port' => 465,  
      'smtp_user' => 'pambayun62@gmail.com',   
      'smtp_pass' => 'muhgirip',   
      'mailtype' => 'html',   
      'charset' => 'iso-8859-1'  
     );  

     $this->load->library('email', $config);  
     $this->email->set_newline("\r\n");  
     $this->email->from('ski_online@gmail.com', 'Donotreply');   
     $this->email->to($mail);   
     $this->email->subject('permintaan Approval SKI Triwulan '.$tw);       
     $nama= $this->Model_karyawan->cari_nama_mail($id)->result();
     foreach($nama as $name){
     $this->email->message('
      Berikut Ski triwulan '.$tw.' yang telah di buat dan sudah di approve oleh bapak/ibu<b> '.$this->session->userdata("ses_nama").'</b> atasan 1 serta menunggu approval dari bapak/ibu<b> '.$nm_atasan.' </b>sebagai atasan 2 dengan:<br>
      <table>
        <tr>
          <td>NIPEG : '.$id.' </td>
        </tr>
        <tr>
          <td>Nama : '.$name->NAMA.'</td>
        </tr>
      </table>
       <a href="'.base_url().''.encrypt_url($id).'/'.encrypt_url($nipegatasan2).'/'.encrypt_url($tw).'/'.encrypt_url($thn).'">
        <button style="color: #fff; background-color: #337ab7; padding: 6px 12px; font-size: 14px; border: transparent;">Preview</button>
      </a>
      <a href="'.base_url().''.encrypt_url($id).'/'.encrypt_url($nipegatasan2).'/'.encrypt_url($tw).'/'.encrypt_url($thn).'">
        <button style="color: #fff; background-color: #28b779; padding: 6px 12px; font-size: 14px; border: transparent;">Approve</button>
      </a>
      <a href='.base_url().''.encrypt_url($id).'/'.encrypt_url($nipegatasan2).'/'.encrypt_url($tw).'/'.encrypt_url($thn).'">
        <button style="color: #fff; background-color: #da542e; padding: 6px 12px; font-size: 14px; border: transparent;">Tolak Ski</button>
      </a>
     
      ');}  
     if (!$this->email->send()) {  
      show_error($this->email->print_debugger());   
     }else{  
      echo $this->session->set_flashdata('msg','<div class="alert alert-success">Anda &nbsp;&nbsp;<span class="badge badge-pill badge-success">Success</span>&nbsp;&nbsp; approve SKI Dan melanjutkan mengirim email ke atasan anda.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
      redirect(base_url('atasan1/karyawan_penilaian/'.$id));
     }  
     
  }

  public function approve($id,$atasan,$tw,$year)
  {
    $thn=decrypt_url($year);
    $Decryptedtw = decrypt_url($tw);
    $Decryptedatasan = decrypt_url($atasan);
    $data = [
        'APPROVE_TW'.$Decryptedtw => 'ATASAN2' 
    ];
      $Decrypted = decrypt_url($id);
      $this->db->where('NIPEG',$Decrypted);
      $this->db->update('role',$data);
      $e = array(
          "NIPEG" => $Decrypted, 
          "tahun" => $thn, 
          "jenis_realisasi" => "TW".$Decryptedtw);

      $updt = [
          "ATASAN_2" => $Decryptedatasan,
          "approve_atasan2_datetime"=> date('Y-m-d', now('Asia/Jakarta'))
      ];
      $this->Model_atasan1->update_tgl_approve($e ,$updt);
      redirect(base_url('ski_mail/sending_mail/'.$id.'/'.$year.'/'.$tw.'/'.$atasan.'/DISETUJUI/green'));
  }

  public function tolak($id,$atasan,$tw,$year)
  {
    $thn=decrypt_url($year);
    $Decryptedtw = decrypt_url($tw);    
    $Decryptedatasan = decrypt_url($atasan);
    $data = [
        'APPROVE_TW'.$Decryptedtw => 'DITOLAK' 
    ];
      $Decrypted = decrypt_url($id);
      $this->db->where('NIPEG',$Decrypted);
      $this->db->update('role',$data);

      $e = array(
          "NIPEG" => $Decrypted, 
          "tahun" => $thn, 
          "jenis_realisasi" => "TW".$Decryptedtw);

      $updt = [
          "ATASAN_2" => 'DITOLAK',
          "approve_atasan2_datetime"=> date('Y-m-d', now('Asia/Jakarta'))
      ];
      $this->Model_atasan1->update_tgl_approve($e ,$updt);
      redirect(base_url('ski_mail/sending_mail/'.$id.'/'.$year.'/'.$tw.'/'.$atasan.'/DITOLAK/red'));
  }

  function preview($id,$atasan,$trw,$year){
    $data['tahun']=$tahun=decrypt_url($year);
    $data['nipeg']=$nipeg = decrypt_url($id);
    $data['status_tw']=$status_tw='TW'.decrypt_url($trw);
    $data['judul']  = "Preview Penilaian SKI";

    $versi  = $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$tahun);

    $status = $this->Model_karyawan->get_data_status()->result();

      foreach ($status as $st) {
        $hasil = array('r.tahun' => $st->tahun, 'r.jenis_realisasi' => $st->status_tw, 'r.NIPEG' => $nipeg );

        $data['w']       = $this->Model_karyawan->get_data_waktu($hasil);
        $data['data_status'] = $this->Model_karyawan->get_data_status_real($hasil)->row();
        $data['tst'] = $st->TST;
        $data['thn'] = $st->tahun;
        $thn         = $st->tahun;
      }

    $thn  = $st->tahun;

    $nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);  
    $dt = array('NIPEG' => $nipeg, 'tahun'=> $thn); 

   $data['nm']           = $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn,$versi)->row();
    $data['status_pembuatan_ski']   = $this->Model_karyawan->status_ski($nip_karyawan); 
    $data['status_penilaian_ski']   = $this->Model_karyawan->status_ski_2($dt); 

    $data['data_karyawan']      = $this->Model_karyawan->get_data_karyawan_nilai($nipeg,$thn,$versi)->row_array();
    $data['nama_karyawan']      = $this->Model_karyawan->get_nama_karyawan_nilai_2($nipeg,$thn,$versi)->result();

    $data['waktu'] = $this->Model_karyawan->get_data_status()->row_array();

    

    $status       = $this->Model_karyawan->get_data_status();
    $ambil_divisi   = $this->Model_karyawan->get_data_karyawan($nipeg)->result_array();

    foreach ($ambil_divisi as $d) {
      $divisi = $d['DIVISI'];
      
        $c = array('pr.DIVISI' => $divisi, 'pr.TAHUN' => $thn, 'pr.JENIS_REALISASI' => $status_tw);
        $data['data_target_penalty']  = $this->Model_karyawan->get_target_penalty_tw($c)->result();
    }
    
        $data['status'] = $status_tw;
        $data['data_target_utama']  = $this->Model_karyawan->get_target_utama_tw($nipeg,$thn,$versi)->result();
        $data['data_target_sla']  = $this->Model_karyawan->get_target_sla_tw($nipeg,$thn,$versi)->result();

        $data['data_utama_nilai'] = $this->Model_karyawan->get_preview_target_utama($nipeg,$thn,$status_tw)->result();
        $data['data_sla_nilai'] = $this->Model_karyawan->get_preview_target_sla($nipeg,$thn,$status_tw)->result();
        
        $data['status_nilai']   = $this->Model_karyawan->ambil_status($nipeg,$thn,$status_tw)->row();


    $this->load->view('mail/preview',$data);
  }

  function sending_mail($id,$thn,$tw,$atasan,$status){
    $warna=$this->uri->segment(8);
    $id=decrypt_url($id);
    $thn=decrypt_url($thn);
    $tw=decrypt_url($tw);
    $atasan=decrypt_url($atasan);
    $a=$this->Model_karyawan->cari_nama_mail($atasan)->result();
      foreach ($a as $key) {
        $nm_atasan=$key->NAMA;
    }
    $b=$this->Model_karyawan->cari_nama_mail($id)->result();
      foreach ($b as $key) {
        $email= $key->E_MAIL;
        $nama=$key->NAMA;

      }
    $tw=decrypt_url($status);
      $config = Array(  
      'protocol' => 'smtp',  
      'smtp_host' => 'ssl://smtp.googlemail.com',  
      'smtp_port' => 465,  
      'smtp_user' => 'pambayun62@gmail.com',   
      'smtp_pass' => '',   
      'mailtype' => 'html',   
      'charset' => 'iso-8859-1'  
     );  

     $this->load->library('email', $config);  
     $this->email->set_newline("\r\n");  
     $this->email->from('ski_online@gmail.com', 'Report Approval SKI Triwulan'.$tw);   
     $this->email->to($email);   
     $this->email->subject('Status Approval SKI Triwulan '.$tw);       
     $this->email->message('
      Berikut status <b>SKI TRIWULAN '.$tw.'</b> yang telah anda ajukan dan diperiksa oleh atasan 2 (<b>'.$nm_atasan.'</b>) sehingga di putuskan bahwa SKI, 
      <table>
        <tr>
          <td>NIPEG : '.$id.' </td>
        </tr>
        <tr>
          <td>Nama : '.$nama.'</td>
        </tr>
        <tr>
          <td>Status SKI :<b style="color:'.$warna.'">'.$status.'</b></td>
        </tr>
      </table>     
      '); 
     if (!$this->email->send()) {  
      show_error($this->email->print_debugger());   
     }else{  
      echo $this->session->set_flashdata('msg','<b style="color:red">Anda Telah sukses membuat status SKI karyawan menjadi '.$status.'</b>');
     }  
  } 

   public function print_tw($id,$trw,$year){
         
           $thn=decrypt_url($year);
           $nipeg = decrypt_url($id);
           $tw='TW'.decrypt_url($trw);
           $data['tw']=decrypt_url($trw);
           $data['tahun']= $thn;
           $nip_karyawan = array('NIPEG' => $nipeg, 'tahun_insert'=> $thn);  
           $dt = array('NIPEG' => $nipeg, 'tahun'=> $thn); 
                  $data['status_pembuatan_ski']   = $this->Model_karyawan->status_ski($nip_karyawan); 
                  $data['status_penilaian_ski']   = $this->Model_karyawan->status_ski_2($dt);

                  $data['waktu'] = $this->Model_karyawan->get_data_status()->row_array();

                  $status = $this->Model_karyawan->get_data_status()->result();
                  $versi        = $this->Model_karyawan->jumlah_penetapan_ski($nipeg,$thn);

                  $data['data_karyawan']      = $this->Model_karyawan->get_data_karyawan_nilai($nipeg,$thn,$versi)->row_array();
                  $data['nama_karyawan']      = $this->Model_karyawan->get_nama_karyawan_nilai($nipeg,$thn,$versi)->result();
                  $data['job_histori'] = $this->Model_karyawan->histori_job_karyawan($nipeg,$thn,$versi)->row_array();
                  $data['waktu'] = $this->Model_karyawan->get_data_status()->row_array();

                  $status = $this->Model_karyawan->get_data_status()->result();

                  foreach ($status as $st) {
                    $hasil = array('r.tahun' => $st->tahun, 'r.jenis_realisasi' => $st->status_tw, 'r.NIPEG' => $nipeg );

                    $data['w'] = $this->Model_karyawan->get_data_waktu($hasil);
                  }  

                      $data['status'] = "TW1";
                      $data['data_target_utama']  = $this->Model_karyawan->get_preview_target_utama($nipeg,$thn,$tw)->result();
                      $data['data_target_sla']  = $this->Model_karyawan->get_preview_target_sla($nipeg,$thn,$tw)->result();
                      //MENGAMBIL TOTAL DARI SLA DAN UTAMA
                      $data['total_tw'] =$this->Model_karyawan->get_total_tw($nipeg, $thn, $tw)->row_array();

                      //pengambilan penaltinya 
                        $ambil_divisi = $this->Model_history_ski->get_data_karyawan($nipeg)->result_array();
                        foreach ($ambil_divisi as $key ) {
                            $divisi = $key['DIVISI'];
                            $data['penalti_tw'] =$this->Model_histori_karyawan_bag_admin->get_pinalti_tw($thn, $divisi, $tw)->result();
                        }

                  $id = 1;
                  $datatst  = $this->Model_karyawan->get_data_tst($id)->result(); 
                  foreach ($datatst as $key) {
                    $data['tst'] =$key->TST;
                  }

                  $e = array(
                        "a.NIPEG" => $nipeg, 
                        "a.tahun" => $thn, 
                        "a.jenis_realisasi" => $tw);
                  $data['ats2']= $this->Model_karyawan->get_atasan2($e)->result(); 
                  $this->load->view('ski/print/print_penilaian_karyawan_tw',$data);
        }

}
