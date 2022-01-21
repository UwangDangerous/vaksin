<?php 

    class Form extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            // $this->load->model('Form_GI_model');
        }

        public function index($id)
        {
            $this->load->model('_Date');
            $data['judul'] = 'Form Evaluasi '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Form Evaluasi'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Form Evaluasi'; 
            $data['general_informasi'] = $this->db->get('tbl_general_informasi')->result_array() ;
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('form/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }
    }

?>