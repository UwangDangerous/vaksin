<?php 

    class Cetak extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('Cetak_model');
            $this->load->model('Evaluasi_model');
            $this->load->model('_Date');
            // $this->load->library('form_validation');
        }

        public function form_evaluasi($id,$idSample) //$id = idJenisSample
        {
            $data['id'] = $id ;
            $data['idSample'] = $idSample ;
            $data['sample'] = $this->Cetak_model->getJudulSample($idSample);
            $data['general_informasi'] = $this->Cetak_model->getDataGeneral_informasi($id);            

            $this->load->view('cetak/form_evaluasi',$data);
        }

        

    }

?>