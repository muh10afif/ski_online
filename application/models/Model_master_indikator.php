<?php

class Model_master_indikator extends CI_Model
{


	//SELECT `id_indikator`, `nama_indikator`, `id_proker`, `cara_pengukuran`, `deliverable` FROM `indikator` WHERE 1

	var $table = 'indikator';
    var $column_order = array('p.nama_indikator','p.cara_pengukuran','p.deliverable','p.id_indikator',null); //set column field database for datatable orderable
    var $column_search = array('p.nama_indikator','p.cara_pengukuran','p.deliverable','i.nama_proker'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('p.id_indikator' => 'desc'); // default order 
 
//
	//SELECT `id_indikator`, `nama_indikator`, `id_proker`, `cara_pengukuran`, `deliverable` FROM `indikator` WHERE 1
	//SELECT `id_proker`, `nama_proker` FROM `proker` WHERE 1

	/*--------------------------------------------------------
					BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/


	 private function _get_datatables_query()
    {         
      			$this->db->select('p.nama_indikator,p.cara_pengukuran,p.deliverable,p.id_indikator,i.nama_proker');
				$this->db->from('indikator as p');
				$this->db->join('proker as i','i.id_proker = p.id_proker'); 
                $this->db->where_in('p.divisi', '');
                

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
    			$this->db->from('indikator as p');
				$this->db->join('proker as i','i.id_proker = p.id_proker');
        return $this->db->count_all_results();
    }
 


	/*--------------------------------------------------------
				PENUTUP BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/

	function tampilkan_data_indikator()
	{
		$sql = 
		"SELECT
		i.nama_indikator,
		p.nama_proker,
		i.cara_pengukuran,
		i.deliverable,
		i.id_indikator
		FROM indikator as i, proker as p
		WHERE i.id_proker = p.id_proker";

		return $this->db->query($sql);
	}

	public function delete_indikator($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
 	
 	function nama_proker(){
        return $this->db->get('proker');
    }

	public function tambah_indikator($data){
			$this->db->insert('indikator',$data);
		}



	public function get_by_id_indikator($id){
		$this->db->from('indikator');
		$this->db->where('id_indikator',$id);
		$query = $this->db->get();
 
		return $query->row();
	}


	public function ubah_data_inidikator($where, $data){

		$this->db->update($this->table, $data, $where);

		return $this->db->affected_rows();
	}



}