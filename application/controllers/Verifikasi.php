<?php 

    class Verifikasi extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Verifikasi_model');
        }

        public function index()
        {
            $data['judul'] = 'Data Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data Sample'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Hasil Evaluasi'; 
            $data['sample'] = $this->Verifikasi_model->getDataSample();
            if( $this->session->userdata('key') != null )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('verifikasi/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function tambah($id)
        {
            $data['judul'] = 'Verifikasi Sample '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Verifikasi Sample'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'verifikasi "> Hasil Evaluasi  </a> / Verifikasi Sample'; 
            $data['sample'] = $this->Verifikasi_model->getDataSampleVerifikasi($id);
            $data['pesan'] = $this->db->get('pesan')->result_array();
            $this->load->model('_Date');
            if( $this->session->userdata('key') != null )
            {
                // $this->form_validation->set_rules('batch', 'Batch No', 'required|numeric');
                // $this->form_validation->set_rules('doses', 'Doses', 'required|numeric');
                // $this->form_validation->set_rules('tanggal', 'Tanggal Pengiriman', 'required');

                // if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('verifikasi/tambah');
                    $this->load->view('temp/dashboardFooter');
                // }else{
                //     $this->Evaluasi_model->addHasilEvaluasi($id,$petugas);
                // }
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function verifikasi() 
        {
            $query = [
                'idEvaluasi' => $this->input->post('id'),
                'status' => $this->input->post('status'),
                'keterangan' => $this->input->post('keterangan')
            ]; 
            if($this->db->insert('verifikasi', $query)){
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
            }
            $this->session->set_flashdata($pesan);
            redirect('verifikasi') ;
        }

    }

?>