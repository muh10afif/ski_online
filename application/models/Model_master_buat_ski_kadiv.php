<?php
class Model_master_buat_ski_kadiv extends CI_Model
{

    // belum penetapan ski
    public function get_karyawan_blm($thn)
    {
        $this->db->select('n.NIPEG');
        $this->db->from('nilai as n');
        $this->db->where('tahun_insert', $thn);
        $sub = $this->db->get_compiled_select();

        $this->db->from('tb_karyawan');
        $this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

        return $this->db->get();
    }

    public function get_karyawan_blm_h($thn)
    {
        $this->db->select('n.NIPEG');
        $this->db->from('nilai as n');
        $this->db->where('tahun_insert', $thn);
        $sub = $this->db->get_compiled_select();

        $this->db->from('tb_karyawan');
        $this->db->where("NIPEG NOT IN ($sub)", NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

        return $this->db->count_all_results();
    }
    // akhir belum penetapan ski

    // ubah data penetapan ski
    public function get_karyawan_ubah($thn)
    {
        //sub query
        $this->db->select('n.NIPEG');
        $this->db->from('nilai as n');
        $this->db->join('role as r', 'r.NIPEG = n.NIPEG');
        $this->db->where('r.buat_ski', "BELUM");
        $this->db->where('n.input_by', "ADMIN");
         $this->db->where('tahun_insert', $thn);
        $sub = $this->db->get_compiled_select();

        //main query
        $this->db->from('tb_karyawan');
        $this->db->where("NIPEG IN ($sub)", NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

        return $this->db->get();
    }

    public function get_karyawan_ubah_h($thn)
    {
        //sub query
        $this->db->select('n.NIPEG');
        $this->db->from('nilai as n');
        $this->db->join('role as r', 'r.NIPEG = n.NIPEG');
        $this->db->where('r.buat_ski', "BELUM");
        $this->db->where('n.input_by', "ADMIN");
         $this->db->where('tahun_insert', $thn);
        $sub = $this->db->get_compiled_select();

        //main query
        $this->db->from('tb_karyawan');
        $this->db->where("NIPEG IN ($sub)", NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

        return $this->db->count_all_results();
    }
    //akhir ubah data penetapan ski

    //sudah penetapan ski
    public function get_karyawan_sdh($thn)
    {
        //sub query
        $this->db->select('n.NIPEG');
        $this->db->from('nilai as n');
        $this->db->join('role as r', 'r.NIPEG = n.NIPEG');
        $this->db->where('r.buat_ski', "SUDAH");
        $this->db->where('n.input_by', "ADMIN");
         $this->db->where('tahun_insert', $thn);
        $sub = $this->db->get_compiled_select();

        //main query
        $this->db->from('tb_karyawan');
        $this->db->where("NIPEG IN ($sub)", NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

        return $this->db->get();
    }

    public function get_karyawan_sdh_h($thn)
    {
        //sub query
        $this->db->select('n.NIPEG');
        $this->db->from('nilai as n');
        $this->db->join('role as r', 'r.NIPEG = n.NIPEG');
        $this->db->where('r.buat_ski', "SUDAH");
        $this->db->where('n.input_by', "ADMIN");
         $this->db->where('tahun_insert', $thn);
        $sub = $this->db->get_compiled_select();

        //main query
        $this->db->from('tb_karyawan');
        $this->db->where("NIPEG IN ($sub)", NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

        return $this->db->count_all_results();
    }
    //akhir sudah penetapan ski

    // belum submit penilaian tw
    public function get_karyawan_tw_blm($thn,$tw)
    {
        $this->db->select('r.NIPEG');
        $this->db->from('realisasi_nilai as r');
        $this->db->where('jenis_realisasi', $tw)->where('tahun', $thn);
        $sub = $this->db->get_compiled_select();

        $this->db->select('n.H_JOBTITLE, n.NIPEG, k.NAMA');
        $this->db->from('nilai as n');
        $this->db->join('tb_karyawan as k', 'k.NIPEG = n.NIPEG');
        $this->db->where('input_by', "ADMIN");
        $this->db->where('n.ATASAN_1 !=', NULL);
        $this->db->where('tahun_insert', $thn);
        $this->db->group_by('n.NIPEG');
        $this->db->where("n.NIPEG NOT IN ($sub)", NULL, FALSE);

        return $this->db->get();
    }

    public function get_karyawan_tw_blm_h($thn,$tw)
    {
        $this->db->select('r.NIPEG');
        $this->db->from('realisasi_nilai as r');
        $this->db->where('jenis_realisasi', $tw)->where('tahun', $thn);
        $sub = $this->db->get_compiled_select();

        $this->db->select('n.H_JOBTITLE, n.NIPEG, k.NAMA');
        $this->db->from('nilai as n');
        $this->db->join('tb_karyawan as k', 'k.NIPEG = n.NIPEG');
        $this->db->where('input_by', "ADMIN");
        $this->db->where('n.ATASAN_1 !=', NULL);
        $this->db->where('tahun_insert', $thn);
        $this->db->group_by('n.NIPEG');
        $this->db->where("n.NIPEG NOT IN ($sub)", NULL, FALSE);

        return $this->db->count_all_results();
    }
    // akhir belum submit penilaian tw

    // sudah ubah data penilaian tw
    public function get_karyawan_tw_ubah($thn,$tw)
    {   
        $this->db->select('r.NIPEG');
        $this->db->from('realisasi_nilai as r');
        $this->db->where('status', "SIMPAN")
        ->where('ATASAN_1', "")->where('ATASAN_2', "")->where('input_by', "ADMIN")
        ->where('jenis_realisasi', $tw)->where('tahun', $thn);
        $sub = $this->db->get_compiled_select();


        $this->db->select('n.H_JOBTITLE, n.NIPEG, k.NAMA');
        $this->db->from('nilai as n');
        $this->db->join('tb_karyawan as k', 'k.NIPEG = n.NIPEG');
        $this->db->where('input_by', "ADMIN");
        $this->db->where('n.ATASAN_1 !=', NULL);
        $this->db->where('tahun_insert', $thn);
        $this->db->group_by('n.NIPEG');
        $this->db->where("n.NIPEG IN ($sub)", NULL, FALSE);

        return $this->db->get();
    }

    public function get_karyawan_tw_ubah_h($thn,$tw)
    {   
        $this->db->select('r.NIPEG');
        $this->db->from('realisasi_nilai as r');
        $this->db->where('status', "SIMPAN")
        ->where('ATASAN_1', "")->where('ATASAN_2', "")->where('input_by', "ADMIN")
        ->where('jenis_realisasi', $tw)->where('tahun', $thn);
        $sub = $this->db->get_compiled_select();


        $this->db->select('n.H_JOBTITLE, n.NIPEG, k.NAMA');
        $this->db->from('nilai as n');
        $this->db->join('tb_karyawan as k', 'k.NIPEG = n.NIPEG');
        $this->db->where('input_by', "ADMIN");
        $this->db->where('n.ATASAN_1 !=', NULL);
        $this->db->where('tahun_insert', $thn);
        $this->db->group_by('n.NIPEG');
        $this->db->where("n.NIPEG IN ($sub)", NULL, FALSE);

        return $this->db->count_all_results();
    }
    // Akhir ubah data penilaian tw

    // sudah submit penilaian tw
    public function get_karyawan_tw_sdh($thn,$tw)
    {   
        $this->db->select('r.NIPEG');
        $this->db->from('realisasi_nilai as r');
        $this->db->where('status', "KIRIM")
        ->where('ATASAN_1 !=', NULL)->where('ATASAN_2 !=', NULL)->where('input_by', "ADMIN")
        ->where('jenis_realisasi', $tw)->where('tahun', $thn);
        $sub = $this->db->get_compiled_select();


        $this->db->select('n.H_JOBTITLE, n.NIPEG, k.NAMA');
        $this->db->from('nilai as n');
        $this->db->join('tb_karyawan as k', 'k.NIPEG = n.NIPEG');
        $this->db->where('input_by', "ADMIN");
        $this->db->where('n.ATASAN_1 !=', NULL);
        $this->db->where('tahun_insert', $thn);
        $this->db->group_by('n.NIPEG');
        $this->db->where("n.NIPEG IN ($sub)", NULL, FALSE);

        return $this->db->get();
    }

    public function get_karyawan_tw_sdh_h($thn,$tw)
    {   
        $this->db->select('r.NIPEG');
        $this->db->from('realisasi_nilai as r');
        $this->db->where('status', "KIRIM")
        ->where('ATASAN_1 !=', NULL)->where('ATASAN_2 !=', NULL)->where('input_by', "ADMIN")
        ->where('jenis_realisasi', $tw)->where('tahun', $thn);
        $sub = $this->db->get_compiled_select();


        $this->db->select('n.H_JOBTITLE, n.NIPEG, k.NAMA');
        $this->db->from('nilai as n');
        $this->db->join('tb_karyawan as k', 'k.NIPEG = n.NIPEG');
        $this->db->where('input_by', "ADMIN");
        $this->db->where('n.ATASAN_1 !=', NULL);
        $this->db->where('tahun_insert', $thn);
        $this->db->group_by('n.NIPEG');
        $this->db->where("n.NIPEG IN ($sub)", NULL, FALSE);

        return $this->db->count_all_results();
    }
    // Akhir sudah submit penilaian tw



    var $column_order = array('NIPEG','NAMA','JOBTITLE'); //set column field database for datatable orderable
    var $column_search = array('NIPEG','NAMA','JOBTITLE'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('NAMA' => 'asc'); // default order
 

    /*--------------------------------------------------------
                    BAGIAN AMBIL DATA SERVER SIDE 
    --------------------------------------------------------*/


     private function _get_datatables_query()
    {         
        $this->db->from('tb_karyawan');
        $this->db->where('NIPEG NOT IN (SELECT n.NIPEG FROM nilai as n)', NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

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
        $this->db->where('NIPEG NOT IN (SELECT n.NIPEG FROM nilai as n)', NULL, FALSE);
        $this->db->order_by('NAMA', 'ASC');

        return $this->db->count_all_results();
    }
}