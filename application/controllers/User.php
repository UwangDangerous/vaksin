<?php 

    class User extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('User_model');
            $this->load->library('form_validation');
        }

        public function index()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Data User Internal'. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data User Internal'; 
            $data['bread'] = '<a href="'.base_url().'dashboard">Dashboard</a> / Data User'; 

            $data['user'] = $this->User_model->getDataUser();

            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('user/index');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
            }
        }


        public function tambah()
        {
            $idLevel = $this->session->userdata('idLevel') ;
            $data['judul'] = 'Tambah Data User '. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Tambah Data User'; 
            $data['bread'] = 'Dashboard / <a href="'.base_url().'user">Data User</a> / Tambah Data'; 

            $data['user'] = $this->User_model->getDataUser();
            $data['level'] = $this->User_model->getDataLevel();

            if( ($this->session->userdata('key') != null) )
            {
                $this->form_validation->set_rules('nama', 'Nama User', 'required');
                $this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
                $this->form_validation->set_rules('level', 'Level User', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/dashboardHeader',$data);
                    $this->load->view('user/tambah');
                    $this->load->view('temp/dashboardFooter');
                }else{
                    $this->User_model->addDataUser();
                    $this->session->set_flashdata('pesan' , 'Data Berhasil Di Tambah');
                    redirect('user') ;
                }

            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth/inuser') ;
            }
        }

        public function eksternal()
        {
            $data['judul'] = 'Data User Eksternal'. $this->session->userdata('namaLevel'); 
            $data['header'] = 'Data User Eksternal'; 
            $data['bread'] = '<a href="'.base_url().'dashboard">Dashboard</a> / Data User'; 

            $data['user'] = $this->User_model->getDataUser();

            if( ($this->session->userdata('key') != null) )
            {
                $this->load->view('temp/dashboardHeader',$data);
                $this->load->view('user/eksternal');
                $this->load->view('temp/dashboardFooter');
            }else{
                $this->session->set_flashdata('login' , 'Silahkan Login Kembali');
                redirect('auth') ;
            }
        }
    }

?>