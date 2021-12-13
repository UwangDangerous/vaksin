<?php 

    class Sertifikat_model extends CI_Model{
        public function getSampleVerifikasi($id)
        {
            $this->db->where('idPenerimaan', $id);
            $this->db->join('jenisSample', 'jenisSample.idJS = sample.idJS');
            $this->db->join('evaluasi', 'evaluasi.idSample = sample.idSample','left');
            $this->db->join('verifikasi', 'verifikasi.idEvaluasi = evaluasi.idEvaluasi','left');
            $this->db->join('pesan', 'idPesan = status','left');
            $this->db->select('sample.idSample as idSample,
                         namaSample,
                         status,
                         sertifikat,
                         keterangan,
                         tgl_terima_sample,
                         tgl_expiry,
                         vialLolos,
                         indo,
                         warna,
                         namaJS,
                         idVerifikasi
                    ');
            return $this->db->get('sample')->result_array();
        }
    }

?>