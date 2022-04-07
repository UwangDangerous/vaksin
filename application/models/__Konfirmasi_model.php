<?php 

    class __Konfirmasi_model extends CI_Model{
        public function getDataVerifikasi(){
            $this->db->where('idIU', $this->session->userdata('key')) ;
            $this->db->where('idTugas', 1) ;
            $this->db->join('sample_batch', 'sample_batch.idBatch = petugas.idBatch') ;
            $this->db->join('no_admin', 'no_admin.idBatch = sample_batch.idBatch', 'left') ;
            $this->db->select('petugas.idBatch') ;
            $this->db->order_by('idAdm', 'desc') ;
            return $this->db->get('petugas')->result_array() ;
        }

        public function getDataPelulusanEvaluasi($id){
            $this->db->where('petugas.idBatch', $id) ;
            $this->db->where('idTugas', 2) ;
            $this->db->join('inuser', 'inuser.idIU = petugas.idIU') ;
            $this->db->join('sample_batch', 'sample_batch.idBatch = petugas.idBatch') ;
            $this->db->join('no_admin', 'no_admin.idBatch = sample_batch.idBatch', 'left') ;
            $this->db->select('noBatch,kodeAdm,idPetugas , petugas.idBatch as idBatch, noAdm, kodeBulan, tahun, konfirmasi,namaIU') ;
            // $this->db->order_by('idAdm', 'desc') ;
            return $this->db->get('petugas')->row_array() ;
        }



        // ===================================================================================================

        public function getDataVerifikasiPengujian()
        {
            $this->db->where('idIU', $this->session->userdata('key')) ;
            $this->db->where('idTugas', 1) ;
            $this->db->join('sample_batch','sample_batch.idBatch = petugas.idBatch') ;
            $this->db->select('petugas.idBatch,noBatch') ;
            return $this->db->get('petugas')->result_array() ;
        }

        public function getDataPetugasPenguji($id){
            $this->db->where('_jp_used.idBatch',$id) ;
            $this->db->join('_jp_used','_jp_used.idJP_used = petugas_penguji.idJP_used') ;
            $this->db->join('no_admin_pengujian','no_admin_pengujian.idJP_used = _jp_used.idJP_used') ;
            $this->db->join('sample_batch','sample_batch.idBatch = _jp_used.idBatch') ;
            $this->db->join('inuser','petugas_penguji.idIU = inuser.idIU') ;
            $this->db->select('PnoAdm,PkodeAdm,PkodeBulan,Ptahun,namaIU,noBatch,idPP,konfirmasiPP,sample_batch.idBatch') ;
            return $this->db->get('petugas_penguji')->result_array() ;
        }
    }

?>