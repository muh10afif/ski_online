
<?php

class Model_dashboard_karyawan extends CI_Model
{


	public function jml_karyawan(){		
		return $this->db->count_all('tb_karyawan where NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ="")');	
	}


	public function jml_divisi(){
		$this->db->select('DIVISI');
		$this->db->from('tb_karyawan');
		$this->db->group_by('DIVISI');
		return $this->db->get();
	}
	 
	 public function jml_sdh_ski_penetapan($tahun_insert){

 		$this->db->select('NIPEG');
 		$this->db->from('nilai');
		$this->db->where($tahun_insert); 
		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan');
		$this->db->where("NIPEG  IN ($sub)", NULL, FALSE);
		$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
		 return $this->db->count_all_results();
	 }


	 public function jml_blm_ski_penetapan($tahun_insert){

	 		$this->db->select('NIPEG');
	 		$this->db->from('nilai');
			$this->db->where($tahun_insert); 
			$sub = $this->db->get_compiled_select();

			// main query
			$this->db->from('tb_karyawan');
			$this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);
			$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
			 return $this->db->count_all_results();
	 }

	 public function thn_kondisi(){
	 	$this->db->from('kondisi');
	 	return $this->db->get();
	 }

	 public function get_divisi(){
	 	$this->db->select('DIVISI');
	 	$this->db->from('tb_karyawan'); 	
	 	$this->db->group_by('DIVISI');
	 	return $this->db->get();
	 }

 	
 	public function get_karyawan_sdh_perdivisi($tahun_insert,$divisi){		 	
	 	//SELECT NAMA, DIVISI FROM tb_karyawan WHERE nipeg in (SELECT nipeg FROM nilai WHERE tahun_insert = '2018') AND divisi = 'PENGEMBANGAN BISNIS DAN PRODUK'
	 		
	 		$this->db->select('NIPEG');
	 		$this->db->from('nilai');
			$this->db->where($tahun_insert); 
			$sub = $this->db->get_compiled_select();

			// main query
			$this->db->from('tb_karyawan');
			$this->db->where("NIPEG IN ($sub)", NULL, FALSE);
			$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
			$this->db->like($divisi);
			return $this->db->get();
	 }
	
	public function get_karyawan_blm_perdivisi($tahun_insert,$divisi){		 	
	 	//SELECT NAMA, DIVISI FROM tb_karyawan WHERE nipeg in (SELECT nipeg FROM nilai WHERE tahun_insert = '2018') AND divisi = 'PENGEMBANGAN BISNIS DAN PRODUK'
	 		
	 		$this->db->select('NIPEG');
	 		$this->db->from('nilai');
			$this->db->where($tahun_insert); 
			$sub = $this->db->get_compiled_select();

			// main query
			$this->db->from('tb_karyawan');
			$this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);
			$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
			$this->db->like($divisi);
			return $this->db->get();
	 }




	 //*********************** BAGIAN UNTUK MENGAMBIL JUMLAH DATANYA*********************//
	 //BAGIAN SBU DEFANSE
	public function jml_sdh_ski_dds($tahun_insert,$divisi){

	 		$this->db->select('NIPEG');
	 		$this->db->from('nilai');
			$this->db->where('tahun_insert',$tahun_insert); 
			$sub = $this->db->get_compiled_select();

			// main query
			$this->db->from('tb_karyawan');
			$this->db->where("NIPEG  IN ($sub)", NULL, FALSE);	
			$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);	
			$this->db->where('DIVISI',$divisi); 
			 return $this->db->count_all_results();
	 }
	
	 public function jml_blm_ski_dds($tahun_insert,$divisi){

	 		$this->db->select('NIPEG');
	 		$this->db->from('nilai');
			$this->db->where('tahun_insert',$tahun_insert); 
			$sub = $this->db->get_compiled_select();

			// main query
			$this->db->from('tb_karyawan');
			$this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);	
			$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);	
			$this->db->where('DIVISI',$divisi); 
			 return $this->db->count_all_results();
	 }

	 public function jml_sdh_ski_penilaian_approve1($divisi,$tw){
	 		$this->db->select('a.NIPEG');
	 		$this->db->from('role as a');	 		
			$this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG'); 
			$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
			$this->db->where('b.DIVISI',$divisi); 
			$this->db->where('a.APPROVE_'.$tw,'ATASAN1');
		return $this->db->count_all_results();
	 }
	
	 public function jml_blm_ski_penilaian($tahun_insert,$divisi,$tw){
 		$this->db->select('NIPEG');
 		$this->db->from('realisasi_nilai');
		$this->db->where('jenis_realisasi',$tw); 
		$this->db->where('tahun',$tahun_insert);
		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan');
		$this->db->where("NIPEG NOT IN ($sub)");
		$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);		
		$this->db->where('DIVISI',$divisi); 
		return $this->db->count_all_results();
 }

	 public function jml_sdh_ski_penilaian($tahun_insert,$divisi,$tw){
 		$this->db->select('NIPEG');
 		$this->db->from('realisasi_nilai');
		$this->db->where('jenis_realisasi',$tw); 
		$this->db->where('tahun',$tahun_insert);
		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan');
		$this->db->where("NIPEG IN ($sub)");
		$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);		
		$this->db->where('DIVISI',$divisi); 
		return $this->db->count_all_results();
	 }
	
	 public function jml_sdh_ski_penilaian_approve2($divisi,$tw){
 		$this->db->select('a.NIPEG');
 		$this->db->from('role as a');			
 		$this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG'); 
		$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
		$this->db->where('b.DIVISI',$divisi); 
		$this->db->where('a.APPROVE_'.$tw,'ATASAN2'); 
		return $this->db->count_all_results();
	 }

	public function jml_sdh_approve_ski($tahun_insert)
	{
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->join('nilai as n', 'n.NIPEG = t.NIPEG');
		$this->db->where($tahun_insert);
		$this->db->where("t.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
		$this->db->where('r.approve', 'SUDAH');
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->group_by('n.NIPEG');

		return $this->db->count_all_results();
	}

	public function jml_blm_approve_ski($tahun_insert)
	{
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->join('nilai as n', 'n.NIPEG = t.NIPEG');
		$this->db->where($tahun_insert);
		$this->db->where('r.approve', 'BELUM');
		$this->db->where("t.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->group_by('n.NIPEG');

		return $this->db->count_all_results();
	}

	public function hitung_sudah_penilaian_tw($e)
	{
		$this->db->select('b.NAMA, a.NIPEG');
	    $this->db->where($e);
	    $this->db->from('realisasi_nilai as a');
	    $this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG');
		$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
	    $this->db->distinct();
	    return $this->db->count_all_results();
	}

	public function hitung_approve1($tw)
	{
		$this->db->select('b.NAMA, a.NIPEG');
	    $this->db->where('APPROVE_'.$tw,'ATASAN1');
	    $this->db->from('role as a');
	    $this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG');
		$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
	    $this->db->distinct();
	    return $this->db->count_all_results();
	}

	public function hitung_approve2($tw)
	{
		$this->db->select('b.NAMA, a.NIPEG');
	    $this->db->where('APPROVE_'.$tw,'ATASAN2');
	    $this->db->from('role as a');
	    $this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG');
		$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
	    $this->db->distinct();
	    return $this->db->count_all_results();
	}

	public function sdh_approve_ski($divisi)
	{
		$this->db->select('t.NIPEG, t.NAMA, t.JOBTITLE, t.BAGIAN, t.DIVISI');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->where('r.approve', 'SUDAH');
		$this->db->where("t.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
		$this->db->like('t.DIVISI',$divisi);
		return $this->db->get();
	}

	public function blm_approve_ski($divisi)
	{
		$this->db->select('t.NIPEG, t.NAMA, t.JOBTITLE, t.BAGIAN, t.DIVISI');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->where('r.approve', 'BELUM');
		$this->db->where("t.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
		$this->db->like('t.DIVISI',$divisi);
		return $this->db->get();
	}

	public function sudah_penilaian_tw($e,$div)
	{
		$this->db->select('b.NIPEG, b.NAMA, b.JOBTITLE, b.BAGIAN, b.DIVISI');
	    $this->db->like('b.DIVISI',$div);
	    $this->db->where($e);
	    $this->db->from('realisasi_nilai as a');
	    $this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG');
		$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
	    $this->db->distinct();
	    return $this->db->get();
	}

	public function belum_penilaian_tw($thn,$tw,$div)
	{
		return $this->db->query('SELECT NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI from tb_karyawan WHERE NIPEG NOT IN (SELECT NIPEG FROM realisasi_nilai WHERE tahun="'.$thn.'" and jenis_realisasi="'.$tw.'")and NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ="") and DIVISI like "%'.$div.'%"');
	}

	public function approve1($tw,$div,$atasan)
	{
		$this->db->select('b.NIPEG, b.NAMA, b.JOBTITLE, b.BAGIAN, b.DIVISI');
	    $this->db->like('b.DIVISI',$div);
	    $this->db->where('approve_'.$tw,$atasan);
		$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
	    $this->db->from('role as a');
	    $this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG');
	    return $this->db->get();
	}

	public function belum_approve1($tw,$div,$atasan)
	{
		$this->db->select('b.NIPEG, b.NAMA, b.JOBTITLE, b.BAGIAN, b.DIVISI');
	    $this->db->like('b.DIVISI',$div);
	    $this->db->where('approve_'.$tw,$atasan);
		$this->db->where("b.NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
	    $this->db->from('role as a');
	    $this->db->join('tb_karyawan as b','a.NIPEG=b.NIPEG');
	    return $this->db->get();
	}

	public function chart_list()
	{
		$this->db->select('DIVISI');
    	$this->db->from('tb_karyawan');
    	$this->db->where_not_in('DIVISI','');
		$this->db->where("NIPEG  IN (SELECT NIPEG FROM ROLE WHERE STATUS_KARYAWAN ='')", NULL, FALSE);
    	$this->db->distinct();
    	return $this->db->get();
	}
}
