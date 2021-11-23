<?php

class Model_master_urusan extends CI_Model
{


	//SELECT `id_urusan`, `nama_urusan` FROM `urusan` WHERE 1

	var $table = 'urusan';
    var $column_order = array('id_urusan','nama_urusan',null); //set column field database for datatable orderable
    var $column_search = array('id_urusan','nama_urusan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_urusan' => 'desc'); // default order 
 

	/*--------------------------------------------------------
					BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/


	 private function _get_datatables_query()
    {         
				$this->db->from($this->table);
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
    			$this->db->from($this->table);
        return $this->db->count_all_results();
    }


	/*--------------------------------------------------------
				PENUTUP BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/
    
    public function delete_urusan($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }    
    
    public function get_by_id_urusan($id){
      
      $this->db->from($this->table);
        $this->db->where('id_urusan',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
     public function tambah_urusan($data){
            $this->db->insert('urusan',$data);
        }

    public function ubah_data_urusan($where, $data){

        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }
    ///


}