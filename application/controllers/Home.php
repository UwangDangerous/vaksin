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

        public function riwayat($idBatch) {
            $this->load->model('_Date') ;
            $this->load->model('_Riwayat') ;

            $data['riwayat_pekerjaan']  = $this->_Riwayat->getDataRiwayat($idBatch);
            $data['idBatch'] = $idBatch ;
            $this->load->view('home/riwayat', $data) ;
        }

        public function respon_tanggapan($idBatch) {
            $this->load->model('_Date') ;
            $this->load->model('_Riwayat') ;

            $data['respon']  = $this->_Riwayat->getDataResponTaggapan($idBatch);
            $data['idBatch'] = $idBatch ;
            $this->load->view('home/respon_tanggapan', $data) ;
        }

        

    }
?>