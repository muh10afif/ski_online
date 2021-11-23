<?php

class Model_master_rekap_data  extends CI_Model
{


	//SELECT `id_divisi`, `nama_divisi` FROM `divisi` WHERE 1

    var $column_order = array('t.NIPEG','t.NAMA','t.DIVISI','r.nilai_ski','r.jenis_realisasi','t.JOBTITLE','t.BAGIAN','t.URUSAN','r.tahun',null); //set column field database for datatable orderable
    var $column_search = array('t.NIPEG','t.NAMA','t.DIVISI','r.nilai_ski','r.jenis_realisasi','t.JOBTITLE','t.BAGIAN','t.URUSAN','r.tahun'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('t.NIPEG' => 'desc'); // default order 
 

	/*--------------------------------------------------------
					BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/


	 private function _get_datatables_query($thn,$tw)
    {         
		
       /*SELECT t.nipeg, t.NAMA , t.DIVISI, r.total_realisasi, r.jenis_realisasi 
        FROM realisasi_nilai as r ,
        tb_karyawan as t 
        WHERE

        r.NIPEG = t.NIPEG AND
        r.ATASAN_1 IS NOT null
        AND r.ATASAN_2 IS NOT null
        AND r.jenis_realisasi = 'TW1' 
        AND tahun = '2018'
        GROUP BY r.jenis_realisasi*/

        $this->db->select("t.nipeg, t.NAMA , t.DIVISI,t.JOBTITLE,t.BAGIAN,t.URUSAN, r.nilai_ski, r.jenis_realisasi,r.tahun ");
       /* $this->db->from("
                        realisasi_nilai as r,
                        tb_karyawan as t
                        ");
        $this->db->Where("
                           r.NIPEG = t.NIPEG AND
                           r.ATASAN_1 IS NOT null
                           AND r.ATASAN_2 IS NOT null
                           AND r.jenis_realisasi like'%$tw' 
                           AND tahun like '%$thn'
                           GROUP BY r.jenis_realisasi
                        ");*/
        $this->db->from('realisasi_nilai as r');
        $this->db->group_by('r.jenis_realisasi');
        $this->db->join('tb_karyawan as t', 't.NIPEG = r.NIPEG');
        $this->db->where("r.jenis_realisasi like '$tw' ")
        ->where("tahun like '$thn'")->where('r.ATASAN_1 !=',"")->where('r.ATASAN_2 !=',"");


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
 
    function get_datatables($thn,$tw)
    {
        $this->_get_datatables_query($thn,$tw);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($thn,$tw)
    {
        $this->_get_datatables_query($thn,$tw);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($thn,$tw)
    {			
    	$this->db->select("t.nipeg, t.NAMA , t.DIVISI,t.JOBTITLE,t.BAGIAN,t.URUSAN, r.nilai_ski, r.jenis_realisasi,r.tahun ");
        $this->db->from("
                        realisasi_nilai as r,
                        tb_karyawan as t
                        ");
        $this->db->Where("
                           r.NIPEG = t.NIPEG AND
                           r.ATASAN_1 IS NOT null
                           AND r.ATASAN_2 IS NOT null
                           AND r.jenis_realisasi like'%$tw' 
                           AND tahun like '%$thn'
                           GROUP BY r.jenis_realisasi
                        ");
        return $this->db->count_all_results();
    }


	/*--------------------------------------------------------
				PENUTUP BAGIAN AMBIL DATA SERVER SIDE 
	--------------------------------------------------------*/

    public function get_rekap_excel($thn,$tw){
        $th = $thn;
        $t = $tw;
        $this->db->select("t.NIPEG, t.NAMA , t.JOBTITLE, t.URUSAN, t.BAGIAN, r.nilai_ski, t.DIVISI, r.total_realisasi, r.jenis_realisasi,r.tahun ");
        $this->db->from("
                        realisasi_nilai as r,
                        tb_karyawan as t
                        ");
        $this->db->Where("
                           r.NIPEG = t.NIPEG AND
                           r.ATASAN_1 IS NOT null
                           AND r.ATASAN_2 IS NOT null
                           AND r.jenis_realisasi like'%$t' 
                           AND tahun like '%$th'
                           GROUP BY r.jenis_realisasi
                        ");
        return $this->db->get();
    }
}