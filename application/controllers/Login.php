<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }
    function index(){
        $this->load->view('v_login');
    }
    function auth(){
        $e_mail=$this->input->post('e_mail');
		$this->session->set_userdata('ses_id',$e_mail);
        $cek_user=$this->login_model->auth_karyawan($e_mail);
            if($cek_user->num_rows() > 0){ //jika login sebagai dosen 
                $data=$cek_user->row_array();
                $this->session->set_userdata('masuk',TRUE);
                if($data['ROLE']=='Admin')
					{ //Akses admin 
						$this->session->set_userdata('akses','admin');
                        $this->session->set_userdata('ses_nama',$data['NAMA']);
                        $this->session->set_userdata('ses_role',$data['ROLE']);
                        $this->session->set_userdata('ses_role1',$data['ROLE1']);
                        $this->session->set_userdata('ses_role2',$data['ROLE2']);
						$this->session->set_userdata('ses_nipeg',$data['NIPEG']);
                        $this->session->set_userdata('ses_nipegup',$data['NIPEG_UP']);

						redirect('admin');
					}
				elseif($data['ROLE']=='Karyawan'){
					   //akses karyawan 
						$this->session->set_userdata('akses','karyawan');
                        $this->session->set_userdata('ses_nama',$data['NAMA']);
                        $this->session->set_userdata('ses_role',$data['ROLE']);
                        $this->session->set_userdata('ses_role1',$data['ROLE1']);
						$this->session->set_userdata('ses_role2',$data['ROLE2']);
                        $this->session->set_userdata('ses_nipeg',$data['NIPEG']);
                        $this->session->set_userdata('ses_nipegup',$data['NIPEG_UP']);
						redirect('karyawan');
                	}
					
				elseif($data['ROLE']=='Atasan'){
					   //akses atasan1 
						$this->session->set_userdata('akses','atasan');
                        $this->session->set_userdata('ses_nama',$data['NAMA']);
                        $this->session->set_userdata('ses_role',$data['ROLE']);
                        $this->session->set_userdata('ses_role1',$data['ROLE1']);
                        $this->session->set_userdata('ses_role2',$data['ROLE2']);
                        $this->session->set_userdata('ses_nipeg',$data['NIPEG']);
                        $this->session->set_userdata('ses_nipegup',$data['NIPEG_UP']);
						redirect('atasan1');
                	}
            }
		else{ 
					// jika username dan password tidak ditemukan atau salah
                    $url=base_url().'login'; 
                    echo $this->session->set_flashdata('msg','<div class="alert alert-danger">Gagal! Nip atau password anda salah.</div>'); 
                    redirect($url);
                }
    }
    function logout()
    {
        $this->session->sess_destroy();
        $url=base_url().'login';
        redirect($url);
    }
}
