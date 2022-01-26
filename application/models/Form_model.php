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

        public function getDataHeader($id)
        {
            $this->db->where('id_tbl_proses', $id) ;
            return $this->db->get('tbl_proses_header')->result_array() ;
        }

        public function getDataKolom($id)
        {
            $this->db->where('id_tbl_proses', $id) ;
            return $this->db->get('tbl_proses_kolom')->result_array() ;
        }

        public function getDataFooter($id)
        {
            $this->db->where('id_tbl_proses', $id) ;
            return $this->db->get('tbl_proses_footer')->result_array() ;
        }




        // untuk form
            public function getDataForGI($id)
            {
                $this->db->where('idJenisSample', $id) ;
                $this->db->join('tbl_general_informasi', 'tbl_general_informasi.idGI = tbl_gi_used.idGI') ;
                return $this->db->get('tbl_gi_used')->result_array() ;
            }

            public function getDataForTabel($id)
            {
                $this->db->where('idJenisSample', $id) ;
                return $this->db->get('tbl_proses')->result_array() ;
            }

            public function getDataForTabelHeader($id)
            {
                $this->db->where('id_tbl_proses', $id) ;
                return $this->db->get('tbl_proses_header')->result_array() ;
            }

            public function getDataForTabelKolom($id)
            {
                $this->db->where('id_tbl_proses', $id) ;
                return $this->db->get('tbl_proses_kolom')->result_array() ;
            }
        // untuk form
    }

?>