<?php 

    class Evaluasi extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Evaluasi_model');
        }

        public function index()
        {
            $this->load->model('_Date');
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Ceklis Tersedia'; 
            $data['sample'] = $this->Evaluasi_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('evaluasi/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambah($id)
        {
            $data['judul'] = 'Evaluasi Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Evaluasi Sample'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'evaluasi "> Ceklis Tersedia  </a> / Input Hasil Evaluasi'; 
            $data['sample'] = $this->Evaluasi_model->getDataSampleEvaluasi($id);
            // $data['petugas'] = $petugas;
            if( $this->session->userdata('key') != null )
            {
                $this->form_validation->set_rules('batch', 'Batch No', 'required|numeric');
                $this->form_validation->set_rules('doses', 'Doses', 'required|numeric');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('evaluasi/tambah');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->Evaluasi_model->addHasilEvaluasi($id);
                }
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }




        public function tambahEvaluasi($id)
        {
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/hasil-evaluasi','pdf','evaluasi','hasil-evaluasi');
            // $namaBerkas, $path, $type,$redirect,$namaTambahan = ''

            $query = [
                'idSample' => $id,
                'hasilEvaluasi' => $upload
            ];
            $queryRiwayat = [
                'idSample' => $id,
                'tgl_riwayat' => date('Y-m-d'),
                'keteranganRiwayat' => 'Selesai Di Evaluasi Oleh '. $this->session->userdata('nama')
            ];

            if($this->db->insert('evaluasi', $query)){
                if($this->db->insert('riwayatPekerjaan', $queryRiwayat)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Tambah',
                        'warna' => 'success' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Tambah',
                        'warna' => 'danger' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("evaluasi") ;
            }
        }


        public function pesanEvaluasi($id)
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
                'keteranganRiwayat' => 'Clock off '.$this->input->post('judul').' | oleh' . $this->session->userdata('nama')
            ];

            if($this->db->insert('clockoff', $query)){
                if($this->db->insert('riwayatPekerjaan', $queryRiwayat)) {
                    $pesan = [
                        'pesan' => 'Data Berhasil Di Tambah',
                        'warna' => 'success' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }else{
                    $pesan = [
                        'pesan' => 'Data Gagal Di Tambah',
                        'warna' => 'danger' 
                    ];
                    $this->session->set_flashdata($pesan);
                    redirect("evaluasi") ;
                }
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect("evaluasi") ;
            }
        }
    }

?>