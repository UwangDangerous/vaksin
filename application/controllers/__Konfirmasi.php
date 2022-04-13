<?php 

    class __Konfirmasi extends CI_Controller{
        public function __construct() {
            parent::__construct() ;
            $this->load->model('__Konfirmasi_model');
        }

        public function pelulusan() 
        {

            $data['judul'] = 'Konfirmasi Petugas Evaluasi '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Konfirmasi Petugas Evaluasi'; 
            $data['bread'] = '<a href='.base_url().'dashboard>Dashboard</a> / Petugas Pelulusan'; 
            $data['petugas'] = $this->__Konfirmasi_model->getDataVerifikasi() ;
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('__konfirmasi/pelulusan');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
                
            }

        }

        public function konfirmasi_terima($idPetugas, $konfirmasi, $id) 
        {
            $this->db->where('idPetugas', $idPetugas) ;
            $this->db->set('konfirmasi', $konfirmasi) ;
            if($this->db->update('petugas')) {

                $this->load->model('_Riwayat') ;
                if($konfirmasi == 1){
                    $this->_Riwayat->simpanRiwayat($id, "Petugas Di Konfirmasi", "Petugas Evaluator",1) ;
                }else{
                    $this->_Riwayat->simpanRiwayat($id, "Batal Penugasan, Konfirmasi Ditolak", "Petugas Evaluator",1) ;
                }
                $pesan = [
                    'pesan' => 'konfirmasi berhasil disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'konfirmasi gagal disimpan',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan);
            redirect("__konfirmasi/pelulusan") ;
        }

        public function hapus_petugas_pelulusan($idPetugas, $id)
        {
            $this->db->where('idPetugas', $idPetugas);
            if($this->db->delete('petugas')) {

                $this->load->model('_Riwayat') ;
                $this->_Riwayat->simpanRiwayat($id, "Petugas Pelulusan Dihapus", "Petugas Evaluator",1) ;
                $pesan = [
                    'pesan' => 'konfirmasi berhasil dihapus',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'konfirmasi gagal dihapus',
                    'warna' => 'danger'
                ];
            }
            $this->session->set_flashdata($pesan);
            redirect("__konfirmasi/pelulusan") ;
        }




        // ==========================================================================================================================
        public function pengujian() 
        {

            $data['judul'] = 'Konfirmasi Petugas Penguji '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Konfirmasi Petugas Penguji'; 
            $data['bread'] = '<a href='.base_url().'dashboard>Dashboard</a> / Petugas Penguji'; 
            $data['petugas'] = $this->__Konfirmasi_model->getDataVerifikasiPengujian() ;
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('__konfirmasi/pengujian');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
                
            }

        }

        public function konfirmasi_terima_pengujian($idPetugas, $konfirmasi, $id) 
        {
            $this->db->where('idPP', $idPetugas) ;
            $this->db->set(
                             [
                                 'konfirmasiPP' => $konfirmasi,
                                 'tgl_mulai_pengujian' => date("Y-m-d")
                             ]) ;
            if($this->db->update('petugas_penguji')) {

                $this->load->model('_Riwayat') ;
                if($konfirmasi == 1){
                    $this->_Riwayat->simpanRiwayat($id, "Petugas Penguji Di Konfirmasi", "Petugas Evaluator",1) ;
                }else{
                    $this->_Riwayat->simpanRiwayat($id, "Batal Penugasan, Konfirmasi Ditolak", "Petugas Pengujian",1) ;
                }
                $pesan = [
                    'pesan' => 'konfirmasi berhasil disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'konfirmasi gagal disimpan',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan);
            redirect("__konfirmasi/pengujian") ;
        }

        public function hapus_petugas_pengujian($idPetugas, $id)
        {
            $this->db->where('idPP', $idPetugas) ;
            if($this->db->delete('petugas_penguji')) {

                $this->load->model('_Riwayat') ;
                $this->_Riwayat->simpanRiwayat($id, "Petugas Penguji Dihapus", "Petugas Pengujian",1) ;
                $pesan = [
                    'pesan' => 'konfirmasi berhasil dihapus',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'konfirmasi gagal dihapus',
                    'warna' => 'danger'
                ];
            }
            $this->session->set_flashdata($pesan);
            redirect("__konfirmasi/pengujian") ;
        }

    }

?>