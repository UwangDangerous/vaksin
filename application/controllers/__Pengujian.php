<?php 

    class __Pengujian extends CI_Controller{
        public function __construct()
        {
            parent :: __construct() ;
            $this->load->model('__Pengujian_model') ;
        }

        public function index()
        {
            $data['judul'] = 'Pengujian Sampel '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Pengujian Sampel'; 
            $data['bread'] = '<a href='.base_url().'dashboard>Dashboard</a> / Pengujian Sampel'; 
            $data['pengujian'] = $this->__Pengujian_model->getDataPengujian() ;
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('__pengujian/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
                
            }
        }
    }

?>