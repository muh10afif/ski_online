<?php

Class Model_master_penalty extends CI_Model
{
	/********************************************************************************************************/
	/*																										*/
	/*									SERVER SIDE TABLE PENALTY 											*/	
	/*																										*/
	/********************************************************************************************************/

	var $column_order 	= array('i.id_indikator', 'i.nama_indikator', 'p.nama_proker', 'i.satuan_indikator', 'i.cara_pengukuran'); 
    var $column_search 	= array('i.id_indikator', 'i.nama_indikator', 'p.nama_proker', 'i.satuan_indikator', 'i.cara_pengukuran');
    var $order 			= array('i.id_indikator' => 'asc'); 


	private function _get_datatables_query($divisi)
    {         
      	$this->db->SELECT('i.id_indikator, i.nama_indikator, p.nama_proker, i.satuan_indikator, i.cara_pengukuran');
		$this->db->from('indikator as i');
		$this->db->join('proker as p', 'p.id_proker = i.id_proker');
		$this->db->where('i.divisi', $divisi);

        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($divisi)
    {
        $this->_get_datatables_query($divisi);

	        if($_POST['length'] != -1)

	        $this->db->limit($_POST['length'], $_POST['start']);

	        $query = $this->db->get();

        return $query->result();
    }
 
    function count_filtered($divisi)
    {
        $this->_get_datatables_query($divisi);

        	$query = $this->db->get();

        return $query->num_rows();
    }
 
    public function count_all($divisi)
    {			
		$this->db->SELECT('i.id_indikator, i.nama_indikator, p.nama_proker, i.satuan_indikator, i.cara_pengukuran');
		$this->db->from('indikator as i');
		$this->db->join('proker as p', 'p.id_proker = i.id_proker');
		$this->db->where('i.divisi', $divisi);

        return $this->db->count_all_results();
    }

    /********************************************************************************************************/
	/*																										*/
	/*								AKHIR SERVER SIDE TABLE PENALTY 										*/	
	/*																										*/
	/********************************************************************************************************/

	public function cari_indikator($where)
	{
		$this->db->from('indikator');
		$this->db->where($where);

		$n = $this->db->get();

		return $n->num_rows();
	}

	public function get_by_id_indikator_pen_div($id){
		$this->db->from('indikator');
		$this->db->where('id_indikator',$id);
		$query = $this->db->get();
 
		return $query->row();
	}

	public function ubah_data_indikator_pen_div($where, $data){

		$this->db->update('indikator', $data, $where);

		return $this->db->affected_rows();
	}

	public function delete_penalty_div($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}


	// Simpan data indikator divisi
	public function simpan_indikator_div($data)
	{
		$this->db->insert('indikator', $data);
	}

	// Mengambil indikator hanya target penalty
	public function get_data_indikator()
	{
		$this->db->select('nama_indikator');
		$this->db->distinct();
		$this->db->from('indikator');
		$this->db->join('proker', 'proker.id_proker = indikator.id_proker');
		$this->db->where('indikator.id_proker', 3);

		return $this->db->get();
	}

	// Mengambil indikator hanya target penalty
	public function get_indikator_div($nama_indikator)
	{
		$this->db->select('*');
		$this->db->from('indikator');
		$this->db->join('proker', 'proker.id_proker = indikator.id_proker');
		$this->db->where('indikator.nama_indikator', $nama_indikator);

		return $this->db->get();
	}

	// Mengambil penalty divisi
    public function get_data_penalty_divisi($divisi)
    {
    	$this->db->SELECT('i.id_indikator, i.nama_indikator, p.nama_proker, i.satuan_indikator, i.cara_pengukuran');
		$this->db->from('indikator as i');
		$this->db->join('proker as p', 'p.id_proker = i.id_proker');
		$this->db->where('i.divisi', $divisi);

		return $this->db->get();
    }

	// Mengambil data divisi yang belum pada indikator
	public function get_divisi_blm()
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan');
		$this->db->where_not_in('DIVISI', '');
		$this->db->where("DIVISI NOT IN (SELECT i.divisi from indikator as i)", NULL, FALSE);

		return $this->db->get();
	}

	public function get_divisi_blm_h()
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan');
		$this->db->where_not_in('DIVISI', '');
		$this->db->where("DIVISI NOT IN (SELECT i.divisi from indikator as i)", NULL, FALSE);

		$n = $this->db->get();

		return $n->num_rows();
	}

	// Mengambil data divisi yang sudah pada indikator
	public function get_divisi_sdh()
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan');
		$this->db->where_not_in('DIVISI', '');
		$this->db->where("DIVISI IN (SELECT i.divisi from indikator as i)", NULL, FALSE);

		return $this->db->get();
	}

	public function get_divisi_sdh_h()
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan');
		$this->db->where_not_in('DIVISI', '');
		$this->db->where("DIVISI IN (SELECT i.divisi from indikator as i)", NULL, FALSE);

		$n = $this->db->get();

		return $n->num_rows();
	}

	// Mengambil data divisi
	public function get_data_divisi()
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan');
		$this->db->where('DIVISI IS NOT NULL');
		$this->db->where('DIVISI !=', '');
		$this->db->order_by('DIVISI', 'ASC');

		return $this->db->get();
	}

	// Mengambil data target Penalty
	public function get_nama_penalty($divisi)
	{
		$this->db->select('*');
		$this->db->from('indikator');
		$this->db->where('id_proker', '3');
		$this->db->where('divisi', $divisi);

		return $this->db->get();
	}

	// simpan nilai penetapan Penalty
	public function simpan_penetapan($data)
	{
		$this->db->insert_batch('penalty_penetapan', $data);

		return $this->db->affected_rows();
	}

	// simpan ubah nilai penetapan Penalty
	public function simpan_ubah_penetapan($data)
	{
		$this->db->update_batch('penalty_penetapan', $data, 'ID_PENALTY_P');

		return $this->db->affected_rows();
	}

	// Mengambil data Penalty Penetapan
	public function get_data_penalty_pen($d)
	{
		$table	= 'penalty_penetapan as p';

		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('indikator as i', 'i.id_indikator = p.ID_INDIKATOR');
		$this->db->where($d);

		return $this->db->get();
	}

	public function get_data_penalty_nilai($e)
	{
		$table	= 'penalty_realisasi as pr';

		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('indikator as i', 'i.id_indikator = pr.ID_INDIKATOR');
		$this->db->where($e);

		return $this->db->get();
	}

	// Mengambil data penalty penetapan sesuai STATUS = SIMPAN
	public function get_data_penalty_penetapan($kondisi)
	{
		$this->db->select('*');
		$this->db->from('penalty_penetapan as p');
		$this->db->join('indikator as i', 'i.id_indikator = p.ID_INDIKATOR');
		$this->db->where($kondisi);

		return $this->db->get();
	}

	// Simpan nilai realisasi Penalty
	public function simpan_realisasi($data)
	{
		$this->db->insert_batch('penalty_realisasi', $data);
	}

	// Simpan ubah nilai realisasi Penalty
	public function simpan_ubah_realisasi($data)
	{
		$this->db->update_batch('penalty_realisasi', $data, 'ID_PENALTY_R');
		return $this->db->affected_rows();
	}

	// Mengambil data Divisi pada tabel Penalty Penetapan
	public function get_data_divisi_penalty($thn)
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('penalty_penetapan');
		$this->db->where('TAHUN_INSERT', $thn);

		return $this->db->get();
	}

	// Cari divisi pada tabel penalty Penetapan
	public function cari_divisi_penetapan($DIVISI, $thn)
	{
		$this->db->select('*');
		$this->db->from('penalty_penetapan');
		$this->db->where('DIVISI', $DIVISI);
		$this->db->where('TAHUN_INSERT', $thn);

		$n = $this->db->get();

		return $n->num_rows();
	}

	// Cari divisi pada tabel penalty Penetapan
	public function cari_divisi_penetapan_2($DIVISI, $thn)
	{
		$this->db->select('DIVISI, STATUS');
		$this->db->from('penalty_penetapan');
		$this->db->where('DIVISI', $DIVISI);
		$this->db->where('TAHUN_INSERT', $thn);

		return $this->db->get();
	}

	// Cari divisi pada tabel penalty Penetapan
	public function cari_divisi_penetapan_3($DIVISI, $thn)
	{
		$this->db->select('DIVISI, STATUS');
		$this->db->from('penalty_penetapan');
		$this->db->where('DIVISI', $DIVISI);
		$this->db->where('TAHUN_INSERT', $thn);
		$this->db->where('STATUS', 'KIRIM');
		$this->db->distinct();

		return $this->db->get();
	}

	// Cari divisi pada tabel penalty Penilaian
	public function cari_divisi_penilaian($DIVISI, $thn)
	{
		$this->db->select('*');
		$this->db->from('penalty_realisasi');
		$this->db->where('DIVISI', $DIVISI);
		$this->db->where('TAHUN', $thn);

		$n = $this->db->get();

		return $n->num_rows();
	}

	// Cari divisi pada tabel penalty Penilaian
	public function cari_divisi_penilaian_2($DIVISI, $thn)
	{
		$this->db->select('DIVISI, STATUS, JENIS_REALISASI');
		$this->db->from('penalty_realisasi');
		$this->db->where('DIVISI', $DIVISI);
		$this->db->where('TAHUN', $thn);

		return $this->db->get();
	}

	// cari divisi belum penetapan dengan status simpan atau tidak ada pd tbel penetapan penalty
	public function cari_divisi_blm_penetapan($tahun)
	{
		// sub query
		$this->db->select('DIVISI');
		$this->db->from('penalty_penetapan');
		$this->db->where('TAHUN_INSERT', $tahun);
		$sub = $this->db->get_compiled_select();
		// main query
		$this->db->select('k.DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan as k');
		$this->db->where('DIVISI !=', '');
		$this->db->where("DIVISI NOT IN ($sub)", NULL, FALSE);

		return $this->db->get();
	}

	//  return num_rows untuk belum buat penalty penetapan SKI
	public function cari_divisi_blm_penetapan_h($tahun)
	{
		// sub query
		$this->db->select('DIVISI');
		$this->db->from('penalty_penetapan');
		$this->db->where('TAHUN_INSERT', $tahun);
		$sub = $this->db->get_compiled_select();
		// main query
		$this->db->select('k.DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan as k');
		$this->db->where('DIVISI !=', '');
		$this->db->where("DIVISI NOT IN ($sub)", NULL, FALSE);

		$n = $this->db->get();

		return $n->num_rows();
	}

	// cari divisi ubah data penetapan dengan status simpan
	public function cari_divisi_ubah_submit_penetapan($a,$tahun)
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('penalty_penetapan');
		$this->db->where('TAHUN_INSERT', $tahun);
		$this->db->where($a);

		return $this->db->get();
	}

	//  return num_rows untuk ubah penalty penetapan SKI
	public function cari_divisi_ubah_submit_penetapan_h($a,$tahun)
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('penalty_penetapan');
		$this->db->where('TAHUN_INSERT', $tahun);
		$this->db->where($a);
		$n = $this->db->get();

		return $n->num_rows();
	}

	// cari divisi belum penilaian dengan status simpan atau tidak ada pd tbel penetapan penalty
	public function cari_divisi_blm_penilaian($c)
	{
		// sub query
		$this->db->select('DIVISI');
		$this->db->from('penalty_realisasi');
		$this->db->where($c);
		$sub = $this->db->get_compiled_select();
		// main query
		$this->db->select('k.DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan as k');
		$this->db->where('DIVISI !=', '');
		$this->db->where("DIVISI NOT IN ($sub)", NULL, FALSE);

		return $this->db->get();
	}

	//  return num_rows untuk belum buat penalty penilaian SKI
	public function cari_divisi_blm_penilaian_h($c)
	{
		// sub query
		$this->db->select('DIVISI');
		$this->db->from('penalty_realisasi');
		$this->db->where($c);
		$sub = $this->db->get_compiled_select();
		// main query
		$this->db->select('k.DIVISI');
		$this->db->distinct();
		$this->db->from('tb_karyawan as k');
		$this->db->where('DIVISI !=', '');
		$this->db->where("DIVISI NOT IN ($sub)", NULL, FALSE);

		$n = $this->db->get();

		return $n->num_rows();
	}

	// cari divisi ubah data penilaian dengan status simpan
	public function cari_divisi_ubah_submit_penilaian($a)
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('penalty_realisasi');
		$this->db->where($a);

		return $this->db->get();
	}

	//  return num_rows untuk ubah penalty penilaian SKI
	public function cari_divisi_ubah_submit_penilaian_h($a)
	{
		$this->db->select('DIVISI');
		$this->db->distinct();
		$this->db->from('penalty_realisasi');
		$this->db->where($a);

		$n = $this->db->get();

		return $n->num_rows();
	}

}