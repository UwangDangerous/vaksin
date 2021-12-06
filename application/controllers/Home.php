<?php 

    class Home extends CI_Controller{
        // public function __construct() 
        // {
        //     parent::__construct() ;
        //     $this->load->library('form_validation');
        // } 

        public function index() 
        {
            $this->load->view('temp/header');
            $this->load->view('temp/navbar');
            $this->load->view('home/index');
            $this->load->view('temp/footerPage');
            $this->load->view('temp/footer');
        }
        public function temp() 
        {
            $this->load->view('home/temp');
        }

        

    }
?>