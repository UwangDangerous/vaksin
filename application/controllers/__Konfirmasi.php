<?php 

    class __Konfirmasi extends CI_Controller{
        public function __construct() {
            parent::__construct() ;
            $this->load->model('__Konfirmasi_model');
        }

        public function pelulusan() 
        {

            $data['judul'] = 'Konfirmasi Petugas Evaluasi '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Konfirmasi Petugas Evaluasi'; 
            $data['bread'] = '<a href='.base_url().'dashboard>Dashboard</a> / Petugas Pelulusan'; 
            $data['petugas'] = $this->__Konfirmasi_model->getDataPelulusan() ;
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('__konfirmasi/pelulusan');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
                
            }

        }

    }

?>