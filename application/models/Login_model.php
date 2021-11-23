<?php
class Login_model extends CI_Model{
    function auth_karyawan($e_mail)
    {
        $query=$this->db->query("SELECT a.NIPEG,a.NIPEG_UP, a.NAMA, b.ROLE, b.ROLE1, b.ROLE2 FROM tb_karyawan as a join role as b on a.nipeg=b.nipeg WHERE a.E_MAIL='$e_mail' LIMIT 1");
        return $query;
    }
}