<?php

Class Model_master_direktori extends CI_Model
{
	var $table = 'direktori';
	var $column_order  = array('d.id_direktori','i.nama_indikator', 'i.satuan_indikator', 'i.cara_pengukuran', 'p.nama_proker');
	var $column_search = array('d.id_direktori','i.nama_indikator', 'i.satuan_indikator', 'i.cara_pengukuran', 'p.nama_proker');
	var $order 		   = array('d.id_direktori' => 'desc');

	/*SELECT direktori.NIPEG, tb_karyawan.NAMA, tb_karyawan.JOBTITLE, indikator.nama_indikator, proker.nama_proker FROM `direktori` 
	join tb_karyawan on tb_karyawan.NIPEG = direktori.NIPEG
	JOIN indikator on indikator.id_indikator = direktori.id_indikator
	JOIN proker on proker.id_proker = direktori.id_proker*/

	/*--------------------------------------------------------
					BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/

	private function _get_datatables_query($jobtitle)
    {         
      	$this->db->SELECT('d.id_direktori, i.nama_indikator, p.nama_proker, i.satuan_indikator, i.cara_pengukuran');
		$this->db->from('direktori as d');
		$this->db->join('indikator as i', 'i.id_indikator = d.id_indikator');
		$this->db->join('proker as p', 'p.id_proker = i.id_proker');
		$this->db->where('d.JOBTITLE', $jobtitle);

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

    function get_datatables($jobtitle)
    {
        $this->_get_datatables_query($jobtitle);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($jobtitle)
    {
        $this->_get_datatables_query($jobtitle);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($jobtitle)
    {			
    	$this->db->SELECT('d.id_direktori, i.nama_indikator, p.nama_proker, i.satuan_indikator, i.cara_pengukuran');
		$this->db->from('direktori as d');
		$this->db->join('indikator as i', 'i.id_indikator = d.id_indikator');
		$this->db->join('proker as p', 'p.id_proker = i.id_proker');
		$this->db->where('d.JOBTITLE', $jobtitle);
        
        return $this->db->count_all_results();
    }

	/*--------------------------------------------------------
				PENUTUP BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/

	/*SELECT DISTINCT JOBTITLE FROM `tb_karyawan` WHERE JOBTITLE NOT IN (SELECT direktori.JOBTITLE FROM direktori)*/

	// Jobtitle BELUM ada pada direktori 
	public function get_job_belum()
	{
		$this->db->select('JOBTITLE');
		$this->db->DISTINCT();
		$this->db->from('tb_karyawan');
		$this->db->where("JOBTITLE NOT IN (SELECT d.JOBTITLE from direktori as d)", NULL, FALSE);

		return $this->db->get();
	}

	public function get_job_belum_h()
	{
		$this->db->select('JOBTITLE');
		$this->db->DISTINCT();
		$this->db->from('tb_karyawan');
		$this->db->where("JOBTITLE NOT IN (SELECT d.JOBTITLE from direktori as d)", NULL, FALSE);

		$n = $this->db->get();

		return $n->num_rows();
	}

	// Jobtitle SUDAH ada pada direktori 
	public function get_job_sudah()
	{
		$this->db->select('JOBTITLE');
		$this->db->DISTINCT();
		$this->db->from('tb_karyawan');
		$this->db->where("JOBTITLE IN (SELECT d.JOBTITLE from direktori as d)", NULL, FALSE);

		return $this->db->get();
	}

	public function get_job_sudah_h()
	{
		$this->db->select('JOBTITLE');
		$this->db->DISTINCT();
		$this->db->from('tb_karyawan');
		$this->db->where("JOBTITLE IN (SELECT d.JOBTITLE from direktori as d)", NULL, FALSE);

		$n = $this->db->get();

		return $n->num_rows();
	}

    // ambil direktori karyawan
    public function get_data_direktori_karyawan($jobtitle)
    {
    	$this->db->SELECT('d.id_direktori, i.nama_indikator, p.nama_proker, i.satuan_indikator, i.cara_pengukuran');
		$this->db->from('direktori as d');
		$this->db->join('indikator as i', 'i.id_indikator = d.id_indikator');
		$this->db->join('proker as p', 'p.id_proker = i.id_proker');
		$this->db->where('d.JOBTITLE', $jobtitle);

		return $this->db->get();
    }

	public function tampil_direktori()
	{
		$this->db->SELECT('d.id_direktori, d.NIPEG, k.NAMA, k.JOBTITLE, i.nama_indikator, p.nama_proker');
		$this->db->from('direktori as d');
		$this->db->join('tb_karyawan as k', 'k.NIPEG = d.NIPEG');
		$this->db->join('indikator as i', 'i.id_indikator = d.id_indikator');
		$this->db->join('proker as p', 'p.id_proker = i.id_proker');
		$this->db->order_by('d.id_direktori', 'desc');

		return $this->db->get();
	}

	public function nama_karyawan()
	{
		$this->db->select('NAMA, NIPEG');
		$this->db->from('tb_karyawan');
		$this->db->order_by('NAMA', 'asc');

		return $this->db->get();
	}

	public function nama_jobtitle()
	{
		$this->db->select('JOBTITLE');
		$this->db->DISTINCT();
		$this->db->from('tb_karyawan');
		$this->db->order_by('JOBTITLE', 'asc');

		return $this->db->get();
	}

	public function direktori()
	{
		return $this->db->get('direktori');
	}

	public function nama_proker()
	{
		return $this->db->get('proker');
	}

	public function nama_indikator()
	{
		$this->db->from('indikator');
		$this->db->where('id_proker !=', '3');

		return $this->db->get();
	}

	public function simpan_direktori($data){
		$this->db->insert('direktori',$data);
	}

	public function cari_direktori($data)
    {
        $this->db->from('direktori');
        $this->db->where($data);

        $n = $this->db->get();

        return $n->num_rows();
    }

    public function cari_nama_indikator($nama)
    {
    	$this->db->from('direktori as d');
    	$this->db->join('indikator as i', 'i.id_indikator = d.id_indikator');
    	$this->db->where('d.id_indikator', $nama);

    	return $this->db->get();
    }


	public function simpan_data($result)
	{
		$this->db->insert_batch('direktori', $result);
		return $this->db->affected_rows();
	}

	public function get_by_id_direktori($id){
		$this->db->from('direktori');
		$this->db->where('id_direktori',$id);
		$query = $this->db->get();
 
		return $query->row();
	}

	public function delete_direktori($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function ubah_data_direktori($where, $data){

		$this->db->update('direktori', $data, $where);

		return $this->db->affected_rows();
	}




}