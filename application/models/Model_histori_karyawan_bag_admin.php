<?php

Class Model_histori_karyawan_bag_admin extends CI_Model {

	



	///SELECT `EXTPES`, `NMKECIL`, `NAMA`, `IDJOB`, `TINGKATJABATAN`, `E_MAIL`, `FIRST_NAME`, `PIN`, `DIREKT`, `NIPEG_UP`, `KDKERJ`, `DIVISI`, `NIPEG`, `BAGIAN`, `PANGKAT`, `JOBTITLE`, `TINGKATAKSES`, `URUSAN` FROM `tb_karyawan` WHERE 1


    var $table = 'tb_karyawan';
    var $column_order = array('NIPEG','NAMA','DIREKT','DIVISI',null); //set column field database for datatable orderable
    var $column_search = array('NIPEG','NAMA','DIREKT','DIVISI'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('NAMA' => 'asc'); // default order 
 

    /*--------------------------------------------------------
                    BAGIAN AMBIL DATA SERVER SIDE 
    --------------------------------------------------------*/


     private function _get_datatables_query($divisi)
    {           
                $this->db->from($this->table);
                $this->db->where("DIVISI like '$divisi'");
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
 
    function get_datatables($divisi)
    {
        $this->_get_datatables_query($divisi);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($divisi)
    {
        $this->_get_datatables_query($divisi);
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

    //menga,bil divisi
	public function get_divisi(){
		$this->db->select('DIVISI');
        $this->db->distinct();
		$this->db->from('tb_karyawan');
        $this->db->where_not_in('DIVISI', '');
        $this->db->order_by('DIVISI', 'ASC');
		return $this->db->get();
	}
    //mengambil list tahun  sesuai nip
    public function list_tahun($nipeg){
        $nip = $nipeg;
         $this->db->from('nilai');
         $this->db->where('NIPEG',$nip);
         $this->db->group_by('tahun_insert');
         return $this->db->get();
    }


      //mengambil pinalty histori 
            public function get_pinalti_penetapan($thn, $divisi)
            {
                //SELECT `ID_PENALTY_P`, `ID_INDIKATOR`, `DIVISI`, `TARGET_PERTAHUN`, `BOBOT`, `TOTAL_BOBOT`, `TW1`, `TW2`, `TW3`, `TW4`, `STATUS`, `TAHUN_INSERT`, `INPUT_TIME` FROM `penalty_penetapan` WHERE 1


                $this->db->select('n.ID_PENALTY_P,i.deliverable,i.id_indikator,n.DIVISI,i.satuan_indikator, i.nama_indikator, i.cara_pengukuran,n.TW1,n.TW2,n.TW3,n.TW4, n.BOBOT, n.TOTAL_BOBOT, n.TARGET_PERTAHUN, n.TAHUN_INSERT');
                $this->db->FROM('penalty_penetapan as n');
                $this->db->join('indikator as i','i.id_indikator = n.ID_INDIKATOR');          
                $this->db->where('n.TAHUN_INSERT',$thn);                
                $this->db->where('n.DIVISI',$divisi);
                return $this->db->get();
            }

     //mengambil pinalty histori per tw
           
            public function get_pinalti_tw($thn, $divisi, $tw)
            {
               //SELECT `ID_PENALTY_R`, `ID_INDIKATOR`, `DIVISI`, `BOBOT`, `TOTAL_BOBOT`, `NILAI_PENETAPAN`, `REALISASI`, `NILAI_REALISASI`, `TOTAL_NILAI`, `JENIS_REALISASI`, `STATUS`, `TAHUN`, `TMT`, `TST`, `INPUT_TIME` FROM `penalty_realisasi` WHERE 1

                $this->db->select('
                                    n.ID_PENALTY_R,
                                    i.id_indikator,
                                    i.satuan_indikator,
                                    i.deliverable,
                                    n.DIVISI,
                                    i.nama_indikator, 
                                    i.cara_pengukuran,                                   
                                    n.BOBOT,
                                    n.TOTAL_BOBOT, 
                                    n.NILAI_PENETAPAN,
                                    n.REALISASI, 
                                    n.NILAI_REALISASI, 
                                    n.TAHUN,
                                    n.TARGET_PERTAHUN,
                                    n.TOTAL_NILAI
                                ');

                $this->db->FROM('penalty_realisasi as n');
                $this->db->join('indikator as i','i.id_indikator = n.ID_INDIKATOR');          
                $this->db->where('n.TAHUN',$thn);                
                $this->db->where('n.DIVISI',$divisi);
                $this->db->where('n.JENIS_REALISASI', $tw);
                return $this->db->get();
            }


         

}