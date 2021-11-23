<?php

Class Model_master_jabatan extends CI_Model {

	var $table = 'jabatan';
    var $column_order = array('j.id_jabatan, j.nama_jabatan, d.nama_divisi', null); //set column field database for datatable orderable
    var $column_search = array('j.nama_jabatan, d.nama_divisi'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('j.id_jabatan' => 'desc'); // default order 
 

	/*--------------------------------------------------------
					BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/


	 private function _get_datatables_query()
    {         
      	$this->db->SELECT('j.id_jabatan, j.nama_jabatan, d.nama_divisi');
		$this->db->from('jabatan as j');
		$this->db->join('divisi as d','j.id_divisi = d.id_divisi');
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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {			
    	$this->db->from('jabatan as j');
		$this->db->join('divisi as d','j.id_divisi = d.id_divisi');
        
        return $this->db->count_all_results();
    }
 
	/*--------------------------------------------------------
				PENUTUP BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/

	function tampilkan_data_jabatan()
	{
		$sql = 
		"SELECT
		j.id_jabatan,
		j.nama_jabatan,
		d.nama_divisi
		FROM jabatan as j, divisi as d
		WHERE j.id_divisi = d.id_divisi ORDER BY j.id_jabatan DESC";

		return $this->db->query($sql);
	}

	function tampil_nama_divisi()
    {
        return $this->db->get('divisi');
    }

	function post($data)
	{
		$this->db->insert('jabatan',$data);
	}

	public function get_by_id($id){
		$this->db->from('jabatan');
		$this->db->where('id_jabatan',$id);
		$query = $this->db->get();
 
		return $query->row();
	}

	public function ubah_data_jabatan($where, $data){
		$this->db->update('jabatan', $data, $where);

		return $this->db->affected_rows();
	}

	public function delete_jabatan($where)
	{
		$this->db->where($where);
		$this->db->delete('jabatan');
	}



}