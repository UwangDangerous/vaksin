<?php 

    class Sertifikat Extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Sertifikat_model');
            $this->load->model('_Date');
            $this->load->model('Cetak_model');
        }

        public function pelulusan()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Sertifikat Pelulusan '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Sertifikat Pelulusan'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Penerimaan Surat'; 
            $data['sample'] = $this->Sertifikat_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('sertifikat/pelulusan');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

    }

?>