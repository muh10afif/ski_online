<?php

class Model_history_ski extends CI_Model
{


var $table = 'nilai';
    var $column_order = array('tahun_insert',null); //set column field database for datatable orderable
    var $column_search = array('tahun_insert'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_nilai' => 'asc'); // default order 
 

    /*--------------------------------------------------------
                    BAGIAN AMBIL DATA SERVER SIDE 
    --------------------------------------------------------*/


     private function _get_datatables_query($nipeg)
    {           
                $this->db->from($this->table);
                $this->db->where($nipeg);
                $this->db->group_by('tahun_insert');

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
 
    function get_datatables($nipeg)
    {
        $this->_get_datatables_query($nipeg);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($nipeg)
    {
        $this->_get_datatables_query($nipeg);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($nipeg)
    {           
      $this->db->from($this->table);
                $this->db->where($nipeg);
                $this->db->group_by('tahun_insert');
        return $this->db->count_all_results();
    }


    /*--------------------------------------------------------
                PENUTUP BAGIAN AMBIL DATA SERVER SIDE 
    --------------------------------------------------------*/
            public function get_data_karyawan($nipeg){ 

                 
                    $this->db->select('
                                        a.NIPEG,
                                        a.NAMA,
                                        a.JOBTITLE,
                                        a.PANGKAT, 
                                        a.URUSAN,
                                        a.BAGIAN,
                                        a.DIVISI
                                    ');
                    $this->db->from('tb_karyawan as a');
                    $this->db->where('a.NIPEG',$nipeg);    
                    
                    return $this->db->get();
                }
        //UNTUK REIEW HISTORI 
               public function get_data_karyawan_nilai($nipeg, $thn,$versi){
                $this->db->select('
                n.id_nilai,
                k.NIPEG,
                k.NAMA,
                k.JOBTITLE,
                k.DIVISI,
                k.PANGKAT,
                i.nama_indikator,
                i.cara_pengukuran');
                $this->db->from('nilai as n');
                $this->db->join('tb_karyawan as k','n.NIPEG = k.NIPEG');
                $this->db->join('indikator as i','n.id_indikator = i.id_indikator');
                $this->db->where('n.NIPEG',$nipeg);
                $this->db->where('n.tahun_insert',$thn);
                $this->db->where('n.versi',$versi);
                $this->db->group_by('n.NIPEG');
                
                return $this->db->get();
            }

    public function get_divisi_baru($nipeg,$thn){
        $this->db->select('H_DIVISI,H_JOBTITLE');
        $this->db->from('nilai');
        $this->db->group_by('versi');
        $this->db->where('NIPEG',$nipeg);
        $this->db->where('tahun_insert',$thn);
        
        return $this->db->get();
    }

    public function get_divisi_baru_satu($nipeg,$thn,$versi){
        $this->db->select('*');
        $this->db->from('nilai');
        $this->db->where('versi',$versi);
        $this->db->where('NIPEG',$nipeg);
        $this->db->where('tahun_insert',$thn);
        
        return $this->db->get();
    }

}

