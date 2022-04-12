<?php 

    class __Evaluasi extends CI_Controller{
        public function __construct()
        {
            parent :: __construct() ;
            $this->load->model('__Evaluasi_model') ;
        }

        public function index()
        {
            $data['judul'] = 'Evaluasi Dokumen Pelulusan '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Evaluasi Dokumen Pelulusan'; 
            $data['bread'] = '<a href='.base_url().'dashboard>Dashboard</a> / Evaluasi Dokumen'; 
            $data['evaluasi'] = $this->__Evaluasi_model->getDataEvaluasi() ;
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('__evaluasi/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
                
            }
        }

        public function simpanPenomoranEvaluasi()
        {
            $id = $this->input->post('idBatch') ;

            $query = [
                'idBatch' => $id ,
                'nomor_ceklis' => $this->input->post('nomor_ceklis'),
                'tgl_expiry' => $this->input->post('tgl_expiry')
            ];

            if($this->db->insert('hasil_evaluasi',$query)) {
                $this->load->model('_Riwayat') ;
                $this->_Riwayat->simpanRiwayat($id, 'Penomoran Evaluasi Disimpan', 'Evaluasi Dokumen','1') ;
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Disimpan',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("__evaluasi") ;
        
        }
        
        public function ubahPenomoranEvaluasi()
        {
            $id = $this->input->post('id_hasil_evaluasi') ;
            $query = [
                'idBatch' => $this->input->post('idBatch') ,
                'nomor_ceklis' => $this->input->post('nomor_ceklis'),
                'tgl_expiry' => $this->input->post('tgl_expiry')
            ];

            $this->db->where('id_hasil_evaluasi', $id) ;
            if($this->db->update('hasil_evaluasi',$query)) {
                $this->load->model('_Riwayat') ;
                $this->_Riwayat->simpanRiwayat($this->input->post('idBatch'), 'Penomoran Evaluasi Disimpan', 'Evaluasi Dokumen','1') ;
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Disimpan',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("__evaluasi") ;
        
        }
        public function hapusPenomoranEvaluasi($id, $idBatch)
        {
            $this->db->where('id_hasil_evaluasi', $id) ;
            if($this->db->delete('hasil_evaluasi')) {
                $this->load->model('_Riwayat') ;
                $this->_Riwayat->simpanRiwayat($idBatch, 'Penomoran Evaluasi Dihapus', 'Evaluasi Dokumen','1') ;
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Disimpan',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect("__evaluasi") ;
        }
    }

?>