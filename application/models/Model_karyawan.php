<?php

class Model_karyawan extends CI_Model
{
	// mencari atasan 1 dan 2
	public function get_nipeg_atasan($nipeg)
	{
		/*SELECT NIPEG_UP, NIPEG,NAMA FROM tb_karyawan WHERE NIPEG IN (SELECT NIPEG_UP FROM tb_karyawan WHERE NIPEG = 'PP.9210038')*/	
		// sub query
		$this->db->select('NIPEG_UP');
		$this->db->from('tb_karyawan');
		$this->db->where('NIPEG', $nipeg);
		$sub = $this->db->get_compiled_select();
		// main query
		$this->db->select('NIPEG_UP as atasan2, NIPEG as atasan1');
		$this->db->from('tb_karyawan');
		$this->db->where("NIPEG IN ($sub)", NULL, FALSE );

		return $this->db->get();
	}

	public function histori_job_karyawan($nipeg, $thn, $versi){
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->where('NIPEG',$nipeg);
		$this->db->where('tahun_insert',$thn);
		$this->db->where('versi',$versi);
		return $this->db->get();
	}
	
	public function get_waktu_tw($nipeg,$thn,$tw)
	{
		$this->db->from('realisasi_nilai');
		$this->db->where('NIPEG', $nipeg);
		$this->db->where('tahun', $thn);
		$this->db->where('jenis_realisasi',$tw);

		return $this->db->get();
	}

	public function get_waktu_ski($nipeg,$thn,$versi)
	{
		$this->db->from('nilai');
		$this->db->where('NIPEG', $nipeg);
		$this->db->where('tahun_insert', $thn);
		$this->db->where('versi', $versi);

		return $this->db->get();	
	}

	public function ambil_time_ski($nipeg){	 		
		$this->db->from('nilai');
		$this->db->where($nipeg);	    
        $this->db->group_by('NIPEG');
        return $this->db->get();
	}

	public function get_field_status_tw($nipeg,$tw,$thn){
		$this->db->from('realisasi_nilai');
		$this->db->where('NIPEG',$nipeg);
		$this->db->where('jenis_realisasi',$tw);
		$this->db->where('tahun',$thn);
		$this->db->group_by('NIPEG');
		return $this->db->get();
	}

	public function count_penetapan_karyawan($nipeg){	 		
		$this->db->from('nilai');
		$this->db->where($nipeg);	    
        
        return $this->db->count_all_results();
	}
		
	public function get_data_karyawan_1($nipeg){ 
      	$this->db->select('*');
		$this->db->from('tb_karyawan as a');
        $this->db->where('a.NIPEG',$nipeg);    
        
        return $this->db->get();
    }


    /*SELECT COUNT(k.nip_karyawan) from karyawan as k 
	JOIN jabatan as c on c.id_jabatan = k.id_jabatan 
	JOIN divisi as d on c.id_divisi = d.id_divisi 

	where d.id_divisi = "2" AND nip_karyawan not
	in (SELECT a.nip_karyawan FROM nilai as a join karyawan as b on a.nip_karyawan = b.nip_karyawan JOIN jabatan as c on c.id_jabatan = b.id_jabatan JOIN divisi as d on c.id_divisi = d.id_divisi 
	WHERE d.id_divisi = "2" AND a.tahun_insert = "2018")*/

	//***********************************************************************************************//
	//************************************* CHART PADA DASHBOARD  ***********************************//
	//***********************************************************************************************//

	public function get_data_jml_sdh_ski_divisi($id_divisi,$thn_grafik)
	{
		// sub query
		$this->db->select('n.NIPEG')->from('nilai as n');
		$this->db->join('tb_karyawan as k','k.NIPEG = n.NIPEG');
		$this->db->where($id_divisi);
		$this->db->where('n.tahun_insert', $thn_grafik);	 
		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan as k');
		$this->db->where($id_divisi);
		$this->db->where("NIPEG IN ($sub)", NULL, FALSE);
		
		return $this->db->count_all_results();
	}

	public function get_data_jml_blm_ski_divisi($id_divisi,$thn_grafik)
	{
		// sub query
		$this->db->select('n.NIPEG')->from('nilai as n');
		$this->db->join('tb_karyawan as k','k.NIPEG = n.NIPEG');
		$this->db->where($id_divisi);
		$this->db->where('n.tahun_insert', $thn_grafik);	 
		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan as k');
		$this->db->where($id_divisi);
		$this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);
		
		return $this->db->count_all_results();
	}

	public function status_ski($nipeg){	 		
		$this->db->from('nilai');
		$this->db->where($nipeg);	    
        
        return $this->db->count_all_results();
	}

	// mencari status buat ski di tabel ROLE
	/*public function status_buat_ski($nipeg){	 		
		$this->db->from('role');
		$this->db->where($nipeg);
		$this->db->where('buat_ski', 'SUDAH');   
        
        return $this->db->count_all_results();
	}*/
	public function status_buat_ski($nipeg){	 		
		$this->db->from('role');
		$this->db->where('NIPEG',$nipeg);  
        
        return $this->db->get();
	}

	// mencari status buat ski di tabel ROLE
	public function data_buat_ski($nipeg){	 		
		$this->db->from('role');
		$this->db->join('nilai', 'nilai.NIPEG = role.NIPEG');
		$this->db->where($nipeg);
		$this->db->where('buat_ski', 'SUDAH');   
        
        return $this->db->get();
	}

	public function status_ski_2($dt){	 		
		$this->db->from('realisasi_nilai');
		$this->db->where($dt);	    
        
        return $this->db->count_all_results();
	}
		
	public function ambil_status_ski($nipeg){	 		
		$this->db->from('nilai');
		$this->db->where($nipeg);	    
        
        return $this->db->get();
	}


	//***********************************************************************************************//
	//*************************************  B U A T - SKI  *****************************************//
	//***********************************************************************************************//

	public function get_karyawan($nipeg){
		$this->db->from('tb_karyawan as k');
		$this->db->where('k.NIPEG',$nipeg);
		
		return $this->db->get();
	}

	public function get_data_karyawan($nipeg)
	{
		$this->db->from('tb_karyawan');
		$this->db->where('NIPEG', $nipeg);

		return $this->db->get();
	}

	public function get_nama_karyawan($divisi){
		$this->db->select('k.NIPEG,
		k.NAMA,
		k.JOBTITLE,
		k.DIVISI,
		k.PANGKAT,
		i.nama_indikator,
		i.cara_pengukuran');
		$this->db->from('direktori as d');
		$this->db->join('tb_karyawan as k','d.JOBTITLE = k.JOBTITLE');
		$this->db->join('indikator as i','d.id_indikator = i.id_indikator');
		$this->db->where('d.JOBTITLE',$divisi);
		
		return $this->db->get();
	}

	public function get_target_utama($divisi)
	{
		$this->db->select('d.JOBTITLE,i.id_indikator,i.satuan_indikator, p.id_proker,i.nama_indikator, i.cara_pengukuran');
		$this->db->FROM('direktori as d');
		$this->db->join('indikator as i','i.id_indikator = d.id_indikator');
		$this->db->join('proker as p','p.id_proker = i.id_proker');
		$this->db->where('d.JOBTITLE',$divisi);
		$this->db->where('i.id_proker','1');
		
		return $this->db->get();
	}

	public function get_target_sla($divisi)
	{
		$this->db->select('d.JOBTITLE,i.id_indikator,i.satuan_indikator, p.id_proker, i.nama_indikator, i.cara_pengukuran');
		$this->db->FROM('direktori as d');
		$this->db->join('indikator as i','i.id_indikator = d.id_indikator');
		$this->db->join('proker as p','p.id_proker = i.id_proker');
		$this->db->where('d.JOBTITLE',$divisi);
		$this->db->where('i.id_proker','2');
		
		return $this->db->get();
	}

	// ambil data Penalty sesuai divisi
	public function get_target_penalty($c)
	{
		$this->db->select('*');
		$this->db->from('penalty_penetapan as pp');
		$this->db->join('indikator as i', 'i.id_indikator = pp.ID_INDIKATOR');
		$this->db->where($c);

		return $this->db->get();
	}

	// ambil data penalty sesuai triwulan
	public function get_target_penalty_tw($c)
	{
		$this->db->select('*');
		$this->db->from('penalty_realisasi as pr');
		$this->db->join('indikator as i', 'i.id_indikator = pr.ID_INDIKATOR');
		$this->db->where($c);

		return $this->db->get();
	}

	public function get_preview_target_utama($nipeg,$thn,$tw)
	{
		$this->db->SELECT('a.id_indikator,a.id_proker, a.nilai_ski, a.id_realisasi,a.target_pertahun,a.status, a.bobot,b.satuan_indikator, b.nama_indikator, b.nilai_maksimal,b.deliverable,b.cara_pengukuran, a.NIPEG, c.nama_proker, a.nilai_penetapan, a.realisasi, a.nilai_realisasi, a.total_realisasi, a.jenis_realisasi, a.tahun'); 
		$this->db->FROM ('realisasi_nilai as a ');
		$this->db->JOIN ('indikator as b',' a.id_indikator=b.id_indikator') ;
		$this->db->JOIN ('proker as c',' a.id_proker=c.id_proker ');
		$this->db->WHERE('a.NIPEG',$nipeg);
		$this->db->where('a.id_proker','1');
		$this->db->where('a.tahun',$thn);
		$this->db->where('jenis_realisasi',$tw);
		return $this->db->get();		
	}

	public function get_preview_target_sla($nipeg,$thn,$tw)
	{
		$this->db->SELECT('a.id_indikator,a.id_proker,a.nilai_ski,a.id_realisasi,a.target_pertahun,a.status, a.bobot,b.satuan_indikator, b.nama_indikator, b.nilai_maksimal,b.deliverable,b.cara_pengukuran, a.NIPEG, c.nama_proker, a.nilai_penetapan, a.realisasi, a.nilai_realisasi, a.total_realisasi, a.jenis_realisasi, a.tahun'); 
		$this->db->FROM ('realisasi_nilai as a');
		$this->db->JOIN ('indikator as b','a.id_indikator=b.id_indikator');
		$this->db->JOIN ('proker as c','a.id_proker=c.id_proker');
		$this->db->WHERE('a.NIPEG',$nipeg);
		$this->db->where('a.id_proker','2');
		$this->db->where('a.tahun',$thn);
		$this->db->where('jenis_realisasi',$tw);
		return $this->db->get();

	}
	//***********************************************************************************************//
	//*********************************  SIMPAN NILAI | SKI  ****************************************//
	//***********************************************************************************************//


	public function simpan_nilai($result)
	{
		return $this->db->insert_batch('nilai',$result);
	}

	//***********************************************************************************************//
	//*********************************  REALISASI NILAI | NILAI-SKI  *******************************//
	//***********************************************************************************************//

	public function realisasi_nilai($data)
	{
		return $this->db->insert_batch('realisasi_nilai', $data);
	}

	public function ubah_realisasi_nilai($data)
	{
		return $this->db->update_batch('realisasi_nilai', $data, 'id_realisasi');
	}

	/************************************************************************************************/

	public function update_status_ski($where, $data)
	{
		$this->db->update('role', $data, $where);
		
		return $this->db->affected_rows();
	}


	//***********************************************************************************************//
	//******************************  UBAH NILAI | SKI **********************************************//
	//***********************************************************************************************//

	public function get_ubah_nilai($data)
	{	  
		$this->db->update_batch('nilai',$data, 'id_nilai');
	}

	//***********************************************************************************************//
	//*********************************  U B A H - SKI  *********************************************//
	//***********************************************************************************************//
	
	public function get_data_karyawan_nilai($nipeg, $thn, $versi){
		$this->db->select('
		n.id_nilai,
		n.ATASAN_1,
		k.NIPEG,
		k.NAMA,
		k.JOBTITLE,
		k.DIVISI,
		k.PANGKAT,
		i.nama_indikator,
		i.cara_pengukuran');
		$this->db->from('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','n.id_indikator = i.id_indikator');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.versi',$versi);
		$this->db->group_by('n.NIPEG');
		
		return $this->db->get();
	}

	public function get_nama_karyawan_nilai($nipeg, $thn, $versi)
	{
		
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.versi',$versi);
		$this->db->limit(1);
		$this->db->select('n.id_nilai,k.NAMA, k.NIPEG, a.BUAT_SKI');
		$this->db->from('nilai as n');
		$this->db->join('role as a', 'a.NIPEG = n.NIPEG');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','n.id_indikator = i.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		return $this->db->get();
	}

	public function get_nama_karyawan_nilai_2($nipeg, $thn, $versi)
	{
		$this->db->select('n.id_nilai,k.NAMA, k.NIPEG, r.approve, r.buat_ski');
		$this->db->from('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','n.id_indikator = i.id_indikator');
		$this->db->join('proker as p','p.id_proker = i.id_proker');
		$this->db->join('role as r', 'r.NIPEG = k.NIPEG');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.versi',$versi);
		
		return $this->db->get();
	}

	public function get_target_utama_nilai($nipeg, $thn, $job, $versi)
	{
		$this->db->select('n.NIPEG, n.id_nilai,i.id_indikator,i.satuan_indikator,i.deliverable, p.id_proker,i.nama_indikator, i.cara_pengukuran,n.tw1,n.tw2,n.tw3,n.tw4, n.bobot, n.target_pertahun');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.H_JOBTITLE',$job);
		$this->db->where('n.versi',$versi);
		$this->db->where('n.id_proker','1');
		
		return $this->db->get();
	}

	public function get_target_utama_nilai_his($nipeg, $thn, $versi)
	{
		$this->db->select('n.NIPEG, n.id_nilai,i.id_indikator,i.satuan_indikator,i.deliverable, p.id_proker,i.nama_indikator, i.cara_pengukuran,n.tw1,n.tw2,n.tw3,n.tw4, n.bobot, n.target_pertahun');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.versi',$versi);
		$this->db->where('n.id_proker','1');
		
		return $this->db->get();
	}

	public function get_target_sla_nilai($nipeg, $thn, $job, $versi)
	{
		$this->db->select('n.NIPEG, n.id_nilai,i.id_indikator,i.satuan_indikator, i.deliverable,p.id_proker, i.nama_indikator, i.cara_pengukuran, n.tw1,n.tw2,n.tw3,n.tw4, n.bobot, n.target_pertahun');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.H_JOBTITLE',$job);
		$this->db->where('n.versi',$versi);
		$this->db->where('n.id_proker','2');
		
		return $this->db->get();
	}

	public function get_target_sla_nilai_his($nipeg, $thn, $versi)
	{
		$this->db->select('n.NIPEG, n.id_nilai,i.id_indikator,i.satuan_indikator, i.deliverable,p.id_proker, i.nama_indikator, i.cara_pengukuran, n.tw1,n.tw2,n.tw3,n.tw4, n.bobot, n.target_pertahun');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.versi',$versi);
		$this->db->where('n.id_proker','2');
		
		return $this->db->get();
	}


	//***********************************************************************************************//
	//*********************************  PENILAIAN - SKI  *******************************************//
	//***********************************************************************************************//

	public function get_data_status()
	{
		return $this->db->get('kondisi');
	}


	public function get_data_waktu($hasil)
	{
		/*SELECT r.nipeg, r.jenis_realisasi, k.TMT, k.TST, r.tahun FROM kondisi as k 
		join realisasi_nilai as r on r.jenis_realisasi = k.status_tw
		WHERE r.tahun = '2018' AND r.jenis_realisasi = 'TW2'*/
		$this->db->select('r.NIPEG, r.jenis_realisasi, k.TMT, k.TST, r.tahun, r.status');
		$this->db->from('kondisi as k');
		$this->db->join('realisasi_nilai as r', 'r.jenis_realisasi = k.status_tw');
		$this->db->where($hasil);

		return $this->db->count_all_results();
	}

	public function get_data_status_real($hasil)
	{
		/*SELECT r.nipeg, r.jenis_realisasi, k.TMT, k.TST, r.tahun FROM kondisi as k 
		join realisasi_nilai as r on r.jenis_realisasi = k.status_tw
		WHERE r.tahun = '2018' AND r.jenis_realisasi = 'TW2'*/
		$this->db->select('r.NIPEG, r.jenis_realisasi, k.TMT, k.TST, r.tahun, r.status');
		$this->db->from('kondisi as k');
		$this->db->join('realisasi_nilai as r', 'r.jenis_realisasi = k.status_tw');
		$this->db->where($hasil);

		return $this->db->get();
	}

	//***********************************************************************************************//
	//************************************  TW 1 - SKI  *********************************************//
	//***********************************************************************************************//

	public function get_target_utama_tw($nipeg, $thn,$versi)
	{
		$this->db->select(
			'n.NIPEG, n.id_nilai,i.id_indikator, p.id_proker,i.nama_indikator,i.satuan_indikator,n.target_pertahun, i.cara_pengukuran,n.tw1,n.tw2,n.tw3,n.tw4, n.bobot, i.nilai_maksimal');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.versi',$versi);
		$this->db->where('n.id_proker','1');
		
		return $this->db->get();
	}

	public function get_target_sla_tw($nipeg, $thn,$versi)
	{
		$this->db->select(
			'n.NIPEG, n.id_nilai,i.id_indikator, p.id_proker, i.nama_indikator,i.satuan_indikator,n.target_pertahun, i.cara_pengukuran,n.tw1,n.tw2,n.tw3,n.tw4, n.bobot, i.nilai_maksimal');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.versi',$versi);
		$this->db->where('n.id_proker','2');
		
		return $this->db->get();
	}

	public function ambil_status($nipeg,$thn,$tw)
	{
		$this->db->SELECT('a.id_indikator,a.id_proker, a.id_realisasi,a.target_pertahun,a.status, a.bobot,b.satuan_indikator, b.nama_indikator, b.nilai_maksimal, a.NIPEG, c.nama_proker, a.nilai_penetapan, a.realisasi, a.nilai_realisasi, a.total_realisasi, a.jenis_realisasi, a.tahun'); 
		$this->db->FROM ('realisasi_nilai as a ');
		$this->db->JOIN ('indikator as b',' a.id_indikator=b.id_indikator') ;
		$this->db->JOIN ('proker as c',' a.id_proker=c.id_proker ');
		$this->db->WHERE('a.NIPEG',$nipeg);
		$this->db->where('a.tahun',$thn);
		$this->db->where('jenis_realisasi',$tw);
		return $this->db->get();		
	}

	public function get_target_utama_triwulan($nipeg, $thn,$tw)
	{
		$this->db->select('n.id_nilai,i.id_indikator, p.id_proker,i.nama_indikator, i.cara_pengukuran,n.'.$tw.', n.bobot, i.nilai_maksimal');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.id_proker','1');
		
		return $this->db->get();
	}

	public function get_target_sla_triwulan($nipeg, $thn,$tw)
	{
		$this->db->select('n.id_nilai,i.id_indikator, p.id_proker, i.nama_indikator, i.cara_pengukuran, n.'.$tw.', n.bobot, i.nilai_maksimal');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.id_proker','2');
		
		return $this->db->get();
	}
	//***********************************************************************************************//
	//*******************************  MERUBAH STATUS TST - SKI  ************************************//
	//***********************************************************************************************//


	public function get_data_tst($id){
		$this->db->select('TST');
		$this->db->from('kondisi');
		$this->db->where('id_kondisi',$id);
		
		return $this->db->get();
	}

	public function waktu()
	{
		$data=$this->db->query("SELECT * FROM kondisi where id_kondisi='2' limit 1");
        foreach ($data->result_array() as $waktu) 
        {
        	$tanggal = mktime(date('m'), date("d"), date('Y'));
	    echo "Tanggal : <b> " . date("d-m-Y", $tanggal ) . "</b>";
	    date_default_timezone_set("Asia/Jakarta");
	    $jam = date ("H:i:s");
	    echo " | Pukul : <b> " . $jam . " " ." </b> ";
	    $a = time ("s");
	    if (($a>=6) && ($a<=11)) {
	        echo " <b>, Selamat Pagi !! </b>";
		    }else if(($a>=11) && ($a<=15)){
		        echo " , Selamat  Pagi !! ";
		    }elseif(($a>15) && ($a<=18)){
		        echo ", Selamat Siang !!";
		    }else{
		        echo ", <b> Selamat Malam </b>";
		    }
	        }
	}

	function cari_submited($nipeg){
		$this->db->select('*');
		$this->db->from('role');
		$this->db->where('NIPEG',$nipeg);
		
		return $this->db->get();
	}

	function cari_nama_mail($id){
		$this->db->where('NIPEG',$id);
		return $this->db->get('tb_karyawan');
	}

	function get_tahun_ski(){
		$this->db->select('tahun');
		$this->db->where('id_kondisi','1');
		return $this->db->get('kondisi');
	}

	function get_atasan($e){
	  $this->db->select("b.NAMA,b.NIPEG, a.approve_atasan1_datetime");
	  $this->db->distinct();
      $this->db->from("nilai as a");
      $this->db->join("tb_karyawan as b","a.ATASAN_1 = b.NIPEG");
      $this->db->where($e); 
	  return $this->db->get();
	}

	function get_atasan2($e){
	  $this->db->select("b.NAMA as N_ATASAN_2,c.NAMA as N_ATASAN_1,a.ATASAN_1,a.ATASAN_2, b.NIPEG, a.approve_atasan2_datetime, a.approve_atasan1_datetime");
	  $this->db->distinct();
      $this->db->from("realisasi_nilai as a");
      $this->db->join("tb_karyawan as b","a.ATASAN_2 = b.NIPEG");
      $this->db->join("tb_karyawan as c","a.ATASAN_1 = c.NIPEG");

      $this->db->where($e); 
	  return $this->db->get();
	}

	function get_atasan_langsung($atasan){
	  $this->db->select("NAMA, E_MAIL, NIPEG");
      $this->db->from("tb_karyawan");
      $this->db->where("NIPEG IN(SELECT NIPEG_UP FROM tb_karyawan WHERE NIPEG='$atasan')");   
      return $this->db->get();
	}


	//fungsi untuk mengambil jumlah atau count per tw untuk kondisi

	public function get_total_tw($nipeg, $thn,$tw)
	{		
		$nip = $nipeg;
		$th = $thn;
		$t = $tw;

		$this->db->select("
							a.total_realisasi,
							a.ATASAN_1,
							a.ATASAN_2,
							a.status
							"
							);
		$this->db->from("
							realisasi_nilai as a ,
							proker as b,
							indikator as c");

		$this->db->where("	 a.id_proker = b.id_proker
							 and a.id_indikator = c.id_indikator
							 and a.NIPEG = '$nip'
							 and a.tahun = '$th'
							 and a.jenis_realisasi = '$t'
						");		
		return $this->db->get();
	}


	//mengambil jumlah atau count

	public function get_jumlah_tw($nipeg, $thn,$tw)
	{		
		$nip = $nipeg;
		$th = $thn;
		$t = $tw;
		$this->db->select("
							a.total_realisasi,
							a.ATASAN_1,
							a.ATASAN_2
							"
							);
		$this->db->from("
							realisasi_nilai as a ,
							proker as b,
							indikator as c");

		$this->db->where("	 a.id_proker = b.id_proker
							 and a.id_indikator = c.id_indikator
							 and a.NIPEG = '$nip'
							 and a.tahun = '$th'
							 and a.jenis_realisasi = '$t'
						");		

		return $this->db->count_all_results();
	}
	//menggambil jumlah triwulan untuk chart pie

	public function get_jumlah_sudah_tw($tw,$thn,$divisi){

		/*SELECT * FROM tb_karyawan WHERE NIPEG  in (
			SELECT r.nipeg From realisasi_nilai as r join role as ro on r.NIPEG = ro.NIPEG WHERE ro.buat_ski = "SUDAH" and ro.approve = "SUDAH" AND r.jenis_realisasi = 'TW1' AND r.tahun = '2017'
			) AND divisi = 'Human Capital Management & Quality'*/
			// sub query

		$this->db->select('r.NIPEG')->from('realisasi_nilai as r');
		$this->db->join('role as ro','r.NIPEG = ro.NIPEG');
		
		$this->db->where('ro.buat_ski','SUDAH');	
		$this->db->where('ro.approve','SUDAH');
		$this->db->where('r.jenis_realisasi',$tw);	
		$this->db->where('r.tahun',$thn);

		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan as k');

		$this->db->where($divisi);
		$this->db->where("NIPEG IN ($sub)", NULL, FALSE);
		
		return $this->db->count_all_results();
		
	}
	public function get_jumlah_belum_tw($tw,$thn,$divisi){

		/*SELECT * FROM tb_karyawan WHERE NIPEG  in (
			SELECT r.nipeg From realisasi_nilai as r join role as ro on r.NIPEG = ro.NIPEG WHERE ro.buat_ski = "SUDAH" and ro.approve = "SUDAH" AND r.jenis_realisasi = 'TW1' AND r.tahun = '2017'
			) AND divisi = 'Human Capital Management & Quality'*/
			// sub query

		$this->db->select('r.NIPEG')->from('realisasi_nilai as r');
		$this->db->join('role as ro','r.NIPEG = ro.NIPEG');
		
		$this->db->where('ro.buat_ski','SUDAH');	
		$this->db->where('ro.approve','SUDAH');
		$this->db->where('r.jenis_realisasi',$tw);	
		$this->db->where('r.tahun',$thn);

		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan as k');
		$this->db->where($divisi);
		$this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);
		
		return $this->db->count_all_results();
		
	}
	//untuk status gambar ceklis dan silang 
	public function status_gambar_tw($nipeg,$tw,$thn){
		$this->db->from('realisasi_nilai');
		$this->db->where('NIPEG',$nipeg);
		$this->db->where('jenis_realisasi',$tw);
		$this->db->where('tahun',$thn);
		return $this->db->count_all_results();
	}
	// untuk jumlah field versi
	public function jumlah_penetapan_ski($nipeg,$thn){
		$this->db->SELECT("NIPEG");
		$this->db->FROM("nilai");
		$this->db->WHERE("NIPEG",$nipeg);
		$this->db->WHERE("tahun_insert",$thn);
		$this->db->group_by("versi");		
		return $this->db->count_all_results();
	}
}