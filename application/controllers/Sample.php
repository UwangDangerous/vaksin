<?php 

    class Sample extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Sample_model');
        }

        public function index()
        {
            $this->load->model('_Date');
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Penerimaan Surat'; 
            $data['sample'] = $this->Sample_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sample/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambah($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'sample"> Penerimaan Surat </a> / Data Sample '; 
            // $data['sample'] = $this->Sample_model->getDataSample();

            
            $surat =  $this->Sample_model->judul($id);

            $data['judulSurat'] = $surat['keterangan'];
            $data['pengirim'] = $surat['namaEU'];
            $data['id'] = $id ;

            $data['sample'] =  $this->Sample_model->getSample($id);

            if( $this->session->userdata('key') != null)
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sample/tambah');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambahSample($id)
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = 'Dashboard / Penerimaan Surat /<a href="'.base_url().'sample/tambah/'.$id.'"> Data Sample </a> / Tambah Sample '; 
            $data['sample'] = $this->Sample_model->getDataSample();
            $data['jenisSample'] = $this->db->get('jenisSample')->result_array();
            
            $surat =  $this->Sample_model->judul($id);

            $data['judulSurat'] = $surat['keterangan'];
            $data['pengirim'] = $surat['namaEU'];
            $data['id'] = $id ;

            $data['sample'] =  $this->Sample_model->getSample($id);

            if( $this->session->userdata('key') != null )
            {
                $this->form_validation->set_rules('nama', 'Nama Surat / Keterangan', 'required');
                $this->form_validation->set_rules('js', 'Jenis Sampel', 'required');
                $this->form_validation->set_rules('vial', 'Vial', 'required');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('sample/tambahSample',$data);
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->Sample_model->addSample($id);
                }
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function cetak($id) 
        {
            $data['id'] = $id ;
            $this->load->view('sample/cetak', $data);
        }
    }

?>