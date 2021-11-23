<?php

class Model_master_divisi  extends CI_Model
{


	//SELECT `id_divisi`, `nama_divisi` FROM `divisi` WHERE 1

	var $table = 'divisi';
    var $column_order = array('id_divisi','nama_divisi',null); //set column field database for datatable orderable
    var $column_search = array('id_divisi','nama_divisi'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_divisi' => 'desc'); // default order 
 

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

    ///tambah master

    public function tambah_divisi($data){
            $this->db->insert('divisi',$data);
        }
    //dlete divisi
    public function delete_divisi($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    
public function get_by_id_divisi($id){
      
      $this->db->from($this->table);
        $this->db->where('id_divisi',$id);
        $query = $this->db->get();
 
        return $query->row();
    }



    public function ubah_data_divisi($where, $data){

        $this->db->update($this->table, $data, $where);

        return $this->db->affected_rows();
    }



}