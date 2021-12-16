<?php //di akhiri dengan _ artinya revisian

    class Sample_ extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('User_Sample_model');
        }

        public function index($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Informasi Sample'; 
            $data['id'] = $id ;
            $data['sample'] = $this->User_Sample_model->getDataSample($id);
            if( $this->session->userdata('eksId') != null )
            {
                $this->load->view('temp/dsbHeader',$data);
                $this->load->view('sample_user/index');
                $this->load->view('temp/dsbFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambah($id)
        {
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'dsb / <a href="'.base_url().'sample_/index/'.$id.'"> Informasi Sample </a> / Data Sample '; 

            $data['id'] = $id ;

            // untuk combo box
            $data['jenisSample'] = $this->db->get('_jenisSample')->result_array();
            $data['jenisManufacture'] = $this->db->get('_jenisManufacture')->result_array();
            $data['jenisDokumen'] = $this->db->get('_jenisDokumen')->result_array();

            if( $this->session->userdata('eksId') != null)
            {

                $this->form_validation->set_rules('nama', 'Nama Surat / Keterangan', 'required');
                $this->form_validation->set_rules('js', 'Jenis Sampel', 'required');
                $this->form_validation->set_rules('jd', 'Jenis Dokumen', 'required');
                $this->form_validation->set_rules('namaManufacture', 'Nama Perusahaan', 'required');
                $this->form_validation->set_rules('alamatManufacture', 'Alamat Perusahaan', 'required');
                $this->form_validation->set_rules('noMA', 'Nomer MA', 'required|numeric');
                $this->form_validation->set_rules('batch', 'No Batch', 'required|numeric');
                $this->form_validation->set_rules('penyimpanan', 'Penyimpanan', 'required');
                $this->form_validation->set_rules('expiry', 'Masa Berlaku', 'required');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dsbHeader',$data);
                    $this->load->view('sample_user/tambah');
                    $this->load->view('temp/dsbFooter');
                }else{
                    $this->User_Sample_model->addSample();
                }
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        // public function tambahSample($id)
        // {
        //     $idLevel = $this->session->userdata('idLevel') ;
        //     $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
        //     $data['header'] = 'Data Sample'; 
        //     $data['bread'] = 'dsb / Informasi Sample /<a href="'.base_url().'sample/tambah/'.$id.'"> Data Sample </a> / Tambah Sample '; 
        //     $data['sample'] = $this->Sample_model->getDataSample();
        //     $data['jenisSample'] = $this->db->get('jenisSample')->result_array();
            
        //     $surat =  $this->Sample_model->judul($id);

        //     $data['judulSurat'] = $surat['keterangan'];
        //     $data['pengirim'] = $surat['namaEU'];
        //     $data['id'] = $id ;

        //     $data['sample'] =  $this->Sample_model->getSample($id);

        //     if( $this->session->userdata('eksId') != null )
        //     {
        //         $this->form_validation->set_rules('nama', 'Nama Surat / Keterangan', 'required');
        //         $this->form_validation->set_rules('js', 'Jenis Sampel', 'required');
        //         $this->form_validation->set_rules('vial', 'Vial', 'required');
        //         $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

        //         if($this->form_validation->run() == FALSE) {
        //             $this->load->view('temp/dsbHeader',$data);
        //             $this->load->view('sample/tambahSample',$data);
        //             $this->load->view('temp/dsbFooter');
        //         }else{
        //             $this->Sample_model->addSample($id);
        //         }
        //     }else{
        //         $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
        //         redirect('auth/inuser') ;
        //     }
        // }

        // public function cetak($id) 
        // {
        //     $data['id'] = $id ;
        //     $this->load->view('sample/cetak', $data);
        // }
    }

?>