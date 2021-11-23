<?php
class Model_master_karyawan extends CI_Model
{

    public function ubah_status($data,$where)
    {
        $this->db->update('role', $data, $where);
    }

    var $table = 'tb_karyawan';
    var $column_order = array('a.NIPEG', 'a.NAMA', 'a.DIREKT', 'a.DIVISI', 'a.BAGIAN','b.STATUS_KARYAWAN' ); //set column field database for datatable orderable
    var $column_search = array('a.NIPEG', 'a.NAMA', 'a.DIREKT', 'a.DIVISI', 'a.BAGIAN','b.STATUS_KARYAWAN'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('a.NAMA' => 'ASC'); // default order 

    /*--------------------------------------------------------
                    BAGIAN AMBIL DATA SERVER SIDE 
    --------------------------------------------------------*/

    /**************************************************************
                    POST KARYAWAN ---- WEBSERVICE
    **************************************************************/

    public function simpan_karyawan_1($array_php)
    {
        return $this->db->insert_batch('tb_karyawan', $array_php);
    }


    public function simpan_karyawan_2($array_php)
    {
        $this->db->insert_batch('tb_karyawan', $array_php);
        return $this->db->affected_rows();
    }

    // hapus karyawan
    public function hapus_karyawan()
    {
        return $this->db->empty_table('tb_karyawan');

    }

    /*--------------------------------------------------------
                AKHIR BAGIAN AMBIL DATA SERVER SIDE 
    --------------------------------------------------------*/

     private function _get_datatables_query()
    {         
                $this->db->select('a.NIPEG, a.NAMA, a.DIVISI, a.JOBTITLE, b.STATUS_KARYAWAN');
                $this->db->from('tb_karyawan as a');
                $this->db->join('role as b','a.NIPEG=b.NIPEG');
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
        $this->db->from('tb_karyawan');
        return $this->db->count_all_results();
    }
 
    /*--------------------------------------------------------
                PENUTUP BAGIAN AMBIL DATA SERVER SIDE 
    --------------------------------------------------------*/

}