<?php 

    class Dashboard extends CI_Controller{
        // public function __construct() 
        // {
        //     parent::__construct() ;
        //     $this->load->library('form_validation');
        // }

        public function index()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Dashboard '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Dashboard'; 
            $data['bread'] = 'Dashboard'; 
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('dashboard/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }
    }

?>