<?php 

    class NoAdm_model extends CI_Model{

        public function getNoUrut($kd, $thn) 
        {
            $this->db->where('kodeAdm', $kd) ;
            // $this->db->where('kodeBulan', $bln) ;
            $this->db->where('tahun', $thn) ;
            $this->db->order_by('idAdm', 'desc') ;
            $this->db->select('noAdm') ;
            return $this->db->get('no_admin')->result_array() ;
        }

        public function getNoUrutUsed($id)
        {
            $this->db->where('idBatch', $id) ;
            return $this->db->get('no_admin')->row_array() ;
        }
    }

?>