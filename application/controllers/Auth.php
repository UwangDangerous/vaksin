<?php 

    class Auth extends CI_Controller{
        public function __construct() 
        {
            parent::__construct() ;
            $this->load->model('Login_model');
            $this->load->library('form_validation');
        }

        // eksternal user
        
        public function index()
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header');
                    $this->load->view('temp/navbar');
                    $this->load->view('auth/index');
                    $this->load->view('temp/footerPage');
                    $this->load->view('temp/footer');
                }else{
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $this->Login_model->loginEksUser($email,$password);
                }
        }

        public function register()
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header');
                    $this->load->view('temp/navbar');
                    $this->load->view('auth/register');
                    $this->load->view('temp/footerPage');
                    $this->load->view('temp/footer');
                }else{
                    
                }
        }











        // internal user

        public function inuser()
        {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

                if($this->form_validation->run() == FALSE) {
                    $this->load->view('temp/header');
                    $this->load->view('temp/navbar');
                    $this->load->view('auth/inuser');
                    $this->load->view('temp/footerPage');
                    $this->load->view('temp/footer');
                }else{
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $this->Login_model->loginInUser($username,$password);
                }
        }





























        // logout
        public function logout() 
        {
            $this->session->sess_destroy();
            redirect('Auth/inuser') ; 
        }

        public function logoutEks() 
        {
            $this->session->sess_destroy();
            redirect('Auth') ; 
        }
    }

?>