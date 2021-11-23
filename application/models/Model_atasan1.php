<?php

class Model_atasan1 extends CI_Model
{

	public function get_data_karyawan_1($nipeg){ 
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

	public function get_data_jml_sdh_ski_divisi($id_divisi)
	{
		// sub query
		$this->db->select('n.NIPEG')->from('nilai as n');
		$this->db->join('tb_karyawan as k','k.NIPEG = n.NIPEG');
		$this->db->where($id_divisi);
		$this->db->where('n.tahun_insert', date('Y'));	 
		$sub = $this->db->get_compiled_select();

		// main query
		$this->db->from('tb_karyawan as k');
		$this->db->where($id_divisi);
		$this->db->where("NIPEG IN ($sub)", NULL, FALSE);
		
		return $this->db->count_all_results();
	}

	public function get_data_jml_blm_ski_divisi($id_divisi)
	{
		// sub query
		$this->db->select('n.NIPEG')->from('nilai as n');
		$this->db->join('tb_karyawan as k','k.NIPEG = n.NIPEG');
		$this->db->where($id_divisi);
		$this->db->where('n.tahun_insert', date('Y'));	 
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

	public function get_data_status()
	{
		return $this->db->get('kondisi');
	}

	public function get_data_tst($id){
		$this->db->select('TST');
		$this->db->from('kondisi');
		$this->db->where('id_kondisi',$id);
		
		return $this->db->get();
	}

	/*
		SELECT a.NAMA as Bawahan, b.NAMA as Atasan FROM `tb_karyawan`as a join tb_karyawan as b on a.NIPEG_UP = b.NIPEG WHERE a.NIPEG_UP = 'PP.9408011'
	*/

	public function tampil_bawahan_1($a)
	{
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->join('nilai as n', 'n.NIPEG = t.NIPEG');
		$this->db->where($a);
		$this->db->where('r.approve', 'BELUM');
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->group_by('n.NIPEG');

		return $this->db->get();
	}

	public function tampil_bawahan($a)
	{
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->join('nilai as n', 'n.NIPEG = r.NIPEG');
		$this->db->where($a);
		$this->db->where('r.approve', 'BELUM');
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->group_by('n.NIPEG');

		$d = $this->db->get();

		return $d->num_rows();
	}

	public function tampil_bawahan_sudah($a)
	{
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->join('nilai as n', 'n.NIPEG = r.NIPEG');
		$this->db->where($a);
		$this->db->where('r.approve', 'SUDAH');
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->group_by('n.NIPEG');

		return $this->db->get();	
	}

	public function tampil_bawahan_sudah_1($a)
	{
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->join('nilai as n', 'n.NIPEG = r.NIPEG');
		$this->db->where($a);
		$this->db->where('r.approve', 'SUDAH');
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->group_by('n.NIPEG');

		$d = $this->db->get();

		return $d->num_rows();	
	}

	/********************************************************************************************************/
	/*																										*/
	/*								Menampilkan Data yang belum submit SKI									*/	
	/*																										*/
	/********************************************************************************************************/

	public function tampil_bawahan_blm_ski($e,$nipeg)
	{
		// Sub Query
		$this->db->select('r.NIPEG');
		$this->db->from('role as r');
		$this->db->where('r.buat_ski', 'BELUM');
		$this->db->where($e);
		$sub = $this->db->get_compiled_select();

		// Main Query
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->where('NIPEG_UP',$nipeg);
		$this->db->where("NIPEG IN ($sub)", NULL, FALSE);
		
		return $this->db->get();
	}

	public function tampil_bawahan_blm_ski_h($e,$nipeg)
	{
		// Sub Query
		$this->db->select('r.NIPEG');
		$this->db->from('role as r');
		$this->db->where('r.buat_ski', 'BELUM');
		$this->db->where($e);
		$sub = $this->db->get_compiled_select();

		// Main Query
		$this->db->select('t.NIPEG, NAMA, JOBTITLE, BAGIAN, DIVISI, NIPEG_UP');
		$this->db->from('tb_karyawan as t');
		$this->db->where('NIPEG_UP',$nipeg);
		$this->db->where("NIPEG IN ($sub)", NULL, FALSE);
		
		$d = $this->db->get();

		return $d->num_rows();
	}

	/********************************************************************************************************/
	/*																										*/
	/*								Akhir Menampilkan Data yang belum submit SKI							*/	
	/*																										*/
	/********************************************************************************************************/

	/********************************************************************************************************/
	/*																										*/
	/*										APPROVE NILAI --- ATASAN 1										*/	
	/*																										*/
	/********************************************************************************************************/

	/*
		SELECT tb_karyawan.NIPEG, NAMA, DIVISI, JOBTITLE FROM `role`
		JOIN tb_karyawan ON tb_karyawan.NIPEG = role.NIPEG
		JOIN realisasi_nilai ON realisasi_nilai.NIPEG = role.NIPEG
		WHERE realisasi_nilai.jenis_realisasi = 'TW1'
		AND
		tb_karyawan.NIPEG_UP = 'PP.9408011'
		AND
		realisasi_nilai.tahun = '2018'
		AND
		role.buat_ski = 'SUDAH' AND role.approve = 'SUDAH'
		GROUP BY realisasi_nilai.NIPEG
	*/

	public function tampil_belum_nilai_bawahan($b)
	{
		$this->db->select('tb.NIPEG, NAMA,BAGIAN, DIVISI, JOBTITLE');
		$this->db->from('role as r');
		$this->db->join('tb_karyawan as tb', 'tb.NIPEG = r.NIPEG');
		$this->db->join('realisasi_nilai as rn', 'rn.NIPEG = r.NIPEG');
		$this->db->where($b);
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->where('r.approve', 'SUDAH');
		$this->db->group_by('rn.NIPEG');

		return $this->db->get();

	}

	public function tampil_belum_nilai_bawahan_h($b)
	{
		$this->db->select('tb.NIPEG, NAMA,BAGIAN, DIVISI, JOBTITLE');
		$this->db->from('role as r');
		$this->db->join('tb_karyawan as tb', 'tb.NIPEG = r.NIPEG');
		$this->db->join('realisasi_nilai as rn', 'rn.NIPEG = r.NIPEG');
		$this->db->where($b);
		$this->db->where('r.buat_ski', 'SUDAH')->where('r.approve', 'SUDAH');
		$this->db->group_by('rn.NIPEG');

		$n = $this->db->get();

		return $n->num_rows();

	}

	/*
		SELECT NIPEG, NAMA FROM tb_karyawan WHERE tb_karyawan.NIPEG_UP = 'PP.9408011' AND NIPEG NOT IN (SELECT realisasi_nilai.NIPEG FROM realisasi_nilai JOIN role ON role.NIPEG = realisasi_nilai.NIPEG WHERE realisasi_nilai.jenis_realisasi = 'TW1' AND realisasi_nilai.tahun ='2018' AND role.buat_ski = 'SUDAH' AND role.approve = 'SUDAH')
	*/

	public function tampil_belum_submit_nilai($d,$nipeg)
	{
		// SUB QUERY
		$this->db->select('rn.NIPEG');
		$this->db->from('realisasi_nilai as rn');
		$this->db->join('role', 'role.NIPEG = rn.NIPEG');
		$this->db->where($d);
		$sub = $this->db->get_compiled_select();

		// MAIN QUERY
		$this->db->select('NIPEG, NAMA, BAGIAN, DIVISI, JOBTITLE');
		$this->db->from('tb_karyawan');
		$this->db->where('NIPEG_UP',$nipeg);
		$this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);

		return $this->db->get();

	}

	public function tampil_belum_submit_nilai_h($d,$nipeg)
	{
		// SUB QUERY
		$this->db->select('rn.NIPEG');
		$this->db->from('realisasi_nilai as rn');
		$this->db->join('role', 'role.NIPEG = rn.NIPEG');
		$this->db->where($d);
		$sub = $this->db->get_compiled_select();

		// MAIN QUERY
		$this->db->select('NIPEG, NAMA, BAGIAN, DIVISI, JOBTITLE');
		$this->db->from('tb_karyawan');
		$this->db->where('NIPEG_UP',$nipeg);
		$this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);

		$n = $this->db->get();

		return $n->num_rows();

	}

	public function tampil_sudah_nilai_bawahan($c)
	{
		$this->db->select('tb.NIPEG, NAMA,BAGIAN, DIVISI, JOBTITLE');
		$this->db->from('role as r');
		$this->db->join('tb_karyawan as tb', 'tb.NIPEG = r.NIPEG');
		$this->db->join('realisasi_nilai as rn', 'rn.NIPEG = r.NIPEG');
		$this->db->where($c);
		$this->db->where('r.buat_ski', 'SUDAH');
		$this->db->where('r.approve', 'SUDAH');
		$this->db->group_by('rn.NIPEG');

		return $this->db->get();

	}

	public function tampil_sudah_nilai_bawahan_h($c)
	{
		$this->db->select('tb.NIPEG, NAMA,BAGIAN, DIVISI, JOBTITLE');
		$this->db->from('role as r');
		$this->db->join('tb_karyawan as tb', 'tb.NIPEG = r.NIPEG');
		$this->db->join('realisasi_nilai as rn', 'rn.NIPEG = r.NIPEG');
		$this->db->where($c);
		$this->db->where('r.buat_ski', 'SUDAH')->where('r.approve', 'SUDAH');
		$this->db->group_by('rn.NIPEG');

		$n = $this->db->get();

		return $n->num_rows();

	}



	/*
	Query Mencari atasan 2 
		SELECT nama ,divisi,nipeg,nipeg_up, jobtitle FROM tb_karyawan WHERE NIPEG  in (SELECT nipeg_up FROM tb_karyawan WHERE NIPEG  in (SELECT nipeg_up FROM tb_karyawan WHERE NIPEG    = 'PP.9306015'))
	*/


	public function get_data_karyawan_nilai($nipeg, $thn){
		$this->db->select('
		n.id_nilai,
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
		$this->db->group_by('n.NIPEG');
		
		return $this->db->get();
	}

	public function get_nama_karyawan_nilai($param_nipeg, $thn)
	{
		$this->db->select('n.id_nilai,k.NAMA, k.NIPEG, r.approve');
		$this->db->from('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','n.id_indikator = i.id_indikator');
		$this->db->join('proker as p','p.id_proker = i.id_proker');
		$this->db->join('role as r', 'r.NIPEG = k.NIPEG');
		$this->db->where('n.NIPEG',$param_nipeg);
		$this->db->where('n.tahun_insert',$thn);
		
		return $this->db->get();
	}

	public function get_nama_karyawan_nilai_2($a)
	{
		$this->db->select('t.NIPEG, t.NAMA, t.JOBTITLE, t.BAGIAN, t.DIVISI, t.NIPEG_UP, r.buat_ski, r.approve');
		$this->db->from('tb_karyawan as t');
		$this->db->join('role as r', 'r.NIPEG = t.NIPEG');
		$this->db->where($a);
		
		return $this->db->get();
	}

	public function get_target_utama_nilai($nipeg, $thn)
	{
		$this->db->select('n.NIPEG, n.id_nilai,n.target_pertahun,i.id_indikator, p.id_proker,i.nama_indikator,i.satuan_indikator, i.cara_pengukuran,n.tw1,n.tw2,n.tw3,n.tw4, n.bobot');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.id_proker','1');
		
		return $this->db->get();
	}

	public function get_target_utama($e)
	{
		$this->db->select('*');
		$this->db->from('realisasi_nilai as rn');
		$this->db->join('indikator as i', 'i.id_indikator = rn.id_indikator');
		$this->db->join('role as r', 'r.NIPEG = rn.NIPEG');
		$this->db->where($e);
		$this->db->where('rn.id_proker', '1');
		
		return $this->db->get();
	}

	public function get_data($e)
	{
		$this->db->select('*');
		$this->db->from('realisasi_nilai as rn');
		$this->db->join('indikator as i', 'i.id_indikator = rn.id_indikator');
		$this->db->join('role as r', 'r.NIPEG = rn.NIPEG');
		$this->db->where($e);
		
		return $this->db->get();
	}

	public function get_target_sla($e)
	{
		$this->db->select('*');
		$this->db->from('realisasi_nilai as rn');
		$this->db->join('indikator as i', 'i.id_indikator = rn.id_indikator');
		$this->db->where($e);
		$this->db->where('rn.id_proker', '2');
		
		return $this->db->get();
	}

	public function get_target_sla_nilai($nipeg, $thn)
	{
		$this->db->select('n.NIPEG, n.id_nilai,i.id_indikator, n.target_pertahun,p.id_proker, i.nama_indikator,i.satuan_indikator, i.cara_pengukuran, n.tw1,n.tw2,n.tw3,n.tw4, n.bobot');
		$this->db->FROM('nilai as n');
		$this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
		$this->db->join('indikator as i','i.id_indikator = n.id_indikator');
		$this->db->join('proker as p','p.id_proker = n.id_proker');
		$this->db->where('n.NIPEG',$nipeg);
		$this->db->where('n.tahun_insert',$thn);
		$this->db->where('n.id_proker','2');
		
		return $this->db->get();
	}

	public function update_approve_ski($where, $data)
	{
		$this->db->update('role', $data, $where);
		
		return $this->db->affected_rows();
	}

	public function get_ubah_nilai_real($data)
	{
		return $this->db->update_batch('realisasi_nilai', $data, 'id_realisasi');
	}

	public function update_approve_ski_nilai($where, $data)
	{
		$this->db->update('nilai', $data, $where);
		
		return $this->db->affected_rows();
	}

	public function update_tgl_approve($e,$updt){
		$this->db->update('realisasi_nilai', $updt, $e);
		
		return $this->db->affected_rows();
	}

}