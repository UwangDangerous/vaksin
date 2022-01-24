<?php 

    class Form_model extends CI_Model{
        public function jenisSample($id)
        {
            $this->db->where('idJenisSample', $id);
            return $this->db->get('_jenisSample')->row_array();
        }

        public function cekTbl_gi_used($idGI, $idJenisSample)
        {
            $this->db->where('idGI', $idGI);
            $this->db->where('idJenisSample', $idJenisSample);
            return $this->db->get('tbl_gi_used')->row_array();
        }

        public function getDataTabel($id)
        {
            $this->db->where('idJenisSample', $id) ;
            return $this->db->get('tbl_proses')->result_array() ;
        }
    }

?>