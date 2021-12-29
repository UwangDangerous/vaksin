<?php 

    class Verifikasi_model_ extends CI_Model{
        public function getDataSample() 
        {
            $this->db->where('petugas.idLevel', '4' );
            $this->db->where('idIU', $this->session->userdata('key') );
            $this->db->join('_sample', '_sample.idSample = petugas.idSample');
            $this->db->join('evaluasi', '_sample.idSample = evaluasi.idSample');
            $this->db->join('_jenisSample', '_sample.idJenisSample = _jenisSample.idJenisSample');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = _sample.idJenisDokumen');
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _sample.idJenisManufacture');
            $this->db->order_by('_sample.idSample', 'desc');
            return $this->db->get('petugas')->result_array();
        }

        public function getDataDukung($id) 
        {
            $this->db->where('idSample', $id);
            $this->db->join('_jenisDataDukung', '_jenisDataDukung.idJenisDataDukung = _dataDukung.idJenisDataDukung');
            return $this->db->get('_dataDukung')->result_array();
        }

        public function buktiBayar($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('_buktiBayar')->row_array();
        }

        public function getDataEvaluasi($id)
        {
            $this->db->where('idEvaluasi', $id);
            return $this->db->get('verifikasi')->row_array();
        }

        public function clockoff($id)
        {
            $this->db->where('idSample',$id);
            $this->db->order_by('idClockOff', 'desc');
            return $this->db->get('clockoff')->row_array() ;
        }

        public function clock_on($id)
        {
            $this->db->where('idSample',$id);
            $this->db->join('clockoff_dokumen', 'clockoff_dokumen.idClockOff = clockoff.idClockOff', 'left');
            return $this->db->get('clockoff')->result_array() ;
        }
        
    }

?>