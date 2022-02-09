<?php 

    class Cetak_model extends CI_Model{
        public function getJudulSample($id) 
        {
            $this->db->where('idSample', $id);
            // $this->db->join('_jenisSample','_jenisSample.idJenisSample = _sample.idJenisSample');
            // $this->db->select('namaSample,jenisSample');
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenissample', '_jenissample.idJenisSample = _sample.idJenisSample');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = _sample.idJenisDokumen');
            $this->db->join('proses', 'proses.idProses = _sample.idProses');
            return $this->db->get('_sample')->row_array();
        }

        public function getDataGeneral_informasi($id)
        {
            $this->db->where('idJenisSample', $id) ;
            $this->db->join('tbl_general_informasi', 'tbl_general_informasi.idGI = tbl_gi_used.idGI') ;
            return $this->db->get('tbl_gi_used')->result_array() ;
        }

        public function getPetugasEvaluasi($idSample) 
        {
            $this->db->where('idSample',$idSample);
            $this->db->where('petugas.idLevel', 3);
            $this->db->select('namaIU, inuser.idIU as idIU');
            $this->db->join('inuser', 'inuser.idIU = petugas.idIU');
            return $this->db->get('petugas')->row_array();
        }

        public function getPetugasVerivikasi($idSample) 
        {
            $this->db->where('idSample',$idSample);
            $this->db->where('petugas.idLevel', 4);
            $this->db->select('namaIU, inuser.idIU as idIU');
            $this->db->join('inuser', 'inuser.idIU = petugas.idIU');
            return $this->db->get('petugas')->row_array();
        }

        public function getPetugasCheck()
        {
            $this->db->where('idLevel', 2);
            return $this->db->get('inuser')->row_array();
        }

        public function getInfoCeklis($idSample)
        {
            $this->db->where('idSample', $idSample);
            return $this->db->get('hasil_evaluasi')->row_array();
        }

        public function getHasilVerifikasi($id) 
        {
            $this->db->where('id_hasil_evaluasi', $id);
            return $this->db->get('hasil_verifikasi')->row_array();
        }

        public function getHasilPeriksa($id) 
        {
            $this->db->where('id_hasil_evaluasi', $id);
            return $this->db->get('hasil_periksa')->row_array();
        }

        public function cekSertifikat($id)
        {
            $this->db->where('id_hasil_evaluasi', $id);
            return $this->db->get('sertifikat')->row_array() ;
        }

        public function getDataBatch($idSample)
        {
            $this->db->where('idSample', $idSample);
            return $this->db->get('sample_batch')->result_array();
        }

        public function getDataImportir($idSample)
        {
            $this->db->where('idSample',$idSample);
            return $this->db->get('_importir')->row_array();
        }
    }


?>