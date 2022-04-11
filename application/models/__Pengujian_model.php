<?php 

    class __Pengujian_model extends CI_Model{
        public function getDataPengujian() 
        {
            $this->db->where('idIU', $this->session->userdata('key')) ;
            // $this->db->where('idTugas', 3) ; //semua yang ada di tabel ini petugas
            $this->db->where('konfirmasiPP', 1) ;
            $this->db->join('no_admin_pengujian', 'no_admin_pengujian.idJP_used = petugas_penguji.idJP_used') ;
            $this->db->join('_jp_used','_jp_used.idJP_used = no_admin_pengujian.idJP_used') ;
            $this->db->join('sample_batch','sample_batch.idBatch = _jp_used.idBatch') ;
            $this->db->join('_sample','sample_batch.idSample = _sample.idSample') ;

            $this->db->join('_jenisSample', '_jenisSample.idJenisSample = _sample.idJenisSample') ;
            $this->db->join('_jenisKemasan','_jenisKemasan.idJenisKemasan = _jenisSample.idJenisKemasan') ;
            $this->db->join('_jenisManufacture', '_jenisManufacture.idJenisManufacture = _jenisSample.idJenisManufacture') ;
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = sample_batch.idJenisDokumen') ;
            $this->db->join('_jenisPengujian', '_jenisPengujian.idJenisPengujian = _jp_used.idJenisPengujian') ;
            $this->db->join('verifikasi_sample_batch', 'verifikasi_sample_batch.idBatch = sample_batch.idBatch') ;

            $this->db->order_by('PidAdm', 'desc') ;
            $this->db->select('PnoAdm, PkodeAdm, sample_batch.idBatch as idBatch, PkodeBulan, Ptahun, jumlah_sample as pengiriman, namaSample,noBatch, ingJenisKemasan ,namaJenisManufacture, _jenisManufacture.idJenisManufacture as idJenisManufacture, namaJenisDokumen, _sample.idJenisSample as idJenisSample, jenisSample, _jp_used.idJP_used, namaJenisPengujian, idPP') ;
            return $this->db->get("petugas_penguji")->result_array();
        }
    }

?>