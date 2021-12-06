<?php 

    class Verifikasi_model extends CI_Model{
        public function getDataSample() 
        {
            // $this->db->where('');
            $this->db->where('petugas.idIU', $this->session->userdata('key') );
            $this->db->join('sample', 'sample.idSample = petugas.idSample');
            $this->db->join('evaluasi', 'sample.idsample = evaluasi.idsample');
            $this->db->join('jenisSample', 'sample.idJS = jenisSample.idJS');
            return $this->db->get('petugas')->result_array();
        }

        public function getDataSampleVerifikasi($id) 
        {
            $this->db->where('idEvaluasi', $id);
            $this->db->join('sample', 'sample.idSample = evaluasi.idSample');
            return $this->db->get('evaluasi')->row_array();
        }

        public function cekData($id)
        {
            $this->db->where('idEvaluasi', $id);
            return $this->db->get('verifikasi')->row_array();
        }
    }

?>