<?php 

    class Sertifikat Extends CI_Controller{
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
                $this->load->view('sertifikat/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function create($id)
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
                $this->load->view('sertifikat/create');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }
    }

?>