<?php 

    class NoAdm_model extends CI_Model{

        public function getNoUrut($kd, $thn) 
        {
            $this->db->where('kodeAdm', $kd) ;
            // $this->db->where('kodeBulan', $bln) ;
            $this->db->where('tahun', $thn) ;
            $this->db->order_by('idAdm', 'asc') ;
            $this->db->select('noAdm') ;
            return $this->db->get('no_admin')->result_array() ;
        }

        public function getNoUrutUsed($id)
        {
            $this->db->where('idBatch', $id) ;
            return $this->db->get('no_admin')->row_array() ;
        }

        public function getDataPengujian($id)
        {
            $this->db->where('idBatch', $id) ;
            $this->db->join('_jenisPengujian', '_jenisPengujian.idJenisPengujian = _jp_used.idJenisPengujian') ;
            $this->db->select('idJP_used, _jenisPengujian.idJenisPengujian, namaJenisPengujian') ;
            return $this->db->get('_jp_used')->result_array() ;
        }

        public function getNoUrutPengujian($kd, $thn) 
        {
            $this->db->where('PkodeAdm', $kd) ;
            // $this->db->where('kodeBulan', $bln) ;
            $this->db->where('Ptahun', $thn) ;
            $this->db->order_by('PidAdm', 'asc') ;
            $this->db->select('PnoAdm, PidAdm') ;
            return $this->db->get('no_admin_pengujian')->result_array() ;
        }

        public function getNoAdmPengujian($id)
        {
            $this->db->where('idJP_used', $id) ;
            return $this->db->get('no_admin_pengujian')->row_array() ;
        }
    }

?>