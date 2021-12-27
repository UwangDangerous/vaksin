<?php 

    class Surat extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('Surat_model');
            $this->load->library('form_validation');
        }

        public function index() 
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Riwayat dan Keterangan Surat'. $this->session->userdata('eksNama'); 
            $data['header'] = 'Riwayat dan Keterangan Surat'; 
            $data['bread'] = '<a href="'.base_url().'dsb"> Dashboard </a> / Riwayat Surat'; 
            $data['surat'] = $this->Surat_model->getSurat();
            if( $this->session->userdata('eksId') )
            {
                $this->load->view('temp/dsbHeader',$data);
                $this->load->view('surat/index', $data);
                $this->load->view('temp/dsbFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                redirect('auth') ;
            }
        }


        public function kirim() 
        {
            $data['judul'] = 'Tambah Surat Pengiriman'. $this->session->userdata('eksNama'); 
            $data['header'] = 'Surat Pengiriman'; 
            $data['bread'] = '<a href="'.base_url().'dsb"> Dashboard </a> / Pengiriman Sample'; 
            if( $this->session->userdata('eksId') )
            {
                // $this->form_validation->set_rules('berkas', 'Nama User', 'required');
                $this->form_validation->set_rules('nama', 'Nama Surat / Judul', 'required');
                $this->form_validation->set_rules('Isi', 'Isi Surat', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dsbHeader',$data);
                    $this->load->view('surat/kirim');
                    $this->load->view('temp/dsbFooter');
                }else{
                    $this->Surat_model->addSurat();
                }
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                redirect('auth') ;
            }
        }

        public function tambahDokumen() 
        {
            $upload = $this->Surat_model->uploadDokumen();

            $query = [
                'idPenerimaan' => $this->input->post('id') ,
                'namaDokumen' => $this->input->post('nama', true),
                'namaBerkas' => $upload
            ];

            if($this->db->insert('dokumen', $query)){
                $pesan = [
                    'pesan' => 'Dokumen Berhasil Di Tambah',
                    'warna' => 'success' 
                ];
                $this->session->set_flashdata($pesan);
                redirect('surat') ;
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Tambah',
                    'warna' => 'danger' 
                ];
                $this->session->set_flashdata($pesan);
                redirect('surat/kirim') ;
            }
        }

        public function penundaan() 
        {
            $this->load->model('_Date');
            $data['judul'] = 'Penundaan Pengerjaan'. $this->session->userdata('eksNama'); 
            $data['header'] = 'Penundaan Pengerjaan'; 
            $data['bread'] = '<a href="'.base_url().'dsb"> Dashboard </a> / Riwayat Surat'; 
            $data['penundaan'] = $this->Surat_model->getClockOFF();
            if( $this->session->userdata('eksId') )
            {
                $this->load->view('temp/dsbHeader',$data);
                $this->load->view('surat/penundaan', $data);
                $this->load->view('temp/dsbFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
                redirect('auth') ;
            }
        }

        public function uploadPenundaan($id)
        {
            // $id = $this->input->post('id') ;
            $this->load->model('_Upload');
            $upload = $this->_Upload->uploadEksUser('berkas','assets/file-upload/berkas-clock-off','pdf','surat/penundaan');
            $query = [
                'idClockOff' => $id,
                'keterangan_cf' => $this->input->post('keterangan'),
                'berkas_cf' => $upload
            ];

            $this->db->where('idClockOff', $id);
            if($this->db->update('clockoff', ['clock_on'=>date('Y-m-d')])) {
                if($this->db->insert('clockoff_dokumen', $query)) {
                    $pesan = [
                        'pesan' => 'Dokumen Berhasil Di Upload',
                        'warna' => 'success' 
                    ];
                }else{
                    $pesan = [
                        'pesan' => 'Dokumen Gagal Di Upload',
                        'warna' => 'danger' 
                    ];
                }
            }else{
                $pesan = [
                    'pesan' => 'Dokumen Gagal Di Upload',
                    'warna' => 'danger' 
                ];
            }
            $this->session->set_flashdata($pesan);
            redirect('surat/penundaan') ;
        }
    }

?>



<?php 

    // class Surat extends CI_Controller{
    //     public function __construct() 
    //     {
    //         parent::__construct() ;
    //         $this->load->model('Surat_model');
    //         $this->load->library('form_validation');
    //     }

    //     public function index() 
    //     {
    //         $idLevel = $this->session->userdata('idLevel') ;
    //         $data['judul'] = 'Riwayat dan Keterangan Surat'. $this->session->userdata('eksNama'); 
    //         $data['header'] = 'Riwayat dan Keterangan Surat'; 
    //         $data['bread'] = '<a href="'.base_url().'dsb"> Dashboard </a> / Riwayat Surat'; 
    //         $data['surat'] = $this->Surat_model->getSurat();
    //         if( $this->session->userdata('eksId') )
    //         {
    //             $this->load->view('temp/dsbHeader',$data);
    //             $this->load->view('surat/index', $data);
    //             $this->load->view('temp/dsbFooter');
    //         }else{
    //             $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
    //             redirect('auth') ;
    //         }
    //     }


    //     public function kirim() 
    //     {
    //         $data['judul'] = 'Tambah Surat Pengiriman'. $this->session->userdata('eksNama'); 
    //         $data['header'] = 'Surat Pengiriman'; 
    //         $data['bread'] = '<a href="'.base_url().'dsb"> Dashboard </a> / Pengiriman Sample'; 
    //         if( $this->session->userdata('eksId') )
    //         {
    //             // $this->form_validation->set_rules('berkas', 'Nama User', 'required');
    //             $this->form_validation->set_rules('nama', 'Nama Surat / Keterangan', 'required');
    //             $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

    //             if($this->form_validation->run() == FALSE) {
    //                 $this->load->view('temp/dsbHeader',$data);
    //                 $this->load->view('surat/kirim');
    //                 $this->load->view('temp/dsbFooter');
    //             }else{
    //                 $this->Surat_model->addSurat();
    //             }
    //         }else{
    //             $this->session->set_flashdata('login' , 'Silahkan Login Lagi');
    //             redirect('auth') ;
    //         }
    //     }

    //     public function tambahDokumen() 
    //     {
    //         $upload = $this->Surat_model->uploadDokumen();

    //         $query = [
    //             'idPenerimaan' => $this->input->post('id') ,
    //             'namaDokumen' => $this->input->post('nama', true),
    //             'namaBerkas' => $upload
    //         ];

    //         if($this->db->insert('dokumen', $query)){
    //             $pesan = [
    //                 'pesan' => 'Dokumen Berhasil Di Tambah',
    //                 'warna' => 'success' 
    //             ];
    //             $this->session->set_flashdata($pesan);
    //             redirect('surat') ;
    //         }else{
    //             $pesan = [
    //                 'pesan' => 'Data Gagal Di Tambah',
    //                 'warna' => 'danger' 
    //             ];
    //             $this->session->set_flashdata($pesan);
    //             redirect('surat/kirim') ;
    //         }
    //     }
    // }

?>