<?php 

    class _Riwayat extends CI_Model {
        public function simpanRiwayat($id, $keterangan)
        {
            date_default_timezone_set('Asia/Jakarta');
            $query = [
                'idBatch' => $id ,
                'tgl_riwayat' => date('Y-m-d'),
                'jam_riwayat' => date('G:i:s'),
                'keteranganRiwayat' => $keterangan
            ] ;

            $this->db->insert('_z_riwayatpekerjaan', $query) ;
        }
    }

?>