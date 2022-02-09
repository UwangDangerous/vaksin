<?php 

    class Cetak extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('Cetak_model');
            $this->load->model('Evaluasi_model');
            $this->load->model('Petugas_model');
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

        public function sertifikat_import($idSample)
        {
            $data['hasil_evaluasi'] = $this->Cetak_model->getInfoCeklis($idSample);
            $data['sertifikat'] = $this->Cetak_model->cekSertifikat($data['hasil_evaluasi']['id_hasil_evaluasi']);
            $data['idSample'] = $idSample ;
            $data['sample'] = $this->Petugas_model->getDetailSample(0, $idSample);
            $data['batch'] = $this->Cetak_model->getDataBatch($idSample);
            $data['importir'] = $this->Cetak_model->getDataImportir($idSample);
            $this->load->view('cetak/sertifikat_import',$data);
        }
        
        public function sertifikat_domestik($idSample)
        {
            $data['hasil_evaluasi'] = $this->Cetak_model->getInfoCeklis($idSample);
            $data['sertifikat'] = $this->Cetak_model->cekSertifikat($data['hasil_evaluasi']['id_hasil_evaluasi']);
            $data['idSample'] = $idSample ;
            $data['sample'] = $this->Petugas_model->getDetailSample(0, $idSample);
            $data['batch'] = $this->Cetak_model->getDataBatch($idSample);
            $data['importir'] = $this->Cetak_model->getDataImportir($idSample);
            $this->load->view('cetak/sertifikat_domestik',$data);
        }

        

    }

?>