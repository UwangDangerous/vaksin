<?php 

    class Sertifikat_model extends CI_Model{
        public function getDataSample()
        {
            $this->db->join('_surat', '_surat.idSurat = _sample.idSurat');
            $this->db->join('eksuser', 'eksuser.idEU = _surat.idEU');
            $this->db->join('_jenissample', '_jenissample.idJenisSample = _sample.idJenisSample');
            $this->db->join('_jenisDokumen', '_jenisDokumen.idJenisDokumen = _sample.idJenisDokumen');
            $this->db->join('proses', 'proses.idProses = _sample.idProses');
            $this->db->order_by('idSample', 'desc');
            return $this->db->get("_sample")->result_array();
        }
    }

?>