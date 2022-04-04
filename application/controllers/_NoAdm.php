<?php 

    class _NoAdm extends CI_Controller{

        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('NoAdm_model');
        }

        // no urut pelulusan
            public function no_adm_pelulusan($id) 
            {
                $this->load->model("_Date") ;
                $data['id'] = $id ;

                $this->load->view('petugas/detail/noAdm/pelulusan', $data) ;
            }

            public function simpan_no_urut_pelulusan($id)
            {
                $query = [
                    'idBatch' => $id,
                    'noAdm' => $this->input->post('noAdm'),
                    'kodeAdm' => $this->input->post('kodeAdm'),
                    'kodeBulan' => $this->input->post('kodeBulan'),
                    'tahun' => $this->input->post('tahun')
                ] ;

                if($this->db->insert('no_admin', $query)) {
                    $this->load->model('_Riwayat') ;
                    $this->_Riwayat->simpanRiwayat($id, 'No Admin Pelulusan Disimpan', "No Admin", 1) ;

                    $pesan = [
                        'pesan_no_pelulusan' => 'Nomor Admin Berhasil Disimpan',
                        'warna_no_pelulusan' => 'success'
                    ];
                }else{
                    $pesan = [
                        'pesan_no_pelulusan' => 'Nomor Admin Gagal Disimpan',
                        'warna_no_pelulusan' => 'danger'
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->no_adm_pelulusan($id) ;
            }

            public function hapus_no_urut_pelulusan($id, $idAdm)
            {
                $this->db->where('idAdm', $idAdm) ;
                if($this->db->delete('no_admin')) {
                    $this->load->model('_Riwayat') ;
                    $this->_Riwayat->simpanRiwayat($id, 'No Admin Pelulusan Dihapus', "No Admin", 1) ;

                    $pesan = [
                        'pesan_no_pelulusan' => 'Nomor Admin Berhasil Dihapus',
                        'warna_no_pelulusan' => 'success'
                    ];
                }else{
                    $pesan = [
                        'pesan_no_pelulusan' => 'Nomor Admin Gagal Dihapus',
                        'warna_no_pelulusan' => 'danger'
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->no_adm_pelulusan($id) ;
            }
        // no urut pelulusan
















        // no urut pengujian
            public function no_adm_pengujian($id, $idJenisManufacture)  
            {
                $this->load->model("_Date") ;
                $data['id'] = $id ;
                $data['idJenisManufacture'] = $idJenisManufacture ;
                $data['pengujian'] = $this->NoAdm_model->getDataPengujian($id) ;

                $this->load->view('petugas/detail/noAdm/pengujian', $data) ;
            }

            public function simpan_no_urut_pengujian($id, $idBatch, $idJenisManufacture)
            {
                $query = [
                    'idJP_used' => $id,
                    'PnoAdm' => $this->input->post('PnoAdm'),
                    'PkodeAdm' => $this->input->post('PkodeAdm'),
                    'PkodeBulan' => $this->input->post('PkodeBulan'),
                    'Ptahun' => $this->input->post('Ptahun')
                ] ;

                if($this->db->insert('no_admin_pengujian', $query)) {
                    $this->load->model('_Riwayat') ;
                    $this->_Riwayat->simpanRiwayat($id, 'No Admin Pengujian Disimpan', "No Admin Pengujian", 1) ;

                    $pesan = [
                        'pesan_no_pengujian' => 'Nomor Admin Berhasil Disimpan',
                        'warna_no_pengujian' => 'success'
                    ];
                }else{
                    $pesan = [
                        'pesan_no_pengujian' => 'Nomor Admin Gagal Disimpan',
                        'warna_no_pengujian' => 'danger'
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->no_adm_pengujian($idBatch, $idJenisManufacture) ;
            }

            public function hapus_no_urut_pengujian($id, $idBatch, $idJenisManufacture)
            {
                $this->db->where('PidAdm', $id) ;
                if($this->db->delete('no_admin_pengujian')) {
                    $this->load->model('_Riwayat') ;
                    $this->_Riwayat->simpanRiwayat($id, 'Hapus No Admin Pengujian', "No Admin Pengujian", 1) ;

                    $pesan = [
                        'pesan_no_pengujian' => 'Nomor Admin Berhasil Dihapus',
                        'warna_no_pengujian' => 'success'
                    ];
                }else{
                    $pesan = [
                        'pesan_no_pengujian' => 'Nomor Admin Gagal Dihapus',
                        'warna_no_pengujian' => 'danger'
                    ];
                }

                $this->session->set_flashdata($pesan) ;
                $this->no_adm_pengujian($idBatch, $idJenisManufacture) ;
            }

            
        // no urut pengujian
    }

?>