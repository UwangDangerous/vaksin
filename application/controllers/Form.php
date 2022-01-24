<?php 

    class Form extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->library('form_validation');
            $this->load->model('Form_model');
        }

        public function index($id)
        {
            $this->load->model('_Date');
            $data['judul'] = 'Form Evaluasi '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Form Evaluasi'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / Form Evaluasi'; 
            $data['general_informasi'] = $this->db->get('tbl_general_informasi')->result_array() ;
            $data['tabel'] = $this->Form_model->getDataTabel($id) ;
            $data['jenisSample'] = $this->Form_model->jenisSample($id);
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



        // general informasi
            public function add_gi_used($id, $idGI ) 
            {
                $query = [
                    'idGI' => $idGI , 
                    'idJenisSample' => $id 
                ] ;
                
                $this->db->insert('tbl_gi_used', $query) ;

                $pesan = [
                    'pesan_gi' => 'Data Berhasil Di Tambah',
                    'warna_gi' => 'success'
                ];
                $this->session->set_flashdata($pesan);
                $this->gi_used($id);
            }
            
            public function off_gi_used($id, $idGI ) 
            {
                $this->db->where('idGI', $idGI) ;
                $this->db->where('idJenisSample', $id) ;
                $this->db->delete('tbl_gi_used') ;

                $pesan = [
                    'pesan_gi' => 'Data Berhasil Di Hapus',
                    'warna_gi' => 'danger'
                ];
                $this->session->set_flashdata($pesan);
                $this->gi_used($id);
            }

            public function gi_used($id) 
            {
                $data['id'] = $id ;
                $this->db->where('idJenisSample', $id) ;
                $this->db->join('tbl_general_informasi', 'tbl_general_informasi.idGI = tbl_gi_used.idGI') ;
                $data['sample'] = $this->db->get('tbl_gi_used')->result_array() ;
                $this->load->view('form/form_gi/use_form_gi',$data);
            }
        // general informasi


        // tabel
            public function tabel($id)
            {
                $this->db->where('id_tbl_proses', $id) ;
                $data['tabel'] = $this->db->get('tbl_proses')->result_array() ;

                // $this->load->view()
            }
        // tabel































        public function tabelProses($id) 
        {
            echo 'ok' ;
        }
    }

?>