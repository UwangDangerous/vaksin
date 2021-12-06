<?php 

    class Petugas_model extends CI_Model{
        public function getSample() 
        {
            // $this->db->where('idPenerimaan', $id);
            $this->db->join('jenisSample','sample.idJS = jenisSample.idJS');
            $this->db->order_by('idSample', 'desc');
            return $this->db->get("sample")->result_array();
        }

        public function getPetugas($id)
        {
            $this->db->where('idSample', $id);
            return $this->db->get('petugas')->result_array();
        }

        public function getPilihPetugas($lvl) 
        {
            if($lvl != 5){
                $this->db->where("idLevel = $lvl or idLevel = 5");
            }else{
                $this->db->where("idLevel = 5");
            }
            $this->db->select('idIU,namaIU');
            $this->db->order_by('idLevel', 'asc');
            return $this->db->get('inUser')->result_array();
        }
        
        public function getDataPetugas($id, $idSample) 
        {
            $this->db->where("idSample = $idSample and idLevel = $id");
            return $this->db->get('petugas')->row_array();
            // var_dump($data) ;
        }

        
    }

?>