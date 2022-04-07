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
    }

?>