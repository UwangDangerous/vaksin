<?php 

    class Verifikasi_ extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Verifikasi_model_');
        }

        public function index()
        {
            $this->load->model('_Date');
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Ceklis Tersedia'; 
            $data['sample'] = $this->Verifikasi_model_->getDataSample();
            if( $this->session->userdata('key') != null ){
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('verifikasi_/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }


        public function tambahVerifikasi($id,$idSample)
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/hasil-verifikasi','pdf','verifikasi_','hasil-verifikasi');
            // $namaBerkas, $path, $type,$redirect,$namaTambahan = ''

            $query = [
                'idEvaluasi' => $id,
                'hasilVerifikasi' => $upload
            ];
            $queryRiwayat = [
                'idSample' => $idSample,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Selesai Di Verifikasi Oleh '. $this->session->userdata('nama')
            ];

            if($this->db->insert('verifikasi', $query)){
                if($this->db->insert('riwayatPekerjaan', $queryRiwayat)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Tambah',
                        'warna' => 'success' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("verifikasi_") ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Tambah',
                        'warna' => 'danger' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("verifikasi_") ;
                }
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("verifikasi_") ;
            }
        }


        public function pesanVerifikasi($id)
        {
            $query = [
                'idSample' => $id,
                'clock_off' => date('Y-m-d'),
                'judul' => $this->input->post('judul'),
                'keterangan' => $this->input->post('isi'),
                'clock_on' => '0000-00-00'
            ];
            $queryRiwayat = [
                'idSample' => $id,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Clock off '.$this->input->post('judul').' | Oleh ' . $this->session->userdata('nama'). ' (Verifikasi)'
            ];

            if($this->db->insert('clockoff', $query)){
                if($this->db->insert('riwayatPekerjaan', $queryRiwayat)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Tambah',
                        'warna' => 'success' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("verifikasi_") ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Tambah',
                        'warna' => 'danger' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("verifikasi_") ;
                }
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("verifikasi_") ;
            }
        }

        public function hapus($id, $idSample, $namaBerkas, $namaSample) 
        {
            $queryRiwayat = [
                'idSample' => $idSample,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Berkas Sampel '.$namaSample.' Di Hapus | Oleh ' . $this->session->userdata('nama'). ' (Verifikasi)'
            ];
            $this->db->where('idVerifikasi', $id);
            if($this->db->delete('verifikasi') ){
                if($this->db->insert('riwayatPekerjaan', $queryRiwayat)) {
                    unlink('./assets/file-upload/hasil-verifikasi/'.$namaBerkas) ;
                    $pesan = [
                        'pesan' => 'data berhasil dihapus' ,
                        'warna' => 'success'
                    ];
                }else{
                    $pesan = [
                        'pesan' => 'data gagal dihapus' ,
                        'warna' => 'danger'
                    ];
                }
            }else{
                $pesan = [
                    'pesan' => 'data gagal dihapus' ,
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect('verifikasi_') ;
        }
    }

?>