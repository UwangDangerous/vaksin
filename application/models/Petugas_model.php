<?php 

    class Petugas_model extends CI_Model{
        public function getSample($id,$cari) 
        {
            // $this->db->where('idPenerimaan', $id);
            // $this->db->join('jenisSample','sample.idJS = jenisSample.idJS');
            $this->db->where("_surat.idSurat like '%$id%'");
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenissample', '_jenissample.idJenisSample = _sample.idJenisSample');
            $this->db->order_by('idSample', 'desc');
            return $this->db->get("_sample")->result_array();
        }

        public function getDetailBatch($id) 
        {
            $this->db->where('idBatch', $id);
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('sample_batch', '_sample.idSample = sample_batch.idSample');
            $this->db->join('_jenissample', '_jenissample.idJenisSample = _sample.idJenisSample');
            $this->db->join('_importir', '_importir.idSample = _sample.idSample', 'left');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = sample_batch.idJenisDokumen');
            return $this->db->get('_sample')->row_array();
        }

        public function getDataDukungBatch($id)
        {
            $this->db->where('idBatch', $id);
            $this->db->join('_jenisDataDukung', '_datadukung_batch.idJenisDataDukung = _jenisDataDukung.idJenisDataDukung');
            $this->db->select('namaJenisDataDukung, fileDataDukung');
            return $this->db->get('_datadukung_batch')->result_array();
        } //new

        public function getJenisDataDukung($id) 
        {
            $this->db->where('idJenisManufacture', $id);
            return $this->db->get('_jenisDataDukung')->result_array();
        } //new

        public function setDataDukung($id, $idDok) 
        {
            $this->db->where('idJenisDataDukung',$idDok);
            $this->db->where('idBatch', $id);
            return $this->db->get('_dataDukung_batch')->row_array();
        } //new

        public function getVerifikasiBerkas($id) 
        {
            $this->db->where('idBatch', $id);
            $this->db->order_by('idVB','asc');
            return $this->db->get('verifikasi_berkas')->row_array();
        }// new
        public function getVerifikasiSample($id) 
        {
            $this->db->where('idBatch', $id);
            $this->db->order_by('idVsb','asc');
            return $this->db->get('verifikasi_sample_batch')->row_array();
        }// new

        public function getVerifikasiPembayaran($id)
        {
            $this->db->where('idBatch', $id);
            // $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = sample_batch.idJenisDokumen') ;
            $this->db->order_by('idBuktiBayar','desc');
            return $this->db->get('_bukti_bayar')->row_array();
        }
    }

?>

