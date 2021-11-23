<?php
class Model_master_hak_akses extends CI_Model
{
var $column_order = array('a.NIPEG','a.NAMA','a.E_MAIL','a.JOBTITLE','b.ROLE'); //set column field database for datatable orderable
    var $column_search = array('a.NIPEG','a.NAMA','a.E_MAIL','a.JOBTITLE','b.ROLE'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('a.NIPEG' => 'asc'); // default order 
 

	/*--------------------------------------------------------
					BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/


	 private function _get_datatables_query()
    {         
      			$this->db->select('a.NIPEG,a.NAMA,a.E_MAIL,a.JOBTITLE,b.ROLE,b.ROLE1,b.ROLE2');
				$this->db->from('tb_karyawan as a');
				$this->db->join('role as b','a.NIPEG = b.NIPEG','left'); 
                

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
		$this->db->from('tb_karyawan as a');
		$this->db->join('role as b','a.NIPEG = b.NIPEG','left');
        return $this->db->count_all_results();
    }
	//end serverside
	
	public function carilebih_karyawan()
    {   
        $query=$this->db->query("SELECT a.NIPEG, a.NAMA, a.JOBTITLE FROM tb_karyawan as a WHERE a.NIPEG not in (SELECT NIPEG FROM role) UNION SELECT a.NIPEG, a.NAMA, a.JOBTITLE FROM tb_karyawan as a JOIN role as b on a.NIPEG=b.NIPEG WHERE b.ROLE='' ");
        return $query->num_rows();
        
    }
    public function carilebih_hak()
    {   
        $query=$this->db->query("SELECT NIPEG FROM role WHERE NIPEG not in (select NIPEG from tb_karyawan)");
        return $query->num_rows();
    }

    public function data_carilebih_karyawan()
    {   
        return $query=$this->db->query("SELECT a.NIPEG, a.NAMA,a.JOBTITLE FROM tb_karyawan as a WHERE a.NIPEG not in (SELECT NIPEG FROM role)");
        
    }

    public function data_belum_punya_hak()
    {   
        return $query=$this->db->query("SELECT a.NIPEG, a.NAMA,a.JOBTITLE FROM tb_karyawan as a JOIN role as b on a.NIPEG=b.NIPEG WHERE b.ROLE='' UNION SELECT a.NIPEG, a.NAMA,a.JOBTITLE FROM tb_karyawan as a JOIN role as b on a.NIPEG=b.NIPEG WHERE b.ROLE='' ");     
    }

    public function data_carilebih_hak()
    {   
        return $query=$this->db->query("SELECT NIPEG, ROLE FROM role WHERE NIPEG not in (select NIPEG from tb_karyawan)");
    }
    
    public function get_edit_hak_akses($id)
    {   
        $this->db->where('NIPEG',$id);
        $this->db->from('role');
        $query = $this->db->get();
 
        return $query->row();
    }
}