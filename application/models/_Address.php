<?php 

    class _Address extends CI_Model {
        public function getDataProvinsi() 
        {
            $this->db->order_by('namaProp', 'asc');
            return $this->db->get('a_propinsi')->result_array();
        }

        public function getDataKota() 
        {
            $this->db->order_by('namaKota', 'asc');
            $this->db->join('a_propinsi', 'a_propinsi.idProp = a_kota.idProp', 'inner');
            return $this->db->get('a_kota')->result_array();
        }

        public function getDataKecamatan() 
        {
            $this->db->order_by('namaKec', 'asc');
            $this->db->join('a_kota', 'a_kota.idKota = a_kecamatan.idKota', 'inner');
            return $this->db->get('a_kecamatan')->result_array();
        }
    }

?>