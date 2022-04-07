<?php 

    class __Evaluasi_model extends CI_Model{
        public function getDataEvaluasi() 
        {
            $this->db->where('idIU', $this->session->userdata('key')) ;
            $this->db->where('idTugas', 2) ;
            $this->db->where('konfirmasi', 1) ;
            $this->db->join('no_admin', 'no_admin.idBatch = petugas.idBatch') ;
            $this->db->join('sample_batch','sample_batch.idBatch = petugas.idBatch') ;
            $this->db->join('_sample','sample_batch.idSample = _sample.idSample') ;

            $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample') ;
            $this->db->join('_jenisKemasan','_jenisKemasan.idJenisKemasan = _jenisSample.idJenisKemasan') ;

            $this->db->order_by('idAdm', 'desc') ;
            $this->db->select('noAdm, kodeAdm, sample_batch.idBatch, kodeBulan, tahun, pengiriman, namaSample,noBatch, ingJenisKemasan ') ;
            return $this->db->get("petugas")->result_array();
        }

        public function getDataPekerjaan($id)
        {
            $this->db->where('idBatch', $id) ;
            $this->db->join('_jenisPekerjaan','_jp_add.idJenisPekerjaan = _jenisPekerjaan.idJenisPekerjaan') ;
            $this->db->select('namaJenisPekerjaan') ;
            return $this->db->get('_jp_add')->result_array() ;
        }
    }

?>