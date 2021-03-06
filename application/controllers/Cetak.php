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

        public function form_evaluasi($id,$idBatch) //$id = idJenisSample
        {
            $data['id'] = $id ;
            $data['idBatch'] = $idBatch ;
            $data['sample'] = $this->Cetak_model->getJudulSample($idBatch);
            $data['idSample'] = $data['sample']['idSample'] ;
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

        //template form
            public function form_header($judul,$css) 
            {
                $html = '
                    <!DOCTYPE html>
                        <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <link rel="stylesheet" href="'.base_url().'assets/css/cetak/form/'.$css.'.css">
                                <link rel="icon" href="'.base_url().'assets/img/logo-bpom.png">
                                <title>'.$judul.'</title>
                            </head>

                            <body>
                    ' ;

                return $html ;
            } 
        //template form

        public function form_penerimaan_sample($idSurat){ //off
            $data['header'] = $this->form_header('Form Penerimaan Sampel', 'form_penerimaan_sampel') ;
            $data['dokumen'] = $this->Cetak_model->getInformasiPenerimaan() ;
            $data['contoh'] = $this->Cetak_model->getInformasiContoh() ;
            $data['surat'] = $this->Cetak_model->getDataSuratPengujianPengantar($idSurat) ;
            $data['judul'] = 'BALAI PENGUJIAN PRODUK BIOLOGI <BR> FORM PENERIMAAN SAMPEL' ;

            $this->load->view('cetak/form/form_penerimaan_sample',$data) ;
        }

        public function surat_perintah_pengujian(){ //off
            $data['header'] = $this->form_header('Surat Perintah Pengujian', 'surat_perintah_pengujian') ;
            // $data['dokumen'] = $this->Cetak_model->getInformasiPenerimaan() ;
            // $data['contoh'] = $this->Cetak_model->getInformasiContoh() ;
            // $data['surat'] = $this->Cetak_model->getDataSuratPengantar($idSurat) ;
            $data['judul'] = 'BALAI PENGUJIAN PRODUK BIOLOGI <BR> SURAT PERINTAH PENGUJIAN' ;

            $this->load->view('cetak/form/surat_perintah_pengujian',$data) ;
        }

        public function surat_perintah_evaluasi(){ //off
            $data['header'] = $this->form_header('Surat Perintah Evaluasi', 'surat_perintah_evaluasi') ;
            // $data['dokumen'] = $this->Cetak_model->getInformasiPenerimaan() ;
            // $data['contoh'] = $this->Cetak_model->getInformasiContoh() ;
            // $data['surat'] = $this->Cetak_model->getDataSuratPengantar($idSurat) ;
            $data['judul'] = 'BALAI PENGUJIAN PRODUK BIOLOGI <BR> SURAT PERINTAH EVALUASI' ;

            $this->load->view('cetak/form/surat_perintah_evaluasi',$data) ;
        }

        public function surat_permintaan_sample(){ //off
            $data['header'] = $this->form_header('Surat Permintaan Sample', 'surat_permintaan_sample') ;
            // $data['dokumen'] = $this->Cetak_model->getInformasiPenerimaan() ;
            // $data['contoh'] = $this->Cetak_model->getInformasiContoh() ;
            // $data['surat'] = $this->Cetak_model->getDataSuratPengantar($idSurat) ;
            $data['judul'] = '' ;

            $this->load->view('cetak/form/surat_permintaan_sample',$data) ;
        }

        public function form_konfirmasi_pengujian(){ //off
            $data['header'] = $this->form_header('Form Konfirmasi Pengujian', 'form_konfirmasi_pengujian') ;
            // $data['dokumen'] = $this->Cetak_model->getInformasiPenerimaan() ;
            // $data['contoh'] = $this->Cetak_model->getInformasiContoh() ;
            // $data['surat'] = $this->Cetak_model->getDataSuratPengantar($idSurat) ;
            $data['judul'] = 'FORM KONFIRMASI PENGUJIAN' ;

            $this->load->view('cetak/form/form_konfirmasi_pengujian',$data) ;
        }

        public function lembar_tanggapan(){ //off
            $data['header'] = $this->form_header('Lembar Tanggapan', 'lembar_tanggapan') ;
            $data['judul'] = 'BALAI PENGUJIAN PRODUK BIOLOGI' ;

            $this->load->view('cetak/form/lembar_tanggapan',$data) ;
        }





        public function surat_perintah_kerja($id, $tugas, $idPengujian=0)
        {  //on
            $data['id'] = $id ; //idBatch
            // $data['tugas'] = $tugas; //1.pelulusan | 2.pengujian

            if($tugas == 1) {
                $data['tugas'] = 'Pelulusan Produk' ;
                $data['surat'] = $this->Cetak_model->getDataSurat($id) ;
            }else {
                $data['tugas'] = 'Pengujian' ;
                $data['surat'] = $this->Cetak_model->getDataSuratPengujian($idPengujian) ;
            }

            $data['verifikator'] = $this->Cetak_model->petugasVerifikasiPelulusan($id) ;

            $data['header'] = $this->form_header('Surat Perintah Kerja', 'surat_perintah_kerja') ;
            $data['judul'] = 'BALAI PENGUJIAN PRODUK BIOLOGI <BR> SURAT PERINTAH KERJA' ;

            $this->load->view('cetak/form/surat_perintah_kerja',$data) ;
        }

        // public function test($id){
        //     var_dump($this->Cetak_model->petugasVerifikasiPengujian($id)) ;
        // }

        

        

    }

?>