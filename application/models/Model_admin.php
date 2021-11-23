<?php

Class Model_admin extends CI_Model {

	public function get_ubah_triwulan($data, $id)
	{
		$this->db->where('id_kondisi', $id);
		$this->db->update('kondisi',$data);
	}

	public function ubah_pembukaan_ski($data, $id)
	{
		$this->db->where('id_kondisi', $id);
		$this->db->update('kondisi',$data);
	}

	public function kondsatu()
	{
		$this->db->where('id_kondisi', '1');
		return $this->db->get('kondisi');
	}

	public function konddua()
	{
		$this->db->where('id_kondisi', '2');
		return $this->db->get('kondisi');
	}

	public function tampil_status()
	{
		return $this->db->get('kondisi');
	}

	public function get_tahun_realisasi(){
		$this->db->select('tahun');
		$this->db->from('realisasi_nilai');
		$this->db->group_by('tahun');
		return $this->db->get();
	}

}