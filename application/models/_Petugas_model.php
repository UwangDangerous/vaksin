<?php 

    class _Petugas_model extends CI_Model{
        public function getDataPetugas($lvl) {

            if($lvl == 3) {
                $this->db->where('idLevel', 3) ; 
            }

            if($lvl == 4){
                $this->db->where('idLevel = 3 or idLevel = 4') ;
            }

            $this->db->select('idIU , namaIU') ;
            return $this->db->get('inuser')->result_array() ;
        }

        public function getPetugasVerifikator($id, $tugas) 
        {
            $this->db->where('idBatch', $id) ;
            $this->db->where('idTugas', $tugas) ;
            return $this->db->get('petugas')->row_array() ;
        }

        public function getDataPengujian($id)
        {
            $this->db->where('idBatch', $id) ;
            $this->db->join('_jenisPengujian', '_jenisPengujian.idJenisPengujian = _jp_used.idJenisPengujian') ;
            $this->db->select('idJP_used, idBatch, namaJenisPengujian') ;
            return $this->db->get('_jp_used')->result_array() ;
        }

        public function getPetugasPenguji($id)
        {
            $this->db->where('idJP_used', $id);
            // $this->db->join('inuser', 'inuser.idIU = petugas_penguji.idIU') ;
            // $this->db->select('idIU') ;
            return $this->db->get('petugas_penguji')->result_array() ;
        }

    }


?>