<?php 

    class __Konfirmasi_model extends CI_Model{
        public function getDataPelulusan(){
            $this->db->where('idIU', $this->session->userdata('key')) ;
            return $this->db->get('petugas')->result_array() ;
        }
    }

?>