<?php 

    class Form_GI extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            // $this->load->library('form_validation');
            // $this->load->model('Form_GI_model');
        }

        public function index()
        {
            $this->load->library('form_validation');
            
            $this->load->model('_Date');
            $data['judul'] = 'General Informasi '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'General Informasi'; 
            $data['bread'] = '<a href="'.base_url().'dashboard"> Dashboard </a> / General Informasi'; 
            $data['general_informasi'] = $this->db->get('tbl_general_informasi')->result_array() ;
            $data['idGI'] = ['1|Evaluasi','2|Pihak Ke 3'] ;
            if( $this->session->userdata('key') != null )
            {
                $this->form_validation->set_rules('nama', 'General Informasi', 'required');
                $this->form_validation->set_rules('penugasan', 'Penugasan', 'required') ;

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('form/form_gi/index');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->simpan() ;
                }
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
            }
        }

        public function simpan() 
        {
            $query = [
                    'namaGI' => $this->input->post('nama', true) ,
                    'tugasGI' => $this->input->post('penugasan')
                ] ;
            if( $this->db->insert('tbl_general_informasi', $query) ) {
                $pesan = [
                    'pesan' => 'Data Berhasil Disimpan',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Disimpan',
                    'warna' => 'danger'
                ];
            }

            $this->session->set_flashdata($pesan) ;
            redirect('form_gi') ;
        }

        public function ubahDataGI($id) 
        {
            $query = [
                'namaGI' => $this->input->post('nama_gi', true) ,
                'tugasGI' => $this->input->post('aksi')
            ] ;

            // var_dump($query) ; die;
            $this->db->where('idGI', $id);
            // $this->db->set($query);
            if( $this->db->update('tbl_general_informasi', $query) ) {
                $pesan = [
                    'pesan' => 'Data Berhasil DiUbah',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal DiUbah',
                    'warna' => 'danger'
                ];
            }
            
            $this->session->set_flashdata($pesan);
            redirect('form_gi') ;
            
        }

        public function hapus($id) 
        {
            $this->db->where('idGI', $id);
            if( $this->db->delete('tbl_general_informasi') ) {
                $pesan = [
                    'pesan' => 'Data Berhasil Di Hapus',
                    'warna' => 'success'
                ];
            }else{
                $pesan = [
                    'pesan' => 'Data Gagal Di Hapus',
                    'warna' => 'danger'
                ];
            }
            
            $this->session->set_flashdata($pesan);
            redirect('form_gi') ;
        }
    }

?>