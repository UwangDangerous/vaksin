<?php 

    class coba extends CI_Controller {
        public function index() 
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Dashboard '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Dashboard'; 
            $data['bread'] = 'Dashboard'; 
            $data['jenisSample'] = $this->db->get('_jenisSample')->result_array();
            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('coba/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Anda Bukan Internal User');
                redirect('auth/inuser') ;
                
            }

        }

        public function tambah() {
            echo($this->input->post('cobatini')) ;
        }
    }

?>