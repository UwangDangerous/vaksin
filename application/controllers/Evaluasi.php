<?php 

    class Evaluasi extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Evaluasi_model');
        }

        public function index()
        {
            $this->load->model('_Date');
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Ceklis Tersedia'; 
            $data['sample'] = $this->Evaluasi_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('evaluasi/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambah($id)
        {
            $data['judul'] = 'Evaluasi Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Evaluasi Sample'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'evaluasi "> Ceklis Tersedia  </a> / Input Hasil Evaluasi'; 
            $data['sample'] = $this->Evaluasi_model->getDataSampleEvaluasi($id);
            // $data['petugas'] = $petugas;
            if( $this->session->userdata('key') != null )
            {
                $this->form_validation->set_rules('batch', 'Batch No', 'required|numeric');
                $this->form_validation->set_rules('doses', 'Doses', 'required|numeric');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('evaluasi/tambah');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->Evaluasi_model->addHasilEvaluasi($id);
                }
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }
    }

?>