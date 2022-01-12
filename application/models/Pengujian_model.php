<?php 

    class Pengujian_model extends CI_Model {
        public function getDataSamplePengujian()
        {
            $this->db->where('idProses = 2');
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample');
            return $this->db->get('_sample')->result_array();
        }

        public function getDataSamplePengujianBatch($id)
        {
            $this->db->where('idSample', $id);
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            // $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            // $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            // $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample');
            $this->db->select('idSample, namaSample');
            return $this->db->get('_sample')->row_array();
        }

        public function getImportir($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('_importir')->row_array();
        }

        public function getBatch($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('sample_batch')->num_rows();
        }

        public function geDatatBatch($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('sample_batch')->result_array();
        }

        public function getDataDukungBatch($id) 
        {
            $this->db->where('idBatch', $id);
            $this->db->join('_jenisDataDukung', '_jenisDataDukung.idJenisDataDukung = _datadukung_batch.idJenisDataDukung');
            return $this->db->get('_datadukung_batch')->result_array();
        }
    }

?>