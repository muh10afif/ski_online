<?php

class Model_master extends CI_Model
{
	
	function tampilkan_data_karyawan()
	{
		$sql = 
		"SELECT 
		k.nip_karyawan, 
		k.nama_karyawan,
		p.nama_pangkat,
		j.nama_jabatan,
		k.status,
		k.buat_ski,
		k.approve 
		FROM karyawan as k, jabatan as j, pangkat as p
		WHERE k.id_jabatan = j.id_jabatan and k.id_pangkat = p.id_pangkat";

		return $this->db->query($sql);
	}

	function tampilkan_data_jabatan()
	{
		$sql = 
		"SELECT
		j.nama_jabatan,
		d.nama_divisi
		FROM jabatan as j, divisi as d
		WHERE j.id_divisi = d.id_divisi";

		return $this->db->query($sql);
	}

	function tampilkan_data_divisi()
	{
		return $this->db->query("SELECT * FROM divisi");
	}

	function tampilkan_data_indikator()
	{
		$sql = 
		"SELECT
		i.nama_indikator,
		p.nama_proker,
		i.satuan_indikator,
		i.cara_pengukuran,
		i.deliverable
		FROM indikator as i, proker as p
		WHERE i.id_proker = p.id_proker";

		return $this->db->query($sql);
	}

}