<?php 

    class _Riwayat extends CI_Model {
        public function simpanRiwayat($id, $keterangan, $perihal,$view)
        {
            date_default_timezone_set('Asia/Jakarta');
            $query = [
                'idBatch' => $id ,
                'tgl_riwayat' => date('Y-m-d'),
                'jam_riwayat' => date('G:i:s'),
                'perihal_riwayat' => $perihal ,
                'keteranganRiwayat' => $keterangan,
                'view_riwayat' => $view
            ] ;

            $this->db->insert('_z_riwayatpekerjaan', $query) ;
        }

        public function getDataRiwayat($id) 
        {
            $this->db->where('idBatch', $id) ;
            return $this->db->get('_z_riwayatpekerjaan')->result_array() ;
        }

        public function responTanggapan($id, $pesan_pengirim,$tipe_pesan,$status_pengirim)
        {
            $berkas = '' ;
                if($this->input->post('file_pengirim')) {
                    $this->load->model('_Upload');
                    $file = $this->_Upload->uploadEksUser('file_pengirim',
                        'assets/file-upload/respon',
                        'pdf|jpg|png|jpeg',
                        "petugas/detail/$idSurat/$idSample/$id", 
                        'Respon_Tanggapan' 
                    );
                }
                $query_respon = [ 
                    'idBatch' => $id ,
                    'pesan_pengirim' => $pesan_pengirim,
                    'tgl_respon_pengirim' => date('Y-m-d'),
                    'jam_respon_pengirim' => date('G:i:s'),
                    'tipe_pesan' => $tipe_pesan,
                    'file_pengirim' => $berkas,
                    'status_pengirim' => $status_pengirim
                ];
                $this->db->insert('_z_respon_tanggapan', $query_respon) ;
        }
    }

?>